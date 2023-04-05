<?
include '../header.php';

$query = "SELECT * FROM ks_event ORDER BY uid DESC";

$result = mysql_query($query) or die("DB Error : " . mysql_error());
$total_record = mysql_num_rows($result);
?>

<style>
    .event_bnr_wrap {
        width: 100%;
        height: 250px;
        margin-bottom: 63px;
        overflow: hidden;
        border-radius: 4px;
    }

    .event_bnr_btm_wrap {
        width: 100%;
        height: 130px;
        overflow: hidden;
        margin-top: 130px;
        border-radius: 4px;
    }
</style>

<div class="subWrap">
	<div class="s_center">
        <!--배너 추가작업 2023-03-30 sj -->
        <div class="event_bnr_wrap">
            <div class="swiper-wrapper">
                <img src="/images/mainslide01.jpg" class="swiper-slide">
            </div>
        </div>
        <!--//배너 추가작업 2023-03-30 sj -->
		<div class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc">이벤트</div>
		<div class="dp_f dp_wrap event_nVdSlickBox_wrap">
			<?
			if ($total_record > 0) {
				while ($row = mysql_fetch_assoc($result)) {
					foreach ($row as $k => $v) {
						${$k} = $v;
					}
					$eDateTime = new DateTime($eDate);
					// $eDateTime = new DateTime('2023-02-14');
					$tDateTime = new DateTime(date('Y-m-d'));
					$interval = $tDateTime->diff($eDateTime);
					$int_d_day = intval($interval->format('%R%a'));


					// $int_d_time = strtotime('2023-02-14') - time();
					// echo strtotime('2023-02-14');
					// echo "<br><br>";
					// echo time();
					// echo "<br><br>";
					// echo date('Y-m-d H:i:s', strtotime($eDate));
					// echo "<br><br>";
					// // $int_d_time = intval($interval->format("%H:%I:%S (Full days: %a)"));
					// echo date('Y-m-d h:i:s', $int_d_time);

					if ($int_d_day < 0) continue;
					else {
						$d_day = $interval->days;
						$d_time = strtotime('15:00:00') - time();
						$d_time = date('H:i:s', $d_time);
			?>
						<div class="nVdSlickBox">
							<a href="./view.php?code=<?= $uid ?>" title="<?= $title ?>">
								<div class="imgWrap c_gry02 p_r" style="background-image:url('/upfile/event/<?= $upfile01 ?>')">
									<div class="time_show p_a c_w bora01">
										<div class="dp_f dp_c">
											<span class="bold2">D-<?= $d_day ?></span>
											<span><?= $d_time ?></span>
											<span>후 종료</span>
										</div>
									</div>
								</div>
								<div class="nVdCont">
									<div class="nVdTop">
										<p class="nVdtit01 bold2 dotdot"><?= $title ?></p>
									</div>
									<div class="nVdBot">
										<span class="c_red bold">D-<?= $d_day ?></span>
										<span class="priceDet bold"><?= $sDate ?> ~ <?= $eDate ?></span>
									</div>
								</div>
							</a>
						</div>
				<? }
				}
			} else { ?>

			<? } ?>
			<!-- <div class="nVdSlickBox">
            <a href="./view.php" title="">
               <div class="imgWrap c_gry02 p_r" style="background-image:url('../images/sub/event_sumnail.png')">
                  <div class="time_show p_a c_w bora01">
                     <div class="dp_f dp_c">
                        <span class="bold2">D-60</span> <span>10:28:37</span> <span>후 종료</span>
                     </div>
                  </div>
               </div>
               <div class="nVdCont">
                  <div class="nVdTop">
                     <p class="nVdtit01 bold2 dotdot">9~11월 한시적 이벤트 혜택!</p>
                  </div>
                  <div class="nVdBot">
                     <span class="c_red bold">D-60</span>
                     <span class="priceDet bold">2022.09.01(목) ~ 2022.11.30(화)</span>
                  </div>
               </div>
            </a>
         </div> -->

		</div>

		<!-- <div class="numWrap">
			<ul class="dp_f dp_c dp_cc">
				<li>
					<a class="prev_btn dp_f dp_c dp_cc" href="javascript:void(0)">
						<img src="/images/sub/page_prev.png" alt="이전">
					</a>
				</li>
				<li>
					<a class="on num dp_f dp_c dp_cc" href="javascript:void(0)">1</a>
				</li>
				<li>
					<a class="num dp_f dp_c dp_cc" href="javascript:void(0)">2</a>
				</li>
				<li>
					<a class="next_btn dp_f dp_c dp_cc" href="javascript:void(0)">
						<img src="/images/sub/page_next.png" alt="이후">
					</a>
				</li>
			</ul>
		</div> -->
        
        <!--배너 추가작업 2023-03-30 sj -->
        <div class="  event_bnr_btm_wrap">
            <div class="swiper-wrapper">
                <img src="/images/main_eventBnr01.jpg" class="swiper-slide">
            </div>
        </div>
        <!--//배너 추가작업 2023-03-30 sj -->

	</div>
</div>

<!--배너 추가작업 2023-03-30 sj -->
<script>
    var topBnr = new Swiper(".event_bnr_wrap", {
        spaceBetween: 0,     
        autoplay: false,
        pagination: false,
        navigation:false,
      });
    var btmBnr = new Swiper(".event_bnr_btm_wrap", {
        spaceBetween: 0,     
        autoplay: false,
        pagination: false,
        navigation:false,
      });
</script>

<?
include '../footer.php';
?>