<?
include '/home/edufim/www/header.php';
include '/home/edufim/www/module/loading.php';

foreach($_POST as $k => $v){
	echo "$k : $v <br>";
}
exit;
/* 
==========================================================================
        결제 API URL                                                                 
--------------------------------------------------------------------------
*/
$target_URL = "https://stg-spl.kcp.co.kr/gw/enc/v1/payment"; // 개발서버
//$target_URL = "https://spl.kcp.co.kr/gw/enc/v1/payment"; // 운영서버
/* 
==========================================================================
        요청정보                                                                
--------------------------------------------------------------------------
*/
$tran_cd            = $_POST[ "tran_cd"  ]; // 요청코드
$site_cd            = $_POST[ "site_cd"  ]; // 사이트코드
// 인증서 정보(직렬화)
$kcp_cert_info      = "-----BEGIN CERTIFICATE-----MIIDgTCCAmmgAwIBAgIHBy4lYNG7ojANBgkqhkiG9w0BAQsFADBzMQswCQYDVQQGEwJLUjEOMAwGA1UECAwFU2VvdWwxEDAOBgNVBAcMB0d1cm8tZ3UxFTATBgNVBAoMDE5ITktDUCBDb3JwLjETMBEGA1UECwwKSVQgQ2VudGVyLjEWMBQGA1UEAwwNc3BsLmtjcC5jby5rcjAeFw0yMTA2MjkwMDM0MzdaFw0yNjA2MjgwMDM0MzdaMHAxCzAJBgNVBAYTAktSMQ4wDAYDVQQIDAVTZW91bDEQMA4GA1UEBwwHR3Vyby1ndTERMA8GA1UECgwITG9jYWxXZWIxETAPBgNVBAsMCERFVlBHV0VCMRkwFwYDVQQDDBAyMDIxMDYyOTEwMDAwMDI0MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAppkVQkU4SwNTYbIUaNDVhu2w1uvG4qip0U7h9n90cLfKymIRKDiebLhLIVFctuhTmgY7tkE7yQTNkD+jXHYufQ/qj06ukwf1BtqUVru9mqa7ysU298B6l9v0Fv8h3ztTYvfHEBmpB6AoZDBChMEua7Or/L3C2vYtU/6lWLjBT1xwXVLvNN/7XpQokuWq0rnjSRThcXrDpWMbqYYUt/CL7YHosfBazAXLoN5JvTd1O9C3FPxLxwcIAI9H8SbWIQKhap7JeA/IUP1Vk4K/o3Yiytl6Aqh3U1egHfEdWNqwpaiHPuM/jsDkVzuS9FV4RCdcBEsRPnAWHz10w8CX7e7zdwIDAQABox0wGzAOBgNVHQ8BAf8EBAMCB4AwCQYDVR0TBAIwADANBgkqhkiG9w0BAQsFAAOCAQEAg9lYy+dM/8Dnz4COc+XIjEwr4FeC9ExnWaaxH6GlWjJbB94O2L26arrjT2hGl9jUzwd+BdvTGdNCpEjOz3KEq8yJhcu5mFxMskLnHNo1lg5qtydIID6eSgew3vm6d7b3O6pYd+NHdHQsuMw5S5z1m+0TbBQkb6A9RKE1md5/Yw+NymDy+c4NaKsbxepw+HtSOnma/R7TErQ/8qVioIthEpwbqyjgIoGzgOdEFsF9mfkt/5k6rR0WX8xzcro5XSB3T+oecMS54j0+nHyoS96/llRLqFDBUfWn5Cay7pJNWXCnw4jIiBsTBa3q95RVRyMEcDgPwugMXPXGBwNoMOOpuQ==-----END CERTIFICATE-----";
$enc_data           = $_POST[ "enc_data" ]; // 암호화 인증데이터
$enc_info           = $_POST[ "enc_info" ]; // 암호화 인증데이터  
// $ordr_mony          = "1"; // 결제요청금액   ** 1 원은 실제로 업체에서 결제하셔야 될 원 금액을 넣어주셔야 합니다. 결제금액 유효성 검증 **
$ordr_mony          = $_POST['good_mny'];
/* = -------------------------------------------------------------------------- = */
$use_pay_method     = $_POST[ "use_pay_method" ]; // 결제 방법
$ordr_idxx          = $_POST[ "ordr_idxx" ]; // 주문번호

