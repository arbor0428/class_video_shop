<?php
include '/home/edufim/www/module/class/class.DbCon.php';

$c1 = $_POST['c1'];

$sql = "select c2.* from ks_license_cade01 c1, ks_license_cade02 c2 where c1.uid = c2.cade01 and c1.title='$c1' order by sort";
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
