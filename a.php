<?php

$access_token = 'php1cvcypd9msm8u';

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
$upload_file_key = '20230227-wz8iqlzu';
$api_url = "https://api-vod-kr.kollus.com/api/v0/vod/media-contents/" . $upload_file_key . "?access_token=" . $access_token;
// echo $api_url;
$params = array();

$result = http_curl_request($api_url, $params);
if ($result) {
    $result = json_decode($result);
    var_dump($result);
} else {
    // 에러 발생 시 처리는 내부 로직으로 변경하여 처리해주세요.
}
