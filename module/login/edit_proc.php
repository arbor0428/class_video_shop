<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

$pwd = hash('sha256', trim($pwd));

$row = sqlRow("SELECT * FROM ks_member WHERE userid='$GBL_USERID'");

if ($pwd === $row['pwd']) {
    $receiveChk = ($receiveChk == 'on')? 1 : 0;

    if ($pwdNew != '' && $pwdChk != '') {
        if ($pwd === $row['pwd']) {
            $pwdNew = hash('sha256', trim($pwdNew));
            $query = "UPDATE ks_member SET 
                pwd='$pwdNew', 
                option01 ='$option01', 
                option02 ='$option02', 
                option03 ='$option03',
                receiveChk='$receiveChk'
                WHERE userid='$GBL_USERID'";
        $msg = '비밀번호가 변경되었습니다';
        // Msg::GblMsgBoxParent($msg, "location.href='/module/login/logout_proc.php'");
                
        } else {
            Msg::GblMsgBoxParent('비밀번호 확인이 일치하지 않습니다', '');
            exit;
        }
        
    } else {
        $query = "UPDATE ks_member SET 
            option01 ='$option01', 
            option02 ='$option02', 
            option03 ='$option03',
            receiveChk='$receiveChk'
            WHERE userid='$GBL_USERID'";
        $msg = '변경되었습니다';
    }
    sqlExe($query);

    Msg::GblMsgBoxParent($msg, "location.href='/mypage/sub14.php'");

} else {
    Msg::GblMsgBoxParent('기존비밀번호가 다릅니다', '');
    exit;
}