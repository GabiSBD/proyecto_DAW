<?php
    require("../model/Class_User.php");

    $id = $_POST["id"];

    User::setIsAdmin($id)?User::adminTable() : die();

    
?>