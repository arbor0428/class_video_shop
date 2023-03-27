<link rel="stylesheet" href="/common/adm/css/login.css"/>

<body>
	<div id="login_container">
		<div class="videowrap">
			<!--
            <video autoplay loop muted playsinline>
                <source src="/adm/img/video.mp4">
            </video>
		-->
			<div class="video_bg"><!--video bg--></div>
		</div>
		<div class="loginWrap">

			<form name='frmLogin' class="user" method='post' action='/module/login/login_proc.php'>
				<input type='text' style='display:none;'>
				<input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
				<h1 class="logo"><a href="/adm/"><img src='/images/favicon.png'></a></h1>
				<a class="useBtn" href="#" title="useBtn">Click here!</a>
				<div class="loginBox">
					<h2>관리자 로그인</h2>

					<div class="id_box">
						<div class="form-group">
							<input type="text" name="userid" id="userid" class="form-control form-control-user" placeholder="이메일" onkeypress="if(event.keyCode==13){masterLogin();}">
						</div>
					</div>
					<div class="pass_box">
						<div class="form-group">
							<input type="password" name="pwd" id="pwd" class="form-control form-control-user" placeholder="비밀번호" onkeypress="if(event.keyCode==13){masterLogin();}">
						</div>
					</div>
					<!--<input id="login_btn" type="submit" value="LOG IN">-->
					<a id="login_btn" href="javascript:masterLogin();">접속하기</a>
				</div>
			</form>
		</div>
	</div>
</body>


<script>
	function masterLogin() {
		form = document.frmLogin;

		if (isFrmEmptyModal(form.userid, "아이디를 입력해 주십시오.")) return;
		if (isFrmEmptyModal(form.pwd, "비밀번호를 입력해 주십시오.")) return;

		form.target = 'ifra_gbl';
		form.submit();
	}

	$(function() {
		//처음에 스크롤바 위치 0
		$(window).on("load", function() {
			$("html,body").stop().animate({
				"scrollTop": 0
			}, 10);
		});

		$(".useBtn").on("click", function(event) {

			event.preventDefault();
			$(".loginBox").stop().slideDown();

			//$(".useBtn").addClass("on");
			$(".useBtn").hide();
			alert("LOG IN 버튼을 클릭해주세요");
		});
	});
</script>

<?
include '/home/edufim/www/module/popupoverlay.php';
?>