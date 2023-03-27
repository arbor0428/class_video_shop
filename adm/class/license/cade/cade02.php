<script language='javascript'>
function setUpDown02(mode){
	var form = document.frm01;
    var code_list = form.code_list02;
	var intPos = code_list.selectedIndex;
	var intLen = code_list.length;
	var strValue, strText;

	
	if(intPos == -1){
		GblMsgBox('카테고리를 선택해 주십시오');
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


function saveOrder02(){
	var form = document.frm01;
	var order_list = "";

    code_list = form.code_list02;
	
	for (i=0; i<code_list.length; i++){
		order_list += code_list[i].value+"|+|";
	}	

	form.sort_cade02.value=order_list;

	form.type.value = 'sort';
	form.action = 'cade02_proc.php';
	form.submit();
}

function selChk02(){
	c1 = $('#code_list01').find('option:selected').val();
	c2 = $('#code_list02').find('option:selected').val();

	form = document.frm01;

	form.e_cade01.value = c1;
	form.o_cade01.value = c1;

	form.e_cade02.value = c2;
	form.o_cade02.value = c2;
}


function cade02_save(){
	form = document.frm01;
	var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('상위 카테고리를 선택해 주십시오');
		return;

	}else{
		if(isFrmEmptyModal(form.w_cade02,"카테고리를 입력해 주십시오"))	return;
		
		form.type.value = 'write';
		form.action = 'cade02_proc.php';
		form.submit();

	}
}



function cade02_modify(){
	form = document.frm01;
	var code_list = form.code_list02;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('수정하실 카테고리를 선택해 주십시오');
		return;

	}else{
		if(isFrmEmptyModal(form.e_cade02,"카테고리를 입력해 주십시오"))	return;

		c2 = $('#code_list02').find('option:selected').val();
		e2 = $('#e_cade02').val();

		if(c2 == e2){
			GblMsgBox('카테고리이 변경되지 않았습니다.');
			return;

		}else{	
			form.type.value = 'edit';
			form.action = 'cade02_proc.php';
			form.submit();
		}
	}
}


function cade02_delete(){
	form = document.frm01;
	var code_list = form.code_list02;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('삭제하실 카테고리를 선택해 주십시오');
		return;

	}else{
		strText = code_list[intPos].text;
		if(confirm(strText+'을(를) 삭제하시겠습니까?')){
			form.type.value = 'del';
			form.action = 'cade02_proc.php';
			form.submit();

		}else{
			return;

		}

	}
}
</script>




<input type='hidden' name='o_cade02' value="<?=$cade02?>">
<input type='hidden' name='sort_cade02' value="">


<div class='cadeBox'>
	<div class='cadeLeft'><input type="text" name="w_cade02" class="form-control" value="" style='width:100%;display:inline-block;' placeholder='카테고리 입력' onkeypress="if(event.keyCode==13){cade02_save();}"></div>
	<div class='cadeRight'><a href="javascript:cade02_save();" class="btn btn-sm btn-primary btn-icon-split" style="margin-top:3px;"><span class="text">등록하기</span></a></div>
</div>

<div class='cadeBox' style='padding:5px 0;'>
	<div class='cadeLeft'>
		<select name="code_list02" id="code_list02" class="form-control" size='2' style='width:100%;height:260px;background:none;' onchange="selChk02();">
		<?
			if($cade01){
				$row = sqlArray("select * from ks_license_cade02 where cade01='".$cade01."' order by sort asc");
				if($row){
					foreach($row as $k => $v){
						$db_cade02 = $v['title'];

						if($cade02 == $db_cade02)	$chk = 'selected';
						else									$chk = '';
		?>
			<option value="<?=$db_cade02?>" style='padding:5px;' <?=$chk?>><?=$db_cade02?></option>
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
					<p style='margin:0;'><a href="javascript:setUpDown02('up')" title='위로'><img src="./img/up.gif"></a></p>
					<p style='margin:3px 0 0 0;'><a href="javascript:setUpDown02('down')" title='아래로'><img src="./img/down.gif"></a></p>
				</td>
				<td style='padding-left:12px;'><a href="javascript:saveOrder02();" class="btn btn-sm btn-secondary btn-icon-split"><!--<img src="./img/save.gif">--><span class="text">순서<br>저장</span></a></td>
			</tr>
		</table>
	</div>
</div>

<div class='cadeBox'>
	<div class='cadeLeft'><input type="text" name="e_cade02" id="e_cade02" class="form-control" value="<?=$cade02?>" style='width:100%;display:inline-block;' placeholder='카테고리 선택' onkeypress="if(event.keyCode==13){cade02_modify();}"></div>
	<div class='cadeRight'>
		<a href="javascript:cade02_modify();" class="btn btn-sm btn-secondary btn-icon-split" style="margin-top:3px;"><span class="text">수정</span></a>
		<a href="javascript:cade02_delete();" class="btn btn-sm btn-danger btn-icon-split" style="margin-top:3px;"><span class="text">삭제</span></a>
	</div>
</div>


<iframe src="<?=$gurl?>" name='ifra01' width='0' height='0' frameborder='0' scrolling='no'></iframe>