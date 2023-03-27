<?
include './header.php';

$main_query = "SELECT *, (SELECT COUNT(1) FROM ks_wish WHERE ks_wish.userid='$GBL_USERID' AND ks_class.uid=ks_wish.class_uid) AS is_wish FROM ks_class WHERE status=1";
$limit = 10;
?>

<!--  -->
<div class="visual">
    <div class="visualSlick">
        <?
        $query = "SELECT * FROM config_main WHERE type='BANNER' AND (upfile!='' AND upfile IS NOT NULL) ORDER BY sort";
        $result = mysql_query($query) or die('Banner Config Error : ' . mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $sort = sprintf("%02d", $row['sort']);
        ?>
            <div class="v_slickBox v_slick<?= $sort ?>">
                <a href="<?= $row['url'] ?>" title="mainslide<?= $sort ?>" target="<?= $row['target'] ?>"><img src="/upfile/main/<?= $row['upfile'] ?>" alt="<?= $row['realfile'] ?>"></a>
            </div>
        <? } ?>
    </div>

    <div class="mainVbtnWrap dp_f dp_c">
        <div class="mVstopBtn"></div>
        <div class="mVprevBtn">
            <span class="lnr lnr-chevron-left"></span>
        </div>
        <div class="pagingInfo"></div>
        <div class="mVnextBtn">
            <span class="lnr lnr-chevron-right"></span>
        </div>
    </div>
</div>

<script>
    var $status = $('.pagingInfo');
    var $slickElement = $('.visualSlick');

    $slickElement.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {
        //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
        var i = (currentSlide ? currentSlide : 0) + 1;
        $status.text(i + ' / ' + slick.slideCount);
    });


    $slickElement.slick({
        infinite: true,
        autoplay: true, // 자동 스크롤 사용 여부
        autoplaySpeed: 3000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
        speed: 500,
        arrows: true,
        fade: false,
        prevArrow: $('.mVprevBtn'),
        nextArrow: $('.mVnextBtn')
    });
    var flag05 = true;
    $('.mainVbtnWrap .mVstopBtn').click(function() {
        if (flag05) {

            $('.visualSlick').slick('slickPause');
            $(this).addClass("on");

            flag05 = false;
        } else {
            $('.visualSlick').slick('slickPlay');
            $(this).removeClass("on");

            flag05 = true;
        }
    });
</script>

