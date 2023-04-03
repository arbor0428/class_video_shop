<?
	include '../../module/class/class.DbCon.php';

	$c1 = $_POST['c1'];
	$c2 = $_POST['c2'];
	$c3 = $_POST['c3'];

	$prodList = Array();

	$row = sqlArray("select * from ks_product where cade01='".$c1."' and cade02='".$c2."' and cade03='".$c3."' and status='1' and inven>0 order by title");
	foreach($row as $k => $v){
		$prodList[$k]['uid'] = $v['uid'];
		$prodList[$k]['title'] = urlencode($v['title']);

		$upfile01 = $v['upfile01'];
		if(!$upfile01)	$upfile01 = 'no_img.png';
		$prodList[$k]['img'] = $upfile01;
	}

	$json = json_encode($prodList);
	echo $json;
?>