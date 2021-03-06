<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");

$page = "DJ Profile";

htmlheader($page, $page, array());

echo $navigation; echo $logo;

bar($page);

?>
        <p><span id="welcome">Welcome, <?php echo $djname; ?>.</span></p>

        <?php
        if (isset($_POST['text']))
        {
                $text = sanitizeString($_POST['text']);
                $text = preg_replace('/\s\s+/', ' ', $text);

                $query = "SELECT * FROM profiles WHERE user='$djname'";
                if (mysql_num_rows(queryMysql($query)))
                {
                        queryMysql("UPDATE profiles SET text='$text'
                                            where user='$djname'");
                }
                else
                {
                        $query = "INSERT INTO profiles VALUES('$djname', '$text')";
                        queryMysql($query);
                }
        }
        else
        {
                $query  = "SELECT * FROM profiles WHERE user='$djname'";
                $result = queryMysql($query);

                if (mysql_num_rows($result))
                {
                        $row  = mysql_fetch_row($result);
                        $text = stripslashes($row[1]);
                }
                else $text = "";
        }

        $text = stripslashes(preg_replace('/\s\s+/', ' ', $text));

        if (isset($_FILES['image']['name']))
        {
                $saveto = "djpics/$djname.jpg";
                move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
                $typeok = TRUE;

                switch($_FILES['image']['type'])
                {
                        case "image/gif":   $src = imagecreatefromgif($saveto); break;

                        case "image/jpeg":  // Both regular and progressive jpegs
                        case "image/pjpeg":	$src = imagecreatefromjpeg($saveto); break;

                        case "image/png":   $src = imagecreatefrompng($saveto); break;

                        default:			$typeok = FALSE; break;
                }

                if ($typeok)
                {
                        list($w, $h) = getimagesize($saveto);
                        $max = 300;
                        $tw  = $w;
                        $th  = $h;

                        if ($w > $h && $max < $w)
                        {
                                $th = $max / $w * $h;
                                $tw = $max;
                        }
                        elseif ($h > $w && $max < $h)
                        {
                                $tw = $max / $h * $w;
                                $th = $max;
                        }
                        elseif ($max < $w)
                        {
                                $tw = $th = $max;
                        }

                        $tmp = imagecreatetruecolor($tw, $th);
                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                        imageconvolution($tmp, array( // Sharpen image
                                                                    array(-1, -1, -1),
                                                                    array(-1, 16, -1),
                                                                    array(-1, -1, -1)
                                                               ), 8, 0);
                        imagejpeg($tmp, $saveto);
                        imagedestroy($tmp);
                        imagedestroy($src);
                }
        }

        showProfile($djname);
        ?>

        <form method='post' action='djprofile.php'
                enctype='multipart/form-data'>
            <table style="float: left;">
                <tr>
                    <td style="text-align: left;">Enter or edit a profile and/or upload an image:</td>
                </tr><tr>
                    <td style="text-align: left;"><textarea name='text' cols='45' rows='4'><?php echo $text; ?></textarea></td>
                </tr><tr>
                    <td style="text-align: left;">Image: <input type='file' name='image' size='14' maxlength='32' />
                    <input type='submit' value='Save Profile' /></td>
                </tr>
            </table>
        </form>
<?php tail(); ?>