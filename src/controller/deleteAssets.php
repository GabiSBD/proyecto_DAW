<?php
    session_start();
    $id = $_SESSION["usuario"]["id"];

    $formats = ["jpeg", ".jpg" , ".pjpeg", ".gif", ".png", ".odt"];

    for($i=0; $i<count($formats); $i++){
        
        $url = "../assets/".$id.$formats[$i];

        if(file_exists($url)) unlink($url);
         
    }


?>