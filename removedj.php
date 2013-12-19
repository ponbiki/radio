<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");

if (!$admin) header("Location: djpanel.php");

$page = "Remove DJ";

htmlheader($page, $page, array());

echo $navigation; echo $logo;

bar($page);

        $error = $user = $pass = "";

        $query1 = "SELECT * FROM djs";
        $result1 = queryMysql($query1);

        if (isset($_POST['user'])) {
        $user = sanitizeString($_POST['user']);

        if (!isset($_POST['confirm'])) {
            $error = "Please check and confirm your selection before deleting<br />";
        } else {
                $query2 = "DELETE FROM djs WHERE username='$user'";
                $query3 = "DELETE FROM profiles WHERE user='$user'";
                queryMysql($query2);
                queryMysql($query3);
                if (!unlink("djpics/$user.jpg")) echo "Please manually delete " . $user . "'s profile picture.";
                die("<h4>$user has been removed</h4><br /><br />Return to <a href='djpanel.php' title='DJ Panel'>DJ Panel</a>");
            }
        }

        ?>

        <p><span id="welcome">Welcome, <?php echo $djname; ?>.</span></p>
        <form method='post' action='removedj.php'><?php echo $error; ?>
            <table style="float: left;">
                <tr>
                    <td style="text-align: left;">DJ</td><td style="text-align: right;"><select name='user' size='1'>
                        <?php while($row = mysql_fetch_array($result1)) {
                            echo "<option value='" . $row[username] . "'>" . $row[username] . "</option>";
                        } ?>
                    </select></td>
                </tr><tr>
                    <td style="text-align: left;">Confirm Selection</td><td style="text-align: right;"><input type="checkbox" name="confirm"></td>
                </tr><tr>
                    <td></td><td style="text-align: right;"><input type='submit' value='Remove' /></td>
                </tr>
            </table>
        </form>
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
    </body>
</html>
