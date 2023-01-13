<?
include '../header.php';
?>

<div class="subWrap">
	<div class="s_center">
		<!-- signin -->
		<div class="signin">
			<div class="signin__inner">
				<p class="signin__title">회원가입</p>
				<form action="/module/login/signup_proc.php" method="post" name="FRM">
					<!-- 필수사항 -->
					<p class="essential__text">필수사항</p>
					<div class="signin__row">
						<input type="text" placeholder="이메일 입력 (edufim@naver.com)" name="email" />
						<input type="password" placeholder="비밀번호 입력 (10자 이상)" name="pwd" />
						<input type="password" placeholder="비밀번호 확인" name="pwdChk" />
						<input type="text" placeholder="이름" name="mname" readonly />
						<div class="input-phone">
							<input type="text" placeholder="휴대폰번호 입력" name="phone" />
							<a href="javascript:void(0)" class="send-code__btn">인증번호 발송</a>
						</div>
						<div class="input-phone input-phone2">
							<input type="text" placeholder="인증번호 입력" name="phoneChk" class="phoneChk" />
							<input type="text" class="chk-time" id="Timer" />
						</div>
					</div>
					<div class="signin__row signin__row2">
						<p>주소</p>
						<div class="input-address">
							<input type="text" placeholder="우편번호 검색" name="postCode" id="postCode" class="openkakao" value="1" readonly />
							<div class="search-address__btn openkakao">검색</div>
						</div>
						<input type="text" placeholder="주소를 입력해주세요" id="address" name="address" class="openkakao" value="1" readonly />
						<input type="text" placeholder="나머지 주소를 입력해주세요" name="address_detail" />
					</div>
					<div class="signin__row signin__row2">
						<p>성별</p>
						<div class="gender__radio">
							<input type="radio" name="gender" id="female" value="F" />
							<label for="female">여성</label>
							<input type="radio" name="gender" id="male" value="M" />
							<label for="male">남성</label>
						</div>
					</div>

					<!--// 필수사항 -->

					<!-- 선택사항 -->
					<p class="essential__text">선택사항</p>
					<div class="signin__row">
						<select name="option01">
							<option value="">직업을 선택해주세요.</option>
							<option value="회사원">회사원</option>
							<option value="대학생">대학생</option>
							<option value="현업 필라테스 강사">현업 필라테스 강사</option>
							<option value="현업 트레이너">현업 트레이너</option>
							<option value="물리치료사">물리치료사</option>
							<option value="필라테스 강사 준비중">필라테스 강사 준비중</option>
							<option value="스포츠지도사 자격증 준비">스포츠지도사 자격증 준비</option>
							<option value="트레이너 준비중">트레이너 준비중</option>
							<option value="운동지도자 준비중">운동지도자 준비중</option>
							<option value="기타">기타</option>
						</select>
					</div>

					<div class="signin__row">
						<p>관심분야</p>
						<div class="interest__wrap">
							<div class="interest-radio">
								<input type="radio" name="option02" id="interest01" value="운동" />
								<label for="interest01"> <span></span>운동 </label>
							</div>
							<div class="interest-radio">
								<input type="radio" name="option02" id="interest02" value="도수" />
								<label for="interest02"> <span></span>도수 </label>
							</div>
							<div class="interest-radio">
								<input type="radio" name="option02" id="interest03" value="필라테스" />
								<label for="interest03"> <span></span>필라테스 </label>
							</div>
							<div class="interest-radio">
								<input type="radio" name="option02" id="interest04" value="골프" />
								<label for="interest04"> <span></span>골프 </label>
							</div>
							<div class="interest-radio">
								<input type="radio" name="option02" id="interest05" value="기타" />
								<label for="interest05"> <span></span>기타 </label>
							</div>
						</div>
					</div>

					<div class="signin__row">
						<p>가입경로</p>
						<div class="interest__wrap join">
							<div class="interest-radio">
								<input type="radio" name="option03" id="join01" value="검색" />
								<label for="join01"> <span></span>검색 </label>
							</div>
							<div class="interest-radio">
								<input type="radio" name="option03" id="join02" value="SNS" />
								<label for="join02"> <span></span>SNS </label>
							</div>
							<div class="interest-radio">
								<input type="radio" name="option03" id="join03" value="카페" />
								<label for="join03"> <span></span>카페 </label>
							</div>
							<div class="interest-radio">
								<input type="radio" name="option03" id="join04" value="블로그" />
								<label for="join04"> <span></span>블로그 </label>
							</div>
							<div class="interest-radio">
								<input type="radio" name="option03" id="join05" value="기타" />
								<label for="join05"> <span></span>기타 </label>
							</div>
						</div>
					</div>
					<!--// 선택사항 -->

					<!-- 약관동의 -->
					<div class="agree__wrap">
						<div class="agree__row">
							<input type="checkbox" name="agree01" id="agree01" />
							<label for="agree01">(필수) 이용약관 동의</label>
							<a href="javscript:void(0)" class="terms__link">보기</a>
						</div>
						<div class="agree__row">
							<input type="checkbox" name="agree02" id="agree02" />
							<label for="agree02">(필수) 개인정보 취급방침 동의</label>
							<a href="javscript:void(0)" class="terms__link">보기</a>
						</div>
						<div class="agree__row">
							<input type="checkbox" name="agree03" id="agree03" value="receive_check" />
							<label for="agree03">(선택) 마케팅 정보 수신 동의</label>
							<a href="javscript:void(0)" class="terms__link">보기</a>
						</div>
					</div>
					<div class="agreeAll__wrap">
						<input type="checkbox" name="agreeAll" id="agreeAll" />
						<div class="agreeAll__row">
							<label for="agreeAll">전체 동의하기</label>
							<span>(선택) 마케팅 정보 수신 동의를 포함하여 모두 동의</span>
						</div>
					</div>
					<!--// 약관동의 -->
					<a href="javascript:check_signup_submit();" class="signin__btn">회원가입</a>
				</form>
			</div>
		</div>
		<!--// signin -->

	</div>
