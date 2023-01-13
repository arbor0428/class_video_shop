<?
	include './header.php';
?>

<div class="visual">
	<div class="visualSlick">
		<div class="v_slickBox v_slick01">
			<a href="" title=""><!--background로 처리--></a>
		</div>
		<div class="v_slickBox v_slick02">
			<a href="" title=""><!--background로 처리--></a>
		</div>
		<div class="v_slickBox v_slick03">
			<a href="" title=""><!--background로 처리--></a>
		</div>
		<div class="v_slickBox v_slick04">
			<a href="" title=""><!--background로 처리--></a>
		</div>
		<div class="v_slickBox v_slick05">
			<a href="" title=""><!--background로 처리--></a>
		</div>
	</div>
	<div class="mainVbtnWrap dp_f dp_c">
		<div class="mVstopBtn"></div>
		<div class="mVprevBtn">
			<span class="lnr lnr-chevron-left"></span>
		</div>
		<div class="pagingInfo"></div>
		<div class="mVnextBtn">
			<span class="lnr lnr-chevron-right"></span>
		</div>
	</div>
</div>

<style>
	.visualSlick {
		width: 100%; 
		height: 400px;
	}

	.visualSlick .v_slickBox {
		width: 100%; 
		height: 400px;
		background-position: center center;
		background-size: 100% 100%;
		background-repeat: no-repeat;
	}
	
	.visualSlick .v_slick01 {
		background-image: url("/images/mainslide01.jpg");
	}

	.visualSlick .v_slick02 {
		background-image: url("/images/mainslide01.jpg");
	}

	.visualSlick .v_slick03 {
		background-image: url("/images/mainslide01.jpg");
	}

	.visualSlick .v_slick04 {
		background-image: url("/images/mainslide01.jpg");
	}

	.visualSlick .v_slick05 {
		background-image: url("/images/mainslide01.jpg");
	}

	.visualSlick .v_slick06 {
		background-image: url("/images/mainslide01.jpg");
	}
</style>
<script>

	var $status = $('.pagingInfo');
	var $slickElement = $('.visualSlick');

	$slickElement.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
		//currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
		var i = (currentSlide ? currentSlide : 0) + 1;
		$status.text(i + ' / ' + slick.slideCount);
	});


	$slickElement.slick({ 
		infinite : true, 
		autoplay : true,			// 자동 스크롤 사용 여부
		autoplaySpeed : 3000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
		speed: 500,
		arrows : true,
		fade: false,
		prevArrow : $('.mVprevBtn'), 
		nextArrow : $('.mVnextBtn')
	});
	var flag05 = true;
	$('.mainVbtnWrap .mVstopBtn').click(function(){
		if(flag05){

			$('.visualSlick').slick('slickPause');
			$(this).addClass("on");

			flag05= false;
		} else {
			$('.visualSlick').slick('slickPlay');
			$(this).removeClass("on");

			flag05= true;
		}


	});

</script>

