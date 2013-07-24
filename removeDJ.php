<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");

if (!$admin) header("Location: djpanel.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Remove DJ</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

    </head>
    <body>
        <?php echo $navigation; echo $logo; ?>
        
        <?php
        $error = $user = $pass = "";

        $query1 = "SELECT * FROM djs";
        $result1 = queryMysql($query1);

        if (isset($_POST['user'])) {
        $user = sanitizeString($_POST['user']);

        if (!isset($_POST['confirm'])) {
            $error = "Please check and confirm your selection before deleting<br />";
        } else {
                $query2 = "DELETE FROM djs WHERE username='$user'";
                queryMysql($query2);
                die("<h4>$user has been removed</h4><br /><br />Return to <a href='djpanel.php' title='DJ Panel'>DJ Panel</a>");
            }
        }

        ?>
        <div class="replymode">
            <h2>Remove DJ</h2>
        </div>
        <form method='post' action='removeDJ.php'><?php echo $error; ?>
            DJ &nbsp; &nbsp;<select name='user' size='1'>
                <?php while($row = mysql_fetch_array($result1)) {
                    echo "<option value='" . $row[username] . "'>" . $row[username] . "</option>";
                } ?>
            </select><br />
            <label>Confirm Selection &nbsp; &nbsp; &nbsp; <input type="checkbox" name="confirm"></label><br /><br />
            &nbsp; &nbsp; &nbsp; &nbsp;
            <input type='submit' value='Remove' />
        </form>
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
    </body>
</html>