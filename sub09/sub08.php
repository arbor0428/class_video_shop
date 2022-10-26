<?
	include '../header.php';
	$side_menu=8;
?>


<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit">
				<ul class="s_cont_tabbtn dp_f">
					<li><a href="/sub09/sub03.php">수강중인 강좌</a></li>
					<li><a href="/sub09/sub04.php">찜한 강좌</a></li>
					<li><a href="/sub09/sub05.php">나의 학습질문</a></li>
					<li><a href="/sub09/sub06.php">나의 리뷰</a></li>
					<li><a href="/sub09/sub07.php">수강증 발급</a></li>
					<li class="on"><a href="/sub09/sub08.php">수료증 발급</a></li>
					<li><a href="/sub09/sub09.php">자격증 발급</a></li>
				</ul>
			</div>
			<p class="c_gry04 f14 m_40">진도율 80% 이상시 시험 응시 가능하며, 시험 합격시 수료증을 발급 받을 수 있습니다.</p>
			<div class="tableWrap">
				<table class="subTbl">
					<colgroup>
						<col style="width: 67%;">
						<col style="width: 21%;">
						<col style="width: 12%;">
					</colgroup>
					<tbody>
						<tr class="brb000">
							<th>강좌명</th>
							<th>내 진도율</th>
							<th>비고</th>
						</tr>
						<!--아무것도 없을 때 보이는 부분-->
						<tr class="noResult">
							<td colspan="3">아직 등록하신 질문이 없습니다.</td>
						</tr>
						<!--아무것도 없을 때 보이는 부분-->
						<tr>
							<td>체형분석평가사 견관절 과정</td>
							<td>82%</td>
							<td><div class="testStatus dp_f dp_c dp_cc">시험 응시</div></td>
						</tr>
						<tr>
							<td>체형분석평가사 견관절 과정</td>
							<td>100%</td>
							<td><div class="testStatus on dp_f dp_c dp_cc">수료증 발급</div></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
    </div>
</div>


<?
	include '../footer.php';
?>