<section class="cont1 blue_gradient c_w">
	<div class="c_center">
		<div class="newWrap">
			<div class="dp_sb dp_c">
				<div class="videoTit dp_f dp_c">
					<span class="newTi dp_f dp_c dp_cc">NEW</span>
					<h3>인기있는 신규 클래스</h3>
				</div>
				<a class="c_tit_btn dp_b bold" href="" title="">전체 클래스 보기+</a>
			</div>
			<div class="p_r newVdSlick_wrap">
				<div class="swiper newVdSlick">
					<div class="swiper-wrapper">
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="priceDet bold">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="priceDet bold">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="priceDet bold">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="priceDet bold">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="priceDet bold">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="priceDet bold">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="priceDet bold">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="priceDet bold">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
		<div class="hotWrap">
			<div class="dp_sb dp_c">
				<div class="videoTit dp_f dp_c">
					<span class="hotTi dp_f dp_c dp_cc">HOT</span>
					<h3>실시간 인기 클래스</h3>
				</div>
				<a class="c_tit_btn dp_b bold" href="" title="">전체 클래스 보기+</a>
			</div>
			<div class="p_r hotVdSlick_wrap">
				<div class="swiper hotVdSlick">
					<div class="swiper-wrapper">
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">무릎손상의 단계별 재활 운동법 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">대학병원 스포츠 의학팀 무릎 재활 프레젠터 직강</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="bold priceDet">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">무릎손상의 단계별 재활 운동법 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">대학병원 스포츠 의학팀 무릎 재활 프레젠터 직강</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="bold priceDet">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">무릎손상의 단계별 재활 운동법 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">대학병원 스포츠 의학팀 무릎 재활 프레젠터 직강</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="bold priceDet">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">무릎손상의 단계별 재활 운동법 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">대학병원 스포츠 의학팀 무릎 재활 프레젠터 직강</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="bold priceDet">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">무릎손상의 단계별 재활 운동법 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">대학병원 스포츠 의학팀 무릎 재활 프레젠터 직강</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="bold priceDet">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">무릎손상의 단계별 재활 운동법 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">대학병원 스포츠 의학팀 무릎 재활 프레젠터 직강</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="bold priceDet">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">무릎손상의 단계별 재활 운동법 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">대학병원 스포츠 의학팀 무릎 재활 프레젠터 직강</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="bold priceDet">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
						<div class="nVdSlickBox swiper-slide">
							<a href="" title="">
								<div class="imgWrap c_gry02 p_r">
									<button type="button" title="관심" class="likeMark"></button>
									<img src="" alt="">
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot">무릎손상의 단계별 재활 운동법 1편</p>
										<p class="nVdtit02 c_gry03 dotdot">대학병원 스포츠 의학팀 무릎 재활 프레젠터 직강</p>
										<ul class="clickicon dp_f dp_c">
											<li class="dp_f dp_c">
												<img src="/images/likeChk.svg" alt="">
												<span>10884</span>
											</li>
											<li class="dp_f dp_c">
												<img src="/images/bestChk.svg" alt="">
												<span>97%</span>
											</li>
										</ul>
									</div>
									<div class="nVdBot">
										<p class="c_w">500,000원</p>
										<span class="c_red bold">46%</span>
										<span class="bold priceDet">월 89,000원</span>
										<span class="monDet">(12개월)</span>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
</section>
<script>
	var swiper01 = new Swiper(".newVdSlick", {
		slidesPerView: 4,
		spaceBetween: 20,
		navigation: {
			nextEl: ".newVdSlick_wrap .swiper-button-next",
			prevEl: ".newVdSlick_wrap .swiper-button-prev",
		},
	});

	var swiper02 = new Swiper(".hotVdSlick", {
		slidesPerView: 4,
		spaceBetween: 20,
		navigation: {
			nextEl: ".hotVdSlick_wrap .swiper-button-next",
			prevEl: ".hotVdSlick_wrap .swiper-button-prev",
		},
	});

</script>
<section class="cont2">
	<div class="c_titWrap blue_gradient c_w">
		<div class="c_center dp_sb dp_end">
			<div class="titcont">
				<p>EDUFIM Event</p>
				<h3>이달의 혜택</h3>
			</div>
			<ul class="indicaotr dp_f">
				<li class="bnrprevBtn"></li>
				<li class="bnrnextBtn"></li>
			</ul>
		</div>
	</div>
	<div class="bannerSlick">
		<div class="b_slickBox b_slick01">
			<a href="" title="" style="display: block; width: 100%; height: 100%;"><!--background로 처리--></a>
		</div>
		<div class="b_slickBox b_slick02">
			<a href="" title="" style="display: block; width: 100%; height: 100%;"><!--background로 처리--></a>
		</div>
		<div class="b_slickBox b_slick03">
			<a href="" title="" style="display: block; width: 100%; height: 100%;"><!--background로 처리--></a>
		</div>
		<div class="b_slickBox b_slick04">
			<a href="" title="" style="display: block; width: 100%; height: 100%;"><!--background로 처리--></a>
		</div>
		<div class="b_slickBox b_slick05">
			<a href="" title="" style="display: block; width: 100%; height: 100%;"><!--background로 처리--></a>
		</div>
	</div>
</section>

