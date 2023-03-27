<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
// include "/home/edufim/www/module/class/class.Util.php";
if (!isset($userid) || !isset($pwd) || !isset($pwdChk) || !isset($phone) || !isset($postCode) || !isset($addr01) || !isset($gender) || !isset($agree01) || !isset($agree02)) {
    http_response_code(404);
    exit;
}

$MSG = new Msg();

function isEmailExist($userid)
{
    $sql = "SELECT * FROM ks_member WHERE userid='$userid'";
    $result = mysql_query($sql);
    $record_cnt = mysql_num_rows($result);

    if ($record_cnt > 0)    return true;
    else    return false;
}

$userid = strtolower(addslashes(trim($userid)));
$userid = str_replace(' ', '', $userid);

if (isEmailExist($userid)) {
    $msg = "이미 사용중인 이메일입니다";
    $MSG->GblMsgBoxParent($msg, '');
    exit;
}

$pwd = hash('sha256', trim($_POST['pwd']));

/*
$option01 = $UTIL->conv_nll($option01);
$option02 = $UTIL->conv_nll($option02);
$option03 = $UTIL->conv_nll($option03);
*/
$receiveChk = ($agree03 == "receiveChk") ? 1 : 0;

$query = "SELECT config_value FROM config_sale WHERE config_key='signup_point'";
$result = mysql_query($query) or die(mysql_error());
$point = mysql_fetch_row($result)[0];
if (empty($point)) $point = 0;

$userip = $_SERVER['REMOTE_ADDR'];
$rTime = time();

$sql = "INSERT INTO ks_member(userid, kakaoID, naverID, googleID, pwd, name, phone, zipcode, addr01, addr02, gender, option01, option02, option03, receiveChk, point, userip, rTime) values ";
$sql .= "('$userid', '$kakaoID', '$naverID', '$googleID', '$pwd', '$mname', '$phone', '$postCode', '$addr01', '$addr02', '$gender', '$option01', '$option02', '$option03', '$receiveChk', '$point', '$userip', '$rTime')";
$result = sqlExe($sql);

if ($result) {
    // signup coupon
    $query = "SELECT s.config_value, c.discountPeriod FROM config_sale s JOIN ks_coupon c ON s.config_value=c.uid WHERE s.config_key='signup_coupon'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_row($result);
    $coupon_uid = $row[0];
    $discountPeriod = $row[1];

    $eTime = $rTime + (60 * 60 * 24 * intval($discountPeriod));
    $eTime = strtotime(date('Y-m-d 23:59:59', $eTime));

    if (!empty($coupon_uid)) {
        sqlExe("INSERT INTO ks_coupon_log (status, userid, coupon_uid, rTime, eTime) VALUES (0, '$userid', '$coupon_uid', '$rTime', '$eTime')");
    }

    $msg = "회원 가입이 완료되었습니다.";
    $url = "location.href = '/member/login.php'";
    $MSG->GblMsgBoxParent($msg, $url);
} else {
    $msg = "회원 가입이 일시적으로 제한 되었습니다. 관리자에게 문의 바랍니다.";
    $url = "location.href = '/'";
    $MSG->GblMsgBoxParent($msg, $url);
}
