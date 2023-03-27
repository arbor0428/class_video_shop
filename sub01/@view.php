<?
include '../header.php';

$class_uid = $code;
if (isEmpty($class_uid)) $MSG->goNext_New("/sub01");
if (!isNumId($class_uid)) $MSG->goNext_New("/sub01");

$query = "SELECT * from ks_class where uid=$class_uid";
// $class_result = mysql_query($query) or $die(mysql_error());
$class_result = mysql_query($query) or $MSG->goNext_New("/sub01");
$num_rows = mysql_num_rows($class_result);

if ($num_rows > 0) $class = mysql_fetch_assoc($class_result);
else $MSG->goNext_New("/sub01");

$query = "SELECT c.*, v.media_content_key, v.length FROM ks_class_list_preview c JOIN kollus_video v ON c.kollus_video_id=v.id WHERE c.class_uid='$class_uid' ORDER BY c.sort";
$list_preview_arr = sqlArray($query);

$query = "SELECT *, (SELECT length FROM kollus_video WHERE ks_class_list.kollus_video_id=kollus_video.id) AS length FROM ks_class_list WHERE class_uid='$class_uid' ORDER BY sort";
$list_num_rows = sqlRowCount($query);
$list_arr = sqlArray($query);

$isWish = sqlRowOne("SELECT COUNT(1) FROM ks_wish WHERE userid='$GBL_USERID' AND class_uid='$class_uid'");
$hasClass = sqlRowCount("SELECT uid FROM ks_learning WHERE userid='$GBL_USERID' AND class_uid='$class_uid'") > 0;
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <div class="detail_cont">
            <div class="detail_sum">
                <iframe src="https://v.kr.kollus.com/<?= $list_preview_arr[0]['media_content_key'] ?>?" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>
                <!--비디오-->
            </div>

            <!-- mobile -->
            <div class="mobile_detail_wrap">
                <div class="detail_right">
                    <div class="pin_box">
                        <p class="pin_box_tit bold2"><?= $class['title'] ?></p>
                        <p class="pin_box_det"><?= $class['target'] ?></p>
                        <ul class="dp_f dp_c gry01 class_dayamount_info">
                            <li class="f12 dp_f dp_c">총 <?= $list_num_rows ?>강</li>
                            <li class="f12">수강기간 <?= $class['period'] ?>일</li>
                        </ul>
                        <ul class="price_detail_box">
                            <?
                            if (is_null($class['discountPrice'])) {
                            ?>
                                <li class="dp_sb dp_end">
                                    <div class="bold2 f14">상품 판매가</div>
                                    <div class="bold2 txt-r f18"><span><?= number_format($class['price']) ?></span>원</div>
                                </li>
                                <li class="dp_sb dp_end">
                                    <div class="bold2 f14 c_bora01">할부 적용시</div>
                                    <div class="txt-r">
                                        <span class="c_gry04 f14">(<?= intval($class['period'] / 30) ?>개월)</span>
                                        <span class="c_bora01 bold2 f22">월 <?= number_format(round(($class['price'] / ($class['period'] / 30)), -1)) ?>원</span>
                                    </div>
                                </li>
                            <?
                            } else {
                            ?>
                                <li class="dp_sb dp_end">
                                    <div class="bold2 f14">상품 판매가</div>
                                    <div class="bold2 txt-r f18">
                                        <div class="dp_sb dp_c">
                                            <p class="c_gry03 f14 strkt"><?= number_format($class['price']) ?> 원</p>
                                            <span class="bold2 f22" style="margin-left: 5px;"><?= number_format($class['discountPrice']) ?>원</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="dp_sb dp_end">
                                    <div class="bold2 f14 c_bora01">할부 적용시</div>
                                    <div class="txt-r">
                                        <span class="c_gry04 f14">(<?= intval($class['period'] / 30) ?>개월)</span>
                                        <span class="c_bora01 bold2 f22">월 <?= number_format(round(($class['discountPrice'] / ($class['period'] / 30)), -1)) ?>원</span>
                                    </div>
                                </li>
                            <?
                            }
                            ?>
                        </ul>

                        <? if ($hasClass) { ?>
                            <a class="pin_box_btn dp_f dp_c dp_cc bold2 gry03" href="javascript:void(0)" title="장바구니">구매한 상품입니다</a>
                        <? } else { ?>
                            <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="javascript:void(0)" title="장바구니" onclick="cart()">장바구니</a>
                            <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="javascript:void(0)" title="구매하기" onclick="buy()">구매하기</a>
                        <? } ?>

                        <div class="pin_two_btn_wrap dp_sb dp_c">
                            <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="javascript:void(0)" title="찜하기" onclick="wish()">
                                <div class="like_toggle <? if ($isWish) echo 'on'; ?>"></div>
                                <span>찜하기</span>
                            </a>
                            <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="javascript:void(0)" title="링크 복사하기" onclick="copy_link()">
                                <img src="/images/sub/clip_icon_blk.svg" alt="클립">
                                <span>링크 복사하기</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="detail_sec_btn dp_f">
                <li class="on"><a class="moveTo" href="javascript:avoid(0);" data-seq="detail_sec01">커리큘럼</a></li>
                <li><a class="moveTo" href="javascript:avoid(0);" data-seq="detail_sec02">상세정보</a></li>
                <li><a class="moveTo" href="javascript:avoid(0);" data-seq="detail_sec03">유의사항</a></li>
                <li><a class="moveTo" href="javascript:avoid(0);" data-seq="detail_sec04">수강후기</a></li>
            </ul>

            <div class="detail_sec_wrap">
                <!---커리큘럼--->
                <section id="detail_sec01">
                    <div class="detail_cont_subcont curricul_subcont">
                        <div class="curricul_box_wrap">
                            <? foreach ($list_preview_arr as $list_preview) { ?>
                                <div class="curricul_box">
                                    <div class="dp_sb dp_c">
                                        <div class="curricul_box_text">
                                            <p class="bold2">미리보기<?= $list_preview['sort'] ?>. <?= $list_preview['title'] ?></p>
                                            <span class="c_gry04 f14"><?= $list_preview['exp'] ?></span>
                                        </div>
                                        <span class="curricul_box_time f14 bold"><?= gmdate('H:i:s', $list_preview['length']) ?></span>
                                    </div>
                                </div>
                            <? } ?>
                            <? foreach ($list_arr as $list) { ?>
                                <div class="curricul_box">
                                    <div class="dp_sb dp_c">
                                        <div class="curricul_box_text">
                                            <p class="bold2"><?= $list['sort'] ?>강 <?= $list['title'] ?></p>
                                            <span class="c_gry04 f14"><?= $list['exp'] ?></span>
                                        </div>
                                        <span class="curricul_box_time f14 bold"><?= gmdate('H:i:s', $list['length']) ?></span>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                        <div id="js-btn-wrap01" class="morescroll_wrap01">
                            <a class="morescroll dp_f dp_c dp_cc bora01 c_w" href="" title="더보기">더보기 <img src="../images/s_down.svg" alt=""> </a>
                        </div>
                    </div>
                </section>
                <!---커리큘럼--->

                <!---상세정보--->
                <section id="detail_sec02">
                    <div class="detail_cont_sub_tit">
                        <span class="bora01 c_w bold2">상세정보</span>
                    </div>
                    <div class="detail_cont_subcont detail_subcont">
                        <?= $class['ment01'] ?>
                    </div>
                </section>
                <!---상세정보--->

                <!---유의사항--->
                <section id="detail_sec03">
                    <div class="detail_cont_sub_tit">
                        <span class="bora01 c_w bold2">유의사항</span>
                    </div>
                    <div class="detail_cont_subcont caution_subcont">
                        <?= $class['ment02'] ?>
                    </div>
                </section>
                <!---유의사항--->

                <!---수강후기--->
                <section id="detail_sec04">
                    <div class="detail_cont_sub_tit dp_sb dp_c">
                        <span class="bora01 c_w bold2">수강후기</span>
                        <p class="f12">수강 후기 작성 시 강의당 <span class="bold2 f12">최대 3일 연장</span></p>
                    </div>
                    <div class="detail_cont_subcont product_review_subcont">
                        <div class="review_box_wrap">
                            <?
                            $reviewArr = sqlArray("SELECT r.*, m.name nm from ks_review r left join ks_member m on r.userid=m.userid where r.class_uid=$class_uid");
                            foreach ($reviewArr as $review) { ?>
                                <div class="review_box">
                                    <div class="dp_sb dp_c">
                                        <div class="per_info_wrap dp_f dp_c">
                                            <div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"><!--프로필 배경 처리--></div>
                                            <div class="per_info">
                                                <p class="bold"><?= $review['nm'] ?></p>
                                                <span class="c_gry04"><?= $review['rDate'] ?></span>
                                            </div>
                                        </div>
                                        <div class="recom_label bora01 dp_inline dp_c">
                                            <img src="/images/sub/thumb_best.svg" alt="">
                                            <span class="c_w">추천해요</span>
                                        </div>
                                    </div>
                                    <p class="review_detail"><?= $review['content'] ?></p>
                                </div>
                            <? } ?>
                            <!-- <div class="review_box">
								<div class="dp_sb dp_c">
									<div class="per_info_wrap dp_f dp_c">
										<div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"></div>
										<div class="per_info">
											<p class="bold">홍길동</p>
											<span class="c_gry04">2022-12-01</span>
										</div>
									</div>
									<div class="recom_label bora01 dp_inline dp_c">
										<img src="/images/sub/thumb_best.svg" alt="">
										<span class="c_w">추천해요</span>
									</div>
								</div>
								<p class="review_detail">협회 교육에서 배웠던 내용이지만 그 내용을 더 간결하고 이해하기 쉽게, 기억하기 쉽게 설명해주셨습니다. 더 열심히 공부해서 현장에서 회원의 몸을 보고 1초만에 앞으로의 수업의 그림이 그려지는 강사가 될 수 있길 바랍니다!! 자료도 굉장히 좋았고 수업 구성도 좋았어요 내용이 익혀질 때까지 열심히 복습하고 응용하겠습니다.</p>
							</div> -->
                        </div>
                        <div id="js-btn-wrap02" class="morescroll_wrap02">
                            <a class="morescroll dp_f dp_c dp_cc bora01 c_w" href="" title="더보기">더보기 <img src="../images/s_down.svg" alt=""> </a>
                        </div>
                    </div>
                </section>
                <!---수강후기--->
            </div>
        </div>

        <div class="detail_right pc_detail_wrap">
            <div class="pin_box">
                <p class="pin_box_tit bold2"><?= $class['title'] ?></p>
                <p class="pin_box_det"><?= $class['target'] ?></p>
                <ul class="dp_f dp_c gry01 class_dayamount_info">
                    <li class="f12 dp_f dp_c">총 <?= $list_num_rows ?>강</li>
                    <li class="f12">수강기간 <?= $class['period'] ?>일</li>
                </ul>
                <ul class="price_detail_box">
                    <?
                    if (is_null($class['discountPrice'])) {
                    ?>
                        <li class="dp_sb dp_end">
                            <div class="bold2 f14">상품 판매가</div>
                            <div class="bold2 txt-r f18"><span><?= number_format($class['price']) ?></span>원</div>
                        </li>
                        <li class="dp_sb dp_end">
                            <div class="bold2 f14 c_bora01">할부 적용시</div>
                            <div class="txt-r">
                                <span class="c_gry04 f14">(<?= intval($class['period'] / 30) ?>개월)</span>
                                <span class="c_bora01 bold2 f22">월 <?= number_format(round(($class['price'] / ($class['period'] / 30)), -1)) ?>원</span>
                            </div>
                        </li>

                    <?
                    } else {
                    ?>
                        <li class="dp_sb dp_end">
                            <div class="bold2 f14">상품 판매가</div>
                            <div class="bold2 txt-r f18">
                                <div class="dp_sb dp_c">
                                    <p class="c_gry03 f14 strkt"><?= number_format($class['price']) ?> 원</p>
                                    <span class="bold2 f22" style="margin-left: 5px;"><?= number_format($class['discountPrice']) ?>원</span>
                                </div>
                            </div>
                        </li>
                        <li class="dp_sb dp_end">
                            <div class="bold2 f14 c_bora01">할부 적용시</div>
                            <div class="txt-r">
                                <span class="c_gry04 f14">(<?= intval($class['period'] / 30) ?>개월)</span>
                                <span class="c_bora01 bold2 f22">월 <?= number_format(round(($class['discountPrice'] / ($class['period'] / 30)), -1)) ?>원</span>
                            </div>
                        </li>
                    <?
                    }
                    ?>
                </ul>

                <? if ($hasClass) { ?>
                    <a class="pin_box_btn dp_f dp_c dp_cc bold2 gry03" href="javascript:void(0)" title="장바구니">구매한 상품입니다</a>
                <? } else { ?>
                    <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="javascript:void(0)" title="장바구니" onclick="cart()">장바구니</a>
                    <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="javascript:void(0)" title="구매하기" onclick="buy()">구매하기</a>
                <? } ?>

                <div class="pin_two_btn_wrap dp_sb dp_c">
                    <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="javascript:void(0)" title="찜하기" onclick="wish()">
                        <div class="like_toggle <? if ($isWish) echo 'on'; ?>"></div>
                        <span>찜하기</span>
                    </a>
                    <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="javascript:void(0)" title="링크 복사하기" onclick="copy_link()">
                        <img src="/images/sub/clip_icon_blk.svg" alt="클립">
                        <span>링크 복사하기</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const uid = '<?= $code ?>';
    const userid = '<?= $GBL_USERID ?>';

    const cart = function() {
        $.ajax({
            url: "./proc.php",
            data: {
                "method": "CART",
                "uid": uid,
                "userid": userid,
            },
            method: "POST",
            // dataType: "json",
            success: (response) => {
                response = response.trim()

                if (response === 'SUCCESS') {
                    GblMsgConfirmBox("장바구니에 담았습니다.\n장바구니로 이동 하겠습니까?", "location.href='/mypage/cart/'");

                } else if (response === 'NOT_LOGIN') {
                    if (confirm("로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?"))
                        location.href = '/member/login.php'

                } else if (response === 'EXIST') {
                    GblMsgBox("장바구니에 이미 존재합니다", "");

                } else if (response === 'NOT_ACCESS') {
                    alert("잘못된 접근입니다.")

                } else if (response === 'FAILED') {
                    alert("오류 발생! 관리자문의 바랍니다")

                } else if (response === 'METHOD_UNAVAILABLE') {
                    alert("오류 발생! 관리자문의 바랍니다")

                } else {
                    alert("오류 발생! 관리자문의 바랍니다.3")
                    console.log(response)
                }
            },
            error: (xhr, status, errorThrown) => {
                console.log(xhr, errorThrown, status);
            }
        })
    }

    const wish = function() {
        $.ajax({
            url: "./proc.php",
            data: {
                "method": "WISH",
                "uid": uid,
                "userid": userid,
            },
            method: "POST",
            // dataType: "json",
            success: (response) => {
                response = response.trim()

                if (response === 'SUCCESS') {
                    return

                } else if (response === 'NOT_LOGIN') {
                    if (confirm("로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?"))
                        location.href = '/member/login.php'

                } else if (response === 'NOT_ACCESS') {
                    alert("잘못된 접근입니다.")

                } else if (response === 'FAILED') {
                    alert("오류 발생! 관리자문의 바랍니다.")

                } else if (response === 'METHOD_UNAVAILABLE') {
                    alert("오류 발생! 관리자문의 바랍니다.")

                } else {
                    alert("오류 발생! 관리자문의 바랍니다.")
                    console.log(response)
                }
            },
            error: (xhr, status, errorThrown) => {
                console.log(xhr, errorThrown, status);
            }
        })
    }

    const buy = function() {
        $.ajax({
            url: "./proc.php",
            data: {
                "method": "BUY",
                "uid": uid,
                "userid": userid,
            },
            method: "post",
            // dataType: "json",
            success: (response) => {
                response = response.trim()

                if (response === 'SUCCESS') {
                    return

                } else if (response === 'NOT_LOGIN') {
                    if (confirm("로그인이 필요한 서비스 입니다. 로그인 하시겠습니까?"))
                        location.href = '/member/login.php'

                } else if (response === 'NOT_ACCESS') {
                    alert("잘못된 접근입니다.")

                } else if (response === 'FAILED') {
                    alert("오류 발생! 관리자문의 바랍니다.")

                } else if (response === 'METHOD_UNAVAILABLE') {
                    alert("오류 발생! 관리자문의 바랍니다.")

                } else {
                    alert("오류 발생! 관리자문의 바랍니다.")
                    console.log(response)
                }
            },
            error: (xhr, status, errorThrown) => {
                console.log(xhr, errorThrown, status);
                GblMsgBox("구매오류 관리자에게 문의 바랍니다", "location.href='/'");
            }
        })
    }

    $(function() {
        $(".curricul_box").slice(0, 3).show(); // 최초 3개 선택
        $(".morescroll_wrap01 .morescroll").click(function(e) { // Load More를 위한 클릭 이벤트e
            e.preventDefault();
            $(".curricul_box:hidden").slice(0, 5).show(); // 숨김 설정된 다음 5개를 선택하여 표시
            if ($(".curricul_box:hidden").length == 0) { // 숨겨진 DIV가 있는지 체크
                $('.#js-btn-wrap01').hide();

            }
        });

        $('.pin_two_btn:nth-child(1)').click(function(event) {
            event.preventDefault();
            $(this).children('.like_toggle').toggleClass("on");
        });

        $(".review_box").slice(0, 3).show(); // 최초 3개 선택
        $(".morescroll_wrap02 .morescroll").click(function(e) { // Load More를 위한 클릭 이벤트e
            e.preventDefault();
            $(".review_box:hidden").slice(0, 5).show(); // 숨김 설정된 다음 5개를 선택하여 표시
            if ($(".review_box:hidden").length == 0) { // 숨겨진 DIV가 있는지 체크
                $('#js-btn-wrap02').hide();
            }
        });

        $(".detail_sec_btn li a.moveTo").click(function() {
            $(".detail_sec_btn li").removeClass("on");
            $(this).parent("li").addClass("on");
            var id = $(this).attr("data-seq");
            id = "#" + id;
            $("html").animate({
                scrollTop: $(id).offset().top - 60
            }, 300);
        });
    });

    //detail_sec_btn scroll 메뉴
    $(window).scroll(function() {
        if (matchMedia("screen and (min-width: 1200px)").matches) {
            var height = $(window).scrollTop(); //실시간으로 스크롤의 높이를 측정
            var top01 = $("#detail_sec01").offset();
            var top02 = $("#detail_sec02").offset();
            var top03 = $("#detail_sec03").offset();
            var top04 = $("#detail_sec04").offset();

            if (height <= top01.top) {
                $(".detail_sec_btn li").removeClass("on");
                $(".detail_sec_btn li:nth-child(1)").addClass("on");
                $(".detail_sec_btn").removeClass("scroll_fix");

            } else if (height >= top04.top - 120) {
                $(".detail_sec_btn li").removeClass("on");
                $(".detail_sec_btn li:nth-child(4)").addClass("on");
                $(".detail_sec_btn").addClass("scroll_fix");


            } else if (height >= top03.top - 120) {
                $(".detail_sec_btn li").removeClass("on");
                $(".detail_sec_btn li:nth-child(3)").addClass("on");
                $(".detail_sec_btn").addClass("scroll_fix");

            } else if (height >= top02.top - 120) {
                $(".detail_sec_btn li").removeClass("on");
                $(".detail_sec_btn li:nth-child(2)").addClass("on");
                $(".detail_sec_btn").addClass("scroll_fix");

            } else if (height > top01.top - 120) {
                $(".detail_sec_btn").addClass("scroll_fix");
            }
        }
    });
</script>

<?
include '../footer.php';
?>