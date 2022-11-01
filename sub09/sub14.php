<?
	include '../header.php';
	$side_menu=14;
?>


<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit f20 bold2 c_bora01">
				개인정보 수정
				<span class="s_cont_tit_det f14 c_blk regular">* 필수 입력 정보입니다.</span>
			</div>
			<div class="personal_Info">
				<p class="s_edit_tit f18 bold2 m_24">내 정보 수정</p>
				<div class="personal_row dp_f dp_c">
					<div class="personal_tit dp_f">아이디<span class="mustInput">*</span></div>
					<div class="personal_det">fim2021@naver.com</div>
				</div>
				<div class="personal_row dp_f dp_c">
					<div class="personal_tit dp_f">비밀번호<span class="mustInput">*</span></div>
					<div class="personal_det dp_f dp_c">
						<input type="text" placeholder="비밀번호">
						<span class="f14 c_gry05 s_label">영문, 숫자 또는 영문+숫자를 조합하여 4~10자리까지 가능합니다.</span>
					</div>
				</div>
				<div class="personal_row dp_f dp_c">
					<div class="personal_tit dp_f">비밀번호 확인<span class="mustInput">*</span></div>
					<div class="personal_det dp_f dp_c">
						<input type="text" placeholder="비밀번호확인">
					</div>
				</div>
				<div class="personal_row dp_f dp_c">
					<div class="personal_tit dp_f">성 명<span class="mustInput">*</span></div>
					<div class="personal_det dp_f dp_c">
						<input type="text">
					</div>
				</div>
				<div class="personal_row dp_f dp_c">
					<div class="personal_tit">성 별</div>
					<div class="personal_det dp_f dp_c">
						남자
					</div>
				</div>
				<div class="personal_row dp_f dp_c">
					<div class="personal_tit dp_f">직 업<span class="mustInput">*</span></div>
					<div class="personal_det dp_f dp_c">
						<select name="" id="">
							<option value="">직업을 선택해주세요.</option>
						</select>
					</div>
				</div>
				<div class="personal_row dp_f dp_c">
					<div class="personal_tit dp_f">휴대전화<span class="mustInput">*</span></div>
					<div class="personal_det dp_f dp_c">
						<input type="text" value="01012345678">
						<div class="dp_f dp_c s_label">
							<img src="../images/check_V.svg" alt="">
							<span class="f12">문자 메세지 정보수신 동의(서비스 안내, 이벤트 등의 정보)</span>
						</div>
					</div>
				</div>
			</div>
			<div class="addr_Info m-60">
				<div class="dp_sb dp_c dp_end m_10">
					<p class="s_edit_tit f18 bold2">배송지 수정</p>
					<a class="c_bora01 f12 bold2" href="" title="">신규 배송지 추가+</a>
				</div>
				<div class="tableWrap">
					<table class="subTbl addSubtbl">
						<colgroup>
							<col style="width: 12%;">
							<col style="width: 14%;">
							<col style="width: 48%;">
							<col style="width: 16%;">
							<col style="width: 10%;">
						</colgroup>
						<tbody>
							<tr class="brb000">
								<th>배송지</th>
								<th>이름</th>
								<th>주소</th>
								<th>연락처</th>
								<th>수정/삭제</th>
							</tr>
							<tr class="addr_tr_det">
								<td>
									<div class="bora01 c_w default_label f12 dp_f dp_c dp_cc">기본 배송지</div>
									<span class="bold2">에듀핌</span>
								</td>
								<td>에듀핌</td>
								<td>서울 마포구 매봉산로 37 (상암동, DMC 산학협력연구센터) 605호</td>
								<td>010-1234-5678</td>
								<td>
									<div class="addrEditBtnWrap dp_f dp_c dp_cc">
										<a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="" title="수정">수정</a>
										<a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="" title="수정">삭제</a>
									</div>
								</td>
							</tr>
							<tr class="addr_tr_det">
								<td>
									<span class="bold2">에듀핌</span>
								</td>
								<td>에듀핌</td>
								<td>서울 마포구 매봉산로 37 (상암동, DMC 산학협력연구센터) 605호</td>
								<td>010-1234-5678</td>
								<td>
									<div class="addrEditBtnWrap dp_f dp_c dp_cc">
										<a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="" title="수정">수정</a>
										<a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="" title="수정">삭제</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="twoBtn02Wrap dp_f dp_c dp_cc">
				<a class="dp_f dp_c dp_cc bold2" href="" title="">탈퇴신청</a>
				<a class="dp_f dp_c dp_cc bora01 c_w" href="" title="">정보수정</a>
			</div>
		</div>
    </div>
</div>


<?
	include '../footer.php';
?>
