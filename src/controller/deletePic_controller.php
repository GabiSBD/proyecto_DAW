<?php
    require("../model/Class_picture.php");
    session_start();

    $title = $_GET["title"];
    $id_user = $_SESSION["usuario"]["id"];

    $myPicture = new Picture($title,null,null,$id_user);
    $myPicture->deletePicture();
    
?>