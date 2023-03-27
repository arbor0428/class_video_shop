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
				<form action="/module/login/signup_proc.php" method="post" name="frm01">
				<input type='text' style='display:none;'>
				<input type='hidden' name='kakaoID' value="<?=$kakaoID?>">
				<input type='hidden' name='naverID' value="<?=$naverID?>">
				<input type='hidden' name='googleID' value="<?=$googleID?>">
					<!-- 필수사항 -->
					<p class="essential__text">필수사항</p>
					<div class="signin__row">
						<input type="text" placeholder="이메일 입력 (edufim@naver.com)" name="userid" value="<?=$snsEmail?>">
						<input type="password" placeholder="비밀번호 (숫자, 영문, 특수문자 조합 최소 8자)" name="pwd" />
						<input type="password" placeholder="비밀번호 확인" name="pwdChk" />
						<input type="text" placeholder="이름" name="mname" value="<?=$snsName?>">
						<input type="text" placeholder="전화번호 -없이 입력해주세요"  maxlength='13' name="phone" id="phone" value="<?=$snsPhone?>">
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
							<input type="radio" name="gender" id="female" value="F" <?if($snsGender == 'F'){echo 'checked';}?>>
							<label for="female">여성</label>
							<input type="radio" name="gender" id="male" value="M" <?if($snsGender == 'M'){echo 'checked';}?>>
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
$(document).on("keyup", "#phone", function() { 
	$(this).val( $(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/,"$1-$2-$3").replace("--", "-") );
});

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
});

const check_signup_submit = function() {
	const form = document.frm01;
	const pwd = form.pwd.value;
	const pwdChk = form.pwdChk.value;

	if(isFrmEmptyModal(form.userid,"이메일을 입력하세요."))	return;
	if(!isEmailModal(form.userid,"올바른 이메일 입력하세요."))	return;
	if(isFrmEmptyModal(form.pwd,"비밀번호를 입력하세요."))	return;
	if(!check_pwd()){
		form.pwd.focus();
		return;
	}
	if(pwd != pwdChk){
		GblMsgBox("비밀번호가 일치하지 않습니다");
		form.pwdChk.focus();
		return;
	}

	if(isFrmEmptyModal(form.phone,"전화번호를 입력하세요."))	return;
	if(isFrmEmptyModal(form.postCode,"주소를 입력하세요."))	return;
	if(isFrmEmptyModal(form.addr01,"주소를 입력하세요."))	return;
	if(!isCheckModal(form.gender,"성별을 선택하세요.")){
		$(".gender__radio").attr("tabindex", -1).focus();
		return;
	}

	if(!isOneCheckModal(form.agree01,"이용약관에 동의 바랍니다."))	return;
	if(!isOneCheckModal(form.agree02,"개인정보 취급방침에 동의 바랍니다."))	return;

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

</script>

<?
include '../footer.php';
?>