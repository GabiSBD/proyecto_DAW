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
    <script src="js/index.js"></script>
    <title>Free office</title>
</head>
<body>
<!-----------------------------------------------Barra navegacion------------------------------------------------------>
    <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header" id="logo">
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
                          <input  type='submit' value='Log Out'>
                          </label>
                      </div>
                    </form>
                  </li>
                </ul>
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
                    <form action='../controller/login_controller.php' method='POST'>
                      <div>
                          <label for='username' class='nav-font'>UserName</label>
                          <input type='text' id='username' name='username' placeholder='User' required>
                      </div>
                      <div>
                          <label for='password' class='nav-font'>Password</label>
                          <input type='password' name='password' id='password'>
                      </div>
                      <div class='checkbox'>
                          <label class='nav-font'>
                          <input  type='checkbox' name='new_user' value='new_user'>New User
                          </label>
                      </div>
                      <input class='nav-font' type='submit' name='submit' value='Send'>
                      <input class='nav-font' type='reset' name='clear' value='Reset'>
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
            <button class="btn btn-primary rounded-pill shadow btn-freeOffice btn-procesador" id="freeWritter">FreeWriter</button>
        </div>
        <div class="col-md-6 col-btn">
            <button class="btn btn-primary rounded-pill shadow btn-freeOffice btn-calculadora" id="calculator">Calculator</button>
        </div>
    </div>
</body>
</html>