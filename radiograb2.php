<?php //yet another silly grab method
$distUrl = 'http://radio.7chan.org:8000/status.xsl';
$distStr = file_get_contents($distUrl);
$dom = new DOMDocument;
$dom->loadHTML($distStr);
$td = $dom ->getElementsByTagName('td');
foreach ($td as $td) {
    $data[] = $td->nodeValue;
}
$clean = preg_replace("/\s+/", " ", $data);
print_r($data);
?>