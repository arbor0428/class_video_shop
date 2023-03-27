<?php
http_response_code(200);
include "/home/edufim/www/module/class/class.DbCon.php";
include './config.php';

if (isset($_POST['content_provider_key']) && $_POST['content_provider_key'] === $securityKey) {
    $upload_file_key = $_POST['upload_file_key'];
    $row_count = sqlRowCount("SELECT id FROM kollus_video WHERE upload_file_key='$upload_file_key'");

    if ($row_count > 0) {
        $set = "";
        foreach ($_POST as $k => $v) {
            $set .= "$k='$v',";
        }
        $set = substr($set, 0, -1);

        $query = "UPDATE kollus_video SET status=2, $set WHERE upload_file_key='$upload_file_key'";
        sqlExe($query);
    } else {
        insert_request();
    }
} else {
    http_response_code(404);
}
