<?
include '../header.php';

define('_UPLOAD_DIR', '/upfile/class/');

$class_uid = $code;
if (isEmpty($class_uid)) $MSG->goNext_New("/sub01");
if (!isNumId($class_uid)) $MSG->goNext_New("/sub01");

$query = "SELECT * from ks_class where uid='$class_uid' AND status=1";
// $class_result = mysql_query($query) or $die(mysql_error());
$class_result = mysql_query($query) or $MSG->goNext_New("/sub01");
$num_rows = mysql_num_rows($class_result);

if ($num_rows > 0) $class = mysql_fetch_assoc($class_result);
else $MSG->goNext_New("/sub01");

$query = "SELECT *, (SELECT length FROM kollus_video WHERE ks_class_list.kollus_video_id=kollus_video.id) AS length FROM ks_class_list WHERE class_uid='$class_uid' ORDER BY sort";
$list_num_rows = sqlRowCount($query);
$list_arr = sqlArray($query);

$isWish = sqlRowOne("SELECT COUNT(1) FROM ks_wish WHERE userid='$GBL_USERID' AND class_uid='$class_uid'");
$hasClass = sqlRowCount("SELECT uid FROM ks_learning WHERE userid='$GBL_USERID' AND class_uid='$class_uid'") > 0;
?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <div class="detail_cont">
            <div class="detail_sum" id="play-video-wrap">
                <img src="<?= _UPLOAD_DIR . '/' . $class['upfile01'] ?>" alt="<?= $class['title'] ?>">
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
                        <div class="mobile_pin_bot dp_f dp_c">
                            <?
                            if ($hasClass) {
                            ?>
                                <a class="pin_box_btn dp_f dp_c dp_cc bold2 gry03 wid100" href="javascript:void(0)" title="장바구니">이미 구매한 상품입니다</a>
                            <?
                            } else {
                            ?>
                                <div class="dp_sb dp_c">
                                    <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="javascript:void(0)" title="장바구니" onclick="cart()">장바구니</a>
                                    <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="javascript:void(0)" title="구매하기" onclick="buy()">구매하기</a>
                                </div>
                            <?
                            }
                            ?>
                        </div>

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
                <li class="on"><a class="moveTo" href="javascript:void(0);" data-seq="detail_sec01">커리큘럼</a></li>
                <li><a class="moveTo" href="javascript:void(0);" data-seq="detail_sec02">상세정보</a></li>
                <li><a class="moveTo" href="javascript:void(0);" data-seq="detail_sec03">유의사항</a></li>
                <li><a class="moveTo" href="javascript:void(0);" data-seq="detail_sec04">수강후기</a></li>
            </ul>

            <div class="detail_sec_wrap">
                <!---커리큘럼--->
                <section id="detail_sec01">
                    <div class="detail_cont_subcont curricul_subcont">
                        <div class="curricul_box_wrap">
                            <?
                            /*
                            foreach ($list_preview_arr as $list_preview) {
                            ?>
                            <!-- <div class="curricul_box">
                                    <a href="javascript:void(0)" onclick="playPreview('<?= $list_preview['media_content_key'] ?>')">
                                        <div class="dp_sb dp_c">
                                            <div class="curricul_box_text">
                                                <p class="bold2"><?= $list_preview['title'] ?></p>
                                                <span class="c_gry04 f14"><?= $list_preview['exp'] ?></span>
                                            </div>
                                            <span class="curricul_box_time f14 bold"><?= gmdate('H:i:s', $list_preview['length']) ?></span>
                                        </div>
                                    </a>
                                </div> -->
                            <?
                            }
                            */
                            foreach ($list_arr as $key => $list) {
                                if ($list['is_preview'] == '1') {
                                    $media_content_key = sqlRowOne("SELECT media_content_key FROM kollus_video WHERE id=" . $list['kollus_video_id']);

                                    $ele = "<a href=\"javascript:void(0)\" onclick=\"playPreview('$media_content_key')\">";
                                    $ele2 = "</a>";
                                    $ico_play = "<span class=\"c_bora01 m0\" style=\"padding-left:0.5rem;\"><i class=\"fa fa-play-circle\" aria-hidden=\"true\"></i>미리보기</span>";
                                } else {
                                    $ele = "";
                                    $ele2 = "";
                                    $ico_play = "";
                                }
                            ?>
                                <div class="curricul_box">
                                    <?
                                    echo $ele;
                                    ?>
                                    <div class="dp_sb dp_c">
                                        <div class="curricul_box_text">
                                            <p class="bold2"><?= $list['title'] ?> <? echo $ico_play?></p>
                                            <span class="c_gry04 f14"><?= $list['exp'] ?></span>
                                        </div>
                                        <span class="curricul_box_time f14 bold"><?= gmdate('H:i:s', $list['length']) ?></span>
                                    </div>
                                    <?
                                    echo $ele2;
                                    ?>
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
                        <span class="c_bora01 bold2 m_10">1. 수강 기간</span><br>
                        - 수강 가능 기간은 나의 강의실에서 확인이 가능합니다.<br><br>

                        <span class="c_bora01 bold2 m_10">2. 학습 질문</span><br>
                        - 강의 내용과 관련된 문의 사항은 나의 강의실 나의 학습질문에 남겨주세요.<br>
                        (질문 작성 방법 : 강좌 선택 > 내용)<br><br>

                        <span class="c_bora01 bold2 m_10">3. 사이트 이용 문의</span><br>
                        - 사이트 이용과 관련된 문의는 Q&A 에 남겨주세요.<br><br>


                        <span class="c_bora01 bold2 m_10">4. 환불</span><br>
                        평생교육법 시행령 제23조 및 소비자분쟁해결기준에서 규정하고 있는 수강료 반환 등에 관한 규정을 기본 원칙으로 하여 환불금액을 산정하고 있습니다. 단, 기본 원칙은 본 사이트 내 상품에 대한 포괄적인 규정이며 각 상품의 경우, 사전계약원칙이 적용되어 자사에서 규정한 별도의 결제취소, 변경 및 환불규정에 따라 환불금액이 산정되는 점 유의하시길 바랍니다.<br><br>


                        <div class="caution_depth01">
                            <b class="m_10">1. 환불 공통 규정</b><br>
                            <div class="caution_depth02">
                                1) 구매 후 모든 강좌는 2강 이하 수강한 경우를 미수강으로 규정합니다.<br>
                                <div class="caution_depth02">
                                    1-1) 학습 자료 다운로드 시 자료가 포함된 해당 강좌는 수강 강좌로 규정됩니다.<br>
                                </div>
                                2) 회원의 본인의사로 환불 시 추가적인 혜택 (사은품, 교재, 쿠폰 등)이 있는 경우 모두 반환되어야 하며, 사용되었거나 상품가치가 감소했을 경우 환불금액에서 공제됩니다.<br>

                                3) 환불 시 발생하는 교재/사은품 반품 배송비 3,000원은 회원 부담이며, 배송 시 무료배송 받으신 경우 해당 배송비 3,000원을 포함한 총 6,000원을 부담하셔야 합니다.<br>

                                4) 환불신청 시, 결제수단으로 환불이 진행되며, 다른 결제수단으로 환불이 불가합니다.<br>
                                <div class="caution_depth02">
                                    4-1) 실시간계좌이체/무통장 입금건의 경우 환불접수일로부터 영업일 기준 3~5일정도 소요됩니다. <br>

                                    4-2) 카드취소는 카드부분결제취소로 환불이 되며, 이는 카드사 영업일 기준 2~3일정도 소요됩니다.
                                </div>
                            </div>
                        </div>
                        <div class="caution_depth01">
                            <b class="m_10">2. 단강좌 환불 규정</b><br>
                            <div class="caution_depth02">
                                1) 결제일로부터 7일이내 환불 신청 시 다음과 같이 환불 규정을 적용합니다.<br>

                                ① 미수강(2강 이하 수강)인 경우 : 전액 환불<br>

                                ② 2강을 초과하여 수강한 경우 : 일할 차감<br>

                                * 일할차감 산출 방식 : 단강좌 실결제금액 - [단강좌 정가금액/기본수강기간*실수강기간] = 환불금액<br>

                                2) 결제일로부터 7일을 초과한 경우 다음과 같이 환불 규정을 적용합니다.<br>

                                * 일할차감 후 환불 : 단강좌 실결제금액 - [단강좌 정가금액/기본수강기간*실수강기간] = 환불금액<br>

                                3) 교습시작 전일지라도 수강기간이 종료된 경우 환불이 불가합니다.<br>

                                4) 강의 다운로드 시 강의 수강으로 간주됩니다.
                            </div>
                        </div>
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
                <?
                if ($hasClass) {
                ?>
                    <a class="pin_box_btn dp_f dp_c dp_cc bold2 gry03" href="javascript:void(0)" title="장바구니">구매한 상품입니다</a>
                <?
                } else {
                ?>
                    <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="javascript:void(0)" title="장바구니" onclick="cart()">장바구니</a>
                    <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="javascript:void(0)" title="구매하기" onclick="buy()">구매하기</a>
                <?
                }
                ?>
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
<form name="frm01" action="/mypage/order/" method="post">
    <input type="hidden" name="class_uids[]" value="<?= $class_uid ?>">
    <input type="hidden" name="prod_type" value="<?= $class['CLASS_ONLINE'] ?>">
    <input type="hidden" name="userid" value="<?= $GBL_USERID ?>">
    <input type="hidden" name="numOfProd" value="1">
    <input type="hidden" name="price" value="<?= $class['price'] ?>">
    <input type="hidden" name="discountPrice" value="<?= (intval($class['price']) - intval($class['discountPrice'])) ?>">
    <input type="hidden" name="shippingFee" value="<?= $class['shippingFee'] ?>">
    <input type="hidden" name="good_mny" value="<?= $class['discountPrice'] ?>">
</form>

<script>
    const uid = '<?= $code ?>';
    const userid = '<?= $GBL_USERID ?>';
    const hasClass = '<?= ($hasClass) ? 'true' : 'false' ?>';

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
            url: "/module/common/proc_class.php",
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
        if (hasClass == 'false') {
            document.frm01.submit()
        } else {
            GblMsgBox('이미 구매한 상품입니다')
        }
    }

    const playPreview = function(key) {
        if (key != null) {
            $('#play-video-wrap').empty()
            $('#play-video-wrap').append('<iframe src="https://v.kr.kollus.com/' + key + '?" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>')
        }
    }

    $(function() {
        // 첫번째 미리보기 클릭
        $(".curricul_box > a")[0].click();

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