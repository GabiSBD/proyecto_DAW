<?php
session_start();

    if(isset($_SESSION["usuario"])) {
        require("../model/Class_picture.php");
        Picture::getPictures($_SESSION["usuario"]["id"]);
        }
?>