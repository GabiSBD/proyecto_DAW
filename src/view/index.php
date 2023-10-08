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
    <!--Editor JS-->
    <script src="js/editor.js"></script>
    <!--fontAwesome JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--estilos CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!--php-->
    <?php
     session_start();
    ?>
    <!--JS-->
    <script src="js/index.js"></script>
 
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
                          <button class='nav-font btn btn-info' id='submit'><i class='fa-solid fa-right-from-bracket' style='color: #ffffff;'></i></button>
                          </label>
                      </div>
                    </form>
                  </li>";
                  if($_SESSION["usuario"]["isAdmin"]== 0){ 
                    echo "<li>
                    <form action='../controller/deleteUser_controller.php' method='POST'>
                      <div class='checkbox'>
                        <label class='nav-font'>
                        <button class='nav-font btn btn-danger' id='submit'><i class='fa-solid fa-user-xmark' style='color: #ffffff;'></i></button>";
                          if(isset($_GET["error"])) echo "<p class='alert alert-danger nav-font'>".$_GET["error"]."</p>
                        </label>
                      </div>
                    </form>
                  </li>";}
                echo "</ul>
              </li>
            </ul>";
           
              
            }else{
              echo "<ul class='nav navbar-nav navbar-right'>
              <li class='login'>
                <a href='#' class='dropdown-toggle nav-font' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
                  <i class='fa-solid fa-user'></i>&nbsp; SIGN IN/SIGN UP
                <span class='caret'></span>
                </a>
                <ul class='dropdown-menu'>
                  <li>
                    <form id='formIndex' action='../controller/login_controller.php' method='POST'>
                      <div style='text-align:center;'>
                          <label for='username' class='nav-font'>UserName</label>
                          <input type='text' id='username' name='username' placeholder='User' required>
                      </div>
                      <div style='text-align:center;'>
                          <label for='password' class='nav-font'>Password</label>
                          <input type='password' name='password' id='password'>";
                          if(isset($_GET["error"])) echo "<p class='alert alert-danger nav-font'>".$_GET["error"]."</p>";
                     echo "</div>
                      <div class='checkbox input-group'>
                          <span class='nav-font input-group-addon'>
                            <input  type='checkbox' name='new_user' value='new_user'>New User
                          </span>
                      </div>
                      <div style='text-align:center;'>
                      <button class='nav-font btn btn-info' id='submit'><i class='fa-solid fa-arrow-right-to-bracket' style='color: #ffffff;'></i></button>
                      <button class='nav-font btn btn-danger' id='reset'><i class='fa-solid fa-eraser' style='color: #ffffff;'></i></button>
                      </div>
                    </form>
                  </li>
                </ul>
              </li>
            </ul>";
            session_destroy();
            }
          ?>
        </div>
      </nav>
    <!------------------------------Contenido de la pagina pricipal--------------------------------------------------->

    <div class="container container-btn">
        <div class="col-md-6 col-btn">
          <button class="btn btn-primary rounded-pill shadow btn-freeOffice" id="typeWriter">TypeWriter</button>
        </div>
        <div class="col-md-6 col-btn">
          <button class="btn btn-primary rounded-pill shadow btn-freeOffice" id="galery">Galery</button>
        </div>
        <div class="col-md-12 col-btn">
            <?php
              if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["isAdmin"]==1)
              echo "<br><br><button class='btn btn-primary rounded-pill shadow btn-freeOffice' id='adminArea'>Admin Area</button>";
            ?>
            
        </div>
    </div>
</body>
</html>