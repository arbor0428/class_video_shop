<?php
http_response_code(200);

include "/home/edufim/www/module/class/class.DbCon.php";
$str = "{";
	foreach($_POST as $k => $v){
		// $str .= "$k : $v <br>";
		$str .= '"'.$k.'":"'.$v.'",';
	}
$str .= "}";

$query = "INSERT INTO kollus_video (text) VALUES ('$str')";
$result = mysql_query($query) or die('Could not connect DB: ' . mysql_error());
