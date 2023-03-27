<?
	include '../header.php';
	if (isLogin()) deny();
?>

<div class="subWrap">
	<div class="s_center">

		 <!-- 비밀번호 찾기 -->
    <div class="signin">
      <div class="signin__inner find-id">
        <p class="signin__title">비밀번호 찾기</p>

        <form action="" method="post" name="FRM">         
          <div class="signin__row">
            <input type="text" placeholder="이메일 입력" name="email" />
            <input type="text" placeholder="이름 입력" name="name" />
            <input type="password" placeholder="휴대폰번호 입력" name="phone" />
          </div>
          <p>
            회원가입 시 등록한 이메일, 이름, 연락처를 입력해주세요.<br />
            가입 시 작성해주신 메일로 안내해드리겠습니다.
          </p>
          <a href="javascript:void(0)" class="signin__btn login__btn">확인</a>          
        </form>

      </div>
    </div>
    <!--// 비밀번호 찾기 -->
		
	</div>
</div>


<?
	include '../footer.php';
?>
