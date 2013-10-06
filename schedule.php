<?php
include "header.php";

define("ADAY", (60*60*24));
if((!isset($_POST["month"])) || (!isse($_POST["year"]))) {
    $nowArray = getdate();
    $month = $nowArray["mon"];
    $year = $nowArray["year"];
} else {
    $month = $_POST["month"];
    $year = $_POST["year"];
}
$start = mktime (12, 0, 0, $month, 1, $year);
$firstDayArray = getdate($start);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">

        <title>Schedule</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

        <script type="text/javascript">
            function eventWindow(url) {
                event_popupWin = window.open(url, 'event',
                    'resizable=yes,scrollbar=yes,toolbar=no,width=400,h$chkEventeight=400');
                event_popupWin.opener = self;
            }
        </script>
    </head>
    <body>
        <?php echo $navigation; echo $logo; ?>

        <div class="replymode">
            <h2>Schedule</h2>
        </div>
        <form method="post" action="schedule.php">
            <select name="month">
                <?php
                $months = Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                for ($x = 1; $x <= count($months); $x++) {
                    echo "<option value='$x'";
                    if ($x == $month) {
                        echo " selected";
                    }
                    echo ">" .$months[$x-1]. "</option>";
                }
                ?>
            </select>
            <select name="year">
                <?php
                
                ?>
            </select>
        </form>