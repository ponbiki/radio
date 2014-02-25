<?php //yet another silly grab method
$distUrl = 'http://radio.7chan.org:8000/status.xsl';
$distStr = file_get_contents($distUrl);
$dom = new DOMDocument;
$dom->loadHTML($distStr);
$td = $dom ->getElementsByTagName('td');
foreach ($td as $td) {
    $data[] = $td->nodeValue;
}
$data = preg_replace("/\s+/", " ", $data);
if (in_array('Mount Point /radio', $data)) {
    while (current($data) != 'Mount Point /radio') {
        next($data);
        $rad_key = key($data);
    }
    $rad_array = array_slice($data, $rad_key);
    while (current($rad_array) != 'Content Type:') {
        next($rad_array);
        $type_key = (key($rad_array)+1);
    }
}
echo $rad_array[$type_key];
?>