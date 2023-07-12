<?php
    require("../model/Class_User.php");
    session_start();
    $id = $_POST["id"];
    User::dropUser($id) ? User::adminTable() : die();
    
?>