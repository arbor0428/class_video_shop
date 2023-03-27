<?
include "/home/edufim/www/module/login/head.php";
?>
<header class="header blue_gradient c_w" id="header">
    <div class="h_top bor_bot">
        <div class="c_center">
            <div class="h_top_wrap dp_sb">
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
                    <? if (!$GBL_USERID) { ?>
                        <!-- <li><a href="/member/signup.php" title="회원가입">회원가입</a></li> -->
                        <li><a href="/member/login.php" title="로그인">로그인</a></li>
                        <li><a href="/member/signup.php" title="회원가입">회원가입</a></li>
                    <? } else {
                        if ($GBL_MTYPE === 'A') echo '<li><a href="/adm" title="관리자 페이지">관리자 페이지</a></li>'; ?>
                        <li><?= $GBL_USERID ?></li>
                        <li><a href="/module/login/logout_proc.php" title="로그인">로그아웃</a></li>
                        <li><a href="/mypage/cart/" title="장바구니">장바구니</a></li>
                    <? } ?>
                    <li><a href="/mypage/edit/" title="마이페이지">마이페이지</a></li>
                    <li><a href="/mypage/certLicense/" title="자격증조회">자격증조회</a></li>
                </ul>
            </div>
            <h1 class="logo txt-c"><a href="/" title="logo"><img src="/images/logo.svg" alt="logo"></a></h1>

            <!-- 모바일메뉴 -->
            <div class="m-navWrap">
                <div class="bBg"><!--뒷배경--></div>
                <div class="m-navbox on">
                    <div class="mn-top">
                        <div class="closeBtn">
                            <a href="#" title="close">
                                <span class="lnr lnr-cross"></span>
                            </a>
                        </div>
                    </div>
                    <div class="dp_sb goBtnWrap">
                        <ul class="h_top_menu dp_f dp_c">
                            <? if (!$GBL_USERID) { ?>
                                <li><a href="/member/signup.php" title="회원가입">회원가입</a></li>
                                <li><a href="/member/login.php" title="로그인">로그인</a></li>
                            <? } else { ?>
                                <li><a href="/module/login/logout_proc.php" title="로그인">로그아웃</a></li>
                                <li><a href="/mypage/cart.php" title="장바구니">장바구니</a></li>
                            <? } ?>
                        </ul>
                        <a class="classBtn bora dp_f dp_c dp_cc c_w" href="/mypage/learning/" title="나의 강의실">나의 강의실</a>
                    </div>
                    <ul class="m-nav">
                        <li>
                            <a href="javascript:avoid(0);" title="ALL 클래스">ALL 클래스</a>
                            <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <?
                            $sql = "SELECT * FROM ks_class_cade01 ORDER BY sort";
                            $cade01 = sqlArray($sql);
                            for ($i = 0; $i < count($cade01); $i++) {
                            ?>
                                <ul class="m-depth2">
                                    <li>
                                        <a href="/sub01/sub01.php?&cade01=<?= $cade01[$i]['sort'] ?>" title="<?= $cade01[$i]['title'] ?>"><?= $cade01[$i]['title'] ?></a>
                                        <ul class="m-depth3">
                                            <?
                                            $cade01_uid = $cade01[$i]['uid'];
                                            $sql = "SELECT * FROM ks_class_cade02 WHERE cade01=$cade01_uid ORDER BY sort";
                                            $cade02 = sqlArray($sql);
                                            for ($j = 0; $j < count($cade02); $j++) {
                                            ?>
                                                <li>
                                                    <a href="/sub01/sub02.php?&cade01=<?= $cade01[$i]['sort'] ?>&cade02=<?= $cade02[$j]['sort'] ?>" title="<?= $cade02[$j]['title'] ?>"><?= $cade02[$j]['title'] ?></a>
                                                    <ul class="m-depth4">

                                                        <?
                                                        $cade02_uid = $cade02[$j]['uid'];
                                                        $sql = "SELECT uid, title FROM ks_class WHERE status=1 AND cade01=$cade01_uid AND cade02=$cade02_uid";
                                                        $classes = sqlArray($sql);
                                                        foreach ($classes as $class) {
                                                        ?>
                                                            <li><a href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                        <? } ?>
                                                    </ul>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </li>
                                </ul>
                            <? } ?>
                        </li>
                        <li>
                            <a href="javascript:avoid(0);" title="국제인증자격증과정">국제인증자격증과정</a>
                            <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <ul class="m-depth2">

                                <?
                                $licenses_sql = "SELECT * FROM ks_license WHERE status=1";
                                $licenses = sqlArray($licenses_sql);
                                foreach ($licenses as $license) {
                                ?>
                                    <li><a href="/sub03/view.php?&code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>"><?= $license['title'] ?></a></li>
                                <? } ?>
                                <!-- <li><a href="" title="국제인증강사">국제인증강사zz</a></li>
								<li><a href="" title="체형분석평가사">체형분석평가사ddff</a></li>
								<li><a href="" title="필라테스지도자">fff필라테스지도자</a></li>
								<li><a href="" title="물리치료사 강사">물ff리치료사 강사</a></li>
								<li><a href="" title="골프피지오 2급">골프피지오 2급</a></li>
								<li><a href="" title="체형분석운동지도자">체형분석운동지도자</a></li>
								<li><a href="" title="Anatomy master">Anatomy master</a></li>
								<li><a href="" title="필라테스시퀀스처방사">필라테스시퀀스처방사</a></li> -->
                            </ul>
                        </li>
                        <li>
                            <a href="/sub04/" title="BEST 콜라보">BEST 콜라보</a>
                        </li>
                        <li>
                            <a href="javascript:avoid(0);" title="필라테스자격증">필라테스자격증</a>
                            <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <ul class="m-depth2">
                                <!-- <li><a href="/sub06/" title="홈트">홈트</a></li> -->
                                <?
                                $homet_arr = sqlArray("SELECT * FROM ks_class WHERE cade01=20");

                                for ($i = 0; $i < count($homet_arr); $i++) {
                                    $homet = $homet_arr[$i];
                                ?>
                                    <li><a href="/sub06/view.php?&code=<?= $homet['uid'] ?>" title="<?= $homet['title'] ?>"><?= $homet['title'] ?></a></li>
                                <? } ?>
                                <!-- <li><a href="" title="다이어트">다이어트</a></li>
                                <li><a href="" title="체형교정">체형교정</a></li>
                                <li><a href="" title="통증컨트롤">통증컨트롤</a></li> -->
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:avoid(0);" title="STORE">STORE</a>
                            <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <ul class="m-depth2">
                                <li><a href="/sub07/" title="스토어">스토어</a></li>
                                <li><a href="" title="교재">교재</a></li>
                                <li><a href="" title="CBP 필로우">CBP 필로우</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/sub08/" title="후기">후기</a>
                        </li>
                        <!-- <li>
							<a href="javascript:avoid(0);" title="자격증시험응시">자격증시험응시</a>
							<span class="lnr lnr-chevron-down"></span>
							<span class="lnr lnr-chevron-up"></span>
							<ul class="m-depth2">
								<li><a href="/sub09/" title="자격증시험응시">자격증시험응시</a></li>
								<li><a href="" title="공지사항">필라테스 지도자과정 이론시험</a></li>
							</ul>
						</li> -->
                        <li>
                            <a href="javascript:avoid(0);" title="Q&A">Q&A</a>
                            <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <ul class="m-depth2">
                                <li><a href="/sub10/sub01.php" title="공지사항">공지사항</a></li>
                                <li><a href="/sub10/sub02.php" title="창업문의">창업문의</a></li>
                                <li><a href="/sub10/sub03.php" title="지부문의">지부문의</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <!--모바일메뉴버튼-->
            <button type="button" id="btnFullMenu" class="m-btn">
                메인메뉴 열기
                <span class="bar_top"></span>
                <span class="bar_mid"></span>
                <span class="bar_bot"></span>
            </button>
        </div>
    </div>
    <script>
        var flag = true;
        $(".toggleTit").click(function() {
            if (flag) {
                $(".langArr").addClass("on");
                $(".toggleDown").stop().slideDown();

                flag = false;
            } else {
                $(".langArr").removeClass("on");
                $(".toggleDown").stop().slideUp();

                flag = true;
            }
        });
    </script>

    <div class="h_bot">
        <div class="c_center dp_sb">
            <ul class="h_bot_menu dp_f">
                <li><a class="dp_b bold" href="/sub01/" title="ALL클래스">ALL클래스</a></li>
                <li><a class="dp_b bold" href="/sub03/" title="국제인증자격증과정">국제인증자격증과정</a></li>
                <li><a class="dp_b bold" href="/sub04/" title="BEST 콜라보">BEST 콜라보</a></li>
                <li><a class="dp_b bold" href="/sub05/" title="필라테스자격증">필라테스자격증</a></li>
                <li><a class="dp_b bold" href="/sub07/" title="STORE">STORE</a></li>
                <li><a class="dp_b bold" href="/sub08/" title="후기">후기</a></li>
                <!-- <li><a class="dp_b bold" href="/sub09/" title="자격증시험응시">자격증시험응시</a></li> -->
                <li><a class="dp_b bold" href="/sub10/sub01.php" title="Q&A">Q&A</a></li>
            </ul>
            <a class="classBtn bora dp_f dp_c dp_cc c_w" href="/mypage/learning/" title="나의 강의실">나의 강의실</a>
        </div>
        <div class="depthWrap">
            <div class="boxWrap">
                <div class="depthbox" style="height: 470px;">
                    <div class="c_center dp_f alcMnWrap">
                        <?
                        $sql = "SELECT * FROM ks_class_cade01 ORDER BY sort";
                        $cade01 = sqlArray($sql);
                        for ($i = 0; $i < count($cade01); $i++) {
                        ?>
                            <div class="allClassMenu wid20">
                                <ul class="depth1">
                                    <li>
                                        <a class="c_bora dp_b bold2" href="/sub01/sub01.php?&cade01=<?= $cade01[$i]['sort'] ?>" title="<?= $cade01[$i]['title'] ?>"><?= $cade01[$i]['title'] ?></a>
                                        <ul class="depth2">
                                            <?
                                            $cade01_uid = $cade01[$i]['uid'];
                                            $sql = "SELECT * FROM ks_class_cade02 WHERE cade01=$cade01_uid ORDER BY sort";
                                            $cade02 = sqlArray($sql);
                                            for ($j = 0; $j < count($cade02); $j++) {
                                            ?>
                                                <li>
                                                    <a class="bold2" href="/sub01/sub02.php?&cade01=<?= $cade01[$i]['sort'] ?>&cade02=<?= $cade02[$j]['sort'] ?>" title="<?= $cade02[$j]['title'] ?>"><?= $cade02[$j]['title'] ?></a>
                                                    <ul class="depth3">

                                                        <?
                                                        $cade02_uid = $cade02[$j]['uid'];
                                                        $sql = "SELECT uid, title FROM ks_class WHERE status=1 AND cade01=$cade01_uid AND cade02=$cade02_uid";
                                                        $classes = sqlArray($sql);
                                                        foreach ($classes as $class) {
                                                        ?>
                                                            <li><a class="c_gry dp_b" href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                        <? } ?>
                                                    </ul>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <? } ?>
                    </div>
                </div>
                <div class="depthbox" style="height: 160px;">
                    <div class="c_center dp_f alcMnWrap">
                        <?
                        $sql = "SELECT * FROM ks_license_cade01 ORDER BY sort";
                        $cade01 = sqlArray($sql);
                        for ($i = 0; $i < count($cade01); $i++) {
                        ?>
                            <div class="allClassMenu wid20">
                                <ul class="depth1">
                                    <li>
                                        <!-- <a class="c_bora dp_b bold2" href="/sub01/sub01.php?&cade01=<?= $cade01[$i]['sort'] ?>" title="<?= $cade01[$i]['title'] ?>"><?= $cade01[$i]['title'] ?></a> -->
                                        <a class="c_bora dp_b bold2" href="/sub03/" title="<?= $cade01[$i]['title'] ?>"><?= $cade01[$i]['title'] ?></a>
                                        <ul class="depth2">
                                            <?
                                            $cade01_uid = $cade01[$i]['uid'];
                                            $sql = "SELECT * FROM ks_license_cade02 WHERE cade01=$cade01_uid ORDER BY sort";
                                            $cade02 = sqlArray($sql);
                                            for ($j = 0; $j < count($cade02); $j++) {
                                            ?>
                                                <li>
                                                    <!-- <a class="bold2" href="/sub01/sub02.php?&cade01=<?= $cade01[$i]['sort'] ?>&cade02=<?= $cade02[$j]['sort'] ?>" title="<?= $cade02[$j]['title'] ?>"><?= $cade02[$j]['title'] ?></a> -->
                                                    <a class="bold2" href="/sub03/" title="<?= $cade02[$j]['title'] ?>"><?= $cade02[$j]['title'] ?></a>
                                                    <ul class="depth3">

                                                        <?
                                                        $cade02_uid = $cade02[$j]['uid'];
                                                        $sql = "SELECT uid, title FROM ks_license WHERE status=1 AND cade01=$cade01_uid AND cade02=$cade02_uid";
                                                        $classes = sqlArray($sql);
                                                        foreach ($classes as $class) {
                                                        ?>
                                                            <!-- <li><a class="c_gry dp_b" href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li> -->
                                                            <li><a class="c_gry dp_b" href="/sub03/" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                        <? } ?>
                                                    </ul>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <? } ?>
                    </div>
                </div>
                <div class="depthbox">
                    <!--빈값 best콜라보-->
                </div>
                <div class="depthbox" style="height: 160px;">
                    <div class="dp_f hght100">
                        <div class="boraMenuTit bora c_w dp_f dp_end02">
                            <p class="dp_f dp_c">
                                필라테스자격증
                                <span class="lnr lnr-chevron-right"></span>
                            </p>
                        </div>
                        <ul class="boraMenuCont dp_f">
                            <li>
                                <ul class="b_menu">
                                    <?
                                    $f2f_arr = sqlArray("SELECT * FROM ks_class WHERE cade01=19");

                                    for ($i = 0; $i < count($f2f_arr); $i++) {
                                        $f2f = $f2f_arr[$i];
                                    ?>
                                        <li><a href="/sub05/view.php?&code=<?= $f2f['uid'] ?>" title="<?= $f2f['title'] ?>"><?= $f2f['title'] ?></a></li>
                                    <? } ?>
                                    <!-- <li><a href="" title="필라테스 지도자 자격증">필라테스 지도자 자격증</a></li>
									<li><a href="" title="CBP 카이로플랙틱">CBP 카이로플랙틱</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <ul class="b_menu">
                                    <?
                                    for ($i = 2; $i < 4; $i++) {
                                        $f2f = $f2f_arr[$i];
                                    ?>
                                        <li><a href="/sub05/view.php?&code=<?= $f2f['uid'] ?>" title="<?= $f2f['title'] ?>"><?= $f2f['title'] ?></a></li>
                                    <? } ?>
                                    <!-- <li><a href="" title="골프 피지오 베이직">골프 피지오 베이직</a></li>
									<li><a href="" title="근막경선 림프반사">근막경선 림프반사</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <ul class="b_menu">
                                    <?
                                    for ($i = 4; $i < count($f2f_arr); $i++) {
                                        $f2f = $f2f_arr[$i];
                                    ?>
                                        <li><a href="/sub05/view.php?&code=<?= $f2f['uid'] ?>" title="<?= $f2f['title'] ?>"><?= $f2f['title'] ?></a></li>
                                    <? } ?>
                                    <!-- <li><a href="" title="골프 피지오 어드벤스">골프 피지오 어드벤스</a></li>
									<li><a href="" title="STM 연부조직이완술">STM 연부조직이완술</a></li> -->
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="depthbox" style="height: 160px;">
                    <div class="dp_f hght100">
                        <div class="boraMenuTit bora c_w dp_f dp_end02">
                            <p class="dp_f dp_c">
                                STORE
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
                <div class="depthbox" style="opacity: 0;">
                    <!-- <div class="dp_f hght100">
						<div class="boraMenuTit bora c_w dp_f dp_end02">
							<p class="dp_f dp_c">
								강의 후기
								<span class="lnr lnr-chevron-right"></span>
							</p>
						</div>
						<ul class="boraMenuCont dp_f">
							<li>
								<ul class="b_menu">
									<li><a href="/sub08/" title="강의후기">강의후기</a></li>
								</ul>
							</li>
						</ul>
					</div> -->
                </div>
                <!-- <div class="depthbox" style="height: 160px;">
					<div class="dp_f hght100">
						<div class="boraMenuTit bora c_w dp_f dp_end02">
							<p class="dp_f dp_c">
								자격증시험응시
								<span class="lnr lnr-chevron-right"></span>
							</p>
						</div>
						<ul class="boraMenuCont dp_f">
							<li>
								<ul class="b_menu">
									<li><a href="" title="필라테스 지도자과정 이론시험">필라테스 지도자과정 이론시험</a></li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li>
									</li>
								</ul>
							</li>
							<li>
								<ul class="b_menu">
									<li>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div> -->
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
                                    <li><a href="/sub10/sub01.php" title="공지사항">공지사항</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul class="b_menu">
                                    <li><a href="/sub10/sub02.php" title="창업문의">창업문의</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul class="b_menu">
                                    <li><a href="/sub10/sub03.php" title="지부문의">지부문의</a></li>
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

    $(".h_bot_menu > li").mouseenter(function(event) {

        event.preventDefault();

        let navnumber = $(this).index();

        $(".h_bot_menu > li").removeClass("on");
        $(this).addClass("on");


        $(".depthWrap .depthbox").css({
            "opacity": 0,
            "display": "none"
        });
        $(".depthWrap .depthbox").eq(navnumber).css({
            "opacity": 1,
            "display": "block"
        });

    });

    $(".h_bot").mouseleave(function(event) {

        event.preventDefault();

        $(".h_bot_menu > li").removeClass("on");

        $(".depthWrap .depthbg").stop().animate({
            "height": "0"
        }, 200);
        $(".depthWrap .depthbox").css({
            "opacity": 0,
            "display": "none"
        });

    });

    //메뉴
    var flag = true;
    $(".m-btn").click(function(event) {

        event.preventDefault();
        if (flag) {
            $("header").addClass("openFull");
            $(".m-navWrap").css({
                "width": "100%"
            });
            $(".bBg").stop().fadeIn();
            $(".m-navbox").stop().addClass("on");
            $(".m-navbox").stop().addClass("on");
            $("html, body").addClass("scrollLock");

            flag = false;
        } else {
            $("header").removeClass("openFull");
            $(".bBg").stop().fadeOut();
            $(".m-navWrap").css({
                "width": "0"
            });
            $(".m-navbox").stop().removeClass("on");
            $(".m-depth2").stop().slideUp();
            $(".m-nav > li").removeClass("on");
            $("html, body").removeClass("scrollLock");

            flag = true;
        }
    });


    //모바일 gnb depth2
    $(".m-nav > li > a").on("click", function() {

        $(this).parent().siblings().children(".m-depth2").stop().slideUp();

        $(this).siblings(".m-depth2").stop().slideToggle();

        $(this).parent().siblings().removeClass("on");
        $(this).parent().toggleClass("on");
    });
</script>