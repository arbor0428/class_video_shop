<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include './config.php';

$upload_file_key = '20230314-xcu49i9r';

$data = get_media_content($upload_file_key);

$snapshot_url = $data['snapshot_url'];
$length = $data['length'];

var_dump($snapshot_url);
var_dump($length);
