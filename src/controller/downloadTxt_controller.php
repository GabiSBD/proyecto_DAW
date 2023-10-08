<?php
    require("../model/Class_text.php");

    if(isset($_SESSION["usuario"])){

        $title = $_GET["txtTitle"];
        $id = $_SESSION["usuario"]["id"];
        $extension =".odt";

        $myTxt = new Text($title,null,$id);

        $path= "../assets/".$id.$extension; 
        $file = fopen($path, "w");

        //escribimos en el fichero el texto recuperado de la BBDD y aseguramos que su codificación sea utf-8

        fwrite($file,mb_convert_encoding($myTxt->getFile(), "UTF-8"));

        fclose($file);

    }else{
        $title = $_GET["txtTitle"];
        $text = $_GET["text"];
        $extension =".odt";
        $uid=1;
        $path="../assets/".$uid.$title.$extension;

        while(file_exists($path)){
            $uid+=1;
            $path="../assets/".$uid.$title.$extension; 
        }
        
        $file = fopen($path, "w");

        //escribimos en el fichero el texto recuperado de la BBDD y aseguramos que su codificación sea utf-8

        fwrite($file,mb_convert_encoding($text, "UTF-8"));

        fclose($file);

        setcookie("uid",$uid,time()+6000,'/downloadPage.php');
    }

    

?>