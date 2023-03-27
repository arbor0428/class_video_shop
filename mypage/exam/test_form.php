<?
include '/home/edufim/www/header.php';

// 진입 페이지 체크
$num_row = sqlRowCount("SELECT * FROM ks_exam WHERE pid=$class_uid ORDER BY qnum");
if($num_row != 10) {
    Msg::goMsg('시험이 준비중입니다.', '/mypage/learning/');
    exit;
}

$rDate = date('Y-m-d');

$row_num = sqlRowCount("SELECT * FROM ks_cert_completion WHERE learning_uid='$learning_uid' AND userid='$GBL_USERID'");

if (!$row_num) {
    $query = "INSERT INTO ks_cert_completion (status, type, learning_uid, class_uid, userid, title, remained_num, rDate)";
    $query .= " VALUES ('0', 'CLASS', '$learning_uid', '$class_uid', '$GBL_USERID', '수료증', '2', '$rDate')";
    echo $query;
    sqlExe($query);
} else {
    $remained_num = sqlRowOne("SELECT remained_num FROM ks_cert_completion WHERE learning_uid='$learning_uid'");
    $remained_num = intval($remained_num) - 1;
    if ($remained_num < 0) $remained_num = 0;

    $query = "UPDATE ks_cert_completion SET remained_num='$remained_num', rDate='$rDate' WHERE learning_uid='$learning_uid'";
    sqlExe($query);
}

$result = sqlExe("UPDATE ks_member SET eng_name='$eng_name' WHERE userid='$GBL_USERID'");
$row_arr = sqlArray("SELECT * FROM ks_exam WHERE pid=$class_uid ORDER BY qnum");

?>

