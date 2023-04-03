<?php

include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

if (!$cade01) {
	echo "NULL";
	exit;
} else {
	$cade02 = sqlArray("SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort");
	echo json_encode($cade02, JSON_UNESCAPED_UNICODE);
}
