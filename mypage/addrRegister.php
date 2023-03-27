<?
	include "/home/edufim/www/module/login/head.php";
?>
<?
if($uid){
	$sql = "select * from ks_address where uid = $uid ";
	
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$uid = $row["uid"];

	$title = $row["title"]; 
	$name = $row["name"]; 
	$zipcode = $row["zipcode"]; 
	$addr01 = $row["addr01"]; 
	$addr02 = $row["addr02"]; 
	$phone = $row['phone']; 
	$default_addr = $row['default_addr'];

	$type="edit";
}

?>
<form name="FRM" method='POST' action=''>
	<input type="hidden"  name="uid" value='<?=$uid?>'/>
	<input type="hidden" name="userid" value="<?=$GBL_USERID?>" />
	<input type="hidden"  name="default_addr"  id="default_addr" />
	<input type="hidden"  name="type" value='<?=$type?>'/>

	<div class="addrRegisterWrap">
			<p class="f24 bold2 m_40">배송지 등록/수정</p>

			<div class="form_row_wrap">
					<div class="row dp_sb dp_c">
							<div class="input_tit f15 bold">배송지명<span class="c_bora01">*</span></div>
							<div class="inputWrap">
									<input type="text" name="title" placeholder="ex) 집/회사/학교" value="<?=$title?>">
							</div>
					</div>
					<div class="row dp_sb dp_c">
							<div class="input_tit f15 bold">이&nbsp;&nbsp;름<span class="c_bora01">*</span></div>
							<div class="inputWrap">
									<input type="text" name="name" placeholder="이름" value="<?=$name?>">
							</div>
					</div>
					<div class="row dp_sb">
							<div class="input_tit f15 bold">주&nbsp;&nbsp;소<span class="c_bora01">*</span></div>
							<div class="inputWrap">
									<div class="two_inputWrap">
											<input type="text" id="zipcode" name="zipcode" placeholder="우편번호 검색" value="<?=$zipcode?>">
											<button class="addrSearchBtn bold2">검색</button>
									</div>
									<input type="text" id='addr01' name='addr01' placeholder="주소를 입력해주세요" value="<?=$addr01?>">
									<input type="text" id='addr02' name='addr02'  placeholder="나머지 주소를 입력해주세요" value="<?=$addr02?>">
							</div>
					</div>
					<div class="row dp_sb dp_c">
							<div class="input_tit f15 bold">연락처<span class="c_bora01">*</span></div>
							<div class="inputWrap">
									<input type="text" name="phone" placeholder="휴대전화번호 입력"  value="<?=$phone?>">
									<div class="dp_f dp_c">
											<?
												if($default_addr && $default_addr == 1){
											?>
											<input type="checkbox" id="addr_chkbox" checked>
											<?}else {?>
											<input type="checkbox" id="addr_chkbox" >
											<?}?>
											<label class="f14" for="">기본 배송지로 저장</label>
									</div>
							</div>
					</div>
			</div>

			<p class="addr_caution f12 c_gry04 m-24">- 입력/수정하신 배송지는 배송지 목록에 저장됩니다.<br>
			- 주소지 확인 부탁드립니다. 주소지 오류로 수신이 되지않은 경우는 책임지지 않습니다.<br> 
			- 주소를 배송지목록에 추가하는 경우 개인정보 수집에 동의하는 것으로 간주됩니다.</p>
			<?
				if($uid){
			?>
				<a class="bora01 c_w dp_f dp_c dp_cc addrRegiBtn" href="javascript:chkEditForm(<?=$uid?>);" title="수정하기">수정하기</a>
			<?} else {?>
				<a class="bora01 c_w dp_f dp_c dp_cc addrRegiBtn" href="javascript:check_form();" title="등록하기">등록하기</a>
			<?}?>
	</div>
</form>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
	$(function () {
		$(".addrSearchBtn").click(function (event) {
			event.preventDefault()
			new daum.Postcode({
				oncomplete: function (data) {
					//선택시 입력값 세팅
					document.getElementById("zipcode").value = data.zonecode;
					document.getElementById("addr01").value = data.address; // 주소 넣기
					document.getElementById("addr02").focus(); //상세입력 포커싱
				},
			}).open();
		});

	
	});
	function check_form(){
		form = document.FRM;

		if(isFrmEmpty(form.title,"배송지명을 입력해 주십시오."))	return;
		if(isFrmEmpty(form.name,"이름을 입력해 주십시오."))	return;
		if(isFrmEmpty(form.zipcode,"우편번호를 입력해 주십시오.")) return;
		if(isFrmEmpty(form.addr01,"주소를 입력해 주십시오.")) return;
		if(isFrmEmpty(form.addr02,"상세주소 입력해 주십시오.")) return;
		if(isFrmEmpty(form.phone,"연락처를 입력해 주십시오."))   return;

		if($('#addr_chkbox').is(":checked")) {
			$('#default_addr').val(1);			
		}else {
			$('#default_addr').val(0);		
		}
		form.type.value = 'write';		
		form.action = './proc.php';		
		form.submit();
	}
	function chkEditForm (uid) {
		form = document.FRM;

		if(isFrmEmpty(form.title,"배송지명을 입력해 주십시오."))	return;
		if(isFrmEmpty(form.name,"이름을 입력해 주십시오."))	return;
		if(isFrmEmpty(form.zipcode,"우편번호를 입력해 주십시오.")) return;
		if(isFrmEmpty(form.addr01,"주소를 입력해 주십시오.")) return;
		if(isFrmEmpty(form.addr02,"상세주소 입력해 주십시오.")) return;
		if(isFrmEmpty(form.phone,"연락처를 입력해 주십시오."))   return;

		if($('#addr_chkbox').is(":checked")) {
			$('#default_addr').val(1);			
		}else {
			$('#default_addr').val(0);		
		}
		form.type.value = 'edit';		
		form.action = './proc.php';		
		form.submit();
	}

</script>


<style>
    @media (max-width:600px){
        .form_row_wrap {width: 92%; margin: 0 auto;}
        .form_row_wrap .input_tit {width: 22%;}
        .form_row_wrap .inputWrap {padding-left: 1%; width: 77% !important;}
        .form_row_wrap .row .two_inputWrap input[type="text"] {width: 50%;}
        .form_row_wrap .row .two_inputWrap .addrSearchBtn {width: 48%;}
		
    }
</style>