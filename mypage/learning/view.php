<?
include '/home/edufim/www/header.php';
if (!isLogin()) redirectLogin();
if (isEmpty($uid))  deny("/mypage/learning/");

// Learning info
$query = "SELECT c.*, l.*";
$query .= " FROM ks_learning l";
$query .= " JOIN ks_class c ON l.class_uid=c.uid";
$query .= " WHERE l.uid=$uid";

$result = mysql_query($query) or die('Could not connect: ' . mysql_error());
$num_row = mysql_num_rows($result);
if ($num_row == 0) die("구매하지 않은 강의입니다.");
$row = mysql_fetch_assoc($result);

// Learning - class list
$class_uid = $row['class_uid'];
$query2 = "SELECT l.*, k.updated_at, k.progress_values, v.length
FROM ks_class_list l
LEFT JOIN kollus_progress_relations k ON l.kollus_video_id=k.video_id AND k.member_id='$GBL_UID'
JOIN kollus_video v ON l.kollus_video_id=v.id
WHERE l.class_uid='$class_uid'
ORDER BY l.sort";

if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
    echo $query2;
}

// $query = "SELECT *
// FROM ks_learning l
// RIGHT JOIN ks_learning_list ll ON l.uid=ll.learning_uid
// LEFT JOIN ks_class_list cl ON ll.class_list_uid=cl.uid
// LEFT JOIN kollus_progress_relations k ON cl.kollus_video_id=k.video_id
// WHERE l.uid='$uid'
// ORDER BY cl.sort";

$result2 = mysql_query($query2) or die('Could not connect: ' . mysql_error());
$num_row2 = mysql_num_rows($result2);

/**
 * kollus video setting
 */
if (empty($_POST['class_list_uid'])) {
    $isInitView = true;
} else {
    $isInitView = false;
    include _WWW . "/module/kollus/config.php";

    // recent date setting
    $recentDate = time();
    sqlExe("UPDATE ks_learning SET recentDate='$recentDate' WHERE userid='$GBL_USERID' AND uid='$uid'");

    // kollus video setting
    $class_list_uid = $_POST['class_list_uid'];

    $kollus_video_id = sqlRowOne("SELECT kollus_video_id FROM ks_class_list WHERE uid='$class_list_uid'");

    // kollus_video
    $video_row = sqlRow("SELECT * FROM kollus_video WHERE id='$kollus_video_id'");

    // kollus_progress_relations
    $progress_relations_row = sqlRow("SELECT * FROM kollus_progress_relations WHERE id='$kollus_video_id' AND member_id='$GBL_UID'");

    // kollus_progress_datas
    $progress_datas_row = sqlRow("SELECT * FROM kollus_progress_datas WHERE progress_relation_id='" . $progress_relations_row['id'] . "'");

    $mediaContentKey = $video_row['media_content_key'];

    $clientUserId = $GBL_USERID;
    $expireTime = 60;

    $mediaItems = array(
        array(
            'media_content_key' => $mediaContentKey,
            'intr' => true,
            'is_seekable' => true,
        ),
    );

    $payload = array(
        'mc' => array(),
        'cuid' => $clientUserId,
        'expt' => time() + $expireTime,
    );

    foreach ($mediaItems as $mediaItem) {
        $mcClaim = array();
        $mcClaim['mckey'] = $mediaItem['media_content_key'];
        //    $mcClaim['mcpf'] = $mediaProfileKey;
        //    $mcClaim['intr'] = (int)$mediaItem['is_intro'];
        //    $mcClaim['seek'] = (int)$mediaItem['is_seekable'];
        //    $mcClaim['seekable_end'] = $seekableEnd;
        //    $mcClaim['disable_playrate'] = (int)$disablePlayrate;
        $payload['mc'][] = $mcClaim;
    }

    $jwtToken = jwt_encode($payload, $securityKey);

    $customKey = '156789126bb13feaa49d68c402f42b578edea889e48640ecfd3d8dcf5ce7dfd5';

    $webTokenURL = 'http://v.kr.kollus.com/s?&jwt=' . $jwtToken . '&custom_key=' . $customKey . '&uservalue0=' . $uid;
}

