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
        require_once 'header.php';
        
        echo "<h3>DJ Log In</h3>";
        $error = $user = $pass = '';
        
        if (isset($_POST['user'])) {
            $user = sanitizeString($_POST['user']);
            $pass = sanitizeString($_POST['pass']);
            
            if ($user == "" || $pass == "") {
                $error = "Not all fields were entered<br />";
            } else {
                $query = "SELECT username,password FROM djs
                    WHERE username='$user' AND password='$pass'";
                
                if (mysql_num_rows(queryMysql($query)) == 0) {
                    $error = "Username/Password invalid<br />";
                } else {
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    die("Righteous");
                }
            }
        }
        ?>
        <form method='post' action='login.php'><?php $error ?>
            Username <input type='text' maxlength='24' name='user' value="<?php $user ?>" /><br />
            Password &nbsp;<input type='password' maxlength='24' name='pass' value="<?php $pass ?>" /><br />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="submit" value="Login" />
        </form>
    </body>
</html>
