<?php
include 'header.php';
global $djname;
if (!$loggedin) header("Location: schedule.php");

$page = "Add Set";

htmlheader($page, $page, array());

?>
    <p class="utc">
        All scheduled times are GMT/UTC<br />
        Your current local time and offset is:<br />
        <script>
            var date = new Date();
            document.write(date);
        </script>
    </p>
<h1>Add Sets</h1>
<?php
if ($_POST['submit']) {
        $safe_m = sanitizeString($_POST['m']);
        $safe_d = sanitizeString($_POST['d']);
        $safe_y = sanitizeString($_POST['y']);
        $safe_event_title = sanitizeString($_POST['event_title']);
        $safe_event_shortdesc = sanitizeString($_POST['event_shortdesc']);
        $safe_event_time_hh = sanitizeString($_POST['event_time_hh']);
        $safe_event_time_mm = sanitizeString($_POST['event_time_mm']);
        $safe_end_time_hh = sanitizeString($_POST['end_time_hh']);
        $safe_end_time_mm = sanitizeString($_POST['end_time_mm']);

        $event_date = $safe_y."-".$safe_m."-".$safe_d." ".$safe_event_time_hh.":".$safe_event_time_mm.":00";
        $event_end = $safe_y."-".$safe_m."-".$safe_d." ".$safe_end_time_hh.":".$safe_end_time_mm.":00";

        $query1 = "INSERT INTO calendar_events (event_title, event_shortdesc, event_start, event_end) VALUES('".$safe_event_title."', '".$safe_event_shortdesc."', '".$event_date."', '".$event_end."')";
        $insEvent_res = queryMysql($query1);

} else {
        $safe_m = sanitizeString($_GET['m']);
        $safe_d = sanitizeString($_GET['d']);
        $safe_y = sanitizeString($_GET['y']);
}
$query2 = "SELECT id, event_title, event_shortdesc, date_format(event_start, '%l:%i %p')
    as fmt_date, date_format(event_end, '%l:%i %p') as emt_date FROM calendar_events WHERE month(event_start) = '".$safe_m."'
    AND dayofmonth(event_start) = '".$safe_d."' AND year(event_start) = '".$safe_y."' ORDER BY event_start";
$getEvent_res = queryMysql($query2);

if (mysql_num_rows($getEvent_res) > 0) {
        $event_txt = "<ul style='list-style-type: none;'>";
        while ($ev = @mysql_fetch_array($getEvent_res)) {
                $event_title = stripslashes($ev['event_title']);
                $event_shortdesc = stripslashes($ev['event_shortdesc']);
                $fmt_date = $ev['fmt_date'];
                $emt_date = $ev['emt_date'];
                $id = $ev['id'];

                $event_txt .= "<li><strong>".$fmt_date."</strong> to <strong>". $emt_date ."</strong>: ".$event_title." - ".$event_shortdesc."</li>";
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

// show form for adding an event
echo <<<END_OF_TEXT
<form name="event" method="post" action="$_SERVER[PHP_SELF]">
<p><strong>Would you like to add a set?</strong><br/>
Complete the form below and press the submit button to add the set and refresh this window.</p>

<p><label for="event_title">DJ: $djname</label><br/>
<input type="hidden" id="event_title" name="event_title" size="25" maxlength="25" value="$djname" /></p>

<p><label for="event_shortdesc">Set Description:</label><br/>
<input type="text" id="event_shortdesc" name="event_shortdesc" size="35" maxlength="255" /></p>

<fieldset>
<legend>Start Time (hh:mm):</legend>
<select name="event_time_hh">
END_OF_TEXT;

for ($x=1; $x <= 24; $x++) {
        echo "<option value=\"$x\">$x</option>";
}

echo <<<END_OF_TEXT
</select> :
<select name="event_time_mm">
<option value="00">00</option>
<option value="15">15</option>
<option value="30">30</option>
<option value="45">45</option>
</select>
</fieldset>
<fieldset>
<legend>End Time (hh:mm):</legend>
<select name="end_time_hh">
END_OF_TEXT;

for ($x=1; $x <= 24; $x++) {
        echo "<option value=\"$x\">$x</option>";
}

echo <<<END_OF_TEXT
</select> :
<select name="end_time_mm">
<option value="00">00</option>
<option value="15">15</option>
<option value="30">30</option>
<option value="45">45</option>
</select>
</fieldset>
<input type="hidden" name="m" value="$safe_m">
<input type="hidden" name="d" value="$safe_d">
<input type="hidden" name="y" value="$safe_y">

<button type="submit" name="submit" value="submit">Add Set</button>
</form>
END_OF_TEXT;
tail();
?>