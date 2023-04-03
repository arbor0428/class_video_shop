<?php
include "/home/edufim/www/adm/head.php";

if (!$GBL_USERID) {
	header('Location:/');
	exit;
}

if (empty($GBL_UID) || !isset($GBL_UID)) {
	header('Location:/');
	exit;
}
?>

<!doctype html>
<html lang="ko">

<head>
    <title>에듀핌</title>

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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    <!-- gsap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/ScrollTrigger.min.js"></script>
</head>

<body>
    <div id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">