$data = array( "tran_cd"        => $tran_cd, 
                "site_cd"        => $site_cd,
                "kcp_cert_info"  => $kcp_cert_info,
                "enc_data"       => $enc_data,
                "enc_info"       => $enc_info,
                "ordr_mony"      => $ordr_mony
                );

$req_data = json_encode($data);

$header_data = array( "Content-Type: application/json", "charset=utf-8" );

// API REQ
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_URL);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $req_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// API RES
$res_data  = curl_exec($ch); 

/* 
==========================================================================
응답정보                                                               
--------------------------------------------------------------------------
*/
// 공통
$res_cd         = "";
$res_msg        = "";
$res_en_msg     = "";
$tno            = "";
$amount         = "";
$app_time       = ""; // 공통(카드:승인시간,계좌이체:계좌이체시간,가상계좌:가상계좌 채번시간)
// 카드
$card_cd     = ""; // 카드코드
$card_name   = ""; // 카드사
$app_no      = ""; // 승인번호
$quota       = ""; // 할부개월
$noinf       = ""; // 무이자여부
// 포인트
$pnt_issue        = ""; // 포인트 서비스사
$add_pnt          = ""; // 발생 포인트
$use_pnt          = ""; // 사용가능 포인트
$rsv_pnt          = ""; // 적립 포인트
$pnt_app_time     = ""; // 승인시간
$pnt_app_no       = ""; // 승인번호
$pnt_amount       = ""; // 적립금액 or 사용금액
// 계좌이체
$bank_name        = ""; // 은행명
$bank_code        = ""; // 은행코드
// 가상계좌
$bankname         = ""; // 입금할 은행
$bankcode         = ""; // 입금할 은행코드
$depositor        = ""; // 입금할 계좌 예금주
$account          = ""; // 입금할 계좌 번호
$va_date          = ""; // 가상계좌 입금마감시간
// 휴대폰
$commid           = ""; // 통신사 코드
$mobile_no        = ""; // 휴대폰 번호
// 상품권
$tk_van_code      = ""; // 발급사 코드
$tk_app_no        = ""; // 승인 번호
$tk_app_time      = ""; // 상품권 승인시간
// 현금 영수증
$cash_yn        = $_POST[ "cash_yn"        ]; // 현금 영수증 등록 여부
$cash_tr_code   = $_POST[ "cash_tr_code"   ]; // 현금 영수증 발행 구분
$cash_id_info   = $_POST[ "cash_id_info"   ]; // 현금 영수증 등록 번호
$cash_authno    = ""; // 현금 영수증 승인 번호
$cash_no        = ""; // 현금 영수증 거래 번호    

// RES JSON DATA Parsing
$json_res = json_decode($res_data, true);

$res_cd = $json_res["res_cd"];
$res_msg = $json_res["res_msg"];

