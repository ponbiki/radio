<?php
require 'header.php';

$page = "DJ Lineup";

htmlheader($page, $page, array());

echo $navigation; echo $logo;

bar($page);

?>

    <ul style="list-style-type: none;">
            <?php
            $query = "SELECT * FROM djs";
            $result = mysql_query($query);
            $rows = mysql_num_rows($result);

            for ($j = 0; $j < $rows; ++$j) {
                $name = mysql_result($result,$j,'username');
                echo "<li><span style='font-size: 12pt; color: #4F5260 !important;'>" . $name . "<br />";
                if (!file_exists("djpics/$name.jpg")) {
                    list($w, $h) = getimagesize("img/catdj.jpg");
                    $width = $w/8 . "px";
                    $height = $h/8 . "px";
                    echo "<img src='img/catdj.jpg' alt='$name' title='$name' style='border: #9988EE solid; border-width: 1px; padding: 1px; width: $width; height: $height;'/></span>";
                } else {
                    list($w, $h) = getimagesize("djpics/$name.jpg");
                    $width = $w/4 . "px";
                    $height = $h/4 . "px";
                    echo "<img src='djpics/$name.jpg' alt='$name' title='$name' style='border: #9988EE solid; border-width: 1px; padding: 1px; width: $width; height: $height;'/></span>";
                }
                $result2 = queryMysql("SELECT * FROM profiles WHERE user='$name'");
                if (!mysql_num_rows($result2)) {
                    echo "<span style='float: right; width: 85%; font-size: 10pt;'>I'm too lazy to add a profile";
                } else {
                    $row = mysql_fetch_row($result2);
                    echo "<span style='float: right; width: 85%; font-size: 10pt;'>" . stripslashes($row[1]);
                }
                echo "</span><br /><br /></li>";
            }
            ?>
        </ul>
    </body>
</html>