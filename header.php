<?php
require 'functions.php';
session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedin = TRUE;
} else $loggedin = FALSE;

?>
