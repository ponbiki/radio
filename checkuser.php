<?php
require 'functions.php';

if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $query = "SELECT * FROM radio WHERE username='$user'";
    
    if (mysql_num_rows(queryMysql($query)))
        echo "<font color=red>&nbsp;&larr;
            This username is already taken</font>";
    else echo "<font color=green>&nbsp;&larr;
        Username available</font>";
}
?>