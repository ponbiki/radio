<?php
require_once 'nowplaying.php';

if ($arrXml['mountpoint']['@attributes']['id'] == '/radio') {
    echo "DJ: ". $arrXml['mountpoint']['name'] ."<br />";
    echo "Now Playing: ". $arrXml['mountpoint']['playing'] ."<br />";
    echo "Listeners: ". $arrXml['mountpoint']['listeners'] ."<br />";
} elseif ($arrXml['mountpoint'][$rad]['@attributes']['id'] == '/radio') {
    echo "DJ: ". $arrXml['mountpoint'][$rad]['name'] ."<br />";
    echo "Now Playing: ". $arrXml['mountpoint'][$rad]['playing'] ."<br />";
    echo "Listeners: ". $arrXml['mountpoint'][$rad]['listeners'] ."<br />";
} else {
    echo "OFF AIR";
}
