<?
	$row = sqlRow("select * from ks_member_child where uid=$uid");
	if($row){
		foreach($row as $k => $v){
			${$k} = $v;
		}
	}else{
		Msg::backMsg('접근오류');
		exit;
	}

?>

<style>
.input-50{width:50%;}
.input-30{width:30%;}
.form-group{margin-bottom:0 !important;}
.text-white-50{padding-top:10px !important;}

@media (max-width: 768px){
	.input-50{width:50% !important;}
	.input-30{width:30% !important;}
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
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.			
/*
			document.getElementById('zip01').value = data.postcode1;
			document.getElementById('zip02').value = data.postcode2;
*/
//			document.getElementById('zipcode').value = data.zonecode;
			document.getElementById('addr01').value = fullAddr;
			document.getElementById('addr02').focus();
		}
	}).open();
}

function goList(){
	history.back();
	
}

function formChk(){
	form = document.frm01;

	if(isFrmEmpty(form.name01,"이름을 입력해 주십시오."))	return;

	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'proc2.php';
	form.submit();
}

function userDel(){
	if(confirm('해당 데이터를 삭제하시겠습니까?')){
		form = document.frm01;
		form.type.value = 'del';
		form.target = 'ifra_gbl';
		form.action = 'proc2.php';
		form.submit();
	}
}
</script>

<form name='frm01' class="user" method='post' action=''>
<input type='text' style='display:none;'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='type' id='type' value='<?=$type?>'>


<input type='hidden' name='f_status' value="<?=$f_status?>">
<input type='hidden' name='f_userid' value="<?=$f_userid?>">
<input type='hidden' name='f_name' value="<?=$f_name?>">
<input type='hidden' name='f_sort' value="<?=$f_sort?>">

<div class="tbl-st">
	
	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>이 름</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="name01" id="name01" class="form-control input-50" value="<?=$name01?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">프로필이미지</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="realfile01" id="realfile01" class="form-control input-50" value="<?=$realfile01?>" readonly>
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>성 별</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<select name="gender01" id="gender01" class="form-control" style='width:120px;'>
					<option value='1' <?if($gender01 == '1'){echo 'selected';}?>>남자</option>
					<option value='0' <?if($gender01 == '0'){echo 'selected';}?>>여자</option>
				</select>
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>소개문구</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="data01" id="data01" class="form-control input-80" value="<?=$data01?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>타이틀</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="data02" id="data02" class="form-control input-80" value="<?=$data02?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>치료영역</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="data03" id="data03" class="form-control input-80" value="<?=$data03?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>학무보님께</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="ment01" id="ment01" class="form-control input-80" value="<?=$ment01?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>학력</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="ment02" id="ment02" class="form-control input-80" value="<?=$ment02?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>자격증</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="ment03" id="ment03" class="form-control input-80" value="<?=$ment03?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>경력</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="ment04" id="ment04" class="form-control input-80" value="<?=$ment04?>">
			</div>
		</div>
	</div>



</div>

<div style='width:100%;margin:40px 0;text-align:center;'>

	<a href="javascript:goList();" class="btn btn-info btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-list"></i>
		</span>
		<span class="text">목록으로</span>
	</a>

	<a href="javascript:formChk();" class="btn btn-secondary btn-icon-split" style="margin-left:20px;">
		<span class="icon text-white-50">
			<i class="fas fa-check"></i>
		</span>
		<?if($type == 'write'){?>
		<span class="text">등록하기</span>
		<?}else{?>
		<span class="text">수정하기</span>
		<?}?>
	</a>
<?
	if($type == 'edit'){
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
