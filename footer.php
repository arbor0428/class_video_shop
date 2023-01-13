		<div class="fixBtnWrap">
			<div class="mediaWrap dp_f dp_fc">
				<div class="mediaOpenBtn bora"></div>
				<ul class="mediaToggle dp_f dp_fc">
					<li><a class="dp_b" href="http://blog.naver.com/movement-lab" target="_blank"></a></li>
					<li><a class="dp_b" href="http://pf.kakao.com/_bsqxcK" target="_blank"></a></li>
					<li><a class="dp_f dp_c dp_cc" href="http://instagram.com/edu_fim?igshid=YmMyMTA2M2Y=" target="_blank"><img src="/images/in_icon.png"></a></li>
				</ul>
			</div>
			<ul class="updownWrap dp_f dp_fc">
				<li><a class="upBtn dp_f dp_c dp_cc" href=""><img src="/images/upward.svg" alt=""></a></li>
				<li><a class="downBtn dp_f dp_c dp_cc" href=""><img src="/images/downward.svg" alt="" style="transform:rotate(180deg);"></a></li>
			</ul>
		</div>

		<script>
			//mediaWrap
			$(".mediaToggle").stop().slideDown();

			var fsite = true;
			$(".mediaOpenBtn").on("click",function(){
				if(fsite){
					$(".mediaToggle").stop().slideUp();
					$(this).addClass("on");

					fsite= false;
				} else {
					$(".mediaToggle").stop().slideDown();
					$(this).removeClass("on");

					fsite= true;
				}

			});


			// 맨위로 가기	
			$('.upBtn').click(function(){
				$('html, body').animate({scrollTop:0}, 400);
				return false;
			});	

			// 맨아래로 가기	
				$('.downBtn').click(function(){
				$('html, body').animate({scrollTop:5000}, 400);
				return false;
			});	
	
			$('.likeMark').click(function(event){ 
				event.preventDefault();
				$(this).toggleClass("on");
			});
		</script>

		<footer class="blue_gradient c_w">
			<div class="f_top01 bor_bot">
				<div class="c_center txt-c">
					<img src="/images/custMedal.png" alt="">
					<p class="yelloTit bold2">2021 대한민국 고객만족지수 1위 교육(재활치료, 필라테스) 부문 수상</p>
					<p class="f_top01_det">지속적인 서비스 품질개선에 적극 반영하여 더 좋은 교육 컨텐츠로 보답하겠습니다.</p>
					<a class="startBtn dp_f dp_c dp_cc bold2" href="" title="">에듀핌 시작하기</a>
				</div>
			</div>
			<div class="f_top02 bor_bot">
				<div class="c_center dp_sb dp_c">
					<ul class="familySlickBtn dp_f">
						<li class="famprevBtn"></li>
						<li class="stop"><a href=""></a></li>
						<li class="famnextBtn"></li>
					</ul>
					<div class="familySlickWrap">
						<div class="f_SlickBox">
							<a href="http://www.korcham.net/nCham/Service/Main/appl/Main.asp" title="대한상공회의소" target="_blank">
								<img src="/images/footer_logo1.png" alt="">
							</a>
						</div>
						<div class="f_SlickBox">
							<a href="https://pqi.or.kr/inf/qul/infQulList.do" title="한국직업능력개발원" target="_blank">
								<img src="/images/footer_logo2.png" alt="">
							</a>
						</div>
						<div class="f_SlickBox">
							<a href="https://www.nile.or.kr/index.jsp" title="국가평생교육진흥원" target="_blank">
								<img src="/images/footer_logo3.png" alt="">
							</a>
						</div>
						<div class="f_SlickBox">
							<a href="http://www.kpta.co.kr/center" title="대한물리치료사협회" target="_blank">
								<img src="/images/footer_logo4.png" alt="">
							</a>
						</div>
						<div class="f_SlickBox">
							<a href="https://www.kaot.org/main/index.jsp" title="대한작업치료사협회" target="_blank">
								<img src="/images/footer_logo5.png" alt="">
							</a>
						</div>
						<div class="f_SlickBox">
							<a href="http://www.ckpta.org/" title="대한퍼스널트레이닝협회" target="_blank">
								<img src="/images/footer_logo6.png" alt="">
							</a>
						</div>
						<div class="f_SlickBox">
							<a href="https://www.kspo.or.kr/kspo/main/main.do" title="국민체육진흥공단" target="_blank">
								<img src="/images/footer_logo7.png" alt="">
							</a>
						</div>
						<div class="f_SlickBox">
							<a href="http://www.kyobobook.co.kr/" title="교보문고" target="_blank">
								<img src="/images/footer_logo8.png" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="f_bot01 bor_bot">
				<div class="c_center dp_sb dp_c">
					<ul class="f_bot01_menu dp_f">
						<li><a href="" title="">회사소개</a></li>
						<li><a href="" title="">이용약관</a></li>
						<li><a href="" title="">개인정보처리방침</a></li>
					</ul>
					<ul class="f_bot01_sns dp_f">
						<li><a href="" title="페이스북"><img src="/images/whtface.svg" alt=""></a></li>
						<li><a href="http://instagram.com/edu_fim?igshid=YmMyMTA2M2Y=" title="인스타그램" target="_blank"><img src="/images/whtinsta.svg" alt=""></a></li>
						<li><a href="http://blog.naver.com/movement-lab" title="블로그" target="_blank"><img src="/images/whtblog.svg" alt=""></a></li>
						<li><a href="http://pf.kakao.com/_bsqxcK" title="카카오" target="_blank"><img src="/images/whttalk.svg" alt=""></a></li>
					</ul>
				</div>
			</div>
			<div class="f_bot02">
				<div class="c_center">
					<img class="f_logo" src="/images/footer_logo.svg" alt="">
					<div class="dp_sb">
						<div class="f_bot02_left">
							<div class="dp_f">
								<ul class="companyList dp_f">
									<li>주식회사 에듀핌</li>
									<li>대표자 : 김철원</li>
								</ul>
								<ul class="companyList dp_f">
									<li>Tel : 010-3968-9609</li>
									<li>E-mail : fim2021@naver.com</li>
								</ul>
							</div>
							<p class="addr">경기도 고양시 덕양구 중앙로 442, 4층 402호(행신동, 아성프라자)</p>
							<ul class="dp_f companyList">
								<li>사업자등록번호 : 640-86-02251</li>
								<li>통신판매신고번호 : 2021-고양덕양구-1375</li>
							</ul>
						</div>
						<div class="f_bot02_right">
							<ul class="f_bot02_menu">
								<li>
									<a href="" title="공지사항">공지사항</a>
								</li>
								<li>
									<a href="" title="창업문의">창업문의</a>
								</li>
								<li>
									<a href="" title="지부문의">지부문의</a>
								</li>
							</ul>
						</div>
					</div>
					<p class="copyright bold">COPYRIGHT EDU FIM. ALL RIGHTS RESERVED.</p>
				</div>
			</div>
		</footer>

		<?
		//팝업 모달창
		include '/home/edufim/www/module/popupoverlay.php';
		?>

		<script>
			$('.familySlickWrap').slick({ 
				fade: false,
				dots : false,
				arrows : true,	
				autoplay : true,			// 자동 스크롤 사용 여부
				autoplaySpeed : 1000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
				slidesToShow : 5,        // 한 화면에 보여질 컨텐츠 개수
				slidesToScroll : 1,        //스크롤 한번에 움직일 컨텐츠 개수
				prevArrow : $('.famprevBtn'), 
				nextArrow : $('.famnextBtn')
			});

			var flag03 = true;
			$('.familySlickBtn .stop').click(function(){

				if(flag03){
					$('.familySlickWrap').slick('slickPause');
					$(this).addClass("on");

					flag03= false;
				} else {
					$('.familySlickWrap').slick('slickPlay');
					$(this).removeClass("on");
					flag03= true;
				}

			});
		</script>
	</body>
</html>