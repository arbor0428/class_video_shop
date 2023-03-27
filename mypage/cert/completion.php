<?php
include "/home/edufim/www/module/login/head2.php";

$eng_name = sqlRowOne("SELECT eng_name FROM ks_member WHERE userid='$GBL_USERID'");
// $eng_name = sqlRowOne("SELECT eng_name FROM ks_member WHERE userid='$GBL_USERID'");
$row = sqlRow("SELECT code, rDate FROM ks_cert_completion WHERE userid='$GBL_USERID' AND class_uid='$uid'");

?>

<style>
	* {
		-webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
		color-adjust: exact !important;                 /*Firefox*/
	}
	.printBtn {cursor:pointer;}
	@page {
		size: A4;
		margin: 0.7cm;
		size: landscape;
	}

	@media print {
		#print_none { display:none; }
		html,
		body {
			width: 280mm;
			height: 180mm;
			background: #fff;
		}

		.page {
			margin: 0;
			border: initial;
			border-radius: initial;
			width: initial;
			min-height: initial;
			box-shadow: initial;
			background: initial;
			page-break-after: always;
		}
		
	}
</style>
<div id="print_none" style="height: 54px;">
	<div class="printBtnWrap"><a class="printBtn dp_f dp_c"><img src="/images/print.svg" alt=""><span class="f12 bold2" style="margin-left: 8px;">인쇄하기</span></a></div>
</div>
<div class="completionWrap">
	<div class="completionBox">
		<div class="compleNm c_w"><?= $row['code'] ?></div>
		<div class="compleTop compleTop02 dp_c">
			<div class="compleTop_left txt-c">
				<div class="compleTop_txt  hahmlet bold2 c_blue03 f20">INTERNATIONAL INSTRUCTOR CERTIFICATE</div>
				<div class="compleTop_nm f54 racingsans c_blue02"><?= $eng_name ?></div>
				<p class="compleTop_det sanchez c_blue03 f20">completed a 30-hour EPS Pilates International Certification<br>
					Instructor organized by the EDUFIM Association.</p>
			</div>
		</div>
		<div class="dp_sb compleBot02 dp_c">
			<div class="compleBot_date">
				<p class="compleBot_date_det txt-c niconne f36"><?= $row['rDate'] ?></p>
				<p class="compleBot_date_tit txt-c greatvibes c_blue02 f24">Date</p>
			</div>
			<div class="p_r">
				<p class="hahmlet bold3 c_blue03 f12">Kim Chul-won, president of the EPS Pilates Association</p>
				<img class="stamp" src="/images/stamp.jpg">
			</div>
			<div class="compleBot_sign">
				<p class="compleBot_sign_det txt-c greatvibes f20"><?= $eng_name ?></p>
				<p class="compleBot_sign_tit txt-c greatvibes c_blue02 f24">Signature</p>
			</div>
		</div>
	</div>
</div>

<!-- backup 20230224 parkone -->
<!-- <div class="completionWrap">
	<div class="completionBox">
		<div class="compleNm c_w">2023-EPQ-0001</div>
		<div class="compleTop compleTop02 dp_c">
			<div class="compleTop_left txt-c">
				<div class="compleTop_txt  hahmlet bold2 c_blue03 f20">INTERNATIONAL INSTRUCTOR CERTIFICATE</div>
				<div class="compleTop_nm f54 racingsans c_blue02">KIM EDUFIM</div>
				<p class="compleTop_det sanchez c_blue03 f20">completed a 30-hour EPS Pilates International Certification<br>
					Instructor organized by the EDUFIM Association.</p>
			</div>
		</div>
		<div class="dp_sb compleBot02 dp_c">
			<div class="compleBot_date">
				<p class="compleBot_date_det txt-c niconne f36">2023. 01. 01</p>
				<p class="compleBot_date_tit txt-c greatvibes c_blue02 f24">Date</p>
			</div>
			<div class="p_r">
				<p class="hahmlet bold3 c_blue03 f12">Kim Chul-won, president of the EPS Pilates Association</p>
				<img class="stamp" src="/images/stamp.jpg">
			</div>
			<div class="compleBot_sign">
				<p class="compleBot_sign_det txt-c greatvibes f36">Park ji woo</p>
				<p class="compleBot_sign_tit txt-c greatvibes c_blue02 f24">Signature</p>
			</div>
		</div>
	</div>
</div> -->

<script language='javascript'>
	function printPage() {
		if (window.print) {
			agree = confirm('현재 페이지를 출력하시겠습니까?');
			if (agree) window.print();
		}
	}
	$('.printBtn').on('click', function(){
		printPage()
	})
	setTimeout('printPage();', 100);
</script>