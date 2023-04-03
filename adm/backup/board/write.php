<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_set where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$table_id = $row["table_id"];
		$title = $row["title"];
		$list_mod = $row["list_mod"];
		$write_chk = $row["write_chk"];
		$read_chk = $row["read_chk"];
		$reply_chk = $row["reply_chk"];
		$coment_chk = $row["coment_chk"];
		$upload_chk = $row["upload_chk"];
		$download_chk = $row["download_chk"];
		$list_mod = $row["list_mod"];

		if($list_mod == '리스트형'){	//리스트형
			$dis01 = '';
			$dis02 = '';
			$dis03 = '';
			$dis04 = '';
			$dis05 = '';
			$dis06 = '';

		}elseif($list_mod == '갤러리형'){	//갤러리형
			$dis01 = '';
			$dis02 = '';
			$dis03 = 'disabled';
			$dis04 = '';
			$dis05 = '';
			$dis06 = '';

		}elseif($list_mod == '미리보기형'){	//미리보기형
			$dis01 = '';
			$dis02 = 'disabled';
			$dis03 = 'disabled';
			$dis04 = 'disabled';
			$dis05 = 'disabled';
			$dis06 = '';

		}elseif($list_mod == '블로그형'){	//블로그형
			$dis01 = '';
			$dis02 = '';
			$dis03 = 'disabled';
			$dis04 = '';
			$dis05 = '';
			$dis06 = '';

		}elseif($list_mod == '질문과답변형'){	//질문과답변형
			$dis01 = 'disabled';
			$dis02 = '';
			$dis03 = 'disabled';
			$dis04 = 'disabled';
			$dis05 = 'disabled';
			$dis06 = 'disabled';

		}elseif($list_mod == '스케쥴러형'){	//스케쥴러형
			$dis01 = '';
			$dis02 = '';
			$dis03 = 'disabled';
			$dis04 = 'disabled';
			$dis05 = 'disabled';
			$dis06 = 'disabled';

		}elseif($list_mod == '링크형'){	//링크형
			$dis01 = 'disabled';
			$dis02 = 'disabled';
			$dis03 = 'disabled';
			$dis04 = 'disabled';
			$dis05 = 'disabled';
			$dis06 = 'disabled';

		}
	}


	$sel_chk01 = Array('전체','관리자','회원','일반');

?>

<script language='javascript'>

function CheckSet(mod){

	form = document.FRM;

	if(mod == '리스트형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '';
		form.reply_chk.disabled = false;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = false;

		//첨부파일
		form.upload_chk.disabled = false;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = false;

		form.db_write_chk.value = '';


	}else	if(mod == '갤러리형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = false;

		//첨부파일
		form.upload_chk.disabled = false;
		if(form.upload_chk[0].selected)	form.upload_chk[1].selected = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = false;

		form.db_write_chk.value = '';


	}else	if(mod == '미리보기형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = true;

		//첨부파일
		form.upload_chk.disabled = false;
		if(form.upload_chk[0].selected)	form.upload_chk[1].selected = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = true;

		form.db_write_chk.value = '';


	}else	if(mod == '블로그형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = false;

		//첨부파일
		form.upload_chk.disabled = false;
		if(form.upload_chk[0].selected)	form.upload_chk[1].selected = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = false;


		form.db_write_chk.value = '';



	}else	if(mod == '질문과답변형'){
		//쓰기권한
		form.write_chk.value = '관리자';
		form.write_chk.disabled = true;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '전체';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = true;

		//첨부파일
		form.upload_chk[0].selected = true;
		form.upload_chk.disabled = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = true;


		form.db_write_chk.value = '관리자';


	}else	if(mod == '스케쥴러형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '전체';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = true;

		//첨부파일
		form.upload_chk[0].selected = true;
		form.upload_chk.disabled = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = true;


		form.db_write_chk.value = '관리자';


	}else	if(mod == '링크형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '전체';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = true;

		//첨부파일
		form.upload_chk[0].selected = true;
		form.upload_chk.disabled = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = true;


		form.db_write_chk.value = '관리자';


	}

}

function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"게시판명을 입력해 주십시오"))	return;

	form.action = 'proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = 'up_index.php';
	form.submit();

}
</script>

<body onload='document.FRM.title.focus();'>

<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$_SERVER['PHP_SELF']?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>

<input type='hidden' name='db_write_chk' value='<?=$write_chk?>'>

