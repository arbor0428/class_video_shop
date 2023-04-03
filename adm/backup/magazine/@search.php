<style>
.searchBox .form-control{background-color:#fff;display:inline-block;}
.searchBox .btn-icon-split .text {padding: 0.31rem 0.75rem;}
</style>

<script>
function selChk01(){
	c1 = $('#f_cade01').find('option:selected').val();

	form = document.frm01;

	//2차분류
	$.post('../itemCode/cade01_set.php',{'c1':c1}, function(c2){		
		//2차분류 selectbox 초기화
		$('#f_cade02').empty();
		$('#f_cade02').append("<option value=''>2차분류</option>");

		//3차분류 selectbox 초기화
		$('#f_cade03').empty();
		$('#f_cade03').append("<option value=''>3차분류</option>");

		c2 = urldecode(c2);
		parData = JSON.parse(c2);

		//2차분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"' style='padding:5px !important;'>"+txt+"</option>");
			$('#f_cade02').append(option);
		}
	});
}

function selChk02(){
	c1 = $('#f_cade01').find('option:selected').val();
	c2 = $('#f_cade02').find('option:selected').val();

	form = document.frm01;

	//3차분류
	$.post('../itemCode/cade02_set.php',{'c1':c1,'c2':c2}, function(c3){
		//3차분류 selectbox 초기화
		$('#f_cade03').empty();
		$('#f_cade03').append("<option value=''>3차분류</option>");

		c3 = urldecode(c3);
		parData = JSON.parse(c3);

		//3차분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"' style='padding:5px !important;'>"+txt+"</option>");
			$('#f_cade03').append(option);
		}
	});
}

function searchChk(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}
</script>

<div class='searchBox' style='width:100%;'>
	<div style="float:left;">
		<select name="f_status" id="f_status" class="form-control" style="width:120px;" onchange="searchChk();">
			<option value=''>전체</option>
			<option value='1' <?if($f_status == '1'){echo 'selected';}?>>판매중</option>
			<option value='2' <?if($f_status == '2'){echo 'selected';}?>>판매중지</option>
		</select>

		<select name="f_cade01" id="f_cade01" class="form-control" style="width:200px;" onchange="selChk01();">
			<option value=''>1차분류</option>
		<?
			$row = sqlArray("select * from ks_itemCode01 order by sort asc");
			if($row){
				foreach($row as $k => $v){
					$db_cade01 = $v['cade01'];

					if($f_cade01 == $db_cade01)	$chk = 'selected';
					else									$chk = '';
		?>
			<option value="<?=$db_cade01?>" style='padding:5px;' <?=$chk?>><?=$db_cade01?></option>
		<?
				}
			}
		?>
		</select>

		<select name="f_cade02" id="f_cade02" class="form-control" style="width:200px;" onchange="selChk02();">
			<option value=''>2차분류</option>
		<?
			if($f_cade01){
				$row = sqlArray("select * from ks_itemCode02 where cade01='".$f_cade01."' order by sort asc");
				if($row){
					foreach($row as $k => $v){
						$db_cade02 = $v['cade02'];

						if($f_cade02 == $db_cade02)	$chk = 'selected';
						else									$chk = '';
		?>
			<option value="<?=$db_cade02?>" style='padding:5px;' <?=$chk?>><?=$db_cade02?></option>
		<?
					}
				}
			}
		?>
		</select>

		<select name="f_cade03" id="f_cade03" class="form-control" style="width:200px;">
			<option value=''>3차분류</option>
		<?
			if($f_cade01 && $f_cade02){
				$row = sqlArray("select * from ks_itemCode03 where cade01='".$f_cade01."' and cade02='".$f_cade02."' order by sort asc");
				if($row){
					foreach($row as $k => $v){
						$db_cade03 = $v['cade03'];

						if($f_cade03 == $db_cade03)	$chk = 'selected';
						else									$chk = '';
		?>
			<option value="<?=$db_cade03?>" style='padding:5px;' <?=$chk?>><?=$db_cade03?></option>
		<?
					}
				}
			}
		?>
		</select>

		<input type="text" name="f_title" class="form-control" value="<?=$f_title?>" style='width:200px;' placeholder='상품명'onkeypress="if(event.keyCode==13){searchChk();}">
		<a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
			<span class="text">검색</span>
		</a>
	</div>
</div>