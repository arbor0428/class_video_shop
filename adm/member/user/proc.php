<?
include "/home/edufim/www/adm/header.php";

$type = trim($_POST['type']);

if($type == 'edit'){
	if($receiveChk == 'checked') $receiveChk = 1;
	else $receiveChk = 0;

	//추천인 아이디 확인
	// if($rCode){
	// 	$tmpChk = sqlRowOne("select count(*) from ks_member where userid='".$rCode."'");

	// 	if($tmpChk == 0){
	// 		$msg = "추천인 아이디를 찾을 수 없습니다.";
	// 		Msg::onlyMsg($msg);
	// 		exit;
	// 	}
	// }

	$sql = "update ks_member set ";
	$sql .= "status='$status',";
	$sql .= "mtype='$mtype',";
//	$sql .= "gender='$gender',";
//	$sql .= "name='$name',";
	$sql .= "phone='$phone',";

	if(trim($_POST['pwd'])){
		$pwd = hash('sha256',trim($_POST['pwd']));
		$sql .= "pwd = '$pwd',";
	}

//	$sql .= "zipcode='$zipcode',";
	$sql .= "addr01='$addr01',";
	$sql .= "addr02='$addr02',";
	// $sql .= "email01='$email[0]',";
	// $sql .= "email02='$email[1]',";
	// $sql .= "bDate='$bDate',";
	// $sql .= "bTime='$bTime',";
	// $sql .= "rCode='$rCode',";
	$sql .= "receiveChk='$receiveChk'";	
	$sql .= " where uid='".$uid."'";
	sqlExe($sql);

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