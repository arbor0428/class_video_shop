<?
include '../header.php';
?>
<div class="subWrap" style="padding: 63px 0 0 0;">
	<div class="s_center">
		<div class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc">강의후기</div>
		<p class="bold2 m-20 f18 c_bora01 txt-c">REVIEW</p>
		<p class="video_review_tit bold2 f36 txt-c">에듀핌 CAMPUS 영상 후기</p>
		<div class="swiper-container03">
			<div class="swiper-wrapper">
				<div class="swiper-slide dp_f dp_c dp_cc" style="background-image:url('../images/sub/campus_sum.png')">
					<a class="playBtn" href="" title="재생"><img src="../images/playBtn.svg" alt=""></a>
				</div>
				<div class="swiper-slide dp_f dp_c dp_cc" style="background-image:url('../images/sub/campus_sum.png')">
					<a class="playBtn" href="" title="재생"><img src="../images/playBtn.svg" alt=""></a>
				</div>
				<div class="swiper-slide dp_f dp_c dp_cc" style="background-image:url('../images/sub/campus_sum.png')">
					<a class="playBtn" href="" title="재생"><img src="../images/playBtn.svg" alt=""></a>
				</div>
				<div class="swiper-slide dp_f dp_c dp_cc" style="background-image:url('../images/sub/campus_sum.png')">
					<a class="playBtn" href="" title="재생"><img src="../images/playBtn.svg" alt=""></a>
				</div>
				<div class="swiper-slide dp_f dp_c dp_cc" style="background-image:url('../images/sub/campus_sum.png')">
					<a class="playBtn" href="" title="재생"><img src="../images/playBtn.svg" alt=""></a>
				</div>
				<div class="swiper-slide dp_f dp_c dp_cc" style="background-image:url('../images/sub/campus_sum.png')">
					<a class="playBtn" href="" title="재생"><img src="../images/playBtn.svg" alt=""></a>
				</div>
				<div class="swiper-slide dp_f dp_c dp_cc" style="background-image:url('../images/sub/campus_sum.png')">
					<a class="playBtn" href="" title="재생"><img src="../images/playBtn.svg" alt=""></a>
				</div>
				<div class="swiper-slide dp_f dp_c dp_cc" style="background-image:url('../images/sub/campus_sum.png')">
					<a class="playBtn" href="" title="재생"><img src="../images/playBtn.svg" alt=""></a>
				</div>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	</div>
	<script>
		let swiper03 = new Swiper('.swiper-container03', {
			effect: 'coverflow',
			grabCursor: false,
			loop: true,
			// direction: "vertical",
			centeredSlides: true,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			slidesPerView: 'auto',
			coverflowEffect: {
				rotate: 0,
				stretch: 115,
				modifier: 1.5,
				depth: 300,
				slideShadows: true,
				// stretch: 50
			},

		});
	</script>
	<div class="sub08_01_review_wrap">
		<div class="s_center">
			<p class="bold2 f18 c_bora01 txt-c">REVIEW</p>
			<p class="video_review_tit bold2 f36 txt-c m_50">에듀핌 CAMPUS 수강 후기</p>
			<div class="pc_swiperBtn_wrap dp_f dp_c dp_end02 m_10">
				<div class="bnrprevBtn" style="margin-right: 5px;"><img src="../images/sub/review_bottom_btn.svg" alt=""></div>
				<div class="bnrnextBtn"><img src="../images/sub/review_top_btn.svg" alt=""></div>
			</div>
			<!--best-->
			<div class="review_box_wrap">

				<?
				$reviews = sqlArray("SELECT c.title, c.target, m.name, r.content, r.rDate FROM ks_review r JOIN ks_class c ON r.class_uid=c.uid JOIN ks_member m ON r.userid=m.userid ORDER BY rDate DESC");
				for ($i=0; $i <2; $i++) {
					$review = $reviews[$i];
				?>
					<div class="review_box">
						<ul class="top_chk_line dp_f dp_c">
							<li class="top_chk_line_nm c_bora01 f14 bold2 dp_f dp_c"><span class="best_chk bora01 c_w f12">BEST</span><?= $review['title'] ?></li>
							<li class="f14"><?= $review['title'] ?> - <?= $review['target'] ?></li>
						</ul>
						<div class="dp_sb dp_c">
							<div class="per_info_wrap dp_f dp_c">
								<div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"><!--프로필 배경 처리--></div>
								<div class="per_info">
									<p class="bold"><?= $review['name'] ?></p>
									<span class="c_gry04"><?= $review['rDate'] ?></span>
								</div>
							</div>
							<div class="recom_label bora01 dp_inline dp_c">
								<img src="/images/sub/thumb_best.svg" alt="">
								<span class="c_w f12">추천해요</span>
							</div>
						</div>
						<p class="review_detail"><?= $review['content'] ?></p>
					</div>
				<? } ?>
				<!-- <div class="review_box">
					<ul class="top_chk_line dp_f dp_c">
						<li class="best_chk bora01 c_w f12">BEST</li>
						<li class="top_chk_line_nm c_bora01 f14 bold2 dp_f dp_c">체형분석평가사</li>
						<li class="f14">체형분석평가사 자격증 과정 - 발/발목</li>
					</ul>
					<div class="dp_sb dp_c">
						<div class="per_info_wrap dp_f dp_c">
							<div class="per_img" style="background-image:url('/images/sub/no_profile.svg');">프로필 배경 처리</div>
							<div class="per_info">
								<p class="bold">홍길동</p>
								<span class="c_gry04">2022-12-01</span>
							</div>
						</div>
						<div class="recom_label bora01 dp_inline dp_c">
							<img src="/images/sub/thumb_best.svg" alt="">
							<span class="c_w f12">추천해요</span>
						</div>
					</div>
					<p class="review_detail">협회 교육에서 배웠던 내용이지만 그 내용을 더 간결하고 이해하기 쉽게, 기억하기 쉽게 설명해주셨습니다. 더 열심히 공부해서 현장에서 회원의 몸을 보고 1초만에 앞으로의 수업의 그림이 그려지는 강사가 될 수 있길 바랍니다!! 자료도 굉장히 좋았고 수업 구성도 좋았어요 내용이 익혀질 때까지 열심히 복습하고 응용하겠습니다.</p>
				</div> -->
			</div>



			<!--돌아가는 일반 후기-->
			<div class="m_swiperBtn_wrap dp_f dp_c dp_end02 m_10">
				<div class="m_bnrprevBtn" style="margin-right: 5px;"><img src="../images/sub/review_bottom_btn.svg" alt=""></div>
				<div class="m_bnrnextBtn"><img src="../images/sub/review_top_btn.svg" alt=""></div>
			</div>
			<div class="">
				<div class="swiper-container05 review_box_wrap">
					<div class="swiper-wrapper">
						<?
						foreach ($reviews as $review) {
						?>
							<div class="swiper-slide">
								<div class="review_box">
									<ul class="top_chk_line dp_f dp_c">
										<li class="top_chk_line_nm c_bora01 f14 bold2 dp_f dp_c" style="margin-left:0;"><?= $review['title'] ?></li>
										<li class="f14"><?= $review['title'] ?> - <?= $review['target'] ?></li>
									</ul>
									<div class="dp_sb dp_c">
										<div class="per_info_wrap dp_f dp_c">
											<div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"><!--프로필 배경 처리--></div>
											<div class="per_info">
												<p class="bold"><?= $review['name'] ?></p>
												<span class="c_gry04"><?= $review['rDate'] ?></span>
											</div>
										</div>
										<div class="recom_label bora01 dp_inline dp_c">
											<img src="/images/sub/thumb_best.svg" alt="">
											<span class="c_w f12">추천해요</span>
										</div>
									</div>
									<p class="review_detail">협회 교육에서 배웠던 내용이지만 그 내용을 더 간결하고 이해하기 쉽게, 기억하기 쉽게 설명해주셨습니다. 더 열심히 공부해서 현장에서 회원의 몸을 보고 1초만에 앞으로의 수업의 그림이 그려지는 강사가 될 수 있길 바랍니다!! 자료도 굉장히 좋았고 수업 구성도 좋았어요 내용이 익혀질 때까지 열심히 복습하고 응용하겠습니다.</p>
								</div>
							</div>
						<? } ?>
						<!-- <div class="swiper-slide">
							<div class="review_box">
								<ul class="top_chk_line dp_f dp_c">
									<li class="top_chk_line_nm c_bora01 f14 bold2 dp_f dp_c">체형분석평가사</li>
									<li class="f14">체형분석평가사 자격증 과정 - 발/발목</li>
								</ul>
								<div class="dp_sb dp_c">
									<div class="per_info_wrap dp_f dp_c">
										<div class="per_img" style="background-image:url('/images/sub/no_profile.svg');">!--프로필 배경 처리--</div>
										<div class="per_info">
											<p class="bold">홍길동</p>
											<span class="c_gry04">2022-12-01</span>
										</div>
									</div>
									<div class="recom_label bora01 dp_inline dp_c">
										<img src="/images/sub/thumb_best.svg" alt="">
										<span class="c_w f12">추천해요</span>
									</div>
								</div>
								<p class="review_detail">협회 교육에서 배웠던 내용이지만 그 내용을 더 간결하고 이해하기 쉽게, 기억하기 쉽게 설명해주셨습니다. 더 열심히 공부해서 현장에서 회원의 몸을 보고 1초만에 앞으로의 수업의 그림이 그려지는 강사가 될 수 있길 바랍니다!! 자료도 굉장히 좋았고 수업 구성도 좋았어요 내용이 익혀질 때까지 열심히 복습하고 응용하겠습니다.</p>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	// $('.myslick02').slick({
	// 	fade: false,
	// 	dots: false,
	//     vertical: true,
	//     draggable: false,
	// 	arrows: true,
	//     slideToShow: 4,
	//     slideToScroll: 1,
	//     verticalSwiping: true,
	// 	prevArrow: $('.bnrprevBtn'),
	// 	nextArrow: $('.bnrnextBtn')
	// });
	var mySwiper05 = new Swiper('.swiper-container05', {
		direction: 'vertical',
		effect: 'slide',
		slidesPerView: 3,
		loop: true,
		navigation: {
			nextEl: '.bnrnextBtn',
			prevEl: '.bnrprevBtn',

		},
		breakpoints: {
			1024: {
				direction: 'horizontal',
				slidesPerView: 1,
				paceBetween: 50,
				navigation: {
					nextEl: '.m_bnrnextBtn',
					prevEl: '.m_bnrprevBtn',

				},
			},
			600: {
				direction: 'horizontal',
				slidesPerView: 1,
				paceBetween: 50,
				navigation: {
					nextEl: '.m_bnrnextBtn',
					prevEl: '.m_bnrprevBtn',

				},
			},
			200: {
				direction: 'horizontal',
				slidesPerView: 1,
				paceBetween: 50,
				navigation: {
					nextEl: '.m_bnrnextBtn',
					prevEl: '.m_bnrprevBtn',

				},
			},
		},
	})
</script>

<?
include '../footer.php';
?>