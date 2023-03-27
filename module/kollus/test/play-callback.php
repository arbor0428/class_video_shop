<?php

/**
 * base64_urlencode
 *
 * @param string $str
 * @return string
 */
function base64_urlencode($str) {
    return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
}

/**
 * jwt_encode
 *
 * @param array $payload
 * @param string $key
 * @return string
 */
function jwt_encode($payload, $key) {
    $jwtHead = base64_urlencode(json_encode(array('typ' => 'JWT', 'alg' => 'HS256')));
    $jsonPayload = base64_urlencode(json_encode($payload));
    $signature = base64_urlencode(hash_hmac('SHA256', $jwtHead . '.' . $jsonPayload, $key, true));

    return $jwtHead . '.' . $jsonPayload . '.' . $signature;
}

$securityKey = 'i-web';
$customKey = '675283b591d559e70fad9630c5453253';

$kind = isset($_POST['kind']) ? (int)$_POST['kind'] : null;
$clientUserId = isset($_POST['client_user_id']) ? $_POST['client_user_id'] : null;
$mediaContentKey = isset($_POST['media_content_key']) ? $_POST['media_content_key'] : null;

echo $kind;

echo $clientUserId;

echo $mediaContentKey;

$result = array(
    'data' => array()
);

$callbackResult = true;

switch($kind) {
    case 1:
        $result['data']['result'] =  (int)$callbackResult;
        $result['data']['expiration_date'] = time() + 60 * 10; // 10 min
        // TODO: try more options

        if (!$result['data']['result']) {
            $result['data']['message'] = 'This video is not permitted to you';
        }

        break;
    case 3:
        $result['data']['result'] =  (int)$callbackResult;
        // TODO: try more options

        if (!$result['data']['result']) {
            $result['data']['message'] = 'This video is not permitted to you';
        }

        break;
}

var_dump($result);
exit;
// header('Content-Type:text/plain; charset=utf-8');
header('X-Kollus-UserKey:' . $customKey);
// echo jwt_encode($result, $securityKey);
$jwtToken = jwt_encode($result, $securityKey);

$webTokenURL = 'http://v.kr.kollus.com/s?jwt=' . $jwtToken . '&autoplay';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div>
		dd
		<iframe src="<?php echo $webTokenURL; ?>" width="774" height="450" allowfullscreen></iframe>
	</div>
</body>
</html>
