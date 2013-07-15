<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Log In</title>
        <meta name="robots" content="noindex, nofollow" />
        
        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
        
        <link rel="stylesheet" href="css/burichan.css" type="text/css" />
    </head>
    <body>
        <?php
        require 'header.php';
        ?>
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
                    die(header("Location: djpanel.php"));
                }
            }
        }
echo <<<_END
        <form method='post' action='login.php'>$error
            Username <input type='text' maxlength='24' name='user' value="$user" /><br />
            Password &nbsp;<input type='password' maxlength='24' name='pass' value="$pass" /><br />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="submit" value="Login" />
        </form>
_END;
?>
    </body>
</html>
