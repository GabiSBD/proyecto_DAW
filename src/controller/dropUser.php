<?php
    require("../model/Class_User.php");
    $id = $_POST["id"];
    User::dropUser($id) ? User::adminTable() : die();
    
?>