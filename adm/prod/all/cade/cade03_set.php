<?php
include '/home/edufim/www/module/class/class.DbCon.php';

$c1 = $_POST['c1'];
$c2 = $_POST['c2'];
$c3 = $_POST['c3'];

$cade01 = "SELECT uid FROM ks_class_cade01 WHERE title='$c1'";
$cade02 = "SELECT uid FROM ks_class_cade02 WHERE cade01=($cade01) AND title='$c2'";
$cade03 = "SELECT uid FROM ks_class_cade03 WHERE cade01=($cade01) AND cade02=($cade02) AND title='$c3'";

$sql = "SELECT * FROM ks_class_cade04 WHERE cade01=($cade01) AND cade02=($cade02) AND cade03=($cade03) ORDER BY sort ASC";

$result = mysql_query($sql) or die(mysql_error());
$num = mysql_num_rows($result);

$cade04List = array();

for ($i = 0; $i < $num; $i++) {
    $row = mysql_fetch_array($result);
    $cade04 = $row['title'];
    $cade04List[$i] = urlencode($cade04);
}

$json = json_encode($cade04List);
echo $json;
