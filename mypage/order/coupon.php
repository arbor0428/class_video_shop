<?
include "/home/edufim/www/module/login/head.php";

if (!$GBL_USERID) {
    Msg::goMsg("로그인이 필요한 서비스 입니다.", "/member/login.php");
    exit;
}

$sql = "SELECT c.*, l.eTime FROM ks_coupon_log l JOIN ks_coupon c ON l.coupon_uid=c.uid WHERE l.userid='$GBL_USERID' AND l.status='1'";
$couponArr = sqlArray($sql);
$num_rows = sqlRowCount($sql);
?>

<form action="./index.php" name="frm03" method="post">
    <div class="couponListWrap" style="height:655px;">
        <div>
            <div class="dp_f dp_c m_12">
                <span class="bold2">쿠폰 적용</span>
                <span>&nbsp;-&nbsp;사용 가능</span>
                <span class="c_bora01 bold2">&nbsp;<?= $num_rows ?>&nbsp;</span>
            </div>
            <div class="couponApplyList">
                <div class="radioWrap dp_f dp_c">
                    <input type="radio" name="coupon" id="c_default" value="" checked>
                    <label for="c_default" class="f14 c_gry04">선택 안 함</label>
                </div>
                <?
                foreach ($couponArr as $index => $coupon) {
                ?>
                    <div class="radioWrap dp_f dp_c">
                        <input type="radio" name="coupon" id="coupon<?= $index ?>" value="<?= $coupon['uid'] ?>" data-title="<?= $coupon['title'] ?>" data-price="<?= $coupon['discountPrice'] ?>" data-time="<?= $coupon['eTime'] ?>"
                            <? if ($coupon['uid'] == $use_coupon_uid) echo "checked"; ?>>
                        <label for="coupon<?= $index ?>" class="dp_f dp_c f14 c_gry04">
                            <ul class="dp_f dp_c">
                                <li class="dp_f dp_c"><?= number_format($coupon['discountPrice']) ?>원</li>
                                <li class="dp_f dp_c">사용기한 : ~<?= date('Y-m-d H:i', $coupon['eTime']) ?></li>
                                <li class="dp_f dp_c"><?= $coupon['title'] ?></li>
                            </ul>
                        </label>
                    </div>
                <?
                }
                ?>
            </div>
        </div>
    </div>
</form>
<script>
    $('input[name=coupon]').on('change', function(e) {
        if (e.target.value == '') {
            parent.order_info.use_coupon_uid.value = ''
            parent.order_info.use_coupon_price.value = 0
            parent.order_info.use_coupon_time.value = ''
            parent.order_info.use_coupon_title.value = ''

        } else {
            parent.order_info.use_coupon_uid.value = e.target.value
            parent.order_info.use_coupon_price.value = e.target.dataset.price
            parent.order_info.use_coupon_time.value = e.target.dataset.time
            parent.order_info.use_coupon_title.value = e.target.dataset.title
        }

        parent.setOrderData()
        // n = $('input[name=coupon]:checked ~ label>ul>li:first-child').data()['discountprice'];
        // $("#use_coupon_price", parent.document).text(n)
    });
</script>