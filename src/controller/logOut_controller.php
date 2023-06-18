<?php
    session_start();
    $_SESSION["usuario"]=null;
    session_destroy();
    header("location:".$_SERVER['HTTP_REFERER']);
?>