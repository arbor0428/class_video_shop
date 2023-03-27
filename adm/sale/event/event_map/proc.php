<?
include "/home/edufim/www/adm/header.php";

switch ($type) {
	case 'ADD':
		$query = "INSERT INTO ks_event_map VALUES ('$event_uid', '$class_uid')";
		sqlExe($query);

		break;

	case 'REMOVE':
		$query = "DELETE FROM ks_event_map WHERE event_uid='$event_uid' AND class_uid='$class_uid'";
		sqlExe($query);
		break;
}

unset($dbconn);
?>

<form name='frm' method='post' action='<?= $next_url ?>'>
	<input type='hidden' name='type' value='list'>
	<input type='hidden' name='event_uid' value='<?= $event_uid ?>'>
</form>

<script language='javascript'>
	document.frm.submit();
</script>