<?php
include "header.php";

define("ADAY", (60*60*24));
if ((!isset($_POST['month'])) || (!isset($_POST['year']))) {
        $nowArray = getdate();
        $month = $nowArray['mon'];
        $year = $nowArray['year'];
} else {
        $month = $_POST['month'];
        $year = $_POST['year'];
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
                for ($x=2013; $x<=2025; $x++) {
                    echo "<option";
                    if ($x == $year) {
                        echo " selected";
                    }
                    echo ">$x</option>";
                }
                ?>
            </select>
            <input type="submit" value="Go">
        </form>
        <br/>
        <?php
        $days = Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
        echo "<table cellpadding='5' style='table-border: solid 1px; float: left;'><tr>\n";
        foreach ($days as $day) {
            echo "<td style='text-weight: bold; text-align: center; width: 65px; height: 50px;'>$day</td>\n";
        }
        for ($count=0; $count < (6*7); $count++) {
            $dayArray = getdate($start);
            if (($count % 7) == 0) {
                if ($dayArray['mon'] != $month) {
                    break;
                } else {
                    echo "</tr><tr>\n";
                }
            }
            if ($count < $firstDayArray['wday'] || $dayArray['mon'] != $month) {
                echo "<td>&nbsp;</td>\n";
            } else {
                $query = "SELECT event_title FROM calendar_events WHERE
                     month(event_start) = '".$month."' AND
                     dayofmonth(event_start) = '".$dayArray['mday']."'
                     AND year(event_start) = '".$year."' ORDER BY event_start";
                 $chkEvent_res = queryMysql($query);
                 if (mysql_num_rows($chkEvent_res) > 0) {
                     while ($ev = mysql_fetch_array($chkEvent_res)) {
                         $event_title .= stripslashes($ev['event_title'])."<br/>";
                     }
                 } else {
                     $event_title = "";
                 }
                 echo "<td><a href=\"javascript:eventWindow('event.php?m=".$month.
                 "&amp;d=".$dayArray['mday']."&amp;y=$year');\">".$dayArray['mday']."</a>
                 <br/><br/>".$event_title."</td>\n";
                 unset($event_title);
                 $start += ADAY;
            }
        }
        echo "</tr></table>";
        ?>
    </body>
</html>