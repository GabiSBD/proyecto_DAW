<?php
    include("../model/Class_text.php");
    session_start();
    
    $id_user = $_SESSION["usuario"]["id"];
    $title = $_POST["title"];

    $text = new Text($title, "", $id_user);
    $text->deleteText();
    ?>