<style>
	.bannerSlick {
		width: 100%; 
		height: 200px;
	}

	.bannerSlick .b_slickBox {
		width: 100%; 
		height: 200px;
		background-position: center center;
		background-size: 100% 100%;
		background-repeat: no-repeat;
	}
	
	.bannerSlick .b_slick01 {
		background-image: url("/images/main_eventBnr01.jpg");
	}

	.bannerSlick .b_slick02 {
		background-image: url("/images/main_eventBnr01.jpg");
	}

	.bannerSlick .b_slick03 {
		background-image: url("/images/main_eventBnr01.jpg");
	}

	.bannerSlick .b_slick04 {
		background-image: url("/images/main_eventBnr01.jpg");
	}

	.bannerSlick .b_slick05 {
		background-image: url("/images/main_eventBnr01.jpg");
	}

	.bannerSlick .b_slick06 {
		background-image: url("/images/main_eventBnr01.jpg");
	}
</style>
<script>
	$('.bannerSlick').slick({ 
		fade: false,
		dots : true,
		arrows : true,	
		autoplay : true,			// 자동 스크롤 사용 여부
		autoplaySpeed : 5000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
		prevArrow : $('.bnrprevBtn'), 
		nextArrow : $('.bnrnextBtn')
	});
</script>

<section class="cont3 blue_gradient c_w">
	<div class="c_center">
		<!--강의 후기-->
		<div class="c_titWrap dp_sb dp_end">
			<div class="titcont">
				<p>REVIEW</p>
				<h3>강의 후기</h3>
			</div>
			<a class="c_tit_btn" href="" title="">자세히 보기+</a>
		</div>
		<div class="p_r rcmtSlick_wrap">
			<div class="swiper rcmtSlick">
				<div class="swiper-wrapper">
					<div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div>
					<div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div>
					<div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div>
					<div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div>
					<div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div>
					<div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div>
					<div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div>
					<div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div>
				</div>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>


		<div class="p_r rvdoSlick_wrap">
			<div class="swiper rvdoSlick">
				<div class="swiper-wrapper">
					<div class="rvdo_box swiper-slide">
						<a href="" title="">
							<img src="" alt="">
							<img class="playShape" src="/images/playBtn.svg" alt="">
						</a>
					</div>
					<div class="rvdo_box swiper-slide">
						<a href="" title="">
							<img src="" alt="">
							<img class="playShape" src="/images/playBtn.svg" alt="">
						</a>
					</div>
					<div class="rvdo_box swiper-slide">
						<a href="" title="">
							<img src="" alt="">
							<img class="playShape" src="/images/playBtn.svg" alt="">
						</a>
					</div>
					<div class="rvdo_box swiper-slide">
						<a href="" title="">
							<img src="" alt="">
							<img class="playShape" src="/images/playBtn.svg" alt="">
						</a>
					</div>
					<div class="rvdo_box swiper-slide">
						<a href="" title="">
							<img src="" alt="">
							<img class="playShape" src="/images/playBtn.svg" alt="">
						</a>
					</div>
					<div class="rvdo_box swiper-slide">
						<a href="" title="">
							<img src="" alt="">
							<img class="playShape" src="/images/playBtn.svg" alt="">
						</a>
					</div>
				</div>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
		<script>
			var swiper03 = new Swiper(".rvdoSlick", {
				slidesPerView: 3,
				spaceBetween: 20,
				slidesPerGroup: 3,
				navigation: {
					nextEl: ".rvdoSlick_wrap .swiper-button-next",
					prevEl: ".rvdoSlick_wrap .swiper-button-prev",
				},
			});

			var swiper04 = new Swiper(".rcmtSlick", {
				slidesPerView: 4,
				spaceBetween: 20,
				navigation: {
					nextEl: ".rcmtSlick_wrap .swiper-button-next",
					prevEl: ".rcmtSlick_wrap .swiper-button-prev",
				},
			});
		</script>


		<!--자격증 커리큘럼-->
		<div class="c_titWrap dp_sb dp_end">
			<div class="titcont">
				<p>Curriculum</p>
				<h3>자격증 커리큘럼</h3>
			</div>
			<a class="c_tit_btn" href="" title="">자세히 보기+</a>
		</div>
		
		<div class="curri_slick_wrap p_r">
			<div class="swiper curri_slick">
				<div class="swiper-wrapper">
					<div class="curri_box swiper-slide">
						<p class="c_bora01 bold2 txt-c">국제인증강사</p>
						<a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="" title="자세히 보기">자세히 보기</a>
					</div>
					<div class="curri_box swiper-slide">
						<p class="c_bora01 bold2 txt-c">물리치료사강사</p>
						<a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="" title="자세히 보기">자세히 보기</a>
					</div>
					<div class="curri_box swiper-slide">
						<p class="c_bora01 bold2 txt-c">anatomy master</p>
						<a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="" title="자세히 보기">자세히 보기</a>
					</div>
					<div class="curri_box swiper-slide">
						<p class="c_bora01 bold2 txt-c">체형분석평가사</p>
						<a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="" title="자세히 보기">자세히 보기</a>
					</div>
					<div class="curri_box swiper-slide">
						<p class="c_bora01 bold2 txt-c">골프피지오 2급</p>
						<a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="" title="자세히 보기">자세히 보기</a>
					</div>
					<div class="curri_box swiper-slide">
						<p class="c_bora01 bold2 txt-c">필라테스시퀀스처방사</p>
						<a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="" title="자세히 보기">자세히 보기</a>
					</div>
					<div class="curri_box swiper-slide">
						<p class="c_bora01 bold2 txt-c">필라테스지도자</p>
						<a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="" title="자세히 보기">자세히 보기</a>
					</div>
					<div class="curri_box swiper-slide">
						<p class="c_bora01 bold2 txt-c">체형분석운동지도자</p>
						<a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="" title="자세히 보기">자세히 보기</a>
					</div>
				</div>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>

		<script>
			var swiper05 = new Swiper(".curri_slick", {
				slidesPerView: 4,
				spaceBetween: 20,
				navigation: {
					nextEl: ".curri_slick_wrap .swiper-button-next",
					prevEl: ".curri_slick_wrap .swiper-button-prev",
				},
			});
		</script>

		<!--맞춤 커리큘럼-->
		<div class="c_titWrap dp_f dp_c">
			<span class="aiTi dp_f dp_c dp_cc">AI</span>
			<h3>맞춤 커리큘럼</h3>
			<p class="slash">-</p>
			<ul class="tabBtn02 hashTabBtn dp_f">
				<li class="on dp_f dp_c"><a class="dp_b" href="" title="">#물리치료사</a></li>
				<li class="dp_f dp_c"><a class="dp_b" href="" title="">#필라테스강사</a></li>
				<li class="dp_f dp_c"><a class="dp_b" href="" title="">#트레이너</a></li>
				<li class="dp_f dp_c"><a class="dp_b" href="" title="">#일반인</a></li>
			</ul>
		</div>
		<div class="tabCont02 hashTabCont">
			<div class="tabBox">
				<ul class="curricul_list box_06 dp_sb">
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0101">
							<p class="c_w">평가과정</p>
							<span class="c_gry06">Evaluation process</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0102">
							<p class="c_w">도수기법</p>
							<span class="c_gry06">Manual therapy</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0103">
							<p class="c_w">운동접근법</p>
							<span class="c_gry06">Exercise approach</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0104">
							<p class="c_w">필라테스</p>
							<span class="c_gry06">Pilates</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0105">
							<p class="c_w">골프</p>
							<span class="c_gry06">Golf</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0106">
							<p class="c_w">기초해부</p>
							<span class="c_gry06">Basic anatomy</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="tabBox">
				<ul class="curricul_list box_05 dp_sb">
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0201">
							<p class="c_w">기초해부</p>
							<span class="c_gry06">Basic anatomy</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0202">
							<p class="c_w">체형분석</p>
							<span class="c_gry06">Body type analysis</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0203">
							<p class="c_w">교정운동</p>
							<span class="c_gry06">Corrective exercise</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0204">
							<p class="c_w">시퀀스</p>
							<span class="c_gry06">Sequence</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0205">
							<p class="c_w">골프</p>
							<span class="c_gry06">Golf</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="tabBox">
				<ul class="curricul_list box_05 dp_sb">
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0301">
							<p class="c_w">기초해부</p>
							<span class="c_gry06">Basic anatomy</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0302">
							<p class="c_w">체형분석</p>
							<span class="c_gry06">Body type analysis</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0303">
							<p class="c_w">교정운동</p>
							<span class="c_gry06">Corrective exercise</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0304">
							<p class="c_w">시퀀스</p>
							<span class="c_gry06">Sequence</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0305">
							<p class="c_w">골프</p>
							<span class="c_gry06">Golf</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="tabBox">
				<ul class="curricul_list box_02 dp_sb">
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0401">
							<p class="c_w">필라테스 지도자</p>
							<span class="c_gry06">Pilates leader</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
					<li>
						<a class="classShowBtn" href="" title="" data-dp="0402">
							<p class="c_w">홈트</p>
							<span class="c_gry06">Home training</span>
							<div class="plus_btn dp_f dp_c dp_cc">+</div>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<script>
			var posY;

			$(".classShowBtn").click(function(event){
				event.preventDefault();

				posY = $(window).scrollTop();
				index = $(this).data('dp');

				$('#classShowFrame').html("<iframe src='./classDetail"+index+".php?uid="+index+"' name='' style='width:100%;height:675px;' frameborder='0' scrolling='auto'></iframe>");
				$('.classShow_open').click();
				$("html, body").addClass("not_scroll");
				$("section").css("top",-posY);
			});

		</script>

		<!--한컷 강의-->
		<div class="c_titWrap dp_f">
			<h3>한컷 강의</h3>

			<ul class="tabBtn04 vdTabBtn dp_f">
				<li><a class="on dp_f dp_c dp_cc" href="#vdcontSlick01" title="">#2022년 앞서가는 운동지도자가 되고 싶다면</a></li>
				<li><a class="dp_f dp_c dp_cc" href="#vdcontSlick02" title="">#기초가 탄탄한 운동 지도자가 되고 싶다면</a></li>
				<li><a class="dp_f dp_c dp_cc" href="#vdcontSlick03" title="">#필라테스 지도자를 꿈꾸고 있다면</a></li>
			</ul>

		</div>
		<div class="tabCont04 vdTabCont">
			<div id="vdcontSlick01" class="tabBox">
				<div class="vdTabSlick01_wrap p_r">
					<div class="swiper vdTabSlick01 vdTabSlick">
						<div class="swiper-wrapper">
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
						</div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
			<div id="vdcontSlick02" class="tabBox">
				<div class="vdTabSlick02_wrap p_r">
					<div class="swiper vdTabSlick02 vdTabSlick">
						<div class="swiper-wrapper">
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
						</div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
			<div id="vdcontSlick03" class="tabBox">
				<div class="vdTabSlick03_wrap p_r">
					<div class="swiper vdTabSlick03 vdTabSlick">
						<div class="swiper-wrapper">
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
							<div class="rvdo_box swiper-slide">
								<a href="" title="">
									<img src="" alt="">
									<img class="playShape" src="/images/playBtn.svg" alt="">
								</a>
							</div>
						</div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</div>

	</div>
