<?
include '../../header.php';
$side_menu = 4;
$topTxt01 = '찜한 강좌';

include '../location02.php';

$query = "SELECT c.*
FROM ks_class c
JOIN ks_wish w
ON c.uid=w.class_uid
WHERE c.`status`=1 AND w.userid='$GBL_USERID'";
?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="s_cont_tit">
                <span class="m_s_cont_tit">찜한 강좌</span>
                <ul class="s_cont_tabbtn dp_f">
                    <li><a href="/mypage/learning/">수강중인 강좌</a></li>
                    <li class="on"><a href="/mypage/wish/">찜한 강좌</a></li>
                    <li><a href="/mypage/qna/">나의 학습질문</a></li>
                    <li><a href="/mypage/review/">나의 리뷰</a></li>
                    <li><a href="/mypage/certClass/">수강증 발급</a></li>
                    <li><a href="/mypage/certCompletion/">수료증 발급</a></li>
                    <li><a href="/mypage/certLicense/">자격증 발급</a></li>
                </ul>
            </div>
            <div class="top_searchBar dp_sb">
                <div class="dp_f">
                    <div class="selectwrap dp_f dp_c">
                        <p class="select_tit c_gry04 f14">정렬 기준</p>
                        <select name="" id="">
                            <option value="">최신순</option>
                            <option value="">평점순</option>
                            <option value="">인기순</option>
                        </select>
                    </div>
                </div>
                <div class="inputwrap dp_f">
                    <input class="search" type="text" placeholder="강좌명으로 검색" value="" name="">
                    <a class="searchBtn bora01 c_w dp_f dp_c dp_cc" href="" title="검색">검색</a>
                </div>
            </div>
            <div class="dp_f dp_wrap">
                <?
                $row_arr = sqlArray($query);
                $num_row = sqlRowCount($query);
                if ($num_row > 0) {
                    foreach ($row_arr as $row) {
                ?>
                        <div class="nVdSlickBox">
                            <a href="/sub01/view.php?&code=<?= $row['uid'] ?>" title="<?= $row['title'] ?>">
                                <div class="imgWrap c_gry02 p_r" style="background-image: url('/upfile/class/<?= $row['upfile01'] ?>')">
                                    <!-- <button type="button" title="관심" class="likeMark <? if ($row['is_wish']) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $row['uid'] ?>"></button> -->
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
                    <? }
                } else { ?>
                    <div class="noListShow">
                        <p class="txt-c bold2">찜한 강좌가 없습니다.</p>
                        <p class="txt-c c_gry04 f15">나를 성장 시켜줄 좋은 강좌들을 찾아보세요.</p>
                        <a class="goClassList c_bora01 dp_f dp_c dp_cc" href="/sub01" title="강좌리스트 보러가기">강좌리스트 보러가기</a>
                    </div>

                <? } ?>
            </div>
        </div>
    </div>
</div>


<?
include '../../footer.php';
?>