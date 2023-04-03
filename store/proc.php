<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.jUtil.php";

if (isEmpty($userid))		{ echo "NOT_LOGIN";  exit; }
else if (isEmpty($method))	{ echo "NOT_ACCESS"; exit; }
else {
	switch ($method) {
		case 'CART':
			if (isEmpty($uid))	{ echo "NOT_ACCESS"; exit; }
			
			$isExist = sqlRowOne("SELECT COUNT(1) FROM ks_cart WHERE userid='$userid' AND class_uid=$uid") > 0;
			
			if ($isExist) {
				echo "EXIST";
			} else {
				$rTime = time();
				$query = "INSERT INTO ks_cart (userid, class_uid, rTime) values ('$userid', '$uid', '$rTime')";
				$result = mysql_query($query);
				if($result) echo "SUCCESS";
				else echo "FAILED";
			}
			break;
        
		case 'WISH':
			$isExist = sqlRowOne("SELECT COUNT(1) FROM ks_wish WHERE userid='$userid' AND class_uid=$uid") > 0;

			if ($isExist) {
				$query = "DELETE FROM ks_wish WHERE userid='$userid' AND class_uid=$uid";
				$result = mysql_query($query);
				if($result) echo "SUCCESS";
				else echo "FAILED";
			} else {
				$rTime = time();
				$query = "INSERT INTO ks_wish (userid, class_uid, rTime) values ('$userid', '$uid', '$rTime')";
				$result = mysql_query($query);
				if($result) echo "SUCCESS";
				else echo "FAILED";
			}
			break;
        
        case 'BUY':
            echo "SUCCESS";
            break;

		default:
			echo "METHOD_UNAVAILABLE";
	}
}