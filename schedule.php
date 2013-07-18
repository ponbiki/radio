<?php
require 'header.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Schedule</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />
    </head>
    <body>
        <div class="navbar">
            [<a href="index.php" title="7chan Radio">7chan Radio</a> / <a href="schedule.php" title="Schedule">Schedule</a>]
            [<a href="https://7chan.org/ch7/" title="Channel 7">ch7</a> / <a href="https://7chan.org" title="7chan">7chan</a>]
            [<a href=<?php if (!$loggedin)
                echo "'login.php' title='Login'>DJ Panel";
                else echo "'djpanel.php' title='DJ Panel'>DJ Panel</a> / <a href='logout.php' title='Logout'>Logout"; ?></a>]
        </div>
        <div class="logo">
            <h1 title="7chan Radio">7chan Radio</h1>
        </div>


        <div class="replymode">
            <h2>Schedule</h2>
        </div>
        <p>In progress</p>
    </body>
</html>
