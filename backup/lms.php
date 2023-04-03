<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/kollus/config.php";

// $class_list_uid = $_POST['class_list_uid'];
$class_list_uid = 1;
$class_list_row = sqlRow("SELECT * FROM ks_class_list WHERE uid=$class_list_uid");

$mediaContentKey = $class_list_row['media_content_key'];
// $clientUserId = $GBL_USERID;
$clientUserId = 'iweb';
$expireTime = 60; // 120 min

$mediaItems = array(
    array(
        'media_content_key' => $mediaContentKey,
        'intr' => true,
        'is_seekable' => true,
    ),
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

$customKey = '156789126bb13feaa49d68c402f42b578edea889e48640ecfd3d8dcf5ce7dfd5';

// $uservalue0 = $GBL_USERID;
// $uservalue = "&uservalue0=$uservalue0";

if (!isset($uservalue)) $uservalue = '';

$webTokenURL = 'http://v.kr.kollus.com/s?&jwt=' . $jwtToken . '&custom_key=' . $customKey . $uservalue;

echo $webTokenURL;

?>
<br>
<iframe src="<?php echo $webTokenURL; ?>" allowfullscreen width="720" height="480"></iframe>
