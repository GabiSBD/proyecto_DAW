<?php
    session_start();
    $_SESSION["usuario"]=null;
    session_destroy();
    header("location:../view/index.php");
?>