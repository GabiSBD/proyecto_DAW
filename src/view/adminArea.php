<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" type="text/css" href="css/adminArea.css">
    <!--php-->
    <?php
     session_start();
     if(!isset($_SESSION["usuario"])) header("location:index.php");
    ?>
    <!-- JS-->
    <script src="js/adminArea.js"></script>

    <title>Admin Area</title>
</head>
<body>
<!---------------------------------------------barra navegacion------------------------------------------------>
<nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header" id="logo">
            <span class="navbar-brand">
              <i class="fa-solid fa-toolbox"></i>
                <label class="nav-font">DgToolbox</label>
            </span>
          </div>
            <ul class='nav navbar-nav navbar-right'>
              <li class='login'>
                <a href='#' class='dropdown-toggle nav-font' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
                  <i class='fa-solid fa-user'></i>&nbsp;<?php echo $_SESSION["usuario"]["name"]?>
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
                  </li>
                </ul>
              </li>
            </ul>
        </div>
</nav>
<!--------------------------------------------------------------------------------------------------------------->


<div class="container">
  <div id="adminTable"></div>
</div>














</body>
</html>