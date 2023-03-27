<?
include "/home/edufim/www/adm/header.php";

$row = sqlRow("SELECT * FROM ks_member WHERE uid='$uid'");
if ($row) {
	foreach ($row as $k => $v) {
		${$k} = $v;
	}
} else {
	$MSG->goMsgReload('회원 오류. 관리자 문의 바랍니다.');
	exit;
}
?>

<style>
	.input-50 {width: 50%;}
	.input-30 {width: 30%;}
	.form-group {margin-bottom: 0 !important;}
	.text-white-50 {padding-top: 10px !important;}
	@media (max-width: 768px) {
		.input-50 {width: 50% !important;}
		.input-30 {width: 30% !important;}
	}
</style>

<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script>
	function openDaumPostcode() {
		new daum.Postcode({
			oncomplete: function(data) {
				// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var fullAddr = ''; // 최종 주소 변수
				var extraAddr = ''; // 조합형 주소 변수

				// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
				if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
					fullAddr = data.roadAddress;

				} else { // 사용자가 지번 주소를 선택했을 경우(J)
					fullAddr = data.jibunAddress;
				}

				// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
				if (data.userSelectedType === 'R') {
					//법정동명이 있을 경우 추가한다.
					if (data.bname !== '') {
						extraAddr += data.bname;
					}
					// 건물명이 있을 경우 추가한다.
					if (data.buildingName !== '') {
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
					fullAddr += (extraAddr !== '' ? ' (' + extraAddr + ')' : '');
				}

				// 우편번호와 주소 정보를 해당 필드에 넣는다.			
				/*
							document.getElementById('zip01').value = data.postcode1;
							document.getElementById('zip02').value = data.postcode2;
				*/
				//			document.getElementById('zipcode').value = data.zonecode;
				document.getElementById('uid').value = fullAddr;
				document.getElementById('addr02').focus();
			}
		}).open();
	}

	function formChk() {
		form = document.frm01;

		//	if(isFrmEmpty(form.name,"이름을 입력해 주십시오."))	return;
		if (isFrmEmpty(form.phone, "연락처를 입력해 주십시오.")) return;
		/*
			if(isFrmEmpty(form.zipcode,"우편번호를 입력해 주십시오."))	return;
			if(isFrmEmpty(form.addr01,"기본주소를 입력해 주십시오."))	return;
			if(isFrmEmpty(form.addr02,"상세주소를 입력해 주십시오."))	return;
			if(isFrmEmpty(form.email,"이메일을 입력해 주십시오."))	return;

			email = $('#email').val();
			okEmail = isEmailChk(email);
			if(!okEmail){
				GblMsgBox('이메일을 정확히 기재해 주시기 바랍니다.');
				$('#email').focus();
				return;
			}

			if(isFrmEmpty(form.bDate,"생년월일을 입력해 주십시오."))	return;
		*/

		form.target = 'ifra_gbl';
		form.action = 'proc.php';
		form.submit();
	}

	function userDel() {
		if (confirm('해당 데이터를 삭제하시겠습니까?')) {
			form = document.frm01;
			form.type.value = 'del';
			form.target = 'ifra_gbl';
			form.action = 'proc.php';
			form.submit();
		}
	}
</script>

<form name='frm01' class="user wid100" method='post' action=''>
	<input type='text' style='display:none;'>
	<input type='hidden' name='uid' value='<?= $uid ?>'>
	<input type='hidden' name='type' id='type' value='<?= $type ?>'>


	<input type='hidden' name='f_status' value="<?= $f_status ?>">
	<input type='hidden' name='f_userid' value="<?= $f_userid ?>">
	<input type='hidden' name='f_name' value="<?= $f_name ?>">
	<input type='hidden' name='f_sort' value="<?= $f_sort ?>">

	<div class="tbl-st">

		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>상태</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<select name="status" id="status" class="form-control" style='width:120px;'>
						<option value='1' <? if ($status == '1') echo 'selected'; ?>>정상</option>
						<option value='2' <? if ($status == '2') echo 'selected'; ?>>휴먼</option>
						<option value='3' <? if ($status == '3') echo 'selected'; ?>>탈퇴</option>
						<option value='4' <? if ($status == '4') echo 'selected'; ?>>정지</option>
					</select>
				</div>
			</div>
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>분류</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<select name="mtype" id="mtype" class="form-control" style='width:120px;'>
						<option value='M' <? if ($mtype == 'M') echo 'selected'; ?>>사용자</option>
						<option value='T' <? if ($mtype == 'T') echo 'selected'; ?>>강사</option>
						<!-- <option value='A' <? if ($mtype == 'A') echo 'selected'; ?>>관리자</option> -->
					</select>
				</div>
			</div>
		</div>

		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>아이디</div>
			<div class="cols_80 cols_">
				<div class="form-group"><?= $userid ?></div>
			</div>
		</div>

		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>이름</div>
			<div class="cols_80 cols_">
				<div class="form-group"><?= $name ?></div>
			</div>
		</div>

		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>연락처</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<input type="text" name="phone" id="phone" class="form-control input-50" value="<?= $phone ?>" onkeyup="phoneChk(this);" maxlength='13'>
				</div>
			</div>
		</div>

		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>비밀번호</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<input type="password" name="passwd" id="passwd" class="form-control input-50" value="" placeholder="변경시 입력">
				</div>
			</div>
		</div>

		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>주소</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<input type="text" name="addr01" id="addr01" class="form-control" style="margin:3px 0;" value="<?= $addr01 ?>" onclick="openDaumPostcode();" readonly>
					<input type="text" name="addr02" id="addr02" class="form-control" value="<?= $addr02 ?>">
				</div>
			</div>
		</div>

		<div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>이메일</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<?
					if (!$email01) {
					?>
						<input type="text" name="email" id="email" class="form-control input-50" value="">
					<?
					} else {
					?>
						<input type="text" name="email" id="email" class="form-control input-50" value="<?= $email01 . '@' . $email02 ?>">
					<?
					}
					?>
				</div>
			</div>
		</div>

		<div class="cols">
			<div class="cols_20 cols_ th">마케팅 정보 수신</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<label class="switch">
						<input type="checkbox" name="receiveChk" id="receiveChk" value='checked' class="switch-input" <? if ($receiveChk == '1') echo 'checked'; ?>>
						<span class="switch-label" data-on="동의" data-off="동의안함"></span>
						<span class="switch-handle"></span>
					</label>
				</div>
			</div>
		</div>

	</div>

	<div style='width:100%;margin:40px 0;text-align:center;'>
		<a href="javascript:formChk();" class="btn btn-secondary btn-icon-split">
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
	<?
	include '/home/childpsy/www/module/popupoverlay.php';
	?>