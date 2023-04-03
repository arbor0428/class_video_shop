<?
include '../header.php';
$side_menu = 1;

if (isEmpty($_GET['cade01'])) $cade01 = 1;
else $cade01 = $_GET['cade01'];
?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include 'sidemenu.php';
        $cade01_title = sqlRowOne("select title from ks_class_cade01 where uid='$cade01'");
        ?>
        <div class="s_cont">
            <div class="s_cont_tit02 dp_f dp_c bor_bot">
                <span class="f20 bold2 c_bora01">
                    <!-- <a href="/sub01" title="전체">전체</a> -->
                    <?= $cade01_title ?>
                </span>
            </div>
            <div class="top_searchBar">
                <div class="selectwrap dp_f dp_c">
                    <p class="select_tit c_gry04 f14">정렬 기준</p>
                    <select name="" id="">
                        <option value="">추천순</option>
                        <option value="">인기순</option>
                        <option value="">최신순</option>
                        <option value="">평점순</option>
                    </select>
                </div>
            </div>

            <?
            $query = "SELECT c.*, c2.title title02, c3.title title03 FROM ks_class c";
            $query .= " LEFT JOIN ks_class_cade02 c2 ON c.cade02=c2.uid";
            $query .= " LEFT JOIN ks_class_cade03 c3 ON c.cade03=c3.uid";
            $query .= " WHERE c.cade01='$cade01'";
            $query .= " GROUP BY c.cade02, c.cade03";

            $cade_arr = sqlArray($query);
            foreach ($cade_arr as $cade) {
            ?>
                <div class="all_list_wrap">
                    <div class="s_cont_tit02 dp_f dp_c">
                        <span class="f18 bold2 dp_f dp_c line"><?= $cade['title02'] ?></span>
                        <span class="f18 bold2 c_bora01"><?= $cade['title03'] ?></span>
                    </div>
                    <div class="dp_f dp_wrap">
                        <?
                        // $query2 = "SELECT c.*, w.class_uid";
                        // $query2 .= " FROM ks_class c";
                        // $query2 .= " LEFT JOIN ks_wish w ON c.uid=w.class_uid AND w.userid='$GBL_USERID'";
                        // $query2 .= " WHERE c.cade01=" . $cade['cade01'] . " AND c.cade02=" . $cade['cade02'];
                        // $query2 .= " ORDER BY c.uid";

                        $query2 = "SELECT *, (SELECT COUNT(1) FROM ks_wish WHERE ks_wish.userid='$GBL_USERID' AND ks_class.uid=ks_wish.class_uid) AS is_wish";
                        $query2 .= " FROM ks_class";
                        $query2 .= " WHERE status='1' AND cade01='$cade01' AND cade02='" . $cade['cade02'] . "' AND cade03='" . $cade['cade03'] . "'";
                        $query2 .= " ORDER BY uid";

                        $row_arr = sqlArray($query2);
                        foreach ($row_arr as $row) {
                        ?>
                            <div class="nVdSlickBox">
                                <a href="/sub01/view.php?&code=<?= $row['uid'] ?>" title="<?= $row['title'] ?>">
                                    <div class="imgWrap c_gry02 p_r">
                                        <button type="button" title="관심" class="likeMark <? if ($row['is_wish']) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $row['uid'] ?>"></button>
                                        <img src="/upfile/class/<?= $row['upfile01'] ?>" alt="<?= $row['title'] ?>" width="315">
                                    </div>
                                    <div class="nVdCont">
                                        <div class="nVdTop">
                                            <p class="nVdtit01 bold2 dotdot"><?= $row['title'] ?></p>
                                            <p class="nVdtit02 c_gry03 dotdot"><?= $row['exp'] ?></p>
                                            <ul class="clickicon dp_f dp_c">
                                                <li class="dp_f dp_c">
                                                    <img src="/images/likeChk_gry.png" alt="">
                                                    <span><?= $row['wish'] ?></span>
                                                </li>
                                                <li class="dp_f dp_c">
                                                    <img src="/images/bestChk_gry.png" alt="">
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
            <?
            }
            ?>
        </div>
    </div>
</div>

<?
include '../footer.php';
?>