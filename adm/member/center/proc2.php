<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include "../../module/class/class.Util.php";
include '../../module/enc_func.php';

$_POST = sql_injection($_POST);

$type = trim($_POST['type']);

if($type == 'edit'){
	$name01 = trim($_POST['name01']);
	$gender01 = trim($_POST['gender01']);
	$data01 = trim($_POST['data01']);
	$data02 = trim($_POST['data02']);
	$data03 = trim($_POST['data03']);
	$ment01 = trim($_POST['ment01']);
	$ment02 = trim($_POST['ment02']);
	$ment03 = trim($_POST['ment03']);
	$ment04 = trim($_POST['ment04']);

	$sql = "update ks_member_child set ";
	$sql .= "name01='$name01',";
	$sql .= "gender01='$gender01',";
	$sql .= "data01='$data01',";
	$sql .= "data02='$data02',";
	$sql .= "data03='$data03',";
	$sql .= "ment01='$ment01',";
	$sql .= "ment02='$ment02',";
	$sql .= "ment03='$ment03',";
	$sql .= "ment04='$ment04'";
	$sql .= " where uid='".$uid."'";
	sqlExe($sql);

	Msg::GblMsgBoxParent("수정되었습니다.","location.href='./index2.php?uid=$uid&type=edit'");


}elseif($type == 'del'){
	$userid = sqlRowOne("select userid from ks_member_chilld where uid='".$uid."'");

	sqlExe("delete from ks_login_log where userid='".$userid."'");
	sqlExe("delete from ks_payment where userid='".$userid."'");
	sqlExe("delete from ks_pointList where userid='".$userid."'");
	sqlExe("delete from ks_coupon where userid='".$userid."'");
	sqlExe("delete from ks_member_child where puid='".$uid."'");
	


	echo ("<script>parent.parent.searchChk();</script>");
}
?>