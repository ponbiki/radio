<?php
require 'functions.php';
session_start();

if (isset($_SESSION['user'])) {
    $djname = $_SESSION['user'];
    $loggedin = TRUE;
} else $loggedin = FALSE;

if (isset($_SESSION['admin'])) {
    $admin = TRUE;
} else {
    $admin = FALSE;
}

function htmlheader($title, $meta, $scripts = array()) {
    echo <<<END
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">

        <title>$title</title>

        <meta name="robots" content="7chanradio, 7chan, Radio, $meta" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

END;

    foreach ($scripts as $x) {
        echo "$x\n\n";
    }

echo <<<_END
       <link rel="stylesheet" href="css/burichan.css" type="text/css" />\n

    </head>

    <body>

_END;
}

function bar($page) {

    echo <<<_END

        <div class="replymode">
            <h2>$page</h2>
        </div>

_END;
}

if ($loggedin)
    $navigation = "<div class='navbar'>
                [<a href='index.php' title='7chan Radio'>7chan Radio</a> / <a href='schedule.php' title='Schedule'>Schedule</a> / <a href='djs.php' title='DJ Lineup'>DJ Lineup</a>]
                [<a href='https://7chan.org/ch7/' title='Channel 7'>ch7</a> / <a href='https://7chan.org' title='7chan'>7chan</a>]
                [<a href='djpanel.php' title='DJ Panel'>DJ Panel</a> / <a href='logout.php' title='Logout'>Logout</a>]
                </div>\n";
    else
        $navigation = "<div class='navbar'>
            [<a href='index.php' title='7chan Radio'>7chan Radio</a> / <a href='schedule.php' title='Schedule'>Schedule</a> / <a href='djs.php' title='DJ Lineup'>DJ Lineup</a>]
            [<a href='https://7chan.org/ch7/' title='Channel 7'>ch7</a> / <a href='https://7chan.org' title='7chan'>7chan</a>]
            [<a href='login.php' title='DJ Panel'>DJ Panel</a>]
            </div>\n";

$logo = "<div class='logo'><h1 title='7chan Radio'>7chan Radio</h1></div>\n";
?>