</section>
<script>

	$(".tabBtn02 > li").on("click",function(event){

		event.preventDefault();

		let tabNumber = $(this).index();

		$(".tabBtn02 > li").removeClass("on");
		$(this).addClass("on");

		$(".tabCont02 > .tabBox").hide();
		$(".tabCont02 > .tabBox").eq(tabNumber).show();

	});

	$(".tabBtn04 > li").on("click",function(event){

		event.preventDefault();

		let tabNumber = $(this).index();

		$(".tabBtn04 > li > a").removeClass("on");
		$(this).children("a").addClass("on");
		

		$(".tabCont04 > .tabBox").hide();
		$(".tabCont04 > .tabBox").eq(tabNumber).show();

	});

	var swiper06 = new Swiper(".vdTabSlick01", {
		slidesPerView: 3,
		spaceBetween: 20,
		navigation: {
			nextEl: ".vdTabSlick01_wrap .swiper-button-next",
			prevEl: ".vdTabSlick01_wrap .swiper-button-prev",
		},
	});

	var swiper07 = new Swiper(".vdTabSlick02", {
		slidesPerView: 3,
		spaceBetween: 20,
		navigation: {
			nextEl: ".vdTabSlick02_wrap .swiper-button-next",
			prevEl: ".vdTabSlick02_wrap .swiper-button-prev",
		},
	});

	var swiper08 = new Swiper(".vdTabSlick03", {
		slidesPerView: 3,
		spaceBetween: 20,
		navigation: {
			nextEl: ".vdTabSlick03_wrap .swiper-button-next",
			prevEl: ".vdTabSlick03_wrap .swiper-button-prev",
		},
	});

