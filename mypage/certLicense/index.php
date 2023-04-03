<?
include '../../header.php';
$side_menu = 9;
$topTxt01 = '자격증 발급';

$query = "SELECT l.license_uid, l.progress, c.title 
    FROM ks_learning_license l
    JOIN ks_class_set c ON l.license_uid=c.uid 
    WHERE l.userid='$GBL_USERID' AND l.progress>=80";

$row_arr = sqlArray($query);
$row_num = sqlRowCount($query);
?>

<?
include '../location02.php';
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="s_cont_tit">
                <span class="m_s_cont_tit">자격증 발급</span>
                <ul class="s_cont_tabbtn dp_f">
                    <li><a href="/mypage/learning/">수강중인 강좌</a></li>
                    <li><a href="/mypage/wish/">찜한 강좌</a></li>
                    <li><a href="/mypage/qna/">나의 학습질문</a></li>
                    <li><a href="/mypage/review/">나의 리뷰</a></li>
                    <li><a href="/mypage/certClass/">수강증 발급</a></li>
                    <li><a href="/mypage/certCompletion/">수료증 발급</a></li>
                    <li class="on"><a href="/mypage/certLicense/">자격증 발급</a></li>
                </ul>
            </div>
            <p class="c_gry04 f14 m_40">진도율 80% 이상시 시험 응시 가능하며, 시험 합격시 수료증을 발급 받을 수 있습니다.</p>
            <div class="tableWrap">
                <a href="javascript:void(0)" class="m_10 f14 testStatus dp_f dp_c dp_cc on bora c_w" onclick="searchCert()">자격증 조회</a>
                <table class="subTbl certi certiTbl">
                    <tbody>
                        <tr class="brb000">
                            <th>자격증명</th>
                            <th>내 진도율</th>
                            <th>비고</th>
                        </tr>

                        <?
                        if ($row_num > 0) {
                            foreach ($row_arr as $key => $row) {
                                $class_set_uid = $row['class_set_uid'];
                                $query2 = "SELECT * FROM ks_cert_license WHERE userid='$GBL_USERID' AND class_set_uid='$class_set_uid'";
                                $row_num2 = sqlRowCount($query2);

                                $testTxt = ($row_num2 > 0) ? "자격증 발급" : "시험 응시";
                        ?>
                                <tr>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['progress'] ?>%</td>
                                    <td>
                                        <div class="testStatus dp_f dp_c dp_cc <? if ($row_num2 > 0) echo 'on certifi_printBtn' ?>" data-tid="<?= $row['class_set_uid'] ?>"><?= $testTxt ?></div>
                                    </td>
                                </tr>
                            <? } ?>
                        <?
                        } else {
                        ?>
                            <tr class="noResult">
                                <td colspan="3">수강 자격증 강좌가 없습니다.</td>
                            </tr>
                        <?
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const searchCert = function() {
        $('#cerSearchFrame').html("<iframe src='../cert/search.php' name='memberFrame' style='width:100%;height:250px;' frameborder='0' scrolling='auto'></iframe>");
        $('.cerSearch_open').click();
    }

    function tema(t) {
        $('#cerPrintFrame').html("<iframe src='../cert/license.php?uid=" + t + "' name='' style='width:100%;height:764px;' frameborder='0' scrolling='auto'></iframe>");
        $('.cerPrint_open').click();
    }

    $(".certifi_printBtn").click(function(event) {
        tid = $(this).data('tid');
        tema(tid);
        event.preventDefault();
        $("html, body").addClass("not_scroll");
    });
</script>


<?
include '../../footer.php';
?>