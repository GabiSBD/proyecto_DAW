<?php
    require("../model/Class_picture.php");
    session_start();
    
    //obtencion de propiedades del archivo file
    $tmpPic = $_FILES["picture"]["tmp_name"];
    $sizePic = $_FILES["picture"]["size"];
    $typePic = $_FILES["picture"]["type"];
    $titlePic = $_FILES["picture"]["name"];

//verificacion de formato del file
    $validFormats = ["image/jpeg","image/jpg" ,"image/pjpeg", "image/gif", "image/png"];
    if(!in_array($typePic,$validFormats,true)){
        header("location:../view/galery.php?badResponse=failed+to+save,+invalid+Format");
        exit();
    }

//obtencion del archivo a persistir en la bbdd
    $file = fopen($tmpPic,"r");
    $picture = fread($file,$sizePic);

    fclose($file);
    
    
    $id_user = $_SESSION["usuario"]["id"];

    $myPicture = new Picture($titlePic,$typePic,$picture,$id_user);
    $myPicture->savePicture();
?>