<?
// phpinfo();exit;
include "./module/class/class.DbCon.php";
include "./module/class/class.jUtil.php";

$data = '';

$null = replace_null($data);

is_null($null);
// var_dump(replaceNull2($data));
// var_dump(replaceNull3($data));

// echo "INSERT INTO ks_license (title, exp) VALUES ($null, 'NULL')";
// sqlExe("INSERT INTO ks_license (title, exp) VALUES ($null, 'NULL')");


// kollus CMS 설정 페이지에서 API 접근 토큰을 확인 할 수 있습니다.
// $access_token = 'php1cvcypd9msm8u';

// $upload_file_key = '20230302-f79y8jhm';

// // http endpoint API call
// $api_url = 'http://api.kr.kollus.com/0/media/library/media_content/' . $upload_file_key .'?access_token=' . $access_token;

// $result = http_curl_request($api_url);
// if ($result) {
//     $result = json_decode($result);
//     // var_dump($result);
//     echo '<pre>';
//     print_r($result);
//     echo '</pre>';
//     // if ($result->error == '0') {

//     // } else {
//         // 에러 발생 시 처리는 내부 로직으로 변경하여 처리해주세요.
//     // }
// } else {
//     // 에러 발생 시 처리는 내부 로직으로 변경하여 처리해주세요.
//     echo "error";
// }

// function http_curl_request($url, $params = array())
// {
//     $curl = curl_init();

//     // request
//     curl_setopt($curl, CURLOPT_URL, $url);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
//     if (count($params) > 0) {
//         curl_setopt($curl, CURLOPT_POST, TRUE);
//         curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
//     }
//     $response = curl_exec($curl);

//     // response
//     $info = curl_getinfo($curl);

//     if (element('http_code', $info) != 200) {
//         return FALSE;
//     } else {
//         return $response;
//     }
// }

// function element($key, $array, $default = FALSE)
// {
//     return isset($array[$key]) ? $array[$key] : $default;
// }


// $query = "SELECT config_value FROM ks_config_sale WHERE config_key='signup_po1int'";
// $result = mysql_query($query) or die(mysql_error());
// $point = mysql_fetch_row($result)[0];
// if(empty($point)) $point = 0;
// var_dump($point);
/*
$rTime = time();
$rDate = date('Y-m-d h:i:s', 1678373999);

// echo $rTime.'<br>';
echo $rDate.'<br>';

$query = "SELECT s.config_value, c.discountPeriod FROM ks_config_sale s JOIN ks_coupon c ON s.config_value=c.uid WHERE s.config_key='signup_coupon'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_row($result);
    $coupon_uid = $row[0];
    $discountPeriod = $row[1];

    $eTime = $rTime + (60 * 60 * 24 * intval($discountPeriod));
    echo $eTime;

    echo "<br><br>";

    $eTime = strtotime(date('Y-m-d 23:59:59', $eTime));
    echo date('Y-m-d H:i:s', $eTime);
    echo "<br><br>";

    echo date('Y-m-d H:i:s', 1678460399);

    if (!empty($coupon_uid)) {
        // sqlExe("INSERT INTO ks_coupon_list (status, userid, coupon_uid, rTime, eTime) VALUES (0, '$userid', '$coupon_uid', '$rTime', '$eTime')");
    }
*/
