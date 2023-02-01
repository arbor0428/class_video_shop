<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
include "/home/edufim/www/module/class/class.Util.php";
include '/home/edufim/www/module/enc_func.php';
// include '/home/edufim/www/module/lib.php';

session_cache_limiter('');
session_start();
Header("p3p: CP=\"CAO DSP AND SO ON\" policyref=\"/w3c/p3p.xml\"");

//글로벌 변수 설정
$GBL_USERID		= strtolower($_SESSION['ses_member_userid']);
$GBL_NAME		= $_SESSION['ses_member_name'];
$GBL_MTYPE		= $_SESSION['ses_member_type'];
$GBL_PASSWORD	= $_SESSION['ses_member_pwd'];

$SYSTEM_DATE = date('Y-m-d');

if ($_SERVER['SERVER_PORT'] == '443') {
	$siteUrl = "https://" . $_SERVER['HTTP_HOST'];
	$siteShortcut = "https://" . $_SERVER['HTTP_HOST'] . "/images/sns_logo.png";
} else {
	$siteUrl = "http://" . $_SERVER['HTTP_HOST'];
	$siteShortcut = "http://" . $_SERVER['HTTP_HOST'] . "/images/sns_logo.png";
}
$strRoot = '../';
$boardRoot = '../board/';

$ver = 20230101;

?>

<!doctype html>
<html lang="ko">

<head>
	<?
	include "/home/edufim/www/module/login/metaTag.php";
	?>

	<link rel="stylesheet" type="text/css" href="/css/reset.css?ver=<?= $ver ?>">
	<link rel="stylesheet" type="text/css" href="/css/style.css?ver=<?= $ver ?>">
	<link rel="stylesheet" type="text/css" href="/css/sub.css?ver=<?= $ver ?>">
	<link rel="stylesheet" type="text/css" href="/css/member.css?ver=<?= $ver ?>">
	<link rel="stylesheet" type="text/css" href="/css/mediaquery.css?ver=<?= $ver ?>">
<!-- 
	<link rel="stylesheet" type="text/css" href="/common/adm/css/style.css?v=<?= $ver ?>">
	<link rel="stylesheet" type="text/css" href="/common/adm/css/button.css?v=<?= $csv ?>"> -->
	
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
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

	<!-- slick 불러오기 -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<!--<script src="/js/slick.min.js"></script>-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

	<!-- swiper -->
	<link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
	<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.css" />

	<!-- bxslider -->
	<link rel="stylesheet" href="/css/jquery.bxslider.css">
	<script type="text/javascript" src="/module/js/jquery.bxslider.js"></script>

	<!-- gsap -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/ScrollTrigger.min.js"></script>

	<title>에듀핌</title>

</head>

<body>