<?php
    require("../model/Class_text.php");

    session_start();

    $title = $_GET["txtTitle"];
    $id = $_SESSION["usuario"]["id"];
    $extension =".odt";

    $myTxt = new Text($title,null,$id);

    $path= "../assets/".$id.$extension; 
    $file = fopen($path, "w");

    

    fwrite($file,mb_convert_encoding($myTxt->getFile(), "UTF-8"));

    fclose($file);


?>