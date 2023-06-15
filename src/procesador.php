<!DOCTYPE html>
<html lang="es">
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
     
    <!--estilos CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/editor.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <!--JS-->
    <script>
      $(function(){
        $("#userText").Editor();

        document.getElementById("logo").addEventListener("click",function(){
            window.location = "index.php";
        },false);

        //funcion para conexion ajax al guardar texto
        $("#save").click(function(){

           // $("#saveSucess").html("entró en el met ajax");

           let formData = {
                title:$("#title").val(),
                text:$("#userText").Editor("getText")
            };

            $.post("php/saveText_controller.php", formData, responseSaveText);

            

       });
        function responseSaveText(data){
            data=="sucess"? $("#saveSucess").html("guardado con exito") : $("#saveSucess").html("error al guardar");
        }
    });
    </script>
    <!--PHP-->
    <?php
      session_start();
    ?>
    <title>free text</title>
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
                    <form action='php/logOut_controller.php' method='POST'>
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
                <a href='#' class=' nav-font'>
                  <i class='fa-solid fa-user'></i>&nbsp; Guest User
                </a>
                ";
            session_destroy();
            }
          ?>
        </div>
      </nav>
<!-----------------------------------------------contenedor del editor------------------------------------------------------>
    <div class="container">
                  
      <div class="col-md-8">
          <textarea name="userText" id="userText"></textarea>
      </div>
      <div class="col-md-4">
          <div> 
          
              
              <input type='text' name='title' id='title' placeholder='Title'>
              <button id='save' <?php if(!isset($_SESSION["usuario"]))echo " disabled"?>>Guardar</button>
            
            
          
          </div>
          <div id="saveSucess"></div>       

    </div>
    
</body>
</html>