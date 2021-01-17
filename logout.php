<?php
session_start();
unset($_SESSION["name"]);
unset($_SESSION["password"]);
unset($_SESSION["admin"]);
header("Location: /index.php");
?>