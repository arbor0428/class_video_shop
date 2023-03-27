<?
include '/home/edufim/www/header.php';

$score = 0;

for ($i = 1; $i < 11; $i++) {
  $a1 = sqlRowOne("SELECT a1 FROM ks_exam WHERE pid='$class_uid' AND qnum='$i' ORDER BY qnum");

  if ($a1 == ${'p' . $i}) $score += 10;
}

$isPass = ($score >= 80) ? true : false;
$result = $isPass ? '합격' : '불합격';

if ($isPass) {
  $time = time();
//   $code = $GBL_USERID . '-' . substr($time, 0, 3) . '-' . substr($time, 3, 3) . '-' . substr($time, 6, 4);
  $code = 'C' . date('Ym') . '-' . time();
  sqlExe("UPDATE ks_cert_completion SET status=1, code='$code' WHERE userid='$GBL_USERID' AND class_uid='$class_uid'");
}

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
        <div class="test_status">
          <p class="test_status_tit bold2 txt-c"><?= $name ?>님,
            <br>
            시험 <span class="c_bora01">채점 결과 <?= $score ?>점</span>으로 <?= $result ?>입니다.
          </p>
          <? if (!$isPass) { ?>
            <p class="test_status_det txt-c">다시 공부하신 후 재응시 해주시길 바랍니다.</p>
          <? } ?>
        </div>
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
          <div class="row dp_f dp_c">
            <div class="row_tit">채점 점수</div>
            <div class="row_det"><?= $score ?>점</div>
          </div>
          <div class="row dp_f dp_c">
            <div class="row_tit">시험 결과</div>
            <div class="row_det"><?= $result ?></div>
          </div>
        </div>
        <div class="test_chk_wrap dp_sb">
          <div class="test_quest wid100">
            <h3 class="c_bora01 bold2">채점 결과</h3>

            <?
            foreach ($row_arr as $key => $row) {
              $key = intval($key) + 1;
              $isCorrect = ($row['a1'] == ${'p'. $key});
            ?>
              <div class="quest_box">
                <p class="quest_tit bold2 dp_f">
                  <? if($isCorrect) { ?>
                  <img class="quest_status_chk" src="/images/sub/correct_chk.svg" alt="">
                  <? } else { ?>
                    <img class="quest_status_chk" src="/images/sub/wrong_chk.svg" alt="">
                  <? } ?>
                  <span><?= $row['qnum'] ?>.</span>
                  <span><?= $row['qtitle'] ?></span>
                </p>

                <ul class="quest_det">
                  <li class="<? if($row['a1'] == 1) echo "answer"; if (!$isCorrect && ${'p'. $key} == 1) echo 'picked';?>">① <?= $row['q1'] ?></li>
                  <li class="<? if($row['a1'] == 2) echo "answer"; if (!$isCorrect && ${'p'. $key} == 2) echo 'picked';?>">② <?= $row['q2'] ?></li>
                  <li class="<? if($row['a1'] == 3) echo "answer"; if (!$isCorrect && ${'p'. $key} == 3) echo 'picked';?>">③ <?= $row['q3'] ?></li>
                  <li class="<? if($row['a1'] == 4) echo "answer"; if (!$isCorrect && ${'p'. $key} == 4) echo 'picked';?>">④ <?= $row['q4'] ?></li>
                </ul>
              </div>
            <? } ?>

          </div>
        </div>

        <div class="two_btn_wrap dp_f dp_c dp_cc">
          <a class="two_btn dp_f dp_c dp_cc bold2 bora01 c_w" href="/mypage/sub08.php" title="확인">
            확인
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?
include '/home/edufim/www/footer.php';
?>