if ( $res_cd == "0000" )
{
    $tno       = $json_res["tno"];
    $res_cd    = $json_res["res_cd"];
    $res_msg   = $json_res["res_msg"];
    $amount    = $json_res["amount"];
    
    // 카드
    if ( $use_pay_method == "100000000000" )
    {
        $card_cd   = $json_res["card_cd"];
        $card_name = $json_res["card_name"];
        $app_no    = $json_res["app_no"];
        $app_time  = $json_res["app_time"];
        $noinf     = $json_res["noinf"];
        $quota     = $json_res["quota"];
        // 포인트 복합결제
        $pnt_issue = $json_res["pnt_issue"];
        if ( $pnt_issue == "SCSK" || $pnt_issue ==  "SCWB" )
        {
            $pnt_issue    = $json_res["pnt_issue"];
            $add_pnt      = $json_res["add_pnt"];
            $use_pnt      = $json_res["use_pnt"];
            $rsv_pnt      = $json_res["rsv_pnt"];
            $pnt_app_time = $json_res["pnt_app_time"];
            $pnt_app_no   = $json_res["pnt_app_no"];
            $pnt_amount   = $json_res["pnt_amount"];
            // 현금영수증 발급시
            if ( $cash_yn == "Y" )
            {
                $cash_authno = $json_res["cash_authno"];
                $cash_no     = $json_res["cash_no"];
            }
        }
    }
    // 계좌이체
    else if ( $use_pay_method == "010000000000" )
    {
        $bank_name = $json_res["bank_name"];
        $bank_code = $json_res["bank_code"];
        $app_time  = $json_res["app_time"];
        
        // 현금영수증 발급시
        if ( $cash_yn == "Y" )
        {
            $cash_authno = $json_res["cash_authno"];
            $cash_no     = $json_res["cash_no"];
        }
    }
    // 가상계좌
    else if ( $use_pay_method == "001000000000" )
    {
        $bankname  = $json_res["bankname"];
        $bankcode  = $json_res["bankcode"];
        $depositor = $json_res["depositor"];
        $account   = $json_res["account"];
        $va_date   = $json_res["va_date"];
        $app_time  = $json_res["app_time"];
        
        // 현금영수증 발급시
        if ( $cash_yn == "Y" )
        {
            // 현금영수증 발급 후 처리
            //$cash_authno = $json_res["cash_authno"];
            //$cash_no     = $json_res["cash_no"];
        }
    }
    // 포인트
    else if ( $use_pay_method == "000100000000" )
    {
        $pnt_issue    = $json_res["pnt_issue"];
        $add_pnt      = $json_res["add_pnt"];
        $use_pnt      = $json_res["use_pnt"];
        $rsv_pnt      = $json_res["rsv_pnt"];
        $pnt_app_time = $json_res["pnt_app_time"];
        $pnt_app_no   = $json_res["pnt_app_no"];
        $pnt_amount   = $json_res["pnt_amount"];
        // 현금영수증 발급시
        if ( $cash_yn == "Y" )
        {
            $cash_authno = $json_res["cash_authno"];
            $cash_no     = $json_res["cash_no"];
        }
    }
    // 휴대폰
    else if ( $use_pay_method == "000010000000" )
    {
        $app_time    = $json_res["app_time"];
        $commid      = $json_res["commid"];
        $mobile_no   = $json_res["mobile_no"];
    }
    // 상품권
    else if ( $use_pay_method == "000000001000" )
    {
        $tk_van_code  = $json_res["tk_van_code"];
        $tk_app_no    = $json_res["tk_app_no"];
        $tk_app_time  = $json_res["tk_app_time"];
    }

	$userip = $_SERVER['REMOTE_ADDR'];
	$rTime = time();

	$sql = "INSERT INTO ks_order (order_no, status, userid, class_uids, title, price, discountPrice, use_point, use_coupon_price, use_coupon_uid, amount, res_data, userip, rTime) VALUES ";
    $sql .= "('$order_no', '1', '$userid', '$class_uids', '$orderName', '$price', '$discountPrice', '$use_point', '$use_coupon_price', '$use_coupon_uid', '$amount', '$res_data', '$userip', $rTime)";
    $result = mysql_query($sql);
}

curl_close($ch);

/* 
==========================================================================
        승인 결과 DB 처리 실패시 : 자동취소
--------------------------------------------------------------------------
        승인 결과를 DB 작업 하는 과정에서 정상적으로 승인된 건에 대해
DB 작업을 실패하여 DB update 가 완료되지 않은 경우, 자동으로
        승인 취소 요청을 하는 프로세스가 구성되어 있습니다.

DB 작업이 실패 한 경우, bSucc 라는 변수(String)의 값을 "false"
        로 설정해 주시기 바랍니다. (DB 작업 성공의 경우에는 "false" 이외의
        값을 설정하시면 됩니다.)
--------------------------------------------------------------------------
*/

