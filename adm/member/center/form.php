<?
	include '../head.php';

	if(!$GBL_USERID){
		Msg::backMsg('접근오류');
		exit;
	}


	$row = sqlRow("select * from ks_member where uid='$uid'");
	if($row){
		foreach($row as $k => $v){
			${$k} = $v;
		}
	}else{
		Msg::backMsg('접근오류');
		exit;
	}


	//달력
	include '../../module/datepicker/Calendar.php';

	$query2 = "select * from ks_centerList where uid='$cuid'";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);

		$name = $row2["name"];
		$address = $row2["address"];
		$owner  = $row2["owner"];
		$RegistrationNum = $row2["RegistrationNum"];
		$cure = $row2["cure"];
		$test = $row2["test"];
		$homepage = $row2["homepage"];
		$treatment = $row2["treatment"];
		$customer  = $row2["customer"];
		$category = $row2["category"];
		$num = $row2["num"];
		$phonenum = $row2["phonenum"];
		$email = $row2["email"];
		$wtime = $row2["wtime"];
		$parkingarea = $row2["parkingarea"];
		$parkingtikets = $row2["parkingtikets"];
		$service = $row2["service"];
		$voucher = $row2["voucher"];
		$intro = $row2["intro"];
		$insurance = $row2["insurance"];
		$regioncurrency = $row2["regioncurrency"];
		$refund = $row2["refund"];
		$Photo = $row2["Photo"];
		//$posx = $row2["posx"];
		//$posy = $row2["posy"];

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

function formChk(){
	form = document.frm01;

//	if(isFrmEmpty(form.name,"이름을 입력해 주십시오."))	return;
	if(isFrmEmpty(form.phone,"연락처를 입력해 주십시오."))	return;
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
	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();

}

function userDel(){
	if(confirm('해당 데이터를 삭제하시겠습니까?')){
		form = document.frm01;
		form.type.value = 'del';
		form.target = 'ifra_gbl';
		form.action = 'proc.php';
		form.submit();
	}
}
</script>

<form name='frm01' class="user" method='post' action=''>
<input type='text' style='display:none;'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='cuid' value='<?=$cuid?>'>
<input type='hidden' name='type' id='type' value='<?=$type?>'>


<input type='hidden' name='f_status' value="<?=$f_status?>">
<input type='hidden' name='f_userid' value="<?=$f_userid?>">
<input type='hidden' name='f_name' value="<?=$f_name?>">
<input type='hidden' name='f_sort' value="<?=$f_sort?>">

<div class="tbl-st">
	
	<div class="cols">
		<div class="cols_20 cols_ th" style="text-align:center;">가입정보</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>상태</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<select name="status" id="status" class="form-control" style='width:120px;'>
					<option value='1' <?if($status == '1'){echo 'selected';}?>>정상</option>
					<option value='' <?if($status == ''){echo 'selected';}?>>탈퇴</option>
					<option value='2' <?if($status == '2'){echo 'selected';}?>>미승인</option>
				</select>
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>등급</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<label class="switch">
					<input type="checkbox" name="level" id="level" value='vip' class="switch-input" <?if($level == 'vip'){echo 'checked';}?>>
					<span class="switch-label" data-on="VIP" data-off="일반"></span>
					<span class="switch-handle"></span>
				</label>
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>아이디</div>
		<div class="cols_80 cols_">
			<div class="form-group"><?=$userid?></div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>연락처</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="phone" id="phone" class="form-control input-50" value="<?=$phone?>" onkeyup="phoneChk(this);" maxlength='13'>
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>비밀번호</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="password" name="passwd" id="passwd" class="form-control input-50" value="" placeholder="변경시에만 입력">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>이메일</div>
		<div class="cols_80 cols_">
			<div class="form-group">
			<?
				if(!$email01){
			?>
				<input type="text" name="memberEmail" id="memberEmail" class="form-control input-50" value="">
			<?
				} else {	
			?>
				<input type="text" name="memberEmail" id="memberEmail" class="form-control input-50" value="<?=$email01.'@'.$email02?>">
			<?
				}	
			?>
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">광고수신동의</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<label class="switch">
					<input type="checkbox" name="receiveChk" id="receiveChk" value='y' class="switch-input" <?if($receiveChk == 'y'){echo 'checked';}?>>
					<span class="switch-label" data-on="동의" data-off="동의안함"></span>
					<span class="switch-handle"></span>
				</label>
			</div>
		</div>
	</div>

	
	<div class="cols">
		<div class="cols_20 cols_ th" style="text-align:center;">센터정보</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">센터명</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="name" id="name" class="form-control input-80" value="<?=$name?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">주소</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="address" id="address" class="form-control input-80" value="<?=$address?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">대표</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="owner" id="owner" class="form-control input-80" value="<?=$owner?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">등록번호</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="RegistrationNum" id="RegistrationNum" class="form-control input-80" value="<?=$RegistrationNum?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">치료법</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="cure" id="cure" class="form-control input-80" value="<?=$cure?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">테스트</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="test" id="test" class="form-control input-80" value="<?=$test?>">
			</div>
		</div>
	</div>

	<div class="cols">
		<div class="cols_20 cols_ th">홈페이지</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="homepage" id="homepage" class="form-control input-80" value="<?=$homepage?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">치료</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="treatment" id="treatment" class="form-control input-80" value="<?=$treatment?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">고객연령</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="customer" id="customer" class="form-control input-80" value="<?=$customer?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">센터유형</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="category" id="category" class="form-control input-80" value="<?=$category?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">연락처</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="num" id="num" class="form-control input-80" value="<?=$num?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">휴대폰번호</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="phonenum" id="phonenum" class="form-control input-80" value="<?=$phonenum?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">이메일</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="email" id="email" class="form-control input-80" value="<?=$email?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">운영시간</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="wtime" id="wtime" class="form-control input-80" value="<?=$wtime?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">주차정보</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="parkingarea" id="parkingarea" class="form-control input-80" value="<?=$parkingarea?>">
			</div>
		</div>
	</div>
			
	<div class="cols">
		<div class="cols_20 cols_ th">주차권</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="parkingtikets" id="parkingtikets" class="form-control input-80" value="<?=$parkingtikets?>">
			</div>
		</div>
	</div>
	
	<div class="cols">
		<div class="cols_20 cols_ th">서비스</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="service" id="service" class="form-control input-80" value="<?=$service?>">
			</div>
		</div>
	</div>
		
	<div class="cols">
		<div class="cols_20 cols_ th">바우처</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="voucher" id="voucher" class="form-control input-80" value="<?=$voucher?>">
			</div>
		</div>
	</div>
		
	<div class="cols">
		<div class="cols_20 cols_ th">보험</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<input type="text" name="intro" id="intro" class="form-control input-80" value="<?=$intro?>">
			</div>
		</div>
	</div>

</div>

<div style='width:100%;margin:40px 0;text-align:center;'>
	<a href="javascript:formChk();" class="btn btn-secondary btn-icon-split">
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
