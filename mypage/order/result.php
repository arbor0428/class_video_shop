<?
header("Content-type: text/html; charset=utf-8");

include '/home/edufim/www/header.php';
include '/home/edufim/www/module/loading.php';

if (!isset($GBL_USERID) || !isset($ordr_idxx) || !isset($good_mny)) deny();
if (sqlRowOne("SELECT COUNT(1) FROM ks_order WHERE order_no='$ordr_idxx'") > 0) $MSG->goMsg('결제가 만료되었습니다.', '/mypage/learning/');

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

/**
 * - 신용카드 : 100000000000
 * - 계좌이체 : 010000000000
 * - 가상계좌 : 001000000000
 * - 포인트 : 000100000000
 * - 휴대폰 : 000010000000
 * - 상품권 : 000000001000
 * {
 *     "order_no": "2023031679884274",
 *     "mall_taxno": "1138521083",
 *     "partcanc_yn": "Y",
 *     "noinf": "N",
 *     "res_msg": "정상처리",
 *     "coupon_mny": "0",
 *     "isp_issuer_cd": "KM04",
 *     "pg_txid": "0327113214MP01986737470000000010000082050813",
 *     "card_bin_type_01": "0",
 *     "trace_no": "T00000RBWE0McICk",
 *     "card_mny": "1000",
 *     "res_vat_mny": "91",
 *     "ca_order_id": "2023031679884274",
 *     "res_tax_flag": "TG03",
 *     "acqu_name": "국민카드",
 *     "card_no": "5272890000006055",
 *     "quota": "00",
 *     "van_cd": "VNKC",
 *     "isp_partner_cd": "050204040016641",
 *     "acqu_cd": "CCKM",
 *     "amount": "1000",
 *     "cert_no": "23336986737476",
 *     "van_apptime": "20230327113214",
 *     "isp_issuer_nm": "KB 국민카드",
 *     "res_free_mny": "0",
 *     "pay_method": "PACA",
 *     "card_bin_bank_cd": "0004",
 *     "bizx_numb": "00013219101",
 *     "res_cd": "0000",
 *     "escw_yn": "N",
 *     "join_cd": "0000",
 *     "app_time": "20230327113214",
 *     "tno": "23336986737476",
 *     "card_bin_type_02": "1",
 *     "card_cd": "CCKM",
 *     "res_en_msg": "processing completed",
 *     "card_name": "국민카드",
 *     "mcht_taxno": "1138521083",
 *     "res_green_deposit_mny": "0",
 *     "res_tax_mny": "909",
 *     "app_no": "82050813"
 * }
 */
if ( $res_cd == "0000" )
{
    $tno       = $json_res["tno"];
    $res_cd    = $json_res["res_cd"];
    $res_msg   = $json_res["res_msg"];
    $amount    = $json_res["amount"];
    $order_no    = $json_res["order_no"];

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
}

// Edufim mysql DB processing

$bSucc = "true";
$userid = $GBL_USERID;
$userip = $_SERVER['REMOTE_ADDR'];
$rTime = time();

