<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Change Password</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

    </head>
    <body>
        <?php echo $navigation; echo $logo; ?>

        <?php
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
                $query = "UPDATE djs SET password='$token' WHERE username='$user'";
                queryMysql($query);
                die("<h4>Password for $user changed</h4><br />Return to <a href='djpanel.php' title='DJ Panel'>DJ Panel</a>");
                }
        }
        ?>

        <div class="replymode">
            <h2>Change Password</h2>
        </div>
        <p><span id="welcome">Welcome, <?php echo $user; ?>.</span></p>
        <p>Please input your new password twice</p>
        <form method='post' action='changepwd.php'><?php echo $error; ?>
            New Password &nbsp; &nbsp; &nbsp;<input type='password' maxlength='24' name='pass1' value="<?php $pass1; ?>" /><br />
            Confirm Password <input type='password' maxlength='24' name='pass2' value="<?php $pass2; ?>" /><br />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type='submit' value='Change' />
        </form>
    </body>
</html>