<style>
	input[type="text"], input[type="password"] {
		/*display: block;*/
		width: 100%;
		min-width: inherit;
	   /* max-width: 29.2em;*/
		height:30px; 
		border-radius:3px;
		background-color: #fff;
		/*font-size: 0.9375em;*/
		padding: 0 1.4em;
		border: 1px solid #e1e1e1 !important;
		box-sizing:border-box;
		-webkit-appearance: none;
	}

	select#data01:focus, input[type="text"]:focus, input[type="password"]:focus {
		background-color: #fff;
		outline: 0;
		box-shadow: 0 0 0 0.125rem rgba(196, 216, 206, .5);
	}
	.board-select {height:30px;border:1px solid #dddddd;border-radius:3px;padding:0 2em 0 1em;vertical-align:middle; background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%235a5c69' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") right 0.75rem center/8px 10px no-repeat; -webkit-appearance: none; -moz-appearance: none; appearance: none;}
</style>

<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>

				<tr> 
					<th>게시판명</th>
				<?
					if($type == 'write'){
				?>
					<td colspan='3'><input name="title" type="text" style='width:213px;' value='<?=$title?>'></td>
				<?
					}else{
				?>
					<td><input name="title" type="text" style='width:213px;' value='<?=$title?>'></td>
					<th>게시판아이디</th>
					<td><?=$table_id?></td>
				<?
					}
				?>
				</tr>


				<tr> 
					<th width="17%">쓰기권한</th>
					<td width="33%">
						<select class="board-select" name='write_chk' <?=$dis01?> style="width:100px;">

						<?

							if(!$write_chk)	$write_chk = '전체';

							for($i=0; $i<count($sel_chk01); $i++){

								if($write_chk == $sel_chk01[$i])	$chk = 'selected';
								else	$chk = '';

								echo ("<option value='$sel_chk01[$i]' $chk>$sel_chk01[$i]</option>");
							}																		
						?>

						</select>
					</td>
					<th width="17%">읽기권한</th>
					<td width="33%">
						<select class="board-select" name='read_chk' <?=$dis02?> style="width:100px;">

						<?

							if(!$read_chk)	$read_chk = '전체';

							for($i=0; $i<count($sel_chk01); $i++){

								if($read_chk == $sel_chk01[$i])	$chk = 'selected';
								else	$chk = '';

								echo ("<option value='$sel_chk01[$i]' $chk>$sel_chk01[$i]</option>");
							}																		
						?>

						</select>
					</td>				
				</tr>
				<tr> 
					<th>답글기능</th>
					<td>
						<select class="board-select" name='reply_chk' <?=$dis03?> style="width:100px;">
							<option value=''>사용안함</option>

						<?

							for($i=0; $i<count($sel_chk01); $i++){

								if($reply_chk == $sel_chk01[$i])	$chk = 'selected';
								else	$chk = '';

								echo ("<option value='$sel_chk01[$i]' $chk>$sel_chk01[$i]</option>");
							}																		
						?>

						</select>
					</td>
					<th>한줄의견</th>
					<td>
						<select class="board-select" name='coment_chk' <?=$dis04?> style="width:100px;">
							<option value=''>사용안함</option>

						<?

							for($i=0; $i<count($sel_chk01); $i++){

								if($coment_chk == $sel_chk01[$i])	$chk = 'selected';
								else	$chk = '';

								echo ("<option value='$sel_chk01[$i]' $chk>$sel_chk01[$i]</option>");
							}																		
						?>

						</select>
					</td>
				</tr>


				<tr> 
					<th>첨부파일</th>
					<td colspan='3'>
						<select class="board-select" name='upload_chk' <?=$dis06?> style="width:100px;">
							<option value=''>사용안함</option>

						<?
							for($i=0; $i<5; $i++){
								$k = $i + 1;

								if($k == $upload_chk)	$chk = 'selected';
								else	$chk = '';

								$ment = $k.'개';

								echo ("<option value='$k' $chk>$ment</option>");
							}																		
						?>

						</select>&nbsp;&nbsp;&nbsp;(글 등록시 파일첨부 기능을 사용합니다.)
					</td>
				</tr>

				<tr> 
					<th>다운로드</th>
					<td colspan='3'>
						<input type='checkbox' name='download_chk' value='1' <?if($download_chk) echo 'checked';?> <?=$dis05?>>&nbsp;&nbsp;&nbsp;(첨부파일 다운로드 기능을 사용합니다.)
					</td>
				</tr>

				<tr> 
					<th>리스트방식</th>
					<td colspan='3'>
						<table width='95%' border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center' style="height:50px;"><input type='radio' name='list_mod' value='리스트형' <?if($list_mod=='' || $list_mod=='리스트형') echo 'checked';?> onclick="CheckSet('리스트형')"> &nbsp;&nbsp;리스트형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view01.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center' style="height:50px;"><input type='radio' name='list_mod' value='갤러리형' <?if($list_mod=='갤러리형') echo 'checked';?> onclick="CheckSet('갤러리형')"> &nbsp;&nbsp;갤러리형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view02.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center' style="height:50px;"><input type='radio' name='list_mod' value='미리보기형' <?if($list_mod=='미리보기형') echo 'checked';?> onclick="CheckSet('미리보기형')"> &nbsp;&nbsp;미리보기형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view03.jpg'></td>
										</tr>
									</table>
								</td>
							</tr>
							
							<tr>
								<td colspan='3' height='30'></td>
							</tr>

							<tr>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center' style="height:50px;"><input type='radio' name='list_mod' value='블로그형' <?if($list_mod=='블로그형') echo 'checked';?> onclick="CheckSet('블로그형')"> &nbsp;&nbsp;블로그형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view04.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center' style="height:50px;"><input type='radio' name='list_mod' value='질문과답변형' <?if($list_mod=='질문과답변형') echo 'checked';?> onclick="CheckSet('질문과답변형')"> &nbsp;&nbsp;질문과답변형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view05.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center' style="height:50px;"><input type='radio' name='list_mod' value='스케쥴러형' <?if($list_mod=='스케쥴러형') echo 'checked';?> onclick="CheckSet('스케쥴러형')"> &nbsp;&nbsp;스케쥴러형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view06.jpg'></td>
										</tr>
									</table>
								</td>
							</tr>

							<tr>
								<td colspan='3' height='30'></td>
							</tr>

							<tr>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center' style="height:50px;"><input type='radio' name='list_mod' value='지도형' <?if($list_mod=='지도형') echo 'checked';?> onclick="CheckSet('지도형')"> &nbsp;&nbsp;지도형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view07.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center' style="height:50px;"><input type='radio' name='list_mod' value='링크형' <?if($list_mod=='링크형') echo 'checked';?> onclick="CheckSet('링크형')"> &nbsp;&nbsp;링크형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view01.jpg'></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>


			</table>


		</td>
	</tr>

	<tr>
		<td align='right' height='50'>
			<a class="btn blk" href="javascript:check_form();">등록</a>&nbsp;
			<a class="btn red" href="javascript:reg_list();">취소</a>
		</td>
	</tr>
</table>


</form>

