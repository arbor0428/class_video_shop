<script language='javascript'>
function setUpDown03(mode){
	var form = document.frm01;
    var code_list = form.code_list03;
	var intPos = code_list.selectedIndex;
	var intLen = code_list.length;
	var strValue, strText;

	
	if(intPos == -1){
		GblMsgBox('3차분류를 선택해 주십시오');
		return;

	}else{

		if(mode=='up'){
			if(intPos!=0 && intLen>=2){
				strValue = code_list[intPos-1].value;
				strText = code_list[intPos-1].text;
				code_list[intPos-1].value = code_list[intPos].value;
				code_list[intPos-1].text = code_list[intPos].text;
				code_list[intPos].value = strValue;
				code_list[intPos].text = strText;
				code_list[intPos-1].selected = true;
			}
		}else{
			if(intPos!=intLen-1 && intLen>=2){
				strValue = code_list[intPos+1].value;
				strText = code_list[intPos+1].text;
				code_list[intPos+1].value = code_list[intPos].value;
				code_list[intPos+1].text = code_list[intPos].text;
				code_list[intPos].value = strValue;
				code_list[intPos].text = strText;
				code_list[intPos+1].selected = true;
			}
		}


	}


}


function saveOrder03(){
	var form = document.frm01;
	var order_list = "";

    code_list = form.code_list03;
	
	for (i=0; i<code_list.length; i++){
		order_list += code_list[i].value+"|+|";
	}	

	form.sort_cade03.value=order_list;

	form.type.value = 'sort';
	form.action = 'cade03_proc.php';
	form.submit();
}


function selChk03(){
	c1 = $('#code_list01').find('option:selected').val();
	c2 = $('#code_list02').find('option:selected').val();
	c3 = $('#code_list03').find('option:selected').val();

	form = document.frm01;

	form.e_cade01.value = c1;
	form.o_cade01.value = c1;

	form.e_cade02.value = c2;
	form.o_cade02.value = c2;

	form.e_cade03.value = c3;
	form.o_cade03.value = c3;
}


function cade03_save(){
	form = document.frm01;
	var code_list = form.code_list02;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('3차분류를 등록할 2차분류를 선택해 주십시오');
		return;

	}else{
		if(isFrmEmptyModal(form.w_cade03,"3차분류를 입력해 주십시오"))	return;
		
		form.type.value = 'write';
		form.action = 'cade03_proc.php';
		form.submit();

	}
}



function cade03_modify(){
	form = document.frm01;
	var code_list = form.code_list03;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('수정하실 3차분류를 선택해 주십시오');
		return;

	}else{
		if(isFrmEmptyModal(form.e_cade03,"3차분류를 입력해 주십시오"))	return;

		c3 = $('#code_list03').find('option:selected').val();
		e3 = $('#e_cade03').val();

		if(c3 == e3){
			GblMsgBox('3차분류 내용이 변경되지 않았습니다.');
			return;

		}else{	
			form.type.value = 'edit';
			form.action = 'cade03_proc.php';
			form.submit();
		}
	}
}


function cade03_delete(){
	form = document.frm01;
	var code_list = form.code_list03;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('삭제하실 3차분류를 선택해 주십시오');
		return;

	}else{
		strText = code_list[intPos].text;
		if(confirm(strText+'을(를) 삭제하시겠습니까?')){
			form.type.value = 'del';
			form.action = 'cade03_proc.php';
			form.submit();

		}else{
			return;

		}

	}
}
</script>


<input type='hidden' name='uid_cade03' value="">
<input type='hidden' name='o_cade03' value="<?=$cade03?>">
<input type='hidden' name='sort_cade03' value="">


<div class='cadeBox'>
	<div class='cadeLeft'><input type="text" name="w_cade03" class="form-control" value="" style='width:100%;display:inline-block;' placeholder='3차분류 입력' onkeypress="if(event.keyCode==13){cade03_save();}"></div>
	<div class='cadeRight'><a href="javascript:cade03_save();" class="btn btn-sm btn-secondary btn-icon-split" style="margin-top:3px;"><span class="text">등록</span></a></div>
</div>

<div class='cadeBox' style='padding:5px 0;'>
	<div class='cadeLeft'>
		<select name="code_list03" id="code_list03" class="form-control" size='2' style='width:100%;height:260px;' onchange="selChk03();">
		<?
			if($cade01 && $cade02){
				$row = sqlArray("select * from ks_itemCode03 where cade01='".$cade01."' and cade02='".$cade02."' order by sort asc");
				if($row){
					foreach($row as $k => $v){
						$db_cade03 = $v['cade03'];

						if($cade03 == $db_cade03)	$chk = 'selected';
						else									$chk = '';
		?>
			<option value="<?=$db_cade03?>" style='padding:5px;' <?=$chk?>><?=$db_cade03?></option>
		<?
					}
				}
			}
		?>
		</select>
	</div>
	<div class='cadeRight'>
		<table cellpadding='0' cellspacing='0' border='0' style='margin-top:100px;'>
			<tr>
				<td>
					<p style='margin:0;'><a href="javascript:setUpDown03('up')" title='위로'><img src="./img/up.gif"></a></p>
					<p style='margin:3px 0 0 0;'><a href="javascript:setUpDown03('down')" title='아래로'><img src="./img/down.gif"></a></p>
				</td>
				<td style='padding-left:5px;'><a href="javascript:saveOrder03();"><img src="./img/save.gif"></a></td>
			</tr>
		</table>
	</div>
</div>

<div class='cadeBox'>
	<div class='cadeLeft'><input type="text" name="e_cade03" id="e_cade03" class="form-control" value="<?=$cade03?>" style='width:100%;display:inline-block;' placeholder='2차분류 선택' onkeypress="if(event.keyCode==13){cade03_modify();}"></div>
	<div class='cadeRight'>
		<a href="javascript:cade03_modify();" class="btn btn-sm btn-secondary btn-icon-split" style="margin-top:3px;"><span class="text">수정</span></a>
		<a href="javascript:cade03_delete();" class="btn btn-sm btn-danger btn-icon-split" style="margin-top:3px;"><span class="text">삭제</span></a>
	</div>
</div>

<iframe src="<?=$gurl?>" name='ifra02' width='0' height='0' frameborder='0' scrolling='no'></iframe>