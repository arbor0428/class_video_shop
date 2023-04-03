<script language='javascript'>
	function setUpDown01(mode) {
		var form = document.frm01;
		var code_list = form.code_list01;
		var intPos = code_list.selectedIndex;
		var intLen = code_list.length;
		var strValue, strText;


		if (intPos == -1) {
			GblMsgBox('카테고리을 선택해 주십시오.');
			return;

		} else {

			if (mode == 'up') {
				if (intPos != 0 && intLen >= 2) {
					strValue = code_list[intPos - 1].value;
					strText = code_list[intPos - 1].text;
					code_list[intPos - 1].value = code_list[intPos].value;
					code_list[intPos - 1].text = code_list[intPos].text;
					code_list[intPos].value = strValue;
					code_list[intPos].text = strText;
					code_list[intPos - 1].selected = true;
				}
			} else {
				if (intPos != intLen - 1 && intLen >= 2) {
					strValue = code_list[intPos + 1].value;
					strText = code_list[intPos + 1].text;
					code_list[intPos + 1].value = code_list[intPos].value;
					code_list[intPos + 1].text = code_list[intPos].text;
					code_list[intPos].value = strValue;
					code_list[intPos].text = strText;
					code_list[intPos + 1].selected = true;
				}
			}
		}
	}


	function saveOrder01() {
		var form = document.frm01;
		var order_list = "";

		code_list = form.code_list01;

		for (i = 0; i < code_list.length; i++) {
			order_list += code_list[i].value + "|+|";
		}

		form.sort_cade01.value = order_list;

		form.type.value = 'sort';
		form.action = 'cade01_proc.php';
		form.submit();
	}

	function selChk01() {
		c1 = $('#code_list01').find('option:selected').val();

		form = document.frm01;

		form.e_cade01.value = c1;
		form.o_cade01.value = c1;

		form.e_cade02.value = '';
		form.o_cade02.value = '';

		//진료항목
		$.post('cade01_set.php', {
			'c1': c1
		}, function(c2) {
			//진료항목 selectbox 초기화
			$('#code_list02').empty();

			c2 = urldecode(c2);
			parData = JSON.parse(c2);

			//진료항목 selectbox 옵션설정	
			for (i = 0; i < parData.length; i++) {
				txt = parData[i];
				option = $("<option value='" + txt + "' style='padding:5px !important;'>" + txt + "</option>");
				$('#code_list02').append(option);
			}
		});
	}


	function cade01_save() {
		form = document.frm01;
		if (isFrmEmptyModal(form.w_cade01, "카테고리을 입력해 주십시오")) return;

		form.type.value = 'write';
		form.action = 'cade01_proc.php';
		form.submit();
	}



	function cade01_modify() {
		form = document.frm01;
		var code_list = form.code_list01;
		var intPos = code_list.selectedIndex;

		if (intPos == -1) {
			GblMsgBox('수정하실 카테고리을 선택해 주십시오');
			return;

		} else {
			if (isFrmEmptyModal(form.e_cade01, "카테고리을 입력해 주십시오")) return;

			c1 = $('#code_list01').find('option:selected').val();
			e1 = $('#e_cade01').val();

			if (c1 == e1) {
				GblMsgBox('카테고리이 변경되지 않았습니다.');
				return;

			} else {
				form.type.value = 'edit';
				form.action = 'cade01_proc.php';
				form.submit();
			}

		}
	}


	function cade01_delete() {
		form = document.frm01;
		var code_list = form.code_list01;
		var intPos = code_list.selectedIndex;

		if (intPos == -1) {
			GblMsgBox('삭제하실 카테고리을 선택해 주십시오');
			return;

		} else {
			let cade02_cnt = $('#code_list02 option').length;
			strText = code_list[intPos].text;
			if (confirm(strText + '을(를) 삭제하시겠습니까?')) {

				if (cade02_cnt > 0) {
					if (confirm('하위 카테고리가 존재합니다. 하위 카테고리와 함께 정말 삭제하시겠습니까?')) {
						form.type.value = 'del';
						form.action = 'cade01_proc.php';
						form.submit();
					} else {
						return;
					}
				} else {
					form.type.value = 'del';
					form.action = 'cade01_proc.php';
					form.submit();
				}

			} else {
				return;

			}

		}
	}
</script>

<div class='cadeBox'>
	<div class='cadeLeft'><input type="text" name="w_cade01" class="form-control" value="" style='width:100%;display:inline-block;' placeholder='카테고리 입력' onkeypress="if(event.keyCode==13){cade01_save();}"></div>
	<!-- <div class='cadeRight'><a href="javascript:cade01_save();" class="btn btn-sm btn-primary btn-icon-split" style="margin-top:3px;"><span class="text">등록하기</span></a></div> -->
</div>

<div class='cadeBox' style='padding:5px 0;'>
	<div class='cadeLeft'>
		<select name="code_list01" id="code_list01" class="form-control" size='2' style='width:100%;height:260px;background:none;' onchange="selChk01();">
			<?
			$row = sqlArray("select * from ks_license_cade01 order by sort asc");
			if ($row) {
				foreach ($row as $k => $v) {
					$db_cade01 = $v['title'];
					if($cade01) {
						$result = mysql_query("SELECT title FROM ks_license_cade01 WHERE uid=$cade01") or die("연결실패");
						$row = mysql_fetch_array($result);
						$cade01_title = $row[0];
					}

					if ($cade01_title == $db_cade01)	$chk = 'selected';
					else						$chk = '';
			?>
					<option value="<?= $db_cade01 ?>" style='padding:5px;' <?= $chk ?>><?= $db_cade01 ?></option>
			<?
				}
			}
			?>
		</select>
	</div>
	<div class='cadeRight'>
		<table cellpadding='0' cellspacing='0' border='0' style='margin-top:100px;'>
			<tr>
				<!-- <td>
					<p style='margin:0;'><a href="javascript:setUpDown01('up')" title='위로'><img src="./img/up.gif"></a></p>
					<p style='margin:3px 0 0 0;'><a href="javascript:setUpDown01('down')" title='아래로'><img src="./img/down.gif"></a></p>
				</td>
				<td style='padding-left:12px;'><a href="javascript:saveOrder01();" class="btn btn-sm btn-secondary btn-icon-split"><img src="./img/save.gif"><span class="text">순서<br>저장</span></a></td> -->
			</tr>
		</table>
	</div>
</div>

<div class='cadeBox'>
	<div class='cadeLeft'><input type="text" name="e_cade01" id="e_cade01" class="form-control" value="<?= $cade01_title ?>" style='width:100%;display:inline-block;' placeholder='카테고리 선택' onkeypress="if(event.keyCode==13){cade01_modify();}"></div>
	<div class='cadeRight'>
		<!-- <a href="javascript:cade01_modify();" class="btn btn-sm btn-secondary btn-icon-split" style="margin-top:3px;"><span class="text">수정</span></a>
		<a href="javascript:cade01_delete();" class="btn btn-sm btn-danger btn-icon-split" style="margin-top:3px;"><span class="text">삭제</span></a> -->
	</div>
</div>


<input type='hidden' name='o_cade01' value="<?= $cade01_title ?>">
<input type='hidden' name='sort_cade01' value="">

<iframe src="<?= $gurl ?>" name='ifra00' width='0' height='0' frameborder='0' scrolling='no'></iframe>