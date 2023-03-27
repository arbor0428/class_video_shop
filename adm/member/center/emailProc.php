<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include "../../module/class/class.sendmail.php"; 


$from_email = 'biz@contentsbank.co.kr';
$from_name = '스타일세븐';

$f_status = $_POST['f_status'];
$f_level = $_POST['f_level'];
$f_userid = $_POST['f_userid'];
$f_name = $_POST['f_name'];
$memType = $_POST['memType'];

//메일 제목
$title = addslashes(trim($_POST['title']));

//메일 내용
$ment = stripslashes($_POST['ment']);

$userip = $_SERVER['REMOTE_ADDR'];
$rDate = date('Y-m-d H:i:s');
$rTime = time();

$insertQuery = "insert into email_history (title,ment,userip,rDate,rTime) values ('$title','$ment','$userip','$rDate','$rTime')";
sqlExe($insertQuery);
$puid = mysql_insert_id();

$mArr = Array();
$count = 0;

//검색된 회원
if($memType == 'search'){
	$query_ment = " where mtype='M' receiveChk='1'";

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

	$sql = "select * from ks_member $query_ment order by uid desc";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$userid = $row['userid'];
		$name = $row['name'];
		$email = $row['email'];
//		$email = 'iwebzone@naver.com';

		//중복된 메일은 제외
		if(!in_array($email,$mArr)){
			$mArr[] = $email;

			$insertQuery = "insert into email_history_member (puid,userid,receive,receivedate) values ('$puid', '$userid', 'N', '')";
			sqlExe($insertQuery);

			$dMail = new Sendmail; 
			$dMail->setUseSMTPServer(true); 
			$dMail->setFrom($from_email, $from_name); 
			$dMail->setSubject($title); 
			$dMail->setMailBody($ment, true); 
			$dMail->addTo($email, $name); 
			$dMail->send(); 
			unset($dMail);

			$count++;
		}
	}


//선택된 회원
}elseif($memType == 'choice'){
	foreach($chk as $k => $v){
		if($v){
			$sql = "select * from ks_member where uid='$v' and email!='' and receiveChk='1'";
			$row = sqlRow($sql);
			$userid = $row['userid'];
			$name = $row['name'];
			$email = $row['email'];
//			$email = 'iwebzone@naver.com';

			//중복된 메일은 제외
			if(!in_array($email,$mArr)){
				$mArr[] = $email;

				$insertQuery = "insert into email_history_member (puid,userid,receive,receivedate) values ('$puid', '$userid', 'N', '')";
				sqlExe($insertQuery);

				$dMail = new Sendmail; 
				$dMail->setUseSMTPServer(true); 
				$dMail->setFrom($from_email, $from_name); 
				$dMail->setSubject($title); 
				$dMail->setMailBody($ment, true); 
				$dMail->addTo($email, $name); 
				$dMail->send(); 
				unset($dMail);

				$count++;
			}
		}
	}

//전체 회원
}elseif($memType == 'all'){
	$query_ment = " where mtype='M' receiveChk='1'";

	$sql = "select * from ks_member $query_ment order by uid desc";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$userid = $row['userid'];
		$name = $row['name'];
		$email = $row['email'];
//		$email = 'iwebzone@naver.com';

		//중복된 메일은 제외
		if(!in_array($email,$mArr)){
			$mArr[] = $email;

			$insertQuery = "insert into email_history_member (puid,userid,receive,receivedate) values ('$puid', '$userid', 'N', '')";
			sqlExe($insertQuery);

			$dMail = new Sendmail; 
			$dMail->setUseSMTPServer(true); 
			$dMail->setFrom($from_email, $from_name); 
			$dMail->setSubject($title); 
			$dMail->setMailBody($ment, true); 
			$dMail->addTo($email, $name); 
			$dMail->send(); 
			unset($dMail);

			$count++;
		}
	}

}
?>

<script>
parent.parent.modalClose();	//모달창 닫기
alert('<?=$count?> 건의 EMAIL이 발송 되었습니다.');
</script>