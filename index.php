<?php
require 'header.php';
require 'codec.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>7chan Radio</title>
        
        <meta name="robots" content="noindex, nofollow" />
        
        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
        
        <link rel="stylesheet" href="css/burichan.css" type="text/css" />
        
        <script type="text/javascript" src="http://hosted.musesradioplayer.com/mrp.js"></script>
        
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
        <div class="navbar">
            [<a href="index.php" title="7chan Radio">7chan Radio</a> / <a href="schedule.php" title="Schedule">Schedule</a>]
            [<a href="https://7chan.org/ch7/" title="Channel 7">ch7</a> / <a href="https://7chan.org" title="7chan">7chan</a>]
            [<a href="djPanel.php" title="DJ Panel">DJ Panel</a>]
            <?php
            if ($welcome != '')
                echo " [$welcome]";
            ?>
        </div>
        <div class="logo">
            <h1 title="7chan Radio">7chan Radio</h1>
        </div>
        <div class="pic">

            <img src="img/anime_girl_dj.jpg" alt="Weeaboo DJ" title="Weeaboo DJ" width="330" height="248" />

        </div>

        <div class="replymode">
            <h2>Now Playing</h2>
        </div>
        <div id="playing">
            <div id="player">
                <script type="text/javascript">
                MRP.insert({
                    'url': 'http://radio.7chan.org:8000/radio',
                    'codec': <?php echo "'$codec'" ?>,
                    'volume': 100,
                    'autoplay': false,
                    'buffering': 5,
                    'title': '7chan%20Radio',
                    'bgcolor': '#EEF2FF',
                    'skin': 'mcclean',
                    'width': 180,
                    'height': 60
                });
                </script>
            </div>
            <div id="announcer">


            </div>
        </div>

        <?php
        // put your code here
        ?>
    </body>
</html>
