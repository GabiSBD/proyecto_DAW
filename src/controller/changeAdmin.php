<?php
    require("../model/Class_User.php");
    
    session_start();

    $id = $_POST["id"];

    User::setIsAdmin($id)?User::adminTable() : die();

    
?>