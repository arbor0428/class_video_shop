<?
include 'head.php';

if ($GBL_MTYPE == 'A' || $GBL_MTYPE == 'T') {
	// header('Location:/adm/main.php');
	header('Location:/adm/main.php');
	exit;
} elseif ($GBL_MTYPE == 'M') {
	header('Location:/');
	exit;
} else {
	include './login.php';	//로그인 페이지
}
