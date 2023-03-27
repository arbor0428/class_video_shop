<?
include '../header.php';
if (isLogin()) deny();
?>

<div class="subWrap">
	<div class="s_center">
		<!-- signin -->
		<div class="signin">
			<div class="signin__inner">
				<p class="signin__title">회원가입</p>
				<form action="/module/login/signup_proc.php" method="post" name="frm01" id="frm01">
					<input type="hidden" name="m" value="checkplusService">				<!-- 필수 데이타로, 누락하시면 안됩니다. -->
					<input type="hidden" name="EncodeData" value="">					<!-- 업체정보를 암호화 한 데이타입니다. -->
                    <input type='hidden' name='kakaoID' value="<?=$kakaoID?>">
                    <input type='hidden' name='naverID' value="<?=$naverID?>">
                    <input type='hidden' name='googleID' value="<?=$googleID?>">

					<!-- 필수사항 -->
					<p class="essential__text">필수사항</p>
					<div class="signin__row">
						<input type="text" placeholder="이메일 입력 (edufim@naver.com)" name="userid" />
						<input type="password" placeholder="비밀번호 (숫자, 영문, 특수문자 조합 최소 8자)" name="pwd" />
						<input type="password" placeholder="비밀번호 확인" name="pwdChk" />
						
						<div class="input-address">
							<input type="text" placeholder="이름" name="mname" id="mname" readonly style="background-color:#efefef;"/>
							<div class="search-address__btn" onclick="niceCheck('mobile');">본인인증</div>
						</div>
						<div class="input-phone">
							<input type="text" placeholder="핸드폰번호" name="phone" id="phone" readonly style="background-color:#efefef;"/>
							<!-- <a href="javascript:void(0)" class="send-code__btn">인증번호 발송</a> -->
						</div>
						<div class="input-phone input-phone2">
							<input type="text" placeholder="인증번호 입력" name="phoneChk" class="phoneChk" />
							<input type="text" class="chk-time" id="Timer" />
						</div>
					</div>
					<div class="signin__row signin__row2">
						<p>주소</p>
						<div class="input-address">
							<input type="text" placeholder="우편번호 검색" name="postCode" id="postCode" class="openkakao" readonly />
							<div class="search-address__btn openkakao">검색</div>
						</div>
						<input type="text" placeholder="주소를 입력하세요" id="address" name="addr01" class="openkakao" readonly />
						<input type="text" placeholder="나머지 주소를 입력하세요" name="addr02" />
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
							<option value="">직업을 선택하세요.</option>
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
							<input type="checkbox" name="agree03" id="agree03" value="receiveChk" />
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
					<a href="javascript:void(0)" class="signin__btn" onclick="check_signup_submit()">회원가입</a>
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
					document.querySelector("input[name=addr02]").focus(); //상세입력 포커싱
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
	
	//나이스 본인인증
	function niceCheck(t){

		if(t == 'mobile')	act = 'moduleCheck.php';

		id = setTimeout(function(){	
			$.post('/module/niceID/mobile/'+act,{}, function(result){
				if(result){
					parData = JSON.parse(result);
					msg = parData.msg;
					
					if(msg){
						GblMsgBox(msg,'');
						return;
					}else{
						data = parData.data;

						if(t == 'mobile'){
							
							window.open('', 'popupChk', 'width=500, height=550, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no');
							document.frm01.EncodeData.value = data;
							document.frm01.action = "https://nice.checkplus.co.kr/CheckPlusSafeModel/checkplus.cb";
							document.frm01.target = "popupChk";
							document.frm01.submit();
						}
					}
				}else{
					GblMsgBox('통신오류','');
					return;
				}
			});	
		}, 500);
	}

	const check_signup_submit = function() {
		const form = document.frm01;

		const userid = form.userid.value;
		const pwd = form.pwd.value;
		const pwdChk = form.pwdChk.value;
		const phone = form.phone.value;
		const postCode = form.postCode.value;
		const addr01 = form.addr01.value;
		const gender = form.gender.value;
		const agree01 = form.agree01.checked;
		const agree02 = form.agree02.checked;

		if (userid === "") {
			GblMsgBox("이메일을 입력하세요")
			form.userid.focus()
			return
		} else if (!isEmailChk(userid)) {
			GblMsgBox("올바른 이메일 입력하세요.")
			form.userid.focus()
			return
        } else if (pwd === "") {
			GblMsgBox("비밀번호를 입력하세요.")
			form.pwd.focus()
			return
		} else if (!check_pwd()) {
            form.pwd.focus()
            return
        } else if (pwd != pwdChk) {
			GblMsgBox("비밀번호가 일치하지 않습니다")
			form.pwdChk.focus()
			return
		} else if (phone === "") {
			GblMsgBox("핸드폰번호를 입력하세요.")
			form.phone.focus()
			return
		// } else if (isCellPhone(phone)) {
		// 	GblMsgBox("올바른 핸드폰번호를 입력하세요")
		// 	form.phone.focus()
		// 	return
        } else if (postCode === "") {
			GblMsgBox("주소를 입력하세요")
			form.postCode.focus()
			return
		} else if (addr01 === "") {
			GblMsgBox("주소를 입력하세요")
			form.addr01.focus()
			return
		} else if (gender === "") {
			GblMsgBox("성별을 선택하세요")
			$(".gender__radio").attr("tabindex", -1).focus()
			return
		} else if (!agree01) {
			GblMsgBox("이용약관에 동의 바랍니다")
			form.agree01.focus()
			return
		} else if (!agree02) {
			GblMsgBox("개인정보 취급방침에 동의 바랍니다.")
			form.agree02.focus()
			return
		}
		form.action = '/module/login/signup_proc.php';
		form.target = 'ifra_gbl';
		form.submit();
	}

    function check_pwd () {
        const form = document.frm01;
        const pwd = form.pwd.value;
        
        const num = pwd.search(/[0-9]/g);
        const eng = pwd.search(/[a-z]/ig);
        const spe = pwd.search(/[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/g);
        //var spe = pw.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

        if(pwd.length < 4 || pwd.length > 20){
            GblMsgBox("4자리 ~ 20자리 이내로 입력하세요.");
            return false;

        // } else if(num < 0 || eng < 0 || spe < 0 || pwd.search(/\s/) != -1){
        } else if(num < 0){
            GblMsgBox("숫자, 영문, 특수문자를 조합하여 입력하세요.");
            return false;

        }else {
            return true;
        }
    }

    /*
	const check_input = {
		userid() {
			const userid = $('input[name=userid]').val();
			return (userid != "") && isEmailChk(userid);
		},
		pwd() {
			const pwd = $('input[name=pwd]').val();
			const pwdChk = $('input[name=pwdChk]').val();
			return (pwd != "") && (pwd === pwdChk) && (pwdChk != "");
		},
		phone() {
			const phone = $('input[name=phone]').val();
			return (phone != "") && isCellPhone(phone);
		},
		mname() {
			const mname = $('input[name=mname]').val();
			return (mname != "");
		},
		postCode() {
			const postCode = $('input[name=postCode]').val();
			return (postCode != "");
		},
		addr01() {
			const addr01 = $('input[name=addr01]').val();
			return (addr01 != "");
		},
		gender() {
			const gender = $('input[name=gender]').val();
			return (gender != "");
		},
		agree1() {
			return $('input[name=agree01]').is("checked");
		},
		agree2() {
			return $('input[name=agree02]').is("checked");
		}
	}
*/

	const TIMER = function() {
		const Timer = document.getElementById("Timer"); //스코어 기록창-분
		let time = 180000;
		let min = 3;
		let sec = 60;
		Timer.text = min + ":" + "00";
		
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
</script>

<?
include '../footer.php';
?>