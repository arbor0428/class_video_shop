<?
	//스타일리스트인 경우 본인의 주문건만 표시...
	if($GBL_MTYPE != 'A')		$f_stylist = $GBL_USERID;

	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where uid>0";

	//주문서번호
	if($f_rTime)	$query_ment .= " and rTime like '%$f_rTime%'";

	//주문자
	if($f_userid)	 $query_ment .= " and userid='$f_userid'";

	//스타일리스트
	if($f_stylist)	$query_ment .= " and stylist='$f_stylist'";

	//주문일 시작
	if($f_sDate){
		$f_sTime = strtotime($f_sDate);
		$query_ment .= " and rTime>='$f_sTime'";
	}

	//주문일 종료
	if($f_eDate){
		$f_eTime = strtotime($f_eDate);
		$query_ment .= " and rTime<='$f_eTime'";
	}

	//주문총액
	$orderTotalAmt = sqlRowOne("select sum(prodAmt) from ks_order $query_ment and status!='환불'");
	$payTotalAmt = sqlRowOne("select sum(payAmt) from ks_order $query_ment and status!='환불'");

	$sort_ment = "order by orderTime desc, rTime desc";

	$query = "select * from ks_order $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = $query." limit $record_start, $record_count";

	$result = mysql_query($query2);
?>

<script>
function checkDel(uid){
	GblMsgConfirmBox("해당 상품을 삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.","delOK('"+uid+"')");
}

