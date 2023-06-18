<!doctype html>
  <html>
    <head>
      <meta charset="utf-8">
      <!--JS-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="js/script_calculadora.js"></script>
      <script src="js/calculadora-nav.js"></script>
      <!--CSS-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="css/cssCalculadora.css" type="text/css">
      <link rel="stylesheet" type="text/css" href="css/nav.css">
      <!--PHP-->
      <?php
        session_start();
      ?>
      <title>Web Calculator</title>
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
    <!-----------------------------------------------interfaz calculadora------------------------------------------------------>
      <table>
        <tr>
          <td colspan="4">
            <input name="display" type="text" class="color_display" id="display" size="25">
          </td>
        </tr>
        <tr>
          <td width="26%"><input name="button" type="button" class="numero" id="button" value="+"></td>
          <td width="21%"><input name="button2" type="button" class="numero" id="button2" value="-"></td>
          <td width="21%"><input name="button3" type="button" class="numero" id="button3" value="*"></td>
          <td width="32%"><input name="button4" type="button" class="numero" id="button4" value="/"></td>
        </tr>
        <tr>
          <td><input name="num7" type="button" class="numero" id="num7" value="7"></td>
          <td><input name="num8" type="button" class="numero" id="num8" value="8"></td>
          <td><input name="num9" type="button" class="numero" id="num9" value="9"></td>
          <td><input name="reset" type="button" class="numero" id="reset" value="C"></td>
        </tr>
        <tr>
          <td><input name="num4" type="button" class="numero" id="num4" value="4" ></td>
          <td><input name="num5" type="button" class="numero" id="num5" value="5"></td>
          <td><input name="num6" type="button" class="numero" id="num6" value="6"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input name="num1" type="button" class="numero" id="num1" value="1"></td>
          <td><input name="num2" type="button" class="numero" id="num2" value="2"></td>
          <td><input name="num3" type="button" class="numero" id="num3" value="3"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input name="num0" type="button" class="numero" id="num0" value="0"></td>
          <td><input name="decimal" type="button" class="numero" id="decimal" value="."></td>
          <td colspan="2"><input name="igual" type="button" class="igual" id="igual" value="="></td>
        </tr>
      </table>
    </body>
  </html>
