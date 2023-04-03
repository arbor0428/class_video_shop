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
		<input type="text" name="f_rTime" class="form-control" value="<?=$f_rTime?>" style='width:140px;' placeholder='주문서번호' onkeypress="if(event.keyCode==13){searchChk();}">
		<input type="text" name="f_userid" id="f_userid" class="form-control" style="width:140px;" value="<?=$f_userid?>" list="userList" placeholder="주문자" onkeypress="if(event.keyCode==13){searchChk();}">
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
	<?
		if($GBL_MTYPE == 'A'){
	?>
		<input type="text" name="f_stylist" id="f_stylist" class="form-control" style="width:140px;" value="<?=$f_stylist?>" list="styleList" placeholder="스타일리스트" onkeypress="if(event.keyCode==13){searchChk();}">
		<datalist id="styleList">
		<?
			$uArr = sqlArray("select * from ks_member where mtype='S' order by name");
			foreach($uArr as $k => $v){
				if($userid == $v['userid'])	$chk = 'selected';
				else								$chk = '';
		?>
			<option value="<?=$v['userid']?>" label="<?=$v['name']?>" <?=$chk?>><?=$v['userid']?></option>
		<?
			}
		?>
		</datalist>
	<?
		}else{
	?>
		<input type='hidden' name='f_stylist' value='<?=$f_stylist?>'>
	<?
		}
	?>


		<input type="text" name="f_sDate" class="form-control fpicker" value="<?=$f_sDate?>" style='width:140px;' placeholder='주문일 시작'> ~
		<input type="text" name="f_eDate" class="form-control fpicker" value="<?=$f_eDate?>" style='width:140px;' placeholder='주문일 종료'>
		<a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
			<span class="text">검색</span>
		</a>
	</div>
</div>