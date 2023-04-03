<?
	include '../class/class.DbCon.php';
	include "../class/class.Msg.php";

	include '../Mobile-Detect-master/Mobile_Detect.php';
	$detect = new Mobile_Detect;

	if($detect->isMobile())	$UserOS = 'm';
	else							$UserOS = 'p';

	$code = $_GET['code'];

	$CLIENT_ID     = '787c4f8ceb50df86d81cdb0c6f28209f';
	$REDIRECT_URI  = 'http://edufim.smilework.kr/module/kakao/loginCheck.php';
	$params = sprintf('?grant_type=authorization_code&client_id=%s&redirect_uri=%s&code=%s', $CLIENT_ID, $REDIRECT_URI, $code);
	$url = 'https://kauth.kakao.com/oauth/token'.$params;

	$s = curl_init();
	curl_setopt($s, CURLOPT_URL, $url);
	curl_setopt($s, CURLOPT_POST, false);
	curl_setopt($s, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($s);
	$status_code = curl_getinfo($s, CURLINFO_HTTP_CODE);
	curl_close($s);


	$result = json_decode($result,true);

	foreach( $result as $k => $v){
		if($k=='access_token'){
			$access_token = $v;
		}
	}

	$TOKEN_API_URL = "https://kapi.kakao.com/v2/user/me";
	 
	$opts = array(
	   CURLOPT_URL => $TOKEN_API_URL,
	   CURLOPT_SSL_VERIFYPEER => false,
	   CURLOPT_SSLVERSION => 1,
	   CURLOPT_POST => true,
	   CURLOPT_POSTFIELDS => false,
	   CURLOPT_RETURNTRANSFER => true,
	   CURLOPT_HTTPHEADER => array(
		"Authorization: Bearer " . $access_token
		)
	);
	 
	$curlSession = curl_init();
	curl_setopt_array($curlSession, $opts);
	$accessTokenJson = curl_exec($curlSession);
	curl_close($curlSession);

	$accessTokenJson = json_decode($accessTokenJson,true);


	$kakaoID = '';

	foreach($accessTokenJson as $k1 => $v1){
		if(is_array($v1)){
			$kakaoName = $v1['name'];
			$kakaoEmail = $v1['email'];
			$kakaoPhone = $v1['phone_number'];	//ex)+82 10-1234-5678
			if($kakaoPhone){
				$kakaoPhone = str_replace('+82 10','010',$kakaoPhone);
//				$kakaoPhone = str_replace('-','',$kakaoPhone);
			}

			if($v1['birthyear'] && $v1['birthday']){
				$kakaoBirthday = $v1['birthyear'].'-'.substr($v1['birthday'],0,2).'-'.substr($v1['birthday'],2,2);
			}

//			echo $kakaoPhone.' / '.$kakaoBirthday.'/<br>';

			if($v1['gender'] == 'male')				$kakaoGender = 'M';
			elseif($v1['gender'] == 'female')		$kakaoGender = 'F';


			foreach( $v1 as $k2 => $v2){
//				echo "[2] ".$k2.' / '.$v2.'<br>';
			}


		}else{
//			echo "[1] ".$k1.' / '.$v1.'<br>';

			if($k1 == 'id')	$kakaoID = $v1;		//카카오에서 받은 id값으로 가입여부 확인
		}
	}





	if(!$kakaoID){
		Msg::goMsg("카카오 인증실패","/member/login.php");
		exit;

	}else{
		//회원확인
		$row = sqlRow("select * from ks_member where kakaoID='".$kakaoID."'");

		//가입된 아이디 확인
		if($row){
			if($row['status'] == '2'){
				$msg = '관리자 승인 후 로그인이 가능합니다.';
				Msg::goMsg($msg);
				exit;

			}elseif($row['status'] == '3'){
				$msg = '탈퇴처리된 회원입니다.';
				Msg::goMsg($msg);
				exit;

			}else{
				@session_destroy();
				session_start();

				$_SESSION['ses_member_userid']				= $row['userid'];
				$_SESSION['ses_member_name']	 		= $row['name'];		
				$_SESSION['ses_member_type']			= $row['mtype'];
				
				$userip = $_SERVER['REMOTE_ADDR'];
				$rDate = date('Y-m-d H:i:s');
				$rTime = time();

				//마지막 로그인정보
				sqlExe("update ks_member set loginDate='".$rDate."', loginTime=".$rTime." where userid='".$row['userid']."'");

				//로그인 정보기록
				//sqlExe("insert into ks_login_log (mtype,userid,snsLogin,device,userip,rDate,rTime) values ('".$row['mtype']."','".$row['userid']."','kakao','".$UserOS."','".$userip."','".$rDate."','".$rTime."')");

				Msg::goNext('/');
				exit;
			}

		}else{
			//회원가입 페이지로..
			$next_url = '/member/signup2.php';
/*
			$kakaoName = '카카오';
			$kakaoPhone = '010-1234-5678';
			$kakaoBirthday = '1998-06-05';
			$kakaoGender = '남';
*/
?>
<form name='frm01' method='post' action='<?=$next_url?>'>
<input type='hidden' name='kakaoID' value="<?=$kakaoID?>">
<input type='hidden' name='snsName' value="<?=$kakaoName?>">
<input type='hidden' name='snsEmail' value="<?=$kakaoEmail?>">
<input type='hidden' name='snsPhone' value="<?=$kakaoPhone?>">
<input type='hidden' name='snsBirthday' value="<?=$kakaoBirthday?>">
<input type='hidden' name='snsGender' value="<?=$kakaoGender?>">
</form>

<script>
document.frm01.submit();
</script>
<?
		}
	}
?>
