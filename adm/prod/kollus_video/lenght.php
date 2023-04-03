<?php

// kollus CMS 설정 페이지에서 API 접근 토큰을 확인 할 수 있습니다.
$access_token = 'php1cvcypd9msm8u';

// http endpoint API call
// $api_url = 'http://api.kr.kollus.com/0/media_auth/upload/create_url.json?access_token=' . $access_token;
$api_url = "https://api-vod-kr.kollus.com/api/v0/vod/media-contents/" . $upload_file_key . "?access_token=" . $access_token;
$params = array();
// $params = array(
// 	'expire_time' => 600,			// 값의 범위는 0 < expire_time <= 21600 입니다. 빈값을 보내거나 항목 자체를 제거하면 기본 600초로 설정됩니다.
// 	'category_key' => '{CATEGORY_KEY}',			// 업로드한 파일이 속할 카테고리의 키(API를 이용하여 확득 가능)입니다. 빈값을 보내거나 항목 자체를 제거하면 '없음'에 속합니다.

// 	'title' => '{TITLE}',					// 입력한 제목을 컨텐츠의 제목으로 강제지정합니다. 이 값을 보내지 않거나 빈값으로 보내면 기본적으로 파일명이 제목으로 사용됩니다.
// 	'is_encryption_upload' => 1,	// 0은 일반 업로드, 1은 암호화 업로드입니다. 암호화 업로드시 파일이 암호화 되어 Kollus의 전용 플레이어로만 재생됩니다.
// 	'is_audio_upload' => 0			// 0은 비디오 업로드, 1은 음원 파일 업로드입니다.
// );

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

$api_url = "https://api-vod-kr.kollus.com/api/v0/vod/media-contents/" . $upload_file_key . "?access_token=" . $access_token;


$http_result = http_curl_request($api_url, $params);
if ($http_result) {
    $http_result = json_decode($http_result);
    $data = $http_result->data;

    $length = $data->media_information->video->duration;

    // if ($result->error == '0') {
    //     $data = $result->result;
    // } else {
    //     // 에러 발생 시 처리는 내부 로직으로 변경하여 처리해주세요.
    //     echo '<pre>';
    //     print_r($result);
    //     echo '</pre>';
    // }
} else {
    // 에러 발생 시 처리는 내부 로직으로 변경하여 처리해주세요.
}
