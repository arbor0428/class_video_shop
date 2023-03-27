<?
if ($type == 'edit' && $uid) { //수정할때
	$row = sqlRow("select * from ks_class where uid=$uid");
	if ($row) {
		foreach ($row as $k => $v) {
			${$k} = $v;
		}
	} else {
		Msg::backMsg('접근오류');
		exit;
	}
	//비고
	//if ($ment)	$ment = Util::textareaDecodeing($ment);
	//if ($ment2)	$ment2 = Util::textareaDecodeing($ment2);
}

$cade01_arr = sqlArray("SELECT * FROM ks_class_cade01 ORDER BY sort");
?>

<style>
	.input-30 {
		width: 30%;
	}

	.form-group {
		margin-bottom: 0 !important;
	}

	.text-white-50 {
		padding-top: 10px !important;
	}

	@media (max-width: 768px) {
		.input-30 {
			width: 30% !important;
		}
	}
</style>


<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<script>
	function goList() {
		history.back();
	}

	function formChk() {
		form = document.frm01;

		if (isFrmEmpty(form.title, "강좌명을 입력해 주십시오.")) return;

		oEditors.getById["ment01"].exec("UPDATE_CONTENTS_FIELD", []);
		oEditors2.getById["ment02"].exec("UPDATE_CONTENTS_FIELD", []);
		//form.target = 'ifra_gbl';
		form.action = 'proc.php';
		form.submit();
	}

	function userDel() {
		if (confirm('해당 데이터를 삭제하시겠습니까?')) {
			form = document.frm01;

			form.type.value = 'del';
			//	form.target = 'ifra_gbl';
			form.action = 'proc.php';
			form.submit();
		}
	}

	const getCade = function(input) {
		const cade01 = input.value
		if (cade01 == "") {
			$('select[name=cade02]').empty();
			return;
		}
		$.ajax({
			url: "/module/common/proc_class_cade.php",
			data: {
				"cade01": cade01,
			},
			method: "get",
			success: (response) => {
				const cade02 = JSON.parse(response)
				let ele = '';
				for (const cade of cade02) {
					const uid = cade['uid']
					const title = cade['title']
					ele += `<option value="${uid}">${title}</option>`;
				}
				$('select[name=cade02]').empty();
				$('select[name=cade02]').append(ele);
			},
			error: (xhr, status, errorThrown) => {
				GblMsgBox("구매오류 관리자에게 문의 바랍니다");
				console.log(xhr, errorThrown, status);
			}
		})
	}
