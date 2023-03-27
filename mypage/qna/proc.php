<?php
include '/home/edufim/www/header.php';

if(isEmpty($uid)) die('INVALID ACCESS');
else {
    $class_uid = sqlRowOne("SELECT class_uid FROM ks_learning WHERE userid='$GBL_USERID' AND uid='$uid'");
    $time = time();
    $query = "INSERT INTO ks_qna (status, learning_uid, class_uid, userid, content, rTime) 
        VALUES (0, '$uid', '$class_uid', '$GBL_USERID', '$content', '$time')";
    sqlExe($query);
}
Msg::goMsg('작성되었습니다.', '/mypage/qna/');