<div class="subWrap">
    <div class="s_center">
        <div class="test_goBox">
            <div class="test_go_top bora01 dp_sb">
                <p class="test_go_top_tit dp_f dp_c">
                    <span class="dp_f dp_c bold2 c_w">에듀핌</span>
                    <span class="c_w">- <?= $ctitle ?> [필기시험]</span>
                </p>
                <a class="test_closeBtn" href="http://edufim.smilework.kr/mypage/sub08.php" title="뒤로가기">
                    <img src="../images/sub/test_go_x_icon.svg" alt="">
                </a>
            </div>
            <div class="test_go_bot">
                <div class="gry04 test_gry_box">
                    <div class="row dp_f dp_c">
                        <div class="row_tit">응시자</div>
                        <div class="row_det"><?= $name ?> (<?= $GBL_USERID ?>)</div>
                    </div>
                    <div class="row dp_f dp_c">
                        <div class="row_tit">응시강좌</div>
                        <div class="row_det"><?= $ctitle ?></div>
                    </div>
                    <div class="row dp_f dp_c">
                        <div class="row_tit">응시일</div>
                        <div class="row_det"><?= $edate ?></div>
                    </div>
                </div>
                <div class="test_chk_wrap dp_sb">
                    <div class="test_quest">
                        <h3 class="c_bora01 bold2">시험 시작</h3>

                        <? foreach ($row_arr as $key => $row) { ?>
                            <div class="quest_box">
                                <p class="quest_tit bold2 dp_f"><span><?= $row['qnum'] ?>.</span>&nbsp;<span><?= $row['qtitle'] ?></span></p>
                                <ul class="quest_det">
                                    <li class="picked<?= $row['qnum'] ?> picked_<?= $row['qnum'] ?>_01" data_filter="<?= $row['qnum'] ?>">① <?= $row['q1'] ?></li>
                                    <li class="picked<?= $row['qnum'] ?> picked_<?= $row['qnum'] ?>_02" data_filter="<?= $row['qnum'] ?>">② <?= $row['q2'] ?></li>
                                    <li class="picked<?= $row['qnum'] ?> picked_<?= $row['qnum'] ?>_03" data_filter="<?= $row['qnum'] ?>">③ <?= $row['q3'] ?></li>
                                    <li class="picked<?= $row['qnum'] ?> picked_<?= $row['qnum'] ?>_04" data_filter="<?= $row['qnum'] ?>">④ <?= $row['q4'] ?></li>
                                </ul>
                            </div>
                        <? } ?>

                    </div>
                    <div class="test_answer">
                        <div class="test_answer_pin_box">
                            <p class="test_answer_tit bora01 c_w">답안</p>
                            <ul class="answer_wrap">

                                <?
                                foreach ($row_arr as $key => $row) {
                                    $qnum = (intval($row['qnum'] / 10) == 0) ? '0' . $row['qnum'] : $row['qnum'];
                                ?>
                                    <li class="dp_f dp_c">
                                        <div class="answer_nmbr bold2"><?= $qnum ?>.</div>
                                        <ul class="four_cir_wrap dp_f dp_c">
                                            <li>
                                                <a class="dp_f dp_c dp_cc" href="" title="1" data_seq="<?= $row['qnum'] ?>_01">1</a>
                                                <div class="point_chk"></div>
                                            </li>
                                            <li>
                                                <a class="dp_f dp_c dp_cc" href="" title="2" data_seq="<?= $row['qnum'] ?>_02">2</a>
                                                <div class="point_chk"></div>
                                            </li>
                                            <li>
                                                <a class="dp_f dp_c dp_cc" href="" title="3" data_seq="<?= $row['qnum'] ?>_03">3</a>
                                                <div class="point_chk"></div>
                                            </li>
                                            <li>
                                                <a class="dp_f dp_c dp_cc" href="" title="4" data_seq="<?= $row['qnum'] ?>_04">4</a>
                                                <div class="point_chk"></div>
                                            </li>
                                        </ul>
                                    </li>
                                <? } ?>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="two_btn_wrap dp_f dp_c dp_cc">
                    <a class="two_btn dp_f dp_c dp_cc bold2 bora01 c_w" href="javascript:void(0)" onclick="checkSubmit()" title="답안제출">
                        답안제출
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<form name="frm01" action="./test_result_form.php" method="post">
    <input type="hidden" name="class_uid" value="<?= $class_uid ?>">
    <input type="hidden" name="learning_uid" value="<?= $learning_uid ?>">
    <input type="hidden" name="name" value="<?= $name ?>">
    <input type="hidden" name="ctitle" value="<?= $ctitle ?>">
    <input type="hidden" name="edate" value="<?= $edate ?>">
    <input type="hidden" name="p1" value="">
    <input type="hidden" name="p2" value="">
    <input type="hidden" name="p3" value="">
    <input type="hidden" name="p4" value="">
    <input type="hidden" name="p5" value="">
    <input type="hidden" name="p6" value="">
    <input type="hidden" name="p7" value="">
    <input type="hidden" name="p8" value="">
    <input type="hidden" name="p9" value="">
    <input type="hidden" name="p10" value="">
</form>

<script>
    const checkSubmit = function() {
        let isAllChecked = true

        for (let i = 1; i < 11; i++) {
            if ($('input[name=p' + i + ']').val() == '') {
                isAllChecked = false
                break
            }
        }

        if (isAllChecked) {
            GblMsgConfirmBox('제출 하시겠습니까?', 'regResult()')

        } else {
            // GblMsgConfirmBox('선택하지 않은 문항이 있습니다. 정말 제출 하시겠습니까?', form.submit())
            GblMsgBox('체크하지 않은 문제가 있습니다')
        }

    }

    const regResult = function() {
        const form = document.frm01
        form.submit()
    }

    $(".four_cir_wrap > li > a").on("click", function(event) {

        event.preventDefault();

        const pickseq = $(this).attr('data_seq');
        const otherseq = $('.picked_' + pickseq).attr('data_filter');

        //답안 상태 변경
        $(this).parent().siblings().children(".point_chk").removeClass("on");
        $(this).siblings(".point_chk").addClass("on");

        //문제 상태 변경
        $('.picked' + otherseq).removeClass("picked");
        $('.picked_' + pickseq).addClass("picked");

        // set value
        $('input[name=p' + otherseq + ']').val(pickseq.substr(-1))
    });
</script>

<?
include '/home/edufim/www/footer.php';
?>