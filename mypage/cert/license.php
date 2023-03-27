<?
	include "/home/edufim/www/module/login/head.php";
	
$eng_name = sqlRowOne("SELECT eng_name FROM ks_member WHERE userid='$GBL_USERID'");
$eng_title = sqlRowOne("SELECT eng_title FROM ks_class_set WHERE uid='$uid' AND sType='LICENSE'");
$row = sqlRow("SELECT code, rDate FROM ks_cert_license WHERE userid='$GBL_USERID' AND class_set_uid='$uid'");
?>


<style>
	* {
		-webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
		color-adjust: exact !important;                 /*Firefox*/
	}
	.printBtn {cursor:pointer;}
	@page {
		size: A4;
		margin: 1cm 0.7cm;
		/* size: landscape; */
		size: A4 portrait;
	}

	@media print {
		#print_none { display:none; }
		html,
		body {
			width: 135mm;
			height: 187mm;
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
<div class="completionWrap page">
    <div class="certificateBox">
        <div class="compleNm c_w f12 light"><?= $row['code'] ?></div>
        <div class="compleTop txt-c">
            <p class="f18 bold2 m_20 dp_f dp_end02" style="margin-right: 60px;"><?= $eng_title ?><br>
                <?= $row['code'] ?></p>
            <div class="compleTop_bar f16 dp_f dp_c dp_cc">THIS CERTIFICATE IS PRESNTED TO</div>
            <div class="compleTop_nm f42"><?= $eng_name ?></div>
			<div class="p_r">
				<p class="compleTop_det f16">The abore persons are recogniced as pilates instructor qualifications because <br> they have completed the curriculun of the Association.</p>
			 	<img class="stamp" src="/images/stamp.jpg">
			 </div>
        </div>
        <div class="dp_sb compleBot">
            <div class="compleBot_date">
                <p class="compleBot_date_det txt-c f16"><?= $row['rDate'] ?></p>
                <p class="compleBot_date_tit txt-c f16 bold2">DATE</p>
            </div>
            <div class="compleBot_sign">
                <p class="compleBot_sign_det txt-c f16"><?= $eng_name ?></p>
                <p class="compleBot_sign_tit txt-c f16 bold2">SIGNATURE</p>
            </div>
        </div>
    </div>
</div>

<!-- backup 20230224 parkone -->
<!-- <div class="completionWrap page">
    <div class="certificateBox">
        <div class="compleNm c_w f12 light"><?= $row['code'] ?></div>
        <div class="compleTop txt-c">
            <p class="f18 bold2 m_20 dp_f dp_end02" style="margin-right: 60px;">PILATES INSTRUCTOR<br>
                2022-001257</p>
            <div class="compleTop_bar f16 dp_f dp_c dp_cc">THIS CERTIFICATE IS PRESNTED TO</div>
            <div class="compleTop_nm f42">KIM, EDU FIM</div>
			<div class="p_r">
				<p class="compleTop_det f16">The abore persons are recogniced as pilates instructor qualifications because <br> they have completed the curriculun of the Association.</p>
			 	<img class="stamp" src="/images/stamp.jpg">
			 </div>
        </div>
        <div class="dp_sb compleBot">
            <div class="compleBot_date">
                <p class="compleBot_date_det txt-c f16">2021. 12. 19</p>
                <p class="compleBot_date_tit txt-c f16 bold2">DATE</p>
            </div>
            <div class="compleBot_sign">
                <p class="compleBot_sign_det txt-c f16">PARK JOWOO</p>
                <p class="compleBot_sign_tit txt-c f16 bold2">SIGNATURE</p>
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