</script>
<script>

	// $('.vdTabSlick01').slick({ 
	// 	fade: false,
	// 	dots : false,
	// 	arrows : true,	
	// 	autoplay : false,			// 자동 스크롤 사용 여부
	// 	autoplaySpeed : 5000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
	// 	slidesToShow : 3,        // 한 화면에 보여질 컨텐츠 개수
    //  	slidesToScroll : 1,        //스크롤 한번에 움직일 컨텐츠 개수
	// });

	// $('.vdTabSlick02').slick({ 
	// 	fade: false,
	// 	dots : false,
	// 	arrows : true,	
	// 	autoplay : false,			// 자동 스크롤 사용 여부
	// 	autoplaySpeed : 5000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
	// 	slidesToShow : 3,        // 한 화면에 보여질 컨텐츠 개수
    //  	slidesToScroll : 3,        //스크롤 한번에 움직일 컨텐츠 개수
	// });

	// $('.vdTabSlick03').slick({ 
	// 	fade: false,
	// 	dots : false,
	// 	arrows : true,	
	// 	autoplay : false,			// 자동 스크롤 사용 여부
	// 	autoplaySpeed : 5000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
	// 	slidesToShow : 3,        // 한 화면에 보여질 컨텐츠 개수
    //  	slidesToScroll : 3,        //스크롤 한번에 움직일 컨텐츠 개수
	// });

	// $('.tabCont04 .tabBox').hide();
	// 	$('.tabBtn04 a').click(function () {
	// 		$('.tabCont04 .tabBox').hide().filter(this.hash).fadeIn();
	// 		$('.vdTabSlick').slick('slickGoTo', 0); //탭클릭시 slick의 순서를 0번째부터 나오게
	// 		$('.vdTabSlick').slick('setPosition'); //slick의 위치를 수동으로 새로 고쳐줌
			
	// 		$('.tabBtn04 a').removeClass('on');
	// 		$(this).addClass('on');
	// 		return false;
	// 	}).filter(':eq(0)').click();