<!--  -->
<section class="cont1 blue_gradient c_w">
    <div class="c_center">
        <div class="newWrap">
            <div class="video_tit_wrap dp_sb dp_end">
                <div class="videoTit dp_f dp_c">
                    <span class="newTi span_ti dp_f dp_c dp_cc">NEW</span>
                    <h3>신규 클래스</h3>
                </div>
                <a class="c_tit_btn dp_b bold" href="/sub01/" title="전체 클래스 보기">전체 클래스 보기&nbsp;&nbsp;+</a>
            </div>
            <div class="p_r newVdSlick_wrap">
                <div class="swiper newVdSlick">
                    <div class="swiper-wrapper">
                        <?
                        $row_arr = sqlArray($main_query . " ORDER BY rDate DESC LIMIT " . $limit);
                        foreach ($row_arr as $row) {
                        ?>
                            <div class="nVdSlickBox swiper-slide">
                                <a href="/sub01/view.php?&code=<?= $row['uid'] ?>" title="<?= $row['title'] ?>">
                                    <div class="imgWrap c_gry02 p_r" style="background-image: url('/upfile/class/<?= $row['upfile01'] ?>')">
                                        <button type="button" title="관심" class="likeMark <? if ($row['is_wish']) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $row['uid'] ?>"></button>
                                    </div>
                                    <div class="nVdCont">
                                        <div class="nVdTop">
                                            <p class="nVdtit01 bold2 dotdot"><?= $row['title'] ?></p>
                                            <p class="nVdtit02 c_gry03 dotdot"><?= $row['exp'] ?></p>
                                            <ul class="clickicon dp_f dp_c">
                                                <li class="dp_f dp_c">
                                                    <img src="/images/likeChk.svg" alt="">
                                                    <span><?= $row['wish'] ?></span>
                                                </li>
                                                <li class="dp_f dp_c">
                                                    <img src="/images/bestChk.svg" alt="">
                                                    <span><?= $row['hit'] ?>%</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div><?= price_tag($row['price'], $row['discountPrice'], $row['discountRate'], $row['period']) ?></div>
                                    </div>
                                </a>
                            </div>

                        <? } ?>

                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <div class="hotWrap">
            <div class="video_tit_wrap dp_sb dp_c">
                <div class="videoTit dp_f dp_c">
                    <span class="hotTi span_ti dp_f dp_c dp_cc">HOT</span>
                    <h3>실시간 인기 클래스</h3>
                </div>
                <a class="c_tit_btn dp_b bold" href="/sub01/" title="전체 클래스 보기">전체 클래스 보기&nbsp;&nbsp;+</a>
            </div>
            <div class="p_r hotVdSlick_wrap">
                <div class="swiper hotVdSlick">
                    <div class="swiper-wrapper">
                        <?
                        $row_arr = sqlArray($main_query . " ORDER BY hit DESC LIMIT " . $limit);
                        foreach ($row_arr as $row) {
                        ?>

                            <div class="nVdSlickBox swiper-slide">
                                <a href="/sub01/view.php?&code=<?= $row['uid'] ?>" title="<?= $row['title'] ?>">
                                    <div class="imgWrap c_gry02 p_r" style="background-image: url('/upfile/class/<?= $row['upfile01'] ?>')">
                                        <button type="button" title="관심" class="likeMark <? if ($row['is_wish']) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $row['uid'] ?>"></button>
                                    </div>
                                    <div class="nVdCont">
                                        <div class="nVdTop">
                                            <p class="nVdtit01 bold2 dotdot"><?= $row['title'] ?></p>
                                            <p class="nVdtit02 c_gry03 dotdot"><?= $row['exp'] ?></p>
                                            <ul class="clickicon dp_f dp_c">
                                                <li class="dp_f dp_c">
                                                    <img src="/images/likeChk.svg" alt="">
                                                    <span><?= $row['wish'] ?></span>
                                                </li>
                                                <li class="dp_f dp_c">
                                                    <img src="/images/bestChk.svg" alt="">
                                                    <span><?= $row['hit'] ?>%</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div><?= price_tag($row['price'], $row['discountPrice'], $row['discountRate'], $row['period']) ?></div>
                                    </div>
                                </a>
                            </div>

                        <? } ?>

                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

<script>
    var swiper01 = new Swiper(".newVdSlick", {
        slidesPerView: 4,
        spaceBetween: 20,
        navigation: {
            nextEl: ".newVdSlick_wrap .swiper-button-next",
            prevEl: ".newVdSlick_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,
                paceBetween: 50,
                allowTouchMove: true,
            },
            600: {
                slidesPerView: 2,
                paceBetween: 50,
                allowTouchMove: true,
            },
            200: {
                slidesPerView: 1,
                paceBetween: 50,
                allowTouchMove: true,
            },
        },
    });

    var swiper02 = new Swiper(".hotVdSlick", {
        slidesPerView: 4,
        spaceBetween: 20,
        navigation: {
            nextEl: ".hotVdSlick_wrap .swiper-button-next",
            prevEl: ".hotVdSlick_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,
                paceBetween: 50,
                allowTouchMove: true,
            },
            600: {
                slidesPerView: 2,
                paceBetween: 50,
                allowTouchMove: true,
            },
            200: {
                slidesPerView: 1,
                paceBetween: 50,
                allowTouchMove: true,
            },
        },
    });
</script>

<!--  -->
<section class="cont2">
    <div class="c_titWrap blue_gradient c_w">
        <div class="c_center dp_sb dp_end">
            <div class="titcont">
                <p>Edufim Event</p>
                <h3>이달의 혜택</h3>
            </div>
            <ul class="indicaotr dp_f">
                <li class="bnrprevBtn"></li>
                <li class="bnrnextBtn"></li>
            </ul>
        </div>
    </div>
    <div class="bannerSlick">
        <?
        $query = "SELECT * FROM config_main WHERE type='EVENT' AND (upfile!='' AND upfile IS NOT NULL) ORDER BY sort";
        $result = mysql_query($query) or die('Banner Config Error : ' . mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $sort = sprintf("%02d", $row['sort']);
        ?>
            <div class="v_slickBox v_slick<?= $sort ?>">
                <a href="<?= $row['url'] ?>" title="mainslide<?= $sort ?>" target="<?= $row['target'] ?>"><img src="/upfile/main/<?= $row['upfile'] ?>" alt="<?= $row['realfile'] ?>"></a>
            </div>
        <? } ?>
    </div>
</section>

