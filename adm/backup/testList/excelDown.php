<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';
	include '../../module/lib.php';

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



	$file_name = date('YmdHis');
	$xls_name = '주문목록_'.$file_name;
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 
?>






<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
	<tr align='center'>
		<td bgcolor='f5f5f5'>주문번호</td>
		<td bgcolor='f5f5f5'>아이디</td>
		<td bgcolor='f5f5f5'>주문자</td>
		<td bgcolor='f5f5f5'>추천인</td>
		<td bgcolor='f5f5f5'>스타일리스트</td>
		<td bgcolor='f5f5f5'>결제대기</td>
		<td bgcolor='f5f5f5'>반품요청</td>
		<td bgcolor='f5f5f5'>입금대기</td>
		<td bgcolor='f5f5f5'>결제완료</td>
		<td bgcolor='f5f5f5'>주문금액</td>
		<td bgcolor='f5f5f5'>입금액</td>
		<td bgcolor='f5f5f5'>주문일</td>
	</tr>

<?
$no = $total_record;
if($total_record){
	while($row = mysql_fetch_array($result)){
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

			if($row['status'] == '입금대기')	$payAmt = 0;

			if($row['status'] == '환불')		$cTxt = "환불";
			else									$cTxt = '';

			//추천인
			$rCode = $rArr[$userid];
			if($rCode)	$rCodeTxt = $rCode.' ('.$sArr[$rCode].')';
			else			$rCodeTxt = '';

			//스타일리스트
			if($stylist)	$stylistTxt = $stylist.' ('.$sArr[$stylist].')';
			else			$stylistTxt = '';
?>

	<tr align='center' height='30'>
		<td><?=$rTime?> <?=$cTxt?></td>
		<td><?=$userid?></td>
		<td><?=$name?></td>
		<td><?=$rCodeTxt?></td>
		<td><?=$stylistTxt?></td>
		<td style=mso-number-format:'\@'><?=$cnt01Txt?></td>
		<td style=mso-number-format:'\@'><?=$cnt02Txt?></td>
		<td style=mso-number-format:'\@'><?=$cnt04Txt?></td>
		<td style=mso-number-format:'\@'><?=$cnt05Txt?></td>
		<td style=mso-number-format:'\@'><?=number_format($prodAmt)?></td>
		<td style=mso-number-format:'\@'><?=number_format($payAmt)?></td>
		<td><?=$orderDate?></td>
	</tr>
<?
		$no--;
	}
}
?>

</table>