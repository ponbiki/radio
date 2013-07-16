<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add DJ</title>
        
        <meta name="robots" content="noindex, nofollow" />
        
        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
        
        <link rel="stylesheet" href="css/burichan.css" type="text/css" />
        
        <script src="yahoo-min.js"></script>
        <script src="event-min.js"></script>
        <script src="connection-min.js"></script>
        
        <script>
            function checkUser(user) {
                if (user.value == '') {
                    document.getElementById('info').innerHTML = ''
                    return
                }
                
                params = "user=" + user.value
                callback = { success:successHandler, failure:failureHandler }
                request = YAHOO.util.Connect.asyncRequest('POST', 
                    'checkuser.php', callback, params);
            }
            
            function successHandler(o) {
                document.getElementById('info').innerHTML = o.responseText;
            }
            
            function failureHandler(o) {
                document.getElementById('info').innerHTML =
                    o.status + " " + o.statusText;
            }
        </script>
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
        $error = $user = $pass = "";
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        
        if (isset($_POST['user'])) {
            $user = sanitizeString($_POST['user']);
            $pass = sanitizeString($_POST['pass']);
            $token = md5("$salt1$pass$salt2");
            
            
            if ($user == "" || $pass == "") {
                $error = "Not all fields were entered<br /><br />";
            } else {
                $query = "SELECT * FROM djs WHERE username='$user'";
                
                if (mysql_num_rows(queryMysql($query))) {
                    $error = "That username already exists<br /><br />";
                } else {
                    $query = "INSERT INTO djs VALUES('$user', '$token')";
                    queryMysql($query);
                }
                die("<h4>Account created for $user</h4>");
            }
        }
        ?>
        <div class="replymode">
            <h2>Add DJ</h2>
        </div>
        <form method='post' action='addDJ.php'><?php $error ?>
            Username <input type='text' maxlength='24' name='user' value="<? $user ?>"
                            onBLur='checkUser(this)'/><span id='info'></span><br />
            Password &nbsp;<input type='password' maxlength='24' name='pass'
                            value="<?php $pass ?>" /><br />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type='submit' value='Add DJ' />
        </form>
    </body>
</html>