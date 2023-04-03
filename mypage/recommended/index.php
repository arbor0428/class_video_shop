<?
include '../../header.php';
$side_menu = 1;
$topTxt01 = '맞춤 강좌';

include '../location01.php';

$main_query = "SELECT *, (SELECT COUNT(1) FROM ks_wish WHERE ks_wish.userid='$GBL_USERID' AND ks_class.uid=ks_wish.class_uid) AS is_wish FROM ks_class WHERE status=1";
$limit = 3;
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="s_cont_tit f20 bold2 c_bora01">맞춤 강좌</div>
            <div class="top_searchBar">
                <div class="inputwrap dp_f dp_end02">
                    <input class="search" type="text" placeholder="원하시는 강좌를 검색해보세요." value="" name="">
                    <a class="searchBtn bora01 c_w dp_f dp_c dp_cc" href="" title="검색">검색</a>
                </div>
            </div>
            <div class="dp_f dp_wrap">
                <?
                $row_arr = sqlArray($main_query . " ORDER BY uid LIMIT " . $limit);
                foreach ($row_arr as $row) {
                ?>
                    <div class="nVdSlickBox">
                        <a href="/sub01/view.php?&code=<?= $row['uid'] ?>" title="<?= $row['title'] ?>">
                            <div class="imgWrap c_gry02 p_r" style="background-image: url('/upfile/class/<?= $row['upfile01'] ?>')">
                                <button type="button" title="관심" class="likeMark <? if ($row['is_wish']) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $row['uid'] ?>"></button>
                            </div>
                            <div class="nVdCont">
                                <div class="nVdTop">
                                    <p class="nVdtit01 bold2 dotdot"><?= $row['title'] ?></p>
                                    <p class="nVdtit02 c_gry03 dotdot"><?= $row['exp'] ?></p>
                                    <ul class="clickicon dp_f dp_c">
                                        <li class="dp_f dp_c">
                                            <img src="/images/likeChk.svg" alt="">
                                            <span><?= $row['wish'] ?></span>
                                        </li>
                                        <li class="dp_f dp_c">
                                            <img src="/images/bestChk.svg" alt="">
                                            <span><?= $row['hit'] ?>%</span>
                                        </li>
                                    </ul>
                                </div>
                                <div><?= price_tag($row['price'], $row['discountPrice'], $row['discountRate'], $row['period']) ?></div>
                            </div>
                        </a>
                    </div>
                <?
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?
include '../../footer.php';
?>