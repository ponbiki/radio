<?php
$dbhost = 'localhost';
$dbname = 'radio';
$dbuser = 'radio';
$dbpass = 'password';

mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

function queryMysql($query) {
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}

function destroySession() {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy;
}

function sanitizeString($var) {
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}

function showProfile($djname) {
    if (file_exists("djpics/$djname.jpg"))
        echo "<img src='djpics/$djname.jpg' border='1' align='left' />";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$djname'");
    if (mysql_num_rows($result)) {
        $row = mysql_fetch_row($result);
        echo stripslashes($row[1]) . "<br clear=left /><br />";
    }
}
?>
