<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

function conv_nll($arg)
{
	return $arg? "'$arg'" : "NULL";
}

$_POST = sql_injection($_POST);

if ($pwd) {
	$pwd = hash('sha256', trim($_POST['pwd']));
} else {
	// exit;
}

$option01 = conv_nll($option01);
$option02 = conv_nll($option02);
$option03 = conv_nll($option03);
$receive_check = ($agree03 == "receive_check")? 1 : 0;
$userip = $_SERVER['REMOTE_ADDR'];
$reg_time = time();

$sql = "insert into ks_member(email, pwd, name, phone, zipcode, address, address_detail, gender, option01, option02, option03, receive_check, userip, reg_time) values ";
$sql .= "('$email', '$pwd', '$mname', '$phone', '$postCode', '$address', '$address_detail', '$gender', $option01, $option02, $option03, '$receive_check', '$userip', '$reg_time')";
// $result = sqlExe($sql);

if ($result) {
	Msg::goKorea($url);
} else {
	$msg = "회원 가입 오류. 관리자(3938)에게 문의 바랍니다.";
	$script = "location.href = '/'";
	Msg::GblMsgBoxParent($msg, $script);
}
