<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
include "/home/edufim/www/module/class/class.Util.php";

if (!$userid || !$type) {
    Msg::GblMsgBoxParent('잘못된 접근입니다.', "location.href='/mypage/cart/'");
    echo "NOT_ACCESS";
    exit;
}

switch ($type) {
    case 'DEL':
        if (!$class_uid) {
            Msg::GblMsgBoxParent('상품을 선택하세요.', "location.reload()");
            exit;
        }
        $sql = "DELETE FROM ks_cart WHERE userid='$userid'";
        $sql .=  " AND class_uid=$class_uid";

        $result_del = sqlExe($sql);
        if ($result_del) {
            Msg::goKorea('/mypage/cart/');
        } else {
            Msg::GblMsgBoxParent('삭제 오류', "location.reload()");
        }

        break;

    case 'DEL_SELETED':
        if (!$class_uids) {
            Msg::GblMsgBoxParent('상품을 선택하세요.', "location.reload()");
            exit;
        }

        $sql = "DELETE FROM ks_cart WHERE userid='$userid' AND";
        foreach ($class_uids as $key => $class_uid) {
            $sql .=  " class_uid=$class_uid";
            if ($key === count($class_uids) - 1) break;
            $sql .= " OR";
        }

        $result_del = sqlExe($sql);
        if ($result_del) {
            Msg::goKorea('/mypage/cart/');
        } else {
            Msg::GblMsgBoxParent('삭제 오류', "location.reload()");
        }

        break;
}
