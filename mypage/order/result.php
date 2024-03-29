<?
include '/home/edufim/www/header.php';
include '/home/edufim/www/module/loading.php';
?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <?
            include 'sidemenu.php';
        ?>

        <!-- Content Wrapper -->
        <div class="s_cont">
            <!-- Main Content -->
            <div class="s_cont_tit f20 bold2 c_bora01">강좌 결제</div>
            <div class="payResult_Wrap">
                <?
                if ( $res_cd == "0000" ) {
                ?>
                    <div class="payResult_box">
                        <h2 class="tit">결제가 완료 되었습니다</h2>
                        <p>결과메세지: <?= $res_msg ?></p>
                        <p>주문번호: <?= $order_no ?></p>
                        <p>결제일시: <?= date('Y-m-d H:i:s', strtotime($app_time)) ?></p>
                        <p>결제수단: <?= $card_name ?></p>
                        <p>결제금액: <span class="pay-success-num"><?= number_format($amount) ?></span> 원</p>
                        <a href="/mypage/learning/" class="classBtn bora dp_inline dp_c dp_cc c_w">수강하러가기</a>
                    </div>
                <?
                } else { ?>
                    <div class="payResult_box">
                        <h2>결제에 실패 하였습니다.</h2>
                        <p>결과코드: <?= $res_cd ?></p>
                        <p>결과메세지: <?= $res_msg ?></p>
                        <p>홈페이지로 문의주시기 바랍니다.</p>
                        <p><?= $errorMsg ?></p>
                        <p><?= $cancelResponse ?></p>
                        <p><?= $cancelErr ?></p>
                        <a href="/" class="classBtn gry03 dp_inline dp_c dp_cc c_w">홈으로</a>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>
<?
include '/home/edufim/www/footer.php';
?>