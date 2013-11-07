<?php
include "header.php";

require 'codec.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">

        <title>Player</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <style type="text/css">
            <!--
            body {
               background-color: #EEF2FF;
            }
            -->
        </style>
    </head>
    <body>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="191" height="46" bgcolor="#EEF2FF">
        <param name="movie" value="muses.swf" />
        <param name="flashvars" value="url=http://radio.7chan.org:8000/radio&lang=auto&codec=<?php echo "$codec" ?>&volume=100&autoplay=true&introurl=&tracking=true&jsevents=true&skin=compact/ffmp3-compact.xml&title=7chan%20Radio&welcome=Get%20krunk" />
        <param name="wmode" value="window" />
        <param name="allowscriptaccess" value="always" />
        <param name="bgcolor" value="#EEF2FF" />
        <param name="scale" value="noscale" />
        <embed src="muses.swf" flashvars="url=http://radio.7chan.org:8000/radio&lang=auto&codec=<?php echo "$codec" ?>&volume=100&autoplay=true&introurl=&tracking=true&jsevents=true&skin=compact/ffmp3-compact.xml&title=7chan%20Radio&welcome=Get%20krunk" width="191" scale="noscale" height="46" wmode="window" bgcolor="#EEF2FF" allowscriptaccess="always" type="application/x-shockwave-flash" />
        </object>
    </body>
</html>