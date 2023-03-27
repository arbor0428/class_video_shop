<?
$record_count = 3;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!$record_start) {
	$record_start = 0;
}

$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

$cade01 = $_GET['cade01'];
$cade02 = $_GET['cade02'];

//쿼리조건
$query_ment = "where 1=1 and p.cade01=c1.uid and p.cade02=c2.uid";

//상태
if ($cade01)	$query_ment .= " and cid=$cade01";
if ($cade02)	$query_ment .= " and ccid=$cade02";
// elseif ($f_status == '3')	$query_ment .= " and status=''";

//등급
// if ($f_level == '1')			$query_ment .= " and level='VIP'";
// elseif ($f_level == '2')	$query_ment .= " and level=''";

//아이디
// if ($f_userid)	 $query_ment .= " and userid like '%$f_userid%'";

//성명
// if ($f_name)	 $query_ment .= " and name like '%$f_name%'";

if (!$cade01)	$sort_ment = 'order by cade01';
if (!$cade02)	$sort_ment = "order by cade01, cade02";
// elseif ($f_sort == 'loginTime')	$sort_ment = "order by loginTime desc";

$query = "select p.*, c1.title c1_title, c2.title c2_title from ks_product p, ks_product_cade01 c1, ks_product_cade02 c2 $query_ment $sort_ment";
// $query = "SELECT * FROM ks_product GROUP BY cade01, cade02";
// echo $query; exit;

$result = mysql_query($query) or die("연결실패");
$total_record = mysql_num_rows($result);
echo $total_record;
// exit;
$total_page = (int)($total_record / $record_count);

if ($total_record % $record_count) {
	$total_page++;
}

$query2 = $query . " limit $record_start, $record_count";
$result = mysql_query($query2);
?>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
	<input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
	<input type='hidden' name='type' value='<?= $type ?>'>
	<input type='hidden' name='uid' value=''>
	<input type='hidden' name='record_start' value='<?= $record_start ?>'>
	<input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
	<input type='hidden' name='cType' value="user">
	<input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>
</form>

<div class="s_cont">
	<div class="s_cont_tit02 dp_f dp_c bor_bot">
		<span class="f20 bold2 c_bora01">전체</span>
		<!-- <span class="f20 regular line dp_f dp_c">전체</span>
		<span class="f20 bold2 c_bora01">zz<?= $cade01 ?></span>
		<span class="f20 regular line dp_f dp_c">zz<?= $cade01 ?></span>
		<span class="f20 bold2 c_bora01">zz<?= $cade02 ?></span> -->
	</div>
	<div class="top_searchBar">
		<div class="selectwrap dp_f dp_c">
			<p class="select_tit c_gry04 f14">정렬 기준</p>
			<select name="" id="">
				<option value="">추천순</option>
			</select>
		</div>
	</div>

	<!------>
	<? while ($row = mysql_fetch_array($result)) { ?>
		<div class="all_list_wrap">
			<div class="s_cont_tit02 dp_f dp_c">
				<span class="f18 bold2 dp_f dp_c line"><?= $row['c1_title'] ?></span>
				<span class="f18 bold2 c_bora01">하위메뉴</span>
			</div>
			<div class="dp_sb dp_wrap">
				<div class="nVdSlickBox">
					<a href="" title="">
						<div class="imgWrap c_gry02 p_r">
							<button type="button" title="관심" class="likeMark"></button>
							<img src="" alt="">
						</div>
						<div class="nVdCont">
							<div class="nVdTop">
								<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
								<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
								<ul class="clickicon dp_f dp_c">
									<li class="dp_f dp_c">
										<img src="/images/likeChk_gry.png" alt="">
										<span>10884</span>
									</li>
									<li class="dp_f dp_c">
										<img src="/images/bestChk_gry.png" alt="">
										<span>97%</span>
									</li>
								</ul>
							</div>
							<div class="nVdBot">
								<p class="c_gry03">500,000원</p>
								<span class="c_red bold">46%</span>
								<span class="priceDet bold">월 89,000원</span>
								<span class="monDet">(12개월)</span>
							</div>
						</div>
					</a>
				</div>
				<div class="nVdSlickBox">
					<a href="" title="">
						<div class="imgWrap c_gry02 p_r">
							<button type="button" title="관심" class="likeMark"></button>
							<img src="" alt="">
						</div>
						<div class="nVdCont">
							<div class="nVdTop">
								<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
								<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
								<ul class="clickicon dp_f dp_c">
									<li class="dp_f dp_c">
										<img src="/images/likeChk_gry.png" alt="">
										<span>10884</span>
									</li>
									<li class="dp_f dp_c">
										<img src="/images/bestChk_gry.png" alt="">
										<span>97%</span>
									</li>
								</ul>
							</div>
							<div class="nVdBot">
								<p class="c_gry03">500,000원</p>
								<span class="c_red bold">46%</span>
								<span class="priceDet bold">월 89,000원</span>
								<span class="monDet">(12개월)</span>
							</div>
						</div>
					</a>
				</div>
				<div class="nVdSlickBox">
					<a href="" title="">
						<div class="imgWrap c_gry02 p_r">
							<button type="button" title="관심" class="likeMark"></button>
							<img src="" alt="">
						</div>
						<div class="nVdCont">
							<div class="nVdTop">
								<p class="nVdtit01 bold2 dotdot">멀리건 기법을 이용한 관절 테크닉 1편</p>
								<p class="nVdtit02 c_gry03 dotdot">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과</p>
								<ul class="clickicon dp_f dp_c">
									<li class="dp_f dp_c">
										<img src="/images/likeChk_gry.png" alt="">
										<span>10884</span>
									</li>
									<li class="dp_f dp_c">
										<img src="/images/bestChk_gry.png" alt="">
										<span>97%</span>
									</li>
								</ul>
							</div>
							<div class="nVdBot">
								<p class="c_gry03">500,000원</p>
								<span class="c_red bold">46%</span>
								<span class="priceDet bold">월 89,000원</span>
								<span class="monDet">(12개월)</span>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>

	<? } ?>
	<!------>

</div>

<script>
	function reg_view(uid) {
		form = document.frm01;
		form.type.value = 'view';
		form.uid.value = uid;
		form.action = 'index.php';
		form.submit();
	}
</script>