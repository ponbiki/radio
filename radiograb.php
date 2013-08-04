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
        $cleaned = strip_tags($result);
        /*$cleaned2 = var_dump($cleaned);*/
        echo "<pre>" . $cleaned . "</pre>";
    }
    fclose($fp);
}
?>