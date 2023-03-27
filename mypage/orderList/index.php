<?
	include '../../header.php';
	$side_menu=13;
	$topTxt01='내 구매내역';

    $query = "SELECT o.*, p.*, m.*
        FROM ks_order o 
        JOIN ks_payment p ON o.orderId=p.orderId 
        JOIN ks_member m ON o.userid=m.userid 
        WHERE o.userid='$GBL_USERID'";

    $row_arr = sqlArray($query);

    $statusMap = Array(
        0=>'결제대기',
        1=>'결제완료',
        2=>'결제완료',
    )
?>

<?
	include '../location03.php';
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include '../sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit f20 bold2 c_bora01 nobrb">내 구매내역</div>
			<div class="tableWrap">
				<div class="divTBL">
					<div class="row dp_f dp_c">
						<div class="row_tit dp_f dp_c dp_cc">구매상품</div>
						<div class="row_tit dp_f dp_c dp_cc">주문일자</div>
						<div class="row_tit dp_f dp_c dp_cc">결제상태</div>
						<div class="row_tit dp_f dp_c dp_cc"></div>
					</div>
                    <?
                    foreach ($row_arr as $key => $row) {
                        foreach ($row as $k => $v) {
                            ${$k} = $v;
                        }

                        $class_uids = json_decode($class_uids);
                    ?>
					<div class="row">
						<div class="row_detWrap dp_f dp_c">
							<div class="row_det dp_f dp_c dp_cc"><?= $title ?></div>
							<div class="row_det dp_f dp_c dp_cc"></div>
							<div class="row_det dp_f dp_c dp_cc"><?= $rDate ?></div>
							<div class="row_det dp_f dp_c dp_cc"><div class="testStatus on dp_f dp_c dp_cc f12"><?= $statusMap[$status] ?></div></div>
							<div class="row_det dp_f dp_c dp_cc">
								<a class="f12 payDetailMore dp_f dp_c bold2" href="">
									상세내역 보기
								</a>
							</div>
						</div>

						<div class="detailToggWrap gry01">
							<div class="dp_sb detailToggBox_wrap">
								<div class="detailToggBox wid50">
									<div class="paystatusBox dp_f dp_c dp_cc c_w blk">결제정보</div>
									<div class="paytblWrap">
										<table class="paytbl">
											<tbody>
												<tr>
													<th>상품금액</th>
													<td><?= number_format($price) ?>원</td>
												</tr>
												<tr>
													<th>할인금액</th>
													<td>- <?= number_format($discountPrice) ?>원</td>
												</tr>
												<tr>
                                                    <th>사용적립금</th>
													<td>- <?= number_format($use_point) ?>원</td>
												</tr>
                                                <tr>
                                                    <th>쿠폰할인금액</th>
                                                    <td>- <?= number_format($use_coupon_price) ?>원</td>
                                                </tr>
												<tr>
													<th>결제수단</th>
													<td><?= $method ?></td>
												</tr>
												<tr>
													<th>영수증</th>
													<td><a href='<?= $receiptUrl ?>' onclick="window.open(this.href,'_blank','width=400,height=800'); return false;">바로가기↑</a></td>
												</tr>
												<!-- <tr>
													<th>입금기한</th>
													<td>2022-10-05 까지</td>
												</tr> -->
											</tbody>
										</table>
										<div class="lastTotal dp_f dp_c">
											<div class="total_tit">총 결제금액</div>
											<div class="total_det bold2"><span class="f20 c_bora01 bold2" style="margin-right: 3px;"><?= number_format($amount) ?></span>원</div>
										</div>
									</div>
								</div>
								<div class="detailToggBox wid50">
									<div class="paystatusBox dp_f dp_c dp_cc c_w blk">결제정보</div>
									<div class="paytblWrap">
										<table class="paytbl">
											<tbody>
												<tr>
													<th>배송상태</th>
													<td><?= $statusMap[$status] ?></td>
												</tr>
												<tr>
													<th>이름</th>
													<td><?= $name ?></td>
												</tr>
												<tr>
													<th>주소</th>
													<td>(<?= $zipcode ?>) <?= $addr01 ?><br><?= $addr02 ?></td>
												</tr>
												<!-- <tr>
													<th>자택</th>
													<td>--</td>
												</tr> -->
												<tr>
													<th>휴대폰</th>
													<td><?= $phone ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <? } ?>
					<!-- <div class="row">
						<div class="row_detWrap dp_f dp_c">
							<div class="row_det dp_f dp_c dp_cc">22년 필라테스 지도자 자격증 과정</div>
							<div class="row_det dp_f dp_c dp_cc">2022-09-28</div>
							<div class="row_det dp_f dp_c dp_cc"><div class="testStatus on dp_f dp_c dp_cc f12">결제완료</div></div>
							<div class="row_det dp_f dp_c dp_cc">
								<a class="f12 payDetailMore dp_f dp_c bold2" href="">
									상세내역 보기
								</a>
							</div>
						</div>
						<div class="detailToggWrap gry01">
							<div class="dp_sb detailToggBox_wrap">
								<div class="detailToggBox wid50">
									<div class="paystatusBox dp_f dp_c dp_cc c_w blk">결제정보</div>
									<div class="paytblWrap">
										<table class="paytbl">
											<tbody>
												<tr>
													<th>상품금액</th>
													<td>3,999,998원</td>
												</tr>
												<tr>
													<th>할인금액</th>
													<td>-20,000원</td>
												</tr>
												<tr>
													<th>적립금</th>
													<td>- 10,000원</td>
												</tr>
												<tr>
													<th>결제수단</th>
													<td>카드결제</td>
												</tr>
											</tbody>
										</table>
										<div class="lastTotal dp_f dp_c">
											<div class="total_tit">총 결제금액</div>
											<div class="total_det bold2"><span class="f20 c_bora01 bold2" style="margin-right: 3px;">3,969,998</span>원</div>
										</div>
									</div>
								</div>
								<div class="detailToggBox wid50">
									<div class="paystatusBox dp_f dp_c dp_cc c_w blk">결제정보</div>
									<div class="paytblWrap">
										<table class="paytbl">
											<tbody>
												<tr>
													<th>배송상태</th>
													<td>발송완료</td>
												</tr>
												<tr>
													<th>이름</th>
													<td>김철원</td>
												</tr>
												<tr>
													<th>주소</th>
													<td>( 12345 ) 서울 마포구 매봉산로 37<br>(상암동, DMC 산학협력연구센터) 605호</td>
												</tr>
												<tr>
													<th>자택</th>
													<td>--</td>
												</tr>
												<tr>
													<th>휴대폰</th>
													<td>010-1234-5678</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
    </div>
</div>

<script>
	$(".divTBL .payDetailMore").on("click",function(event){

		event.preventDefault();

		if($(this).hasClass("on")){
					
			$(this).text("상세내역 보기");
			$(this).removeClass("on");
			$(this).parent().parent().siblings(".detailToggWrap").stop().slideUp();
							
		}else{

			$(this).text("상세내역 접기");
			$(this).addClass("on");
			$(this).parent().parent().siblings(".detailToggWrap").stop().slideDown();
		}

	});
</script>

<?
	include '../../footer.php';
?>
