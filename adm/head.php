<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

define('_WWW', '/home/edufim/www');
define ('_ADM', _WWW . '/adm');

include _WWW . "/module/class/class.DbCon.php";
include _WWW . "/module/class/class.Msg.php";
include _WWW . "/module/class/class.Util.php";
include _WWW . '/module/class/class.jUtil.php';
include _WWW . "/module/class/class.FileUpload.php";
include _WWW . "/module/class/class.gd.php";
include _WWW . '/module/enc_func.php';
// include '/home/edufim/www/module/lib.php';

session_cache_limiter('');
session_start();
Header("p3p: CP=\"CAO DSP AND SO ON\" policyref=\"/w3c/p3p.xml\"");

//글로벌 변수 설정
$GBL_UID	    = $_SESSION['ses_member_uid'];
$GBL_USERID	    = strtolower($_SESSION['ses_member_userid']);
$GBL_NAME		= $_SESSION['ses_member_name'];
$GBL_MTYPE		= $_SESSION['ses_member_type'];
// $GBL_PASSWORD	= $_SESSION['ses_member_pwd'];

if ($GBL_MTYPE == 'M') {
	header('Location:/');
    exit;
}

$MSG = new Msg();
$UTIL = new Util();

if (!isset($type)) $type = 'list';

$SYSTEM_DATE = date('Y-m-d');
$ver = '20230101';
