<?php
http_response_code(200);
include "/home/edufim/www/module/class/class.DbCon.php";
include './config.php';

if (isset($_POST['content_provider_key']) && $_POST['content_provider_key'] === $securityKey) {
    $columns = "";
    $values = "";

    foreach ($_POST as $k => $v) {
        $columns .= "$k,";
        $values .= "'$v',";
    }

    $columns = substr($columns, 0, -1);
    $values = substr($values, 0, -1);

    $query = "INSERT INTO kollus_video (status, $columns) VALUES (0, $values)";
    sqlExe($query);
} else {
    http_response_code(404);
}
