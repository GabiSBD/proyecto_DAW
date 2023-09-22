<?php
    session_start();

    $formats = [".jpeg", ".jpg" , ".pjpeg", ".gif", ".png", ".odt"];

   if(isset($_SESSION["usuario"])){
        $id = $_SESSION["usuario"]["id"];

        for($i=0; $i<count($formats); $i++){
            
            $url = "../assets/".$id.$formats[$i];

            if(file_exists($url)) unlink($url);
            
        }

    }
    else{

        $uid = $_COOKIE["uid"];

        for($i=0; $i<count($formats); $i++){
            
            $url = "../assets/".$uid."GuestDoc".$formats[$i];

            if(file_exists($url)) unlink($url);
            
        }
        setcookie("uid","",time()-1);
    }


?>