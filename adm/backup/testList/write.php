<?
	$listTime = '';

	if($type=='edit' && $uid){
		$row = sqlRow("select * from ks_order where uid='".$uid."'");

		$stylist = $row["stylist"];	
		$userid = $row["userid"];		
		$name = $row["name"];
		$phone = $row["phone"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$email = $row["email"];
		$Delivery = $row["Delivery"];
		$DeliveryNum = $row["DeliveryNum"];
		$prodCnt = $row["prodCnt"];
		$prodAmt = $row["prodAmt"];
		$status = $row["status"];
		$orderDate = $row["orderDate"];
		$listTime = $row["rTime"];

	}else{
		$orderDate = date('Y-m-d');
	}

	include 'script.php';
?>

<style>
.listTable td p{margin:0;}
.prodCnt, .prodAmt{font-size:1.5em;}
.listTable, .zTable{min-width:900px;}

.dropdown-toggle{width:200px;}
.dropdown-toggle::after{margin-left: 3.55em;}
#prod{min-width:200px;height:auto;max-height:300px;overflow-y:auto;}
</style>

<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$_SERVER['PHP_SELF']?>'>

<input type='hidden' name='prodCnt' id='prodCnt' value='<?=$prodCnt?>'>
<input type='hidden' name='prodAmt' id='prodAmt' value='<?=$prodAmt?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_rTime' value='<?=$f_rTime?>'>
<input type='hidden' name='f_userid' value='<?=$f_userid?>'>
<input type='hidden' name='f_stylist' value='<?=$f_stylist?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>
<!-- /검색관련 -->
<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">1. 상품추가</h6>
	</div>
	<div class="card-body" style='width:100%;'>
			<div class="mb20 clearfix">
				<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
					<tr>
						<th width='17%'><span class='eqc'>*</span> 분류</th>
						<td width='83%'>
							<select name="cade01" id="cade01" class="form-control" style="width:200px;display:inline-block;" onchange="selChk01();">
								<option value=''>1차분류</option>
							<?
								$row = sqlArray("select * from ks_itemCode01 order by sort asc");
								if($row){
									foreach($row as $k => $v){
							?>
								<option value="<?=$v['cade01']?>" style='padding:5px;'><?=$v['cade01']?></option>
							<?
									}
								}
							?>
							</select>

							<select name="cade02" id="cade02" class="form-control" style="width:200px;display:inline-block;" onchange="selChk02();">
								<option value=''>2차분류</option>
							</select>

							<select name="cade03" id="cade03" class="form-control" style="width:200px;display:inline-block;" onchange="selChk03();">
								<option value=''>3차분류</option>
							</select>
						</td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 상품추가</th>
						<td>
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" id="prodBtn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span id="dropTxt">등록상품없음</span>
								</button>
								<div class="dropdown-menu animated--fade-in" id="prod">
								<!--
									<a class="dropdown-item" href="javascript://"><img src='/upfile/<?=$v['upfile01']?>' style='width:50px;height:50px;'> <?=$v['title']?></a>
								-->
								</div>
							</div>
						</td>
					</tr>
				</table>

		</div>
	</div>
</div>





<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">2. 주문상품</h6>
	</div>
	<div class="card-body" style='width:100%;max-width:1000px;'>
		<div class="tbl-st-wrap01" style="clear:both;border-top:0;">
			<div class="mb20 clearfix">
				<table cellpadding='0' cellspacing='0' border='0' width='100%' id='prodTable' class='listTable'>
					<tr>
						<th width='17%'>이미지</th>
						<th width='58%'>상품정보</th>
						<th width='15%'>상태</th>
						<th width='10%'>삭제</th>
					</tr>
				<?
					//주문상품
					if($listTime){
						$row = sqlArray("select * from ks_orderList where userid='".$userid."' and rTime='".$listTime."' order by uid");

						foreach($row as $k => $v){
							$i = $k + 1;

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
							<input type='hidden' name='uChk[]' value='<?=$v['pid']?>' class='uChk'>
							<input type='hidden' name='tChk[]' value='<?=$v['title']?>'>
							<input type='hidden' name='pChk[]' value='<?=$v['price']?>' class='pChk'>
						</td>
						<td align='center'>
							<select name="sChk[]" class="form-control">
								<option value='결제대기' <?if($v['status'] == '결제대기'){echo 'selected';}?>>결제대기</option>
								<option value='반품요청' <?if($v['status'] == '반품요청'){echo 'selected';}?>>반품요청</option>
							<!--
								<option value='재신청' <?if($v['status'] == '재신청'){echo 'selected';}?>>재신청</option>
							-->
								<option value='입금대기' <?if($v['status'] == '입금대기'){echo 'selected';}?>>입금대기</option>
								<option value='결제완료' <?if($v['status'] == '결제완료'){echo 'selected';}?>>결제완료</option>
							</select>

						<!--
							<textarea name='reText[]' id='reMsg<?=$i?>' style='display:none;'><?=$v['reMsg']?></textarea>
						-->
							<input type='hidden' name='reDateChk[]' value='<?=$v['reDate']?>'>
							<input type='hidden' name='reTimeChk[]' value='<?=$v['reTime']?>'>

						<?
							if($v['status'] == '반품요청'){
						?>
							<a href="javascript:formModal('반품사유',<?=$listTime?>);" class='btn btn-info btn-circle btn-sm' style='margin-top:5px;' title='반품사유'>
								<i class='fas fa-exclamation-triangle'></i>
							</a>
						<?
							//재신청 사용안함
							}elseif($v['status'] == '재신청'){
						?>
							<a href="javascript:formModal('재신청사유',<?=$listTime?>);" class='btn btn-warning btn-circle btn-sm' style='margin-top:5px;' title='재신청사유'>
								<i class='fas fa-exclamation-triangle'></i>
							</a>
						<?
							}
						?>
						</td>
						<td align='center'>
							<a href='javascript:prodDel(<?=$i?>);' class='btn btn-danger btn-circle btn-sm' title='삭제'>
								<i class='fas fa-trash'></i>
							</a>
						</td>
					</tr>
				<?
						}
					}
				?>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
/*
$(function(){
	$("#stylist").keydown(function (e) {
		return false;
	});
});
*/
</script>

<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">3. 주문자 정보</h6>
	</div>
	<div class="card-body" style='width:100%;max-width:1000px;'>
		<div class="tbl-st-wrap01" style="clear:both;border-top:0;">
			<div class="mb20 clearfix">
				<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
					<tr>
						<th width='17%'><span class='eqc'>*</span> 주문자</th>
						<td width='33%'>
							<input type="text" name="userid" id="userid" class="form-control" style="width:100%;" value="<?=$userid?>" list="userList" placeholder="회원선택">
							<datalist id="userList">
							<?
								$uArr = sqlArray("select * from ks_member where mtype='M' order by uid");
								foreach($uArr as $k => $v){
									if($userid == $v['userid'])	$chk = 'selected';
									else								$chk = '';
							?>
								<option value="<?=$v['userid']?>" label="<?=$v['name']?>" <?=$chk?>><?=$v['userid']?></option>
							<?
								}
							?>
							</datalist>
						</td>
						<th width='17%'><span class='eqc'>*</span> 스타일리스트</th>
						<td width='33%'>
							<input type="text" name="stylist" id="stylist" class="form-control" style="width:100%;" value="<?=$stylist?>" list="staffList" placeholder="스타일리스트">
							<datalist id="staffList">
							<?
								$uArr = sqlArray("select * from ks_member where mtype='S' order by uid");
								foreach($uArr as $k => $v){
									if($userid == $v['userid'])	$chk = 'selected';
									else								$chk = '';
							?>
								<option value="<?=$v['userid']?>" label="<?=$v['name']?>" <?=$chk?>><?=$v['userid']?></option>
							<?
								}
							?>
							</datalist>
						</td>
					</tr>
					<tr>
						<th width='17%'><span class='eqc'>*</span> 이름</th>
						<td width='33%'><input type="text" name="name" id="name" class="form-control" value="<?=$name?>"></td>
						<th width='17%'><span class='eqc'>*</span> 연락처</th>
						<td width='33%'><input type="text" name="phone" id="phone" class="form-control" value="<?=$phone?>" onkeyup="phoneChk(this);" maxlength='13'></td>
					</tr>
					<tr>
						<th><span class='eqc'>*</span> 배송지</th>
						<td colspan='3'>
							<input type="text" name="zipcode" id="zipcode" class="form-control" style="width:70px;" value="<?=$zipcode?>" onclick="openDaumPostcode();" readonly>
							<input type="text" name="addr01" id="addr01" class="form-control" style="width:60%;margin:3px 0;" value="<?=$addr01?>" onclick="openDaumPostcode();" readonly>
							<input type="text" name="addr02" id="addr02" class="form-control" style="width:60%;" value="<?=$addr02?>">
						</td>
					</tr>
					<tr>
						<th><span class='eqc'>*</span> 이메일</th>
						<td colspan='3'><input type="text" name="email" id="email" class="form-control" value="<?=$email?>" style='width:30%;'></td>
					</tr>
					<tr>
						<th> 운송정보</th>
						<td colspan='3'>
							<?
								//택배사 정보
								$item = sqlRow("select * from ks_shopConfig");
							?>
							<select name="Delivery" id="Delivery" class="form-control" style="width:200px;display:inline-block;">
							<?
								for($i=1; $i<=3; $i++){
									$n = sprintf('%02d',$i);
									$DeliveryName = $item['DeliveryName'.$n];
									if($DeliveryName){
										if($DeliveryName == $Delivery)	$chk = 'selected';
										else										$chk ='';
							?>
								<option value='<?=$DeliveryName?>' <?=$chk?>><?=$DeliveryName?></option>
							<?
									}
								}
							?>
							</select>
							<input type="text" name="DeliveryNum" id="DeliveryNum" class="form-control" value="<?=$DeliveryNum?>" placeholder='운송장 번호' style='width:30%;display:inline-block;'>
						</td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 주문 알림톡</th>
						<td colspan='3'>
							<label class="switch">
								<input type="checkbox" name="talkType" id="talkType" value='orderList' class="switch-input">
								<span class="switch-label" data-on="발송" data-off="발송안함"></span>
								<span class="switch-handle"></span>
							</label>
						</td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 주문일</th>
						<td colspan='3'><input type="text" name="orderDate" class="form-control fpicker" value="<?=$orderDate?>" style='width:140px;'></td>
					</tr>
					<tr>
						<th><span class='eqc'>*</span> 주문 상품수</th>
						<td colspan='3'><span class='prodCnt'><?=number_format($prodCnt)?></span> 개</td>
					</tr>
					<tr>
						<th><span class='eqc'>*</span> 주문금액</th>
						<td colspan='3'><span class='prodAmt'><?=number_format($prodAmt)?></span> 원</td>
					</tr>
				</table>

			<?
				if($type == 'write'){
			?>
				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<tr>
						<td align='center' style='padding:30px 0;'>
							<a href="javascript:check_form();" class='big cbtn blue'>등록</a>&nbsp;&nbsp;
							<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
						</td>
					</tr>
				</table>

			<?
				}else{
			?>

				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<tr>
						<td width='20%'></td>
						<td width='40%' align='center' style='padding:30px 0;'>
							<a href="javascript:check_form();" class='big cbtn blue'>정보수정</a>&nbsp;&nbsp;
							<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
						</td>
						<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>주문삭제</a></td>
					</tr>
				</table>

			<?
				}
			?>
			</div>
		</div>
	</div>
</div>

</form>