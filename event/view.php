<?
include '../header.php';

$uid = $code;
$query = "SELECT * FROM ks_event WHERE uid=$uid";
$result = mysql_query($query) or die("/sub03");
$num_row = mysql_num_rows($result);
$row = mysql_fetch_assoc($result);

foreach ($row as $k => $v) {
    ${$k} = $v;
}
$eDateTime = new DateTime($eDate);
$tDateTime = new DateTime(date('Y-m-d'));
$diff = $tDateTime->diff($eDateTime);
$int_d_day = intval($diff->format('%R%a'));

$d_day = $diff->days;
$d_time = strtotime('15:00:00') - time();
$d_time = date('H : i : s', $d_time);
?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <div class="detail_cont">
            <div class="detail_sum">
                <img src="/upfile/event/<?= $upfile01 ?>" alt="썸네일 상단">
            </div>

            <!--mobile-->
            <div class="mobile_detail_wrap">
                <div class="detail_right">
                    <div class="pin_box">
                        <p class="pin_box_tit bold2"><?= $title ?></p>
                        <p class="pin_box_det"><?= $exp ?></p>
                        <ul class="event_pin_list">
                            <li class="dp_f dp_c">
                                <span class="c_bora01 bold2">남은 시간</span>
                                <span class="bold2"><?= $d_day ?>일 <?= $d_time ?></span>
                            </li>
                            <li class="dp_f dp_c">
                                <span class="c_bora01 bold2">이벤트 대상</span>
                                <span><?= $target ?></span>
                            </li>
                            <li class="dp_f dp_c">
                                <span class="c_bora01 bold2">이벤트 기간</span>
                                <span>
                                    <?= $sDate ?> ~ <?= $eDate ?> <!--PM 23 : 59분 까지-->
                                </span>
                            </li>
                        </ul>
                        <?
                        if ($coupon_uid > 0) {
                        ?>
                            <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="javascript:void(0)" onclick="getCoupon()" title="쿠폰 다운로드">
                                <i class="fa fa-download" aria-hidden="true"></i>쿠폰 다운로드
                            </a>
                        <?
                        }
                        ?>
                        <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="javascript:void(0)" onclick="copy_link()" title=""><img src="/images/sub/clip_icon.svg" alt="클립">링크 복사하기</a>
                    </div>
                </div>
            </div>

            <div class="event_detail">
                <?= $ment01 ?>
            </div>
        </div>

        <!--pc-->
        <div class="detail_right pc_detail_wrap">
            <div class="pin_box">
                <p class="pin_box_tit bold2"><?= $title ?></p>
                <p class="pin_box_det"><?= $exp ?></p>
                <ul class="event_pin_list">
                    <li class="dp_f dp_c">
                        <span class="c_bora01 bold2">남은 시간</span>
                        <span class="bold2"><?= $d_day ?>일 <?= $d_time ?></span>
                    </li>
                    <li class="dp_f dp_c">
                        <span class="c_bora01 bold2">이벤트 대상</span>
                        <span><?= $target ?></span>
                    </li>
                    <li class="dp_f dp_c">
                        <span class="c_bora01 bold2">이벤트 기간</span>
                        <span>
                            <?= $sDate ?> ~ <?= $eDate ?>
                        </span>
                    </li>
                </ul>
                <?
                if ($coupon_uid > 0) {
                ?>
                    <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="javascript:void(0)" onclick="getCoupon();" title="쿠폰 다운로드">
                        <i class="fa fa-download"></i>&nbsp;쿠폰 다운로드
                    </a>
                <?
                }
                ?>
                <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="javascript:void(0)" onclick="copy_link()" title=""><img src="/images/sub/clip_icon.svg" alt="클립">링크 복사하기</a>
            </div>
        </div>
    </div>
</div>

<script>
    const uid = '<?= $code ?>';
    const userid = '<?= $GBL_USERID ?>';

    const getCoupon = function() {
        $.ajax({
            url: "./proc.php",
            data: {
                "method": "EVENT",
                "userid": userid,
                "uid": uid,
            },
            method: "POST",
            success: (response) => {
                response = response.trim()

                if (response === 'SUCCESS') {
                    GblMsgBox("쿠폰을 발급 받았습니다.", "");

                } else if (response === 'EXIST') {
                    GblMsgBox("이미 발급받은 쿠폰입니다.", "");

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
</script>

<?
include '../footer.php';
?>