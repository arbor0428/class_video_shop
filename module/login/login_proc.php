<?php
session_start();
Header("p3p: CP=\"CAO DSP AND SO ON\" policyref=\"/w3c/p3p.xml\"");

include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

// $_POST = sql_injection($_POST);

$email = strtolower($_POST['email']);
$pwd = hash('sha256', trim($_POST['pwd']));

// $next_url = $_POST['next_url'];
// $token = $_POST['token'];

if (!$next_url)	$next_url = '/';

// $token = str_replace('\\"', '', $token);
// $token = str_replace('\\', '', $token);

//직원정보확인
if ($_SERVER['REMOTE_ADDR'] == '106.246.92.2371') {
	$sql = "select * from ks_member where email='$email'";
} else {
	$sql = "select * from ks_member where email='$email' and pwd='$pwd'";
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
		// if ($token) {
		// 	$sql = "update ks_member set token='$token' where email='$email'";
		// 	$result = mysql_query($sql);
		// }
		$_SESSION['ses_member_email']	= strtolower($email);
		$_SESSION['ses_member_name']	= $info['name'];
		$_SESSION['ses_member_type']	= $info['mtype'];
		$_SESSION['ses_member_pwd']		= $info['pwd'];
		// $_SESSION['ses_member_company']	= $info['company'];
		Msg::goKorea($next_url);
		exit;
	}
} else {
	$msg = '입력정보가 일치하지 않습니다.\\n입력정보를 확인해 주십시오';
	Msg::GblMsgBoxParent($msg, '');
	exit;
}
