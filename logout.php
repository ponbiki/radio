<?php
require 'header.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Log out</title>
        
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
        
<?php
echo "<div class='replymode'><h2>Log out</h2></div>";

if (isset($_SESSION['user'])) {
    destroySession();
    header("Location: index.php");
} else {
    echo "Bitch, you are not logged in!<br />";
    echo "Just go back to <a href='index.php' title='7chan Radio'>the beginning</a>";
}
?>
    </body>
</html>