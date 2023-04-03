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
			$crnt_wish = sqlRowOne("SELECT wish FROM ks_class WHERE class_uid=$uid");

			if ($isExist) {
				$query = "DELETE FROM ks_wish WHERE userid='$userid' AND class_uid=$uid";
				$result = mysql_query($query);

                $update_wish = intval($crnt_wish) - 1;
                if ($update_wish < 0) $update_wish = 0;
                $query2 = "UPDATE ks_class SET wish='$update_wish' WHERE class_uid=$uid";
				$result2 = mysql_query($query2);

				if($result && $result2) echo "SUCCESS";
				else echo "FAILED";
			} else {
				$rTime = time();
				$query = "INSERT INTO ks_wish (userid, class_uid, rTime) values ('$userid', '$uid', '$rTime')";
				$result = mysql_query($query);
                
                $update_wish = intval($crnt_wish) + 1;
                $query2 = "UPDATE ks_class SET wish='$update_wish' WHERE class_uid=$uid";
				$result2 = mysql_query($query2);

				if($result && $result2) echo "SUCCESS";
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