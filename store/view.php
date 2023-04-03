<?
include '../header.php';
define('_UPLOAD_DIR', '/upfile/prod/store');
$tot_num = 6;

$class_uid = $code;
if (isEmpty($class_uid)) $MSG->goNext_New("\/store");
if (!isNumId($class_uid)) $MSG->goNext_New("\/store");

$query = "SELECT * FROM ks_class WHERE uid='$class_uid' AND status=1";
$result = mysql_query($query) or $MSG->goNext_New("\/store");
$num_row = mysql_num_rows($result);

if ($num_row > 0) $class = mysql_fetch_assoc($result) or $MSG->goNext_New("\/store");
else $MSG->goNext_New("\/store");

$isWish = sqlRowOne("SELECT COUNT(1) FROM ks_wish WHERE userid='$GBL_USERID' AND class_uid='$class_uid'");
$hasClass = sqlRowCount("SELECT uid FROM ks_learning WHERE userid='$GBL_USERID' AND class_uid='$class_uid'") > 0;
$shipPrice = (is_null($class['shipPrice']))? 0 : $class['shipPrice'];
?>

<style>
    .bx-wrapper {
        width: 644px;
        height: 450px;
        margin-bottom: 30px;
        box-shadow: none;
        border-radius: 4px;
        overflow: hidden;
        border: none;
    }

    /* .bx-wrapper .bx-next {
        right: 0px;
        background-image: url("/images/sub/order_next.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 13px 21px;
    }

    .bx-wrapper .bx-prev {
        left: 0px;
        background-image: url("/images/sub/order_prev.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 13px 21px;
    }

    .bx-wrapper .bx-prev:hover,
    .bx-wrapper .bx-prev:focus {
        background-position: center center;
    }

    .bx-wrapper .bx-next:hover,
    .bx-wrapper .bx-next:focus {
        background-position: center center;
    } */

    .bx-wrapper .bx-controls-direction a {
        top: 115%;
    }

    .bx .bx_box {
        width: 665px;
        height: 450px;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    #bx-pager {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        flex-direction: column;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    #bx-pager a {
        display: block;
        border-radius: 4px;
        width: 120px;
        height: 100px; /* 공백  2개일때 48% 3개 일때 31% 4개일때 23%*/ 
        overflow: hidden;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    #bx-pager a:last-child {
        margin-bottom: 0;
    }

    @media (max-width:1240px) {
        .bx-wrapper {
            width: calc(100% - 140px);
        }
    }

    @media (max-width:1024px) {
        #bx-pager a {
            height: calc(25% - 17px);
        }
    }

    @media (max-width:600px) {
        .bx-wrapper {
            width: 70%;
            margin-bottom: 0;
            height: auto;
        }

        .bx-wrapper .bx-viewport {
            height: 100%;
        }

        .bx {
            height: 100%;
        }

        .bx .bx_box {
            height: 100%;
        }

        #bx-pager {
            width: 28%;
        }

        #bx-pager a {
            width: 100%;
            /* height: calc(25% - 5px); */
            background-size: 100% 100%;
        }

    }
</style>

