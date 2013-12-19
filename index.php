<?php
require 'header.php';

require 'codec.php';

$page = "7chan Radio";

htmlheader($page, $page, array(
    "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\"></script>",
    "<script type=\"text/javascript\">// <![CDATA[
            $(document).ready(function() {
                $.ajaxSetup({cache: false});
                setInterval(function() {
                    $('#announcer').load('announce.php');
                }, 3000);
            });
            // ]]>
        </script>",
    "<script type=\"text/javascript\">
            function eventWindow(url) {
                event_popupWin = window.open(url, 'popout.php',
                    'resizable=no,scrollbar=no,toolbar=no,width=210,height=35');
                event_popupWin.opener = self;
                setTimeout(\"document.location.reload()\",750);
            }
        </script>"));

echo $navigation; echo $logo;
?>

        <div class="pic">

            <img src="img/anime_girl_dj.jpg" alt="Weeaboo DJ" title="Weeaboo DJ" width="330" height="248" />

        </div>
        <div class="daily">
            <p class="utc">
                All scheduled times are GMT/UTC<br />
                Your current local time and offset is:<br />
                <script>
                    var date = new Date();
                    document.write(date);
                </script>
            </p>
            <?php
            $nowArray = getdate();
            $month = $nowArray['mon'];
            $monthText = $nowArray['month'];
            $year = $nowArray['year'];
            $day = $nowArray['mday'];
            echo "<h2>". $day ." ". $monthText ." ". $year ."</h2>";

            $query = "SELECT event_title, event_shortdesc, date_format(event_start, '%l:%i %p') as fmt_date, date_format(event_end, '%l:%i %p') as emt_date FROM calendar_events
                WHERE month(event_start) ='".$month."' AND dayofmonth(event_start) ='".$day."' AND year(event_start) = '".$year."'
                ORDER BY event_start";
            $chkEvent_res = queryMysql($query);
            if (mysql_num_rows($chkEvent_res) > 0) {
                $event_txt = "<ul>";
                while ($ev = mysql_fetch_array($chkEvent_res)) {
                    $event_title = stripslashes($ev['event_title']);
                    $event_shortdesc = stripslashes($ev['event_shortdesc']);
                    $fmt_date = $ev['fmt_date'];
                    $emt_date = $ev['emt_date'];
                    $event_txt .="<li><strong>". $fmt_date ."</strong> to <strong>". $emt_date ."</strong>: ". $event_title ."<br />".
                            $event_shortdesc ."</li>";
                }
                $event_txt .= "</ul>";
                mysql_free_result($chkEvent_res);
            } else {
                $event_txt = "";
            }
            if ($event_txt != "") {
                echo "<p><strong>Today's Lineup:</strong></p>$event_txt<hr />";
            }
            ?>
        </div>

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
                <a href="javascript:eventWindow('popout.php');" title="Pop-out Player"><img src="img/pop.png"></a>
            </div>
            <div id="announcer" >
            </div>
        </div>
        <div id="footer">
            <p>If you prefer to use your own player, tune in at <a href="http://radio.7chan.org:8000/radio.m3u">http://radio.7chan.org:8000/radio.m3u</a><p>
        </div>
    </body>
</html>
