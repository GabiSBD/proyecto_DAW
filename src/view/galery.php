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
    <!--estilos CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <!--PHP-->
    <?php
      session_start();
    ?>

    <title>Free Galery</title>
</head>
<body>
    <!-----------------------------------------------Barra navegacion------------------------------------------------------>
    <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header clickElement" id="logo">
            <span class="navbar-brand">
                <i class="fa-solid fa-feather"></i>
                <label class="nav-font">Free Office</label>
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
                  </li>
                  <li>
                    <form action='../controller/deleteUser_controller.php' method='POST'>
                      <div class='checkbox'>
                        <label class='nav-font'>
                          <input class='btn btn-danger' type='submit' value='Delete User'>";
                          if(isset($_GET["error"])) echo "<p class='text-danger nav-font'>".$_GET["error"]."</p>";
                       echo " </label>
                      </div>
                    </form>
                  </li>
                </ul>
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
    
</body>
</html>