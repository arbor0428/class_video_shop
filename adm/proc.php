<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

$query = "SELECT * FROM ks_member WHERE uid='$uid'";
$row = sqlRow($query);

$o_pwd = hash('sha256', trim($_POST['o_pwd']));

if ($o_pwd === $row['pwd']) {
    if ($n_pwd1 != $n_pwd2) {
        Msg::backMsg("비밀번호가 일치하지 않습니다");
    } else {
        $n_pwd = hash('sha256', trim($_POST['n_pwd1']));
    
        $query = "UPDATE ks_member SET pwd='$n_pwd' WHERE uid='$uid'";
        sqlExe($query);
    
        Msg::onlyMsg("비밀번호가 변경되었습니다");
        Msg::GblMsgBoxCloseParent('multiBox_close');
    }

} else {
    Msg::backMsg("비밀번호가 일치하지 않습니다");
}

unset($dbcon);
