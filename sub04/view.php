<?
include '../header.php';

define('_NAME', 'BEST 콜라보');
define('_UPLOAD_DIR', '/upfile/best/');

$uid = $code;
if (isEmpty($uid)) $MSG->goNext_New("/sub04");
if (!isNumId($uid)) $MSG->goNext_New("/sub04");

$query = "SELECT * from ks_best where uid=$uid";
$result = mysql_query($query) or $MSG->goNext_New("/sub04");
$num_rows = mysql_num_rows($result);

if ($num_rows > 0) $row = mysql_fetch_assoc($result);
else $MSG->goNext_New("/sub04");
?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <div class="detail_cont">
            <div class="detail_sum">
                <img src="<?= _UPLOAD_DIR . $row['upfile01'] ?>" alt="<?= $row['title'] ?>">
                <!-- <iframe src="https://v.kr.kollus.com/<?= $row['key01'] ?>?" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe> -->
                <!--비디오-->
            </div>

            <!--mobile-->
            <div class="mobile_detail_wrap">
                <div class="detail_right">
                    <div class="pin_box">
                        <p class="pin_box_tit bold2"><?= $row['title'] ?></p>
                        <p class="pin_box_det"><?= $row['target'] ?></p>

                        <ul class="choose_list_box price_detail_box">
                            <?php
                            $class_lists = sqlArray("SELECT c.* FROM ks_best_list l JOIN ks_class c ON l.class_uid=c.uid WHERE l.best_uid='$uid' ORDER BY l.sort");
                            foreach ($class_lists as $key => $class_list) {
                            ?>
                                <li class="dp_sb dp_c">
                                    <div class="dp_f dp_c">
                                        <input id="classChk01" type="checkbox" disabled <? if (!$hasClass) echo "checked" ?>>
                                    </div>
                                    <label class="f14 <? if ($hasClass) echo "strkt"; ?>" for="classChk01"><?= $class_list['title'] ?></label>
                                    <!-- <p class="txt-r bold2 f14 <? if ($hasClass) echo "strkt"; ?>"><span><?= number_format($price) ?></span>원</p> -->
                                </li>
                            <? } ?>
                        </ul>

                        <ul class="price_detail_box02">
                            <?= price_view($row['price'], $row['discountPrice'], $row['discountRate']) ?>
                        </ul>

                        <!-- <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="javascript:void(0)" title="장바구니" onclick="cart()">장바구니</a> -->
                        <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="javascript:void(0)" title="구매하기" onclick="buy()">구매하기</a>
                        <div class="pin_two_btn_wrap dp_sb dp_c">
                            <a class="pin_two_btn dp_f dp_c dp_cc bold2 wid100" href="javascript:void(0)" title="링크 복사하기" onclick="copy_link()">
                                <img src="/images/sub/clip_icon_blk.svg" alt="클립">
                                링크 복사하기
                            </a>
                            <!-- <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="javascript:void(0)" title="찜하기" onclick="wish()">
                                </div>
								<div class="like_toggle <? if ($row['pid'] != NULL) echo 'on'; ?>"></div>
								<span>찜하기</span>
							</a> -->
                            <!-- <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="" title="">
                                <span>링크 복사하기</span>
                            </a> -->
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
                            <?
                            // var_dump($class_lists);
                            foreach ($class_lists as $key => $class_list) {
                            ?>
                                <div class="curricul_box">
                                    <div class="dp_sb dp_c">
                                        <div class="curricul_box_text">
                                            <p class="bold2"><?= $class_list['title'] ?></p>
                                            <span class="c_gry04 f14"><?= $class_list['exp'] ?></span>
                                        </div>
                                        <!-- <span class="curricul_box_time f14 bold"><?= $listCnt ?> 강</span> -->
                                    </div>
                                </div>
                            <?
                            }
                            ?>
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
                        <?= $row['ment01'] ?>
                    </div>
                </section>
                <!---상세정보--->

                <!---유의사항--->
                <section id="detail_sec03">
                    <div class="detail_cont_sub_tit">
                        <span class="bora01 c_w bold2">유의사항</span>
                    </div>
                    <div class="detail_cont_subcont caution_subcont">
                        <?= $row['ment02'] ?>
                    </div>
                </section>
                <!---유의사항--->

                <!---수강후기--->
                <!-- <section id="detail_sec04">
					<div class="detail_cont_sub_tit dp_sb dp_c">
						<span class="bora01 c_w bold2">수강후기</span>
						<p class="f12">수강 후기 작성 시 강의당 <span class="bold2 f12">최대 3일 연장</span></p>
					</div>
					<div class="detail_cont_subcont product_review_subcont">
						<div class="review_box_wrap">

							<?
                            while ($row2 = mysql_fetch_assoc($result2)) {
                            ?>
								<div class="review_box">
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
								</div>

							<? } ?>

						</div>
						<div id="js-btn-wrap02" class="morescroll_wrap02">
							<a class="morescroll dp_f dp_c dp_cc bora01 c_w" href="" title="더보기">더보기 <img src="../images/s_down.svg" alt=""> </a>
						</div>
					</div>
				</section> -->
                <!---수강후기--->
            </div>
        </div>

        <!--pc-->
        <div class="detail_right pc_detail_wrap">
            <div class="pin_box">
                <p class="pin_box_tit bold2"><?= $row['title'] ?></p>
                <p class="pin_box_det"><?= $row['target'] ?></p>

                <ul class="choose_list_box price_detail_box">
                    <?
                    foreach ($class_lists as $key => $class_list) {
                    ?>
                        <li class="dp_sb dp_c">
                            <div class="dp_f dp_c">
                                <input id="classChk01" type="checkbox" disabled <? if (!$hasClass) echo "checked" ?>>
                            </div>
                            <label class="f14 <? if ($hasClass) echo "strkt"; ?>" for="classChk01"><?= $class_list['title'] ?></label>
                            <!-- <p class="txt-r bold2 f14 <? if ($hasClass) echo "strkt"; ?>"><span><?= number_format($price) ?></span>원</p> -->
                        </li>
                    <?
                    }
                    ?>
                </ul>

                <ul class="price_detail_box02">
                    <?= price_view($row['price'], $row['discountPrice'], $row['discountRate']) ?>
                </ul>

                <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="javascript:void(0)" title="장바구니" onclick="cart()">장바구니</a>
                <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="javascript:void(0)" title="구매하기" onclick="buy()">구매하기</a>
                <div class="pin_two_btn_wrap dp_sb dp_c">
                    <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="javascript:void(0)" title="찜하기" onclick="wish()">
                        <div class="like_toggle <? if ($row['pid'] != NULL) echo 'on'; ?>"></div>
                        <span>찜하기</span>
                    </a>
                    <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="" title="">
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

    const buy = function() {
        console.log("buy");
        // $.ajax({
        // 	url: "./proc.php",
        // 	data: {
        // 		"CTYPE": _CTYPE,
        // 		"method": "BUY",
        // 		"userid": userid,
        // 		"uid": uid
        // 	},
        // 	method: "POST",
        // 	// dataType: "json",
        // 	success: (response) => {
        // 		response = response.trim()
        // 		console.log(response);
        // 		// if (response === '0') {
        // 		// 	alert("로그인이 필요한 서비스 입니다.")
        // 		// 	location.href = '/member/login.php';
        // 		// } else if (response === '1') {
        // 		// 	alert("잘못된 접근입니다")
        // 		// 	location.href = '/'
        // 		// } else {
        // 		// 	location.href = '/mypage/cart.php';
        // 		// }
        // 	},
        // 	error: (xhr, status, errorThrown) => {
        // 		console.log(xhr, errorThrown, status);
        // 		GblMsgBox("구매오류 관리자에게 문의 바랍니다", "location.href='/'");
        // 	}
        // })
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