</script>
<section class="cont4">
	<p class="blueBigTit">EDU FIM</p>
	<img class="symbol" src="/images/symbol.svg" alt="">
	<!--absolute-->

	<div class="c_center p_r">
		<div class="c_titWrap dp_sb c_blue dp_end">
			<div class="titcont">
				<p class="bold2">EDUFIM Instructor</p>
				<h3>에듀핌의 전문가팀을 소개합니다.</h3>
			</div>
			<a class="c_tit_btn c_blue" href="" title="">자세히 보기+</a>
		</div>
		<ul class="eduPerSlickBtn dp_f">
			<li class="eduPerprevBtn"></li>
			<li class="stop"><a href=""></a></li>
			<li class="eduPernextBtn"></li>
		</ul>
		<div class="eduPerSlick">
			<div class="eduPerBox">
				<div class="dp_f">
					<div class="perWrap">
						<img src="/images/instructor1.png" alt="">
					</div>
					<div class="perYear">
						<p class="perNm">김철원 대표이사</p>
						<ul class="perYearCont">
							<li class="bold2">약력</li>
							<li>現 라온필라테스 대표</li>
							<li>現 (주)에듀핌 대표이사</li>
							<li>現 대한물리치료사협회 정회원</li>
							<li>現 대한정형도수물리치료학회 정회원</li>
							<li>現 대한 고유수용성신경근촉진법 학회 정회원</li>
							<li>前 현명의원 도수치료센터 센터장</li>
							<li>前 동서한방병원 재활치료센터</li>
							<li>前 SRC 삼육 재활 전문 센터</li>
							<li>前 농촌진흥원 장수마을 프로젝트 연구원</li>
						</ul>
						<div class="vdTastyTit bold2">영상 맛보기</div>
						<div class="vdTastyImg">
							<img src="" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="eduPerBox">
				<div class="dp_f">
					<div class="perWrap">
						<img src="/images/instructor2.png" alt="">
					</div>
					<div class="perYear">
						<p class="perNm">박지우 이사</p>
						<ul class="perYearCont">
							<li class="bold2">약력</li>
							<li>現 라온필라테스 원장</li>
							<li>現 대한자세통합필라테스협회 수석강사</li>
							<li>現 (주)에듀핌 이사</li>
							<li>現 움직임과학연구소 책임연구원</li>
							<li>現 대한물리치료사협회 정회원</li>
							<li>現 대한정형도수물리치료학회 정회원</li>
							<li>現 메디컬 인모션 아이디어팩토리 대표강사</li>
							<li>現 메디컬 필라테스 아이디어팩토리 강사</li>
							<li>現 현명의원 도수치료센터 센터장</li>
							<li>現 영동신경외과 근무</li>
						</ul>
						<div class="vdTastyTit">영상 맛보기</div>
						<div class="vdTastyImg">
							<img src="" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="eduPerBox">
				<div class="dp_f">
					<div class="perWrap">
						<img src="/images/instructor3.png" alt="">
					</div>
					<div class="perYear">
						<p class="perNm">윤소군 이사</p>
						<ul class="perYearCont">
							<li class="bold2">약력</li>
							<li>現 라온필라테스 대표</li>
							<li>現 (주)에듀핌 이사</li>
							<li>現 움직임 과학연구소장</li>
							<li>現 대한물리치료사협회 정회원</li>
							<li>現 대한정형도수물리치료학회 정회원</li>
							<li>現 메디컬 인모션 아이디어 팩토리 대표강사</li>
							<li>現 메디컬 필라테스 아이디어 팩토리 강사</li>
							<li>前 현명의원 도수치료센터 부센터장</li>
							<li>前 동서한방병원 재활치료실 팀장</li>
						</ul>
						<div class="vdTastyTit">영상 맛보기</div>
						<div class="vdTastyImg">
							<img src="" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="eduPerBox">
				<div class="dp_f">
					<div class="perWrap">
						<img src="/images/instructor4.png" alt="">
					</div>
					<div class="perYear">
						<p class="perNm">조정로 강사</p>
						<ul class="perYearCont">
							<li class="bold2">약력</li>
							<li>現 에듀핌 수석강사</li>
							<li>現 라온필라테스 2호점 대표</li>
							<li>現 삼육대학교 근골격계 석사과정</li>
							<li>現 대한물리치료사협회 정회원</li>
							<li>現 대한정형도수물리치료학회 정회원</li>
							<li>現 Austrilia association of massage therapy 정회원</li>
							<li>現 대한무에타이협회 정회원</li>
							<li>現 현명의원 도수치료센터 근무</li>
							<li>現 메디컬 인모션 아이디어팩토리 대표강사</li>
							<li>現 유니버셜 발레단 전담 물리치료사 근무</li>
							<li>現 익산 튼튼병원 슬링치료실 근무</li>
							<li>現 chi-link-remedical-massage therapist</li>
							<li>現 바로 척척의원 도수치료센터 근무</li>
						</ul>
						<div class="vdTastyTit">영상 맛보기</div>
						<div class="vdTastyImg">
							<img src="" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="eduPerBox">
				<div class="dp_f">
					<div class="perWrap">
						<img src="/images/instructor5.png" alt="">
					</div>
					<div class="perYear">
						<p class="perNm">정환진 강사</p>
						<ul class="perYearCont">
							<li class="bold2">약력</li>
							<li>現 에듀핌 수석강사</li>
							<li>現 대한물리치료사협회 정회원</li>
							<li>現 대한정형도수물리치료학회 정회원</li>
							<li>現 메디컬 인모션 아이디어팩토리 대표강사</li>
							<li>現 메디컬 필라테스 아이디어 팩토리 강사</li>
							<li>現 이석 참바른메디컬 센터 팀장</li>
							<li>現 굿닥터신경외과 실장</li>
						</ul>
						<div class="vdTastyTit">영상 맛보기</div>
						<div class="vdTastyImg">
							<img src="" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="eduPerBox">
				<div class="dp_f">
					<div class="perWrap">
						<img src="/images/instructor6.png" alt="">
					</div>
					<div class="perYear">
						<p class="perNm">박두원 강사</p>
						<ul class="perYearCont">
							<li class="bold2">약력</li>
							<li>現 에듀핌 수석강사</li>
							<li>前 일산힐링스 물리치료사</li>
							<li>前 나래울 운동치료사</li>
							<li>前 현대유비스 도수치료사</li>
							<li>前 늘푸른 노인재활운동치료사</li>
							<li>前 허리나은 도수치료사</li>
							<li>前 큰나무 도수치료사</li>
						</ul>
						<div class="vdTastyTit">영상 맛보기</div>
						<div class="vdTastyImg">
							<img src="" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$('.eduPerSlick').slick({ 
		fade: false,
		dots : true,
		arrows : true,	
		autoplay : true,			// 자동 스크롤 사용 여부
		autoplaySpeed : 1000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
		prevArrow : $('.eduPerprevBtn'), 
		nextArrow : $('.eduPernextBtn')
	});

	var flag04 = true;
	$('.eduPerSlickBtn .stop').click(function(){

		if(flag04){
			$('.eduPerSlick').slick('slickPause');
			$(this).addClass("on");

			flag04= false;
		} else {
			$('.eduPerSlick').slick('slickPlay');
			$(this).removeClass("on");
			flag04= true;
		}

	});
