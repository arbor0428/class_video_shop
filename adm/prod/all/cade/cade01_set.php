<?php
include '/home/edufim/www/module/class/class.DbCon.php';

$c1 = $_POST['c1'];

$cade01 = "SELECT uid FROM ks_class_cade01 WHERE title='$c1'";

$sql = "SELECT * FROM ks_class_cade02 WHERE cade01=($cade01) ORDER BY sort ASC";

$result = mysql_query($sql);
$num = mysql_num_rows($result);

$cade02List = array();

for ($i = 0; $i < $num; $i++) {
	$row = mysql_fetch_array($result);
	$cade02 = $row['title'];
	$cade02List[$i] = urlencode($cade02);
}

$json = json_encode($cade02List);
echo $json;
