<?
    if (!isLogin()) redirectLogin();
	
    $userid = $GBL_USERID;
	$side[$side_menu]="content_box_a";
?>

<div class='sidemenu'>
	<div class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc">나의 강의실</div>
	<ul class="sidemenu_list">
		<li class="c_gry04 f14">HOME</li>
		<li class='<?=$side[1]?>'><a href='/mypage/recommended/'>맞춤 강좌</a></li>
		<li class='<?=$side[2]?>'><a href='/mypage/alarm/'>알림</a></li>
	</ul>
	<ul class="sidemenu_list">
		<li class="c_gry04 f14">학습 관리</li>
		<li class='<?=$side[3]?>'><a href='/mypage/learning/'>수강중인 강좌</a></li>
		<li class='<?=$side[4]?>'><a href='/mypage/wish/'>찜한 강좌</a></li>
		<li class='<?=$side[5]?>'><a href='/mypage/qna/'>나의 학습질문</a></li>
		<li class='<?=$side[6]?>'><a href='/mypage/review/'>나의 리뷰</a></li>
		<li class='<?=$side[7]?>'><a href='/mypage/certClass/'>수강증 발급</a></li>
		<li class='<?=$side[8]?>'><a href='/mypage/certCompletion/'>수료증 발급</a></li>
		<li class='<?=$side[9]?>'><a href='/mypage/certLicense/'>자격증 발급</a></li>
	</ul>
	<ul class="sidemenu_list">
		<li class="c_gry04 f14">강좌신청 관리</li>
		<li class='<?=$side[10]?>'><a href='/mypage/cart/'>장바구니</a></li>
		<li class='<?=$side[11]?>'><a href='/mypage/coupon/'>쿠폰함</a></li>
		<li class='<?=$side[12]?>'><a href='/mypage/point/'>적립금</a></li>
		<li class='<?=$side[13]?>'><a href='/mypage/orderList/'>구매내역</a></li>
	</ul>
	<ul class="sidemenu_list">
		<li class="c_gry04 f14">설정</li>
		<li class='<?=$side[14]?>'><a href='/mypage/edit/'>개인정보 수정</a></li>
		<li class='<?=$side[15]?>'><a href='/mypage/mobileReset/'>모바일기기 초기화</a></li>
	</ul>
</div>