<?php
require_once 'nowplaying.php';

$codec = findCodec($arrXml);

function findCodec($arr) {
if (($arr['mountpoint'][$rad]['streamurl'] = "mp3") || ($arr['mountpoint']['streamurl'] = "mp3"))
        $k = 'mp3';
    else
        $k = 'ogg';
    return $k;
}
?>
