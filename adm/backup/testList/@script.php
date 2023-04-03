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
			document.getElementById('zipcode').value = data.zonecode;
			document.getElementById('addr01').value = fullAddr;
			document.getElementById('addr02').focus();
		}
	}).open();
}

function selChk01(){
	c1 = $('#cade01').find('option:selected').val();

	form = document.frm01;

	//2차분류
	$.post('../itemCode/cade01_set.php',{'c1':c1}, function(c2){		
		//2차분류 selectbox 초기화
		$('#cade02').empty();
		$('#cade02').append("<option value=''>2차분류</option>");

		//3차분류 selectbox 초기화
		$('#cade03').empty();
		$('#cade03').append("<option value=''>3차분류</option>");

		c2 = urldecode(c2);
		parData = JSON.parse(c2);

		//2차분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"' style='padding:5px !important;'>"+txt+"</option>");
			$('#cade02').append(option);
		}
	});
}

function selChk02(){
	c1 = $('#cade01').find('option:selected').val();
	c2 = $('#cade02').find('option:selected').val();

	form = document.frm01;

	//3차분류
	$.post('../itemCode/cade02_set.php',{'c1':c1,'c2':c2}, function(c3){
		//3차분류 selectbox 초기화
		$('#cade03').empty();
		$('#cade03').append("<option value=''>3차분류</option>");

		c3 = urldecode(c3);
		parData = JSON.parse(c3);

		//3차분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"' style='padding:5px !important;'>"+txt+"</option>");
			$('#cade03').append(option);
		}
	});
}

function selChk03(){
	c1 = $('#cade01').find('option:selected').val();
	c2 = $('#cade02').find('option:selected').val();
	c3 = $('#cade03').find('option:selected').val();

	form = document.frm01;

	//주문상품
	$.post('json_prod.php',{'c1':c1,'c2':c2,'c3':c3}, function(prod){
		//주문상품 selectbox 초기화
		$('#prod').empty();
		$('#prod').append("<option value=''>주문상품선택</option>");

		prod = urldecode(prod);
		parData = JSON.parse(prod);

		//주문상품 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			u = parData[i]['uid'];
			txt = parData[i]['title'];
			option = $("<option value='"+u+"' style='padding:5px !important;'>"+txt+"</option>");
			$('#prod').append(option);
		}
	});
}

$(function(){
	//주문상품추가
	$("#prod").change(function(){
		uid = $(this).val();
		if(uid){
			addChk = true;

			$(".uChk").each(function() {
				tmp = $(this).val();
				if(uid == tmp){
					GblMsgBox('동일한 상품이 추가되어있습니다.','');
					addChk = false;
					return false;
				}
			});

			if(addChk){
				listNum = $("#prodTable tr").length;

				for(i=1; i<=50; i++){
					if($("#prod"+i).length == 0){

						//상품정보
						$.post('json_prodInfo.php',{'uid':uid}, function(prod){
							prod = urldecode(prod);
							parData = JSON.parse(prod);

							strHtml = 
								"<tr id='prod"+i+"'>"
									+"<td align='center'><img src='/upfile/"+parData['img']+"' style='width:100px;'></td>"
									+"<td>"
										+"<p>"+parData['cade01']+"<br>"+parData['cade02']+"<br>"+parData['cade03']+"</p>"
										+"<p style='margin-top:10px;'><b>"+parData['title']+"</b><br>"+number_format(parData['price'])+"원</p>"
										+"<input type='hidden' name='uChk[]' value='"+parData['uid']+"' class='uChk'>"
										+"<input type='hidden' name='tChk[]' value='"+parData['title']+"'>"
										+"<input type='hidden' name='pChk[]' value='"+parData['price']+"' class='pChk'>"
									+"</td>"
									+"<td align='center'>"
										+"<select name=sChk[] class=form-control>"
											+"<option value='결제대기'>결제대기</option>"
											+"<option value='반품요청'>반품요청</option>"
											+"<option value='재신청'>재신청</option>"
											+"<option value='입금대기'>입금대기</option>"
											+"<option value='결제완료'>결제완료</option>"
										+"</select>"

										+"<textarea name='reText[]' style='display:none;'></textarea>"
										+"<input type='hidden' name='reDateChk[]' value=''>"
										+"<input type='hidden' name='reTimeChk[]' value=''>"

									+"</td>"
									+"<td align='center'>"
										+"<a href='javascript:prodDel("+i+");' class='btn btn-danger btn-circle btn-sm' title='삭제'>"
											+"<i class='fas fa-trash'></i>"
										+"</a>"
									+"</td>"
								+"</tr>";

							$("#prodTable").append($(strHtml).fadeIn(200));
						});
						setTimeout(function(){orderSet()}, 100);
						return;
					}
				}

				GblMsgBox("주문 상품은 최대 50개까지 등록이 가능합니다.",'');
				return;
			}
		}
	});

	//주문자 선택
	$("#userid").change(function(){
		userid = $('#userid').val();
		if(userid == ''){
			$('#name').val('');
			$('#phone').val('');
			$('#zipcode').val('');
			$('#addr01').val('');
			$('#addr02').val('');
			$('#email').val('');

		}else{
			$.post('json_userInfo.php',{'userid':userid}, function(res){
				if(res == '100'){
					GblMsgBox("주문자 아이디를 확인해\n주시기 바랍니다.",'');
					$('#userid').val('');
					$('#name').val('');
					$('#phone').val('');
					$('#zipcode').val('');
					$('#addr01').val('');
					$('#addr02').val('');
					$('#email').val('');

				}else{
					res = urldecode(res);
					parData = JSON.parse(res);

					$('#name').val(parData['name']);
					$('#phone').val(parData['phone']);
					$('#zipcode').val(parData['zipcode']);
					$('#addr01').val(parData['addr01']);
					$('#addr02').val(parData['addr02']);
					$('#email').val(parData['email']);
				}
			});
		}
	});
});

