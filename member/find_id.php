<?
	include '../header.php';
?>

<div class="subWrap">
	<div class="s_center">

		<!-- 아이디 찾기 -->
		<div class="signin">
			<div class="signin__inner find-id">
				<p class="signin__title">아이디 찾기</p>

				<form action="" method="post" name="FRM">					
					<div class="signin__row">
						<input type="text" placeholder="이름 입력" name="name" />
						<input type="password" placeholder="휴대폰번호 입력" name="phone" />
					</div>
					<p>
						회원가입 시 등록한 이름과 휴대폰 번호를 입력하시면<br />
						아이디를 확인하실 수 있습니다.
					</p>
					<a href="javascript:void(0)" class="signin__btn login__btn">아이디 찾기</a>					
				</form>

			</div>
		</div>
		<!--// 아이디 찾기 -->


	</div>
</div>


<?
	include '../footer.php';
?>
