<?
include "/home/edufim/www/adm/head.php";

if (!$type)	$type = 'list';

if ($type == 'list')		include 'video_list.php';
elseif ($type == 'write')	include 'video_write.php';
elseif ($type == 'edit')	include 'video_write.php';
?>

<?
include '/home/edufim/www/adm/footer.php';
?>