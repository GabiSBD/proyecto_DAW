<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--Bootstrap JS-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!--fontAwesome JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--estilos CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" href="css/galery.css">
    <!--PHP-->
    <?php
      session_start();
    ?>
    <!--JS-->
    <script src="js/galery.js"></script>
    <title>DgToolbox</title>
</head>
<body>
    <!-----------------------------------------------Barra navegacion------------------------------------------------------>
    <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header" id="logo">
            <span class="navbar-brand">
              <i class="fa-solid fa-toolbox"></i>
                <label class="nav-font">DgToolbox</label>
            </span>
          </div>
          <?php
          
            if(isset($_SESSION["usuario"])){
              echo "<ul class='nav navbar-nav navbar-right'>
              <li class='login'>
                <a href='#' class='dropdown-toggle nav-font' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
                  <i class='fa-solid fa-user'></i>&nbsp;".$_SESSION["usuario"]["name"]."
                <span class='caret'></span>
                </a>
                <ul class='dropdown-menu'>
                  <li>
                    <form action='../controller/logOut_controller.php' method='POST'>
                      <div class='checkbox'>
                          <label class='nav-font'>
                          <input class='btn btn-info' type='submit' value='Log Out'>
                          </label>
                      </div>
                    </form>
                  </li>";
                  if($_SESSION["usuario"]["isAdmin"] == 0){
                    echo "<li>
                      <form action='../controller/deleteUser_controller.php' method='POST'>
                        <div class='checkbox'>
                          <label class='nav-font'>
                            <input class='btn btn-danger' type='submit' value='Delete User'>";
                            if(isset($_GET["error"])) echo "<p class='alert alert-danger nav-font'>".$_GET["error"]."</p>";
                         echo " </label>
                        </div>
                      </form>
                    </li>";}
                  echo "</ul>
                </li>
              </ul>";
              
            }else{
              echo "<ul class='nav navbar-nav navbar-right'>
              <li class='login'>
                <a href='#' class=' nav-font'>
                  <i class='fa-solid fa-user'></i>&nbsp; Guest User
                </a>
                ";
            session_destroy();
            }
          ?>
        </div>
    </nav>

      <!-----------------------------------------------contenedor de Galery------------------------------------------------------>
      <div class="container">
                  
        <div class="col-md-8" id="album"></div>
        <div class="col-md-4">
            <div class="form-group">
              <label id="iconSave" class="control-label col-sm-2" for="picture"><i class="fas fa-images fa-lg"></i></label>
              <div class="col-sm-10">
                <input type="file" class="form-control" id="picture" name="picture" accept="image/jpeg" <?php if(!isset($_SESSION["usuario"]))echo " disabled"?>>
                <button id="upload" <?php if(!isset($_SESSION["usuario"]))echo "class='btn btn-danger rounded-pill shadow' disabled"; else echo "class='btn btn-primary rounded-pill shadow'";?>>
                  <i class="fa-solid fa-upload"></i>
                </button>
               <div id='ajaxMsg'></div>
              </div>
            </div>
        </div>
      </div>
</body>
</html>