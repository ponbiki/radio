<?php
$dbhost = 'localhost';
$dbname = 'radio';
$dbuser = 'radio';
$dbpass = 'password';

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

function sanitzeString($var) {
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}
?>
