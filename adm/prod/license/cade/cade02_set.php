<?
	include '/home/edufim/www/module/class/class.DbCon.php';

	$c1 = $_POST['c1'];
	$c2 = $_POST['c2'];

	$sql = "select * from ks_license_cade03 where cade01='$c1' and cade02='$c2' order by sort";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$cade03List = Array();

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$cade03 = $row['cade03'];
		$cade03List[$i] = urlencode($cade03);
	}

	$json = json_encode($cade03List);
	echo $json;
?>