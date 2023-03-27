<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand-->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/adm/">
		<div class="sidebar-brand-icon"><img src='/images/favicon.png'> 에듀핌 관리자</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Divider -->
	<hr class="sidebar-divider">

	<li class="nav-item  <?= $sideArr[1] ?>">
		<a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#subList1" aria-expanded="true" aria-controls="subList1">
			<span>클래스 관리</span>
		</a>
		<div id="subList1" class="collapse <?= $showArr[1] ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $subArr['all'] ?>" href="/adm/class/all">ALL클래스</a>
				<a class="collapse-item <?= $subArr['license'] ?>" href="/adm/class/license/">자격증과정</a>
				<a class="collapse-item <?= $subArr['best'] ?>" href="/adm/class/best/">BEST콜라보</a>
				<!-- <a class="collapse-item <?= $subArr['off'] ?>" href="/adm/class/off/">필라테스자격증</a> -->
				<!-- <a class="collapse-item <?= $subArr['homet'] ?>" href="/adm/class/homet/">홈트</a> -->
			</div>
		</div>
	</li>

	<li class="nav-item  <?= $sideArr[2] ?>">
		<a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#subList2" aria-expanded="true" aria-controls="subList2">
			<span>회원</span>
		</a>
		<div id="subList2" class="collapse <?= $showArr[2] ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $subArr['user'] ?>" href="/adm/member/user/">회원</a>
				<a class="collapse-item <?= $subArr['admin'] ?>" href="/adm/member/admin/">관리자</a>
				<a class="collapse-item <?= $subArr['completion'] ?>" href="/adm/member/completion/">수료증 조회</a>
				<a class="collapse-item <?= $subArr['license'] ?>" href="/adm/member/license/">자격증 조회</a>
				<a class="collapse-item <?= $subArr['profile'] ?>" href="/adm/member/profile/">프로필 편집</a>
			</div>
		</div>
	</li>

	<li class="nav-item  <?= $sideArr[3] ?>">
		<a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#subList3" aria-expanded="true" aria-controls="subList3">
			<span>세일</span>
		</a>
		<div id="subList3" class="collapse <?= $showArr[3] ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $subArr['event'] ?>" href="/adm/sale/event">이벤트</a>
				<a class="collapse-item <?= $subArr['coupon'] ?>" href="/adm/sale/coupon">쿠폰</a>
				<a class="collapse-item <?= $subArr['point'] ?>" href="/adm/sale/point">포인트</a>
			</div>
		</div>
	</li>

	<li class="nav-item  <?= $sideArr[4] ?>">
		<a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#subList4" aria-expanded="true" aria-controls="subList4">
			<span>상점 관리</span>
		</a>
		<div id="subList4" class="collapse <?= $showArr[4] ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $subArr['store'] ?>" href="/adm/shop/store/">스토어</a>
				<a class="collapse-item <?= $subArr['order'] ?>" href="/adm/shop/order/">주문</a>
				<a class="collapse-item <?= $subArr['payment'] ?>" href="/adm/shop/payment/">결제</a>
				<!-- <a class="collapse-item <?= $subArr['address'] ?>" href="/adm/shop/address/">주소</a> -->
			</div>
		</div>
	</li>

	<li class="nav-item  <?= $sideArr[5] ?>">
		<a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#subList5" aria-expanded="true" aria-controls="subList5">
			<span>메인</span>
		</a>
		<div id="subList5" class="collapse <?= $showArr[5] ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $subArr['banner'] ?>" href="/adm/main/banner/">메인 배너</a>
				<a class="collapse-item <?= $subArr['event'] ?>" href="/adm/main/event/">이벤트 배너</a>
				<!-- <a class="collapse-item <?= $subArr['address'] ?>" href="/adm/shop/address/">주소</a> -->
			</div>
		</div>
	</li>

	<li class="nav-item  <?= $sideArr[10] ?>">
		<a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#subList10" aria-expanded="true" aria-controls="subList10">
			<span>게시판 관리</span>
		</a>
		<div id="subList10" class="collapse <?= $showArr[10] ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<!-- <a class="collapse-item <?= $subArr['main'] ?>" href="/adm/board/main/">메인-배너</a>
				<a class="collapse-item <?= $subArr['main2'] ?>" href="/adm/board/main2/">메인-이벤트</a> -->
				<!-- <a class="collapse-item <?= $subArr['board3'] ?>" href="/adm/board/">창업 문의</a> -->
				<!-- <a class="collapse-item <?= $subArr['board4'] ?>" href="/adm/board/">지부 문의</a> -->
				<a class="collapse-item <?= $subArr['setting'] ?>" href="/adm/board/setting/">게시판 관리</a>
			</div>
		</div>
	</li>                                                                                                                           

	<!-- 
	<li class="nav-item <?= $sideArr[3] ?>">
		<a class="nav-link" href="/adm/testList/">
			<span>이벤트 관리</span>
		</a>
	</li>

	<li class="nav-item <?= $sideArr[4] ?>">
		<a class="nav-link" href="/adm/magazineList/">
			<span>아맘때매거진 관리</span>
		</a>
	</li>

	<li class="nav-item  <?= $sideArr[5] ?>">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#subList6" aria-expanded="true" aria-controls="subList6">
			<span>커뮤니티 관리</span>
		</a>
		<div id="subList6" class="collapse <?= $showArr[5] ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= $subArr['freeBoard'] ?>" href="/adm/freeBoard/">자유게시판 관리</a>
				<a class="collapse-item <?= $subArr['today'] ?>" href="/adm/today/">오늘의 한마디</a>
			</div>
		</div>
	</li>

	<li class="nav-item <?= $sideArr[6] ?>">
		<a class="nav-link" href="/adm/payment/">
			<span>결제내역</span>
		</a>
	</li>


	<li class="nav-item <?= $sideArr[7] ?>">
		<a class="nav-link" href="/adm/notice/">
			<span>공지</span>
		</a>
	</li>
 -->

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->