<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	//쿼리조건
	$query_ment = "where mtype='M'";

	//상태
	if($f_status == '1')		$query_ment .= " and status='1'";
	elseif($f_status == '2')	$query_ment .= " and status=''";

	//등급
	if($f_level == '1')			$query_ment .= " and level='VIP'";
	elseif($f_level == '2')	$query_ment .= " and level=''";

	//아이디
	if($f_userid)	 $query_ment .= " and userid like '%$f_userid%'";

	//성명
	if($f_name)	 $query_ment .= " and name like '%$f_name%'";

	if(!$f_sort)	$f_sort = 'rTime';

	if($f_sort == 'rTime')				$sort_ment = "order by rTime desc";
	elseif($f_sort == 'loginTime')	$sort_ment = "order by loginTime desc";

	$query = "select * from ks_member $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);



	$file_name = date('YmdHis');
	$xls_name = '일반회원_'.$file_name;
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 
?>






<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
	<tr align='center'>
		<td bgcolor='f5f5f5'>상태</td>
		<td bgcolor='f5f5f5'>등급</td>
		<td bgcolor='f5f5f5'>아이디</td>
		<td bgcolor='f5f5f5'>닉네임</td>
		<td bgcolor='f5f5f5'>연락처</td>
		<td bgcolor='f5f5f5'>주소</td>
		<td bgcolor='f5f5f5'>이메일</td>
		<td bgcolor='f5f5f5'>마케팅동의</td>
		<td bgcolor='f5f5f5'>가입일시</td>
		<td bgcolor='f5f5f5'>최근접속일시</td>
	</tr>



<?
$nTime = time();

$no = $total_record;

if($total_record){
	while($row = mysql_fetch_array($result)){
		$status = $row["status"];
		$level = $row["level"];
		$userid = $row["userid"];
		$nickname = $row["nickname"];
		$rCode = $row["rCode"];
		$bDate = $row["bDate"];
		$name = $row["name"];
		$gender = $row["gender"];
		$point = $row["point"];
		$phone = $row["phone"];
		$email = $row['email01'].'@'.$row['email02'];
		$addr = $row['addr01'].' '.$row['addr02'];
		if($row['receiveChk'] == 'y')	$receiveChk = '동의';
		else			$receiveChk == '비동의';
		$rDate = $row['rDate'];
		$loginDate = $row['loginDate'];

		if($status)	$statusTxt = "정상";
		else			$statusTxt = "휴면";

		if($level)		$levelTxt = "VIP";
		else			$levelTxt = "일반";

		$genderTxt = '';
		if($gender == '1')			$genderTxt = "남";
		elseif($gender == '2')	$genderTxt = "여";
?>

	<tr align='center' height='30'>
		<td><?=$statusTxt?></td>
		<td><?=$levelTxt?></td>
		<td><?=$userid?></td>
		<td><?=$nickname?></td>
		<td><?=$phone?></td>
		<td><?=$addr?></td>
		<td><?=$email?></td>
		<td><?=$receiveChk?></td>
<!--
		<td style=mso-number-format:'\@'><?=number_format($point)?></td>
		<td>
		<?
			//사용가능한 보유쿠폰
			$cArr = sqlArray("select * from ks_coupon where userid='".$userid."' and orderNum=0 and eTime>'".$nTime."'");
			foreach($cArr as $v){
				echo $v['title'].' ('.number_format($v['price']).')<br>';
			}
		?>
		</td>
		<td style=mso-number-format:'\@'><?=$phone?></td>
		<td><?=$email?></td>
		<td style=mso-number-format:'\@'><?=$zipcode?></td>
		<td><?=$addr?></td>
-->
		<td><?=$rDate?></td>
		<td><?=$loginDate?></td>
	</tr>
<?
		$no--;
	}
}
?>

</table>