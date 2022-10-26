<?
	include '../header.php';
	$side_menu=6;
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
					<li><a href="/sub09/sub05.php">나의 학습질문</a></li>
					<li class="on"><a href="/sub09/sub06.php">나의 리뷰</a></li>
					<li><a href="/sub09/sub07.php">수강증 발급</a></li>
					<li><a href="/sub09/sub08.php">수료증 발급</a></li>
					<li><a href="/sub09/sub09.php">자격증 발급</a></li>
				</ul>
			</div>
			<p class="c_gry04 f14 m_40">내가 수강한 강좌에 대한 리뷰를 남겨보세요!</p>
			

			<!--리뷰 list 보여지는 부분-->
			<div class="top_searchBar dp_sb">
				<div class="dp_f">
					<div class="selectwrap dp_f dp_c">
						<select name="" id="">
							<option value="">작성 가능한 리뷰</option>
						</select>
					</div>
				</div>
			</div>
			<div class="tableWrap">
				<table class="subTbl">
					<tbody>
						<tr class="brb000">
							<th>강좌명</th>
						</tr>
						<!--아무것도 없을 때 보이는 부분-->
						<tr class="noResult">
							<td>아직 등록하신 질문이 없습니다.</td>
						</tr>
						<!--아무것도 없을 때 보이는 부분-->
						<tr>
							<td>
								필라테스 시퀀스 처방사 자격증 [Basic]
								<a class="reviewWrt bora01 c_w dp_f dp_c dp_cc" href="" title="리뷰 쓰기">리뷰 쓰기</a>
							</td>
						</tr>
						<tr>
							<td>
								22년 필라테스 지도자 자격증 과정
								<a class="reviewWrt bora01 c_w dp_f dp_c dp_cc" href="" title="리뷰 쓰기">리뷰 쓰기</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>


			<!--리뷰 view 보여지는 부분-->
			<div class="top_searchBar dp_sb">
				<div class="dp_f">
					<div class="selectwrap dp_f dp_c">
						<select name="" id="">
							<option value="">작성한 리뷰</option>
						</select>
					</div>
				</div>
			</div>
			<div class="tableWrap">
				<table class="subTbl">
					<colgroup>
						<col style="width: 17%;">
						<col style="width: 71%;">
						<col style="width: 12%;">
					</colgroup>
					<tbody>
						<tr class="brb000">
							<th>강좌명</th>
							<th>내용</th>
							<th>작성일</th>
						</tr>
						<!--아무것도 없을 때 보이는 부분-->
						<tr class="noResult">
							<td colspan="3">아직 등록하신 질문이 없습니다.</td>
						</tr>
						<!--아무것도 없을 때 보이는 부분-->
						<tr>
							<td>필라테스 시퀀스 처방사 자격증 [Basic]</td>
							<td class="txt-l">협회 교육에서 배웠던 내용이지만 그 내용을 더 간결하고 이해하기 쉽게, 기억하기 쉽게 설명해주셨습니다. 더 열심히 공부해서 현장에서 회원의 몸을 보고 1초만에 앞으로의 수업의 그림이 그려지는 강사가 될 수 있길 바랍니다!! 자료도 굉장히 좋았고 수업 구성도 좋았어요 내용이 익혀질 때까지 열심히 복습하고 응용하겠습니다.</td>
							<td>2022-09-28</td>
						</tr>
						<tr>
							<td>22년 필라테스 지도자 자격증 과정</td>
							<td class="txt-l">초보강사일때 시퀀스 고민이 되어 반신반의하면서 구매해 들었는데 도움이 많이 되었습니다. 고강도 필라테스, 캐딜락 강의 등 점점 추가되는 강의가 많아져서 더 만족스러웠습니다ㅎㅎ 협회에서 배운 동작 외에 조금 더 다양한 동작들을 알고 싶은 강사님이라면 한번 쯤 들어보기에 괜찮은 강의여서 추천합니다!</td>
							<td>2022-09-28</td>
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
