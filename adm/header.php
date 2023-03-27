<?
include "/home/edufim/www/adm/head.php";
// include '/home/edufim/www/module/loading.php';

if (!$GBL_USERID) {
	header('Location:/');
	exit;
}
if (isEmpty($GBL_USERID)) {
	header('Location:/');
	exit;
}
if (!isAdmin($GBL_MTYPE)){
	header('Location:/');
	exit;
}
if (!isset($type)) $type = 'list';
?>

<div id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">