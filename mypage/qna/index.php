<?
include '../../header.php';
$side_menu = 5;
$topTxt01 = '나의 학습질문';

include '../location02.php';

$query = "SELECT q.*, l.uid, c.title ctitle 
    FROM ks_qna q
    LEFT JOIN ks_learning l ON q.learning_uid=l.uid
    JOIN ks_class c ON q.class_uid=c.uid
    WHERE q.userid='$GBL_USERID'";

// if (isset($_teacher))  $query .= " AND c.uid='$_teacher'";
if (isset($_class)) $query .= " AND l.uid='$_class'";
else $_class = '';

$query .= " ORDER BY q.rDate DESC";

$row_qna = sqlArray($query);
$row_num_qna = sqlRowCount("SELECT * FROM ks_qna WHERE userid='$GBL_USERID'");

// $row_mem = sqlArray("SELECT * FROM ks_member WHERE mType='T'");
// $row_learn = sqlArray("SELECT * FROM ks_learning WHERE userid='$GBL_USERID'");
?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="s_cont_tit m_10">
                <span class="m_s_cont_tit">나의 학습질문</span>
                <ul class="s_cont_tabbtn dp_f">
                    <li><a href="/mypage/learning/">수강중인 강좌</a></li>
                    <li><a href="/mypage/wish/">찜한 강좌</a></li>
                    <li class="on"><a href="/mypage/qna/">나의 학습질문</a></li>
                    <li><a href="/mypage/review/">나의 리뷰</a></li>
                    <li><a href="/mypage/certClass/">수강증 발급</a></li>
                    <li><a href="/mypage/certCompletion/">수료증 발급</a></li>
                    <li><a href="/mypage/certLicense/">자격증 발급</a></li>
                </ul>
            </div>
            <p class="c_gry04 f14 m_40">공부하다 궁금한 점이 있으면 질문을 남겨주세요. 에듀핌 강사님들과 전문 연구진이 답변을 달아드립니다.</p>
            <div class="top_searchBar dp_sb">
                <div class="dp_f">
                    <!-- <div class="selectwrap dp_f dp_c">
                        <select name="" id="">
                            <option value="">강사님 선택</option>
                        </select>
                    </div> -->
                    <div class="selectwrap dp_f dp_c wid500">
                        <select name="class-selected" id="" onchange="reg_sort()">
                            <option value="">강좌 전체</option>
                            <?
                            $row_arr = sqlArray("SELECT l.*, c.title FROM ks_learning l JOIN ks_class c ON l.class_uid=c.uid WHERE l.userid='$GBL_USERID'");
                            foreach ($row_arr as $row) {
                            ?>
                                <option value="<?= $row['uid'] ?>" <? if ($row['uid'] == $_class) echo "selected"; ?>><?= $row['title'] ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <!-- <a class="searchBtn02 bora01 c_w dp_f dp_c dp_cc" href="javascript:void(0)" onclick="reg_write('<?= $row['uid'] ?>');" title="학습 질문하기">학습 질문하기</a> -->
                <a class="searchBtn02 bora01 c_w dp_f dp_c dp_cc" href="./write.php" title="학습 질문하기">학습 질문하기</a>
            </div>
            <div class="tableWrap">
                <table class="subTbl myClassQna">
                    <tbody>
                        <tr class="brb000">
                            <th>강좌 정보</th>
                            <th>문의 내역</th>
                            <th>작성일</th>
                            <th>답변유무</th>
                        </tr>

                        <?
                        if ($row_num_qna > 0) {
                            if ($status == 0)        $statusEle = '<div class="replyStatus dp_f dp_c dp_cc" href="" title="답변 대기">답변 대기</div>';
                            elseif ($status == 1)    $statusEle = '<div class="replyStatus dp_f dp_c dp_cc on" href="" title="답변 완료">답변 완료</div>';
                        ?>
                            <? foreach ($row_qna as $row) { ?>
                                <tr>
                                    <td><?= $row['ctitle'] ?></td>
                                    <td>
                                        <p><?= $row['content'] ?></p>
                                    </td>
                                    <td><?= $row['rDate'] ?></td>
                                    <td><?= $statusEle ?></td>
                                </tr>

                            <? }
                        } else { ?>
                            <tr class="noResult">
                                <td colspan="4">아직 등록하신 질문이 없습니다.</td>
                            </tr>
                        <? } ?>

                        <!-- <tr>
                                <td>22년 필라테스 지도자 자격증 과정</td>
                                <td>
                                    <p>문의 드리겠습니다.</p>
                                </td>
                                <td>2022-09-28</td>
                                <td>
                                    <div class="replyStatus dp_f dp_c dp_cc" href="" title="답변 대기">답변 대기</div>
                                </td>
                            </tr> -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- <form name="frm01" action="<?= $_SERVER['PHP_SEFT'] ?>" method="post">
    <input type="hidden" name="uid" value="">
    <input type="hidden" name="sort_class" value="">
</form> -->

<script>
    const selfUrl = '<?= $_SERVER['PHP_SEFT'] ?>';
    const reg_sort = function() {
        const _class = $('select[name=class-selected]').val()
        if (_class == '') location.href = '/mypage/qna/'
        else location.href = selfUrl + "?_class=" + _class
        
    }

    const reg_write = function(uid) {
        document.frm01.uid.value = uid
        document.frm01.submit()
    }
</script>

<?
include '../../footer.php';
?>