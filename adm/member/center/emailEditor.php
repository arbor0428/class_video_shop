<?
	include '../head.php';

	if($GBL_MTYPE != 'A'){
		Msg::goMsg('접근오류','/');
		exit;
	}

	$f_status = $_POST['f_status'];
	$f_level = $_POST['f_level'];
	$f_userid = $_POST['f_userid'];
	$f_name = $_POST['f_name'];
?>

<style>
.zTable{border-bottom:0;}
.zTable th, .zTable td{height:30px;}
</style>

<script>
function check_form(){
	form = document.frm01;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;

	ment = $('#ment').val().replace("<p>&nbsp;</p>","");
	if(ment == ''){
		alert('메일 내용을 입력해 주십시오');
		return;
	}else{

		$('#sendBtn').html("<a href='javascript://;' class='big cbtn green'>전송중</a>");

		form.target = 'mail_frame';
		form.action = 'emailProc.php';
		form.submit();
	}
}
</script>

<iframe name='mail_frame' src='about:blank' style='width:0;height:0;display:none;'></iframe>

<form name='frm01' method='post' action='emailProc.php'>
<input type="hidden" name="f_status" value="<?=$f_status?>">
<input type="hidden" name="f_level" value="<?=$f_level?>">
<input type="hidden" name="f_userid" value="<?=$f_userid?>">
<input type="hidden" name="f_name" value="<?=$f_name?>">
<input type="hidden" name="memType" value="<?=$memType?>">

<?
//선택된 회원
if($memType == 'choice'){
	foreach($chk as $k => $v){
?>
<input type="hidden" name="chk[]" value="<?=$v?>">
<?
	}
}
?>

* 광고수신 미동의 회원에게는 발송되지 않습니다.
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th width='17%'>제목</th>
		<td width='83%'><input name="title" type="text" style='width:100%;' class='textBox01' value=""></td>
	</tr>
</table>
<textarea name="ment" id="ment" style='width:100%;height:500px;'></textarea>

<p style='width:100%;text-align:center;margin-top:10px;' id='sendBtn'><a href="javascript:check_form();" class="big cbtn blue">보내기</a></p>

</form>


<?
	//썸머노트
	include '../../module/summernote/lib.php';
?>