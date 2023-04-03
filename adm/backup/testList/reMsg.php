<?
	include '../head.php';

	if(!$GBL_USERID){
		Msg::backMsg('접근오류');
		exit;
	}

	$orderNum = $_GET['orderNum'];

	$tmpChk = sqlRowOne("select count(*) from ks_order where rTime='$orderNum'");
	if(!$tmpChk){
		Msg::backMsg('접근오류');
		exit;
	}
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' id='prodTable' class='listTable'>
	<tr>
		<th width='20%'>이미지</th>
		<th width='90%'>사유</th>
	</tr>
<?
	$prodCnt = 0;

	//주문상품
	if($orderNum){
		$olist = sqlArray("select * from ks_orderList where rTime='".$orderNum."' and status='반품요청' order by uid");

		foreach($olist as $v){
			//상품정보
			$item = sqlRow("select * from ks_product where uid='".$v['pid']."'");
			$upfile01 = $item['upfile01'];
			if(!$upfile01)	$upfile01 = 'no_img.png';
?>
	<tr id='prod<?=$i?>'>
		<td align='center'><img src='/upfile/<?=$upfile01?>' style='width:100px;'></td>
		<td><p style='font-weight:800;'><?=$v['title']?></p><?=$v['reMsg']?></td>
	</tr>
<?
		}
	}
?>
</table>