<div class="subWrap">
    <div class="s_center dp_sb">
        <div class="detail_cont">
            <div class="detail_sum dp_sb">
                <div class='bx'>
                    <? for ($i = 1; $i <= $tot_num; $i++) {
                        $file_num = sprintf("%02d", $i);
                        $upfile = $class["upfile" . $file_num];

                        if ($upfile) {
                            echo $upfile;
                    ?>
                            <div class="bx_box" style="background-image:url('<?= _UPLOAD_DIR . '/' . $upfile ?>');"></div>
                    <? }
                    } ?>
                </div>

                <div id="bx-pager">
                    <? for ($i = 1; $i <= $tot_num; $i++) {
                        $file_num = sprintf("%02d", $i);
                        $upfile = $class["upfile" . $file_num];

                        if ($upfile) {
                    ?>
                            <a data-slide-index="<?= $i - 1 ?>" href="javascript:avoid(0)" style="background-image:url('<?= _UPLOAD_DIR . '/' . $upfile ?>')"></a>
                    <? }
                    } ?>
                </div>
            </div>

            <!--mobile-->
            <div class="mobile_detail_wrap">
                <div class="detail_right">
                    <div class="pin_box">
                        <p class="pin_box_tit bold2"><?= $class['title'] ?></p>
                        <p class="pin_box_det"><?= $class['exp'] ?></p>
                        <ul class="price_detail_box">
                            <?
                                if (is_null($class['discountPrice'])) {
                            ?>
                            <li class="dp_sb dp_end">
                                <div class="bold2 f14">상품 판매가</div>
                                <div class="bold2 txt-r f18"><span><?= number_format($class['price']) ?></span>원</div>
                            </li>
                            <li class="dp_sb dp_end">
                                <div class="bold2 f14">배송비</div>
                                <div class="bold2 txt-r f18"><?= number_format($shipPrice) ?> 원</div>
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
                                <div class="bold2 f14">배송비</div>
                                <div class="bold2 txt-r f18"><?= number_format($shipPrice) ?> 원</div>
                            </li>
                            <?
                                }
                            ?>
                            <!-- <li class="dp_sb dp_c">
                                <div class="bold2 f14">옵션선택</div>
                                <div>
                                    <select name="" id="">
                                        <option value="">[필수] 옵션을 선택해주세요.</option>
                                        <option value="">EMS 어깨 마사지기기</option>
                                        <option value="">EMS 어깨 마사지기기</option>
                                    </select>
                                </div>
                            </li> -->
                        </ul>

                        <!-- <div class="selected_option_wrap">
                            <div class="selected_option gry02">
                                <div class="p_r">
                                    <a class="selected_option_close p_a" href="" title="닫기"><img src="/images/sub/price_x_icon.svg" alt=""></a>
                                    <p class="bold2 f14 m_05">EMS 어깨 마사지기기</p>
                                    <div class="dp_sb">
                                        <span class="c_gry04 f12">남성용 L 사이즈</span>
                                        <span class="c_bora01 bold2 f12">360,000</span>
                                    </div>
                                    <ul class="num_list dp_inline dp_c">
                                        <li class="dp_f dp_c dp_cc"><a href="">-</a></li>
                                        <li><input type="text" value="1"></li>
                                        <li class="dp_f dp_c dp_cc"><a href="">+</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="selected_option gry02">
                                <div class="p_r">
                                    <a class="selected_option_close p_a" href="" title="닫기"><img src="/images/sub/price_x_icon.svg" alt=""></a>
                                    <p class="bold2 f14 m_05">EMS 어깨 마사지기기</p>
                                    <div class="dp_sb">
                                        <span class="c_gry04 f12">여성용 M 사이즈</span>
                                        <span class="c_bora01 bold2 f12">360,000</span>
                                    </div>
                                    <ul class="num_list dp_inline dp_c">
                                        <li class="dp_f dp_c dp_cc"><a href="">-</a></li>
                                        <li><input type="text" value="1"></li>
                                        <li class="dp_f dp_c dp_cc"><a href="">+</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->

                        <div class="total_price_wrap dp_sb dp_end">
                            <p class="c_bora01 bold2 f14">총 금액</p>
                            <p class="c_bora01 bold2 f22"><span><?= number_format($class['discountPrice'] + $shipPrice) ?></span>원</p>
                        </div>

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
                <!-- <div class="detail_cont_subcont caution_subcont">
                    <?= $class['ment02'] ?>
                </div> -->
            </section>
            <!---유의사항--->


            <!---상품후기--->
            <section id="detail_sec04">
                <div class="detail_cont_sub_tit">
                    <span class="bora01 c_w bold2">상품후기</span>
                </div>
                <div class="detail_cont_subcont product_review_subcont">
                    <div class="review_box_wrap">
                    <?php
                        $reviewArr = sqlArray("SELECT r.*, m.name nm from ks_review r left join ks_member m on r.userid=m.userid where r.class_uid=$class_uid");
                        foreach ($reviewArr as $review) {
                    ?>
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
                    <?php
                        }
                    ?>
                        <div class="review_box">
                            <div class="dp_sb dp_c">
                                <div class="per_info_wrap dp_f dp_c">
                                    <div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"><!--프로필 배경 처리--></div>
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
                    </div>
                    <div id="js-btn-wrap">
                        <a class="morescroll dp_f dp_c dp_cc bora01 c_w" href="" title="더보기">더보기 <img src="../images/s_down.svg" alt=""> </a>
                    </div>
                </div>
            </section>
            <!---상품후기--->
        </div>

        <!--pc-->
        <div class="detail_right pc_detail_wrap">
            <div class="pin_box" style="padding: 0;">
                <div class="pin_box_scroll">
                    <p class="pin_box_tit bold2"><?= $class['title'] ?></p>
                    <p class="pin_box_det"><?= $class['exp'] ?></p>
                    <ul class="dp_f dp_c gry01 class_dayamount_info">
                        <li class="f12 dp_f dp_c">대상</li>
                        <li class="f12"><?= $class['target'] ?></li>
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
                                <div class="bold2 f14">배송비</div>
                                <div class="bold2 txt-r f18"><?= number_format($shipPrice) ?> 원</div>
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
                                <div class="bold2 f14">배송비</div>
                                <div class="bold2 txt-r f18"><?= number_format($shipPrice) ?> 원</div>
                            </li>
                        <?
                        }
                        ?>
                        <!-- <li class="dp_sb dp_c">
                            <div class="bold2 f14">옵션선택</div>
                            <div>
                                <select name="" id="">
                                    <option value="">[필수] 옵션을 선택해주세요.</option>
                                    <option value="">EMS 어깨 마사지기기</option>
                                    <option value="">EMS 어깨 마사지기기</option>
                                </select>
                            </div>
                        </li> -->
                    </ul>

                    <!-- <div class="selected_option_wrap">
                        <div class="selected_option gry02">
                            <div class="p_r">
                                <a class="selected_option_close p_a" href="" title="닫기"><img src="/images/sub/price_x_icon.svg" alt=""></a>
                                <p class="bold2 f14 m_05">EMS 어깨 마사지기기</p>
                                <div class="dp_sb">
                                    <span class="c_gry04 f12">남성용 L 사이즈</span>
                                    <span class="c_bora01 bold2 f12">360,000</span>
                                </div>
                                <ul class="num_list dp_inline dp_c">
                                    <li class="dp_f dp_c dp_cc"><a href="">-</a></li>
                                    <li><input type="text" value="1"></li>
                                    <li class="dp_f dp_c dp_cc"><a href="">+</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="selected_option gry02">
                            <div class="p_r">
                                <a class="selected_option_close p_a" href="" title="닫기"><img src="/images/sub/price_x_icon.svg" alt=""></a>
                                <p class="bold2 f14 m_05">EMS 어깨 마사지기기</p>
                                <div class="dp_sb">
                                    <span class="c_gry04 f12">여성용 M 사이즈</span>
                                    <span class="c_bora01 bold2 f12">360,000</span>
                                </div>
                                <ul class="num_list dp_inline dp_c">
                                    <li class="dp_f dp_c dp_cc"><a href="">-</a></li>
                                    <li><input type="text" value="1"></li>
                                    <li class="dp_f dp_c dp_cc"><a href="">+</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->

                    <div class="total_price_wrap dp_sb dp_end">
                        <p class="c_bora01 bold2 f14">총 금액</p>
                        <p class="c_bora01 bold2 f22"><span><?= number_format($class['discountPrice'] + $shipPrice) ?></span>원</p>
                    </div>


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
</div>
<form name="frm01" action="/mypage/order/" method="post">
    <input type="hidden" name="class_uids[]" value="<?= $class_uid ?>">
    <input type="hidden" name="prod_type" value="CLASS">
    <input type="hidden" name="userid" value="<?= $GBL_USERID ?>">
    <input type="hidden" name="numOfProd" value="1">
    <input type="hidden" name="price" value="<?= $class['price'] ?>">
    <input type="hidden" name="discountPrice" value="<?= $class['discountPrice'] ?>">
    <input type="hidden" name="shipPrice" value="<?= $shipPrice ?>">
    <input type="hidden" name="good_mny" value="<?= $class['discountPrice'] + $shipPrice ?>">
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
        if (hasClass == 'false') {
            document.frm01.submit()
        } else {
            GblMsgBox('이미 구매한 상품입니다')
        }
    }
    
    $(function() {
        $(".review_box").slice(0, 3).show(); // 최초 3개 선택
        $(".morescroll").click(function(e) { // Load More를 위한 클릭 이벤트e
            e.preventDefault();
            $(".review_box:hidden").slice(0, 5).show(); // 숨김 설정된 다음 5개를 선택하여 표시
            if ($(".review_box:hidden").length == 0) { // 숨겨진 DIV가 있는지 체크
                $('#js-btn-wrap').hide();
            }
        });

        $(".bx").bxSlider({
            mode: 'horizontal',
            speed: '300',
            pause: '3000',
            pagerCustom: '#bx-pager',
            auto: false
        });

        $('.pin_two_btn:nth-child(1)').click(function(event) {
            event.preventDefault();
            $(this).children('.like_toggle').toggleClass("on");
        });
    });

</script>

<?
include '../footer.php';
?>