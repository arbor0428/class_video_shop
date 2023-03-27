<?
include '../head.php';
include '../../module/loading.php';

?>
<form name='frm01' id='frm01' method='post' action="<?=$_SERVER['PHP_SELF']?>">
	<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='uid' value=''>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
	<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
	<input type='hidden' name='cType' value="user">
<?

	if(!$type)	$type = 'list';
	
	if($type == 'list')			include 'list02.php';
	elseif($type == 'write')	include 'write02.php';
	elseif($type == 'edit')	include 'write02.php';

?>
</form>