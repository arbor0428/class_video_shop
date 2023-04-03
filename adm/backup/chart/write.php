<?
	if($type=='edit' && $uid){
		$row = sqlRow("select * from ks_product where uid='".$uid."'");

		$status = $row["status"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$cade03 = $row["cade03"];
		$title = $row["title"];
		$price = number_format($row["price"]);
		$inven = number_format($row["inven"]);
		$memo = $row["memo"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];

		if($memo)	$memo = Util::textareaDecodeing($memo);

	}else{
		$status = '1';
	}

	include 'script.php';
?>

<form name='frm_filedown' method='post'>
<input type='hidden' name='file_name' value="<?=$upfile01?>">
<input type='hidden' name='file_rename' value="<?=$realfile01?>">
</form>

<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$_SERVER['PHP_SELF']?>'>
<input type='hidden' name='dbfile01' id='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' id='realfile01' value='<?=$realfile01?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_cade01' value='<?=$f_cade01?>'>
<input type='hidden' name='f_cade02' value='<?=$f_cade02?>'>
<input type='hidden' name='f_cade03' value='<?=$f_cade03?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<!-- /검색관련 -->

<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-body">
		<div class="tbl-st-wrap01" style="clear:both;border-top:0;">
			<div class="mb20 clearfix">
				<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable' style='min-width:900px;'>
					<tr>
						<th width='17%'><span class='eqc'>*</span> 분류</th>
						<td width='83%'>
							<select name="cade01" id="cade01" class="form-control" style="width:200px;display:inline-block;" onchange="selChk01();">
								<option value=''>1차분류</option>
							<?
								$row = sqlArray("select * from ks_itemCode01 order by sort asc");
								if($row){
									foreach($row as $k => $v){
										$db_cade01 = $v['cade01'];

										if($cade01 == $db_cade01)	$chk = 'selected';
										else									$chk = '';
							?>
								<option value="<?=$db_cade01?>" style='padding:5px;' <?=$chk?>><?=$db_cade01?></option>
							<?
									}
								}
							?>
							</select>

							<select name="cade02" id="cade02" class="form-control" style="width:200px;display:inline-block;" onchange="selChk02();">
								<option value=''>2차분류</option>
							<?
								if($cade01){
									$row = sqlArray("select * from ks_itemCode02 where cade01='".$cade01."' order by sort asc");
									if($row){
										foreach($row as $k => $v){
											$db_cade02 = $v['cade02'];

											if($cade02 == $db_cade02)	$chk = 'selected';
											else									$chk = '';
							?>
								<option value="<?=$db_cade02?>" style='padding:5px;' <?=$chk?>><?=$db_cade02?></option>
							<?
										}
									}
								}
							?>
							</select>

							<select name="cade03" id="cade03" class="form-control" style="width:200px;display:inline-block;">
								<option value=''>3차분류</option>
							<?
								if($cade01 && $cade02){
									$row = sqlArray("select * from ks_itemCode03 where cade01='".$cade01."' and cade02='".$cade02."' order by sort asc");
									if($row){
										foreach($row as $k => $v){
											$db_cade03 = $v['cade03'];

											if($cade03 == $db_cade03)	$chk = 'selected';
											else									$chk = '';
							?>
								<option value="<?=$db_cade03?>" style='padding:5px;' <?=$chk?>><?=$db_cade03?></option>
							<?
										}
									}
								}
							?>
							</select>
						</td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 상품명</th>
						<td><input type="text" name="title" id="title" class="form-control" value="<?=$title?>"></td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 상품가격</th>
						<td><input type="text" name="price" id="price" class="form-control numberOnly" style="width:120px;display:inline-block;" value="<?=$price?>"> 원</td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 재고수량</th>
						<td><input type="text" name="inven" id="inven" class="form-control numberOnly" style="width:80px;display:inline-block;" value="<?=$inven?>"> 개</td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 상품설명</th>
						<td><textarea name='memo' id='memo' class="form-control" style='width:100%;height:100px;resize:none;'><?=$memo?></textarea></td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 상품이미지</th>
						<td>
							<div class="custom-file">
								<input type="file" name="upfile01" id="upfile01" class="custom-file-input" onchange="fileChk('01');">
								<label class="custom-file-label" id="file_route01" for="upfile01" style="width:50%;">파일선택</label>
							</div>
						<?
							if($upfile01){
						?>
							<table cellpadding='0' cellspacing='0' border='0' style='margin-top:5px;'>
								<tr>
									<td><img src='/upfile/<?=$upfile01?>' style='width:100px;'></td>
									<td style='padding:0 0 0 10px;'>
										<p><?=$realfile01?></p>
										<p><a href="javascript:filedownload();" class='small cbtn green'>다운로드</a></p>
									</td>
								</tr>
							</table>
						<?
							}
						?>
						</td>
					</tr>

					<tr>
						<th><span class='eqc'>*</span> 판매상태</th>
						<td>
							<label class="switch">
								<input type="checkbox" name="status" id="status" value='1' class="switch-input" <?if($status){echo 'checked';}?>>
								<span class="switch-label" data-on="판매중" data-off="판매중지"></span>
								<span class="switch-handle"></span>
							</label>
						</td>
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
						<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>상품삭제</a></td>
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