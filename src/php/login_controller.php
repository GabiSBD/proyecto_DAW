<?php
    include("Usuario_class.php");
    $name = $_POST["username"];
    $passwrd = $_POST["password"];
    $login = new User($name, $passwrd);

    if(isset($_POST["new_user"])) $login->setUser();
    else $login->getUser();
    

?>