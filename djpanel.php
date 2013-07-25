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

        <?php echo $navigation; echo $logo; ?>

        <div class="replymode">
            <h2>DJ Panel</h2>
        </div>
        <p><span id="welcome">Welcome, <?php echo $user; ?>.</span></p>
        <div class="dj">
            <ul>
                <?php if ($admin)
                    echo "<li><a href='adddj.php' title='Add DJ'>Add New DJ</a></li>
                        <li><a href='removedj.php' title='Remove DJ'>Remove DJ</a></li>"; ?>
                    <li><a href='changepwd.php' title='Change Password'>Change Password</a></li>
                    <li><a href='djprofile.php' title='DJ Profile'>DJ Profile</a></li>
            </ul>
        </div>
        <table>
            <tr><th>DJs</th></tr>
            <?php
            $query = "SELECT * FROM djs";
            $result = mysql_query($query);
            $rows = mysql_num_rows($result);

            for ($j = 0; $j < $rows; ++$j) {
                if (mysql_result($result,$j,'admin') == "Y") {
                    echo "<tr><td><span style='color:#AF0A0F;'>" . mysql_result($result,$j,'username') . "</span></td></tr>";
                } else {
                    echo "<tr><td>" . mysql_result($result,$j,'username') . "</td></tr>";
                }
            }
            ?>
        </table>
</html>