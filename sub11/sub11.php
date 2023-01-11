<?
	include '../header.php';
	$side_menu=11;
?>


<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit f20 bold2 c_bora01 nobrb">쿠폰함</div>
			<div class="dp_f couponBoxWrap">
				<div class="couponBox wid50 dp_sb dp_fc">
					<div class="couponTop dp_f dp_c">
						<img src="../images/couponIcon.png" alt="">
						사용가능한 쿠폰
					</div>
					<div class="couponBot dp_f dp_end dp_end02">
						<span class="couponNm c_bora01 bold2 f48">1</span>
						<span>개</span>
					</div>
				</div>
				<div class="couponBox wid50 dp_sb dp_fc">
					<div class="couponTop dp_f dp_c">
						<img src="../images/timeIcon.png" alt="">
						만료임박 쿠폰
					</div>
					<div class="couponBot dp_f dp_end dp_end02">
						<span class="couponNm bold2 f48">0</span>
						<span>개</span>
					</div>
				</div>
			</div>

			<div class="couTabWrap">
				<ul class="couTabBtn dp_f dp_wrap">
					<li class="on"><a href="" title="사용가능">사용가능</a></li>
					<li><a href="" title="만료임박">만료임박</a></li>
					<li><a href="" title="사용완료 · 기간만료">사용완료 · 기간만료</a></li>
					<li><a href="" title="전체 쿠폰">전체 쿠폰</a></li>
				</ul>
				<div class="couTabContWrap">
					<div class="couTabCont">
						<!--보유 쿠폰이 없을 때 뜨는 페이지-->
						<!-- <div class="noCouponWrap txt-c">
							<img src="../images/nocoupon.svg" alt="쿠폰">
							<p class="m-12 bold2">보유하신 쿠폰이 없습니다.</p>
						</div> -->

						<!--보유 쿠폰이 있을 때 뜨는 페이지-->
						<div class="dp_sb dp_wrap">
							<div class="couponUseBox dp_sb dp_fc">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="c_gry_tit f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
						</div>

					</div>
					<div class="couTabCont">
						<div class="dp_sb dp_wrap">
							<div class="couponUseBox dp_sb dp_fc">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="c_gry_tit f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
						</div>
					</div>
					<div class="couTabCont">
						<div class="dp_sb dp_wrap">
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">사용만료</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
						</div>
					</div>
					<div class="couTabCont">
						<div class="dp_sb dp_wrap">
							<div class="couponUseBox dp_sb dp_fc">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="c_gry_tit f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">사용만료</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
							<div class="couponUseBox dp_sb dp_fc used">
								<div class="couponUse dp_sb dp_fc">
									<div>
										<p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
										<p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
									</div>
									<div class="dp_sb dp_end">
										<span class="f12">만료임박</span>
										<p class="c_bora01 bold2 f18">5,000원</p>
									</div>
								</div>
								<div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<script>
$(".couTabBtn > li").on("click",function(event){

	event.preventDefault();

	let tabNumber = $(this).index();

	$(".couTabBtn > li").removeClass("on");
	$(this).addClass("on");

	$(".couTabContWrap .couTabCont").hide();;
	$(".couTabContWrap .couTabCont").eq(tabNumber).show();

});
</script>

<?
	include '../footer.php';
?>