if ( $res_cd == "0000" )
{
    // Insert
    if ($ordr_idxx != $order_no  || $good_mny != $amount) {
        $bSucc = "false";

    } else {
        // 1. INSERT ks_order
        $query = "INSERT INTO ks_order (order_no, status, tno, res_cd, res_msg, userid, class_uids, title, price, discountPrice, use_point, use_coupon_price, use_coupon_uid, amount, req_data, res_data, userip, rTime) VALUES ";
        $query .= "('$order_no', 'ORDER_SUCCESS', '$tno', '$res_cd', '$res_msg', '$userid', '$class_uids', '$orderName', '$price', '$discountPrice', '$use_point', '$use_coupon_price', '$use_coupon_uid', '$amount', '$req_data', '$res_data', '$userip', $rTime)";
        mysql_query($query) or die(mysql_error());

        $class_uids_arr = explode('|', $class_uids);
        foreach ($class_uids_arr as $key => $class_uid) {
            $query = "SELECT period FROM ks_class WHERE uid='$class_uid'";
            $result = mysql_query($query) or die(mysql_error());
            $period = mysql_fetch_row($result)[0];
    
            $sDate = date('Y-m-d h:i:s', $rTime);
            $tmpTime = strtotime("+$period days", $rTime);

            $eDate = date("Y-m-d 23:59:59", $tmpTime);
            $eTime = strtotime($eDate);
    
            // 2. INSERT ks_learning
            $query = "INSERT INTO ks_learning (status, userid, class_uid, order_no, sDate, sTime, eDate, eTime)";
            $query .= " VALUES ('0', '$userid', '$class_uid', '$order_no', '$sDate', '$rTime', '$eDate', '$eTime')";
            mysql_query($query) or die(mysql_error());

            // 2.5. INSERT ks_learning_list
            // $learning_uid = sqlRowOne("SELECT uid FROM ks_learning WHERE userid='$userid' AND class_uid='$class_uid' AND sDate='$sDate'");
            // $class_list_uids = sqlArray("SELECT uid FROM ks_class_list WHERE class_uid=$class_uid");
            // foreach ($class_list_uids as $uids) {
            //     $uid = $uids['uid'];
            //     $learning_list_insert = sqlExe("INSERT INTO ks_learning_list (learning_uid, class_list_uid) VALUES ($learning_uid, $uid)");
            // }
            
            // 3. DELETE ks_cart
            mysql_query("DELETE FROM ks_cart WHERE userid='$userid' AND class_uid='$class_uid'") or die(mysql_error());

        }

        // 4. UPDATE ks_coupon_log
        if ($use_coupon_uid) mysql_query("UPDATE ks_coupon_log SET status=2, order_no='$order_no', userip='$userip', uTime='$rTime' WHERE userid='$userid' AND coupon_uid='$use_coupon_uid'");

        // 5. INSERT ks_point and Update ks_member
        if ($use_point && intval($use_point) > 0) {
            $member_point = mysql_fetch_row(mysql_query("SELECT point FROM ks_member WHERE userid='$userid'") or die(mysql_error()))[0];

            $point = intval($member_point) - intval($use_point);
            if ($point < 0 ) $point = 0;

            mysql_query("INSERT INTO ks_point (userid, ptype, point, content, order_no) VALUES ('$userid', 'M', '$use_point', '적립금 결제', '$order_no')");
            mysql_query("UPDATE ks_member SET point='$point' WHERE userid='$userid'");
        }
        
    }
    
}
else
{
    // INSERT ks_order - kcp response error
    $query = "INSERT INTO ks_order (order_no, status, tno, res_cd, res_msg, userid, req_data, res_data, userip, rTime) VALUES ";
    $query .= "('$order_no', 'ORDER_FAIL', '$tno', '$res_cd', '$res_msg', '$userid', '$req_data', '$res_data', '$userip', $rTime)";
    $result = mysql_query($query) or $MSG->goMsg("결제 시스템 점검중입니다.\n홈페이지에 문의 바랍니다.", "/");
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
        ?>

        <!-- Content Wrapper -->
        <div class="s_cont">
            <!-- Main Content -->
            <div class="s_cont_tit f20 bold2 c_bora01">강좌 결제</div>
            <div class="payResult_Wrap">
                <?
                if ( $res_cd == "0000" ) {
                ?>
                    <div class="payResult_box">
                        <h2 class="tit">결제가 완료 되었습니다</h2>
                        <p>결과메세지: <?= $res_msg ?></p>
                        <p>주문번호: <?= $order_no ?></p>
                        <p>결제일시: <?= date('Y-m-d H:i:s', strtotime($app_time)) ?></p>
                        <p>결제수단: <?= $card_name ?></p>
                        <p>결제금액: <span class="pay-success-num"><?= number_format($amount) ?></span> 원</p>
                        <a href="/mypage/learning/" class="classBtn bora dp_inline dp_c dp_cc c_w">수강하러가기</a>
                    </div>
                <?
                } else { ?>
                    <div class="payResult_box">
                        <h2>결제에 실패 하였습니다.</h2>
                        <p>결과코드: <?= $res_cd ?></p>
                        <p>결과메세지: <?= $res_msg ?></p>
                        <p>홈페이지로 문의주시기 바랍니다.</p>
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