<?php
include '/home/edufim/www/module/class/class.DbCon.php';

$c1 = $_POST['c1'];
$c2 = $_POST['c2'];

$cade01 = "SELECT uid FROM ks_class_cade01 WHERE title='$c1'";
$cade02 = "SELECT uid FROM ks_class_cade02 WHERE cade01=($cade01) AND title='$c2'";

$sql = "SELECT * FROM ks_class_cade03 WHERE cade01=($cade01) AND cade02=($cade02) ORDER BY sort ASC";

$result = mysql_query($sql);
$num = mysql_num_rows($result);

$cade03List = array();

for ($i = 0; $i < $num; $i++) {
    $row = mysql_fetch_array($result);
    $cade03 = $row['title'];
    $cade03List[$i] = urlencode($cade03);
}

$json = json_encode($cade03List);
echo $json;
