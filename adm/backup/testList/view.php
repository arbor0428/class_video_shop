<?
	$listTime = '';

	if($type=='view' && $uid){
		$row = sqlRow("select * from ks_order where uid='".$uid."'");

		$userid = $row["userid"];
		$name = $row["name"];
		$phone = $row["phone"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$email = $row["email"];
		$Delivery = $row["Delivery"];
		$DeliveryNum = $row["DeliveryNum"];
//		$prodCnt = $row["prodCnt"];
		$prodAmt = $row["prodAmt"];
		$usePoint = $row["usePoint"];
		$couponAmt = $row["couponAmt"];
		$status = $row["status"];
		$orderDate = $row["orderDate"];
		$listTime = $row["rTime"];
		$saleAmt = $row["saleAmt"];
		$cDate = $row["cDate"];
	}

	include 'script.php';
?>

<style>
.listTable td p{margin:0;}
.prodCnt, .prodAmt{font-size:1.5em;}
</style>

<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$_SERVER['PHP_SELF']?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_rTime' value='<?=$f_rTime?>'>
<input type='hidden' name='f_userid' value='<?=$f_userid?>'>
<input type='hidden' name='f_stylist' value='<?=$f_stylist?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>
<!-- /검색관련 -->


<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">1. 주문상품</h6>
	</div>
	<div class="card-body" style='width:100%;max-width:1000px;'>
		<table cellpadding='0' cellspacing='0' border='0' width='100%' id='prodTable' class='listTable'>
			<tr>
				<th width='17%'>이미지</th>
				<th width='58%'>상품정보</th>
				<th width='15%'>상태</th>
				<th width='10%'>사유</th>
			</tr>
		<?
			$prodCnt = 0;

			//주문상품
			if($listTime){
				$olist = sqlArray("select * from ks_orderList where userid='".$userid."' and rTime='".$listTime."' order by uid");

				foreach($olist as $k => $v){
					$i = $k + 1;

					if($v['status'] == '결제완료')	$prodCnt++;

					//상품정보
					$item = sqlRow("select * from ks_product where uid='".$v['pid']."'");
					$upfile01 = $item['upfile01'];
					if(!$upfile01)	$upfile01 = 'no_img.png';
		?>
			<tr id='prod<?=$i?>'>
				<td align='center'><img src='/upfile/<?=$upfile01?>' style='width:100px;'></td>
				<td>
					<p><?=$item['cade01']?><br><?=$item['cade02']?><br><?=$item['cade03']?></p>
					<p style='margin-top:10px;'><b><?=$v['title']?></b><br><?=number_format($v['price'])?>원</p>
				</td>
				<td align='center'>
					<select class="form-control sChk" data-uid="<?=$v['uid']?>">
						<option value='결제대기' <?if($v['status'] == '결제대기'){echo 'selected';}?>>결제대기</option>
						<option value='반품요청' <?if($v['status'] == '반품요청'){echo 'selected';}?>>반품요청</option>
						<option value='입금대기' <?if($v['status'] == '입금대기'){echo 'selected';}?>>입금대기</option>
						<option value='결제완료' <?if($v['status'] == '결제완료'){echo 'selected';}?>>결제완료</option>
					</select>
				<?
					if($v['status'] == '반품요청' || $v['status'] == '재신청'){
				?>
					<label class="switch">
						<input type="checkbox" value="<?=$v['uid']?>" class="switch-input" <?if($v['reChk']){echo 'checked';}?>>
						<span class="switch-label" data-on="반품확인" data-off="미확인"></span>
						<span class="switch-handle"></span>
					</label>
				<?
					}
				?>
				<!--
					<textarea name='reText[]' id='reMsg<?=$i?>' style='display:none;'><?=$v['reMsg']?></textarea>
				-->
				</td>
				<td align='center'>
				<?
					if($v['status'] == '반품요청'){
				?>
					<a href="javascript:formModal('반품사유',<?=$listTime?>);" class='btn btn-info btn-circle btn-sm' style='margin-top:5px;' title='반품사유'>
						<i class='fas fa-exclamation-triangle'></i>
					</a>
				<?
					}elseif($v['status'] == '재신청'){
				?>
					<a href="javascript:formModal('재신청사유',<?=$listTime?>);" class='btn btn-warning btn-circle btn-sm' style='margin-top:5px;' title='재신청사유'>
						<i class='fas fa-exclamation-triangle'></i>
					</a>
				<?
					}else{
						echo  '-';
					}
				?>
				</td>
			</tr>
		<?
				}
			}
		?>
		</table>
	</div>
</div>

<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">2. 주문자 정보</h6>
	</div>
	<div class="card-body" style='width:100%;max-width:1000px;'>
		<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
			<tr>
				<th><span class='eqc'>*</span> 주문자</th>
				<td colspan='3'><?=$userid?></td>
			</tr>
			<tr>
				<th width='17%'><span class='eqc'>*</span> 이름</th>
				<td width='33%'><?=$name?></td>
				<th width='17%'><span class='eqc'>*</span> 연락처</th>
				<td width='33%'><?=$phone?></td>
			</tr>
			<tr>
				<th><span class='eqc'>*</span> 배송지</th>
				<td colspan='3'>[<?=$zipcode?>] <?=$addr01?> <?=$addr02?></td>
			</tr>
			<tr>
				<th><span class='eqc'>*</span> 이메일</th>
				<td colspan='3'><?=$email?></td>
			</tr>
			<tr>
				<th><span class='eqc'>*</span> 운송정보</th>
				<td colspan='3'>[<?=$Delivery?>] <?=$DeliveryNum?></td>
			</tr>
			<tr>
				<th><span class='eqc'>*</span> 주문일</th>
				<td colspan='3'><?=$orderDate?></td>
			</tr>
			<tr>
				<th><span class='eqc'>*</span> 주문 상품수</th>
				<td colspan='3'><?=number_format($prodCnt)?> 개</td>
			</tr>
			<tr>
				<th><span class='eqc'>*</span> 주문금액</th>
				<td colspan='3'><?=number_format($prodAmt)?> 원</td>
			</tr>
		</table>
	</div>
</div>

<?
$row = sqlRow("select * from ks_payment where orderNum='".$listTime."'");
?>

<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">3. 결제 정보</h6>
	</div>
	<div class="card-body" style='width:100%;max-width:1000px;'>
		<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
			<tr>
				<th><span class='eqc'>*</span> 주문번호</th>
				<td colspan='3'><?=$listTime?></td>
			</tr>
			<tr>
				<th><span class='eqc'>*</span> 결제수단</th>
				<td colspan='3'>
				<?
					if($row['payMode'] == 'card')		echo '신용카드';
					elseif($row['payMode'] == 'acc')	echo '계좌이체';
					elseif($row['payMode'] == 'vacc')	echo '가상계좌';
					else											echo '-';
				?>
				</td>
			</tr>
			<tr>
				<th width='17%'><span class='eqc'>*</span> 사용 포인트</th>
				<td width='33%'>- <?=number_format($usePoint)?> 원</td>
				<th width='17%'><span class='eqc'>*</span> 쿠폰사용</th>
				<td width='33%'>- <?=number_format($couponAmt)?> 원</td>
			</tr>
			<tr>
				<th><span class='eqc'>*</span> 결제금액</th>
				<td><?=number_format($row['payAmt'])?> 원</td>
				<th><span class='eqc'>*</span> 즉시할인</th>
				<td>- <?=number_format($saleAmt)?> 원</td>
			</tr>

			<tr>
				<th><span class='eqc'>*</span> 환불일자</th>
				<td colspan='3'>
				<?
					if($cDate){
				?>
					<a href="javascript:checkCancel2();" class="btn btn-sm btn-danger btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas fa-check"></i>
						</span>
						<span class="text">환불취소</span>
					</a>
				<?
					}else{
				?>
					<input type="text" name="cDate" class="form-control fpicker" value="<?=$cDate?>" style='width:140px;display:inline-block;' placeholder='환불일'>
					<a href="javascript:checkCancel();" class="btn btn-sm btn-warning btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas fa-check"></i>
						</span>
						<span class="text">환불처리</span>
					</a>
				<?
					}
				?>
				</td>
			</tr>
		</table>

		<table cellpadding='0' cellspacing='0' border='0' width='100%'>
			<tr>
				<td width='20%'></td>
				<td width='40%' align='center' style='padding:30px 0;'>
					<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
				</td>
				<td width='20%' align='right'>
				<?if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){?>
					<a href="javascript:checkDel();" class='big cbtn blood'>주문삭제</a>
				<?}?>
				</td>
			</tr>
		</table>

	</div>
</div>

</form>