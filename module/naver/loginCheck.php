<? 
	include '../class/class.DbCon.php';
	include "../class/class.Msg.php";

	include '../Mobile-Detect-master/Mobile_Detect.php';
	$detect = new Mobile_Detect;

	if($detect->isMobile())	$UserOS = 'm';
	else							$UserOS = 'p';

	// NAVER LOGIN 
	define('NAVER_CLIENT_ID', 'wgqkpoWQTDxguYqgQnhM');
	define('NAVER_CLIENT_SECRET', 'AP0_qd89AB');
	define('NAVER_CALLBACK_URL', 'http://edufim.smilework.kr/module/naver/loginCheck.php');

	$errMsg = '';

	$naver_curl = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".NAVER_CLIENT_ID."&client_secret=".NAVER_CLIENT_SECRET."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&code=".$_GET['code']."&state=".$_GET['state'];

	// 토큰값 가져오기
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $naver_curl);
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec ($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close ($ch);

	if($status_code == 200){
		$responseArr = json_decode($response, true);
		$_SESSION['naver_access_token'] = $responseArr['access_token'];
		$_SESSION['naver_refresh_token'] = $responseArr['refresh_token'];
		// 토큰값으로 네이버 회원정보 가져오기 
		$me_headers = array( 'Content-Type: application/json', sprintf('Authorization: Bearer %s', $responseArr['access_token']) );
		$me_is_post = false;
		$me_ch = curl_init();
		curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me");
		curl_setopt($me_ch, CURLOPT_POST, $me_is_post);
		curl_setopt($me_ch, CURLOPT_HTTPHEADER, $me_headers);
		curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true);
		$me_response = curl_exec ($me_ch);
		$me_status_code = curl_getinfo($me_ch, CURLINFO_HTTP_CODE);
		curl_close ($me_ch);
		$me_responseArr = json_decode($me_response, true);

		if ($me_responseArr['response']['id']){
		/*
			$mb_uid = $me_responseArr['response']['id'];
			$mb_email = $me_responseArr['response']['email']; // 이메일
			$mb_name = $me_responseArr['response']['name']; // 이름 
			$mb_gender = $me_responseArr['response']['gender']; // 성별 F: 여성, M: 남성, U: 확인불가 
			if($mb_gender=='M')	$mb_genderTxt='남';
			elseif($mb_gender=='F')	$mb_genderTxt='여';
		*/

			$res = $me_responseArr['response'];

			foreach($res as $k => $v){
//				echo $k.' = '.$v.'<br>';
			}

			$naverID = $res['id'];

			if(!$naverID){
				Msg::goMsg("네이버 인증실패","/member/login.php");
				exit;

			}else{
				//회원확인
				$row = sqlRow("select * from ks_member where naverID='".$naverID."'");

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
						sqlExe("insert into ks_login_log (mtype,userid,snsLogin,device,userip,rDate,rTime) values ('".$row['mtype']."','".$row['userid']."','naver','".$UserOS."','".$userip."','".$rDate."','".$rTime."')");

						Msg::goNext('/');
						exit;
					}

				}else{
					//회원가입 페이지로..
					$next_url = '/member/signup2.php';

					$naverName = $res['name'];
					$naverEmail = $res['email'];
					$naverPhone = $res['mobile'];
					$naverBirthday = $res['birthyear'].'-'.$res['birthday'];

					if($res['gender'] == 'M')		$naverGender = 'M';
					elseif($res['gender'] == 'F')	$naverGender = 'F';
				}
?>
<form name='frm01' method='post' action='<?=$next_url?>'>
<input type='hidden' name='naverID' value="<?=$naverID?>">
<input type='hidden' name='snsName' value="<?=$naverName?>">
<input type='hidden' name='snsEmail' value="<?=$naverEmail?>">
<input type='hidden' name='snsPhone' value="<?=$naverPhone?>">
<input type='hidden' name='snsBirthday' value="<?=$naverBirthday?>">
<input type='hidden' name='snsGender' value="<?=$naverGender?>">
</form>

<script>
document.frm01.submit();
</script>
<?
			}


		}else{
			$errMsg = '네이버 인증실패';
		}


	}else{
		$errMsg = '네이버 인증실패';
	}





if($errMsg){
	Msg::goMsg($errMsg,"/member/login.php");
	exit;
}
?>