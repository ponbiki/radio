<?php
include "header.php";

$page = "Schedule";

htmlheader($page, $page, array(
    "<script type=\"text/javascript\">
            function eventWindow(url) {
                event_popupWin = window.open(url, 'event',
                    'resizable=yes,scrollbar=yes,toolbar=no,width=400,height=900');
                event_popupWin.opener = self;
            }
        </script>"));

echo $navigation; echo $logo;

bar($page);

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
        <p class="utc">
            All scheduled times are GMT/UTC.&nbsp;&nbsp;Your current local time and offset is:<br />
            <script>
                var date = new Date();
                document.write(date);
            </script>
        </p>
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
        echo "<table cellpadding='5' style='border: 1px solid #C5C8D2; float: left;'><tr>\n";
        foreach ($days as $day) {
            echo "<td cellpadding='5' style='text-weight: bold; border: 1px dotted #C5C8D2; text-align: center; vertical-align: center; width: 85px; height: 60px;'>$day</td>\n";
        }
        for ($count=0; $count < (6*7); $count++) {
            $dayArray = getdate($start);
            if (($count % 7) == 0) {
                if ($dayArray['mon'] != $month) {
                    break;
                } else {
                    echo "</tr><tr style='border: 1px dotted #C5C8D2;'>\n";
                }
            }
            if ($count < $firstDayArray['wday'] || $dayArray['mon'] != $month) {
                echo "<td style='border: 1px dotted #C5C8D2; vertical-align: top;'>&nbsp;</td>\n";
            } else {
                $query = "SELECT event_title FROM calendar_events WHERE
                     month(event_start) = '".$month."' AND
                     dayofmonth(event_start) = '".$dayArray['mday']."'
                     AND year(event_start) = '".$year."' ORDER BY event_start";
                 $chkEvent_res = queryMysql($query);
                 if (mysql_num_rows($chkEvent_res) > 0) {
                     while ($ev = mysql_fetch_array($chkEvent_res)) {
                         $event_title .= sanitizeString($ev['event_title'])."<br/>";
                     }
                 } else {
                     $event_title = "";
                 }
                 if ($loggedin) {
                     echo "<td style='border: 1px dotted #C5C8D2; vertical-align: top;'><a href=\"javascript:eventWindow('event.php?m=".$month.
                     "&amp;d=".$dayArray['mday']."&amp;y=$year');\">".$dayArray['mday']."</a>
                     <br/><br/>".$event_title."</td>\n";
                     unset($event_title);
                     $start += ADAY;
                 } else {
                     echo "<td style='border: 1px dotted #C5C8D2; vertical-align: top;'><a href=\"javascript:eventWindow('event2.php?m=".$month.
                     "&amp;d=".$dayArray['mday']."&amp;y=$year');\">".$dayArray['mday']."</a>
                     <br/><br/>".$event_title."</td>\n";
                     unset($event_title);
                     $start += ADAY;
                 }
            }
        }
        echo "</tr></table>";
        ?>
    </body>
</html>
