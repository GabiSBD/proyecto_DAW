<?php
include("../model/Class_User.php");

session_start();
$name = $_SESSION["usuario"]["name"];



$user = new User($name, null);

$user->deleteUser();



?>