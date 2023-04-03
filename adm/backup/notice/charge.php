<?
exit;
if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
	include '../../module/class/class.DbCon.php';

	//충전포인트
	$charge = 100000;

	//현재 보유포인트
	$upoint = sqlRowOne("select alimtalkPoint from ks_shopConfig");

	//포인트 충전
	$point = $charge + $upoint;
	sqlExe("update ks_shopConfig set alimtalkPoint='".$point."'");

	//포인트 충전기록
	$talkType = 'charge';
	$userid = 'admin';
	$ptype = 'P';
	$pMent = '포인트충전';
	$userip = $_SERVER['REMOTE_ADDR'];
	$rDate = date('Y-m-d H:i:s');
	$rTime = time();

	$sql = "insert into ks_alimtalk_point (talkType,userid,ptype,point,afterPoint,pMent,userip,rDate,rTime) values ('$talkType','$userid','$ptype','$charge','$point','$pMent','$userip','$rDate','$rTime')";
	sqlExe($sql);
}
?>