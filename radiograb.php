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
echo "<pre>";print_r($split);echo "</pre>";
?>