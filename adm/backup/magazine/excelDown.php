<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	//쿼리조건
	$query_ment = "where uid>0";

	//상태
	if($f_status == '1')		$query_ment .= " and status='1'";
	elseif($f_status == '2')	$query_ment .= " and status=''";

	//분류
	if($f_cade01)	$query_ment .= " and cade01='$f_cade01'";
	if($f_cade02)	$query_ment .= " and cade02='$f_cade02'";
	if($f_cade03)	$query_ment .= " and cade03='$f_cade03'";

	//상품명
	if($f_title)	 $query_ment .= " and title like '%$f_title%'";

	$sort_ment = "order by rTime desc";

	$query = "select * from ks_product $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);



	$file_name = date('YmdHis');
	$xls_name = '상품목록_'.$file_name;
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 
?>






<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
	<tr align='center'>
		<td bgcolor='f5f5f5'>1차분류</td>
		<td bgcolor='f5f5f5'>2차분류</td>
		<td bgcolor='f5f5f5'>3차분류</td>
		<td bgcolor='f5f5f5'>상품명</td>
		<td bgcolor='f5f5f5'>상품가격</td>
		<td bgcolor='f5f5f5'>재고수량</td>
		<td bgcolor='f5f5f5'>상품설명</td>
		<td bgcolor='f5f5f5'>판매상태</td>
		<td bgcolor='f5f5f5'>등록일</td>
	</tr>

	<?
	$no = $total_record;
	if($total_record){
		while($row = mysql_fetch_array($result)){
			$status = $row["status"];
			$cade01 = $row["cade01"];
			$cade02 = $row["cade02"];
			$cade03 = $row["cade03"];
			$title = $row["title"];
			$memo = $row["memo"];
			$price = $row["price"];
			$inven = $row["inven"];
			$rDate = date('Y-m-d',$row['rTime']);

			if($status)	$statusTxt = "O";
			else			$statusTxt = "X";
	?>

	<tr align='center' height='30'>
		<td><?=$cade01?></td>
		<td><?=$cade02?></td>
		<td><?=$cade03?></td>
		<td><?=$title?></td>
		<td style=mso-number-format:'\@'><?=number_format($price)?></td>
		<td style=mso-number-format:'\@'><?=number_format($inven)?></td>
		<td><?=$memo?></td>
		<td><?=$statusTxt?></td>
		<td><?=$rDate?></td>
	</tr>
<?
		$no--;
	}
}
?>

</table>