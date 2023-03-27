<?
include '/home/edufim/www/header.php';
// if (!isLogin()) redirectLogin();
if (empty($class_uid)) {
	// deny();
	// exit;
	$class_uid = 1;
}

if (empty($class_list_uid)) $class_list_uid = 1;

$userid =  $GBL_USERID;

// learning join class
$learning = sqlRow("SELECT l.*, c.* FROM ks_learning l JOIN ks_class c ON l.class_uid=c.uid WHERE c.uid=$class_uid");
// $class = sqlRow("SELECT * FROM ks_class WHERE uid=$class_uid");

// class_list
$query = "SELECT * FROM ks_class_list WHERE class_uid=$class_uid ORDER BY sort";
$class_lists = mysql_query($query) or die("연결실패");
$class_list_count = mysql_num_rows($class_lists);

if ($class_list_count <= 0) {
	Msg::goMsg("등록된 강좌가 없습니다. 관리자에게 문의 바랍니다.", '/mypage/learning.php');
	exit;
}

/**
 * base64_urlencode
 *
 * @param string $str
 * @return string
 */
function base64_urlencode($str) {
    return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
}

/**
 * jwt_encode
 *
 * @param array $payload
 * @param string $key
 * @return string
 */
function jwt_encode($payload, $key) {
    $jwtHead = base64_urlencode(json_encode(array('typ' => 'JWT', 'alg' => 'HS256')));
    $jsonPayload = base64_urlencode(json_encode($payload));
    $signature = base64_urlencode(hash_hmac('SHA256', $jwtHead . '.' . $jsonPayload, $key, true));

    return $jwtHead . '.' . $jsonPayload . '.' . $signature;
}

$securityKey = 'i-web';
$customKey = '8350bbc806a3810d1bcd78f44bccaea7';
$mediaContentKey = 'Yp8GsbBA';
// $mediaContentKey = 'MHnpsb93';
$clientUserId = $GBL_USERID;
$expireTime = 7200; // 120 min
$mediaItems = array(
	array(
		'media_content_key' => $mediaContentKey,
    ),
	// array(
	// 	'media_content_key' => $otherMediaContentKey,
	// 	'intr' => true,
	// 	'is_seekable' => true,
	// ),
);

