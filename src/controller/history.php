<?php
session_start();
require("../model/Class_text.php");
Text::getTitles($_SESSION["usuario"]["id"]);
?>