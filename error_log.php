<?php
include "/home/edufim/www/module/class/class.DbCon.php";

$row = sqlRow("select * from error_query order by uid desc limit 1");

echo $row['request_uri'] . "<br><br>";
echo $row['http_referer'] . "<br><br>";
echo $row['postdata'] . "<br><br>";
echo $row['query'] . "<br><br>";
echo $row['errmsg'] . "<br><br>";
