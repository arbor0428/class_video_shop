<script>
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

function fileChk(no){
	upFile = $("#upfile"+no).val();

	if( upFile != "" ){
		var ext = $('#upfile'+no).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg','gif','png']) == -1) {
			GblMsgBox('jpg, gif, png\n파일만 등록이 가능합니다.','');
			$("#upfile"+no).val('');
			$("#file_route"+no).html('');
			return;

		}else{
			var fileSize = 0;

			// 브라우저 확인
			var browser=navigator.appName;

			file = document.FRM['upfile'+no];
			
			// 익스플로러일 경우
			if(browser=="Microsoft Internet Explorer"){
				var oas = new ActiveXObject("Scripting.FileSystemObject");
				fileSize = oas.getFile(file.value).size;

			// 익스플로러가 아닐경우			
			}else{
				fileSize = file.files[0].size;
			}

			fS = Math.round(fileSize / 1024);

			if(fS > 5120){
				GblMsgBox('5M이상의 파일은 등록할 수 없습니다.','');
				$("#upfile"+no).val('');
				$("#file_route"+no).html('');
				return;
			}
		}
	}

	$("#file_route"+no).html(upFile);
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.cade01,"1차분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.cade02,"2차분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.cade03,"3차분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.title,"상품명을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.price,"상품가격을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.inven,"재고수량을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.memo,"상품설명을 입력해 주십시오."))	return;

	if(form.type.value == 'write'){
		if(isFrmEmptyModal(form.upfile01,"상품이미지를 등록해 주십시오."))	return;
	}

	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function checkDel(){
	GblMsgConfirmBox("해당 상품을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.FRM;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function filedownload(){
	form = document.frm_filedown;
	form.target = 'ifra_gbl';
	form.action = '/module/download.php';
	form.submit();
}
</script>