<?php
require 'header.php';

if (!$loggedin) header("Location: index.php");

$page = "DJ Panel";

htmlheader($page, $page, array());

echo $navigation; echo $logo;

bar($page);

?>
<p><span id="welcome">Welcome, <?php echo $djname; ?>.</span></p>
        <div class="dj">
            <ul style="list-style-type: none;">
                <?php if ($admin)
                    echo "<li><a href='adddj.php' title='Add DJ'>Add New DJ</a></li>
                        <li><a href='removedj.php' title='Remove DJ'>Remove DJ</a></li>"; ?>
                    <li><a href='changepwd.php' title='Change Password'>Change Password</a></li>
                    <li><a href='djprofile.php' title='DJ Profile'>DJ Profile</a></li>
                    <li><a href='schedule.php' title='Schedule'>Schedule Set</a></li>
            </ul>
        </div>
        <table>
            <tr><th>DJs</th></tr>
            <?php
            $query = "SELECT * FROM djs";
            $result = mysql_query($query);
            $rows = mysql_num_rows($result);

            for ($j = 0; $j < $rows; ++$j) {
                if (mysql_result($result,$j,'admin') == "Y") {
                    echo "<tr><td><span style='color:#AF0A0F;'>" . mysql_result($result,$j,'username') . "</span></td></tr>";
                } else {
                    echo "<tr><td>" . mysql_result($result,$j,'username') . "</td></tr>";
                }
            }
            ?>
        </table>
    </body>
</html>