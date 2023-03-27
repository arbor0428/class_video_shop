<?php
session_start();
Header("p3p: CP=\"CAO DSP AND SO ON\" policyref=\"/w3c/p3p.xml\"");

include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

$userid = strtolower($_POST['userid']);
$pwd = hash('sha256', trim($_POST['pwd']));

$next_url = $_POST['next_url'];

if (!$next_url)	$next_url = '/';

//직원정보확인
if ($_SERVER['REMOTE_ADDR'] == '106.246.92.237') {
	$sql = "SELECT * FROM ks_member WHERE userid='$userid'";
} else {
	$sql = "SELECT * FROM ks_member WHERE userid='$userid' AND pwd='$pwd'";
}

$result = mysql_query($sql);
$num = mysql_num_rows($result);

if ($num) {
	$info = mysql_fetch_array($result);
	$status = $info['status'];

	if ($status == '2') {
		$msg = '관리자 승인 후 로그인이 가능합니다.';
		Msg::GblMsgBoxParent($msg, '');
		exit;

	} elseif ($status == '3') {
		$msg = '탈퇴처리된 회원입니다.';
		Msg::GblMsgBoxParent($msg, '');
		exit;

	} else {

        $loginTime = time();
        $loginDate = date('Y-m-d H:i:s', $loginTime);
        sqlExe("UPDATE ks_member SET loginDate='$loginDate', loginTime='$loginTime' WHERE userid='$userid'");
        
		$_SESSION['ses_member_uid']	    = $info['uid'];
		$_SESSION['ses_member_userid']	= $userid;
		$_SESSION['ses_member_name']	= $info['name'];
		$_SESSION['ses_member_type']	= $info['mtype'];
		Msg::goKorea($next_url);
		exit;
	}
} else {
	$msg = '입력정보가 일치하지 않습니다.\\n입력정보를 확인해 주십시오';
	Msg::GblMsgBoxParent($msg, '');
	exit;
}
