<?php
require 'header.php';

$page = "Change Password";

if (!$loggedin) header("Location: index.php");

htmlheader($page, $page, array());

echo $navigation; echo $logo;

        $error = $pass2 = $pass1 = "";
        $salt1 = "qm&h*";
        $salt2 = "pg!@";

        if (isset($_POST['pass1'])) {
            $pass1 = sanitizeString($_POST['pass1']);
            $pass2 = sanitizeString($_POST['pass2']);
            $token = md5("$salt1$pass1$salt2");

            if (($pass1 == "" || $pass2 == "") || ($pass1 != $pass2)) {
                $error = "Not all fields were entered, or the password do not match.  Please try again.<br /><br />";
            } else {
                $query = "UPDATE djs SET password='$token' WHERE username='$djname'";
                queryMysql($query);
                die("<h4>Password for $djname changed</h4><br />Return to <a href='djpanel.php' title='DJ Panel'>DJ Panel</a>");
                }
        }

        bar($page);

?>
        <p><span id="welcome">Welcome, <?php echo $djname; ?>.</span></p>
        <p>Please input your new password twice</p>
        <form method='post' action='changepwd.php'><?php echo $error; ?>
            <table style="float: left;">
                <tr>
                    <td style="text-align: left;">New Password</td><td style="text-align: right;"><input type='password' maxlength='24' name='pass1' value="<?php $pass1; ?>" /></td>
            </tr><tr>
                    <td style="text-align: left;">Confirm Password</td><td style="text-align: right;"><input type='password' maxlength='24' name='pass2' value="<?php $pass2; ?>" /></td>
                </tr><tr>
                    <td></td><td style="text-align: right;"><input type='submit' value='Change' /></td>
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
<?php tail(); ?>