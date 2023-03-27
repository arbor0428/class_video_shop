<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

switch ($type) {
	case 'ADD':
		$query = "INSERT INTO ks_best_list (best_uid, class_uid) VALUES ('$best_uid', '$class_uid')";
		$result = mysql_query($query) or die(mysql_error());

		break;

	case 'REMOVE':
		$query = "DELETE FROM ks_best_list WHERE best_uid='$best_uid' AND class_uid='$class_uid'";
		$result = mysql_query($query) or die(mysql_error());

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