</div>


<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
	$(function() {
		$(".openkakao").click(function() {
			new daum.Postcode({
				oncomplete: function(data) {
					//선택시 입력값 세팅
					document.getElementById("postCode").value = data.zonecode;
					document.getElementById("address").value = data.address; // 주소 넣기
					document.querySelector("input[name=address_detail]").focus(); //상세입력 포커싱
				},
			}).open();
		});

		$(".send-code__btn").click(function() {
			$(".input-phone2").show();
			TIMER();
			setTimeout(function() {
				clearInterval(PlAYTIME);
			}, 180000); //3분이 되면 타이머를 삭제한다.
		});
	});

	const Timer = document.getElementById("Timer"); //스코어 기록창-분
	let time = 180000;
	let min = 3;
	let sec = 60;

	Timer.text = min + ":" + "00";

	function TIMER() {
		PlAYTIME = setInterval(function() {
			time = time - 1000; //1초씩 줄어듦
			min = time / (60 * 1000); //초를 분으로 나눠준다.

			if (sec > 0) {
				//sec=60 에서 1씩 빼서 출력해준다.
				sec = sec - 1;
				Timer.value = Math.floor(min) + ":" + sec; //실수로 계산되기 때문에 소숫점 아래를 버리고 출력해준다.
			}
			if (sec === 0) {
				// 0에서 -1을 하면 -59가 출력된다.
				// 그래서 0이 되면 바로 sec을 60으로 돌려주고 value에는 0을 출력하도록 해준다.
				sec = 60;
				Timer.value = Math.floor(min) + ":" + "00";
			}
		}, 1000); //1초마다
	}

	const check_signup_submit = function() {
		const form = document.FRM;

		const email = form.email.value;
		const pwd = form.pwd.value;
		const pwdChk = form.pwdChk.value;
		const phone = form.phone.value;
		const postCode = form.postCode.value;
		const address = form.address.value;
		const gender = form.gender.value;
		const agree01 = form.agree01.checked;
		const agree02 = form.agree02.checked;

		const email_regex = '^[a-zA-Z0-9+-\_.]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$';
		const pwd_regex = '';
		const phone_regex = '\d{10,11}';
		const address_regex = '\d[0-9]';


		if (email === "") {
			GblMsgBox("이메일을 입력해주세요", "")
			form.email.focus()
			return
		} else if (pwd === "") {
			GblMsgBox("비밀번호를 입력해주세요", "")
			form.pwd.focus()
			return
		} else if (pwd != pwdChk) {
			GblMsgBox("비밀번호가 일치하지 않습니다", "")
			form.pwdChk.focus()
			return
		} else if (phone === "") {
			GblMsgBox("휴대폰번호를 입력해주세요", "")
			form.phone.focus()
			return
		} else if (postCode === "") {
			GblMsgBox("주소를 입력해주세요", "")
			form.postCode.focus()
			return
		} else if (address === "") {
			GblMsgBox("주소를 입력해주세요", "")
			form.address.focus()
			return
		} else if (gender === "") {
			GblMsgBox("성별을 선택해주세요", "")
			$(".gender__radio").attr("tabindex", -1).focus()
			return
		} else if (!agree01) {
			GblMsgBox("이용약관에 동의해주세요", "")
			form.agree01.focus()
			return
		} else if (!agree02) {
			GblMsgBox("개인정보 취급방침에 동의해주세요", "")
			form.agree02.focus()
			return
		}


		

		// form.target = 'ifra_gbl';
		// form.submit();
		// return;
	}
</script>

<?
include '../footer.php';
?>