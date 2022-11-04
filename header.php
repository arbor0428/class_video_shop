<?
	include "/home/edufim/www/module/login/head.php";
?>
<header class="blue_gradient c_w">
	<div class="h_top bor_bot">
		<div class="c_center">
			<div class="dp_sb">
				<div class="langWrap">
					<div class="toggleTit dp_f dp_c">
						<img src="../images/earthIcon.svg" alt="">
						<span class="f12 bold" style="margin: 0 15px 0 8px;">KOR</span>
						<div class="dp_f dp_c langArr"><img src="../images/lang_arrow.svg" alt=""></div>
					</div>
					<div class="toggleDown">
						<ul class="toggleDownmenu">
							<li class="dp_f dp_c f12 bold"><span class="mr10">+</span>KOR</li>
							<li class="dp_f dp_c f12 bold"><span class="mr10">-</span>ENG</li>
							<li class="dp_f dp_c f12 bold"><span class="mr10">-</span>CHN</li>
							<li class="dp_f dp_c f12 bold"><span class="mr10">-</span>JAP</li>
						</ul>
					</div>
				</div>
				<ul class="h_top_menu dp_f dp_c">
					<li><a href="" title="회원가입">회원가입</a></li>
					<li><a href="" title="로그인">로그인</a></li>
					<li><a href="" title="장바구니">장바구니</a></li>
				</ul>
			</div>
			<h1 class="logo txt-c"><a href="/" title="logo"><img src="/images/logo.svg" alt="logo"></a></h1>
		</div>
	</div>
	<script>
	var flag = true;
	$(".toggleTit").click(function(){
		if(flag){
			$(".langArr").addClass("on");
			$(".toggleDown").stop().slideDown();

			flag= false;
		} else {
			$(".langArr").removeClass("on");
			$(".toggleDown").stop().slideUp();

			flag= true;
		}
	});

	</script>
	<div class="h_bot">
		<div class="c_center dp_sb">
			<ul class="h_bot_menu dp_f">
				<li><a class="dp_b bold" href="" title="ALL클래스">ALL클래스</a></li>
				<li><a class="dp_b bold" href="" title="이벤트">이벤트</a></li>
				<li><a class="dp_b bold" href="" title="자격증 과정">자격증 과정</a></li>
				<li><a class="dp_b bold" href="" title="BEST 콜라보">BEST 콜라보</a></li>
				<li><a class="dp_b bold" href="" title="대면강의">대면강의</a></li>
				<li><a class="dp_b bold" href="" title="홈트">홈트</a></li>
				<li><a class="dp_b bold" href="" title="스토어">스토어</a></li>
				<li><a class="dp_b bold" href="" title="강의 후기">강의 후기</a></li>
				<li><a class="dp_b bold" href="" title="Q&A">Q&A</a></li>
			</ul>
			<a class="classBtn bora dp_f dp_c dp_cc c_w" href="" title="나의 강의실">나의 강의실</a>
		</div>
		<div class="depthWrap">
			<div class="boxWrap">
				<div class="depthbox" style="height: 450px;">
					<div class="c_center dp_f alcMnWrap">
						<div class="allClassMenu wid20">
							<ul class="depth1">
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="allClassMenu wid20">
							<ul class="depth1">
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="allClassMenu wid20">
							<ul class="depth1">
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="allClassMenu wid20">
							<ul class="depth1">
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="allClassMenu wid20">
							<ul class="depth1">
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a class="c_bora dp_b bold2" href="" title="상위메뉴">상위메뉴</a>
									<ul class="depth2">
										<li>
											<a class="bold2" href="" title="하위메뉴">하위메뉴</a>
											<ul class="depth3">
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
												<li><a class="c_gry dp_b" href="" title="게시물">게시물</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="depthbox">
					<!--빈값 이벤트-->
				</div>
				<div class="depthbox" style="height: 160px;">
					<div class="dp_f hght100">
						<div class="boraMenuTit bora c_w dp_f dp_end02">
							<p class="dp_f dp_c">
								자격증 과정
								<span class="lnr lnr-chevron-right"></span>
							</p>
						</div>
						<ul class="boraMenuCont dp_f">
							<li>
								<ul class="b_menu">
									<li><a href="" title="필라테스시퀀스 처방사">필라테스시퀀스 처방사</a></li>
									<li><a href="" title="근신경움직임 처방사">근신경움직임 처방사</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="골프 필라테스">골프 필라테스</a></li>
									<li><a href="" title="체형분석 운동지도자">체형분석 운동지도자</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="체형분석평가사">체형분석평가사</a></li>
									<li><a href="" title="에듀핌 근골격계시퀀스 지도자">에듀핌 근골격계시퀀스 지도자</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="depthbox">
					<!--빈값 best콜라보-->
				</div>
				<div class="depthbox" style="height: 160px;">
					<div class="dp_f hght100">
						<div class="boraMenuTit bora c_w dp_f dp_end02">
							<p class="dp_f dp_c">
								대면강의
								<span class="lnr lnr-chevron-right"></span>
							</p>
						</div>
						<ul class="boraMenuCont dp_f">
							<li>
								<ul class="b_menu">
									<li><a href="" title="필라테스 지도자 자격증">필라테스 지도자 자격증</a></li>
									<li><a href="" title="CBP 카이로플랙틱">CBP 카이로플랙틱</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="골프 피지오 베이직">골프 피지오 베이직</a></li>
									<li><a href="" title="근막경선 림프반사">근막경선 림프반사</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="골프 피지오 어드벤스">골프 피지오 어드벤스</a></li>
									<li><a href="" title="STM 연부조직이완술">STM 연부조직이완술</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="depthbox" style="height: 160px;">
					<div class="dp_f hght100">
						<div class="boraMenuTit bora c_w dp_f dp_end02">
							<p class="dp_f dp_c">
								홈트
								<span class="lnr lnr-chevron-right"></span>
							</p>
						</div>
						<ul class="boraMenuCont dp_f">
							<li>
								<ul class="b_menu">
									<li><a href="" title="다이어트">다이어트</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="체형교정">체형교정</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="통증 컨트롤">통증 컨트롤</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="depthbox" style="height: 160px;">
					<div class="dp_f hght100">
						<div class="boraMenuTit bora c_w dp_f dp_end02">
							<p class="dp_f dp_c">
								스토어
								<span class="lnr lnr-chevron-right"></span>
							</p>
						</div>
						<ul class="boraMenuCont dp_f">
							<li>
								<ul class="b_menu">
									<li><a href="" title="교재">교재</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="CBP 필로우">CBP 필로우</a></li>
								</ul>
							</li>
							<li>
								<!--빈값-->
							</li>
						</ul>
					</div>
				</div>
				<div class="depthbox" style="height: 160px;">
					<div class="dp_f hght100">
						<div class="boraMenuTit bora c_w dp_f dp_end02">
							<p class="dp_f dp_c">
								강의 후기
								<span class="lnr lnr-chevron-right"></span>
							</p>
						</div>
						<ul class="boraMenuCont dp_f">
							<li>
								<ul class="b_menu">
									<li><a href="" title="하위메뉴">하위메뉴</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="하위메뉴">하위메뉴</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="하위메뉴">하위메뉴</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="depthbox" style="height: 160px;">
					<div class="dp_f hght100">
						<div class="boraMenuTit bora c_w dp_f dp_end02">
							<p class="dp_f dp_c">
								Q&A
								<span class="lnr lnr-chevron-right"></span>
							</p>
						</div>
						<ul class="boraMenuCont dp_f">
							<li>
								<ul class="b_menu">
									<li><a href="" title="하위메뉴">하위메뉴</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="하위메뉴">하위메뉴</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li><a href="" title="하위메뉴">하위메뉴</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<script>
	//pc - header depth2
        
	$(".h_bot_menu > li").mouseenter(function(event){

		event.preventDefault();

		let navnumber = $(this).index();
		console.log(navnumber);

		$(".h_bot_menu > li").removeClass("on");
		$(this).addClass("on");


		$(".depthWrap .depthbox").css({"opacity":0,"display":"none"});
		$(".depthWrap .depthbox").eq(navnumber).css({"opacity":1,"display":"block"});

	});

	$(".h_bot").mouseleave(function(event){

		event.preventDefault();

		$(".h_bot_menu > li").removeClass("on");

		$(".depthWrap .depthbg").stop().animate({"height":"0"},200);
		$(".depthWrap .depthbox").css({"opacity":0,"display":"none"});

	});

</script>