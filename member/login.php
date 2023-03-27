<?
include '../header.php';
if (isLogin()) deny();
?>

<div class="subWrap">
	<div class="s_center">

		<!-- 로그인 -->
		<div class="signin">
			<div class="signin__inner">
				<p class="signin__title">로그인</p>

				<!-- 휴대폰 인증용 -->
				<form name="FRM" id="FRM" method="post" action="signup.php">
					<input type="hidden" name="m" value="checkplusService">
					<input type="hidden" name="EncodeData" value="">
				</form>

				<form action="/module/login/login_proc.php" method="post" name="frm01" onsubmit="return check_login_submit();" class="login__form">
					<div class="signin__row">
						<input type="text" name="userid" placeholder="이메일" />
						<input type="password" name="pwd" placeholder="비밀번호" />
					</div>
					<div class="find__info">
						<a href="find_id.php">아이디 찾기</a>
						<a href="find_pwd.php">비밀번호 찾기</a>
						<a href="./signup.php">회원가입 하기</a>
					</div>
					<input type="submit" value="로그인" class="signin__btn login__btn" />
				</form>

				<div class="sns__login">
					<p><span>이용약관, 개인정보 수집 및 이용, 개인정보 제공</span> 내용을 확인하였고 동의합니다.</p>
					<a href="javascript:void(0)" class="signin__btn sns__btn" id="kakao" onclick="kakao_login();">
						<span>카카오로 1초 만에 시작하기</span>
					</a>
					<a href="javascript:void(0)" class="signin__btn sns__btn" id="naver" onclick="naver_login();">
						<span>네이버로 1초 만에 시작하기</span>
					</a>
				<!--
					<a href="javascript:void(0)" class="signin__btn sns__btn" id="google" onclick="google_login();">
						<span>구글로 1초 만에 시작하기</span>
					</a>
				-->
				</div>
			</div>
		</div>
		<!--// 로그인 -->

	</div>
</div>


<?
	define('NAVER_CLIENT_ID', 'wgqkpoWQTDxguYqgQnhM');
	define('NAVER_CLIENT_SECRET', 'AP0_qd89AB');
	define('NAVER_CALLBACK_URL', 'http://edufim.smilework.kr/module/naver/loginCheck.php');

	$naver_state = md5(microtime() . mt_rand());
	$_SESSION['naver_state'] = $naver_state;

	$naver_apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NAVER_CLIENT_ID."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&state=".$naver_state;
?>
<script>

	// onkeypress="if(event.keyCode==13){check_form();}"
	const check_login_submit = function() {
		const form = document.frm01
		if (isFrmEmptyModal(form.userid, "아이디를 입력해 주십시오.")) return false;
		else if (isFrmEmptyModal(form.pwd, "비밀번호를 입력해 주십시오.")) return false;
		else {
			form.target = 'ifra_gbl';
			return true;
		}
	}

    const login_map = {
        kakao_login(){},
        naver_login(){},
        google_login(){},
    }

    const kakao_login = function () {
		url = "https://kauth.kakao.com/oauth/authorize?client_id=787c4f8ceb50df86d81cdb0c6f28209f&redirect_uri=http://edufim.smilework.kr/module/kakao/loginCheck.php&response_type=code";
		location.href = url;        
    }
    const naver_login = function () {
		url = "<?=$naver_apiURL?>";
		location.href = url;
    }
    const google_login = function () {

    }
</script>

<?
include '../footer.php';
?>