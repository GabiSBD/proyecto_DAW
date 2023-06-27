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
    <!--PHP-->
    <?php
      session_start();
    ?>
    <!--JS-->
    <script>
      /*
        Me vi obligado a incrustar aqui el js de este fichero porque no habia 
        otra manera de hacer que las funcionalidades ajax funcionases desde un fichero externo
      */
     $(function(){
      //coloca el editor de texto
        $("#userText").Editor();

        //devuelve a la pagina pricipal al pulsar en el logo
        document.getElementById("logo").addEventListener("click",function(){
            window.location = "index.php";
        },false);

        //cuando el raton se pose sobre el boton delete hara una animacion y dejara de hacerla al salir el focus del ratón
        document.getElementById("delete").addEventListener("mouseover", function(){
          $("#delete").addClass("fa-flip");
        }, false);
        document.getElementById("delete").addEventListener("mouseout", function(){
          $("#delete").removeClass("fa-flip");
        }, false);

         //cuando el raton se pose sobre el boton save hara una animacion y dejara de hacerla al salir el focus del raton
         document.getElementById("save").addEventListener("mouseover", function(){
          $("#save").addClass("fa-flip");
        }, false);
        document.getElementById("save").addEventListener("mouseout", function(){
          $("#save").removeClass("fa-flip");
        }, false);

        //funcion para conexion ajax al guardar texto
        document.getElementById("save").addEventListener("click",function(){
            let title =$("#title").val();

            if(title==null ||title==""||title==" "){
              $("#ajaxMsg").attr("class","text-danger").html("The file title cannot be blank.");
              return false;
            }

            let formData = {
                title:$("#title").val(),
                text:$("#userText").Editor("getText")
            };

            $.post("../controller/saveText_controller.php", formData, responseSaveText);

        },false);
        //funcion ajax para traer texto de vuelta al editor
        document.getElementById("textList").addEventListener("change",function(){

          let txtTitle = $("#textList").val();
          //colocamos el titulo del texto recuperado en el input de guardar para facilitar su post actualizacion
          $("#title").val(txtTitle);

          let formData = {
            title:txtTitle
          };

          $.post("../controller/getText.php", formData, write);
          
        },false);

        // funcion ajax para borrar un texto del la bbdd
        document.getElementById("delete").addEventListener("click", function(){

          if(title==null ||title==""||title==" "){
              $("#ajaxMsg").attr("class","text-danger").html("The file title cannot be blank.");
              return false;
           }

           let formData = {
              title:$("#title").val()
           }

           $.post("../controller/deleteText.php", formData, responseDeleteText);
          
          
        }, false);

        
          
      });
      //coloca un mensaje de respuesta del servidor al guardar texto
    function responseSaveText(data){
        data=="success"? $("#ajaxMsg").attr("class","text-success").html("saved successfully") : $("#ajaxMsg").attr("class","text-danger").html("failed to save");
    }
    //escribe el texto recuperado del la bbdd en el editor
    function write(data){
      data=="error" ? $("#userText").Editor("setText","") : $("#userText").Editor("setText",data);
    }
    //coloca un mensaje de respuesta del servidor al borrar un texto
    function responseDeleteText(data){
      data == "success" ? $("#ajaxMsg").attr("class","text-success").html("delete successfully") : $("#ajaxMsg").attr("class","text-danger").html("failed to delete");
    }
      
    </script>
    
    
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
<!-----------------------------------------------contenedor del editor------------------------------------------------------>
    <div class="container">
                  
      <div class="col-md-8">
          <textarea name="userText" id="userText"></textarea>
      </div>
      <div class="col-md-4">
          <div class="input-group">    
              <input type='text' class="form-control" name='title' id='title' placeholder='Title'<?php if(!isset($_SESSION["usuario"]))echo " disabled"?>>
              <span class="input-group-btn">
                <button id='save' <?php if(!isset($_SESSION["usuario"]))echo "class='btn btn-danger rounded-pill shadow' disabled"; else echo "class='btn btn-primary rounded-pill shadow'";?>>
                  <i class="fa-solid fa-floppy-disk"></i>
                </button>
                <button id='delete' <?php if(!isset($_SESSION["usuario"]))echo "class='btn btn-danger rounded-pill shadow' disabled"; else echo "class='btn btn-primary rounded-pill shadow'";?>>
                  <i class="fa-solid fa-trash"></i>
                </button>
              </span>
          </div>
          <div id="ajaxMsg"></div>
          <div>
            <select id="textList" class="form-control" <?php if(!isset($_SESSION["usuario"]))echo "disabled";?>>
              <option value="" selected>History</option>
              <?php
                include("../controller/history.php"); 
              ?>
            </select>
          <div>    

    </div>
    
</body>
</html>