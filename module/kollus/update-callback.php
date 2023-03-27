<?php
http_response_code(200);
include "/home/edufim/www/module/class/class.DbCon.php";
include './config.php';

if (isset($_POST['content_provider_key']) && $_POST['content_provider_key'] === $securityKey) {
    $update_type = $_POST['update_type'];
    $upload_file_key = $_POST['upload_file_key'];
    $set = "";
    foreach ($_POST as $k => $v) {
        $set .= "$k='$v',";
    }
    $set = substr($set, 0, -1);

    if ($update_type == 'content_enable') {
        $query = "UPDATE kollus_video SET status=2, $set WHERE upload_file_key='$upload_file_key'";
    } elseif ($update_type == 'content_disable') {
        $query = "UPDATE kollus_video SET status=3, $set WHERE upload_file_key='$upload_file_key'";
    } elseif ($update_type == 'content_delete') {
        $query = "DELETE FROM kollus_video WHERE upload_file_key='$upload_file_key'";
    } elseif ($update_type == 'content_poster') {
        $snapshot_url = get_media_content($upload_file_key)['snapshot_url'];
        $query = "UPDATE kollus_video SET snapshot_url='$snapshot_url', $set WHERE upload_file_key='$upload_file_key'";
    } else {
        kollus_log('This update_callback_type is not proccessed');
        exit;
    }
    sqlExe($query);
} else {
    http_response_code(404);
}
