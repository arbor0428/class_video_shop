<?
include '../header.php';

define('_NAME', '국제인증자격증과정');
define('_UPLOAD_DIR', '/upfile/license/');

$cade01 = sqlRowOne("SELECT uid FROM ks_license_cade01 WHERE title='" . _NAME . "'");

$query = "SELECT * FROM ks_license WHERE status='1' AND cade01='$cade01'";
$result = mysql_query($query) or die(mysql_error());
?>

<div class="subWrap">
    <div class="s_center">
        <div class="bora c_w sideTit f22 bold2 sideTit dp_inline dp_c dp_cc"><?= _NAME ?></div>
        <div class="dp_f dp_wrap nVdSlickBox_04_wrap hght150">

            <?
            while ($row = mysql_fetch_assoc($result)) {
                foreach ($row as $k => $v) {
                    ${$k} = $v;
                }
            ?>
                <div class="nVdSlickBox">
                    <a href="./view.php?code=<?= $uid ?>" title="<?= $title ?>">
                        <div class="imgWrap c_gry02 p_r">
                            <!-- <button type="button" title="관심" class="likeMark <? if ($isWish) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $uid ?>" data-ctype="<?= _CTYPE ?>"></button> -->
                            <img src="<?= _UPLOAD_DIR . $upfile01 ?>" alt="<?= $title ?>" width="276" height="150">
                        </div>
                        <div class="nVdCont">
                            <div class="nVdTop">
                                <p class="nVdtit01 bold2 dotdot"><?= $title ?></p>
                                <p class="nVdtit02 c_gry03 dotdot"><?= $exp ?></p>
                                <!-- <ul class="clickicon dp_f dp_c">
									<li class="dp_f dp_c">
										<img src="/images/likeChk_gry.png" alt="wish">
										<span><?= $wish ?></span>
									</li>
									<li class="dp_f dp_c">
										<img src="/images/bestChk_gry.png" alt="like">
										<span><?= $like ?>%</span>
									</li>
								</ul> -->
                            </div>
                            <div><?= price_tag($row['price'], $row['discountPrice'], $row['discountRate'], $row['period']) ?></div>
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