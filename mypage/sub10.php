<?
	include '../header.php';
	$side_menu=10;
?>

<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit f20 bold2 c_bora01 nobrb">강좌 바구니</div>
			<!--수강중인 강좌가 없을때 보여지는 부분-->
			<div class="noListShow">
				<p class="txt-c bold2">강좌 바구니에 담긴 상품이 없습니다.</p>
				<p class="txt-c c_gry04 f15">나를 성장 시켜줄 좋은 지식들을 찾아보세요.</p>
				<a class="goClassList c_bora01 dp_f dp_c dp_cc" href="" title="강좌리스트 보러가기">강좌리스트 보러가기</a>
			</div>

			<!--수강중인 강좌가 있을때 보여지는 부분-->
			<div class="tableWrap">
				<div class="dp_sb m_10">
					<div class="dp_f dp_c">
						<input type="checkbox">
						<label class="f14" for="">전체선택</label>
						<span class="nmBox f14" style="margin: 0 5px;"><span class="c_bora01 f14">0</span>/2</span>
					</div>
					<div class="dp_f dp_c c_gry04 f14">선택삭제<span class="lnr lnr-cross" style="margin: 0 5px;"></span></div>
				</div>
				<table class="subTbl">
					<colgroup>
						<col style="width: 3%;">
						<col style="width: 77%;">
						<col style="width: 20%;">
					</colgroup>
					<tbody>
						<tr class="brb000">
							<th></th>
							<th>상품정보</th>
							<th>금액</th>
						</tr>
						<tr>
							<td class="nopadd">
								<input type="checkbox">
							</td>
							<td>
								<div class="dp_f">
									<div class="imgWrap gry">
										<img src="" alt="">
									</div>
									<div class="cart_tit">
										<p class="cart_tit01 bold2 txt-l">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="c_gry04 f14 txt-l">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과까지!</p>
									</div>
								</div>
							</td>
							<td>
								<a class="trDelBtn" href="" title="삭제"><span class="lnr lnr-cross"></span></a>
								<span class="f14 f18 bold2">1,999,999</span><span class="f14" style="margin-left:3px;">원</span>
							</td>
						</tr>
						<tr>
							<td class="nopadd">
								<input type="checkbox">
							</td>
							<td>
								<div class="dp_f">
									<div class="imgWrap gry">
										<img src="" alt="">
									</div>
									<div class="cart_tit">
										<p class="cart_tit01 bold2 txt-l">멀리건 기법을 이용한 관절 테크닉 1편</p>
										<p class="c_gry04 f14 txt-l">멀리건 기법을 이용한 관절 유동술 빠른 치료 효과까지!</p>
									</div>
								</div>
							</td>
							<td>
								<a class="trDelBtn" href="" title="삭제"><span class="lnr lnr-cross"></span></a>
								<span class="f14 f18 bold2">1,999,999</span><span class="f14" style="margin-left:3px;">원</span>
							</td>
						</tr>
					</tbody>
				</table>
				<span class="dp_b wid100 txt-r c_gry04 f12" style="margin-top: 5px;">※ 장바구니 리스트는 1주일 단위로 삭제됩니다.</span>
			</div>

			<div class="tableWrap">
				<p class="discount_tit f18 bold2">할인 금액</p>
				<table class="subTbl brbt0">
					<colgroup>
						<col style="width: 15%;">
						<col style="width: 85%;">
					</colgroup>
					<tbody>
						<tr>
							<th>쿠폰 할인</th>
							<td class="txt-l">
								<a class="couponBtn bora01 c_w dp_f dp_c dp_cc couponListopen" href="" title="쿠폰 적용">쿠폰 적용</a>
							</td>
						</tr>
						<tr>
							<th>적립금 사용</th>
							<td class="txt-l">
								<input class="gryinput" type="text" placeholder="0">
								<span class="f12">원</span> 
								<span class="f14">(사용가능 적립금 <span style="margin: 0 5px;">0</span>원)</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="totalAmtWrap dp_sb m-50">
				<div class="wid50">
					<p class="f20 bold2">총 결제금액</p>
				</div>
				<div class="tableWrap wid50">
					<table class="subTbl02">
						<tbody>
							<tr>
								<th>결제상품 수</th>
								<td>0개</td>
							</tr>
							<tr>
								<th>상품금액</th>
								<td>0원</td>
							</tr>
							<tr>
								<th>할인금액</th>
								<td>- 0원</td>
							</tr>
							<tr>
								<th>적립금</th>
								<td>- 0원</td>
							</tr>
							<tr class="totalTrWrap">
								<th>최종 결제금액</th>
								<td><span class="f20 bold2 c_bora01" style="margin: 0 5px;">0</span>원</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="twoBtnWrap dp_f dp_cc m-40 m_40">
				<a class="c_bora01 dp_f dp_c dp_cc" href="" title="선택상품 구매">선택상품 구매</a>
				<a class="bora01 c_w dp_f dp_c dp_cc" href="" title="전체상품 구매">전체상품 구매</a>
			</div>

			<div class="recommend_box">
				<div class="s_cont_tit f20 bold2 c_bora01 nobrb">추천 강좌</div>
				<div class="newVdSlick02">
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
		</div>
    </div>
</div>


<script>
	function tema(t){
		$('#couponListFrame').html("<iframe src='/sub09/couponList.php?uid="+t+"' name='' style='width:100%;height:655px;' frameborder='0' scrolling='auto'></iframe>");
		$('.couponList_open').click();
	}

	$(".couponListopen").click(function(event){
		tid = $(this).data('tid');
		tema(tid);
		event.preventDefault();
	});

	$('.newVdSlick02').slick({ 
		fade: false,
		dots : false,
		arrows : true,	
		autoplay : false,			// 자동 스크롤 사용 여부
		autoplaySpeed : 5000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
		slidesToShow : 3,        // 한 화면에 보여질 컨텐츠 개수
     	slidesToScroll : 1,        //스크롤 한번에 움직일 컨텐츠 개수
	});
</script>

<?
	include '../footer.php';
?>
