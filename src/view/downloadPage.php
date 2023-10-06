<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="css/downloadPic.css">
    <!-- JS -->
    <script src="js/downloadPage.js"></script>

    <title>Download link page</title>
    <?php
        session_start();
        
       if(isset($_GET["title"])){
        require("../controller/downloadPic_controller.php");

        //separamos el nombre del archivo pasado en title de su extension;
        $title = $_GET["title"];
        $id = $_SESSION["usuario"]["id"];
        $extension =strtolower(".".pathinfo($title, PATHINFO_EXTENSION));
       }

        if(isset($_GET["txtTitle"]) && isset($_SESSION["usuario"])){
        require("../controller/downloadTxt_controller.php");

        //definimos el nombre y extension donde debe recuperar el texto a descargar previamente guardado en assets
        $id = $_SESSION["usuario"]["id"];
        $extension =".odt";
       }
       else if(isset($_GET["txtTitle"]) && $_GET["text"] && !isset($_SESSION["usuario"])){
        require("../controller/downloadTxt_controller.php");
        
        $id=$_COOKIE["uid"];
        $title = $_GET["txtTitle"];
        $extension =".odt";
       }
    ?>
</head>
<body>
    
    <div class="container">
        <div class="col-md-12 downloadLink">
            <a download href='<?php if(isset($_SESSION["usuario"]))echo "../assets/".$id.$extension; else echo "../assets/".$id.$title.$extension?>'>
                <button class="btn btn-info rounded-pill shadow">CLICK TO DOWNLOAD</button>
            </a>
        </div>
    </div>
    
</body>
</html>