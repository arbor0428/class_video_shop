<?
	include '../../module/class/class.DbCon.php';

	$uid = $_POST['uid'];

	$prodList = Array();

	$row = sqlRow("select * from ks_product where uid='".$uid."'");

	$prodList['uid'] = $row['uid'];
	$prodList['img'] = $row['upfile01'];
	$prodList['cade01'] = urlencode($row['cade01']);
	$prodList['cade02'] = urlencode($row['cade02']);
	$prodList['cade03'] = urlencode($row['cade03']);
	$prodList['title'] = urlencode($row['title']);
	$prodList['price'] = $row['price'];

	$upfile01 = $row['upfile01'];
	if(!$upfile01)	$upfile01 = 'no_img.png';
	$prodList['img'] = $upfile01;


	$json = json_encode($prodList);
	echo $json;
?>