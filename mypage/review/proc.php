<?php
include '/home/edufim/www/header.php';

if(isEmpty($uid)) die('INVALID ACCESS');
else {
    $time = time();
    $query = "INSERT INTO ks_review (class_uid, userid, title, content, rTime) 
        VALUES ('$uid', '$GBL_USERID', '$title', '$content', '$time')";
    sqlExe($query);
}
Msg::goMsg('작성되었습니다.', '/mypage/review/');