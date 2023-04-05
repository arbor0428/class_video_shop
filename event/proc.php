<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.jUtil.php";

if (isEmpty($userid))       { echo "NOT_LOGIN";  exit; }
elseif (isEmpty($uid))	    { echo "NOT_ACCESS"; exit; }
elseif (isEmpty($method))   { echo "NOT_ACCESS"; exit; }
else {
	switch ($method) {
		case 'EVENT':
            $row = sqlRow("SELECT coupon_uid, eDate FROM ks_event WHERE uid='$uid'");
            $coupon_uid = $row[0];
            $eDate = $row[1];
            
            $query = "SELECT COUNT(1) FROM ks_coupon_log WHERE userid='$userid' AND coupon_uid='$coupon_uid'";
			$isExist = sqlRowOne($query) > 0;
			
			if ($isExist) {
				echo "EXIST";
			} else {
                $rTime = time();
                $eTime = strtotime($eDate . "+1 days");
                $userip = $_SERVER['REMOTE_ADDR'];

				$query = "INSERT INTO ks_coupon_log (status, userid, coupon_uid, eTime, userip, rTime) VALUES (1, '$userid', '$coupon_uid', '$eTime',  '$userip', '$rTime')";
				$result = mysql_query($query);
				if($result) echo "SUCCESS";
				else echo "FAILED";
			}
			break;

		default:
			echo "METHOD_UNAVAILABLE";
	}
}
