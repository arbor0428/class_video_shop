<?
include '../../header.php';
$side_menu = 6;
$topTxt01 = '나의 리뷰';

include '../location02.php';

$query = "SELECT c.uid, c.title
    FROM ks_learning l
    LEFT JOIN ks_class c ON l.class_uid=c.uid
    LEFT JOIN ks_review r ON l.class_uid=r.class_uid
    WHERE l.userid='$GBL_USERID' AND r.class_uid IS NULL
    ORDER BY l.uid DESC";

$num_row = sqlRowCount($query);
$row_arr = sqlArray($query);

$query2 = "SELECT c.title, r.content, r.rDate 
    FROM ks_review r 
    JOIN ks_class c ON r.class_uid=c.uid
    WHERE r.userid='$GBL_USERID'";

$num_row2 = sqlRowCount($query2);
$row_arr2 = sqlArray($query2);
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="s_cont_tit m_10">
                <span class="m_s_cont_tit">나의 리뷰</span>
                <ul class="s_cont_tabbtn dp_f">
                    <li><a href="/mypage/learning/">수강중인 강좌</a></li>
                    <li><a href="/mypage/wish/">찜한 강좌</a></li>
                    <li><a href="/mypage/qna/">나의 학습질문</a></li>
                    <li class="on"><a href="/mypage/review/">나의 리뷰</a></li>
                    <li><a href="/mypage/certClass/">수강증 발급</a></li>
                    <li><a href="/mypage/certCompletion/">수료증 발급</a></li>
                    <li><a href="/mypage/certLicense/">자격증 발급</a></li>
                </ul>
            </div>
            <p class="c_gry04 f14 m_40">내가 수강한 강좌에 대한 리뷰를 남겨보세요!</p>

            <div class="top_searchBar dp_sb">
                <div class="dp_f">
                    <div class="selectwrap dp_f dp_c">
                        <select name="" id="tab-select">
                            <option value="0" id="tab1">작성 가능한 리뷰</option>
                            <option value="1">작성한 리뷰</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="showWayWrap">
                <!--리뷰 list 보여지는 부분-->
                <div id="tab01" class="tableWrap showWayBox">
                    <table class="subTbl reviewTbl">
                        <tbody>
                            <tr class="brb000">
                                <th>강좌명</th>
                            </tr>
                            <?
                            if ($num_row > 0) {
                                foreach ($row_arr as $row) {
                            ?>
                                    <tr>
                                        <td>
                                            <?= $row['title'] ?>
                                            <a class="reviewWrt bora01 c_w dp_f dp_c dp_cc" href="javascript:void(0)" onclick="reg_write('<?= $row['uid'] ?>');" title="리뷰 쓰기">리뷰 쓰기</a>
                                        </td>
                                    </tr>
                                <? }
                            } else { ?>
                                <tr class="noResult">
                                    <td>아직 등록하신 리뷰가 없습니다.</td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
                <!--리뷰 view 보여지는 부분-->
                <div id="tab02" class="tableWrap showWayBox">
                    <table class="subTbl reviewedTbl">
                        <tbody>
                            <tr class="brb000">
                                <th>강좌명</th>
                                <th>내용</th>
                                <th>작성일</th>
                            </tr>
                            <?
                            if ($num_row > 0) {
                                foreach ($row_arr2 as $row) {
                            ?>
                                    <tr>
                                        <td><?= $row['title'] ?></td>
                                        <td class="txt-l"><?= $row['content'] ?></td>
                                        <td><?= $row['rDate'] ?></td>
                                    </tr>
                                <? }
                            } else { ?>
                                <tr class="noResult">
                                    <td colspan="3">아직 등록하신 질문이 없습니다.</td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form name="frm01" action="./write.php" method="post">
    <input type="hidden" name="uid" value="">
</form>

<script>
    /* select tab function */
    var selectTab = document.getElementById("tab-select"); // select 저장
    var con = document.getElementsByClassName("showWayBox"); // select 에 대응하는 콘텐츠 요소들 저장 
    selectTab.addEventListener("change", function() { // select가 변화할 때 
        var val = selectTab.options[selectTab.selectedIndex].value; // option value값
        for (var i = 0; i < selectTab.length; i++) {
            con[i].style.display = "none"; // 콘텐츠 모두 숨김
            if (val == i) { // select에 해당하는 콘텐츠가 보여짐

                con[i].style.display = "block";

            }
        }
    });

    const reg_write = function(uid) {
        document.frm01.uid.value = uid
        document.frm01.submit()
    }
</script>

<?
include '../../footer.php';
?>