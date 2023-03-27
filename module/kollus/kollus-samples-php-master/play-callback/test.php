<?php
    /**
    * PHP Version : 5.4 above
    * by yupmin
    */
    include "./config.php";
    
    // 주의 : kind가 1일때 자동으로 expiration_date가 생성되는 샘플 페이지입니다.
    // 재생 제한 횟수
    $_default_expiration_count = 3;
    $_expired_duration = 60 * 60 * 24; // 1 day
    // DB Connection
    $_db_conn = mysql_connect($_hostname, $_username, $_password);
    if (!$_db_conn) {
   		die('Could not connect: ' . mysql_error());
    }
    $_db_selected = mysql_select_db($_database, $_db_conn);
    if (!$_db_selected) {
    	die ('Can\'t use database : ' . mysql_error());
    }
    $_kind = isset($_POST['kind']) ? ((int) $_POST['kind']) : NULL;
    $_media_content_key = isset($_POST['media_content_key']) ? $_POST['media_content_key'] : 		NULL;
    $_client_user_id = isset($_POST['client_user_id']) ? $_POST['client_user_id'] : NULL;
    
    $channel = NULL;
    $_query = sprintf("SELECT * FROM `channels` WHERE `media_content_key` = '%s'",
   		mysql_real_escape_string($_media_content_key, $_db_conn));
    $_result = mysql_query($_query, $_db_conn);
    if ($_result) {
   		$channel = mysql_fetch_array($_result, MYSQL_ASSOC);
    	if ($channel === FALSE) $channel = NULL;
    } else {
    	die('Invalid query: ' . mysql_error());
    }
    
    $user = NULL;
    $_query = sprintf("SELECT * FROM `users` WHERE `client_user_id` = '%s'",
    	mysql_real_escape_string($_client_user_id, $_db_conn));
    $_result = mysql_query($_query, $_db_conn);
    if ($_result) {
    	$channel = mysql_fetch_array($_result, MYSQL_ASSOC);
    	if ($channel === FALSE) $channel = NULL;
    } else {
    	die('Invalid query: ' . mysql_error());
    }
    
    $channel_user = NULL;
    if (!is_null($_media_content_key) && !is_null($_client_user_id)) {
    	$_query = sprintf("SELECT * FROM `channel_users` WHERE `user_id` = '%s', `channel_id` = 			'%s'",
    	$user['id'], $channel['id']);
    	$_result = mysql_query($_query, $_db_conn);
        if ($_result) {
        	$channel_user = mysql_fetch_array($_result, MYSQL_ASSOC);
            if ($channel_user === FALSE) $channel_user = NULL;
        } else {
        	die('Invalid query: ' . mysql_error());
        }
   	}
    $_json_result = array('result' => 0);
    switch($_kind) {
    case 1:
        if (is_null($channel_user)){
            $_expiration_date = time() + $_expired_duration;
            $_expiration_count = $_default_expiration_count;
            $_query = sprintf("INSERT INTO `channel_users`(`user_id`, `channel_id`, 						`expiration_date`
                ,`expiration_count` , `created_at`, `updated_at`) VALUES('%s', '%s', '%s', '%s', 			 UNIX_TIMESTAMP(),
                UNIX_TIMESTAMP())", $user['id'], $channel['id'], $_expiration_date, 						$_expiration_count);

            $_result = mysql_query($_query, $_db_conn);
             if (!$_result) {
                die('Invalid query: ' . mysql_error());
            }
        } else {
            $_expiration_date = $channel_user['expiration_date'];
            $_expiration_count = $channel_user['$expiration_count'];
        }
        $_json_result['expiration_date'] = (int) $_expiration_date;
        $_json_result['expiration_count'] = (int) $_expiration_count;
        break;
    case 3:
    	if (!is_null($channel_user) && $channel_user['is_expired']) {
    		$_json_result['content_expired'] = 1;
    	}
    	break;
    }
    
    // DB Close
    mysql_close($_db_conn);
    
    // json_encode된 결과를 kollus_encrypt를 통해 암호화시킴
    echo kollus_encrypt(json_encode($_json_encode));
