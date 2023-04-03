<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';
	include '../../module/lib.php';

	//쿼리조건
	$query_ment = "where uid>0";

	//구분
	if($f_ptype)	$query_ment .= " and ptype='$f_ptype'";

	//아이디
	if($f_userid)	 $query_ment .= " and userid like '%$f_userid%'";

	//처리일 시작
	if($f_sDate){
		$f_sTime = strtotime($f_sDate);
		$query_ment .= " and rTime>='$f_sTime'";
	}

	//처리일 종료
	if($f_eDate){
		$f_eTime = strtotime($f_eDate);
		$query_ment .= " and rTime<='$f_eTime'";
	}

	$sort_ment = "order by rTime desc";

	$query = "select * from ks_pointList $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);



	$file_name = date('YmdHis');
	$xls_name = '포인트내역_'.$file_name;
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 
?>






<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
	<tr align='center'>
		<td bgcolor='f5f5f5'>구분</td>
		<td bgcolor='f5f5f5'>아이디</td>
		<td bgcolor='f5f5f5'>이름</td>
		<td bgcolor='f5f5f5'>포인트</td>
		<td bgcolor='f5f5f5'>내용</td>
		<td bgcolor='f5f5f5'>처리일시</td>
	</tr>



<?
$no = $total_record;
if($total_record){
	while($row = mysql_fetch_array($result)){
		$ptype = $row["ptype"];
		$userid = $row["userid"];
		$point = $row["point"];
		$pMent = $row["pMent"];
		$orderNum = $row["orderNum"];
		$rDate = $row['rDate'];

		if($ptype == 'M'){
			$ptxt = '차감';
			$pico = "-";
		}elseif($ptype == 'P'){
			$ptxt = '적립';
			$pico = "+";
		}
?>

	<tr align='center' height='30'>
		<td><?=$ptxt?></td>
		<td><?=$userid?></td>
		<td><?=$sArr[$userid]?></td>
		<td>(<?=$pico?>) <?=number_format($point)?></td>
		<td><?=$pMent?></td>
		<td><?=$rDate?></td>
	</tr>
<?
		$no--;
	}
}
?>

</table>