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
        $radio_key = key($split);
        $stream_type = $split[$radio_key + 11];
    }
}
echo $stream_type;
?>