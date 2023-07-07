<?php
    require("../model/Class_picture.php");

    session_start();

    $title = $_GET["title"];
    $id = $_SESSION["usuario"]["id"];


    $myPicture = new Picture($title,null,null,$id);

    $pic = $myPicture->getPicture();
    $pic = imagecreatefromstring($pic); 

    $type = $myPicture->getType();

    $Formats = ["image/jpeg"=>".jpeg","image/jpg"=>".jpg" ,"image/pjpeg"=>".pjpeg", "image/gif"=>".gif", "image/png"=>".png"];



    $path= "../assets/".$id.$Formats[$type]; 
    $file = fopen($path, "w");

    switch($Formats[$type]){
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