<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where p.uid>0";

	//결제구분
	if($f_payTitle == 'order')				$query_ment .= " and p.payTitle='order'";
	elseif($f_payTitle == 'join')			$query_ment .= " and p.payTitle='join'";
	elseif($f_payTitle == 'styleQ')		$query_ment .= " and p.payTitle='style' and p.styleQuiz='1'";
	elseif($f_payTitle == 'styleA')		$query_ment .= " and p.payTitle='style' and p.styleQuiz=''";

	//결제수단
	if($f_payMode)	$query_ment .= " and p.payMode='$f_payMode'";

	//등급
	if($f_level == '1')			$query_ment .= " and m.level='VIP'";
	elseif($f_level == '2')	$query_ment .= " and m.level=''";

	//아이디
	if($f_userid)	 $query_ment .= " and p.userid like '%$f_userid%'";

	//성별
	if($f_gender)	$query_ment .= " and m.gender='$f_gender'";

	//생년
	if($f_bYear)		$query_ment .= " and m.bDate like '$f_bYear-%'";

	//스타일리스트
	if($f_stylist)	$query_ment .= " and o.stylist like '%$f_stylist%'";

	//결제금액
	if($f_payAmtMin)	$query_ment .= " and p.payAmt>='".str_replace(',','',$f_payAmtMin)."'";
	if($f_payAmtMax)	$query_ment .= " and p.payAmt<='".str_replace(',','',$f_payAmtMax)."'";

	//결제일 시작
	if($f_sDate){
		$f_sTime = strtotime($f_sDate);
		$query_ment .= " and p.rTime>='$f_sTime'";
	}

	//결제일 종료
	if($f_eDate){
		$f_eTime = strtotime($f_eDate);
		$query_ment .= " and p.rTime<='$f_eTime'";
	}

	//결제총액
	$payTotalAmt = sqlRowOne("select sum(p.payAmt) from ks_payment as p left join ks_order as o on p.orderNum=o.rTime left join ks_member as m on p.userid=m.userid $query_ment and p.payOk='결제완료'");

	$sort_ment = "order by p.rTime desc";

	$query = "select p.*, o.stylist, o.uid as orderUid, m.level, m.gender, m.bDate, m.rCode from ks_payment as p left join ks_order as o on p.orderNum=o.rTime left join ks_member as m on p.userid=m.userid $query_ment $sort_ment";

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
function formModal(u){
	$("#multiBox").css({"width":"90%","max-width":"750px"});
	$('#multi_ttl').text('정보수정');
	$('#multiFrame').html("<iframe src='form.php?type=edit&uid="+u+"' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}

function orderView(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.target = '';
	form.action = '../orderList/';
	form.submit();
}

function checkDel(name,uid){
	GblMsgConfirmBox("["+name+"]님의 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.","delOK('"+uid+"')");
}

function delOK(uid){
	form = document.frm01;
	form.type.value = 'del';
	form.uid.value = uid;
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function alimtalkChk(c){
	len = $('input:checkbox[class=cMail]:checked').length;
	if(len == 0){
		GblMsgBox('선택된 회원이 없습니다.','');
		return;
	}

	txt = '';

	if(c == 'delay-bae')		txt = '배송지연';
	else if(c == 'delay-bal')	txt = '발송지연';

	if(txt){
		GblMsgConfirmBox("["+txt+"] 알림톡을 발송하시겠습니까?","alimtalkSend('"+c+"')");
	}
}

function alimtalkSend(c){
	form = document.frm01;
	form.type.value = c;
	form.target = 'ifra_gbl';
	form.action = 'alimtalkProc.php';
	form.submit();
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

function ifra_xls(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = 'excelDown.php';
	form.submit();
}
</script>

<style>
.listTable td{text-align:center;}
span.btn-sm{height:1.1rem !important;width:1.1rem !important;font-size:0.75rem !important;}
</style>


<div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
	<span class="scorll-hand">
		<img src="/adm/img/scroll_hand.gif" style="max-width:100%;">
	</span>
</div>

<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
	<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">

		<a href="javascript:alimtalkChk('delay-bae');" class="btn btn-sm btn-warning btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">배송지연</span>
		</a>
		<a href="javascript:alimtalkChk('delay-bal');" class="btn btn-sm btn-danger btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">발송지연</span>
		</a>

		<a href="javascript:modalOpen();" class="btn btn-sm btn-info btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">쿠폰발급</span>
		</a>

		<a href="javascript:ifra_xls();" class="btn btn-sm btn-success btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-download"></i>
			</span>
			<span class="text">엑셀다운로드</span>
		</a>

		<span class='btn-danger btn-circle btn-sm'>Q</span> <span class='text-gray-700' style='font-size:12px;'>(스타일퀴즈 다시풀기)</span>&nbsp;&nbsp;
		<span class='btn-warning btn-circle btn-sm'>A</span> <span class='text-gray-700' style='font-size:12px;'>(스타일퀴즈 안함)</span>&nbsp;&nbsp;
		<span class='btn-success btn-circle btn-sm'><i class="fas fa-info-circle"></i></span> <span class='text-gray-700' style='font-size:12px;'>(주문정보)</span>

		<div style='float:right;font-size:14px;color:#777;'>
			결제총액 : <span><?=number_format($payTotalAmt)?> 원</span>
		</div>

		<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
			<tr>
				<th width='50'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
				<th width='70'>번호</th>
				<th>결제구분</th>
				<th>등급</th>
				<th>아이디</th>
				<th>추천인</th>
				<th>성별</th>
				<th>생년월일</th>
				<th>스타일리스트</th>
				<th>거래번호</th>
				<th>결제수단</th>
				<th>결제금액</th>
				<th>주문번호</th>
				<th>결제상태</th>
				<th width='60'>환불</th>
				<th width='120'>결제일시</th>
			</tr>
<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$payTitle = $row["payTitle"];
		$userid = $row["userid"];
		$paynum = $row["paynum"];
		$payMode = $row["payMode"];
		$styleQuiz = $row['styleQuiz'];
		$payAmt = $row["payAmt"];
		$rTime = $row['rTime'];
		$payOk = $row["payOk"];
		$rDate = $row['rDate'];

		if($row["level"])	$levelTxt = "<span class='ico03'>VIP</span>";
		else					$levelTxt = "<span class='ico10'>일반</span>";

		$gender = $row['gender'];
		$bDate = $row['bDate'];
		$rCode = $row["rCode"];

		$pt = '';
		$styleQuizIcon = '';
		$orderNum = '';
		$orderUid = '';
		$stylist = '';

		if($payTitle == 'join'){
			$pt = '스타일링';
			$orderNum = $rTime;

		}elseif($payTitle == 'order'){
			$pt = '상품주문';
			$orderNum = $row["orderNum"];
			$orderUid = $row["orderUid"];
			$stylist = $row["stylist"];

		}elseif($payTitle == 'style'){
			$pt = '스타일링';
			$orderNum = $rTime;

			if($styleQuiz)	$styleQuizIcon = "<span class='btn-danger btn-circle btn-sm'>Q</span>";
			else				$styleQuizIcon = "<span class='btn-warning btn-circle btn-sm'>A</span>";
		}

		if($stylist)	$stylistTxt = $stylist.' ('.$sArr[$stylist].')';
		else			$stylistTxt = '';

		if($payMode == 'card')			$pm = '신용카드';
		elseif($payMode == 'acc')		$pm = '계좌이체';
		elseif($payMode == 'vacc')	$pm = '가상계좌';

		$genderTxt = '';
		if($gender == '1')			$genderTxt = "<span class='ico06'>남</span>";
		elseif($gender == '2')	$genderTxt = "<span class='ico09'>여</span>";

		$fc = '#777';

		//추천인
		if($rCode){
			$rCodeTxt = $rCode.' ('.$sArr[$rCode].')';
			$fc = '#17a673';		//추천했으면 초록색

		}else{
			$rCodeTxt = '';
			$rChk = sqlRowOne("select count(*) from ks_member where rCode='".$userid."'");
			if($rChk)	$fc = '#17a673';	//추천받았어도 초록색
		}

		if($row['payOk'] == '환불'){
			$linkClass = 'pinkLine';
			$cTxt = "checked";
		}else{
			$linkClass = 'grayLine';
			$cTxt = '';
		}
?>
			<tr id='tr<?=$uid?>' class='<?=$linkClass?>'>
				<td><input type="checkbox" name="chk[]" value="<?=$uid?>" class="cMail"></td>
				<td><?=$i?></td>
				<td><?=$pt?> <?=$styleQuizIcon?></td>
				<td><?=$levelTxt?></td>
				<td><span style='color:<?=$fc?>;'><?=$userid?> (<?=$sArr[$userid]?>)</span></td>
				<td><?=$rCodeTxt?></td>
				<td><?=$genderTxt?></td>
				<td><?=$bDate?></td>
				<td><?=$stylistTxt?></td>
				<td><?=$paynum?></td>
				<td><?=$pm?></td>
				<td><?=number_format($payAmt)?></td>
				<td><?=$orderNum?> <?if($payTitle == 'order'){?><a href="javascript:orderView('<?=$orderUid?>');" class='btn btn-success btn-circle btn-sm' title='주문내역'><i class="fas fa-info-circle"></i></a><?}?></td>
				<td><span id='payOkTxt<?=$uid?>'><?=$payOk?></span></td>
				<td>
					<div class="custom-control custom-switch" style="padding-left:45px !important;">
						<input type="checkbox" id="refChk<?=$uid?>" value="<?=$uid?>" class="custom-control-input" <?=$cTxt?>>
						<label class="custom-control-label" for="refChk<?=$uid?>"></label>
					</div>
				</td>
				<td><?=$rDate?></td>
			</tr>


<?
		$i--;
	}

}else{
?>
			<tr>
				<td colspan='16' style='padding:50px 0;text-align:center;'>결제정보가 없습니다.</td>
			</tr>
<?
}
?>
		</table>

	</div>
</div>

<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
?>

<script>
$(function(){
	$('.custom-control-input').bind('click', function() {
		if($(this).is(":checked"))		c = 1; 
		else								c = '';

		u = $(this).val();

		obj = $(this);

		$.post('proc.php',{'c':c,'u':u}, function(){
			$(obj).closest('tr').removeClass('grayLine pinkLine');

			if(c){
				$(obj).closest('tr').addClass('pinkLine');
				$('#payOkTxt'+u).text('환불');
			}else{
				$(obj).closest('tr').addClass('grayLine');
				$('#payOkTxt'+u).text('결제완료');
			}

		});
	});
});
</script>

