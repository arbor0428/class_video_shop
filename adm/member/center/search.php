<?
	//달력
//	include '../../module/datepicker/Calendar.php';
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
		<select name="f_status" id="f_status" class="form-control" style="width:120px;" onchange="searchChk();">
			<option value=''>상태</option>
			<option value='1' <?if($f_status == '1'){echo 'selected';}?>>정상</option>
			<option value='3' <?if($f_status == '3'){echo 'selected';}?>>탈퇴</option>
			<option value='2' <?if($f_status == '2'){echo 'selected';}?>>중지</option>
		</select>
		<select name="f_level" id="f_level" class="form-control" style="width:120px;" onchange="searchChk();">
			<option value=''>등급</option>
			<option value='1' <?if($f_level == '1'){echo 'selected';}?>>VIP</option>
			<option value='2' <?if($f_level == '2'){echo 'selected';}?>>일반</option>
		</select>
	<!--
		<input type="text" name="f_sDate" class="form-control fpicker" value="<?=$f_sDate?>" style='width:140px;' placeholder='접수일 시작'> ~
		<input type="text" name="f_eDate" class="form-control fpicker" value="<?=$f_eDate?>" style='width:140px;' placeholder='접수일 종료'>
	-->
		<input type="text" name="f_userid" class="form-control" value="<?=$f_userid?>" style='width:140px;' placeholder='아이디'onkeypress="if(event.keyCode==13){searchChk();}">
		<input type="text" name="f_name" class="form-control" value="<?=$f_name?>" style='width:140px;' placeholder='성명'onkeypress="if(event.keyCode==13){searchChk();}">
		<a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
			<span class="text">검색</span>
		</a>
	</div>

	<div style="float:right;">
		<select name="f_sort" id="f_sort" class="form-control" style='width:150px;' onchange='searchChk();'>
			<option value='rTime' <?if($f_sort == 'rTime'){echo 'selected';}?>>가입일순</option>
			<option value='loginTime' <?if($f_sort== 'loginTime'){echo 'selected';}?>>최근접속일순</option>
		</select>
	</div>
</div>