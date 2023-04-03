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
		<select name="f_talkType" id="f_talkType" class="form-control" style='width:120px;' onchange='searchChk();'>
			<option value="">구분</option>
			<option value='style' <?if($f_talkType == 'style'){echo 'selected';}?>>스타일링</option>
			<option value='orderList' <?if($f_talkType == 'orderList'){echo 'selected';}?>>상품발송</option>
			<option value='3day' <?if($f_talkType == '3day'){echo 'selected';}?>>3일경과</option>
			<option value='4day' <?if($f_talkType == '4day'){echo 'selected';}?>>4일경과</option>
			<option value='order' <?if($f_talkType == 'order'){echo 'selected';}?>>상품결제</option>
			<option value='return' <?if($f_talkType == 'return'){echo 'selected';}?>>반품접수</option>
			<option value='review' <?if($f_talkType == 'review'){echo 'selected';}?>>리뷰등록</option>
			<option value='coupon' <?if($f_talkType == 'coupon'){echo 'selected';}?>>쿠폰발급</option>
			<option value='delay-bae' <?if($f_talkType == 'delay-bae'){echo 'selected';}?>>배송지연</option>
			<option value='delay-bal' <?if($f_talkType == 'delay-bal'){echo 'selected';}?>>발송지연</option>
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

		<input type="text" name="f_sDate" class="form-control fpicker" value="<?=$f_sDate?>" style='width:140px;' placeholder='발송일 시작'> ~
		<input type="text" name="f_eDate" class="form-control fpicker" value="<?=$f_eDate?>" style='width:140px;' placeholder='발송일 종료'>

		<a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
			<span class="text">검색</span>
		</a>
	</div>
</div>