<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>DJ Profile</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

    </head>
    <body>
        <?php echo $navigation; echo $logo; ?>


        <div class="replymode">
            <h2>Change Password</h2>
        </div>
    </body>
