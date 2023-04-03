<?
include '../header.php';
$side_menu = 1;
$side_menu02 = 1;

if (isEmpty($_GET['cade01'])) die("/sub01");
else if (isEmpty($_GET['cade02'])) die("/sub01");
else if (isEmpty($_GET['cade03'])) die("/sub01");
else {
    $cade01 = $_GET['cade01'];
    $cade02 = $_GET['cade02'];
    $cade03 = $_GET['cade03'];
}

?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include 'sidemenu.php';
        $cade01_title = sqlRowOne("select title from ks_class_cade01 where uid=$cade01");
        $cade02_title = sqlRowOne("select title from ks_class_cade02 where uid=$cade02");
        $cade03_title = sqlRowOne("select title from ks_class_cade03 where uid=$cade03");
        ?>
        <div class="s_cont">
            <div class="s_cont_tit02 dp_f dp_c bor_bot">
                <span class="f20 regular line dp_f dp_c"><?= $cade01_title ?></span>
                    <!-- <a href="" title="전체">전체</a>-->
                
                <!-- <span class="f20 regular line dp_f dp_c">체형분석 전문가</span> -->
                <span class="f20 regular line dp_f dp_c">
                    <!-- <a href="/sub01/sub01.php?&cade01=<?= $cade01 ?>" title="<?= $cade01_title ?>"></a> -->
                        <?= $cade02_title ?>
                </span>
                <!-- <span class="f20 bold2 c_bora01">하위메뉴</span> -->
                <span class="f20 bold2 c_bora01">
                    <!-- <a href="/sub01/sub01.php?&cade01=<?= $cade01 ?>&cade02=<?= $cade02 ?>" title="<?= $cade02_title ?>"></a> -->
                        <?= $cade03_title ?>
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

            <!----->
            <div class="all_list_wrap">
                <div class="dp_f dp_wrap">

                    <?
                    $query2 = "SELECT *, (SELECT COUNT(1) FROM ks_wish WHERE ks_wish.userid='$GBL_USERID' AND ks_class.uid=ks_wish.class_uid) AS is_wish";
                    $query2 .= " FROM ks_class";
                    $query2 .= " WHERE status='1' AND cade01=$cade01 AND cade02=$cade02 AND cade03=$cade03";
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

                    <!-- <div class="nVdSlickBox">
						<a href="./view.php" title="">
							<div class="imgWrap c_gry02 p_r">
								<button type="button" title="관심" class="likeMark"></button>
								<img src="" alt="">
							</div>
							<div class="nVdCont">
								<div class="nVdTop">
									<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
									<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
									<ul class="clickicon dp_f dp_c">
										<li class="dp_f dp_c">
											<img src="/images/likeChk_gry.png" alt="">
											<span>10884</span>
										</li>
										<li class="dp_f dp_c">
											<img src="/images/bestChk_gry.png" alt="">
											<span>97%</span>
										</li>
									</ul>
								</div>
								<div class="nVdBot">
									<p class="c_gry03">500,000원</p>
									<span class="c_red bold">46%</span>
									<span class="priceDet bold">월 89,000원</span>
									<span class="monDet">(12개월)</span>
								</div>
							</div>
						</a>
					</div> -->
                </div>
            </div>
            <!----->

        </div>
    </div>
</div>



<?
include '../footer.php';
?>