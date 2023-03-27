<?
if ($type == 'edit' && $uid) {
	$sql = "select * from ks_class_list where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$title = $row["title"];
	$exp = $row["exp"];
	$keyCode = $row["keyCode"];
	$length = $row["length"];
}
?>

<script language='javascript'>
	function check_form() {
		form = document.frm01;

		if (isFrmEmpty(form.title, "영상제목을 입력해 주십시오")) return;
		if (isFrmEmpty(form.exp, "간단설명을 입력해 주십시오")) return;
		if (isFrmEmpty(form.keyCode, "영상 키값을 입력해 주십시오")) return;
		if (isFrmEmpty(form.length, "영상 시간을 입력해 주십시오")) return;

		form.action = 'video_proc.php';
		form.submit();
	}

	function check_del() {
		if (confirm('영상을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다')) {
			form = document.frm01;
			form.type.value = 'del';
			form.action = 'video_proc.php';
			form.submit();
		} else {
			return;
		}
	}

	function reg_list() {
		form = document.frm01;
		form.type.value = 'list';
		form.action = 'video_index.php';
		form.submit();
	}

	function onlyNumber() {
		var key = event.keyCode;

		if (key >= 48 && key <= 57) {
			event.returnValue = true;
		} else {
			alert("숫자만 입력 가능합니다");
			event.returnValue = false;
		}
	}
</script>

<style>
	input {
		border: 1px solid #d1d1d1;
	}
</style>

<form name='frm01' action="proc.php" method='post' ENCTYPE="multipart/form-data">
	<input type='hidden' name='type' value='<?= $type ?>'>
	<input type='hidden' name='mtype' value='<?= $mtype ?>'>
	<input type='hidden' name='uid' value='<?= $uid ?>'>
	<input type='hidden' name='class_uid' value='<?= $class_uid ?>'>
	<input type='hidden' name='dbfile01' value='<?= $upfile01 ?>'>
	<input type='hidden' name='dbfile02' value='<?= $upfile02 ?>'>
	<input type='hidden' name='dbfile03' value='<?= $upfile03 ?>'>
	<input type='hidden' name='dbfile04' value='<?= $upfile04 ?>'>
	<input type='hidden' name='next_url' value='<?= $PHP_SELF ?>'>
	<input type='hidden' name='record_start' value='<?= $record_start ?>'>

	<!-- 검색관련 -->
	<input type='hidden' name='f_c02a' value='<?= $f_c02a ?>'>
	<input type='hidden' name='f_c02b' value='<?= $f_c02b ?>'>
	<input type='hidden' name='f_c02c' value='<?= $f_c02c ?>'>
	<input type='hidden' name='f_c02d' value='<?= $f_c02d ?>'>
	<input type='hidden' name='f_title' value='<?= $f_title ?>'>
	<input type='hidden' name='f_enable01' value='<?= $f_enable01 ?>'>
	<input type='hidden' name='f_enable02' value='<?= $f_enable02 ?>'>
	<!-- /검색관련 -->

	<!--등록-->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<!-- 필수정보 -->
		<tr>
			<td>
				<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
					<tr>
						<th width='20%'><?= $chk_icon01 ?> 영상명</th>
						<td width=''><input type='text' name='title' style='width:100%' value='<?= $title ?>'></td>
					</tr>
					<tr>
						<th><?= $chk_icon01 ?> 간단설명</th>
						<td width=''><input type='text' name='exp' style='width:100%' value='<?= $exp ?>'></td>
					</tr>
					<tr>
						<th><?= $chk_icon01 ?> 영상 키값</th>
						<td width=''><input type='text' name='keyCode' style='width:100%' value='<?= $keyCode ?>'></td>
					</tr>
					<tr>
						<th><?= $chk_icon01 ?> 영상 시간</th>
						<td width=''><input type='text' name='length' style='width:100%' value='<?= $length ?>'></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td align='right' height='50'>
				<div style='width:100%;margin:40px 0;text-align:center;'>

					<a href="javascript:reg_list();" class="btn btn-secondary btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas fa-list"></i>
						</span>
						<span class="text">목록으로</span>
					</a>

					<a href="javascript:check_form();" class="btn btn-success btn-icon-split" style="margin-left:20px;">
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
						<a href="javascript:check_del();" class="btn btn-danger btn-icon-split" style="margin-left:20px;">
							<span class="icon text-white-50">
								<i class="fas fa-trash"></i>
							</span>
							<span class="text">삭제하기</span>
						</a>
					<?
					}
					?>
				</div>
			</td>
		</tr>
	</table>


</form>