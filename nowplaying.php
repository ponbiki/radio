<?php
$distUrl = 'http://radio.7chan.org:8000/status3.xsl';
$distStr = file_get_contents($distUrl);
$distObj = simplexml_load_string($distStr);
$arrXml = objectsIntoArray($distObj);
$rad = findRadio($arrXml);

function findRadio($arr) {
    for ($j = 0; $j < 6; $j++) {
        if ($arr['mountpoint'][$j]['@attributes']['id'] == '/radio') {
            break;
        } else {
            continue;
        }
    }
    return $j;
}

function findCodec($arr) {

    global $rad;

    if (($arr['mountpoint'][$rad]['streamurl'] == 'MP3') || ($arr['mountpoint'][$rad]['streamurl'] == 'mp3')
            || ($arr['mountpoint']['streamurl'] == 'MP3') || ($arr['mountpoint']['streamurl'] == 'mp3')) {
        $j = 'mp3';
    } else {
        $j = 'ogg';
    }
    return $j;
}

function objectsIntoArray($arrObjData, $arrSkipIndices = array()) {
    $arrData = array();

    // if input is object, convert into array
    if (is_object($arrObjData)) {
            $arrObjData = get_object_vars($arrObjData);
    }

    if (is_array($arrObjData)) {
            foreach ($arrObjData as $index => $value) {
                    if (is_object($value) || is_array($value)) {
                            $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
                    }
                    if (in_array($index, $arrSkipIndices)) {
                            continue;
                    }
                    $arrData[$index] = $value;
            }
    }
    return $arrData;
}
?>
