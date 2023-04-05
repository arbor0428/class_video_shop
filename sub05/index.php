<?
include '../header.php';
define('_NAME', '필라테스자격증');
define('_UPLOAD_DIR', '/upfile/license/');

$cade01 = sqlRowOne("SELECT uid FROM ks_license_cade01 WHERE title='" . _NAME . "'");

$query = "SELECT * FROM ks_license WHERE status='1' AND cade01='$cade01'";
$result = mysql_query($query) or die(mysql_error());
?>

<style>
    .event_bnr_wrap {
        width: 100%;
        height: 250px;
        margin-bottom: 63px;
        overflow: hidden;
        border-radius: 4px;
    }
    .event_bnr_btm_wrap {
        width: 100%;	
        height: 130px;
        overflow: hidden;
        margin-top: 130px;
        border-radius: 4px;
    }
</style>

<div class="subWrap">
    <div class="s_center">
        <!--배너 추가작업 2023-03-30 sj -->
        <div class="event_bnr_wrap">
            <div class="swiper-wrapper">
                <img src="/images/mainslide01.jpg" class="swiper-slide">						
            </div>
        </div>
        <!--//배너 추가작업 2023-03-30 sj -->

        <div class="bora c_w sideTit f22 bold2 sideTit dp_inline dp_c dp_cc">필라테스자격증</div>
        <div class="dp_f dp_wrap nVdSlickBox_04_wrap hght150">
            <?php
            while ($row = mysql_fetch_assoc($result)) {
                foreach ($row as $k => $v) {
                    ${$k} = $v;
                }
            ?>
                <div class="nVdSlickBox">
                    <a href="./view.php?&code=<?= $uid ?>" title="<?= $title ?>">
                        <div class="imgWrap c_gry02 p_r">
                            <img src="<?= _UPLOAD_DIR . "/" . $upfile01 ?>" alt="<?= $title ?>" width="276">
                        </div>
                        <div class="nVdCont">
                            <div class="nVdTop">
                                <p class="nVdtit01 bold2 dotdot"><?= $title ?></p>
                                <p class="nVdtit02 c_gry03 dotdot"><?= $exp ?></p>
                                <ul class="clickicon dp_f dp_c">
                                    <li class="dp_f dp_c">
                                        <img src="/images/likeChk_gry.png" alt="wish">
                                        <span><?= $wish ?></span>
                                    </li>
                                    <li class="dp_f dp_c">
                                        <img src="/images/bestChk_gry.png" alt="like">
                                        <span><?= $like ?>%</span>
                                    </li>
                                </ul>
                            </div>
                            <div><?= price_tag($row['price'], $row['discountPrice'], $row['discountRate'], $row['period']) ?></div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
        <!--배너 추가작업 2023-03-30 sj -->
        <div class="  event_bnr_btm_wrap">
            <div class="swiper-wrapper">
                <img src="/images/main_eventBnr01.jpg" class="swiper-slide">
            </div>
        </div>
        <!--//배너 추가작업 2023-03-30 sj -->
    </div>
</div>

<!--배너 추가작업 2023-03-30 sj -->
<script>
    var topBnr = new Swiper(".event_bnr_wrap", {
        spaceBetween: 0,
        autoplay: false,
        pagination: false,
        navigation: false,
    });
    var btmBnr = new Swiper(".event_bnr_btm_wrap", {
        spaceBetween: 0,
        autoplay: false,
        pagination: false,
        navigation: false,
    });
</script>

<?
include '../footer.php';
?>