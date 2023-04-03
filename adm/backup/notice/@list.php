<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where ptype='M'";

	//구분
	if($f_talkType)	$query_ment .= " and talkType='$f_talkType'";

	//아이디
	if($f_userid)	 $query_ment .= " and userid like '%$f_userid%'";

	//발송일 시작
	if($f_sDate){
		$f_sTime = strtotime($f_sDate);
		$query_ment .= " and rTime>='$f_sTime'";
	}

	//발송일 종료
	if($f_eDate){
		$f_eTime = strtotime($f_eDate);
		$query_ment .= " and rTime<='$f_eTime'";
	}

	$sort_ment = "order by rTime desc";

	$query = "select * from ks_alimtalk_point $query_ment $sort_ment";

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

<?
	$alimtalkPoint = sqlRowOne("select alimtalkPoint from ks_shopConfig");
?>

<div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
	<span class="scorll-hand">
		<img src="/adm/img/scroll_hand.gif" style="max-width:100%;">
	</span>
</div>

<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
	<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">

		<div style='float:right;font-size:14px;color:#777;'>
			보유포인트 : <span><?=number_format($alimtalkPoint)?> P</span>
		</div>

		<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
			<tr>
				<th width='70'>번호</th>
				<th>포인트</th>
				<th>유형</th>
				<th width='300'>아이디</th>
				<th>내용</th>
				<th width='120'>발송일시</th>
			</tr>
<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$point = $row["point"];
		$userid = $row["userid"];
		$talkType = $row["talkType"];
		$pMent = $row["pMent"];
		$rDate = $row["rDate"];

		$txt = '';

		if($talkType == 'charge')				$txt = '충전';
		elseif($talkType == 'style')				$txt = '스타일링';
		elseif($talkType == 'orderList')			$txt = '상품발송';
		elseif($talkType == '3day')				$txt = '3일경과';
		elseif($talkType == '4day')				$txt = '4일경과';
		elseif($talkType == 'order')				$txt = '상품결제';
		elseif($talkType == 'return')			$txt = '반품접수';
		elseif($talkType == 'review')			$txt = '리뷰등록';
		elseif($talkType == 'coupon')			$txt = '쿠폰발급';
		elseif($talkType == 'delay-bae')		$txt = '배송지연';
		elseif($talkType == 'delay-bal')		$txt = '발송지연';

		if($userid == 'admin')	$name = '관리자';
		else							$name = $sArr[$userid];

		$uArr = explode(',',$userid);
?>
			<tr class='grayLine'>
				<td><?=$i?></td>
				<td><?=number_format($point)?></td>
				<td><?=$txt?></td>
				<td>
				<?
					$n = 0;
					foreach($uArr as $v){
						if($n > 0)	echo ', ';
						echo $v.' ('.$sArr[$v].')';
						$n++;
					}
				?>
				</td>
				<td style='text-align:left;'>
				<?
					echo str_replace("\n","<br>",$pMent);
				?>
				</td>
				<td><?=$rDate?></td>
			</tr>


<?
		$i--;
	}

}else{
?>
			<tr>
				<td colspan='6' style='padding:50px 0;text-align:center;'>알림톡 발송 내역이 없습니다.</td>
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