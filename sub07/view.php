<?
include '../header.php';

$tot_num = 5;

$uid = $code;
$query = "SELECT * FROM ks_store WHERE uid=$uid";
$row = sqlRow($query);
foreach ($row as $k => $v) {
    ${$k} = $v;
}
$shipPrice = ($shipPrice == 0)? "무료배송" : number_format($shipPrice);
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

    .bx-wrapper .bx-next {
        right: 0px;
        background-image: url("../images/sub/order_next.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 13px 21px;
    }

    .bx-wrapper .bx-prev {
        left: 0px;
        background-image: url("../images/sub/order_prev.png");
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
    }

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
        height: 100px;
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
            height: calc(25% - 5px);
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
                        $upfile = ${"upfile" . $file_num};

                        if ($upfile) {
                    ?>
                            <div class="bx_box" style="background-image:url('/upfile/store/<?= $upfile ?>');"></div>
                    <? }
                    } ?>
                </div>

                <div id="bx-pager">
                    <? for ($i = 1; $i <= $tot_num; $i++) {
                        $file_num = sprintf("%02d", $i);
                        $upfile = ${"upfile" . $file_num};

                        if ($upfile) {
                    ?>
                            <a data-slide-index="<?= $i - 1 ?>" href="javascript:avoid(0)" style="background-image:url('/upfile/store/<?= $upfile ?>')"></a>
                    <? }
                    } ?>
                </div>
            </div>

            <!--mobile-->
            <div class="mobile_detail_wrap">
                <div class="detail_right">
                    <div class="pin_box" style="padding: 0;">
                        <div class="pin_box_scroll">
                            <p class="pin_box_tit bold2"><?= $title ?></p>
                            <p class="pin_box_det"><?= $exp ?></p>
                            <ul class="price_detail_box">
                                <li class="dp_sb dp_end">
                                    <div class="bold2 f14">판매가</div>
                                    <div class="bold2 txt-r f18"><span><?= number_format($price) ?></span>원</div>
                                </li>
                                <li class="dp_sb dp_end">
                                    <div class="bold2 f14">배송비</div>
                                    <div class="bold2 txt-r f14"><?= $shipPrice ?></div>
                                </li>
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
                                <p class="c_bora01 bold2 f22"><span><?= number_format($price + $shipPrice) ?></span>원</p>
                            </div>

                            <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="" title="">장바구니</a>
                            <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="" title="">구매하기</a>
                            <div class="pin_two_btn_wrap dp_sb dp_c">
                                <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="" title="">
                                    <div class="like_toggle"></div>
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


            <div class="event_detail">
                <?= $ment01 ?>
            </div>

            <!---유의사항--->
            <div class="detail_cont_sub_tit">
                <span class="bora01 c_w bold2">유의사항</span>
            </div>
            <div class="detail_cont_subcont caution_subcont">
                <?= $ment02 ?>
            </div>
            <!---유의사항--->


            <!---상품후기--->
            <div class="detail_cont_sub_tit">
                <span class="bora01 c_w bold2">상품후기</span>
            </div>
            <div class="detail_cont_subcont product_review_subcont">
                <div class="review_box_wrap">
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
            <!---상품후기--->
        </div>

        <!--pc-->
        <div class="detail_right pc_detail_wrap">
            <div class="pin_box" style="padding: 0;">
                <div class="pin_box_scroll">
                    <p class="pin_box_tit bold2"><?= $title ?></p>
                    <p class="pin_box_det"><?= $exp ?></p>
                    <ul class="price_detail_box">
                        <li class="dp_sb dp_end">
                            <div class="bold2 f14">판매가</div>
                            <div class="bold2 txt-r f18"><span><?= number_format($price) ?></span>원</div>
                        </li>
                        <li class="dp_sb dp_end">
                            <div class="bold2 f14">배송비</div>
                            <div class="bold2 txt-r f14"><?= $shipPrice ?></div>
                        </li>
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
                        <p class="c_bora01 bold2 f22"><span><?= number_format($price + $shipPrice) ?></span>원</p>
                    </div>

                    <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="" title="">장바구니</a>
                    <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="" title="">구매하기</a>
                    <div class="pin_two_btn_wrap dp_sb dp_c">
                        <a class="pin_two_btn dp_f dp_c dp_cc bold2" href="" title="">
                            <div class="like_toggle"></div>
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
</div>

<script>
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
    });

    $('.pin_two_btn:nth-child(1)').click(function(event) {
        event.preventDefault();
        $(this).children('.like_toggle').toggleClass("on");

    });
</script>

<?
include '../footer.php';
?>