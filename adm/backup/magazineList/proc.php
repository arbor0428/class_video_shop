<?
include "../../module/class/class.DbCon.php";

$c = $_POST['c'];
$uid = $_POST['u'];

if($uid){
	$row = sqlRow("select * from ks_payment where uid='".$uid."'");
	$payTitle = $row['payTitle'];
	$orderNum = $row['orderNum'];

	//상품주문 결제건일 경우
	if($payTitle == 'order'){
		if($c){
			$status = '환불';
			$cDate = date('Y-m-d');
			$cTime = strtotime($cDate);
		}else{
			$status = '결제완료';
			$cDate = '';
			$cTime = 0;
		}

		//주문내역
		sqlExe("update ks_order set status='".$status."', cDate='".$cDate."', cTime='".$cTime."' where rTime='".$orderNum."'");
	}

	//결제내역
	if($c)	$payOk = '환불';
	else	$payOk = '결제완료';

	sqlExe("update ks_payment set payOk='".$payOk."' where uid='".$uid."'");
}
?>