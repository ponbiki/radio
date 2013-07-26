<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
        <title>DJ Profile</title>

        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

        <link rel="stylesheet" href="css/burichan.css" type="text/css" />

    </head>
    <body>
        <?php echo $navigation; echo $logo; ?>

        <div class="replymode">
            <h2>DJ Profile</h2>
        </div>
        <p><span id="welcome">Welcome, <?php echo $djname; ?>.</span></p>

        <?php
        if (!isset($_POST['text'])) {
            $text = $_POST['text'];
            $query = "SELECT * FROM profiles WHERE user='$djname'";
            if (mysql_num_rows(queryMysql($query))) {
                queryMysql("UPDATE profiles SET text='$text' WHERE user='$djname'");
            } else {
                $query = "INSERT INTO profiles VALUES('$djname', '$text')";
                queryMysql($query);
            }
        } else {
            $query = "SELECT * FROM profiles WHERE user='$djname'";
            $result = queryMysql($query);

            if (mysql_num_rows($result)) {
                $row = mysql_fetch_row($result);
                $text = stripslashes($row[1]);
            }
            else $text = "";
        }

        $text = stripslashes(preg_replace('/\s\s+/', ' ', $text));

        if (isset($_FILES['image']['name'])) {
            $saveto = "/tmp/$djname.jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
            $typeok = TRUE;

            switch($_FILES['image']['type']) {
                case "image/gif":   $src = imagecreatefromgig($saveto); break;
                case "image/jpg":
                case "image/pjpeg": $src = imagecreatefromjpg($saveto); break;
                case "image/png":   $src = imagecreatefrompng($saveto); break;
                default:            $typeok = FALSE; break;
            }

            if ($typeok) {
                list($w, $h) = getimagesize($saveto);
                $max = 100;
                $tw = $w;
                $th = $h;

                if ($w > $h && $max < $w) {
                    $th = $max / $w * $h;
                    $tw =$max;
                } elseif ($h > $w && $max < $h){
                    $tw = $max / $h * $w;
                    $th = $max;
                } elseif ($max < $w){
                    $tw = $th = $max;
                }

                $tmp = imagecreatetruecolor($tw, $th);
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                imageconvolution($tmp,  array( //sharpen image
                                        array(-1, -1, -1),
                                        array(-1, 16, -1),
                                        array(-1, -1, -1)
                                        ), 8, 0);
                imagejpg($tmp, $saveto);
                imagedestroy($tmp);
                imagedestroy($src);
            }
        }

        showProfile($djname);

        ?>
        <form method='post' action='djprofile.php' enctype='multipart/form-data'>
            Enter or edit your profile and image:<br />
            <textarea name='text' cols='40' rows='3'><?php echo $text; ?></textarea><br />
            Image: <input type='file' name='image' />
            <input type='submit' value='Save Profile' />
            <?php echo $djname; ?>
        </form>
    </body>
</html>