</script>
<section class="cont5">
	<div class="c_center dp_sb">
		<div class="ct5_twoBox">
			<div class="c_titWrap dp_sb">
				<div class="titcont">
					<p>NOTICE</p>
					<h3 class="dp_sb dp_c">
						공지사항
						<a class="c_tit_btn" href="" title="">자세히 보기+</a>
					</h3>
				</div>
			</div>
			<div class="gryWrap p_r">
				<ul class="noticeRoll">
					<li>홈페이지를 오픈했습니다. 많은 성원 부탁드립니다.</li>
					<li>홈페이지를 오픈했습니다. 많은 성원 부탁드립니다.</li>
					<li>홈페이지를 오픈했습니다. 많은 성원 부탁드립니다.</li>
					<li>홈페이지를 오픈했습니다. 많은 성원 부탁드립니다.</li>
				</ul>
				<div class="noticeBtn dp_f dp_fc">
					<div class="notipreBtn dp_ib">
						<span class="lnr lnr-chevron-up"></span>
					</div>
					<div class="notinextBtn dp_ib">
						<span class="lnr lnr-chevron-down"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="ct5_twoBox">
			<div class="c_titWrap dp_sb">
				<div class="titcont">
					<p>CONTACT US</p>
					<h3 class="dp_sb dp_c">
						고객센터
						<a class="c_tit_btn" href="" title="">자세히 보기+</a>
					</h3>
				</div>
			</div>
			<div class="gryWrap">
				<ul class="phoneEmail dp_f">
					<li class="dp_f dp_c">
						<img src="/images/s_email.png" alt="">
						<span>전화 문의 : 010-3968-9609</span>
					</li>
					<li class="dp_f dp_c">
						<img src="/images/s_phone.png" alt="">
						<span>이메일 문의 : film2021@naver.com</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<div class="videoPopUp">
	<div class="videoPopUpBox">
		<div class="videoClose dp_f dp_c dp_cc bora">
			<img src="/images/x_btn.png" alt="">
		</div>
		<div class="viPlayWrap">
			<a class="playShape playBtn" href=""><img class="playShape" src="/images/playBtn.svg" alt=""></a>
		</div>
	</div>
</div>
<script>
	$('.noticeRoll').slick({ 
		infinite: true,
		slidesToShow: 1, 
		slidesToScroll: 1, 
		arrows: true,
		vertical: true,
		autoplay: true,
		autoplaySpeed: 1000,
		prevArrow : $('.notipreBtn'), 
		nextArrow : $('.notinextBtn')
	});

	$(".playShape").click(function(event){

		event.preventDefault();

		$(".videoPopUp").stop().fadeIn();
	});

	$(".videoPopUp .videoClose").click(function(event){

		event.preventDefault();

		$(".videoPopUp").stop().fadeOut();
	});
</script>

<?
	include './footer.php';
?>
