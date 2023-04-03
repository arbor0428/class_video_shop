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
		<select name="f_payTitle" id="f_payTitle" class="form-control" style='width:130px;' onchange='searchChk();'>
			<option value="">결제구분</option>
			<option value='order' <?if($f_payTitle == 'order'){echo 'selected';}?>>상품주문</option>
			<option value='join' <?if($f_payTitle == 'join'){echo 'selected';}?>>스타일링</option>
			<option value='styleQ' <?if($f_payTitle == 'styleQ'){echo 'selected';}?>>스타일링Q</option>
			<option value='styleA' <?if($f_payTitle == 'styleA'){echo 'selected';}?>>스타일링A</option>
		</select>
		<select name="f_payMode" id="f_payMode" class="form-control" style='width:120px;' onchange='searchChk();'>
			<option value="">결제수단</option>
			<option value='card' <?if($f_payMode == 'card'){echo 'selected';}?>>신용카드</option>
			<option value='acc' <?if($f_payMode == 'acc'){echo 'selected';}?>>계좌이체</option>
			<option value='vacc' <?if($f_payMode == 'vacc'){echo 'selected';}?>>가상계좌</option>
		</select>
		<select name="f_level" id="f_level" class="form-control" style="width:120px;" onchange="searchChk();">
			<option value=''>등급</option>
			<option value='1' <?if($f_level == '1'){echo 'selected';}?>>VIP</option>
			<option value='2' <?if($f_level == '2'){echo 'selected';}?>>일반</option>
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

		<select name="f_gender" id="f_gender" class="form-control" style='width:80px;' onchange='searchChk();'>
			<option value="">성별</option>
			<option value='1' <?if($f_gender == '1'){echo 'selected';}?>>남</option>
			<option value='2' <?if($f_gender == '2'){echo 'selected';}?>>여</option>
		</select>

		<select name="f_bYear" id="f_bYear" class="form-control" style='width:90px;' onchange='searchChk();'>
			<option value="">생년</option>
		<?
			$sy = date('Y');
			$ey = date('Y') - 80;
			for($i=$sy; $i>=$ey; $i--){
		?>
			<option value='<?=$i?>' <?if($f_bYear == $i){echo 'selected';}?>><?=$i?></option>
		<?
			}
		?>
		</select>

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

		<input type="text" name="f_payAmtMin" id="f_payAmtMin" class="form-control numberOnly" style="width:140px;" value="<?=$f_payAmtMin?>" placeholder="결제금액" onkeypress="if(event.keyCode==13){searchChk();}">~
		<input type="text" name="f_payAmtMax" id="f_payAmtMax" class="form-control numberOnly" style="width:140px;" value="<?=$f_payAmtMax?>" placeholder="결제금액" onkeypress="if(event.keyCode==13){searchChk();}">

		<input type="text" name="f_sDate" class="form-control fpicker" value="<?=$f_sDate?>" style='width:140px;' placeholder='결제일 시작'> ~
		<input type="text" name="f_eDate" class="form-control fpicker" value="<?=$f_eDate?>" style='width:140px;' placeholder='결제일 종료'>

		<a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
			<span class="text">검색</span>
		</a>
	</div>
</div>