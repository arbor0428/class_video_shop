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
	case 'PAY':
		$status = 0;
		// $class_title = sqlRowOne("SELECT * FROM ks_class WHERE uid=$class_uid");
		// $class_uids = json_decode($class_uids);
		// echo $class_uids;exit;
		$userip = $_SERVER['REMOTE_ADDR'];
		$rTime = time();

		$sql = "INSERT INTO ks_order (status, userid, orderId, class_uids, title, price, discountPrice, use_point, use_coupon_price, use_coupon_uid, amount, userip, rTime) VALUES ";
		$sql .= "(0, '$userid', '$orderId', '$class_uids', '$orderName', $price, $discountPrice, $use_point, '$use_coupon_price', '$use_coupon_uid', $amount, '$userip', $rTime)";
		$ks_order_result = sqlExe($sql);
		
		if ($ks_order_result) echo "SUCCESS";
		else echo "FAILED";
		exit;

		break;
		
	case 'PAY_CANCEL':
		if (!$class_uid) {
			Msg::GblMsgBoxParent('상품을 선택하세요.', "location.reload()");
			exit;
		}
		$sql = "DELETE FROM ks_cart WHERE userid='$userid'";
		$sql .=  " AND pid=$class_uid";

		$result_del = sqlExe($sql);
		if ($result_del) {
			Msg::goKorea('/mypage/cart/');
		} else {
			Msg::GblMsgBoxParent('삭제 오류', "location.reload()");
		}

		break;
}