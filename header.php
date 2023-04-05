<?
include "/home/edufim/www/module/login/head.php";

if($_SERVER['REMOTE_ADDR'] == '106.246.92.237' && $deviceId){
	echo$deviceId.'/';
}

?>
<header class="header blue_gradient c_w" id="header">
    <div class="h_top bor_bot">
        <div class="c_center">
            <div class="h_top_wrap dp_sb">
                <div class="langWrap">
                    <div class="toggleTit dp_f dp_c">
                        <!-- <img src="../images/earthIcon.svg" alt=""> -->
                        <span class="f12 bold" style="margin: 0 15px 0 8px;">KOR</span>
                        <div class="dp_f dp_c langArr">
                            <!-- <img src="../images/lang_arrow.svg" alt=""> -->
                        </div>
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
            <h1 class="logo txt-c"><a href="/" title="logo"><!--<img src="/images/logo.svg" alt="logo">--><img src="/images/logo_wht3.png" alt="logo"></a></h1>

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
                                <li><a href="/mypage/cart" title="장바구니">장바구니</a></li>
                            <? } ?>
                        </ul>
                        <a class="classBtn bora dp_f dp_c dp_cc c_w" href="/mypage/learning/" title="나의 강의실">나의 강의실</a>
                    </div>
                    <ul class="m-nav">
                        <li>
                            <a href="javascript:void(0);" title="ALL 클래스">ALL 클래스</a>
                            <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <div class="m-depth2">
                                <div class="p_r toggle_tit">
                                    <p>물리치료사</p>
                                    <span class="lnr lnr-chevron-down"></span>
                                    <span class="lnr lnr-chevron-up"></span>
                                </div>
                                    <div class="toggle_cont">
                            
                                    <?
                                    $cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='물리치료사'");
                                    $sql = "SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort";
                                    $cade02 = sqlArray($sql);
                                    for ($i = 0; $i < count($cade02); $i++) {
                                    ?>
                                        <ul class="m-depth3">
                                            <li>
                                                <a class="c_bora dp_b bold2" href="/sub01/sub01.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>" title="<?= $cade02[$i]['title'] ?>">
                                                    <?= $cade02[$i]['title'] ?>
                                                </a>
                                                <ul class="m-depth5">
                                                    <?
                                                    $cade02_uid = $cade02[$i]['uid'];
                                                    $sql = "SELECT * FROM ks_class_cade03 WHERE cade01=$cade01 AND cade02=$cade02_uid ORDER BY sort";
                                                    $cade03 = sqlArray($sql);
                                                    for ($j = 0; $j < count($cade03); $j++) {
                                                    ?>
                                                        <li>
                                                            <a class="c_bora dp_b bold2" href="/sub01/sub02.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>&cade03=<?= $cade03[$j]['uid'] ?>" title="<?= $cade03[$j]['title'] ?>"><?= $cade03[$j]['title'] ?></a>
                                                            <ul class="m-depth6">

                                                                <?
                                                                $cade03_uid = $cade03[$j]['uid'];
                                                                $sql = "SELECT uid, title FROM ks_class WHERE status=1 AND cade01=$cade01 AND cade02=$cade02_uid AND cade03=$cade03_uid";
                                                                $classes = sqlArray($sql);
                                                                foreach ($classes as $class) {
                                                                ?>
                                                                    <li><a class="c_gry dp_b" href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                                <? } ?>
                                                            </ul>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="m-depth2">
                                <div class="p_r toggle_tit">
                                    <p>필라테스</p>
                                    <span class="lnr lnr-chevron-down"></span>
                                    <span class="lnr lnr-chevron-up"></span>
                                </div>
                                <div class="toggle_cont">
                                    <?
                                    $cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='필라테스'");
                                    $sql = "SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort";
                                    $cade02 = sqlArray($sql);
                                    for ($i = 0; $i < count($cade02); $i++) {
                                    ?>
                                        <ul class="m-depth3">
                                            <li>
                                                <a class="c_bora dp_b bold2" href="/sub01/sub01.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>" title="<?= $cade02[$i]['title'] ?>">
                                                    <?= $cade02[$i]['title'] ?>
                                                </a>
                                                <ul class="m-depth5">
                                                    <?
                                                    $cade02_uid = $cade02[$i]['uid'];
                                                    $sql = "SELECT * FROM ks_class_cade03 WHERE cade01=$cade01 AND cade02=$cade02_uid ORDER BY sort";
                                                    $cade03 = sqlArray($sql);
                                                    for ($j = 0; $j < count($cade03); $j++) {
                                                    ?>
                                                        <li>
                                                            <a class="bold2 dp_b " href="/sub01/sub02.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>&cade03=<?= $cade03[$j]['uid'] ?>" title="<?= $cade03[$j]['title'] ?>"><?= $cade03[$j]['title'] ?></a>
                                                            <ul class="m-depth6">

                                                                <?
                                                                $cade03_uid = $cade03[$j]['uid'];
                                                                $sql = "SELECT uid, title FROM ks_class WHERE status=1 AND cade01=$cade01 AND cade02=$cade02_uid AND cade03=$cade03_uid";
                                                                $classes = sqlArray($sql);
                                                                foreach ($classes as $class) {
                                                                ?>
                                                                    <li><a class="c_gry dp_b" href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                                <? } ?>
                                                            </ul>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="m-depth2">
                                <div class="p_r toggle_tit">
                                    <p>트레이너</p>
                                    <span class="lnr lnr-chevron-down"></span>
                                    <span class="lnr lnr-chevron-up"></span>
                                </div>
                                <div class="toggle_cont">
                                    <?
                                    $cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='트레이너'");
                                    $sql = "SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort";
                                    $cade02 = sqlArray($sql);
                                    for ($i = 0; $i < count($cade02); $i++) {
                                    ?>   
                                        <ul class="depth1">
                                            <li>
                                                <a class="c_bora dp_b bold2" href="/sub01/sub01.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>" title="<?= $cade02[$i]['title'] ?>">
                                                    <?= $cade02[$i]['title'] ?>
                                                </a>
                                                <ul class="m-depth3">
                                                    <?
                                                    $cade02_uid = $cade02[$i]['uid'];
                                                    $sql = "SELECT * FROM ks_class_cade03 WHERE cade01=$cade01 AND cade02=$cade02_uid ORDER BY sort";
                                                    $cade03 = sqlArray($sql);
                                                    for ($j = 0; $j < count($cade03); $j++) {
                                                    ?>
                                                        <li>
                                                            <a class="bold2 dp_b " href="/sub01/sub02.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>&cade03=<?= $cade03[$j]['uid'] ?>" title="<?= $cade03[$j]['title'] ?>"><?= $cade03[$j]['title'] ?></a>
                                                            <ul class="m-depth5">

                                                                <?
                                                                $cade03_uid = $cade03[$j]['uid'];
                                                                $sql = "SELECT uid, title FROM ks_class WHERE status=1 AND cade01=$cade01 AND cade02=$cade02_uid AND cade03=$cade03_uid";
                                                                $classes = sqlArray($sql);
                                                                foreach ($classes as $class) {
                                                                ?>
                                                                    <li><a class="c_gry dp_b" href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                                <? } ?>
                                                            </ul>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    <? } ?>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:void(0);" title="국제인증자격증과정">국제인증자격증과정</a>
                            <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <div class="m-depth2">

                                <?
                                    $cade01 = sqlRowOne("SELECT uid FROM ks_license_cade01 WHERE title='국제인증자격증과정'");

                                    $sql = "SELECT * FROM ks_license WHERE status=1 AND cade01='$cade01' ORDER BY uid";
                                    $license_arr = sqlArray($sql);

                                    for ($i = 0; $i < count($license_arr); $i++) {
                                        $license = $license_arr[$i];
                                ?>

                                <ul class="m-depth3">
                                    <li>
                                        <a class="c_bora dp_b bold2" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                            <?= $license['title'] ?>
                                        </a>
                                        <ul class="m-depth5">
                                            <li>
                                                <a class="bold2 dp_b" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                                    필수 이수강좌
                                                </a>
                                                <ul class="m-depth6">
                                                    <?
                                                    $required_classes = sqlArray("SELECT (SELECT title FROM ks_class WHERE ks_license_list.class_uid=ks_class.uid) AS ctitle FROM ks_license_list WHERE license_uid=" . $license['uid'] . " AND is_required=1 ORDER BY sort");
                                                    foreach ($required_classes as $class) {
                                                    ?>
                                                        <li>
                                                            <a class="c_gry dp_b" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                                                <?= $class['ctitle'] ?>
                                                            </a>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="bold2 dp_b" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                                    선택 이수강좌
                                                </a>
                                                <ul class="m-depth6">
                                                    <?
                                                    $not_required_classes = sqlArray("SELECT (SELECT title FROM ks_class WHERE ks_license_list.class_uid=ks_class.uid) AS ctitle FROM ks_license_list WHERE license_uid=" . $license['uid'] . " AND is_required=0 ORDER BY sort");
                                                    foreach ($not_required_classes as $class) {
                                                    ?>
                                                        <li>
                                                            <a class="c_gry dp_b" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                                                <?= $class['ctitle'] ?>
                                                            </a>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <? } ?>
                            </div>
                        </li>
                        <li>
                            <a href="/sub04/" title="BEST 콜라보">BEST 콜라보</a>
                        </li>
                        <li>
                            <a href="/sub05/" title="필라테스자격증">필라테스자격증</a>
                            <!-- <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <ul class="m-depth2">
                                <li><a href="/sub06/" title="홈트">홈트</a></li>
                                <?
                                $homet_arr = sqlArray("SELECT * FROM ks_class WHERE cade01=20");
                            
                                for ($i = 0; $i < count($homet_arr); $i++) {
                                    $homet = $homet_arr[$i];
                                ?>
                                    <li><a href="/sub06/view.php?&code=<?= $homet['uid'] ?>" title="<?= $homet['title'] ?>"><?= $homet['title'] ?></a></li>
                                <? } ?>
                                <li><a href="" title="다이어트">다이어트</a></li>
                                <li><a href="" title="체형교정">체형교정</a></li>
                                <li><a href="" title="통증컨트롤">통증컨트롤</a></li>
                            </ul> -->
                        </li>
                        <li>
                            <a href="javascript:void(0);" title="STORE">STORE</a>
                            <span class="lnr lnr-chevron-down"></span>
                            <span class="lnr lnr-chevron-up"></span>
                            <ul class="m-depth2">
                                <li><a href="/store/" title="스토어">스토어</a></li>
                                <li><a href="" title="교재">교재</a></li>
                                <li><a href="" title="CBP 필로우">CBP 필로우</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/sub08/" title="후기">후기</a>
                        </li>
                        <!-- <li>
							<a href="javascript:void(0);" title="자격증시험응시">자격증시험응시</a>
							<span class="lnr lnr-chevron-down"></span>
							<span class="lnr lnr-chevron-up"></span>
							<ul class="m-depth2">
								<li><a href="/sub09/" title="자격증시험응시">자격증시험응시</a></li>
								<li><a href="" title="공지사항">필라테스 지도자과정 이론시험</a></li>
							</ul>
						</li> -->
                        <li>
                            <a href="javascript:void(0);" title="Q&A">Q&A</a>
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
    //모바일 ALL클래스 4-5차 메뉴 TOGGLE
    $(".m-depth2 > .toggle_tit").on("click", function() {

        $(".toggle_cont").stop().slideUp();
        $(this).siblings(".toggle_cont").stop().slideToggle();

        $(this).parent().siblings().children(".toggle_tit").removeClass("on");
        $(this).toggleClass("on");
    });

    </script>

    <div class="h_bot">
        <div class="c_center dp_sb">
            <ul class="h_bot_menu dp_f">
                <li><a class="dp_b bold" href="/sub01/" title="ALL클래스">ALL클래스</a></li>
                <li><a class="dp_b bold" href="/sub03/" title="국제인증자격증과정">국제인증자격증과정</a></li>
                <li><a class="dp_b bold" href="/sub04/" title="BEST 콜라보">BEST 콜라보</a></li>
                <li><a class="dp_b bold" href="/sub05/" title="필라테스자격증">필라테스자격증</a></li>
                <li><a class="dp_b bold" href="/event/" title="이벤트">이벤트</a></li>
                <li><a class="dp_b bold" href="/store/" title="STORE">STORE</a></li>
                <li><a class="dp_b bold" href="/sub08/" title="후기">후기</a></li>
                <!-- <li><a class="dp_b bold" href="/sub09/" title="자격증시험응시">자격증시험응시</a></li> -->
                <li><a class="dp_b bold" href="/sub10/sub01.php" title="Q&A">Q&A</a></li>
            </ul>
            <a class="classBtn bora dp_f dp_c dp_cc c_w" href="/mypage/learning/" title="나의 강의실">나의 강의실</a>
        </div>
        <div class="depthWrap">
            <div class="boxWrap">
                <div class="depthbox">
                    <div class="c_center">
                        <ul class="alcMnWrap_btn dp_f dp_c">
                            <li class="on"><a class="dp_f dp_c dp_cc c_w" href="" title="물리치료사">물리치료사</a></li>
                            <li><a class="dp_f dp_c dp_cc c_w" href="" title="필라테스">필라테스</a></li>
                            <li><a class="dp_f dp_c dp_cc c_w" href="" title="트레이너">트레이너</a></li>
                        </ul>
                        <div class="alcMnWrap_wrap">
                            <div class="dp_f alcMnWrap">
                                <?
                                $cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='물리치료사'");
                                $sql = "SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort";
                                $cade02 = sqlArray($sql);
                                for ($i = 0; $i < count($cade02); $i++) {
                                ?>
                                    <div class="allClassMenu wid20">
                                        <ul class="depth1">
                                            <li>
                                                <a class="c_bora dp_b bold2" href="/sub01/sub01.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>" title="<?= $cade02[$i]['title'] ?>">
                                                    <?= $cade02[$i]['title'] ?>
                                                </a>
                                                <ul class="depth2">
                                                    <?
                                                    $cade02_uid = $cade02[$i]['uid'];
                                                    $sql = "SELECT * FROM ks_class_cade03 WHERE cade01=$cade01 AND cade02=$cade02_uid ORDER BY sort";
                                                    $cade03 = sqlArray($sql);
                                                    for ($j = 0; $j < count($cade03); $j++) {
                                                    ?>
                                                        <li>
                                                            <a class="bold2" href="/sub01/sub02.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>&cade03=<?= $cade03[$j]['uid'] ?>" title="<?= $cade03[$j]['title'] ?>"><?= $cade03[$j]['title'] ?></a>
                                                            <ul class="depth3">

                                                                <?
                                                                $cade03_uid = $cade03[$j]['uid'];
                                                                $sql = "SELECT uid, title FROM ks_class WHERE status=1 AND cade01=$cade01 AND cade02=$cade02_uid AND cade03=$cade03_uid";
                                                                $classes = sqlArray($sql);
                                                                foreach ($classes as $class) {
                                                                ?>
                                                                    <li><a class="c_gry dp_b" href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                                <? } ?>
                                                            </ul>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                <? } ?>
                            </div>
                            <div class="dp_f alcMnWrap">
                                <?
                                $cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='필라테스'");
                                $sql = "SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort";
                                $cade02 = sqlArray($sql);
                                for ($i = 0; $i < count($cade02); $i++) {
                                ?>
                                    <div class="allClassMenu wid20">
                                        <ul class="depth1">
                                            <li>
                                                <a class="c_bora dp_b bold2" href="/sub01/sub01.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>" title="<?= $cade02[$i]['title'] ?>">
                                                    <?= $cade02[$i]['title'] ?>
                                                </a>
                                                <ul class="depth2">
                                                    <?
                                                    $cade02_uid = $cade02[$i]['uid'];
                                                    $sql = "SELECT * FROM ks_class_cade03 WHERE cade01=$cade01 AND cade02=$cade02_uid ORDER BY sort";
                                                    $cade03 = sqlArray($sql);
                                                    for ($j = 0; $j < count($cade03); $j++) {
                                                    ?>
                                                        <li>
                                                            <a class="bold2" href="/sub01/sub02.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>&cade03=<?= $cade03[$j]['uid'] ?>" title="<?= $cade03[$j]['title'] ?>"><?= $cade03[$j]['title'] ?></a>
                                                            <ul class="depth3">

                                                                <?
                                                                $cade03_uid = $cade03[$j]['uid'];
                                                                $sql = "SELECT uid, title FROM ks_class WHERE status=1 AND cade01=$cade01 AND cade02=$cade02_uid AND cade03=$cade03_uid";
                                                                $classes = sqlArray($sql);
                                                                foreach ($classes as $class) {
                                                                ?>
                                                                    <li><a class="c_gry dp_b" href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                                <? } ?>
                                                            </ul>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                <? } ?>
                            </div>
                            <div class="dp_f alcMnWrap">
                                <?
                                $cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='트레이너'");
                                $sql = "SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort";
                                $cade02 = sqlArray($sql);
                                for ($i = 0; $i < count($cade02); $i++) {
                                ?>
                                    <div class="allClassMenu wid20">
                                        <ul class="depth1">
                                            <li>
                                                <a class="c_bora dp_b bold2" href="/sub01/sub01.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>" title="<?= $cade02[$i]['title'] ?>">
                                                    <?= $cade02[$i]['title'] ?>
                                                </a>
                                                <ul class="depth2">
                                                    <?
                                                    $cade02_uid = $cade02[$i]['uid'];
                                                    $sql = "SELECT * FROM ks_class_cade03 WHERE cade01=$cade01 AND cade02=$cade02_uid ORDER BY sort";
                                                    $cade03 = sqlArray($sql);
                                                    for ($j = 0; $j < count($cade03); $j++) {
                                                    ?>
                                                        <li>
                                                            <a class="bold2" href="/sub01/sub02.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02[$i]['uid'] ?>&cade03=<?= $cade03[$j]['uid'] ?>" title="<?= $cade03[$j]['title'] ?>"><?= $cade03[$j]['title'] ?></a>
                                                            <ul class="depth3">

                                                                <?
                                                                $cade03_uid = $cade03[$j]['uid'];
                                                                $sql = "SELECT uid, title FROM ks_class WHERE status=1 AND cade01=$cade01 AND cade02=$cade02_uid AND cade03=$cade03_uid";
                                                                $classes = sqlArray($sql);
                                                                foreach ($classes as $class) {
                                                                ?>
                                                                    <li><a class="c_gry dp_b" href="/sub01/view.php?&code=<?= $class['uid'] ?>" title="<?= $class['title'] ?>"><?= $class['title'] ?></a></li>
                                                                <? } ?>
                                                            </ul>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="depthbox">
                    <div class="c_center dp_f alcMnWrap">
                        <?
                        $cade01 = sqlRowOne("SELECT uid FROM ks_license_cade01 WHERE title='국제인증자격증과정'");

                        $sql = "SELECT * FROM ks_license WHERE status=1 AND cade01='$cade01' ORDER BY uid";
                        $license_arr = sqlArray($sql);

                        for ($i = 0; $i < count($license_arr); $i++) {
                            $license = $license_arr[$i];
                        ?>
                            <div class="allClassMenu wid20">
                                <ul class="depth1">
                                    <li>
                                        <a class="c_bora dp_b bold2" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                            <?= $license['title'] ?>
                                        </a>
                                        <ul class="depth2">
                                            <li>
                                                <a class="bold2" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                                    필수 이수강좌
                                                </a>
                                                <ul class="depth3">
                                                    <?
                                                    $required_classes = sqlArray("SELECT (SELECT title FROM ks_class WHERE ks_license_list.class_uid=ks_class.uid) AS ctitle FROM ks_license_list WHERE license_uid=" . $license['uid'] . " AND is_required=1 ORDER BY sort");
                                                    foreach ($required_classes as $class) {
                                                    ?>
                                                        <li>
                                                            <a class="c_gry dp_b" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                                                <?= $class['ctitle'] ?>
                                                            </a>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="bold2" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                                    선택 이수강좌
                                                </a>
                                                <ul class="depth3">
                                                    <?
                                                    $not_required_classes = sqlArray("SELECT (SELECT title FROM ks_class WHERE ks_license_list.class_uid=ks_class.uid) AS ctitle FROM ks_license_list WHERE license_uid=" . $license['uid'] . " AND is_required=0 ORDER BY sort");
                                                    foreach ($not_required_classes as $class) {
                                                    ?>
                                                        <li>
                                                            <a class="c_gry dp_b" href="/sub03/view.php?code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>">
                                                                <?= $class['ctitle'] ?>
                                                            </a>
                                                        </li>
                                                    <?
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?
                        }
                        ?>
                    </div>
                </div>

                <div class="depthbox">
                    <!--빈값 best콜라보-->
                </div>

                <div class="depthbox" style="height: 160px;">
                    <?
                    $cade01 = sqlRowOne("SELECT uid FROM ks_license_cade01 WHERE title='필라테스자격증'");
                    ?>
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
                                    $sql = "SELECT * FROM ks_license_cade02 WHERE cade01='$cade01' ORDER BY sort";
                                    $cade02 = sqlArray($sql);

                                    for ($i = 0; $i < count($cade02); $i++) {
                                        $license = $cade02[$i];
                                    ?>
                                        <li><a href="/sub05/view.php?&code=<?= $license['uid'] ?>" title="<?= $license['title'] ?>"><?= $license['title'] ?></a></li>
                                    <?
                                    }
                                    ?>
                                    <!-- <li><a href="" title="필라테스 지도자 자격증">필라테스 지도자 자격증</a></li>
									<li><a href="" title="CBP 카이로플랙틱">CBP 카이로플랙틱</a></li> -->
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

    $(".alcMnWrap_btn li").on("click",function(event){
        event.preventDefault();

        let tabNumber = $(this).index();

        $(".alcMnWrap_btn li").removeClass("on");
        $(this).addClass("on");

        $(".alcMnWrap_wrap .alcMnWrap").stop().hide();
        $(".alcMnWrap_wrap .alcMnWrap").eq(tabNumber).css({"display":"flex"});

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

<?
unset($cade01);
unset($cade02);
unset($cade03);
unset($cade04);
?>