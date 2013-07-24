<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");

?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>DJ Panel</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

    </head>
    <body>
        <div class="navbar">
            [<a href="index.php" title="7chan Radio">7chan Radio</a> / <a href="schedule.php" title="Schedule">Schedule</a>]
            [<a href="https://7chan.org/ch7/" title="Channel 7">ch7</a> / <a href="https://7chan.org" title="7chan">7chan</a>]
            [<a href='djpanel.php' title='DJ Panel'>DJ Panel</a> / <a href='logout.php' title='Logout'>Logout</a>]
        </div>
        <div class="logo">
            <h1 title="7chan Radio">7chan Radio</h1>
        </div>
        <div class="replymode">
            <h2>DJ Panel</h2>
        </div>
        <p><span id="welcome">Welcome, <?php echo $user; ?>.</span></p>
        <div class="dj">
            <ul>
                <?php if ($admin)
                    echo "<li><a href='addDJ.php' title='Add DJ'>Add New DJ</a></li>
                        <li><a href='removeDJ.php' title='Remove DJ'>Remove DJ</a></li>"; ?>
                    <li><a href='changepwd.php' title='Change Password'>Change Password</a></li>
            </ul>
        </div>
        <table>
            <tr><th>DJs</th></tr>
            <?php
            $query = "SELECT * FROM djs";
            $result = mysql_query($query);
            $rows = mysql_num_rows($result);

            for ($j = 0; $j < $rows; ++$j) {
                echo "<tr><td>" . mysql_result($result,$j,'username') . "</td></tr>";
            }
            ?>
        </table>
</html>