?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <div class="detail_cont detail_cont_scroll">
            <p class="detail_cont_scroll_tit bold2"><?= $row['title'] ?></p>
            <p class="detail_cont_scroll_sub_tit bold dp_f dp_c"><?= $row['title'] ?> - <?= $row['target'] ?></p>

            <ul class="dp_f dp_c gry01 class_dayamount_info">
                <li class="f12 dp_f dp_c">총 <?= $num_row2 ?>강</li>
                <li class="f12">수강기간 <?= $row['period'] ?>일</li>
            </ul>
            <div class="progress_status_bar dp_sb dp_c">
                <p class="c_bora01 bold2">진도율 <span><?= $row['progress'] ?></span>%</p>
                <p class="progress_status_date dp_f dp_c c_gry04">
                    <span class="dp_f dp_c"><?= ($class_list_sort) ? $class_list_sort : 0 ?> / <?= $num_row2 ?>강</span>
                    <span>최근 수강일: <? echo ($row['recentDate'] != null) ? date('Y-m-d H:i', $row['recentDate']) : "미수강"; ?></span>
                </p>
            </div>
            <div class="video_progress">
                <div class="progressBar_wrap dp_sb dp_c">
                    <div class="progressBar" style="width: 100%;">
                        <div class="progressBar_fill" style="width: <?= $row['progress'] ?>%;"></div>
                    </div>
                </div>
            </div>

            <!--비디오-->
            <div class="detail_sum">
                <? if ($isInitView) { ?>
                    <img src="/upfile/class/<?= $row['upfile01'] ?>">
                <? } else { ?>
                    <iframe src="<?php echo $webTokenURL; ?>" allowfullscreen></iframe>
                <? } ?>
            </div>

            <!-- 강의자료 -->
            <div class="detail_cont_sub_tit">
                <span class="bora01 c_w bold2">강의 자료</span>
            </div>
            <div>
                <ul>
                    <li><a href="/upfile/class/<?= $row['upfile02'] ?>" download="<?= $row['realfile02'] ?>"><?= $row['realfile02'] ?></a></li>
                    <li><a href="/upfile/class/<?= $row['upfile03'] ?>" download="<?= $row['realfile03'] ?>"><?= $row['realfile03'] ?></a></li>
                    <li><a href="/upfile/class/<?= $row['upfile04'] ?>" download="<?= $row['realfile04'] ?>"><?= $row['realfile04'] ?></a></li>
                    <li><a href="/upfile/class/<?= $row['upfile05'] ?>" download="<?= $row['realfile05'] ?>"><?= $row['realfile05'] ?></a></li>
                    <li><a href="/upfile/class/<?= $row['upfile06'] ?>" download="<?= $row['realfile06'] ?>"><?= $row['realfile06'] ?></a></li>
                </ul>
            </div>


            <!---나의 학습질문--->
            <div class="detail_cont_sub_tit">
                <span class="bora01 c_w bold2">나의 학습질문</span>
            </div>
            <div class="detail_cont_subcont detail_subcont br_bot_gry">
                <?
                $qna_query = "SELECT q.*, m.name FROM ks_qna q JOIN ks_member m ON q.userid=m.userid WHERE q.learning_uid='$uid' AND q.userid='$GBL_USERID'";
                $qna_row = sqlRow($qna_query);
                $qna_row_num = sqlRowCount($qna_query);

                if ($qna_row_num > 0) {
                ?>
                    <div class="review_box_wrap">
                        <div class="review_box">
                            <div class="class_question_box">
                                <div class="dp_sb dp_c">
                                    <div class="per_info_wrap dp_f dp_c">
                                        <div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"><!--프로필 배경 처리--></div>
                                        <div class="per_info">
                                            <p class="bold"><?= $qna_row['name'] ?></p>
                                            <span class="c_gry04"><?= date('Y-m-d H:i', $qna_row['rTime']) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <p class="review_detail f14"><?= $qna_row['content'] ?></p>
                            </div>

                            <div class="class_quest_reply_box">
                                <span class="admin_user dp_inline c_w gry03"><?= $qna_row['tuserid'] ?></span>
                                <p class="f14">
                                <?= $qna_row['tanswer'] ?>
                                </p>
                                <span class="c_gry04 f12"><?= date('Y-m-d H:i', $qna_row['tTime']) ?></span>
                            </div>
                        </div>
                    </div>

                <? } else { ?>
                    <p class="no_statu txt-c c_gry04 f14">
                        강의 수강 중 궁금한 사항이 있나요?
                        <br>
                        질문을 남겨주시면 답변해드립니다.
                    </p>

                <? } ?>
            </div>
            <div class="detail_subcont_btn_wrap dp_f dp_c dp_end02">
                <a class="bora_small_btn c_w bora01 dp_inline dp_c dp_cc" href="/mypage/qna/" title="질문 하기">질문 하기</a>
            </div>



            <div class="detail_cont_sub_tit">
                <span class="bora01 c_w bold2">나의 리뷰</span>
            </div>
            <div class="detail_cont_subcont detail_subcont br_bot_gry">
                <!---나의 리뷰--->
                <?
                $review_query = "SELECT * FROM ks_review WHERE class_uid='$class_uid' AND userid='$GBL_USERID'";
                $review_row = sqlRow($review_query);
                $reivew_row_num = sqlRowCount($review_query);

                if ($reivew_row_num > 0) {
                ?>
                    <div class="review_box_wrap">
                        <div class="review_box">
                            <div class="dp_sb dp_c">
                                <div class="per_info_wrap dp_f dp_c">
                                    <div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"><!--프로필 배경 처리--></div>
                                    <div class="per_info">
                                        <p class="bold"><?= $review_row['userid'] ?></p>
                                        <span class="c_gry04"><?= date('Y-m-d H:i', $review_row['rTime']) ?></span>
                                    </div>
                                </div>
                                <div class="recom_label bora01 dp_inline dp_c">
                                    <img src="/images/sub/thumb_best.svg" alt="">
                                    <span class="c_w f12">추천해요</span>
                                </div>
                            </div>
                            <p class="review_detail f14"><?= $review_row['title'] ?></p>
                        </div>
                    </div>

                <? } else { ?>
                    <p class="no_statu txt-c c_gry04 f14">
                        강의 리뷰를 작성해주시면 수강기간 3일 연장해드립니다.
                        <br>
                        내가 수강한 강좌의 리뷰를 남겨보세요.
                    </p>
                    <div class="detail_subcont_btn_wrap dp_f dp_c dp_end02">
                        <p class="f14">리뷰 작성시 수강기간 <span class="bold2 c_bora01">3일 연장 가능</span></p>
                        <a class="bora_small_btn c_w bora01 dp_inline dp_c dp_cc" href="/mypage/review/" title="리뷰 쓰기">리뷰 쓰기</a>
                    </div>
                <? } ?>
            </div>


        </div>

        <div class="detail_right">
            <div class="pin_scroll_box">
                <div class="bora01 c_w sideTit f20 bold2 dp_inline dp_c dp_cc">강좌 구성</div>
                <div class="per_class_list">
                    <?
                    if ($num_row2 == 0) {
                        echo ("등록된 강좌가 없습니다.");
                    }
                    // Msg::goMsg("등록된 강좌가 없습니다. 관리자에게 문의 바랍니다.", '/mypage/learning.php');
                    // exit;
                    // }
                    else {
                        while ($row2 = mysql_fetch_array($result2)) {
                    ?>
                            <div class="per_class_list_box">
                                <a href="javascript:void(0)" title="<?= $row2['title'] ?>" onclick="showList('<?= $row2['uid'] ?>', '<?= $row2['sort'] ?>');">
                                    <p class="bold2"><? /*<?= $row2['sort'] ?>강. */?><?= $row2['title'] ?></p>
                                    <span class="c_gry04 f12"><?= $row2['exp'] ?></span>
                                    <div class="now_class_status_wrap dp_sb p_r">
                                        <div class="now_class_status_play dp_f dp_c">
                                            <img src="/images/sub/class_proc_play.svg" alt="">
                                            <span><?= gmdate('H:i:s', $row2['length']) ?></span>
                                            <span class="ncsp_line"></span>
                                            <? if ($row2['updated_at'] != null) { ?>
                                                <span class="ncsp_timeline">최근 수강일 : <?= date('y-m-d H:i', $row2['updated_at']) ?></span>
                                            <? } else { ?>
                                                <span class="ncsp_yet">미수강</span>
                                            <? } ?>
                                        </div>
                                        <?
                                        if ($row2['uid'] == $class_list_uid) echo '<div class="now_class_status p_a dp_inline dp_c dp_cc bora01 c_w">수강중</div>';
                                        elseif ($row2['progress_values'] == 1) echo '<div class="now_class_status p_a dp_inline dp_c dp_cc c_gry">수강완료</div>';
                                        ?>
                                        <!--  -->
                                        
                                    </div>
                                </a>
                            </div>
                    <? }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="frm01">
    <input type="hidden" name="uid" value="<?= $uid ?>">
    <input type="hidden" name="class_list_uid" value="<?= $class_list_uid ?>">
    <input type="hidden" name="class_list_sort" value="<?= $class_list_sort ?>">
</form>

<script>
    const showList = function(uid, sort) {
        document.frm01.class_list_uid.value = uid
        document.frm01.class_list_sort.value = sort
        document.frm01.submit()
    }
</script>
<?
include '../../footer.php';
?>