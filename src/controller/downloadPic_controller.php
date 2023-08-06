<?php
    require("../model/Class_picture.php");

    session_start();

    $title = $_GET["title"];
    $id = $_SESSION["usuario"]["id"];


    $myPicture = new Picture($title,null,null,$id);

    $pic = $myPicture->getPicture();
    $pic = imagecreatefromstring($pic); 

    //separamos el nombre del archivo pasado en title de su extension;
    $extension =strtolower(".".pathinfo($title, PATHINFO_EXTENSION));

    $path= "../assets/".$id.$extension; 
    $file = fopen($path, "w");
    
    //guardamos la imagen capturada en el fichero en funcion de su extensión
    switch($extension){
        case ".jpeg"||".jpg"||".pjpeg":
            imagejpeg($pic, $file);
            break;
        case ".png":
            imagepng($pic,$file);
            break;
        case ".gif":
            imagegif($pic,$file);
            break;
    }
    fclose($file);

    



?>