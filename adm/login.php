<!doctype html>
<html lang="ko">

<head>
    <title>에듀핌</title>

    <link rel="stylesheet" href="/common/adm/css/login.css"/>
    <link rel="stylesheet" type="text/css" href="/css/reset.css?ver=<?= $ver ?>">
    <link rel="stylesheet" type="text/css" href="/css/style.css?ver=<?= $ver ?>">
    <!-- <link rel="stylesheet" type="text/css" href="/css/sub.css?ver=<?= $ver ?>">
	<link rel="stylesheet" type="text/css" href="/css/member.css?ver=<?= $ver ?>">
	<link rel="stylesheet" type="text/css" href="/css/mediaquery.css?ver=<?= $ver ?>"> -->

    <link rel="stylesheet" type="text/css" href="/common/adm/css/style.css?v=<?= $ver ?>">
    <link rel="stylesheet" type="text/css" href="/common/adm/css/button.css?v=<?= $csv ?>">
    <link rel="stylesheet" type="text/css" href="/common/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/common/vendor/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="/module/popupoverlay/popupoverlay.css">
    <link rel='stylesheet' type='text/css' href='/module/js/placeholder.css'><!-- 웹킷브라우져용 -->

    <!-- Noto Sans KR -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Ubuntu -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <!-- Dancing Script &  Noto Serif-->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Noto+Serif&display=swap" rel="stylesheet">

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.3.js"></script> -->
    <script src="/common/vendor/jquery/jquery.min.js"></script>
    <script src="/common/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/common/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="/module/js/common.js?v=<?= $ver ?>"></script>
    <script src="/module/js/script.js"></script>
    <script src="/module/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
    <script src="/module/js/jquery.easing.min.js"></script>
    <script src="/module/popupoverlay/jquery.popupoverlay.js"></script>

    <!-- aos -->
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
    <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->

    <!-- font awesome -->
    <!-- <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css"> -->

    <!-- gsap -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/ScrollTrigger.min.js"></script> -->
</head>

<body>
	<div id="login_container">
		<div class="videowrap">
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