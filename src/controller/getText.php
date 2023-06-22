<?php
    include("../model/Class_text.php");

    session_start();

    $user_id = $_SESSION["usuario"]["id"];

    $title = $_POST["title"];

    $texts = new Text($title,"",$user_id);
    
    $texts->getText();
?>