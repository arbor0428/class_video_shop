<?
include '../header.php';

$uid = $code;
$query = "SELECT * FROM ks_event WHERE uid=$uid";
$result = mysql_query($query) or die("/sub03");
$num_row = mysql_num_rows($result);
$row = mysql_fetch_assoc($result);

foreach ($row as $k => $v) {
	${$k} = $v;
}
$eDateTime = new DateTime($eDate);
$tDateTime = new DateTime(date('Y-m-d'));
$diff = $tDateTime->diff($eDateTime);
$int_d_day = intval($diff->format('%R%a'));

if ($int_d_day < 0) echo "기간 만료된 이벤트 입니다";
else {
	$d_day = $diff->days;
	$d_time = strtotime('15:00:00') - time();
	$d_time = date('H : i : s', $d_time);
?>

	<div class="subWrap">
		<div class="s_center dp_sb">
			<div class="detail_cont">
				<div class="detail_sum">
					<img src="/upfile/event/<?= $upfile01 ?>" alt="썸네일 상단">
				</div>

				<!--mobile-->
				<div class="mobile_detail_wrap">
					<div class="detail_right">
						<div class="pin_box">
							<p class="pin_box_tit bold2"><?= $title ?></p>
							<p class="pin_box_det"><?= $exp ?></p>
							<ul class="event_pin_list">
								<li class="dp_f dp_c">
									<span class="c_bora01 bold2">남은 시간</span>
									<span class="bold2"><?= $d_day ?>일 <?= $d_time ?></span>
								</li>
								<li class="dp_f dp_c">
									<span class="c_bora01 bold2">이벤트 대상</span>
									<span><?= $target ?></span>
								</li>
								<li class="dp_f dp_c">
									<span class="c_bora01 bold2">이벤트 기간</span>
									<span>
										<?= $sDate ?> ~ <?= $eDate ?> <!--PM 23 : 59분 까지-->
									</span>
								</li>
							</ul>
							<a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="/sub01/view.php?code=<?= $class_uid ?>" title="수강신청 바로가기">수강신청 바로가기</a>
							<a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="" title=""><img src="/images/sub/clip_icon.svg" alt="클립">링크 복사하기</a>
						</div>
					</div>
				</div>

				<div class="event_detail">
					<?= $ment01 ?>
				</div>
			</div>

			<!--pc-->
			<div class="detail_right pc_detail_wrap">
				<div class="pin_box">
					<p class="pin_box_tit bold2"><?= $title ?></p>
					<p class="pin_box_det"><?= $exp ?></p>
					<ul class="event_pin_list">
						<li class="dp_f dp_c">
							<span class="c_bora01 bold2">남은 시간</span>
							<span class="bold2"><?= $d_day ?>일 <?= $d_time ?></span>
						</li>
						<li class="dp_f dp_c">
							<span class="c_bora01 bold2">이벤트 대상</span>
							<span><?= $target ?></span>
						</li>
						<li class="dp_f dp_c">
							<span class="c_bora01 bold2">이벤트 기간</span>
							<span>
								<?= $sDate ?> ~
								<br>
								<?= $eDate ?> <!--PM 23 : 59분 까지-->
							</span>
						</li>
					</ul>
					<a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="/sub01/view.php?code=<?= $class_uid ?>" title="수강신청 바로가기">수강신청 바로가기</a>
					<a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="" title=""><img src="/images/sub/clip_icon.svg" alt="클립">링크 복사하기</a>
				</div>
			</div>
		</div>
	</div>

<? } ?>

<?
include '../footer.php';
?>