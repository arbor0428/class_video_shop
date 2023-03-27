<?
include '../../header.php';
$side_menu = 12;
$topTxt01 = '적립금';

$query = "SELECT *
        FROM ks_point 
        WHERE userid='$GBL_USERID'";

if (!isset($case)) $case = 1;

if ($case == 1) {
    $row_arr = sqlArray($query);
    $num_row = sqlRowCount($query);
} elseif ($case == 2) {
    $row_arr = sqlArray($query . " AND ptype='P'");
    $num_row = sqlRowCount($query . " AND ptype='P'");
} elseif ($case == 3) {
    $row_arr = sqlArray($query . " AND ptype='M'");
    $num_row = sqlRowCount($query . " AND ptype='M'");
} else {
    die("ERROR");
}

?>

<?
include '../location03.php';
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="s_cont_tit f20 bold2 c_bora01 nobrb">적립금</div>
            <div class="totalPointWrap dp_sb dp_c">
                <div class="dp_f dp_c">
                    <img class="p_icon" src="/images/p_icon.svg" alt="총 보유 적립금">
                    <span>총 보유 적립금</span>
                </div>
                <p class="dp_f dp_c">
                    <span class="bold2 c_bora01" style="margin: 0 5px;"><?= number_format(sqlRowOne("SELECT point FROM ks_member WHERE userid='$GBL_USERID'")) ?></span>
                    <span>원</span>
                </p>
            </div>
            <p class="c_gry04 f14 m-12 m_40">· 총 결제금액 (배송비 제외)이 10,000원 이상인 경우 1,000원 단위로 사용가능</p>
            <div class="couTabWrap">
                <ul class="couTabBtn dp_f dp_wrap">
                    <li class="<? if ($case == 1) echo "on"; ?>"><a href="/mypage/point/" title="전체">전체</a></li>
                    <li class="<? if ($case == 2) echo "on"; ?>"><a href="/mypage/point/?case=2" title="적립">적립</a></li>
                    <li class="<? if ($case == 3) echo "on"; ?>"><a href="/mypage/point/?case=3" title="사용">사용</a></li>
                </ul>
                <div class="couTabContWrap">
                    <div class="couTabCont">
                        <div class="tableWrap">
                            <div class="subTbl subTbl01">
                                <div class="row_tit_wrap dp_f">
                                    <div class="row_tit">상태</div>
                                    <div class="row_tit">적립금</div>
                                    <div class="row_tit">적립내용</div>
                                    <div class="row_tit">날짜</div>
                                </div>

                                <? if ($num_row > 0) { ?>

                                    <div class="pointTrWrap">
                                        <?
                                        foreach ($row_arr as $key => $row) {
                                            foreach ($row as $k => $v) {
                                                ${$k} = $v;
                                            }

                                            if ($ptype == 'P') {
                                        ?>
                                                <div class="pointTr">
                                                    <div class="dp_f dp_c">
                                                        <div class="row_det"><span class="c_bora01 bold">적립</span></div>
                                                        <div class="row_det"><span class="c_bora01 bold">+<?= number_format($point) ?></span></div>
                                                        <div class="row_det">
                                                            <p><?= $content ?></p>
                                                            <p class="pointDet c_gry04"><?= $orderTitle ?></p>
                                                        </div>
                                                        <div class="row_det"><?= $rDate ?></div>
                                                    </div>
                                                </div>
                                            <? } else { ?>
                                                <div class="pointTr">
                                                    <div class="dp_f dp_c">
                                                        <div class="row_det"><span class="c_red01 bold">사용</span></div>
                                                        <div class="row_det"><span class="c_red01 bold">-<?= number_format($point) ?></span></div>
                                                        <div class="row_det">
                                                            <p><?= $content ?></p>
                                                            <p class="pointDet c_gry04"><?= $orderTitle ?></p>
                                                        </div>
                                                        <div class="row_det"><?= $rDate ?></div>
                                                    </div>
                                                </div>

                                            <? } ?>
                                        <? } ?>

                                        <!-- <div class="pointTr">
										<div class="dp_f dp_c">
											<div class="row_det"><span class="c_bora01 bold">적립</span></div>
											<div class="row_det"><span class="c_bora01 bold">+20,000</span></div>
											<div class="row_det">
												<p>주문 적립</p>
												<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
											</div>
											<div class="row_det">2022-09-28</div>
										</div>
									</div> -->
                                    </div>

                                <? } else { ?>

                                    <div class="noResult dp_f dp_c dp_cc">
                                        <div class="c_gry04 f14">적립금 내역이 없습니다.</div>
                                    </div>

                                <? } ?>

                                <div id="js-btn-wrap">
                                    <a class="bora01 c_w wid100 dp_f dp_c dp_cc point_moreBtn point_moreBtn01" href="" title="">
                                        내역 확인 하기
                                        <span class="lnr lnr-chevron-down"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //전체 탭에서 더보기
    $(".subTbl01 .pointTr").slice(0, 3).show(); // 최초 3개 선택
    $(".point_moreBtn01").click(function(e) { // Load More를 위한 클릭 이벤트e
        e.preventDefault();
        $(".subTbl01 .pointTr:hidden").slice(0, 10).show(); // 숨김 설정된 다음 10개를 선택하여 표시
        if ($(".subTbl01 .pointTr:hidden").length == 0) { // 숨겨진 DIV가 있는지 체크
            $('#js-btn-wrap').hide();
        }
    });

    //탭 기능
    // $(".couTabBtn > li").on("click", function(event) {

    //     event.preventDefault();

    //     let tabNumber = $(this).index();

    //     $(".couTabBtn > li").removeClass("on");
    //     $(this).addClass("on");

    //     $(".couTabContWrap .couTabCont").hide();;
    //     $(".couTabContWrap .couTabCont").eq(tabNumber).show();

    // });
</script>

<?
include '../../footer.php';
?>