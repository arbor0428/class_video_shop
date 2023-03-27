<?php
http_response_code(200);
include "/home/edufim/www/module/class/class.DbCon.php";
include './config.php';

if (isset($_POST['content_provider_key']) && $_POST['content_provider_key'] === $securityKey) {
    $upload_file_key = $_POST['upload_file_key'];

    // update-callback
    $row_count = sqlRowCount("SELECT id FROM kollus_video WHERE upload_file_key='$upload_file_key'");
    if ($row_count > 0) {
        $set = "";
        foreach ($_POST as $k => $v) {
            $set .= "$k='$v',";
        }
        $set = substr($set, 0, -1);

        $status = ($_POST['transcoding_result'] == 'success') ? 1 : 11;

        $data = get_media_content($upload_file_key);
        $snapshot_url = $data['snapshot_url'];
        $length = $data['length'];
        
        $query = "UPDATE kollus_video SET status='$status', snapshot_url='$snapshot_url', length='$length', $set WHERE upload_file_key='$upload_file_key'";
        sqlExe($query);
    } else {
        kollus_log('not exist upload video');
    }
} else {
    http_response_code(404);
}
