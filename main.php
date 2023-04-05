<?
include './header.php';

$main_query = "SELECT *, (SELECT COUNT(1) FROM ks_wish WHERE ks_wish.userid='$GBL_USERID' AND ks_class.uid=ks_wish.class_uid) AS is_wish FROM ks_class WHERE status=1";
$limit = 10;
?>

<!--  -->
<section>
    <div class="visual">
        <div class="visualSlick pcvisual">
            <?
            $query = "SELECT * FROM config_main WHERE type='BANNER' AND (upfile!='' AND upfile IS NOT NULL) ORDER BY sort";
            $result = mysql_query($query) or die('Banner Config Error : ' . mysql_error());
            while ($row = mysql_fetch_assoc($result)) {
                $sort = sprintf("%02d", $row['sort']);
            ?>
                <div class="v_slickBox v_slick<?= $sort ?>">
                    <a href="<?= $row['url'] ?>" title="mainslide<?= $sort ?>" target="<?= $row['target'] ?>" style="background-image:url('/upfile/main/<?= $row['upfile'] ?>')"><img src="/upfile/main/<?= $row['upfile'] ?>" alt=""></a>
                </div>
            <? } ?>
        </div>
        <!-- 모바일 메인 배너 -->
        <div class="visualSlick mvisual">
            <?
            $query = "SELECT * FROM config_main WHERE type='BANNER' AND (upfile!='' AND upfile IS NOT NULL) ORDER BY sort";
            $result = mysql_query($query) or die('Banner Config Error : ' . mysql_error());
            while ($row = mysql_fetch_assoc($result)) {
                $sort = sprintf("%02d", $row['sort']);
            ?>
                <div class="v_slickBox v_slick<?= $sort ?>">
                    <a href="<?= $row['url'] ?>" title="mainslide<?= $sort ?>" target="<?= $row['target'] ?>"><img src="/upfile/main/<?= $row['upfile_m'] ?>" alt=""></a>
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
</section>

<script>
    AOS.init(); //aos 플러그인 동작 실행

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
            <p class="cont1_tit c_orange bold2" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">지금 인기 있는 신규 클래스</p>
            <p class="cont1_sub_tit c_w bold" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="500">
                선생님들의 실력이 계속 업그레이드 될 수 있게<br>
                지금 에듀핌에서 수강생들에게 가장 필요한 강의들을 끊임없이 업데이트 하고 있습니다.
            </p>
            <div class="video_tit_wrap dp_sb dp_c">
                <div class="videoTit dp_f dp_c">
                    <span class="orange span_ti dp_f dp_c dp_cc">NEW</span>
                    <h3>인기있는 신규 클래스</h3>
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
    </div>
</section>
<section class="cont1_2">
    <div class="c_center txt-c">
        <p class="cont1_2_tit01" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
            교육 <span class="bold2">수료</span>만 해서는 더 이상<br>
            <span class="bold2">경쟁력 있는 커리어</span>를 가질 수 없습니다.
        </p>
        <p class="cont1_2_tit02" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="500">
            에듀핌은 6개 자격증 보유 기관으로 내가 꼭 필요한 강의들로 구성할 수 있게<br>
            <span class="bold2">선택적</span>인 강좌 구성과 실력이 향상 될 수 있게 <span class="bold2">체계적</span>인 자격증 과정을 제공합니다.
        </p>
        <p class="cont1_2_tit03 bold2" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="1000">
            에듀핌은 여러분의 <span class="c_w">진짜 실력과 경쟁력 있는</span>커리어 성장을<br>
            동시에 서포트합니다.
        </p>
        <div class="tab_slide_tit">
            <p class="c_bora bold2">전문가를 더 전문가 답게</p>
            <h3>자격증 과정</h3>
        </div>
        <div class="curri_slide_tab_btn_wrap">
            <ul class="curri_slide_tab_btn dp_f dp_c">
                <li class="on"><a class="bold" href="" title="물리치료사">물리치료사</a></li>
                <li><a class="bold" href="" title="필라테스 강사">필라테스 강사</a></li>
                <li><a class="bold" href="" title="트레이너">트레이너</a></li>
                <li><a class="bold" href="" title="골프 티칭 프로">골프 티칭 프로</a></li>
            </ul>
        </div>
        <div class="curri_slide_tab_wrap">
            <div id="curricont01" class="curri_slide_tab">
                <div class="curriswiper01_wrap p_r">
                    <div class="swiper curriswiper01 curriswiper">
                        <div class="swiper-wrapper">
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step01.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">체형분석 평가사 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            정확한 평가와 진단.
                                            <br>확실한 전 후 비교 근거 제시
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step02.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">PHYSICAL THERAPIST INSTRUCTOR 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            도수치료 전문가 과정.<br>
                                            OP, 교정, 관절 가동, 메뉴얼 등
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step03.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">근골격계 시퀀스 처방사 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            신체 각 분절의 미세 분석.<br>
                                            검사, 운동 시퀀스, 도수 메뉴얼, 테이핑 전부 수록
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step04.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">골프 피지오 & 필라테스 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            골프 해부학적 동작 분석 및 구간별 시퀀스 제공.<br>
                                            체형별 스윙 패턴 분석 및 상황별 시퀀스 제공.
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step05.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">골프 정형 메뉴얼 전문가 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            골프 동작 분석 기반.<br>
                                            국내 유일 골프 전문 도수 치료
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div id="curricont02" class="curri_slide_tab">
                <div class="curriswiper02_wrap p_r">
                    <div class="swiper curriswiper02 curriswiper">
                        <div class="swiper-wrapper">
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step01.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">체형분석 평가사 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            정확한 평가와 진단.
                                            <br>확실한 전 후 비교 근거 제시
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step03.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">근골격계 시퀀스 처방사 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            신체 각 분절의 미세 분석.<br>
                                            검사, 운동 시퀀스, 도수 메뉴얼, 테이핑 전부 수록
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step06.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">필라테스 시퀀스 처방사 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            생각 알고리즘을 통한 시퀀스 설계.<br>
                                            각 부위별 상세 티칭 스킬 방법을 제시!
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step04.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">골프 피지오 & 필라테스 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            골프 해부학적 동작 분석 및 구간별 시퀀스 제공.<br>
                                            체형별 스윙 패턴 분석 및 상황별 시퀀스 제공.
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step07.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">체형 분석 운동 지도자 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            근거에 입각한 정확한 운동법 제공.<br>
                                            정확한 동작으로 전문 운동 지도자 양성.
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step08.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">E.P.S 필라테스 지도자 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            FLOW 시퀀스와 차별화 된 변형동작.<br>
                                            국제 지부 연계로 해외 취업까지 One Pass!
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div id="curricont03" class="curri_slide_tab">
                <div class="curriswiper03_wrap p_r">
                    <div class="swiper curriswiper03 curriswiper">
                        <div class="swiper-wrapper">
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step01.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">체형분석 평가사 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            정확한 평가와 진단.
                                            <br>확실한 전 후 비교 근거 제시
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step03.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">근골격계 시퀀스 처방사 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            신체 각 분절의 미세 분석.<br>
                                            검사, 운동 시퀀스, 도수 메뉴얼, 테이핑 전부 수록
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step04.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">골프 피지오 & 필라테스 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            골프 해부학적 동작 분석 및 구간별 시퀀스 제공.<br>
                                            체형별 스윙 패턴 분석 및 상황별 시퀀스 제공.
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step07.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">체형 분석 운동 지도자 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            근거에 입각한 정확한 운동법 제공.<br>
                                            정확한 동작으로 전문 운동 지도자 양성.
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div id="curricont04" class="curri_slide_tab">
                <div class="curriswiper04_wrap p_r">
                    <div class="swiper curriswiper04 curriswiper">
                        <div class="swiper-wrapper">
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step04.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">골프 피지오 & 필라테스 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            골프 해부학적 동작 분석 및 구간별 시퀀스 제공.<br>
                                            체형별 스윙 패턴 분석 및 상황별 시퀀스 제공.
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
                            </div>
                            <div class="curri_kink_box swiper-slide">
                                <div class="curri_kind_top">
                                    <img src="../images/new_add/bnr_step05.png" alt="">
                                </div>
                                <div class="curri_kind_bot">
                                    <p class="curri_kind_bot_tit bold">골프 정형 메뉴얼 전문가 자격증</p>
                                    <div class="kind_detailgo dp_sb dp_c">
                                        <p class="curri_kind_bot_det c_gry08">
                                            골프 동작 분석 기반.<br>
                                            국내 유일 골프 전문 도수 치료
                                        </p>
                                        <a class="currigoBtn c_gry08" href="" title="바로가기">바로가기</a>
                                    </div>
                                </div>
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
    $(".curri_slide_tab_btn > li").on("click", function(event) {

        event.preventDefault();

        let tabNumber = $(this).index();

        $(".curri_slide_tab_btn > li").removeClass("on");
        $(this).addClass("on");


        $(".curri_slide_tab_wrap > .curri_slide_tab").hide();
        $(".curri_slide_tab_wrap > .curri_slide_tab").eq(tabNumber).show();

    });

    var swiper16 = new Swiper(".curriswiper01", {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: ".curriswiper01_wrap .swiper-button-next",
            prevEl: ".curriswiper01_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 2,
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

    var swiper17 = new Swiper(".curriswiper02", {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: ".curriswiper02_wrap .swiper-button-next",
            prevEl: ".curriswiper02_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 2,
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

    var swiper18 = new Swiper(".curriswiper03", {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: ".curriswiper03_wrap .swiper-button-next",
            prevEl: ".curriswiper03_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 2,
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

    var swiper19 = new Swiper(".curriswiper04", {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: ".curriswiper04_wrap .swiper-button-next",
            prevEl: ".curriswiper04_wrap .swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 2,
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
<section class="cont1_3 blue_gradient">
    <div class="c_center txt-c">
        <p class="cont1_3_tit01 c_pink bold2" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">국제 표준 인증</p>
        <p class="cont1_3_tit02 c_w" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
            넘쳐나는 교육들! 어떤 기준으로 교육을 선택하실 건가요?<br>
            정답은 그냥 교육이 아닌, 어디에서나 인정 받을 수 있는 교육이 필요합니다.
        </p>
        <p class="cont1_3_tit03 pink c_w" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="600">에듀핌은 국제표준인증을 받은 퀄리티 높은 교육입니다.</p>

        <p class="cont1_3_tit04 c_w butler" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="900">EDUPIM CAMPUS</p>
        <p class="cont1_3_tit05 c_w" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="1200">100% 활용하기</p>

        <img src="/images/new_add/main_edufimCampus.png" alt="" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="1500">

        <div class="cont1_3_imgDetail txt-c" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
            <p class="c_w bold">
                에듀핌 캠퍼스의 모든 커리큘럼은<br>
                국제표준기구에서 커리큘럼(소프트웨어)와 오프라인(하드웨어) 과정 부문에서<br>
                까다로운 심사를 거쳐 승인을 받은 국제 정식 교육기관입니다.
            </p>
        </div>

        <p class="hotWrap_tit c_w bold" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
            지금 에듀핌에서<br>
            선생님들이 가장 많이 선택한 강의는?
        </p>

        <div class="hotWrap">
            <div class="video_tit_wrap dp_sb dp_c">
                <div class="videoTit dp_f dp_c">
                    <span class="pink c_w span_ti dp_f dp_c dp_cc">HOT</span>
                    <h3 class="c_w">실시간 인기 클래스</h3>
                </div>
                <a class="c_tit_btn dp_b bold c_w" href="/sub01/" title="전체 클래스 보기">전체 클래스 보기&nbsp;&nbsp;+</a>
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
                                            <p class="nVdtit01 bold2 dotdot c_w"><?= $row['title'] ?></p>
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
        loop: true,
        loopedSlides: 1,
        slidesPerGroup: 1,
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
        loop: true,
        loopedSlides: 1,
        slidesPerGroup: 1,
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

<section class="cont1_4">
    <div class="c_center txt-c">
        <p class="cont1_4_tit01" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
            내 실력에 맞게 차근차근 공부하고 싶은데...<br>
            어디서 부터 어떻게 시작할지 막막하다면?
        </p>
        <p class="cont1_4_tit02 bold2" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">에듀핌 AI 맞춤 강좌추천으로 시작하세요!</p>
        <p class="cont1_4_tit03" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="600">현상태에서 객관적으로 나에게 맞는 강의를 추천해</p>
        <p class="cont1_4_tit03 back c_w" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="900">실력 향상의 가장 빠른 길을 제시해드립니다.</p>
        <div class="videoTit dp_f dp_c">
            <span class="blue c_w span_ti dp_f dp_c dp_cc">AI</span>
            <h3>나에게 딱 맞는 강좌 추천</h3>
        </div>
        <div class="ai_tab_btn_wrap">
            <ul class="ai_tab_btn dp_f dp_c">
                <?
                $ai_arr = sqlArray('SELECT * FROM ai_recommended WHERE depth=0');
                foreach ($ai_arr as $ai) {
                ?>
                    <li class="dp_f dp_cc"><a class="bold" href="javascript:void(0)" title="<?= $ai['value'] ?>"><?= $ai['value'] ?></a></li>
                <?
                }
                ?>
                <!-- <li class="dp_f dp_cc"><a class="bold" href="javascript:void(0)" title="필라테스 강사">필라테스 강사</a></li>
                <li class="dp_f dp_cc"><a class="bold" href="javascript:void(0)" title="트레이너">트레이너</a></li>
                <li class="dp_f dp_cc"><a class="bold" href="javascript:void(0)" title="일반인">일반인</a></li> -->
            </ul>
        </div>
        <div class="ai_tab_box_wrap">
            <?
            /*
            $ai_arr = sqlArray('SELECT * FROM ai_recommended WHERE depth=1');
            foreach ($ai_arr as $ai) {
            ?>
            
            <?
            }*/
            ?>
                <div class="ai_tab_box">
                    <div class="dp_sb dp_wrap">
                        <div class="ai_tab_box_child dp_sb dp_c">
                            <div class="ai_tab_txt_box">
                                <p class="c_blue04 ai_tit_top">물리치료사</p>
                                <p class="ai_tit_bot bold">환자 평가가 어렵다</p>
                                <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                            </div>
                            <div class="ai_tab_img">
                                <img src="../images/new_add/bnr_ai01.png" alt="">
                            </div>
                        </div>
                        <div class="ai_tab_box_child dp_sb dp_c">
                            <div class="ai_tab_txt_box">
                                <p class="c_blue04 ai_tit_top">물리치료사</p>
                                <p class="ai_tit_bot bold">도수치료 스킬 업</p>
                                <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                            </div>
                            <div class="ai_tab_img">
                                <img src="../images/new_add/bnr_ai02.png" alt="">
                            </div>
                        </div>
                        <div class="ai_tab_box_child dp_sb dp_c">
                            <div class="ai_tab_txt_box">
                                <p class="c_blue04 ai_tit_top">물리치료사</p>
                                <p class="ai_tit_bot bold">근골격계 재활 운동 치료</p>
                                <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                            </div>
                            <div class="ai_tab_img">
                                <img src="../images/new_add/bnr_ai03.png" alt="">
                            </div>
                        </div>
                        <div class="ai_tab_box_child dp_sb dp_c">
                            <div class="ai_tab_txt_box">
                                <p class="c_blue04 ai_tit_top">물리치료사</p>
                                <p class="ai_tit_bot bold">스페셜 치료</p>
                                <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                            </div>
                            <div class="ai_tab_img">
                                <img src="../images/new_add/bnr_ai04.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="ai_tab_box">
                <div class="dp_sb dp_wrap">
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">필라테스 강사</p>
                            <p class="ai_tit_bot bold">기초 해부 뽀개기</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai05.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">필라테스 강사</p>
                            <p class="ai_tit_bot bold">체형 교정 전문 강사 되기</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai06.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">필라테스 강사</p>
                            <p class="ai_tit_bot bold">시퀀스를 다양하게</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai07.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">필라테스 강사</p>
                            <p class="ai_tit_bot bold">스페셜 케이스</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai08.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="ai_tab_box">
                <div class="dp_sb dp_wrap">
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">트레이너</p>
                            <p class="ai_tit_bot bold">기초 해부 뽀개기</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai09.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">트레이너</p>
                            <p class="ai_tit_bot bold">PT 전문가 되기</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai10.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">트레이너</p>
                            <p class="ai_tit_bot bold">교정 재활 트레이닝</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai11.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">트레이너</p>
                            <p class="ai_tit_bot bold">스페셜 트레이닝</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai12.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="ai_tab_box">
                <div class="dp_sb dp_wrap">
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">일반인</p>
                            <p class="ai_tit_bot bold">국제 인증 필라테스 강사 되기</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai13.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">일반인</p>
                            <p class="ai_tit_bot bold">돌려 깎기 시리즈 (다이어트)</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai14.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">일반인</p>
                            <p class="ai_tit_bot bold">예쁜 자세 (자세교정)</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai15.png" alt="">
                        </div>
                    </div>
                    <div class="ai_tab_box_child dp_sb dp_c">
                        <div class="ai_tab_txt_box">
                            <p class="c_blue04 ai_tit_top">일반인</p>
                            <p class="ai_tit_bot bold">통증 뽀개기</p>
                            <a class="ai_goBtn dp_f dp_c dp_cc" href="javascript:void(0)" title="바로가기">바로가기</a>
                        </div>
                        <div class="ai_tab_img">
                            <img src="../images/new_add/bnr_ai16.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<script>
    $(".ai_tab_btn > li").on("click", function(event) {

        event.preventDefault();

        let tabNumber = $(this).index();

        $(".ai_tab_btn > li").removeClass("on");
        $(this).addClass("on");

        $(".ai_tab_box_wrap .ai_tab_box").hide();
        $(".ai_tab_box_wrap .ai_tab_box").eq(tabNumber).stop().fadeIn(500);

    });

    var posY;
    $(".ai_goBtn").click(function(event) {
        event.preventDefault();

		let browerWid = $(window).innerWidth();

        posY = $(window).scrollTop();
		if (browerWid < 500) {
			 $('#classShowFrame').html("<iframe src='./classDetail.php' name='' style='width:100%;height:460px;' frameborder='0' scrolling='auto'></iframe>");
		} else {
			$('#classShowFrame').html("<iframe src='./classDetail.php' name='' style='width:100%;height:766px;' frameborder='0' scrolling='auto'></iframe>");
		}
        $('.classShow_open').click();
        $("html, body").addClass("not_scroll");
        $("section").css("top", -posY);

    });
</script>

<!--  -->
<section class="cont2 blue_gradient c_w">
    <div class="c_center">
        <p class="cont2_tit01 c_w bold2 txt-c" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">에듀핌에서 성장한 선생님들의 생생한 후기!</p>
        <p class="cont2_tit02 c_w txt-c" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
            에듀핌을 방문하신 모든 선생님들도 원하는 목적까지 달성할 수 있도록<br>
            에듀핌이 발맞춰 도와드리겠습니다.
        </p>
        <!--강의 후기-->
        <div class="c_titWrap dp_sb dp_end">
            <div class="titcont">
                <p class="c_grn">에듀핌 수강생 후기</p>
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
                            <!-- <a href="javascript:void(0)" title=""> -->
                            <img src="/upfile/thumb.png" alt="" style="width:inherit; height:inherit;">
                            <img class="playShape" src="/images/playBtn.svg" alt="">
                            <!-- </a> -->
                        </div>
                    <? } ?>
                    <!-- <div class="rvdo_box swiper-slide">
						<a href="javascript:void(0)" title="">
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

    </div>
</section>

<!--  -->
<section class="cont2_1 blk02 c_w">
    <div class="c_center">
        <p class="cont2_1_mtit c_w">당신의 커리어를 높이는 길잡이</p>
        <div class="matrix_wrap">
            <div class="matrix_box matrix01 dp_f dp_fc dp_c dp_cc" data-aos="fade-down" data-aos-easing="ease" data-aos-duration="1000">
                <img src="./images/new_add/hexagon_icon01.png" alt="">
                <p class="matrix_tit bold">체형분석평가사</p>
                <a class="matrix_btn dp_f dp_c dp_cc" href="" title="바로가기">바로가기</a>
            </div>
            <div class="matrix_box matrix02 dp_f dp_fc dp_c dp_cc" data-aos="fade-down" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="200">
                <img src="./images/new_add/hexagon_icon02.png" alt="">
                <p class="matrix_tit bold">피지컬동작처방사</p>
                <a class="matrix_btn dp_f dp_c dp_cc" href="" title="바로가기">바로가기</a>
            </div>
            <div class="matrix_box matrix03 dp_f dp_fc dp_c dp_cc" data-aos="fade-left" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
                <img src="./images/new_add/hexagon_icon06.png" alt="">
                <p class="matrix_tit bold">필라테스 지도자</p>
                <a class="matrix_btn dp_f dp_c dp_cc" href="" title="바로가기">바로가기</a>
            </div>
            <div class="matrix_box matrix04 dp_f dp_fc dp_c dp_cc" data-aos="fade-right" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
                <img src="./images/new_add/hexagon_icon03.png" alt="">
                <p class="matrix_tit bold">근골격계시퀀스처방사</p>
                <a class="matrix_btn dp_f dp_c dp_cc" href="" title="바로가기">바로가기</a>
            </div>
            <div class="matrix_box matrix05 dp_f dp_fc dp_c dp_cc" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="600">
                <img src="./images/new_add/hexagon_icon05.png" alt="">
                <p class="matrix_tit bold">골프피지오 & 필라테스</p>
                <a class="matrix_btn dp_f dp_c dp_cc" href="" title="바로가기">바로가기</a>
            </div>
            <div class="matrix_box matrix06 dp_f dp_fc dp_c dp_cc" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="800">
                <img src="./images/new_add/hexagon_icon04.png" alt="">
                <p class="matrix_tit bold">필라테스시퀀스처방사</p>
                <a class="matrix_btn dp_f dp_c dp_cc" href="" title="바로가기">바로가기</a>
            </div>

            <p class="matrix_center butler c_gry07 txt-c">
                Certification<br>
                Challenge
            </p>
        </div>
    </div>
</section>

<!--  -->
<section class="cont3 blue_gradient">
    <div class="c_center">

        <p class="cont3_tit01 c_w txt-c bold2" data-aos="fade-up" data-aos-easing="ease">이제 에듀핌을 시작하려고 한다면?</p>
        <div class="cont3_num dp_f dp_c dp_cc c_w txt-c bora bold" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">01</div>
        <p class="cont3_tit02 c_w txt-c bold" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="600">놓치면 후회하는 에듀핌을 120% 활용하는 방법!</p>
        <div class="ballon_wrap" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="900">
            <div class="ballon c_w dp_f dp_c dp_cc">Check Point</div>
        </div>
        <p class="cont3_tit03 c_w txt-c bold2" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="1200">글로벌 커리어를 위한 첫 걸음</p>

        <div class="global_career_wrap dp_sb dp_c dp_wrap">
            <div class="global_career_box dp_f dp_c" data-aos="fade-right" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
                <img src="./images/new_add/career_icon01.png" alt="">
                <div class="global_career_txt">
                    <p class="global_career_tit c_w bold">맞춤진단</p>
                    <p class="global_career_det c_w">
                        AI 맞춤 커리큘럼 진단으로<br>
                        꼭 필요한 강좌를 마음대로 선택
                    </p>
                </div>
            </div>
            <div class="global_career_box dp_f dp_c" data-aos="fade-left" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
                <img src="./images/new_add/career_icon02.png" alt="">
                <div class="global_career_txt">
                    <p class="global_career_tit c_w bold">0강 미리수강</p>
                    <p class="global_career_det c_w">
                        원하는 강좌를 구매하기 전에 <br>
                        미리 수강
                    </p>
                </div>
            </div>
            <div class="global_career_box dp_f dp_c" data-aos="fade-right" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
                <img src="./images/new_add/career_icon03.png" alt="">
                <div class="global_career_txt">
                    <p class="global_career_tit c_w bold">자격증 과정 선택</p>
                    <p class="global_career_det c_w">
                        글로벌 커리어 전문가를 위한<br>
                        자격증 과정 선택
                    </p>
                </div>
            </div>
            <div class="global_career_box dp_f dp_c" data-aos="fade-left" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
                <img src="./images/new_add/career_icon04.png" alt="">
                <div class="global_career_txt">
                    <p class="global_career_tit c_w bold">단일 강좌 선택</p>
                    <p class="global_career_det c_w">
                        필요한 부분을 채워주는 단일 강좌 <br>
                        집중 수강
                    </p>
                </div>
            </div>
            <div class="global_career_box dp_f dp_c" data-aos="fade-right" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
                <img src="./images/new_add/career_icon05.png" alt="">
                <div class="global_career_txt">
                    <p class="global_career_tit c_w bold">80% 수강 완료</p>
                    <p class="global_career_det c_w">
                        필수 수강 요건 <br>
                        필수 이수
                    </p>
                </div>
            </div>
            <div class="global_career_box dp_f dp_c" data-aos="fade-left" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
                <img src="./images/new_add/career_icon06.png" alt="">
                <div class="global_career_txt">
                    <p class="global_career_tit c_w bold">시험</p>
                    <p class="global_career_det c_w">
                        필수 수강 요건 충족 후 <br>
                        자격증 또는 수료증 시험
                    </p>
                </div>
            </div>
        </div>

        <div class="cont3_num dp_f dp_c dp_cc c_w txt-c bora bold" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">02</div>
        <p class="cont3_tit02 c_w txt-c bold" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
            수강생들을 위한 Special Event로<br>
            풍성한 혜택을 누려보세요!
        </p>
        <div class="ballon_wrap" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">
            <div class="ballon c_w dp_f dp_c dp_cc">이달의 혜택</div>
        </div>


        <div class="bannerSlick_wrap p_r">
            <div class="swiper bannerSlick">
                <div class="swiper-wrapper">
                    <?
                    $query = "SELECT * FROM config_main WHERE type='EVENT' AND (upfile!='' AND upfile IS NOT NULL) ORDER BY sort";
                    $result = mysql_query($query) or die('Banner Config Error : ' . mysql_error());
                    while ($row = mysql_fetch_assoc($result)) {
                        $sort = sprintf("%02d", $row['sort']);
                    ?>
                        <div class="v_slickBox v_slick<?= $sort ?> swiper-slide">
                            <a href="<?= $row['url'] ?>" title="mainslide<?= $sort ?>" target="<?= $row['target'] ?>"><img src="/upfile/main/<?= $row['upfile'] ?>" alt="<?= $row['realfile'] ?>"></a>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <script>
            var swiper18 = new Swiper(".bannerSlick", {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".bannerSlick_wrap .swiper-button-next",
                    prevEl: ".bannerSlick_wrap .swiper-button-prev",
                },
            });
        </script>
        <!--한컷 강의-->
        <div class="c_titWrap">
            <h3 class="c_w">한컷 강의</h3>
        </div>
        <div class="tabBtn04_wrap">
            <ul class="tabBtn04 vdTabBtn dp_f">
                <li><a class="on dp_f dp_c dp_cc c_w bold" href="#vdcontSlick01" title=""># 앞서가는 운동지도자를 꿈꿔요</a></li>
                <li><a class="dp_f dp_c dp_cc c_w bold" href="#vdcontSlick02" title=""># 기초가 탄탄한 운동지도자를 꿈꿔요</a></li>
                <li><a class="dp_f dp_c dp_cc c_w bold" href="#vdcontSlick03" title=""># 필라테스 지도자를 꿈꿔요</a></li>
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

</section>


<section class="cont3_2">
    <div class="c_center txt-c">
        <p class="cont3_2_tit01 butler" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">Certification</p>
        <p class="cont3_2_tit02 bold2" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">80% 이상 수강 및 시험 응시 후 수료증을 발급 받아보세요!</p>
        <img src="../images/new_add/main_certification.png" alt="" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="600">
    </div>
</section>

<section class="cont3_3">
    <div class="c_center">
        <p class="cont3_plus_tit txt-c light" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="300">선생님들의 <span class="bold2">진짜 실력향상</span>을 최선을 다해 도와줄 전문 강사진입니다.</p>
        <p class="cont3_plus_det txt-c light" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000" data-aos-delay="600">
            <span class="bold2">현실성</span>없는 이론만 나열하는 것이 아닌<br>
            지금도 임상에서 활동중인 전문 강사진이 여러분이 <span class="bold2">진짜 필요로</span> 하는 부분을<br>
            정확히 캐치해서 채워드리겠습니다.
        </p>
    </div>
</section>


<!--  -->
<section class="cont4">
    <img class="symbol" src="/images/symbol.svg" alt="">
    <!--absolute-->

    <div class="c_center p_r">
        <div class="c_titWrap dp_sb dp_end">
            <div class="titcont">
                <p class="bold2 c_blue04">EDUPIM Instructor</p>
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
            <?
            $teacher_arr = sqlArray("SELECT * FROM ks_member WHERE mtype='T' AND status=1 AND userid!='teacher@naver.com'");
            foreach ($teacher_arr as $key => $teacher) {
            ?>
                <div class="eduPerBox">
                    <div class="dp_f eduPerBox_wrap">
                        <div class="perWrap">
                            <img src="/upfile/member/<?= $teacher['upfile01'] ?>" alt="<?= $teacher['realfile01'] ?>">
                        </div>
                        <div class="perYear">
                            <p class="perNm"><?= $teacher['name'] . ' ' . $teacher['job'] ?></p>
                            <ul class="perYearCont">
                                <li class="bold2">약력</li>
                                <?= $teacher['ment01'] ?>
                                <!-- <li>現 라온필라테스 대표</li>
                            <li>現 (주)에듀핌 대표이사</li>
                            <li>現 대한물리치료사협회 정회원</li>
                            <li>現 대한정형도수물리치료학회 정회원</li>
                            <li>現 대한 고유수용성신경근촉진법 학회 정회원</li>
                            <li>前 현명의원 도수치료센터 센터장</li>
                            <li>前 동서한방병원 재활치료센터</li>
                            <li>前 SRC 삼육 재활 전문 센터</li>
                            <li>前 농촌진흥원 장수마을 프로젝트 연구원</li> -->
                            </ul>
                            <div class="vdTastyTit bold2">영상 맛보기</div>
                            <div class="vdTastyImg">
                                <?
                                $teacher_class = sqlRow("SELECT upfile01, realfile01 FROM ks_class WHERE uid='" . $teacher['class_uid'] . "'");
                                if ($teacher_class) {
                                ?>
                                    <a href="/sub01/view.php?code=<?= $teacher['class_uid'] ?>" style="width:inherit; height:inherit;">
                                        <img src="/upfile/class/<?= $teacher_class[0] ?>" alt="<?= $teacher_class[1] ?>" style="width:inherit; height:inherit;">
                                    </a>
                                <?
                                } else {
                                ?>
                                    <img src="/upfile/teacher.png" alt="preivew" style="width:inherit; height:inherit;">
                                <?
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?
            }
            ?>
            <!-- <div class="eduPerBox">
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
            </div> -->
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

<section class="cont4_2 blue_gradient">
    <div class="c_center">
        <p class="txt-c c_w" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
            수강생 입장을 최우선으로<br>
            최상 퀄리티의 강의와 자격증 과정으로<br>
            <span class="bold2">선생님들이 글로벌 커리어를 가질 수 있게 최선을 다해 돕겠습니다.</span>
        </p>
    </div>
</section>

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