$payload = array(
    'cuid' => $clientUserId,
    'expt' => time() + $expireTime,
	// 'playback_rates'=> array(0.5, 0.7, 1, 1.3, 1.5, 1.7, 2),
    'mc' => array(),
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
echo $jwtToken;
$webTokenURL = 'http://v.kr.kollus.com/s?jwt=' . $jwtToken . '&custom_key=' . $customKey . '&autoplay';

?>
<div class="subWrap">
	<div class="s_center dp_sb">
		<div class="detail_cont detail_cont_scroll">
			<p class="detail_cont_scroll_tit bold2"><?= $learning['title'] ?></p>
			<p class="detail_cont_scroll_sub_tit bold dp_f dp_c"><?= $learning['title'] ?> - <?= $learning['target'] ?></p>

			<ul class="dp_f dp_c gry01 class_dayamount_info">
				<li class="f12 dp_f dp_c">총 <?= $class_list_count ?>강</li>
				<li class="f12">수강기간 <?= $learning['period'] ?>일</li>
			</ul>
			<div class="progress_status_bar dp_sb dp_c">
				<p class="c_bora01 bold2">진도율<span><?= $learning['progress'] ?></span>%</p>
				<p class="progress_status_date dp_f dp_c c_gry04">
					<span class="dp_f dp_c"><?= $class_list_uid ?>/<?= $class_list_count ?>강</span>
					<span>최근 수강일: <? echo $learning['recentDate']? $learning['recentDate'] : "미수강"; ?></span>
				</p>
			</div>
			<div class="video_progress">
				<div class="progressBar_wrap dp_sb dp_c">
					<div class="progressBar" style="width: 100%;">
						<div class="progressBar_fill" style="width: <?= $learning['progress'] ?>%;"></div>
					</div>
				</div>
			</div>

			<div class="detail_sum" style="height: 450px; background-color: #efefef;">
				<!--비디오-->
				<iframe src="<?php echo $webTokenURL; ?>" width="774" height="450" allowfullscreen></iframe>
			</div>

			<!---나의 학습질문--->
			<div class="detail_cont_sub_tit">
				<span class="bora01 c_w bold2">나의 학습질문</span>
			</div>
			<div class="detail_cont_subcont detail_subcont br_bot_gry">
				<!--학습질문이 없을때-->
				<p class="no_statu txt-c c_gry04 f14">
					강의 수강 중 궁금한 사항이 있나요?
					<br>
					질문을 남겨주시면 답변해드립니다.
				</p>
				<!--학습질문이 없을때-->

				<!--학습질문이 있을때-->
				<div class="review_box_wrap">
					<div class="review_box">
						<!--학습질문-->
						<div class="class_question_box">
							<div class="dp_sb dp_c">
								<div class="per_info_wrap dp_f dp_c">
									<div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"><!--프로필 배경 처리--></div>
									<div class="per_info">
										<p class="bold">홍길동</p>
										<span class="c_gry04">2022-12-01</span>
									</div>
								</div>
							</div>
							<p class="review_detail f14">협회 교육에서 배웠던 내용이지만 그 내용을 더 간결하고 이해하기 쉽게, 기억하기 쉽게 설명해주셨습니다. 더 열심히 공부해서 현장에서 회원의 몸을 보고 1초만에 앞으로의 수업의 그림이 그려지는 강사가 될 수 있길 바랍니다!! 자료도 굉장히 좋았고 수업 구성도 좋았어요 내용이 익혀질 때까지 열심히 복습하고 응용하겠습니다.</p>
						</div>
						<!--학습질문답변-->
						<div class="class_quest_reply_box">
							<span class="admin_user dp_inline c_w gry03">에듀핌</span>
							<p class="f14">
								안녕하세요 홍길동님
								<br>
								강의에 대한 질문을 주셔서 감사합니다! 질문에 대한 답변 드리겠습니다. 질문에 대한 답변 드리겠습니다. 질문에 대한 답변 드리겠습니다. 질문에 대한 답변 드리겠습니다. 질문에 대한 답변 드리겠습니다. 질문에 대한 답변 드리겠습니다. 질문에 대한 답변 드리겠습니다. 질문에 대한 답변 드리겠습니다.
							</p>
							<span class="c_gry04 f12">2022-12-02</span>
						</div>
					</div>
				</div>
				<!--학습질문이 있을때-->
			</div>
			<div class="detail_subcont_btn_wrap dp_f dp_c dp_end02">
				<a class="bora_small_btn c_w bora01 dp_inline dp_c dp_cc" href="" title="질문 하기">질문 하기</a>
			</div>
			<!---나의 학습질문--->

			<!---나의 리뷰--->
			<div class="detail_cont_sub_tit">
				<span class="bora01 c_w bold2">나의 리뷰</span>
			</div>
			<div class="detail_cont_subcont detail_subcont br_bot_gry">

				<?
				$review = sqlRow("SELECT * FROM ks_review WHERE userid='$userid' AND class_uid=$class_uid");
				if ($review > 0) {
				?>
					<!--나의리뷰가 있을때-->
					<div class="review_box_wrap">
						<div class="review_box">
							<!--리뷰-->
							<div class="dp_sb dp_c">
								<div class="per_info_wrap dp_f dp_c">
									<div class="per_img" style="background-image:url('/images/sub/no_profile.svg');"><!--프로필 배경 처리--></div>
									<div class="per_info">
										<p class="bold"><?= $GBL_NAME ?></p>
										<span class="c_gry04"><?= $review['rDate'] ?></span>
									</div>
								</div>
								<div class="recom_label bora01 dp_inline dp_c">
									<img src="/images/sub/thumb_best.svg" alt="">
									<span class="c_w f12">추천해요</span>
								</div>
							</div>
							<!--리뷰-->
							<p class="review_detail f14"><?= $review['content'] ?></p>
						</div>
					</div>
					<!--나의리뷰가 있을때-->

				<? } else { ?>
					<!--나의리뷰가 없을때-->
					<p class="no_statu txt-c c_gry04 f14">
						강의 리뷰를 작성해주시면 수강기간 3일 연장해드립니다.
						<br>
						내가 수강한 강좌의 리뷰를 남겨보세요.
					</p>
					<!--나의리뷰가 없을때-->
				<? } ?>

			</div>
			<div class="detail_subcont_btn_wrap dp_f dp_c dp_end02">
				<p class="f14">리뷰 작성시 수강기간 <span class="bold2 c_bora01">3일 연장 가능</span></p>
				<a class="bora_small_btn c_w bora01 dp_inline dp_c dp_cc" href="" title="리뷰 쓰기">리뷰 쓰기</a>
			</div>
			<!---나의 리뷰--->
		</div>
		<div class="detail_right">
			<div class="pin_scroll_box">
				<div class="bora01 c_w sideTit f20 bold2 dp_inline dp_c dp_cc">강좌 구성</div>
				<div class="per_class_list">
					<? while ($class_list = mysql_fetch_array($class_lists)) { ?>
						<div class="per_class_list_box">
							<a href="javascript:void(0)" title="<?= $class_list['title'] ?>" onclick="showList(<?= $class_list['uid'] ?>);">
								<p class="bold2"><?= $class_list['sort'] ?>강. <?= $class_list['title'] ?></p>
								<span class="c_gry04 f12"><?= $class_list['exp'] ?></span>
								<div class="now_class_status_wrap dp_sb p_r">
									<div class="now_class_status_play dp_f dp_c">
										<img src="/images/sub/class_proc_play.svg" alt="">
										<span><?= $class_list['length'] ?></span>
										<span class="ncsp_line"></span>
										<? if ($class_list['recentDate']) { ?>
											<span class="ncsp_timeline">최근 수강일 <?= $class_list['recentDate'] ?></span>
										<? } else { ?>
											<span class="ncsp_yet">미수강</span>
										<? } ?>
									</div>
									<div class="now_class_status p_a dp_inline dp_c dp_cc bora01 c_w" <? if ($class_list['uid'] == $class_list_uid) echo "style='display: block;'" ?>>
										수강중
									</div>
								</div>
							</a>
						</div>
					<? } ?>
					<!-- <div class="per_class_list_box">
                        <a href="" title="" onclick="">
                            <p class="bold2">1강. [이론+운동] 골반전방경사_Stretch_ release</p>
                            <span class="c_gry04 f12">골반이 기울어졌을 경우, 원인과 함께 교정 방법을 알려드립니다.</span>
                            <div class="now_class_status_wrap dp_sb p_r">
                                <div class="now_class_status_play dp_f dp_c">
                                    <img src="/images/sub/class_proc_play.svg" alt="">
                                    <span>00:15:40</span>
                                    <span class="ncsp_line"></span>
                                    <span class="ncsp_timeline">최근 수강일 2022.09.28</span>
                                    <span class="ncsp_yet">미수강</span>
                                </div>
                                <div class="now_class_status p_a dp_inline dp_c dp_cc bora01 c_w">
                                    수강중
                                </div>
                            </div>
                        </a>
                    </div> -->
				</div>
			</div>
		</div>
	</div>
</div>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="frm01">
	<input type="hidden" name="class_uid" value="<?= $class_uid ?>">
	<input type="hidden" name="class_list_uid" value="<?= $class_list_uid ?>">
</form>

<script>
	const showList = function (uid) {
		const form = document.frm01
		form.class_list_uid.value = uid
		form.submit() 
	}

	// $(".per_class_list .per_class_list_box").click(function(event) {
	// 	event.preventDefault();

    //     //수강중
    //     $(".now_class_status").stop().hide();
    //     $(this).children().children().children(".now_class_status").stop().show();
    //     //날짜
    //     $(this).children().children().children(".now_class_status_play").addClass("on");

    // });
</script>
<?
include '/home/edufim/www/footer.php';
?>