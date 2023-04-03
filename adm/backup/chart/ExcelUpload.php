<?
	include '../head.php';

	if(!$GBL_USERID){
		Msg::backMsg('접근오류');
		exit;
	}
?>

<style>
.input-50{width:50%;}
.form-group{margin-bottom:0 !important;}
.text-white-50{padding-top:10px !important;}

@media (max-width: 768px){
	.input-50{width:100% !important;}
}
</style>

<script>
function fileChk(no){
	upFile = $("#upfile"+no).val();

	if( upFile != "" ){
		var ext = $('#upfile'+no).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['xlsx']) == -1) {
			alert('xlsx 파일만 등록이 가능합니다.');
			$("#upfile"+no).val('');
			$("#file_route"+no).val('');
			return;

		}else{
			var fileSize = 0;

			// 브라우저 확인
			var browser=navigator.appName;

			file = document.frm01['upfile'+no];
			
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
				alert('5MB 이상의 파일은 등록할 수 없습니다.');
				$("#upfile"+no).val('');
				$("#file_route"+no).val('');
				return;
			}
		}
	}

	$("#file_route"+no).val(upFile);
}

function checkForm(){
	form = document.frm01;
	if(isFrmEmpty(form.upfile01,"엑셀파일을 첨부해 주십시오."))	return;
	
	form.target = '';
	form.action = 'ExcelProc.php';
	form.submit();
}
</script>

<form name='frm01' action="<?=$_SERVER['PHP_SELF']?>" method='post' ENCTYPE="multipart/form-data">
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>

<div style='margin-bottom:3px;'><a href='SampleDown.php' class='big cbtn green' style='padding:6px 15px;'><i class="fas fa-download"></i> 샘플다운</a></div>

<div class="tbl-st">
	<div class="cols">
		<div class="cols_20 cols_ th"><span class='eqc'>*</span>엑셀등록</div>
		<div class="cols_80 cols_">
			<div class="form-group">
				<div class="file_input">
					<input type="text" readonly title="File Route" id="file_route01" style="width:220px;padding:0 0 0 10px;height:30px;" placeholder="xlsx 파일만 등록이 가능합니다.">
					<label style='margin-top:8px;'>파일선택<input type="file" name="upfile01" id="upfile01" onchange="fileChk('01');"></label>
				</div>
			</div>
		</div>
	</div>
</div>

<div style='width:100%;margin:40px 0;text-align:center;'>
	<a href="javascript:checkForm();" class="btn btn-secondary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-check"></i>
		</span>
		<span class="text">등록하기</span>
	</a>
</div>

</form>