function delOK(uid){
	form = document.frm01;
	form.type.value = 'del';
	form.uid.value = uid;
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function prdEdit(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function prdView(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function prdWrite(){
	form = document.frm01;
	form.type.value = 'write';
	form.uid.value = '';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function reg_list(){
	form = document.frm01;
	form.type.value = 'list';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function ifra_xls(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = 'excelDown.php';
	form.submit();
}

function formModal(t,i){
	$("#multiBox").css({"width":"90%","max-width":"750px"});
	$('#multi_ttl').text(t);

	$('#multiFrame').html("<iframe src='reMsg.php?orderNum="+i+"' name='configFrame' style='width:100%;height:400px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}

function modalOpen(){
	len = $('input:checkbox[class=cMail]:checked').length;
	if(len == 0){
		GblMsgBox('선택된 회원이 없습니다.','');
		return;
	}

	$("#multiBox").css({"width":"90%","max-width":"700px"});
	$('#multi_ttl').text('쿠폰발급');
	$('#multiFrame').html("<iframe src='about:blank' name='couponFrame' style='width:100%;height:450px;' frameborder='0' scrolling='auto'></iframe>");

	form = document.frm01;
	form.target = 'couponFrame';
	form.action = '/adm/coupon/modalForm.php';
	form.submit();

	$('.multiBox_open').click();
}

function modalClose(){
	$(".multiBox_close").click();
}
</script>

<style>
.listTable td{text-align:center;}
.redStroke{border:2px solid #e02d1b;}
</style>

<form name='frm01' id='frm01' method='post' action="<?=$_SERVER['PHP_SELF']?>">
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='cType' value='orderList'><!-- 쿠폰발급용 -->

<div class="card shadow mb-4" style='margin-top:10px;'>
	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<?
		include 'search.php';
	?>
	</div>

	<div class="card-body">
	<?if($GBL_MTYPE == 'A'){?>
		<div style='float:left;margin-top:10px;'>
			<a href="javascript:prdWrite();" class="btn btn-sm btn-secondary btn-icon-split">
				<span class="icon text-white-50">
					<i class="fas fa-check"></i>
				</span>
				<span class="text">주문등록</span>
			</a>

			<a href="javascript:ifra_xls();" class="btn btn-sm btn-success btn-icon-split">
				<span class="icon text-white-50">
					<i class="fas fa-download"></i>
				</span>
				<span class="text">엑셀다운로드</span>
			</a>
		</div>
	<?}?>

		<div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
			<span class="scorll-hand">
				<img src="/adm/img/scroll_hand.gif" style="max-width:100%;">
			</span>
		</div>


		<div style='float:right;font-size:14px;color:#777;'>
			주문총액 : <span><?=number_format($orderTotalAmt)?> 원</span><br>
			입금총액 : <span><?=number_format($payTotalAmt)?> 원</span>
		</div>

		<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
			<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
				<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
					<tr>
					<?
						if($GBL_MTYPE == '사용안함'){
					?>
						<th width='50'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
					<?
						}
					?>
						<th width='70'>번호</th>
						<th>주문번호</th>
						<th>주문자</th>
						<th>추천인</th>
						<th>스타일리스트</th>
						<th>결제대기</th>
						<th>반품요청</th>
					<!--
						<th>재신청</th>
					-->
						<th>입금대기</th>
						<th>결제완료</th>
						<th>주문금액</th>
						<th>입금액</th>
						<th width='120'>주문일</th>
					<?if($GBL_MTYPE == 'A'){?>
						<th width='120'>편집</th>
					<?}?>
					</tr>
	<?
	if($total_record){
		$i = $total_record - ($current_page - 1) * $record_count;

		while($row = mysql_fetch_array($result)){

			$uid = $row["uid"];
			$userid = $row["userid"];
			$stylist = $row["stylist"];
			$name = $row["name"];
			$prodCnt = $row["prodCnt"];
			$prodAmt = $row["prodAmt"];
			$payAmt = $row["payAmt"];
			$orderDate = $row["orderDate"];
			$rTime = $row["rTime"];

			$cnt01 = sqlRowOne("select count(*) from ks_orderList where userid='$userid' and rTime='$rTime' and status='결제대기'");
			$cnt02 = sqlRowOne("select count(*) from ks_orderList where userid='$userid' and rTime='$rTime' and status='반품요청'");
//			$cnt03 = sqlRowOne("select count(*) from ks_orderList where userid='$userid' and rTime='$rTime' and status='재신청'");
			$cnt04 = sqlRowOne("select count(*) from ks_orderList where userid='$userid' and rTime='$rTime' and status='입금대기'");
			$cnt05 = sqlRowOne("select count(*) from ks_orderList where userid='$userid' and rTime='$rTime' and status='결제완료'");

			$cnt01Txt = number_format($cnt01);
			$cnt02Txt = number_format($cnt02);
//			$cnt03Txt = number_format($cnt03);
			$cnt04Txt = number_format($cnt04);
			$cnt05Txt = number_format($cnt05);

			if($cnt01)	$cnt01Txt = "<span class='btn-secondary btn-circle btn-sm'>".$cnt01Txt."</span>";
			if($cnt02){
				//반품확인 개수
				$reChkNum = sqlRowOne("select count(*) from ks_orderList where userid='$userid' and rTime='$rTime' and status='반품요청' and reChk='1'");
				if($cnt02 > $reChkNum)	$reChk = 'redStroke';
				else								$reChk = '';

				$cnt02Txt = "<a href=\"javascript:formModal('반품사유','".$rTime."');\"><span class='btn-info btn-circle btn-sm $reChk'>".$cnt02Txt."</span></a>";
			}

/*
			if($cnt03){
				//반품확인 개수
				$reChkNum = sqlRowOne("select count(*) from ks_orderList where userid='$userid' and rTime='$rTime' and status='재신청' and reChk='1'");
				if($cnt03 > $reChkNum)	$reChk = 'redStroke';
				else								$reChk = '';

				$cnt03Txt = "<span class='btn-warning btn-circle btn-sm $reChk'>".$cnt03Txt."</span>";
			}
*/

			if($cnt04)	$cnt04Txt = "<span class='btn-success btn-circle btn-sm'>".$cnt04Txt."</span>";
			if($cnt05)	$cnt05Txt = "<span class='btn-primary btn-circle btn-sm'>".$cnt05Txt."</span>";

//			if($row['status'] == '입금대기')	$payAmt = 0;

			if($row['status'] == '환불'){
				$linkClass = 'pinkLine';
				$cTxt = "<span style='color:#ff0000;'>환불</span>";
			}else{
				$linkClass = 'grayLine';
				$cTxt = '';
			}

			//추천인
			$rCode = $rArr[$userid];
			if($rCode)	$rCodeTxt = $rCode.' ('.$sArr[$rCode].')';
			else			$rCodeTxt = '';

			//스타일리스트
			if($stylist)	$stylistTxt = $stylist.' ('.$sArr[$stylist].')';
			else			$stylistTxt = '';
	?>
					<tr class='<?=$linkClass?>'>
					<?
						if($GBL_MTYPE == '사용안함'){
					?>
						<td><input type="checkbox" name="chk[]" value="<?=$uid?>" class="cMail"></td>
					<?
						}
					?>
						<td><?=$i?></td>
						<td><?=$rTime?> <?=$cTxt?></td>
						<td><?=$userid?> (<?=$name?>)</td>
						<td><?=$rCodeTxt?></td>
						<td><?=$stylistTxt?></td>
						<td><?=$cnt01Txt?></td>
						<td><?=$cnt02Txt?></td>
					<!--
						<td><?=$cnt03Txt?></td>
					-->
						<td><?=$cnt04Txt?></td>
						<td><?=$cnt05Txt?></td>
						<td><?=number_format($prodAmt)?>원</td>
						<td><?=number_format($payAmt)?>원</td>
						<td><?=$orderDate?></td>
					<?if($GBL_MTYPE == 'A'){?>
						<td>
						<?
							if($row['status'] == '입금대기' || $row['status'] == '결제완료' || $row['status'] == '환불'){
						?>
							<a href="javascript:prdView('<?=$uid?>');" class="btn btn-success btn-circle btn-sm" title='보기'>
								<i class="fas fa-info-circle"></i>
							</a>
						<?
							}else{
						?>
							<a href="javascript:prdEdit('<?=$uid?>');" class="btn btn-success btn-circle btn-sm" title='수정'>
								<i class="fas fa-info-circle"></i>
							</a>
							<a href="javascript:checkDel('<?=$uid?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'>
								<i class="fas fa-trash"></i>
							</a>
						<?
							}
						?>
						</td>
					<?}?>
					</tr>


	<?
			$i--;
		}

	}else{
	?>
					<tr>
						<td colspan='14' style='padding:50px 0;text-align:center;'>주문정보가 없습니다.</td>
					</tr>
	<?
	}
	?>
				</table>
	<?
		if($GBL_MTYPE == 'A' && $total_record == '사용안함'){
	?>
	<!--
		<a href="javascript:modalOpen();" class="btn btn-sm btn-info btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">쿠폰발급</span>
		</a>
	-->
	<?
		}
	?>
			</div>
		</div>
	</div>
<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
?>

</div>
</form>