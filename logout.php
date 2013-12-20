<?php
require 'header.php';

$page = "Log Out";

htmlheader($page, $page, array());

echo $navigation; echo $logo;

bar($page);

if (isset($_SESSION['user'])) {
    destroySession();
    header("Location: index.php");
} else {
    echo "Bitch, you are not logged in!<br />";
    echo "Just go back to <a href='index.php' title='7chan Radio'>the beginning</a>";
}

tail();
?>