<script>
    $('.bannerSlick').slick({
        fade: false,
        dots: true,
        arrows: true,
        autoplay: true, // 자동 스크롤 사용 여부
        autoplaySpeed: 5000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
        prevArrow: $('.bnrprevBtn'),
        nextArrow: $('.bnrnextBtn')
    });
</script>

<!--  -->
<section class="cont3 blue_gradient c_w">
    <div class="c_center">
        <!--강의 후기-->
        <div class="c_titWrap dp_sb dp_end">
            <div class="titcont">
                <p>REVIEW</p>
                <h3>강의 후기</h3>
            </div>
            <a class="c_tit_btn" href="/sub08" title="자세히 보기">자세히 보기&nbsp;&nbsp;+</a>
        </div>
        <div class="p_r rcmtSlick_wrap">
            <div class="swiper rcmtSlick">
                <div class="swiper-wrapper">
                    <?
                    $reviews = sqlArray("SELECT r.*, m.name FROM ks_review r JOIN ks_member m ON r.userid=m.userid ORDER BY r.rDate DESC LIMIT 10");
                    foreach ($reviews as $review) {
                        $rname = mb_substr($review['name'], 0, 1, 'utf-8');
                    ?>
                        <div class="rcmt_box swiper-slide">
                            <p class="rcmt_tit bold2"><?= $review['title'] ?></p>
                            <div class="nameCirBox dp_f dp_c dp_cc"><?= $rname ?>**</div>
                            <p class="reviewTxt txt-c"><?= $review['content'] ?></p>
                        </div>
                    <? } ?>
                    <!-- <div class="rcmt_box swiper-slide">
						<p class="rcmt_tit bold2">강의 완전 강추합니다!!</p>
						<div class="nameCirBox dp_f dp_c dp_cc">iwebz***님</div>
						<p class="reviewTxt txt-c">이것은 테스트이며, 수강평 후기를 입력해주신다면 감사하겠습니다. 후기를 입력해주세요!</p>
					</div> -->
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>


        <div class="p_r rvdoSlick_wrap">
            <div class="swiper rvdoSlick">
                <div class="swiper-wrapper">
                    <?
                    $classes = sqlArray("SELECT * FROM ks_class ORDER BY rDate DESC LIMIT 10");
                    foreach ($classes as $class) {
                    ?>
                        <div class="rvdo_box swiper-slide">
                            <!-- <a href="" title=""> -->
                            <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                            <img class="playShape" src="/images/playBtn.svg" alt="">
                            <!-- </a> -->
                        </div>
                    <? } ?>
                    <!-- <div class="rvdo_box swiper-slide">
						<a href="" title="">
							<img src="" alt="">
							<img class="playShape" src="/images/playBtn.svg" alt="">
						</a>
					</div> -->
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <script>
            var swiper03 = new Swiper(".rvdoSlick", {
                slidesPerView: 3,
                spaceBetween: 20,
                slidesPerGroup: 3,
                navigation: {
                    nextEl: ".rvdoSlick_wrap .swiper-button-next",
                    prevEl: ".rvdoSlick_wrap .swiper-button-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 3,
                        paceBetween: 50,
                        allowTouchMove: true,
                    },
                    600: {
                        slidesPerView: 2,
                        paceBetween: 50,
                        slidesPerGroup: 1,
                        allowTouchMove: true,
                    },
                    200: {
                        slidesPerView: 1,
                        paceBetween: 50,
                        slidesPerGroup: 1,
                        allowTouchMove: true,
                    },
                },
            });

            var swiper04 = new Swiper(".rcmtSlick", {
                slidesPerView: 4,
                spaceBetween: 20,
                navigation: {
                    nextEl: ".rcmtSlick_wrap .swiper-button-next",
                    prevEl: ".rcmtSlick_wrap .swiper-button-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        paceBetween: 20,
                        allowTouchMove: true,
                    },
                    1000: {
                        slidesPerView: 3,
                        paceBetween: 50,
                        allowTouchMove: true,
                    },
                    600: {
                        slidesPerView: 2,
                        paceBetween: 50,
                        allowTouchMove: true,
                    },
                    200: {
                        slidesPerView: 1,
                        paceBetween: 50,
                        allowTouchMove: true,
                    },
                },
            });
        </script>


        <!--자격증 커리큘럼-->
        <div class="c_titWrap dp_sb dp_end">
            <div class="titcont">
                <p>Curriculum</p>
                <h3>자격증 커리큘럼</h3>
            </div>
            <a class="c_tit_btn" href="/sub03" title="자세히 보기">자세히 보기&nbsp;&nbsp;+</a>
        </div>

        <div class="curri_slick_wrap p_r">
            <div class="swiper curri_slick">
                <div class="swiper-wrapper">
                    <div class="curri_box swiper-slide">
                        <p class="c_bora01 bold2 txt-c">국제인증강사</p>
                        <a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="#" title="자세히 보기">자세히 보기</a>
                    </div>
                    <div class="curri_box swiper-slide">
                        <p class="c_bora01 bold2 txt-c">물리치료사강사</p>
                        <a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="#" title="자세히 보기">자세히 보기</a>
                    </div>
                    <div class="curri_box swiper-slide">
                        <p class="c_bora01 bold2 txt-c">anatomy master</p>
                        <a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="#" title="자세히 보기">자세히 보기</a>
                    </div>
                    <div class="curri_box swiper-slide">
                        <p class="c_bora01 bold2 txt-c">체형분석평가사</p>
                        <a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="#" title="자세히 보기">자세히 보기</a>
                    </div>
                    <div class="curri_box swiper-slide">
                        <p class="c_bora01 bold2 txt-c">골프피지오 2급</p>
                        <a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="#" title="자세히 보기">자세히 보기</a>
                    </div>
                    <div class="curri_box swiper-slide">
                        <p class="c_bora01 bold2 txt-c">필라테스시퀀스처방사</p>
                        <a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="#" title="자세히 보기">자세히 보기</a>
                    </div>
                    <div class="curri_box swiper-slide">
                        <p class="c_bora01 bold2 txt-c">필라테스지도자</p>
                        <a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="#" title="자세히 보기">자세히 보기</a>
                    </div>
                    <div class="curri_box swiper-slide">
                        <p class="c_bora01 bold2 txt-c">체형분석운동지도자</p>
                        <a class="curri_moreBtn dp_f dp_c dp_cc bora01 c_w" href="#" title="자세히 보기">자세히 보기</a>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <script>
            var swiper05 = new Swiper(".curri_slick", {
                slidesPerView: 4,
                spaceBetween: 20,
                navigation: {
                    nextEl: ".curri_slick_wrap .swiper-button-next",
                    prevEl: ".curri_slick_wrap .swiper-button-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 3,
                        paceBetween: 50,
                        allowTouchMove: true,
                    },
                    600: {
                        slidesPerView: 2,
                        paceBetween: 50,
                        allowTouchMove: true,
                    },
                    200: {
                        slidesPerView: 1,
                        paceBetween: 50,
                        allowTouchMove: true,
                    },
                },
            });
        </script>

        <!--맞춤 커리큘럼-->
        <div class="c_titWrap c_titWrap_sb dp_f dp_c">
            <div class="aiTi_wrap dp_f dp_c">
                <span class="aiTi span_ti dp_f dp_c dp_cc">AI</span>
                <h3>맞춤 커리큘럼</h3>
                <p class="slash">-</p>
            </div>
            <ul class="tabBtn02 hashTabBtn dp_f">
                <li class="on dp_f dp_c"><a class="dp_b" href="#" title="물리치료사">#물리치료사</a></li>
                <li class="dp_f dp_c"><a class="dp_b" href="#" title="필라테스강사">#필라테스강사</a></li>
                <li class="dp_f dp_c"><a class="dp_b" href="#" title="트레이너">#트레이너</a></li>
                <li class="dp_f dp_c"><a class="dp_b" href="#" title="일반인">#일반인</a></li>
            </ul>
        </div>
        <div class="tabCont02 hashTabCont">
            <div class="tabBox">
                <ul class="curricul_list box_06 dp_sb">
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0101">
                            <p class="c_w">평가과정</p>
                            <span class="c_gry06">Evaluation process</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0102">
                            <p class="c_w">도수기법</p>
                            <span class="c_gry06">Manual therapy</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0103">
                            <p class="c_w">운동접근법</p>
                            <span class="c_gry06">Exercise approach</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0104">
                            <p class="c_w">필라테스</p>
                            <span class="c_gry06">Pilates</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0105">
                            <p class="c_w">골프</p>
                            <span class="c_gry06">Golf</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0106">
                            <p class="c_w">기초해부</p>
                            <span class="c_gry06">Basic anatomy</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tabBox">
                <ul class="curricul_list box_05 dp_sb">
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0201">
                            <p class="c_w">기초해부</p>
                            <span class="c_gry06">Basic anatomy</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0202">
                            <p class="c_w">체형분석</p>
                            <span class="c_gry06">Body type analysis</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0203">
                            <p class="c_w">교정운동</p>
                            <span class="c_gry06">Corrective exercise</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0204">
                            <p class="c_w">시퀀스</p>
                            <span class="c_gry06">Sequence</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0205">
                            <p class="c_w">골프</p>
                            <span class="c_gry06">Golf</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tabBox">
                <ul class="curricul_list box_05 dp_sb">
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0301">
                            <p class="c_w">기초해부</p>
                            <span class="c_gry06">Basic anatomy</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0302">
                            <p class="c_w">체형분석</p>
                            <span class="c_gry06">Body type analysis</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0303">
                            <p class="c_w">교정운동</p>
                            <span class="c_gry06">Corrective exercise</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0304">
                            <p class="c_w">골프</p>
                            <span class="c_gry06">Sequence</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0305">
                            <p class="c_w">통증/재활</p>
                            <span class="c_gry06">Golf</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tabBox">
                <ul class="curricul_list box_02 dp_sb">
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0401">
                            <p class="c_w">필라테스 지도자</p>
                            <span class="c_gry06">Pilates leader</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                    <li>
                        <a class="classShowBtn" href="" title="" data-dp="0402">
                            <p class="c_w">홈트</p>
                            <span class="c_gry06">Home training</span>
                            <div class="plus_btn dp_f dp_c dp_cc"><!--배경으로 넣음--></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <script>
            var posY;

            $(".classShowBtn").click(function(event) {
                event.preventDefault();
                let browerWid = $(window).innerWidth();
                posY = $(window).scrollTop();
                index = $(this).data('dp');

                //$('#classShowFrame').html("<iframe src='./classDetail" + index + ".php?uid=" + index + "' name='' style='width:100%;height:675px;' frameborder='0' scrolling='auto'></iframe>");
                // console.log(browerWid);
                if (browerWid < 500) {
                    $('#classShowFrame').html("<iframe src='./classDetail" + index + ".php?uid=" + index + "' name='' style='width:100%;height:470px;' frameborder='0' scrolling='auto'></iframe>");
                } else {
                    $('#classShowFrame').html("<iframe src='./classDetail" + index + ".php?uid=" + index + "' name='' style='width:100%;height:675px;' frameborder='0' scrolling='auto'></iframe>");
                }

                $('.classShow_open').click();
                $("html, body").addClass("not_scroll");
                $("section").css("top", -posY);
            });
        </script>

        <!--한컷 강의-->
        <div class="c_titWrap c_titWrap_sb dp_f">
            <h3>한컷 강의</h3>

            <ul class="tabBtn04 vdTabBtn dp_f">
                <li><a class="on dp_f dp_c dp_cc" href="#vdcontSlick01" title="">#2022년 앞서가는 운동지도자가 되고 싶다면</a></li>
                <li><a class="dp_f dp_c dp_cc" href="#vdcontSlick02" title="">#기초가 탄탄한 운동 지도자가 되고 싶다면</a></li>
                <li><a class="dp_f dp_c dp_cc" href="#vdcontSlick03" title="">#필라테스 지도자를 꿈꾸고 있다면</a></li>
            </ul>

        </div>
        <div class="tabCont04 vdTabCont">
            <div id="vdcontSlick01" class="tabBox">
                <div class="vdTabSlick01_wrap p_r">
                    <div class="swiper vdTabSlick01 vdTabSlick">
                        <div class="swiper-wrapper">
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                            </div>
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                            </div>
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div id="vdcontSlick02" class="tabBox">
                <div class="vdTabSlick02_wrap p_r">
                    <div class="swiper vdTabSlick02 vdTabSlick">
                        <div class="swiper-wrapper">
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                            </div>
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                            </div>
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div id="vdcontSlick03" class="tabBox">
                <div class="vdTabSlick03_wrap p_r">
                    <div class="swiper vdTabSlick03 vdTabSlick">
                        <div class="swiper-wrapper">
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                            </div>
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                            </div>
                            <div class="rvdo_box swiper-slide">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                                <img class="playShape" src="/images/playBtn.svg" alt="">
                                <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    $(".tabBtn02 > li").on("click", function(event) {

        event.preventDefault();

        let tabNumber = $(this).index();

        $(".tabBtn02 > li").removeClass("on");
        $(this).addClass("on");

        $(".tabCont02 > .tabBox").hide();
        $(".tabCont02 > .tabBox").eq(tabNumber).show();

    });

    $(".tabBtn04 > li").on("click", function(event) {

        event.preventDefault();

        let tabNumber = $(this).index();

        $(".tabBtn04 > li > a").removeClass("on");
        $(this).children("a").addClass("on");


        $(".tabCont04 > .tabBox").hide();
        $(".tabCont04 > .tabBox").eq(tabNumber).show();

    });

    var swiper06 = new Swiper(".vdTabSlick01", {
        slidesPerView: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: ".vdTabSlick01_wrap .swiper-button-next",
            prevEl: ".vdTabSlick01_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 3,
                paceBetween: 50,
                allowTouchMove: true,
            },
            600: {
                slidesPerView: 2,
                paceBetween: 50,
                allowTouchMove: true,
            },
            200: {
                slidesPerView: 1,
                paceBetween: 50,
                allowTouchMove: true,
            },
        },
    });

    var swiper07 = new Swiper(".vdTabSlick02", {
        slidesPerView: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: ".vdTabSlick02_wrap .swiper-button-next",
            prevEl: ".vdTabSlick02_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 3,
                paceBetween: 50,
                allowTouchMove: true,
            },
            600: {
                slidesPerView: 2,
                paceBetween: 50,
                allowTouchMove: true,
            },
            200: {
                slidesPerView: 1,
                paceBetween: 50,
                allowTouchMove: true,
            },
        },
    });

    var swiper08 = new Swiper(".vdTabSlick03", {
        slidesPerView: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: ".vdTabSlick03_wrap .swiper-button-next",
            prevEl: ".vdTabSlick03_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 3,
                paceBetween: 50,
                allowTouchMove: true,
            },
            600: {
                slidesPerView: 2,
                paceBetween: 50,
                allowTouchMove: true,
            },
            200: {
                slidesPerView: 1,
                paceBetween: 50,
                allowTouchMove: true,
            },
        },
    });
