<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");

if (!$admin) header("Location: djpanel.php");
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
        <?php echo $navigation; echo $logo; ?>

        <?php
        $error = $user = $pass = $admin = "";
        $salt1 = "qm&h*";
        $salt2 = "pg!@";

        if (isset($_POST['user'])) {
            $user = sanitizeString($_POST['user']);
            $pass = sanitizeString($_POST['pass']);
            $token = md5("$salt1$pass$salt2");

            if (isset($_POST['admin']))
                $admin = "Y";
                    else $admin = "N";

                if ($user == "" || $pass == "") {
                    $error = "Not all fields were entered<br /><br />";
                } else {
                    $query = "SELECT * FROM djs WHERE username='$user'";

                    if (mysql_num_rows(queryMysql($query))) {
                        $error = "That username already exists<br /><br />";
                    } else {
                        $query = "INSERT INTO djs VALUES('$user', '$token', '$admin')";
                        queryMysql($query);
                        die("<h4>Account created for $user</h4><br /><br />Return to <a href='djpanel.php' title='DJ Panel'>DJ Panel</a>");
                    }
                }
            }
        ?>
        <div class="replymode">
            <h2>Add DJ</h2>
        </div>
        <p><span id="welcome">Welcome, <?php echo $djname; ?>.</span></p>
        <form method='post' action='adddj.php'><?php echo $error; ?>
            Username <input type='text' maxlength='24' name='user' value="<?php $user; ?>"
                            onBLur='checkUser(this)'/><span id='info'></span><br />
            Password &nbsp;<input type='password' maxlength='24' name='pass'
                            value="<?php $pass; ?>" /><br />
            <label>Make Administrator &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="admin"></label><br /><br />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type='submit' value='Add DJ' />
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