function prodDel(n){
	$("#prod"+n).fadeOut(200, function() {
		$(this).remove();
		setTimeout(function(){orderSet()}, 100);
	});		
}

function orderSet(){
	prodCnt = 0;
	prodAmt = 0;

	$(".uChk").each(function() {
		idx = $(".uChk").index(this);
		p = $(".pChk").eq(idx).val();

		prodCnt++;
		prodAmt += parseInt(p);
	});

	$('.prodCnt').html(number_format(prodCnt));
	$('.prodAmt').html(number_format(prodAmt));	

	$('#prodCnt').val(prodCnt);
	$('#prodAmt').val(prodAmt);
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.target = "parData['name']";
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function check_form(){
	form = document.FRM;

	tmp = $(".uChk").length;
	if(tmp == 0){
		GblMsgBox("주문 상품을 추가해 주십시오.","");
		return;
	}

	if(isFrmEmptyModal(form.userid,"주문자를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.stylist,"스타일리스트를 선택해 주십시오."))	return;

	userid = $('#userid').val();

	$.post('json_userInfo.php',{'userid':userid}, function(res){
		if(res == '100'){
			GblMsgBox("주문자 아이디를 확인해\n주시기 바랍니다.",'');
			return;

		}else{
			res = urldecode(res);
			parData = JSON.parse(res);

			if(isFrmEmptyModal(form.name,"이름을 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.phone,"연락처를 입력해 주십시오."))	return;	
			if(isFrmEmptyModal(form.zipcode,"우편번호를 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.addr01,"기본주소를 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.addr02,"상세주소를 입력해 주십시오."))	return;

			if(isFrmEmptyModal(form.email,"이메일을 입력해 주십시오."))	return;

			email = $('#email').val();
			okEmail = isEmailChk(email);
			if(!okEmail){
				GblMsgBox('이메일을 정확히 기재해 주시기 바랍니다.');
				$('#email').focus();
				return;
			}

			if(isFrmEmptyModal(form.Delivery,"택배사를 선택해 주십시오."))	return;
			if(isFrmEmptyModal(form.DeliveryNum,"운송장 번호를 입력해 주십시오."))	return;

			if(isFrmEmptyModal(form.orderDate,"주문일을 선택해 주십시오."))	return;

			form.target = 'ifra_gbl';
			form.action = 'proc.php';
			form.submit();
		}
	});
}

function checkDel(){
	GblMsgConfirmBox("해당 주문을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.FRM;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function formModal(t,i){
	$("#multiBox").css({"width":"90%","max-width":"550px"});
	$('#multi_ttl').text(t);

	$('#multiFrame').css("text-align","left");
	msg = $("#reMsg"+i).val();
	$('#multiFrame').html(msg);
	$('.multiBox_open').click();
}

function checkCancel(){
	form = document.FRM;
	if(isFrmEmptyModal(form.cDate,"환불일자를 입력해 주십시오."))	return;

	form.type.value = 'cancel';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

$(function(){
	$('.switch-input').change(function(){
		if($(this).is(":checked"))		t = '1';
		else								t = '';

		uid = $(this).val();

		$.post('proc.php',{'type':'reCheck','t':t,'uid':uid}, function(){});
	});
});
</script>