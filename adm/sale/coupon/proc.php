<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

switch ($type) {
    case 'write':
        $rTime = time();

        $query = "INSERT INTO ks_coupon (title, discountPrice, discountPeriod, rTime) VALUES";
        $query .= " ('$title', '$discountPrice', '$discountPeriod', '$rTime')";
        $result = mysql_query($query) or die(mysql_error());

        $msg = '등록되었습니다';
        break;

    case 'edit':
        $discountDate = date('Y-m-d', strtotime($discountDate));

        $query = "UPDATE ks_coupon SET";
        $query .= " title='$title',";
        $query .= " discountPrice='$discountPrice',";
        $query .= " discountPeriod='$discountPeriod'";
        $query .= " WHERE uid=$uid";

        $result = mysql_query($query) or die(mysql_error());
        
        $msg = '수정되었습니다';
        break;

    case 'del':
        $sql = "DELETE FROM ks_coupon WHERE uid='$uid'";
        $result = mysql_query($sql) or die(mysql_error());

        $msg = '삭제되었습니다';
        break;

    case 'able':
        sqlExe("UPDATE ks_coupon SET status='$status' WHERE uid='$uid'");
        break;

    default:
        $msg = "Invalid type";
        break;
}

unset($dbconn);
Msg::goMsg($msg, $next_url);
?>

<!-- <form name='frm' method='post' action='<?= $next_url ?>'>
	<input type='hidden' name='record_start' value='<?= $record_start ?>'>
	<input type='hidden' name='f_c02a' value='<?= $f_c02a ?>'>
	<input type='hidden' name='f_c02b' value='<?= $f_c02b ?>'>
	<input type='hidden' name='f_c02c' value='<?= $f_c02c ?>'>
	<input type='hidden' name='f_c02d' value='<?= $f_c02d ?>'>
	<input type='hidden' name='f_title' value='<?= $f_title ?>'>
	<input type='hidden' name='f_enable01' value='<?= $f_enable01 ?>'>
	<input type='hidden' name='f_enable02' value='<?= $f_enable02 ?>'>
	<input type='hidden' name='cade01' value='<?= $cade01 ?>'>
</form>

<script language='javascript'>
	alert('<?= $msg ?>');
	document.frm.submit();
</script> -->