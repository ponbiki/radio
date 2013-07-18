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
        <div class="navbar">
            [<a href="index.php" title="7chan Radio">7chan Radio</a> / <a href="schedule.php" title="Schedule">Schedule</a>]
            [<a href="https://7chan.org/ch7/" title="Channel 7">ch7</a> / <a href="https://7chan.org" title="7chan">7chan</a>]
            [<a href='djpanel.php' title='DJ Panel'>DJ Panel</a> / <a href='logout.php' title='Logout'>Logout</a>]
        </div>
        <div class="logo">
            <h1 title="7chan Radio">7chan Radio</h1>
        </div>
        
        <?php
        $error = $pass2 = $pass1 = "";
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        
        if (isset($_POST[pass1])) {
            $pass1 = sanitizeString($_POST['pass1']);
            $pass2 = sanitizeString($_POST['pass2']);
            $token = md5("$salt1$pass1$salt2");
            
            if (($pass1 == "" || $pass2 == "") || ($pass1 != $pass2))
                $error = "Not all fields were entered, or the password do not match.  Please try again.";
            } else {
            $query = "UPDATE djs SET password='$token' WHERE username='$user'";
            queryMysql($query);
            die("<h4>Password for $user changed</h4>");
            }
        ?>

        <div class="replymode">
            
            <h2>Change Password</h2>
        </div>
        <p><span id="welcome">Welcome, <?php echo $user; ?>.</span></p>
        <p>Please input your new password twice</p>
        <form method='post' action='changepwd.php'><?php $error ?>
            Password <input type='password' maxlength='24' name='pass1' value="<?php echo $pass1; ?>"
                            onBLur='checkUser(this)'/><span id='info'></span><br />
            Password <input type='password' maxlength='24' name='pass2' value="<?php echo $pass2; ?>" /><br />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type='submit' value='Change' />
        </form>
    </body>
</html>