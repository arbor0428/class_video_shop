<?
	include '../../module/datepicker/Calendar.php';
?>

<style>
.searchBox .form-control{background-color:#fff;display:inline-block;}
.searchBox .btn-icon-split .text {padding: 0.31rem 0.75rem;}
</style>

<script>
function searchChk(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}
</script>

<div class='searchBox' style='width:100%;'>
	<div style="float:left;">
		<input type="text" name="f_company" class="form-control" value="<?=$f_company?>" style='width:140px;' placeholder='업체명'onkeypress="if(event.keyCode==13){searchChk();}">
		<input type="text" name="f_name" class="form-control" value="<?=$f_name?>" style='width:140px;' placeholder='담당자'onkeypress="if(event.keyCode==13){searchChk();}">
		<input type="text" name="f_sDate" class="form-control fpicker" value="<?=$f_sDate?>" style='width:140px;' placeholder='접수일 시작'> ~
		<input type="text" name="f_eDate" class="form-control fpicker" value="<?=$f_eDate?>" style='width:140px;' placeholder='접수일 종료'>
		<a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
			<span class="text">검색</span>
		</a>
	</div>
</div>