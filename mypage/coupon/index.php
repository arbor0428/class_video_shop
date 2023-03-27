<?
include '../../header.php';
$side_menu = 11;
$topTxt01 = '쿠폰함';

include '../location03.php';

$query = "SELECT l.*, c.title, c.discountPrice
    FROM ks_coupon_log l 
    JOIN ks_coupon c ON l.coupon_uid=c.uid
    WHERE l.userid='$GBL_USERID'";

if (!isset($case)) $case = 1;

$num_row_use = sqlRowCount($query . " AND l.status=1");

if ($case == 1)     $query .= " AND l.status=1";
elseif ($case == 2) $query .= " AND l.status=0";
else                $query .= "";

$query .= " ORDER BY l.status DESC";

$row_arr = sqlArray($query);
$num_row = sqlRowCount($query);

?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="s_cont_tit f20 bold2 c_bora01 nobrb">쿠폰함</div>

            <div class="dp_f couponBoxWrap">
                <div class="couponBox wid50 dp_sb dp_fc">
                    <div class="couponTop dp_f dp_c">
                        <img src="/images/couponIcon.png" alt="">
                        사용가능한 쿠폰
                    </div>
                    <div class="couponBot dp_f dp_end dp_end02">
                        <span class="couponNm c_bora01 bold2 f48"><?= $num_row_use ?></span>
                        <span>개</span>
                    </div>
                </div>
                <div class="couponBox wid50 dp_sb dp_fc">
                    <div class="couponTop dp_f dp_c">
                        <img src="../images/timeIcon.png" alt="">
                        만료임박 쿠폰
                    </div>
                    <div class="couponBot dp_f dp_end dp_end02">
                        <span class="couponNm bold2 f48">0</span>
                        <span>개</span>
                    </div>
                </div>
            </div>

            <div class="couTabWrap">
                <ul class="couTabBtn dp_f dp_wrap">
                    <li class="<? if ($case == 1) echo "on"; ?>"><a href="/mypage/coupon/" title="사용가능">사용가능</a></li>
                    <li class="<? if ($case == 2) echo "on"; ?>"><a href="/mypage/coupon/?case=2" title="사용완료 · 기간만료">사용완료 · 기간만료</a></li>
                    <li class="<? if ($case == 3) echo "on"; ?>"><a href="/mypage/coupon/?case=3" title="전체 쿠폰">전체 쿠폰</a></li>
                    <!-- <li class="<? if ($case == 4) echo "on"; ?>"><a href="/mypage/coupon/?case=2" title="만료임박">만료임박</a></li> -->
                </ul>
                <div class="couTabContWrap">

                    <div class="couTabCont">

                        <? if ($num_row > 0) { ?>

                            <div class="dp_f dp_wrap">
                                <?
                                foreach ($row_arr as $row) {
                                    foreach ($row as $k => $v) {
                                        ${$k} = $v;
                                    }
                                    if ($status == 1) { ?>
                                        <div class="couponUseBox dp_sb dp_fc">
                                            <div class="couponUse dp_sb dp_fc">
                                                <div>
                                                    <p class="c_gry_tit f12 c_gry04"><?= date('Y년 m월 d일 h:i', $eTime) ?> 까지</p>
                                                    <p class="f14 bold"><?= $title ?></p>
                                                </div>
                                                <div class="dp_sb dp_end">
                                                    <span class="f12">사용가능</span>
                                                    <p class="c_bora01 bold2 f18"><?= number_format($discountPrice) ?>원</p>
                                                </div>
                                            </div>
                                            <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                                        </div>
                                    <? } else { ?>
                                        <div class="couponUseBox dp_sb dp_fc used">
                                            <div class="couponUse dp_sb dp_fc">
                                                <div>
                                                    <p class="f12 c_gry04"><?= date('Y년 m월 d일 h:i', $eTime) ?> 까지</p>
                                                    <p class="cc_tit f14 bold"><?= $title ?></p>
                                                </div>
                                                <div class="dp_sb dp_end">
                                                    <span class="f12">사용만료</span>
                                                    <p class="c_bora01 bold2 f18"><?= number_format($discountPrice) ?>원</p>
                                                </div>
                                            </div>
                                            <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                                        </div>
                                <? }
                                } ?>

                                <!-- <div class="couponUseBox dp_sb dp_fc">
                                    <div class="couponUse dp_sb dp_fc">
                                        <div>
                                            <p class="c_gry_tit f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                            <p class="f14 bold">가입환영 5000원 할인쿠폰</p>
                                        </div>
                                        <div class="dp_sb dp_end">
                                            <span class="f12">만료임박</span>
                                            <p class="c_bora01 bold2 f18">5,000원</p>
                                        </div>
                                    </div>
                                    <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                                </div> -->
                            </div>

                        <? } else { ?>

                            <div class="noCouponWrap txt-c">
                                <img src="/images/nocoupon.svg" alt="쿠폰">
                                <p class="m-12 bold2">보유하신 쿠폰이 없습니다.</p>
                            </div>

                        <? } ?>

                    </div>

                    <!-- <div class="couTabCont">
                        <div class="dp_f dp_wrap">
                            <div class="couponUseBox dp_sb dp_fc">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="c_gry_tit f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                        </div>
                    </div>

                    <div class="couTabCont">
                        <div class="dp_f dp_wrap">
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">사용만료</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                        </div>
                    </div>

                    <div class="couTabCont">
                        <div class="dp_f dp_wrap">
                            <div class="couponUseBox dp_sb dp_fc">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="c_gry_tit f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">사용만료</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                            <div class="couponUseBox dp_sb dp_fc used">
                                <div class="couponUse dp_sb dp_fc">
                                    <div>
                                        <p class="f12 c_gry04">2022년 09월 29일 23:59 까지</p>
                                        <p class="cc_tit f14 bold">가입환영 5000원 할인쿠폰</p>
                                    </div>
                                    <div class="dp_sb dp_end">
                                        <span class="f12">만료임박</span>
                                        <p class="c_bora01 bold2 f18">5,000원</p>
                                    </div>
                                </div>
                                <div class="botText c_w bora01 dp_f dp_c dp_cc">C&nbsp;O&nbsp;U&nbsp;P&nbsp;O&nbsp;N</div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // $(".couTabBtn > li").on("click", function(event) {

    //     event.preventDefault();

    //     let tabNumber = $(this).index();

    //     $(".couTabBtn > li").removeClass("on");
    //     $(this).addClass("on");

    //     $(".couTabContWrap .couTabCont").hide();
    //     $(".couTabContWrap .couTabCont").eq(tabNumber).show();

    // });
</script>

<?
include '../../footer.php';
?>