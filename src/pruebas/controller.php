<?php
    include("../php/Usuario_class.php");
    $name = $_POST["name"];
    $passwrd = $_POST["passwrd"];

    $login = new User($name, $passwrd);
    $login->getUser();






?>