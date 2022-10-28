<?
	include '../header.php';
	$side_menu=12;
?>


<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit f20 bold2 c_bora01 nobrb">적립금</div>
			<div class="totalPointWrap dp_sb dp_c">
				<div class="dp_f dp_c">
					<img class="p_icon" src="../images/p_icon.svg" alt="총 보유 적립금">
					<span>총 보유 적립금</span>
				</div>
				<p class="dp_f dp_c">
					<span class="bold2 c_bora01" style="margin: 0 5px;">0</span>
					<span>원</span>
				</p>
			</div>
			<p class="c_gry04 f14 m-12 m_40">· 총 결제금액 (배송비 제외)이 10,000원 이상인 경우 10,000원 단위로 사용가능</p>
			<div class="couTabWrap">
				<ul class="couTabBtn dp_f dp_wrap">
					<li class="on"><a href="" title="전체">전체</a></li>
					<li><a href="" title="적립">적립</a></li>
					<li><a href="" title="사용">사용</a></li>
				</ul>
				<div class="couTabContWrap">
					<div class="couTabCont">
						<div class="tableWrap">
							<table class="subTbl">
								<colgroup>
									<col style="width: 10%;">
									<col style="width: 18%;">
									<col style="width: 60%;">
									<col style="width: 12%;">
								</colgroup>
								<tbody>
									<tr class="brb000">
										<th>상태</th>
										<th>적립금</th>
										<th>적립내용</th>
										<th>날짜</th>
									</tr>
									<!--아무것도 없을 때 보이는 부분-->
									<tr class="noResult">
										<td colspan="4">적립금 내역이 없습니다.</td>
									</tr>
									<!--아무것도 없을 때 보이는 부분-->
									<tr>
										<td><span class="c_red01 bold">사용</span></td>
										<td><span class="c_red01 bold">-10,000</span></td>
										<td>
											<p>적립금 결제</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_bora01 bold">적립</span></td>
										<td><span class="c_bora01 bold">+20,000</span></td>
										<td>
											<p>주문 적립</p>
											<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_red01 bold">사용</span></td>
										<td><span class="c_red01 bold">-10,000</span></td>
										<td>
											<p>적립금 결제</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_bora01 bold">적립</span></td>
										<td><span class="c_bora01 bold">+20,000</span></td>
										<td>
											<p>주문 적립</p>
											<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_red01 bold">사용</span></td>
										<td><span class="c_red01 bold">-10,000</span></td>
										<td>
											<p>적립금 결제</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_bora01 bold">적립</span></td>
										<td><span class="c_bora01 bold">+20,000</span></td>
										<td>
											<p>주문 적립</p>
											<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_red01 bold">사용</span></td>
										<td><span class="c_red01 bold">-10,000</span></td>
										<td>
											<p>적립금 결제</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_bora01 bold">적립</span></td>
										<td><span class="c_bora01 bold">+20,000</span></td>
										<td>
											<p>주문 적립</p>
											<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
										</td>
										<td>2022-09-28</td>
									</tr>
								</tbody>
							</table>
							<a class="bora01 c_w wid100 dp_f dp_c dp_cc point_moreBtn" href="" title="">
								내역 확인 하기
								<span class="lnr lnr-chevron-down"></span>
							</a>
						</div>
					</div>
					<div class="couTabCont">
						<div class="tableWrap">
							<table class="subTbl">
								<colgroup>
									<col style="width: 10%;">
									<col style="width: 18%;">
									<col style="width: 60%;">
									<col style="width: 12%;">
								</colgroup>
								<tbody>
									<tr class="brb000">
										<th>상태</th>
										<th>적립금</th>
										<th>적립내용</th>
										<th>날짜</th>
									</tr>
									<!--아무것도 없을 때 보이는 부분-->
									<tr class="noResult">
										<td colspan="4">적립금 내역이 없습니다.</td>
									</tr>
									<!--아무것도 없을 때 보이는 부분-->
									<tr>
										<td><span class="c_bora01 bold">적립</span></td>
										<td><span class="c_bora01 bold">+20,000</span></td>
										<td>
											<p>주문 적립</p>
											<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_bora01 bold">적립</span></td>
										<td><span class="c_bora01 bold">+20,000</span></td>
										<td>
											<p>주문 적립</p>
											<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_bora01 bold">적립</span></td>
										<td><span class="c_bora01 bold">+20,000</span></td>
										<td>
											<p>주문 적립</p>
											<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_bora01 bold">적립</span></td>
										<td><span class="c_bora01 bold">+20,000</span></td>
										<td>
											<p>주문 적립</p>
											<p class="pointDet c_gry04">무릎손상의 단계별 재활 운동법 1편</p>
										</td>
										<td>2022-09-28</td>
									</tr>
								</tbody>
							</table>
							<a class="bora01 c_w wid100 dp_f dp_c dp_cc point_moreBtn" href="" title="">
								내역 확인 하기
								<span class="lnr lnr-chevron-down"></span>
							</a>
						</div>
					</div>
					<div class="couTabCont">
						<div class="tableWrap">
							<table class="subTbl">
								<colgroup>
									<col style="width: 10%;">
									<col style="width: 18%;">
									<col style="width: 60%;">
									<col style="width: 12%;">
								</colgroup>
								<tbody>
									<tr class="brb000">
										<th>상태</th>
										<th>적립금</th>
										<th>적립내용</th>
										<th>날짜</th>
									</tr>
									<!--아무것도 없을 때 보이는 부분-->
									<tr class="noResult">
										<td colspan="4">적립금 내역이 없습니다.</td>
									</tr>
									<!--아무것도 없을 때 보이는 부분-->
									<tr>
										<td><span class="c_red01 bold">사용</span></td>
										<td><span class="c_red01 bold">-10,000</span></td>
										<td>
											<p>적립금 결제</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_red01 bold">사용</span></td>
										<td><span class="c_red01 bold">-10,000</span></td>
										<td>
											<p>적립금 결제</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_red01 bold">사용</span></td>
										<td><span class="c_red01 bold">-10,000</span></td>
										<td>
											<p>적립금 결제</p>
										</td>
										<td>2022-09-28</td>
									</tr>
									<tr>
										<td><span class="c_red01 bold">사용</span></td>
										<td><span class="c_red01 bold">-10,000</span></td>
										<td>
											<p>적립금 결제</p>
										</td>
										<td>2022-09-28</td>
									</tr>
								</tbody>
							</table>
							<a class="bora01 c_w wid100 dp_f dp_c dp_cc point_moreBtn" href="" title="">
								내역 확인 하기
								<span class="lnr lnr-chevron-down"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<script>
$(".couTabBtn > li").on("click",function(event){

	event.preventDefault();

	let tabNumber = $(this).index();

	$(".couTabBtn > li").removeClass("on");
	$(this).addClass("on");

	$(".couTabContWrap .couTabCont").hide();;
	$(".couTabContWrap .couTabCont").eq(tabNumber).show();

});
</script>

<?
	include '../footer.php';
?>
