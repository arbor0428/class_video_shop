<?
include '../header.php';

$query = "SELECT *";
$query .= " FROM ks_class";
// $query .= " LEFT JOIN ks_wish w ON s.uid=w.pid AND w.userid='$GBL_USERID' AND w.cType='" . _CTYPE . "'";
$query .= " WHERE cade01=19";

$result = mysql_query($query) or die("FAILED");

define('_UPLOAD_DIR', '/upfile/class');
?>

<div class="subWrap">
    <div class="s_center">
        <div class="bora c_w sideTit f22 bold2 sideTit dp_inline dp_c dp_cc">대면강의</div>
        <div class="dp_f dp_wrap nVdSlickBox_04_wrap hght150">
            <?
            while ($row = mysql_fetch_assoc($result)) {
                foreach ($row as $k => $v) {
                    ${$k} = $v;
                }
                $isWish = ($pid != NULL) ? true : false;
            ?>

                <div class="nVdSlickBox">
                    <a href="./view.php?&code=<?= $uid ?>" title="<?= $title ?>">
                        <div class="imgWrap c_gry02 p_r">
                            <button type="button" title="관심" class="likeMark <? if ($isWish) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $uid ?>" data-ctype="<?= _CTYPE ?>"></button>
                            <img src="<?= _UPLOAD_DIR . "/" . $upfile01 ?>" alt="<?= $title ?>" width="276" height="150">
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

                            <? if (!$discountPrice) { ?>
                                <div class="nVdBot">
                                    <span class="c_gry03"><?= number_format($price) ?>원</span>
                                    <p>
                                        <span class="priceDet m0 bold">월 <?= number_format($price / intval($period / 30)) ?>원</span>
                                        <span class="monDet">(<?= intval($period / 30) ?>개월)</span>
                                    </p>
                                </div>

                            <? } else { ?>
                                <div class="nVdBot">
                                    <p class="c_gry03 strkt"><?= number_format($price) ?>원</p>
                                    <p>
                                        <span class="bold"><?= number_format($discountPrice) ?> 원</span>
                                    </p>
                                    <p>
                                        <span class="c_red bold"><?= intval((($price - $discountPrice) / $price) * 100) ?>%</span>
                                        <span class="priceDet">월 <?= number_format($discountPrice / intval($period / 30)) ?>원</span>
                                        <span class="monDet">(<?= intval($period / 30) ?>개월)</span>
                                    </p>
                                </div>
                            <? } ?>

                        </div>
                    </a>
                </div>
            <? } ?>
        </div>
    </div>
</div>


<?
include '../footer.php';
?>