</script>

<!--  -->
<section class="cont4">
    <p class="blueBigTit">EDU FIM</p>
    <img class="symbol" src="/images/symbol.svg" alt="">
    <!--absolute-->

    <div class="c_center p_r">
        <div class="c_titWrap dp_sb c_blue dp_end">
            <div class="titcont">
                <p class="bold2">EDUFIM Instructor</p>
                <h3>에듀핌의 전문가팀을 소개합니다.</h3>
            </div>
            <!-- <a class="c_tit_btn c_blue" href="" title="">자세히 보기+</a> -->
        </div>
        <ul class="eduPerSlickBtn dp_f">
            <li class="eduPerprevBtn"></li>
            <li class="stop"><a href=""></a></li>
            <li class="eduPernextBtn"></li>
        </ul>
        <div class="eduPerSlick">
            <div class="eduPerBox">
                <div class="dp_f eduPerBox_wrap">
                    <div class="perWrap">
                        <img src="/images/instructor1.png" alt="">
                    </div>
                    <div class="perYear">
                        <p class="perNm">김철원 대표이사</p>
                        <ul class="perYearCont">
                            <li class="bold2">약력</li>
                            <li>現 라온필라테스 대표</li>
                            <li>現 (주)에듀핌 대표이사</li>
                            <li>現 대한물리치료사협회 정회원</li>
                            <li>現 대한정형도수물리치료학회 정회원</li>
                            <li>現 대한 고유수용성신경근촉진법 학회 정회원</li>
                            <li>前 현명의원 도수치료센터 센터장</li>
                            <li>前 동서한방병원 재활치료센터</li>
                            <li>前 SRC 삼육 재활 전문 센터</li>
                            <li>前 농촌진흥원 장수마을 프로젝트 연구원</li>
                        </ul>
                        <div class="vdTastyTit bold2">영상 맛보기</div>
                        <div class="vdTastyImg">
                            <img src="/upfile/teacher.png" alt="" style="width:inherit; height:inherit;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="eduPerBox">
                <div class="dp_f eduPerBox_wrap">
                    <div class="perWrap">
                        <img src="/images/instructor2.png" alt="">
                    </div>
                    <div class="perYear">
                        <p class="perNm">박지우 이사</p>
                        <ul class="perYearCont">
                            <li class="bold2">약력</li>
                            <li>現 라온필라테스 원장</li>
                            <li>現 대한자세통합필라테스협회 수석강사</li>
                            <li>現 (주)에듀핌 이사</li>
                            <li>現 움직임과학연구소 책임연구원</li>
                            <li>現 대한물리치료사협회 정회원</li>
                            <li>現 대한정형도수물리치료학회 정회원</li>
                            <li>現 메디컬 인모션 아이디어팩토리 대표강사</li>
                            <li>現 메디컬 필라테스 아이디어팩토리 강사</li>
                            <li>現 현명의원 도수치료센터 센터장</li>
                            <li>現 영동신경외과 근무</li>
                        </ul>
                        <div class="vdTastyTit">영상 맛보기</div>
                        <div class="vdTastyImg">
                            <img src="/upfile/teacher.png" alt="" style="width:inherit; height:inherit;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="eduPerBox">
                <div class="dp_f eduPerBox_wrap">
                    <div class="perWrap">
                        <img src="/images/instructor3.png" alt="">
                    </div>
                    <div class="perYear">
                        <p class="perNm">윤소군 이사</p>
                        <ul class="perYearCont">
                            <li class="bold2">약력</li>
                            <li>現 라온필라테스 대표</li>
                            <li>現 (주)에듀핌 이사</li>
                            <li>現 움직임 과학연구소장</li>
                            <li>現 대한물리치료사협회 정회원</li>
                            <li>現 대한정형도수물리치료학회 정회원</li>
                            <li>現 메디컬 인모션 아이디어 팩토리 대표강사</li>
                            <li>現 메디컬 필라테스 아이디어 팩토리 강사</li>
                            <li>前 현명의원 도수치료센터 부센터장</li>
                            <li>前 동서한방병원 재활치료실 팀장</li>
                        </ul>
                        <div class="vdTastyTit">영상 맛보기</div>
                        <div class="vdTastyImg">
                            <img src="/upfile/teacher.png" alt="" style="width:inherit; height:inherit;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="eduPerBox">
                <div class="dp_f eduPerBox_wrap">
                    <div class="perWrap">
                        <img src="/images/instructor4.png" alt="">
                    </div>
                    <div class="perYear">
                        <p class="perNm">조정로 강사</p>
                        <ul class="perYearCont">
                            <li class="bold2">약력</li>
                            <li>現 에듀핌 수석강사</li>
                            <li>現 라온필라테스 2호점 대표</li>
                            <li>現 삼육대학교 근골격계 석사과정</li>
                            <li>現 대한물리치료사협회 정회원</li>
                            <li>現 대한정형도수물리치료학회 정회원</li>
                            <li>現 Austrilia association of massage therapy 정회원</li>
                            <li>現 대한무에타이협회 정회원</li>
                            <li>現 현명의원 도수치료센터 근무</li>
                            <li>現 메디컬 인모션 아이디어팩토리 대표강사</li>
                            <li>現 유니버셜 발레단 전담 물리치료사 근무</li>
                            <li>現 익산 튼튼병원 슬링치료실 근무</li>
                            <li>現 chi-link-remedical-massage therapist</li>
                            <li>現 바로 척척의원 도수치료센터 근무</li>
                        </ul>
                        <div class="vdTastyTit">영상 맛보기</div>
                        <div class="vdTastyImg">
                            <img src="/upfile/teacher.png" alt="" style="width:inherit; height:inherit;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="eduPerBox">
                <div class="dp_f eduPerBox_wrap">
                    <div class="perWrap">
                        <img src="/images/instructor5.png" alt="">
                    </div>
                    <div class="perYear">
                        <p class="perNm">정환진 강사</p>
                        <ul class="perYearCont">
                            <li class="bold2">약력</li>
                            <li>現 에듀핌 수석강사</li>
                            <li>現 대한물리치료사협회 정회원</li>
                            <li>現 대한정형도수물리치료학회 정회원</li>
                            <li>現 메디컬 인모션 아이디어팩토리 대표강사</li>
                            <li>現 메디컬 필라테스 아이디어 팩토리 강사</li>
                            <li>現 이석 참바른메디컬 센터 팀장</li>
                            <li>現 굿닥터신경외과 실장</li>
                        </ul>
                        <div class="vdTastyTit">영상 맛보기</div>
                        <div class="vdTastyImg">
                            <img src="/upfile/teacher.png" alt="" style="width:inherit; height:inherit;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="eduPerBox">
                <div class="dp_f eduPerBox_wrap">
                    <div class="perWrap">
                        <img src="/images/instructor6.png" alt="">
                    </div>
                    <div class="perYear">
                        <p class="perNm">박두원 강사</p>
                        <ul class="perYearCont">
                            <li class="bold2">약력</li>
                            <li>現 에듀핌 수석강사</li>
                            <li>前 일산힐링스 물리치료사</li>
                            <li>前 나래울 운동치료사</li>
                            <li>前 현대유비스 도수치료사</li>
                            <li>前 늘푸른 노인재활운동치료사</li>
                            <li>前 허리나은 도수치료사</li>
                            <li>前 큰나무 도수치료사</li>
                        </ul>
                        <div class="vdTastyTit">영상 맛보기</div>
                        <div class="vdTastyImg">
                            <img src="/upfile/teacher.png" alt="" style="width:inherit; height:inherit;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('.eduPerSlick').slick({
        fade: false,
        dots: true,
        arrows: true,
        autoplay: false, // 자동 스크롤 사용 여부
        autoplaySpeed: 1000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
        prevArrow: $('.eduPerprevBtn'),
        nextArrow: $('.eduPernextBtn')
    });

    var flag04 = true;
    $('.eduPerSlickBtn .stop').click(function() {

        if (flag04) {
            $('.eduPerSlick').slick('slickPause');
            $(this).addClass("on");

            flag04 = false;
        } else {
            $('.eduPerSlick').slick('slickPlay');
            $(this).removeClass("on");
            flag04 = true;
        }

    });