</script>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
	<input type='text' style='display:none;'>
	<input type='hidden' name='uid' value='<?= $uid ?>'>
	<input type='hidden' name='type' id='type' value='<?= $type ?>'>
	<input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
	<input type='hidden' name='f_status' value="<?= $f_status ?>">
	<input type='hidden' name='f_userid' value="<?= $f_userid ?>">
	<input type='hidden' name='f_name' value="<?= $f_name ?>">
	<input type='hidden' name='f_sort' value="<?= $f_sort ?>">

	<div class="tbl-st">
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>1차 분류</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<select type="text" name="cade01" id="cade01" class="form-control " value="" onchange="getCade(this)">
						<option value="">선택</option>
						<? foreach ($cade01_arr as $cade) { ?>
							<option value="<?= $cade['uid'] ?>" <? if ($cade['uid'] == $cade01) echo "selected"; ?>><?= $cade['title'] ?></option>
						<? } ?>
					</select>
				</div>
			</div>
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>2차 분류</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<select type="text" name="cade02" id="cade02" class="form-control " value="">
						<?
						if ($type == 'edit') {
							$cade02_arr = sqlArray("SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort");
							foreach ($cade02_arr as $cade) {
						?>
								<option value="<?= $cade['uid'] ?>" <? if ($cade['uid'] == $cade02) echo "selected"; ?>><?= $cade['title'] ?></option>
							<? } ?>
						<? } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>클래스명</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<input type="text" name="title" id="title" class="form-control " value="<?= $title ?>">
				</div>
			</div>
		</div>
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>설명</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<input type="text" name="exp" id="exp" class="form-control " value="<?= $exp ?>">
				</div>
			</div>
		</div>
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>대상부위</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<input type="text" name="target" id="target" class="form-control " value="<?= $target ?>">
				</div>
			</div>
		</div>
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>수강기간</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<input type="text" name="period" id="period" class="form-control " value="<?= $period ?>">
				</div>
			</div>

			<div class="cols_20 cols_ th"><span class='eqc'>*</span>금액</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<input type="text" name="price" id="price" class="form-control " value="<?= $price ?>">
				</div>
			</div>
		</div>
		<!-- <div class="cols">
			<div class="cols_20 cols_ th">할인율</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<input type="text" name="discountRate" id="discountRate" class="form-control " value="<?= $discountRate ?>">
				</div>
			</div>

			<div class="cols_20 cols_ th">할인금액</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<input type="text" name="discountPrice" id="discountPrice" class="form-control " value="<?= $discountPrice ?>">
				</div>
			</div>
		</div> -->
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>썸네일</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<table cellpadding='0' cellspacing='0' border='0' width='100%'>
						<?
						if ($upfile01) {
							$imgFile = $path . 'thumb_' . $upfile01;
							if (!is_file($imgFile))	$imgFile = $path . $upfile01;
							$imgFile = "/upfile/class/" . $upfile01;
						?>
							<tr>
								<td style='padding:0 0 10px 0;'><img src='<?= $imgFile ?>' style='width:100px;'></td>
							</tr>
						<?
						}
						?>
						<tr>
							<td>
								<div class="file_input">
									<input type="text" readonly title="File Route" id="file_route01">
									<label>찾아보기<input type="file" name="upfile01" onchange="javascript:document.getElementById('file_route01').value=this.value"></label><br>
									<!-- (가로:800px * 세로:450px / 사진의 크기가 다를 경우 사진이 잘리거나 깨져보일 수 있습니다.) -->
								</div>

							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- <div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>업로드2</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<table cellpadding='0' cellspacing='0' border='0' width='100%'>
						<?
						/*if ($upfile02) {
							$imgFile = $path . 'thumb_' . $upfile02;
							if (!is_file($imgFile))	$imgFile = $path . $upfile02;
							$imgFile = "/upfile/class/" . $upfile02;
						?>
							<tr>
								<td style='padding:0 0 10px 0;'><img src='<?= $imgFile ?>' style='width:100px;'></td>
							</tr>
						<?
						}
						?>
						<tr>
							<td>
								<div class="file_input">
									<input type="text" readonly title="File Route" id="file_route02">
									<label>찾아보기<input type="file" name="upfile02" onchange="javascript:document.getElementById('file_route02').value=this.value"></label><br>
								</div>

							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>업로드3</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<table cellpadding='0' cellspacing='0' border='0' width='100%'>
						<?
						if ($upfile03) {
							$imgFile = $path . 'thumb_' . $upfile03;
							if (!is_file($imgFile))	$imgFile = $path . $upfile03;
							$imgFile = "/upfile/class/" . $upfile03;
						?>
							<tr>
								<td style='padding:0 0 10px 0;'><img src='<?= $imgFile ?>' style='width:100px;'></td>
							</tr>
						<?
						}*/
						?>
						<tr>
							<td>
								<div class="file_input">
									<input type="text" readonly title="File Route" id="file_route03">
									<label>찾아보기<input type="file" name="upfile03" onchange="javascript:document.getElementById('file_route03').value=this.value"></label><br>
								</div>

							</td>
						</tr>
					</table>
				</div>
			</div>
		</div> -->
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>미리보기</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<input type="text" name="key01" id="key01" class="form-control " value="<?= $key01 ?>">
				</div>
			</div>

			<div class="cols_20 cols_ th"><span class='eqc'>*</span>광고</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<input type="text" name="key02" id="key02" class="form-control " value="<?= $key02 ?>">
				</div>
			</div>
		</div>
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>상세정보</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<textarea name='ment01' id='ment01' style='width:100%;height:540px;border:1px solid #ccc;resize:none;'><?= $ment01 ?></textarea>
				</div>
			</div>
		</div>
		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>유의사항</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<textarea name='ment02' id='ment02' style='width:100%;height:540px;border:1px solid #ccc;resize:none;'><?= $ment02 ?></textarea>
				</div>
			</div>
		</div>

		<!--
			<div class="cols">
				<div class="cols_20 cols_ th"><span class='eqc'>*</span>생년월일</div>
				<div class="cols_80 cols_">
					<div class="form-group">
						<input type="text" name="bDate01" id="bDate01" class="form-control input-30 fpicker" value="<?= $bDate01 ?>">
					</div>
				</div>
			</div>

			<div class="cols">
				<div class="cols_20 cols_ th"><span class='eqc'>*</span>성 별</div>
				<div class="cols_80 cols_">
					<div class="form-group">
						<select name="gender01" id="gender01" class="form-control" style='width:120px;'>
							<option value='1' <? if ($gender01 == '1') {
													echo 'selected';
												} ?>>남자</option>
							<option value='0' <? if ($gender01 == '0') {
													echo 'selected';
												} ?>>여자</option>
						</select>
					</div>
				</div>
			</div>
		-->

	</div>

	<div style='width:100%;margin:40px 0;text-align:center;'>

		<a href="javascript:goList();" class="btn btn-secondary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-list"></i>
			</span>
			<span class="text">목록으로</span>
		</a>

		<a href="javascript:formChk();" class="btn btn-success btn-icon-split" style="margin-left:20px;">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<? if ($type == 'write') { ?>
				<span class="text">등록하기</span>
			<? } else { ?>
				<span class="text">수정하기</span>
			<? } ?>
		</a>
		<?
		if ($type == 'edit') {
		?>
			<a href="javascript:userDel();" class="btn btn-danger btn-icon-split" style="margin-left:20px;">
				<span class="icon text-white-50">
					<i class="fas fa-trash"></i>
				</span>
				<span class="text">삭제하기</span>
			</a>
		<?
		}
		?>
	</div>

	<iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>

</form>

<script type="text/javascript">
	var oEditors = [];

	nhn.husky.EZCreator.createInIFrame({

		oAppRef: oEditors,

		elPlaceHolder: "ment01",

		sSkinURI: "/smarteditor/SmartEditor2Skin.html",

		/* 페이지 벗어나는 경고창 없애기 */
		htParams: {
			bUseToolbar: true,
			bUseVerticalResizer: false,
			fOnBeforeUnload: function() {},
			fOnAppLoad: function() {}
		},

		fCreator: "createSEditor2"

	});


	var oEditors2 = [];

	nhn.husky.EZCreator.createInIFrame({

		oAppRef: oEditors2,

		elPlaceHolder: "ment02",

		sSkinURI: "/smarteditor/SmartEditor2Skin.html",

		/* 페이지 벗어나는 경고창 없애기 */
		htParams: {
			bUseToolbar: true,
			bUseVerticalResizer: false,
			fOnBeforeUnload: function() {},
			fOnAppLoad: function() {}
		},

		fCreator: "createSEditor2"

	});
</script>