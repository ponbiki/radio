<?php
require 'header.php';

require 'codec.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">

        <title>7chan Radio</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

        <script type="text/javascript">// <![CDATA[
            $(document).ready(function() {
                $.ajaxSetup({cache: false}); // This part addresses an IE bug. without it, IE will only load the first number and will never refresh
                setInterval(function() {
                    $('#announcer').load('announce.php');
                }, 3000); // the "3000" here refers to the time to refresh the div. it is in milliseconds.
            });
            // ]]>
        </script>

    </head>
    <body>

        <?php echo $navigation; echo $logo; ?>

        <div class="pic">

            <img src="img/anime_girl_dj.jpg" alt="Weeaboo DJ" title="Weeaboo DJ" width="330" height="248" />

        </div>
        
            <?php
            $nowArray = getdate();
            $month = $nowArray['mon'];
            $monthText = $nowArray['month'];
            $year = $nowArray['year'];
            $day = $nowArray['mday'];
            echo $day ." ". $monthText ." ". $year;
            
            $query = "SELECT event_title FROM calendar_events WHERE month(event_start) ='".$month."' AND
                dayofmonth(event_start) ='".$day."' AND year(event_start) = '".$year."' ORDER BY event_start";
            $chkEvent_res = queryMysql($query);
            if (mysql_num_rows($chkEvent_res) > 0) {
                while ($ev = mysql_fetch_array($chkEvent_res)) {
                    $event_title .= stripslashes($ev['event_title'])."<br/>";
                }
            } else {
                $event_title = "";
            }
            echo $event_title;
            ?>

        <div class="replymode">
            <h2>Now Playing</h2>
        </div>
        <div id="playing">
            <div id="player">
                <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="191" height="46" bgcolor="#EEF2FF">
                <param name="movie" value="muses.swf" />
                <param name="flashvars" value="url=http://radio.7chan.org:8000/radio&lang=auto&codec=<?php echo "$codec" ?>&volume=100&introurl=&tracking=true&jsevents=true&skin=compact/ffmp3-compact.xml&title=7chan%20Radio&welcome=Get%20krunk" />
                <param name="wmode" value="window" />
                <param name="allowscriptaccess" value="always" />
                <param name="bgcolor" value="#EEF2FF" />
                <param name="scale" value="noscale" />
                <embed src="muses.swf" flashvars="url=http://radio.7chan.org:8000/radio&lang=auto&codec=<?php echo "$codec" ?>&volume=100&introurl=&tracking=true&jsevents=true&skin=compact/ffmp3-compact.xml&title=7chan%20Radio&welcome=Get%20krunk" width="191" scale="noscale" height="46" wmode="window" bgcolor="#EEF2FF" allowscriptaccess="always" type="application/x-shockwave-flash" />
                </object>
            </div>
            <div id="announcer" >
            </div>
        </div>
    </body>
</html>
