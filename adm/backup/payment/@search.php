<?
	//달력
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
		<select name="f_ptype" id="f_ptype" class="form-control" style='width:120px;' onchange='searchChk();'>
			<option value="">구분</option>
			<option value='P' <?if($f_ptype == 'P'){echo 'selected';}?>>적립</option>
			<option value='M' <?if($f_ptype == 'M'){echo 'selected';}?>>차감</option>
		</select>
		<input type="text" name="f_userid" id="f_userid" class="form-control" style="width:140px;" value="<?=$f_userid?>" list="userList" placeholder="아이디" onkeypress="if(event.keyCode==13){searchChk();}">
		<datalist id="userList">
		<?
			$uArr = sqlArray("select * from ks_member where mtype='M' order by uid");
			foreach($uArr as $k => $v){
				if($userid == $v['userid'])	$chk = 'selected';
				else								$chk = '';
		?>
			<option value="<?=$v['userid']?>" label="<?=$v['name']?>" <?=$chk?>><?=$v['userid']?></option>
		<?
			}
		?>
		</datalist>

		<input type="text" name="f_sDate" class="form-control fpicker" value="<?=$f_sDate?>" style='width:140px;' placeholder='처리일 시작'> ~
		<input type="text" name="f_eDate" class="form-control fpicker" value="<?=$f_eDate?>" style='width:140px;' placeholder='처리일 종료'>

		<a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
			<span class="text">검색</span>
		</a>
	</div>
</div>