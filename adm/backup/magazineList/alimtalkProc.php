<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';

if($chk == '' || $type == ''){
	exit;
}


$a = 0;
$alimArr = Array();		//알림톡 발송용
$clientID = '';

foreach($chk as $uid){
	$row = sqlRow("select * from ks_payment where uid='".$uid."'");
	$userid = $row['userid'];
	$payTitle = $row['payTitle'];
	$orderNum = $row['orderNum'];

	$item = '';

	//상품 수령 후 결제
	if($payTitle == 'order'){
		$item = sqlRow("select * from ks_order where rTime='".$orderNum."'");

	//스타일링 결제 또는 가입
	}elseif($payTitle == 'style' || $payTitle == 'join'){
		$item = sqlRow("select * from ks_member where userid='".$userid."'");
	}

	if($item){

		if($clientID)		$clientID .= ',';
		$clientID .= $userid;

		$alimArr[$a]['name'] = $item['name'];
		$alimArr[$a]['phone'] = $item['phone'];

		$a++;

		echo $item['name'].' / '.$item['phone'].'<br>';
	}
}




if(count($alimArr)){
	$talkType = $type;	//배송지연(delay-bae) or 발송지연(delay-bal)

	include '../../module/kakao/alimtalk.php';

	if($talkType == 'delay-bae')		$txt = '배송지연';
	elseif($talkType == 'delay-bal')	$txt = '발송지연';
?>

<script>
parent.GblMsgBox("[<?=$txt?>] 알림톡이\n발송되었습니다.");
</script>
<?
}
?>