</script>

<!--  -->
<section class="cont5">
    <div class="c_center dp_sb">
        <div class="ct5_twoBox">
            <div class="c_titWrap dp_sb">
                <div class="titcont">
                    <p>NOTICE</p>
                    <h3 class="dp_sb dp_c">
                        공지사항
                        <a class="c_tit_btn" href="/sub10/sub01.php" title="자세히 보기">자세히 보기&nbsp;&nbsp;+</a>
                    </h3>
                </div>
            </div>
            <div class="gryWrap p_r">
                <ul class="noticeRoll">
                    <?
                    $notices = sqlArray("SELECT * FROM tb_board_list WHERE table_id='table_1675005604' LIMIT 5");
                    foreach ($notices as $notice) {
                    ?>
                        <li><?= $notice['title'] ?></li>
                    <? } ?>
                </ul>
                <div class="noticeBtn dp_f dp_fc">
                    <div class="notipreBtn dp_ib">
                        <span class="lnr lnr-chevron-up"></span>
                    </div>
                    <div class="notinextBtn dp_ib">
                        <span class="lnr lnr-chevron-down"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="ct5_twoBox">
            <div class="c_titWrap dp_sb">
                <div class="titcont">
                    <p>CONTACT US</p>
                    <h3 class="dp_sb dp_c">
                        고객센터
                        <!-- <a class="c_tit_btn" href="" title="">자세히 보기&nbsp;&nbsp;+</a> -->
                    </h3>
                </div>
            </div>
            <div class="gryWrap">
                <ul class="phoneEmail dp_f">
                    <li class="dp_f dp_c">
                        <img src="/images/s_phone.png" alt="">
                        <span>전화 문의 : 010-3968-9609</span>
                    </li>
                    <li class="dp_f dp_c">
                        <img src="/images/s_email.png" alt="">
                        <span>이메일 문의 : film2021@naver.com</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--  -->
<div class="videoPopUp">
    <div class="videoPopUpBox">
        <div class="videoClose dp_f dp_c dp_cc bora">
            <img src="/images/x_btn.png" alt="">
        </div>
        <div class="viPlayWrap" style="background-image: url('/images/sub/campus_sum.png'); background-repeat: no-repeat; background-position: center center; background-size: cover;">
            <a class="playShape playBtn" href=""><img class="playShape" src="/images/playBtn.svg" alt=""></a>
        </div>
    </div>
</div>

<script>
    $('.noticeRoll').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        vertical: true,
        autoplay: true,
        autoplaySpeed: 1000,
        prevArrow: $('.notipreBtn'),
        nextArrow: $('.notinextBtn')
    });


    $(".playShape").click(function(event) {

        event.preventDefault();

        $(".videoPopUp").stop().fadeIn();
        $("html, body").addClass("scrollLock");
    });

    $(".videoPopUp .videoClose").click(function(event) {

        event.preventDefault();

        $(".videoPopUp").stop().fadeOut();
        $("html, body").removeClass("scrollLock");
    });
</script>

<?
include './footer.php';
?>