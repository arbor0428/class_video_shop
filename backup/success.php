<?php
include '../../module/loading.php';

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

if (!$GBL_USERID) {
	header('Location:/');
	exit;
}

$paymentKey = $_GET['paymentKey'];
$orderId = $_GET['orderId'];
$amount = $_GET['amount'];
$userid = $GBL_USERID;

// echo "<script>console.log('$userid')</script>";

if ($paymentKey & $orderId & $amount) {
	$secretKey = 'test_sk_OALnQvDd2VJqkqN0p0N3Mj7X41mN';
	$credential = base64_encode($secretKey . ':');
} else {
	$msg = "잘못된 접근입니다.";
	$url = "/adm/pointPay/";
	Msg::goMsg($msg, $url);
	exit;
}

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
// $err = curl_error($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$isSuccess = $httpCode == 200;
curl_close($curl);

$responseJson = json_decode($response, true);

$orderId = $responseJson['orderId'];
$totalAmount = $responseJson['totalAmount'];
$method = $responseJson['method'];
$approvedAt = date('Y-m-d H:i:s', strtotime($responseJson['approvedAt']));
$receiptUrl = $responseJson['receipt']['url'];


$result = 0;
// member db 포인트 추가
if ($isSuccess) {
	$userid = strtolower(addslashes(trim($userid)));
	$userid = str_replace(' ', '', $userid);
	// echo "<script>console.log('$userid')</script>";

	// $tmpChk = sqlRowOne("select count(*) from ks_member where userid='$userid'");
	// echo "<script>console.log('$tmpChk')</script>";
	// if ($tmpChk > 0) {
	// 	$msg = "사용할 수 없는 아이디입니다.";
	// 	Msg::backMsg($msg);
	// 	exit;
	// }

	$sql = "select * from ks_member where userid='$userid'";
	$row = sqlRow($sql);
	$beforePoint = $row['point'];

	$afterPoint = $beforePoint + $totalAmount;
	$sql = "update ks_member set point=$afterPoint where userid='$userid'";
	$result = sqlExe($sql);
	} else {
		$msg = "결제에 실패했습니다.";
		$url = "/adm/pointPay/";
		Msg::goMsg($msg, $url);
		exit;
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
?>

<div id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">
		<?
		$sideArr[7] = 'active';
		include '../sidemenu.php';
		?>

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
				<?
				include '../nav.php';
				?>
				<!-- Page Content -->
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm mb-4">
							<h4 class="ml-2 font-weight-bold text-gray mb-4">포인트충전</h4>
							<div class="card shadow mb-4" style='margin-top:10px;'>
								<div class="card-header py-3 align-items-center justify-content-between">
									<div class="card-body">
										<?php
										if ($isSuccess && $result) {
										?>
											<h2 class="tit">결제가 완료 되었습니다</h2>
											<p>주문번호: <?= $orderId ?></p>
											<p>결제일시: <?= $approvedAt ?></p>
											<p>결제수단: <?= $method ?></p>
											<p>충전금액: <span class="pay-num"><?= number_format($totalAmount) ?></span> P</p>
											<p>포인트 내역: <span class="pay-num"><?= number_format($beforePoint) ?></span> P &#8594; <span class="pay-num"><?= number_format($afterPoint) ?></span> P</p>
										<?php
										} else { ?>
											<h2>결제에 실패 하였습니다.</h2>
											<p>에러코드: <?= $responseJson['code'] ?></p>
											<p>에러메시지: <?= $responseJson['message'] ?></p>
											<p>포인트 충전 오류 발생 시 예약센터로 문의주시기 바랍니다.</p>
										<?php
										}
										?>
										<div class="mb20">
											<a href="/adm/pointPay/" class="btn btn-secondary btn-icon-split">
												<span class="text">확인</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?
					include '../footer.php';
					?>
				</div>
				<!-- End of Content Wrapper -->

			</div>
			<!-- End of Page Wrapper -->

		</div>
	</div>