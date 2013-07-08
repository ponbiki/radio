<?php
$distUrl = 'http://radio.7chan.org:8000/status3.xsl';
$distStr = file_get_contents($distUrl);
$distObj = simplexml_load_string($distStr);
$arrXml = objectsIntoArray($distObj);
$rad = findRadio($arrXml);

if ($arrXml['mountpoint']['@attributes']['id'] == '/radio') {
    echo "DJ: ". $arrXml['mountpoint']['name'] ."<br />";
    echo "Now Playing: ". $arrXml['mountpoint']['playing'] ."<br />";
    echo "Listeners: ". $arrXml['mountpoint']['listeners'] ."<br />";
} elseif ($arrXml['mountpoint'][$rad]['@attributes']['id'] == '/radio') {
       echo "DJ: ". $arrXml['mountpoint'][$rad]['name'] ."<br />";
        echo "Now Playing: ". $arrXml['mountpoint'][$rad]['playing'] ."<br />";
        echo "Listeners: ". $arrXml['mountpoint'][$rad]['listeners'] ."<br />";
} else echo "OFF AIR";
        

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
