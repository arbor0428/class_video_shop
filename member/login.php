<?
include '../header.php';
?>

<div class="subWrap">
	<div class="s_center">

		<!-- 로그인 -->
		<div class="signin">
			<div class="signin__inner">
				<p class="signin__title">로그인</p>
				<form action="/module/login/login_proc.php" method="post" name="FRM" onsubmit="return check_login_submit();" class="login__form">
					<div class="signin__row">
						<input type="text" name="email" placeholder="이메일 입력 (iwebzone@naver.com)" />
						<input type="password" name="pwd" placeholder="비밀번호 입력 (10자 이상)" />
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
					<a href="javascript:void(0)" class="signin__btn sns__btn" id="kakao">
						<span>카카오로 1초 만에 시작하기</span>
					</a>
					<a href="javascript:void(0)" class="signin__btn sns__btn" id="naver">
						<span>네이버로 1초 만에 시작하기</span>
					</a>
					<a href="javascript:void(0)" class="signin__btn sns__btn" id="goggle">
						<span>구글로 1초 만에 시작하기</span>
					</a>
				</div>
			</div>
		</div>
		<!--// 로그인 -->

	</div>
</div>
<script>
	// onkeypress="if(event.keyCode==13){check_form();}"
	const check_login_submit = function() {
		const form = document.FRM
		const email = form.email.value
		const pwd = form.pwd.value

		if (email === "") {
			GblMsgBox("이메일을 입력해주세요", "")
			return false;
		} else if (pwd === "") {
			GblMsgBox("비밀번호를 입력해주세요", "")
			return false;
		} else {
			form.target = 'ifra_gbl'
			return true;
			// form.submit();
		}
	}
</script>

<?
include '../footer.php';
?>