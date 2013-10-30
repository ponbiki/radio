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

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

        <script type="text/javascript">
            function eventWindow(url) {
                event_popupWin = window.open(url, 'event',
                    'resizable=yes,scrollbar=yes,toolbar=no,width=400,height=300');
                event_popupWin.opener = self;
            }
        </script>
    </head>