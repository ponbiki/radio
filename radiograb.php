<?php //experimenting with a grab from html instead of xsl
$fp = fsockopen("74.208.78.226", 8000, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = "GET /status.xsl HTTP/1.1\r\n";
    $out .= "Host: 74.208.78.226\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    while (!feof($fp)) {
        $result = (fgets($fp, 128));
        $out .= $result. "\n";
    }
    fclose($fp);
}
$cleaned = strip_tags($out);
$stripped = preg_replace("/\s+/", " ", $cleaned);
$split = explode(" ", $stripped);
if (in_array('/radio', $split)) {
    while (current($split) != '/radio') {
        next($split);
        $rad_key = key($split);
    }
    $rad_array = array_slice($split, $rad_key);
    while (current($rad_array) != 'Type:') {
        next($rad_array);
        $type_key = (key($rad_array)+1);
    }
}
$rad_cod = $rad_array[$type_key];
?>