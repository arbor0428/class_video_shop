<?php

include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

$secretKey = 'test_sk_OALnQvDd2VJqkqN0p0N3Mj7X41mN';
$credential = base64_encode($secretKey . ':');

// $orderId = $_GET['orderId'];
// $amount = $_GET['amount'];
// $paymentKey = $_GET['paymentKey'];

$credential = base64_encode($secretKey . ':');

if (!$paymentKey || !$orderId || !$orderId) {
	deny();
	exit;
}

$userid = $GBL_USERID;

// ks_order
if ($isSuccess) {

	$userip = $_SERVER['REMOTE_ADDR'];
	$rDate = date('Y-m-d H:i:s');

	$sql = "insert into ks_order (userid, status, class_uid, class_name, price, sale, point, coupon, amount, userip, orderTime) values ";
	$sql .= "('$userid', 0, '$class_uid', '$class_name', $price, $sale, $point, $coupon, $amount, '$userip', " . time() . ")";
	$ks_order_result = sqlExe($sql);
} else {
	$msg = "결제에 실패했습니다.";
	$url = "/mypage/cart/";
	Msg::goMsg($msg, $url);
	exit;
}

$secretKey = 'test_sk_OALnQvDd2VJqkqN0p0N3Mj7X41mN';
$credential = base64_encode($secretKey . ':');

// 결제 요청
$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://api.tosspayments.com/v1/payments/confirm",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "{\"paymentKey\":\"$paymentKey\",\"amount\":$amount,\"orderId\":\"$orderId\"}",
	CURLOPT_HTTPHEADER => [
		"Authorization: Basic $credential",
		"Content-Type: application/json"
	],
]);
$response = curl_exec($curl);
$err = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

$isSuccess = ($httpCode == 200);
curl_close($curl);


$responseJson = json_decode($response, true);

$orderId = $responseJson['orderId'];
$totalAmount = $responseJson['totalAmount'];
$method = $responseJson['method'];
$approvedAt = date('Y-m-d H:i:s', strtotime($responseJson['approvedAt']));
$receiptUrl = $responseJson['receipt']['url'];



if ($ks_order_result) {
	$pid = sqlRowOne("select uid from ks_order where rTime=$rTime");

	$sql = "insert into ks_payment (pid, order_id, payment_key, amount, method, approvedAt, receiptUrl, response, rDate, rTime) values ";
	$sql .= "($pid, '$orderId', '$paymentKey', $totalAmount, '$method', '$approvedAt', '$receiptUrl', '$response', '$rDate', $rTime)";
	sqlExe($sql);
} else {
}


// pointList db 내역 추가
if ($result) {
	$pid = 0;
	$ptype = 'P';
	$pMent = "포인트 충전";

	$userip = $_SERVER['REMOTE_ADDR'];
	$rDate = date('Y-m-d H:i:s');
	$rTime = time();

	$sql = "insert into ks_pointList (pid, userid, ptype, point, afterPoint, pMent, userip, rDate, rTime) values ";
	$sql .= "('$pid','$userid','$ptype','$totalAmount','$afterPoint','$pMent','$userip','$rDate','$rTime')";
	sqlExe($sql);

	$pid = sqlRowOne("select uid from ks_pointList where rTime=$rTime");

	$sql = "insert into ks_pointPayList (pid, order_id, payment_key, amount, method, approvedAt, receiptUrl, response, rDate, rTime) values ";
	$sql .= "($pid, '$orderId', '$paymentKey', $totalAmount, '$method', '$approvedAt', '$receiptUrl', '$response', '$rDate', $rTime)";
	sqlExe($sql);
} else {
	// 결제 취소 요청
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://api.tosspayments.com/v1/payments/$paymentKey/cancel",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\"cancelReason\":\"DB error\"}",
		CURLOPT_HTTPHEADER => [
			"Authorization: Basic $credential",
			"Content-Type: application/json"
		],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		echo $response;
	}
}