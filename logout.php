<?php
require 'header.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">

        <title>Log out</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />
    </head>
    <body>
        <?php echo $navigation; echo $logo; ?>

<?php
echo "<div class='replymode'><h2>Log out</h2></div>";

if (isset($_SESSION['user'])) {
    destroySession();
    header("Location: index.php");
} else {
    echo "Bitch, you are not logged in!<br />";
    echo "Just go back to <a href='index.php' title='7chan Radio'>the beginning</a>";
}
?>
    </body>
</html>