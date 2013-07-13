<?php
require_once 'functions.php';
session_start();

if (isset($_SESSION['dj'])) {
    $dj = $_SESSION['dj'];
    $loggedin = TRUE;
} else $loggedin = FALSE;

if ($loggedin)
    $welcome = "$dj logged in";
    else
        $welcome = '';
    
return $welcome;
?>
