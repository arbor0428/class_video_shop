<?
	include '../header.php';
	$side_menu=5;
?>


<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit m_10">
				<ul class="s_cont_tabbtn dp_f">
					<li><a href="/sub09/sub03.php">수강중인 강좌</a></li>
					<li><a href="/sub09/sub04.php">찜한 강좌</a></li>
					<li class="on"><a href="/sub09/sub05.php">나의 학습질문</a></li>
					<li><a href="/sub09/sub06.php">나의 리뷰</a></li>
					<li><a href="/sub09/sub07.php">수강증 발급</a></li>
					<li><a href="/sub09/sub08.php">수료증 발급</a></li>
					<li><a href="/sub09/sub09.php">자격증 발급</a></li>
				</ul>
			</div>
			<p class="c_gry04 f14 m_40">공부하다 궁금한 점이 있으면 질문을 남겨주세요. 에듀핌 강사님들과 전문 연구진이 답변을 달아드립니다.</p>
			<div class="top_searchBar dp_sb">
				<div class="dp_f">
					<div class="selectwrap dp_f dp_c">
						<select name="" id="">
							<option value="">강사님 선택</option>
						</select>
					</div>
					<div class="selectwrap dp_f dp_c wid500">
						<select name="" id="">
							<option value="">강좌 전체</option>
						</select>
					</div>
				</div>
				<a class="searchBtn02 bora01 c_w dp_f dp_c dp_cc" href="" title="학습 질문하기">학습 질문하기</a>
			</div>
			<div class="tableWrap">
				<table class="subTbl">
					<colgroup>
						<col style="width: 17%;">
						<col style="width: 59%;">
						<col style="width: 12%;">
						<col style="width: 12%;">
					</colgroup>
					<tbody>
						<tr class="brb000">
							<th>강좌 정보</th>
							<th>문의 내역</th>
							<th>작성일</th>
							<th>답변유무</th>
						</tr>
						<!--아무것도 없을 때 보이는 부분-->
						<tr class="noResult">
							<td colspan="4">아직 등록하신 질문이 없습니다.</td>
						</tr>
						<!--아무것도 없을 때 보이는 부분-->
						<tr>
							<td>필라테스 시퀀스 처방사 자격증 [Basic]</td>
							<td><p>과정 취득에 대해 문의드립니다!</p></td>
							<td>2022-09-28</td>
							<td><div class="replyStatus dp_f dp_c dp_cc on" href="" title="답변 완료">답변 완료</div></td>
						</tr>
						<tr>
							<td>22년 필라테스 지도자 자격증 과정</td>
							<td><p>문의 드리겠습니다.</p></td>
							<td>2022-09-28</td>
							<td><div class="replyStatus dp_f dp_c dp_cc" href="" title="답변 대기">답변 대기</div></td>
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
