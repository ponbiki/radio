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
        
        $salt1 = "qm&h*";
        $salt2 = "pg!@";

        echo "<h3>DJ Log In</h3>";
        $error = $user = '';
        
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
                    die(header("Location: index.php"));
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
