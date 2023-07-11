<?php
//controlador para borrar un usuario propio desde el menu de navegación.

include("../model/Class_User.php");

session_start();
$name = $_SESSION["usuario"]["name"];



$user = new User($name, null);

$user->deleteUser();

?>