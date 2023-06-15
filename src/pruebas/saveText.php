<?php
    include("../php/Class_text.php");

    $title = $_POST["title"];
    $text = $_POST["text"];
    $id_user =1;
    
    $my_text = new Text($title, $text, $id_user);

    
    $my_text->saveText();
?>