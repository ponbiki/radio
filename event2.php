<?php
include 'header.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">

        <title>Set List</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

    </head>
<body>
<h1>Show Sets</h1>
<?php
        $safe_m = sanitizeString($_GET['m']);
        $safe_d = sanitizeString($_GET['d']);
        $safe_y = sanitizeString($_GET['y']);
$query2 = "SELECT event_title, event_shortdesc, date_format(event_start, '%l:%i %p') as fmt_date FROM calendar_events WHERE month(event_start) = '".$safe_m."' AND dayofmonth(event_start) = '".$safe_d."' AND year(event_start) = '".$safe_y."' ORDER BY event_start";
$getEvent_res = queryMysql($query2);

if (mysql_num_rows($getEvent_res) > 0) {
        $event_txt = "<ul style='list-style-type: none;'>";
        while ($ev = @mysql_fetch_array($getEvent_res)) {
                $event_title = stripslashes($ev['event_title']);
                $event_shortdesc = stripslashes($ev['event_shortdesc']);
                $fmt_date = $ev['fmt_date'];

                $event_txt .= "<li><strong>".$fmt_date."</strong>: ".$event_title." - ".$event_shortdesc."</li>";
        }
        $event_txt .= "</ul>";
        mysql_free_result($getEvent_res);
} else {
        $event_txt = "";
}

if ($event_txt != "") {
        echo "<p><strong>Today's Sets:</strong></p>
        $event_txt
        <hr/>";
}
?>
</body>
</html>