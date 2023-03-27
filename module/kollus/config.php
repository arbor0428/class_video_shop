<?php

/**
 * video setting
 */
$access_token = 'php1cvcypd9msm8u';
$securityKey = 'edufim';
$expireTime = 60; // sec

define('_ACCESS_TOKEN', $access_token);
define('_SECRET_KEY', $securityKey);

/**
 * base64_urlencode
 *
 * @param string $str
 * @return string
 */
function base64_urlencode($str)
{
    return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
}

/**
 * jwt_encode
 *
 * @param array $payload
 * @param string $key
 * @return string
 */
function jwt_encode($payload, $key)
{
    $jwtHead = base64_urlencode(json_encode(array('typ' => 'JWT', 'alg' => 'HS256')));
    $jsonPayload = base64_urlencode(json_encode($payload));
    $signature = base64_urlencode(hash_hmac('SHA256', $jwtHead . '.' . $jsonPayload, $key, true));

    return $jwtHead . '.' . $jsonPayload . '.' . $signature;
}

function kollus_log($type = 'NULL', $errorLog = '')
{
    $str = "{";
    foreach ($_POST as $k => $v) {
        $str .= "$k : $v,";
    }
    foreach ($_GET as $k => $v) {
        $str .= "$k : $v,";
    }
    $str .= "}";

    $query = "INSERT INTO kollus_log (type, error_log, response) VALUES ('$type', '$errorLog', '$str')";
    sqlExe($query);
}

function http_curl_request($url, $params = array())
{
    $curl = curl_init();

    // request
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    if (count($params) > 0) {
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
    }
    $response = curl_exec($curl);

    // response
    $info = curl_getinfo($curl);
    if (element('http_code', $info) != 200) {
        return FALSE;
    } else {
        return $response;
    }
}

function element($key, $array, $default = FALSE)
{
    return isset($array[$key]) ? $array[$key] : $default;
}

function get_media_content($upload_file_key)
{
    global $access_token;
    $api_url = 'http://api.kr.kollus.com/0/media/library/media_content/' . $upload_file_key . '?access_token=' . $access_token;

    $result = http_curl_request($api_url);
    if ($result) {
        $result = json_decode($result);
        $snapshot_url = $result->result->item->snapshot_url;
        $length = round(($result->result->item->media_information->file->raw_duration) / 1000);
    } else {
        $snapshot_url = NULL;
        $length = 0;
    }
    
    $data = array(
        'snapshot_url' => $snapshot_url,
        'length' => $length,
    );

    return $data;
}
