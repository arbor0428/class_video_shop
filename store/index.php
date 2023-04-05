<?
include '../header.php';
define('_UPLOAD_DIR', '/upfile/prod/store');
$category01 = '5';

$query = "SELECT *, (SELECT COUNT(1) FROM ks_wish WHERE ks_wish.userid='$GBL_USERID' AND ks_class.uid=ks_wish.class_uid) AS is_wish FROM ks_class WHERE status=1 AND prod_type='STORE'";
$result = mysql_query($query) or die("DB Error : " . mysql_error());
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

        <div class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc">스토어</div>
        <div class="dp_f dp_wrap nVdSlickBox_04_wrap">
            <?php
            while ($row = mysql_fetch_assoc($result)) {
                foreach ($row as $k => $v) {
                    ${$k} = $v;
                }
            ?>
                <div class="nVdSlickBox">
                    <a href="./view.php?&code=<?= $uid ?>" title="<?= $title ?>">
                        <div class="imgWrap c_gry02 p_r">
                            <button type=" button" title="관심" class="likeMark <? if ($row['is_wish']) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $uid ?>"></button>
                            <img src="<?= _UPLOAD_DIR . "/" . $upfile01 ?>" alt="<?= $title ?>" width="276" height="240">
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
                            <div><?= price_tag($row['price'], $row['discountPrice'], $row['discountRate']) ?></div>
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
        navigation:false,
      });
    var btmBnr = new Swiper(".event_bnr_btm_wrap", {
        spaceBetween: 0,     
        autoplay: false,
        pagination: false,
        navigation:false,
      });
</script>

<?
include '../footer.php';
?>