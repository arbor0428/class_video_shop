<?
//달력
include '../../module/datepicker/Calendar.php';


if($type == 'edit' && $uid){

	//해당팝업의 정보를 가지고온다
	$que = "select * from tb_popup where uid='$uid'";
	$result = mysql_query($que);
	$row = mysql_fetch_array($result);


	$ptype=$row["ptype"];
	$pop_width=$row["pop_width"];
	$pop_height=$row["pop_height"];

	$pop_left=$row["pop_left"];
	$pop_top=$row["pop_top"];
	$pos_mod=$row["pos_mod"];

	$chk_width=$row["chk_width"];
	if($chk_width == "0"){$chk_width_0 = "checked";}
	if($chk_width == "1"){$chk_width_1 = "checked";}
	if($chk_width == "2"){$chk_width_2 = "checked";}
	if($chk_width == "100"){$chk_width_100 = "checked";}

	$title=$row["title"];
	$ment=$row["ment"];
	$pop_day=$row["pop_day"];
	$chk_enable=$row["chk_enable"];
	$sTime = $row["sTime"];
	$eTime = $row["eTime"];

	$scrolling=$row["scrolling"];

	if($sTime){
		$sDate = date('Y-m-d',$sTime);
		$sHour = date('H',$sTime);
		$sMin = date('i',$sTime);
	}

	if($eTime){
		$eDate = date('Y-m-d',$eTime);
		$eHour = date('H',$eTime);
		$eMin = date('i',$eTime);
	}

}


if(!$pop_left)	$pop_left = '100';
if(!$pop_top)	$pop_top = '100';

if(!$pop_width)	$pop_width = '300';
if(!$pop_height)	$pop_height = '500';

if(!$pop_day)	$pop_day = '1';

?>

<script language="javascript">
function pos_view(id){
	if(id == 'user')	document.getElementById('pos_id').style.display='';
	else	document.getElementById('pos_id').style.display='none';
}

