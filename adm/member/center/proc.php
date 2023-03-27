<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include "../../module/class/class.Util.php";
include '../../module/enc_func.php';

$_POST = sql_injection($_POST);

$type = trim($_POST['type']);


if($type == 'edit'){

	//ks_centerList 데이터
	$name = trim($_POST['name']);
	$address = trim($_POST['address']);	
	$owner = trim($_POST['owner']);
	$RegistrationNum = trim($_POST['RegistrationNum']);
	$cure = trim($_POST['cure']);
	$test = trim($_POST['test']);
	$homepage = trim($_POST['homepage']);
	$treatment = trim($_POST['treatment']);
	$customer = trim($_POST['customer']);
	$category = trim($_POST['category']);
	$num = trim($_POST['num']);
	$phonenum = trim($_POST['phonenum']);
	$email = trim($_POST['email']);
	$wtime = trim($_POST['wtime']);
	$parkingarea = trim($_POST['parkingarea']);
	$parkingtikets = trim($_POST['parkingtikets']);	
	$service = trim($_POST['service']);
	$voucher = trim($_POST['voucher']);
	$intro = trim($_POST['intro']);
	$insurance = trim($_POST['insurance']);
	$regioncurrency = trim($_POST['regioncurrency']);
	$refund = trim($_POST['refund']);
	$Photo = trim($_POST['Photo']);
//	$posx = trim($_POST['posx']);
//	$posy = trim($_POST['posy']);

	//ks_member 데이터
	$status = trim($_POST['status']);
	$level = trim($_POST['level']);
	$phone = trim($_POST['phone']);
	$passwd = trim($_POST['passwd']);
	$memberEmail = trim($_POST['memberEmail']);
	$memberEmail = explode('@',$memberEmail);
	$receiveChk = trim($_POST['receiveChk']);

	if($receiveChk == 'on') $receiveChk = "y";

	

/*
	//추천인 아이디 확인
	if($rCode){
		$tmpChk = sqlRowOne("select count(*) from ks_member where userid='".$rCode."'");

		if($tmpChk == 0){
			$msg = "추천인 아이디를 찾을 수 없습니다.";
			Msg::onlyMsg($msg);
			exit;
		}
	}
*/
	
	//ks_centerList 데이터
	$sql = "update ks_centerList set ";
	$sql .= "name='$name',";
	$sql .= "address='$address',";
	$sql .= "owner='$owner',";
	$sql .= "RegistrationNum='$RegistrationNum',";
	$sql .= "cure='$cure',";
	$sql .= "test='$test',";
	$sql .= "homepage='$homepage',";
	$sql .= "treatment='$treatment',";
	$sql .= "customer='$customer',";
	$sql .= "category='$category',";
	$sql .= "num='$num',";
	$sql .= "phonenum='$phonenum',";
	$sql .= "email='$email',";
	$sql .= "wtime='$wtime',";
	$sql .= "parkingarea='$parkingarea',";
	$sql .= "parkingtikets='$parkingtikets',";
	$sql .= "service='$service',";
	$sql .= "voucher='$voucher',";
	$sql .= "intro='$intro',";
	$sql .= "insurance='$insurance',";
	$sql .= "regioncurrency='$regioncurrency',";
	$sql .= "refund='$refund',";
	$sql .= "Photo='$Photo' ";
	$sql .= " where uid='".$cuid."'";
	sqlExe($sql);

	//ks_member 데이터
	$sql2 = "update ks_member set ";
	$sql2 .= "status='$status',";
	$sql2 .= "level='$level',";
	$sql2 .= "phone='$phone',";
	if(trim($_POST['passwd'])){
		$passwd	= hash('sha256',trim($_POST['passwd']));
		$sql2 .= "passwd = '$passwd',";
	}
	$sql2 .= "email01='$memberEmail[0]',";
	$sql2 .= "email02='$memberEmail[1]',";
	$sql2 .= "receiveChk='$receiveChk'";	
	$sql2 .= " where uid='".$uid."'";
	sqlExe($sql2);

	Msg::GblMsgBoxParent("수정되었습니다.","location.href='./form.php?uid=$uid&type=edit'");


}elseif($type == 'del'){
	$userid = sqlRowOne("select userid from ks_member where uid='".$uid."'");

	sqlExe("delete from ks_member where uid='".$uid."'");
	sqlExe("delete from ks_login_log where userid='".$userid."'");
	sqlExe("delete from ks_payment where userid='".$userid."'");
	sqlExe("delete from ks_pointList where userid='".$userid."'");
	sqlExe("delete from ks_coupon where userid='".$userid."'");
	sqlExe("delete from ks_member_child where puid='".$uid."'");
	


	echo ("<script>parent.parent.searchChk();</script>");
}
?>