<?php
    include("Class_text.php");
    session_start();
    
    $id_user = $_SESSION["usuario"]["id"];
    $title = $_POST["title"];
    $text = $_POST["text"];
    
    
    $my_text = new Text($title, $text, $id_user);

    
    $my_text->saveText();
?>