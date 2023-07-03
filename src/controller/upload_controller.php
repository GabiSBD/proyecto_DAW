<?php
    require("../model/Class_picture.php");
    session_start();
    //obtencion de la imagen a guardar
    $tmpPic = $_FILES["picture"]["tmp_name"];
    $sizePic = $_FILES["picture"]["size"];

    $file = fopen($tmpPic,"r");
    $picture = fread($file,$sizePic);

    fclose($file);
    
    $title = $_FILES["picture"]["name"];
    $id_user = $_SESSION["usuario"]["id"];

    $myPicture = new Picture($title,$picture,$id_user);
    $myPicture->savePicture();
?>