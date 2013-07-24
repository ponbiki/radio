<?php
require 'functions.php';
session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedin = TRUE;
} else $loggedin = FALSE;

if (isset($_SESSION['admin'])) {
    $admin = TRUE;
} else {
    $admin = FALSE;
}

if ($loggedin)
    $navigation = "<div class='navbar'>
                [<a href='index.php' title='7chan Radio'>7chan Radio</a> / <a href='schedule.php' title='Schedule'>Schedule</a> / <a href='djs.php' title='DJ Lineup'>DJ Lineup</a>]
                [<a href='https://7chan.org/ch7/' title='Channel 7'>ch7</a> / <a href='https://7chan.org' title='7chan'>7chan</a>]
                [<a href='djpanel.php' title='DJ Panel'>DJ Panel</a> / <a href='logout.php' title='Logout'>Logout</a>]
                </div>";
    else
        $navigation = "<div class='navbar'>
            [<a href='index.php' title='7chan Radio'>7chan Radio</a> / <a href='schedule.php' title='Schedule'>Schedule</a> / <a href='djs.php' title='DJ Lineup'>DJ Lineup</a>]
            [<a href='https://7chan.org/ch7/' title='Channel 7'>ch7</a> / <a href='https://7chan.org' title='7chan'>7chan</a>]
            [<a href='login.php' title='DJ Panel'>DJ Panel</a>]
            </div>";

$logo = "<div class='logo'><h1 title='7chan Radio'>7chan Radio</h1></div>";
?>
