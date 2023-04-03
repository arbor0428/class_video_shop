<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';
	include '../../module/lib.php';

	//쿼리조건
	$query_ment = "where p.uid>0";

	//결제구분
	if($f_payTitle == 'order')				$query_ment .= " and p.payTitle='order'";
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
	$payTotalAmt = sqlRowOne("select sum(p.payAmt) from ks_payment as p left join ks_order as o on p.orderNum=o.rTime join ks_member as m on p.userid=m.userid $query_ment and p.payOk='결제완료'");

	$sort_ment = "order by p.rTime desc";

	$query = "select p.*, o.stylist, o.status, o.uid as orderUid, m.gender, m.bDate from ks_payment as p left join ks_order as o on p.orderNum=o.rTime join ks_member as m on p.userid=m.userid $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);



	$file_name = date('YmdHis');
	$xls_name = '결제내역_'.$file_name;
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 
?>






<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
	<tr align='center'>
		<td bgcolor='f5f5f5'>결제구분</td>
		<td bgcolor='f5f5f5'>아이디</td>
		<td bgcolor='f5f5f5'>추천인</td>
		<td bgcolor='f5f5f5'>이름</td>
		<td bgcolor='f5f5f5'>성별</td>
		<td bgcolor='f5f5f5'>생년월일</td>
		<td bgcolor='f5f5f5'>스타일리스트</td>
		<td bgcolor='f5f5f5'>거래번호</td>
		<td bgcolor='f5f5f5'>결제수단</td>
		<td bgcolor='f5f5f5'>결제금액</td>
		<td bgcolor='f5f5f5'>주문번호</td>
		<td bgcolor='f5f5f5'>결제상태</td>
		<td bgcolor='f5f5f5'>결제일시</td>
	</tr>



	<?
	$no = $total_record;
	if($total_record){
		while($row = mysql_fetch_array($result)){
			$payTitle = $row["payTitle"];
			$userid = $row["userid"];
			$paynum = $row["paynum"];
			$payMode = $row["payMode"];
			$styleQuiz = $row['styleQuiz'];
			$payAmt = $row["payAmt"];
			$rTime = $row['rTime'];
			$payOk = $row["payOk"];
			$rDate = $row['rDate'];

			$gender = $row['gender'];
			$bDate = $row['bDate'];

			$pt = '';
			$styleQuizIcon = '';
			$orderNum = '';
			$orderUid = '';
			$stylist = '';

			if($payTitle == 'join'){	//회원가입 시 결제를 사용안함으로 join값은 없음...
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

				if($styleQuiz)	$styleQuizIcon = "Q";
				else				$styleQuizIcon = "A";
			}

			if($stylist)	$stylistTxt = $stylist.' ('.$sArr[$stylist].')';
			else			$stylistTxt = '';

			if($payMode == 'card')			$pm = '신용카드';
			elseif($payMode == 'acc')		$pm = '계좌이체';
			elseif($payMode == 'vacc')	$pm = '가상계좌';

			$genderTxt = '';
			if($gender == '1')			$genderTxt = "남";
			elseif($gender == '2')	$genderTxt = "여";

			//추천인
			$rCode = $rArr[$userid];
			if($rCode)	$rCodeTxt = $rCode.' ('.$sArr[$rCode].')';
			else			$rCodeTxt = '';

			if($row['status'] == '환불'){
				$cTxt = "<span style='color:#ff0000;'>환불</span>";
			}else{
				$cTxt = '';
			}
	?>

	<tr align='center' height='30'>
		<td><?=$pt?> <?=$styleQuizIcon?></td>
		<td><?=$userid?></td>
		<td><?=$sArr[$userid]?></td>
		<td><?=$rCodeTxt?></td>
		<td><?=$genderTxt?></td>
		<td><?=$bDate?></td>
		<td><?=$stylistTxt?></td>
		<td style=mso-number-format:'\@'><?=$paynum?></td>
		<td><?=$pm?></td>
		<td style=mso-number-format:'\@'><?=number_format($payAmt)?></td>
		<td style=mso-number-format:'\@'><?=$orderNum?></td>
		<td><?=$payOk?><br><?=$cTxt?></td>
		<td><?=$rDate?></td>
	</tr>
<?
		$no--;
	}
}
?>

</table>