function check_form(){
	form = document.frm01;

	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;

	if(form.pos01.value == 'user'){
		if(isFrmEmptyModal(form.pop_left,"팝업위치의 x좌표를 입력해 주십시오"))	return;
		if(isFrmEmptyModal(form.pop_top,"팝업위치의 y좌표를 입력해 주십시오"))	return;
	}

	if(form.chk_width[3].checked){
		if(isFrmEmptyModal(form.pop_width,"팝업의 넓이를 입력해 주십시오"))	return;
		if(form.pop_width.value < 250){
			alert('팝업의 넓이는 최소 250픽셀 이상이어야 합니다');
			form.pop_width.focus();
			return;
		}

		if(isFrmEmptyModal(form.pop_height,"팝업의 높이를 입력해 주십시오"))	return;
		if(form.pop_height.value < 250){
			alert('팝업의 높이는 최소 250픽셀 이상이어야 합니다');
			form.pop_height.focus();
			return;
		}
	}

	if(form.chk_enable.selectedIndex == 1){
		if(isFrmEmptyModal(form.sDate,"활성화 기간을 입력해 주십시오"))	return;
		if(isFrmEmptyModal(form.eDate,"활성화 기간을 입력해 주십시오"))	return;
	}

	if($(".note-editor").hasClass("codeview")){
		form.ment.value = $(".note-codable").val();
	}

	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function reg_list(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}


function checkDel(){
	GblMsgConfirmBox("해당 팝업을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.frm01;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}


function setSize(w,h){
	document.getElementById('pop_id').style.display = 'none';

	form = document.frm01;
	form.pop_width.value = w;
	form.pop_height.value = h;
}

function cal_view(n){
	if(n == '2')	document.getElementById('cal_id').style.display='';
	else			document.getElementById('cal_id').style.display='none';
}
</script>


<!-- / 팝업위치 미리보기 -->

<form name='frm01' method='post' action='proc.php'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type="hidden" name="record_start" value="<?=$record_start?>">
<input type="hidden" name="word" value="<?=$word?>">
<input type="hidden" name="field" value="<?=$field?>">

<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-body">
		<div class="tbl-st-wrap01" style="clear:both;border-top:0;">
			<div class="mb20 clearfix">
				<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable' style='min-width:900px;'>
					<tr>
						<th width='17%'><span class='eqc'>*</span> 유형</th>
						<td width='83%'>
							<input type='radio' name='ptype' id='p1' value='layer' <?if($ptype=='layer' || !$ptype)	echo 'checked';?>> <label for='p1'>레이어팝업</label>&nbsp;&nbsp;
							<input type='radio' name='ptype' id='p2' value='winpop' <?if($ptype=='winpop')	echo 'checked';?>> <label for='p2'>윈도우팝업창</label>
						</td>
					</tr>
					<tr>
						<td colspan='2'>*윈도우팝업창의 경우 사용자 컴퓨터 환경에 따라 팝업이 차단될 수 있습니다</td>
					</tr>
					<tr> 
						<th>제목</th>
						<td><input type="text" name="title" id="title" class="form-control" value="<?=$title?>"></td>
					</tr>
					<tr> 
						<th>위치</th>
						<td>
							<table cellpadding='0' cellspacing='0' border='0' width='100%'>
								<tr>
									<td>
										<table cellpadding='0' cellspacing='0' border='0'>
											<tr>
												<td> 
													<select name="pos01" class="form-control" style="width:140px;display:inline-block;" onclick="pos_view(this.value)">
														<option value='left' <?if($pos_mod=='left') echo 'selected';?>>왼쪽상단</option>
														<option value='center' <?if($pos_mod=='center') echo 'selected';?>>가운데</option>
														<option value='right' <?if($pos_mod=='right') echo 'selected';?>>오른쪽상단</option>
														<option value='user' <?if($pos_mod=='user') echo 'selected';?>>사용자지정</option>
													</select>
												</td>
												<td width='10'></td>
				<?
					if($pos_mod == 'user')	$pos_id_dis = '';
					else	$pos_id_dis = 'none';
				?>
												<td>
													<div id='pos_id' style="display:<?=$pos_id_dis?>">
													x좌표 : <input type='text' name='pop_left' class="form-control" value='<?=$pop_left?>' style='width:80px;display:inline-block;'>
													&nbsp;&nbsp;
													y좌표 : <input type='text' name='pop_top' class="form-control" value='<?=$pop_top?>' style='width:80px;display:inline-block;'>
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>

				<?
					if($chk_width == '100')	 $pop_id_dis = '';
					else	$pop_id_dis = 'none';
				?>

					<tr> 
						<th>크기</th>
						<td>
							<table cellpadding='0' cellspacing='0' border='0'>
								<tr>
									<td>
										<input type='radio' name='chk_width' value='0' <?if($chk_width=='0') echo 'checked';?>  onClick="setSize('600','800');"> 대(가로:600,세로:800)&nbsp;&nbsp;
										<input type='radio' name='chk_width' value='1' <?if($chk_width=='1') echo 'checked';?>  onClick="setSize('500','300');" checked> 중(가로:500,세로:300)&nbsp;&nbsp;
										<input type='radio' name='chk_width' value='2' <?if($chk_width=='2') echo 'checked';?>  onClick="setSize('250','300');"> 소(가로:250,세로:300)
									</td>
								</tr>
								<tr>
									<td style='padding-top:5px;'>
										<table cellpadding='0' cellspacing='0' border='0'>
											<tr>
												<td><input type='radio' name='chk_width' value='100' <?if($chk_width=='100') echo 'checked';?>  onClick="document.getElementById('pop_id').style.display='';"> 사용자 지정</td>
												<td style='padding-left:30px;'>
													<div id='pop_id' style="display:<?=$pop_id_dis?>">
														넓이 : <input type='text' name='pop_width' value='<?=$pop_width?>' class="form-control" style='width:80px;display:inline-block;' style='IME-MODE:disabled;'>PX&nbsp;&nbsp;
														높이 : <input type='text' name='pop_height' value='<?=$pop_height?>' class="form-control" style='width:80px;display:inline-block;' style='IME-MODE:disabled;'>PX
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<input type='hidden' name='pop_day' value='1'>

					<tr>
						<th>활성화</th>
						<td>
							<select name='chk_enable' class="form-control" style="width:200px;" onchange='cal_view(this.options[this.selectedIndex].value);'>
								<option value='1' <?if($chk_enable=='1') echo 'selected';?>>활성화 (매일)</option>
								<option value='2' <?if($chk_enable=='2') echo 'selected';?>>활성화 (기간설정)</option>
								<option value='0' <?if($chk_enable=='0') echo 'selected';?>>비활성화</option>
							</select>
						</td>
					</tr>

				<?
					if($chk_enable == '2')	$cal_id_dis = '';
					else	$cal_id_dis = 'none';
				?>

					<tr id='cal_id' style="display:<?=$cal_id_dis?>">
						<th>활성화기간</th>
						<td>
							<table cellpadding='0' cellspacing='0' border='0'>
								<tr>
									<td><input type='text' name='sDate' id='sDate' class='form-control fpicker' style='width:140px;' value='<?=$sDate?>' readonly></td>
									<td style='padding:0px 0px 0px 15px;'>
										<select name='sHour' class='form-control' style='width:70px;display:inline-block;'>
										<?
											for($i=0; $i<24; $i++){
												if($sHour == $i)	$chk = 'selected';
												else					$chk = '';

												echo ("<option value='$i' $chk>$i</option>");
											}
										?>
										</select>시&nbsp;&nbsp;
										<select name='sMin' class='form-control' style='width:70px;display:inline-block;'>
											<option value='0' <?if($sMin == '0'){echo 'selected';}?>>0</option>
											<option value='10' <?if($sMin == '10'){echo 'selected';}?>>10</option>
											<option value='20' <?if($sMin == '20'){echo 'selected';}?>>20</option>
											<option value='30' <?if($sMin == '30'){echo 'selected';}?>>30</option>
											<option value='40' <?if($sMin == '40'){echo 'selected';}?>>40</option>
											<option value='50' <?if($sMin == '50'){echo 'selected';}?>>50</option>
										</select>분
									</td>

									<td style='padding:0 20px;'>~</td>

									<td><input type='text' name='eDate' id='eDate' class='form-control fpicker' style='width:140px;' value='<?=$eDate?>' readonly></td>
									<td style='padding:0px 0px 0px 15px;'>
										<select name='eHour' class='form-control' style='width:70px;display:inline-block;'>
										<?
											for($i=0; $i<24; $i++){
												if($eHour == $i)	$chk = 'selected';
												else					$chk = '';

												echo ("<option value='$i' $chk>$i</option>");
											}
										?>
										</select>시&nbsp;&nbsp;
										<select name='eMin' class='form-control' style='width:70px;display:inline-block;'>
											<option value='0' <?if($eMin == '0'){echo 'selected';}?>>0</option>
											<option value='10' <?if($eMin == '10'){echo 'selected';}?>>10</option>
											<option value='20' <?if($eMin == '20'){echo 'selected';}?>>20</option>
											<option value='30' <?if($eMin == '30'){echo 'selected';}?>>30</option>
											<option value='40' <?if($eMin == '40'){echo 'selected';}?>>40</option>
											<option value='50' <?if($eMin == '50'){echo 'selected';}?>>50</option>
										</select>분
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<td colspan='2' style='padding: 5px 0;'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></td>
					</tr>
					<tr> 
						<td colspan='2'>
						<li>팝업을 등록을 하시더라도 비활성화를 시키시면 팝업이 동작하지 않습니다 
						<li>팝업을 띄우지않고 기존 팝업을 삭제하지않고 다음에 사용하고 싶을 경우에는 비활성화를 선택하시기 바랍니다 
						<li>비활성화 시킨 팝업은 새로 등록을 하지 않더라도 언제든지 활성화를 시키실수가 있습니다.</td>
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
							<a href="javascript:check_form();" class='big cbtn blue'>수정</a>&nbsp;&nbsp;
							<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
						</td>
						<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>팝업삭제</a></td>
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



<?
	//썸머노트
	include '../../module/summernote/lib.php';
?>