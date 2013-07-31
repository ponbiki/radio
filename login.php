<?php
require 'header.php';

if ($loggedin) header("Location: djpanel.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">

        <title>Log In</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />
    </head>
    <body>
        <?php echo $navigation; echo $logo; ?>

        <?php
        $salt1 = "qm&h*";
        $salt2 = "pg!@";

        echo "<div class='replymode'><h2>DJ Log In</h2></div>";
        $error = $user = $pass = '';

        if (isset($_POST['user'])) {
            $user = sanitizeString($_POST['user']);
            $pass = sanitizeString($_POST['pass']);

            if ($user == "" || $pass == "") {
                $error = "Not all fields were entered<br />";
            } else {
                $token = md5("$salt1$pass$salt2");
                $query = "SELECT username,password FROM djs
                    WHERE username='$user' AND password='$token'";

                if (mysql_num_rows(queryMysql($query)) == 0) {
                    $error = "Username/Password invalid<br />";
                } else {
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $token;
                    $query2 = "SELECT admin FROM djs WHERE username='$user'";
                    $sql = queryMysql($query2);
                    $isadmin = mysql_fetch_row($sql);
                    if ($isadmin[0] == "Y")
                        $_SESSION['admin'] = $admin;
                    die(header("Location: djpanel.php"));
                }
            }
        }
?>
        <form method='post' action='login.php'><?php echo $error ?>
            <table style="float: left;">
                <tr>
                    <td style="text-align: left;">Username</td><td style="text-align: right;"><input type='text' maxlength='24' name='user' value="<?php echo $user ?>" /></td>
                </tr><tr>
                    <td style="text-align: left;">Password</td><td style="text-align: right;"><input type='password' maxlength='24' name='pass' value="<?php echo $pass ?>" /></td>
                </tr><tr>
                    <td></td><td style="text-align: right;"><input type="submit" value="Login" /></td>
            </tr>
            </table>
        </form>

    </body>
</html>
