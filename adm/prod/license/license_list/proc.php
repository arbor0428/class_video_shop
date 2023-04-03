<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

switch ($type) {
	case 'ADD':
		$query = "INSERT INTO ks_license_list (license_uid, class_uid) VALUES ('$license_uid', '$class_uid')";
		$result = mysql_query($query) or die(mysql_error());

		break;

	case 'REMOVE':
		$query = "DELETE FROM ks_license_list WHERE license_uid='$license_uid' AND class_uid='$class_uid'";
		$result = mysql_query($query) or die(mysql_error());

		break;
    
    case 'required':
		$query = "UPDATE ks_license_list SET is_required='$status' WHERE license_uid='$license_uid' AND class_uid='$class_uid'";
		$result = mysql_query($query) or die(mysql_error());
        
        echo $result;

		break;

}

unset($dbconn);
?>

<form name='frm' method='post' action='<?= $next_url ?>'>
	<input type='hidden' name='type' value='list'>
    <input type='hidden' name='record_start' value='<?= $record_start ?>'>
    <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>
</form>

<script language='javascript'>
	document.frm.submit();
</script>