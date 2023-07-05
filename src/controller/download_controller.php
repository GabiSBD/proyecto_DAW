<?php
    require("../model/Class_picture.php");

    session_start();
    $title = $_GET["title"];
    // $title = $_POST["title"];
    $id = $_SESSION["usuario"]["id"];

    $myPicture = new Picture($title,null,null,$id);

    $myPicture->getPicture();
?>