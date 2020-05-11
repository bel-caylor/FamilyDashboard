<?php require_once('../private/initialize.php');

session_destroy();

header("Location: " . WWW_ROOT . "/login.php");

?>