if ($result) $bSucc = "true";
else $bSucc = "false";

if ( $res_cd == "0000" )
{
    if ( $bSucc == "false")
    {
        $res_data      = "";
        $req_data      = "";
        $kcp_sign_data = "";
        /* 
        ==========================================================================
        취소 API URL                                                           
        --------------------------------------------------------------------------
        */
        $target_URL = "https://stg-spl.kcp.co.kr/gw/mod/v1/cancel"; // 개발서버
        //$target_URL = "https://spl.kcp.co.kr/gw/mod/v1/cancel"; // 운영서버
        
        // 서명데이터생성에시
        // site_cd(사이트코드) + "^" + tno(거래번호) + "^" + mod_type(취소유형)
        // NHN KCP로부터 발급받은 개인키(PRIVATE KEY)로 SHA256withRSA 알고리즘을 사용한 문자열 인코딩 값
        $cancel_target_data = $site_cd . "^" . $tno . "^" . "STSC";
        /*
            ==========================================================================
            privatekey 파일 read
            --------------------------------------------------------------------------
            */
        // $key_data = file_get_contents('C:\...\php_kcp_api_pay_sample\certificate\splPrikeyPKCS8.pem');
        $key_data = file_get_contents('.\certificate\splPrikeyPKCS8.pem');
        
        /*
            ==========================================================================
            privatekey 추출
            'changeit' 은 테스트용 개인키비밀번호
            --------------------------------------------------------------------------
            */
        $pri_key = openssl_pkey_get_private($key_data,'changeit');
        
        /*
            ==========================================================================
            sign data 생성
            --------------------------------------------------------------------------
            */
        // 결제 취소 signature 생성
        openssl_sign($cancel_target_data, $signature, $pri_key, 'sha256WithRSAEncryption');
        //echo "cancel_signature :".base64_encode($signature)."<br><br>";
        $kcp_sign_data = base64_encode($signature);
        
        $data = array(
            "site_cd"        => $site_cd,
            "kcp_cert_info"  => $kcp_cert_info,
            "kcp_sign_data"  => $kcp_sign_data,
            "tno"            => $tno,
            "mod_type"       => "STSC",
            "mod_desc"       => "가맹점 DB 처리 실패(자동취소)"
        );
        
        $req_data = json_encode($data);
        
        $header_data = array( "Content-Type: application/json", "charset=utf-8" );
        
        // API REQ
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_URL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        // API RES
        $res_data  = curl_exec($ch);
        
        // RES JSON DATA Parsing
        $json_res = json_decode($res_data, true);
        
        $res_cd = $json_res["res_cd"];
        $res_msg = $json_res["res_msg"];

        curl_close($ch); 
    }
}
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
            include 'sidemenu.php';

            $userid = $GBL_USERID;

            if (!$paymentKey || !$orderId || !$amount) {
                deny();
                exit;
            } else {
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
                $isSuccess = ($httpCode === 200);
                curl_close($curl);
                $resJson = json_decode($response, true);
            }

            // ks_payment DB insert
            if ($isSuccess) {
                $orderId = $resJson['orderId'];
                $totalAmount = $resJson['totalAmount'];
                $method = $resJson['method'];
                $approvedAt = date('Y-m-d H:i:s', strtotime($resJson['approvedAt']));
                $receiptUrl = $resJson['receipt']['url'];
                $userip = $_SERVER['REMOTE_ADDR'];
                $rTime = time();

                $sql = "insert into ks_payment (userid, orderId, paymentKey, totalAmount, method, approvedAt, receiptUrl, response, userip, rTime) values ";
                $sql .= "('$userid', '$orderId', '$paymentKey', $totalAmount, '$method', '$approvedAt', '$receiptUrl', '$response', '$userip', $rTime)";
                sqlExe($sql);
            } else {
                /*
                $msg = "결제에 실패했습니다-paymentdb";
                $url = "/mypage/cart.php";
                Msg::goMsg($msg, $url);
                exit;
                */
            }

            // ks_learning DB insert
            if ($isSuccess) {
                $row_one = sqlRowOne("SELECT class_uids FROM ks_order WHERE orderId='$orderId'");

                $class_uids = json_decode($row_one);

                foreach ($class_uids as $key => $class_uid) {
                    $period = sqlRowOne("SELECT period FROM ks_class WHERE uid='$class_uid'");
                    $period = intval($period) + 1;

                    $sDate = date('Y-m-d h:i:s', $rTime);
                    $timestamp = strtotime("+$period days", strtotime($sDate));
                    $eDate = date("Y-m-d 23:59:59", $timestamp);

                    // $MAP_INSERT = sqlExe("INSERT INTO MAP_MEMBER_CLASS (USERID, CLASS_UID, orderId, sDate, eDate) VALUES ('$userid', '$class_uid', '$orderId', '$sDate', '$eDate')");

                    // $learning_insert = sqlExe("INSERT INTO ks_learning (userid, class_uid, rTime) VALUES ('$userid', $class_uid, $rTime)");

                    $learning_insert = sqlExe("INSERT INTO ks_learning (userid, class_uid, orderId, sDate, eDate) 
                        VALUES ('$userid', '$class_uid', '$orderId', '$sDate', '$eDate')");

                    $learning_uid = sqlRowOne("SELECT uid FROM ks_learning WHERE userid='$userid' AND class_uid='$class_uid' AND sDate='$sDate'");

                    $class_list_uids = sqlArray("SELECT uid FROM ks_class_list WHERE class_uid=$class_uid");

                    foreach ($class_list_uids as $uids) {
                        $uid = $uids['uid'];
                        $learning_list_insert = sqlExe("INSERT INTO ks_learning_list (learning_uid, class_list_uid) VALUES ($learning_uid, $uid)");
                    }
                }
                sqlExe("UPDATE ks_order SET status=1 WHERE orderId='$orderId'");
                sqlExe("DELETE FROM ks_cart WHERE userid='$userid' AND pid=$class_uid");
                $use_coupon_uid = sqlRowOne("SELECT use_coupon_uid FROM ks_order WHERE status=1 AND orderId='$orderId'");
                sqlExe("UPDATE ks_coupon_list SET status=1 WHERE userid='$userid' AND coupon_uid='$use_coupon_uid'");
            }

            if ($isSuccess && !$learning_insert) {
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
                $cancelResponse = curl_exec($curl);
                $cancelErr = curl_error($curl);
                curl_close($curl);
            }
        ?>

        <!-- Content Wrapper -->
        <div class="s_cont">
            <!-- Main Content -->
            <div class="s_cont_tit f20 bold2 c_bora01">강좌 결제</div>
            <div class="payResult_Wrap">
                <?
                if ($isSuccess) {
                ?>
                    <div class="payResult_box">
                        <h2 class="tit">결제가 완료 되었습니다</h2>
                        <p>주문번호: <?= $orderId ?></p>
                        <p>결제일시: <?= $approvedAt ?></p>
                        <p>결제수단: <?= $method ?></p>
                        <p>결제금액: <span class="pay-success-num"><?= number_format($totalAmount) ?></span> P</p>
                        <a href="/mypage/learning/" class="classBtn bora dp_inline dp_c dp_cc c_w">수강하러가기</a>
                    </div>
                <?
                } else { ?>
                    <div class="payResult_box" style="display: none;">
                        <h2>결제에 실패 하였습니다.</h2>
                        <p>에러코드: <?= $resJson['code'] ?></p>
                        <p>에러메시지: <?= $resJson['message'] ?></p>
                        <p>결제 오류 발생 시 예약센터로 문의주시기 바랍니다.</p>
                        <p><?= $errorMsg ?></p>
                        <p><?= $cancelResponse ?></p>
                        <p><?= $cancelErr ?></p>
                        <a href="/" class="classBtn gry03 dp_inline dp_c dp_cc c_w">홈으로</a>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>
<?
include '/home/edufim/www/footer.php';
?>