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
$customKey = '72ccf63caa11078e5e2cc9f15bb41130';
$mediaContentKey = 'aYMlsPNr';
$clientUserId = 'iweb';
$expireTime = 7200; // 120 min
$mediaItems = array(
	array(
		'media_content_key' => $mediaContentKey,
    ),
	// array(
	// 	'media_content_key' => $otherMediaContentKey,
	// 	'intr' => true,
	// 	'is_seekable' => true,
	// ),
);

$payload = array(
    'mc' => array(),
    'cuid' => $clientUserId,
    'expt' => time() + $expireTime,
);

foreach ($mediaItems as $mediaItem) {
    $mcClaim = array();
    $mcClaim['mckey'] = $mediaItem['media_content_key'];
//    $mcClaim['mcpf'] = $mediaProfileKey;
//    $mcClaim['intr'] = (int)$mediaItem['is_intro'];
//    $mcClaim['seek'] = (int)$mediaItem['is_seekable'];
//    $mcClaim['seekable_end'] = $seekableEnd;
//    $mcClaim['disable_playrate'] = (int)$disablePlayrate;
    $payload['mc'][] = $mcClaim;
}

$jwtToken = jwt_encode($payload, $securityKey);

$webTokenURL = 'http://v.kr.kollus.com/s?jwt=' . $jwtToken . '&custom_key=' . $customKey . '&autoplay';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
    <iframe src="<?php echo $webTokenURL; ?>" width='960' height='540' allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>
</body>
</html>
