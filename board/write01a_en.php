<?

/*
	if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
		
		$title='테스트입니다';
		$name='테스트';
		$passwd='1234';
		$data02='01012345678';
		$ment='테스트입니다.';
		
	}
*/

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$passwd = $row["passwd"];
		$pwd_chk = $row["pwd_chk"];
		$notice_chk = $row["notice_chk"];
		$totalNotice_chk = $row["totalNotice_chk"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$cade03 = $row["cade03"];

		$reg_date = $row["reg_date"];

		//저장된 파일명
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];
		$userfile03 = $row["userfile03"];
		$userfile04 = $row["userfile04"];
		$userfile05 = $row["userfile05"];

		//실제 파일명
		$realfile01 = $row["realfile01"];
		$realfile02 = $row["realfile02"];
		$realfile03 = $row["realfile03"];
		$realfile04 = $row["realfile04"];
		$realfile05 = $row["realfile05"];

		$set_ry = date('Y',$reg_date);
		$set_rm = date('m',$reg_date);
		$set_rd = date('d',$reg_date);
		$set_rh = date('H',$reg_date);
		$set_ri = date('i',$reg_date);
		$set_rs = date('s',$reg_date);

	//채용정보 시
	}elseif($table_id == 'table_1639528886'){
		if(!$data01)	$data01 = date('Y-m-d');
		if(!$data02)	$data02 = date('Y-m-d',mktime()+86400);
		if(!$data03)	$data03 = '12';

	}

	if($GBL_MTYPE == 'A'){
		if(!$name)	$name = 'admin';
		if(!$passwd)	$passwd = '1234';
	}



?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;
	<?
		if($table_id=='table_1628232234'){
	?>
	if(!isOneCheckModal(form.check_1,"서비스 이용약관에 동의해 주십시오","fc1"))	return;
	<?
		}
	?>
	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.passwd,"비밀번호를 입력해 주십시오"))	return;

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(){
	
	if(confirm('글을 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

}

</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value="<?=$type?>">
<input type='hidden' name='uid' value="<?=$uid?>">
<input type='hidden' name='userid' value="<?=$GBL_USERID?>">
<input type='hidden' name='next_url' value="<?=$PHP_SELF?>">
<input type='hidden' name='record_start' value="<?=$record_start?>">
<input type='hidden' name='field' value="<?=$field?>">
<input type='hidden' name='word' value="<?=$word?>">
<input type='hidden' name='f_data01' value="<?=$f_data01?>">
<input type='hidden' name='strRoot' value="<?=$strRoot?>">
<input type='hidden' name='boardRoot' value="<?=$boardRoot?>">

<input type='hidden' name='table_id' value="<?=$table_id?>">
<input type='hidden' name='dbfile01' value="<?=$userfile01?>">
<input type='hidden' name='dbfile02' value="<?=$userfile02?>">
<input type='hidden' name='dbfile03' value="<?=$userfile03?>">
<input type='hidden' name='dbfile04' value="<?=$userfile04?>">
<input type='hidden' name='dbfile05' value="<?=$userfile05?>">

<input type='hidden' name='realfile01' value="<?=$realfile01?>">
<input type='hidden' name='realfile02' value="<?=$realfile02?>">
<input type='hidden' name='realfile03' value="<?=$realfile03?>">
<input type='hidden' name='realfile04' value="<?=$realfile04?>">
<input type='hidden' name='realfile05' value="<?=$realfile05?>">

<input type='hidden' name='engChk' value="<?=$engChk?>">


<style>
select#data01 {
width: 200px;
padding: .6rem .5rem;
border: 1px solid #e1e1e1;
font-family: inherit;
/*background: url("/images/arrow.jpg") no-repeat 100%;*/
background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%235a5c69' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") right 0.75rem center/8px 10px no-repeat;
 border-radius: 0.35rem;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;

}

.tbl-st {border-top:1px solid #ddd;}
.tbl-st-row {display:table; width:100%; min-height:50px; border-bottom:1px solid #ddd; /*background:#f5f5f5;*/}
.tbl-st-row .tbl-st-col {display:table-cell; vertical-align:middle;}

.tbl-st-row .tbl-st-col input[type="text"], .tbl-st-row .tbl-st-col input[type="password"] {
	/*display: block;*/
    width: 100%;
    min-width: inherit;
   /* max-width: 29.2em;*/
    height: 2.53333em;
    background-color: #fff;
    /*font-size: 0.9375em;*/
    padding: 0 1.4em;
    border: 1px solid #e1e1e1;
    border-radius: 0.35rem;
	box-sizing:border-box;
	-webkit-appearance: none;
}

select#data01:focus, .tbl-st-row .tbl-st-col input[type="text"]:focus, .tbl-st-row .tbl-st-col input[type="password"]:focus {
	background-color: #fff;
	outline: 0;
	box-shadow: 0 0 0 0.125rem rgba(196, 216, 206, .5);
}

/*--------스타일 수정하기....................-----*/
.tbl-st-row .col-1 {/*width:18%;*/width:240px; padding-left:2%; box-sizing:border-box; color:#070b09; font-size:0.875rem; background:#f5f5f5;}
.tbl-st-row .col-2 {/*width:82% width:73%;*/padding-left:2%; /*background:#fff;*/ box-sizing:border-box;}

.tbl-st-row-wrap .tbl-st-row {float:left; width:50%}
.tbl-st-row-wrap .tbl-st-row .col-1 {/*width:36%;*/width:240px; padding-left:4%; box-sizing:border-box;}
.tbl-st-row-wrap .tbl-st-row .col-2 {/*width:64%*/;padding-left:4%; box-sizing:border-box;}


@media screen and (max-width:768px){
.tbl-st-row-wrap .tbl-st-row {width:100%;}
.tbl-st-row-wrap .tbl-st-row .col-1 {width:18%; padding-left:2%;}
.tbl-st-row-wrap .tbl-st-row .col-2 {width:82%; padding-left:2%;}

.tbl-st-row select {-webkit-appearance: none; -moz-appearance: none; padding:0 4px; margin:4px 0;}
}

@media screen and (max-width:640px){
#smart_editor2 {min-width:100% !important; outline:1px solid red;}
.tbl-st-row .col-1 {width: 18%;}
.file_input {width: 100%;}
.file_input input[type=text] {display: inline-block !important; width: 60% !important;}
.file_input label {width: 35%; font-size: 15px;}
}
</style>

<!--등록-->



<?
	if($table_id=='table_1628232234'){
		include'agree.php';
	}
?>

<div class="tbl-st">
<?
if($GBL_MTYPE == 'A'){
?>
				<div class="tbl-st-row clearfix"> 
					<div class="tbl-st-col col-1">공지</div>
					<div class="tbl-st-col col-2"> <input name="notice_chk" type="checkbox" value='1' <?if($notice_chk=='1') echo 'checked';?>> 체크하실 경우 리스트의 최상단에 출력됩니다</div>
				</div>
<?
}else{
?>
<input type='hidden' name='notice_chk' value='<?=$notice_chk?>'>
<?
}
?>
				<?
					if($table_id == 'table_1642307954'){
						
					$sql_c = "select * from tb_board_set where table_id='$table_id'";
					$result_c = mysql_query($sql_c);
					$num_c = mysql_num_rows($result_c);
					$row_c = mysql_fetch_array($result_c);
					$cade03_chk = $row_c['cade03'];
					$cade03sort = $row_c['cade03sort'];
				?>
				<div class="tbl-st-row clearfix"> 
					<div class="tbl-st-col col-1">분류</div>
					<div class="tbl-st-col col-2">
						<input name="cade03" type="text" style='width:200px;height:30px;' value='<?=$cade03?>'>
						<select class="ipmt10" onchange="document.FRM.cade03.value=this.options[this.selectedIndex].value;"  style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
							<option value="">:: 직접입력 ::</option>
							<?
								$sql_c = "select distinct(cade03) from tb_board_list where table_id='$table_id'";
								$result_c = mysql_query($sql_c);
								while($row_c = mysql_fetch_array($result_c)){
									$cade03Txt = $row_c["cade03"];
									if($cade03Txt){
							?>
								<option value="<?=$cade03Txt?>"><?=$cade03Txt?></option>
							<?
									}
								}								
							?>
						</select>
						<!-- <select class="ipmt10" name="cade03sort" style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
							<option value="" <?if(!$cade03sort)	echo'selected';?>>:: 오름차순 ::</option>
							<option value="1" <?if($cade03sort=='1')	echo'selected';?>>:: 내림차순 ::</option>
						</select> -->
					</div>
				</div>
				<?
					}
				?>

				<div class="tbl-st-row clearfix"> 
					<div class="tbl-st-col col-1">제목</div>
					<div class="tbl-st-col col-2"><input name="title" type="text" id='title' style='width:99%;' value="<?=$title?>"></div>
				</div>
				<?
					if($table_id=='table_1639528886'){
				?>
					<div class="tbl-st-row clearfix"> 
						<div class="tbl-st-col col-1">접수기간</div>
						<div class="tbl-st-col col-2">
							<input type="text" name="data01" id="" value="<?=$data01?>" class="fpicker" placeholder="날짜 선택" autocomplete="off" style="width:150px;">
							~
							<input type="text" name="data02" id="" value="<?=$data02?>" class="fpicker" placeholder="날짜 선택" autocomplete="off" style="width:150px;">
							<select name='data03' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
													
						<?
							for($i=0; $i<=23; $i++){
								$set_rh_no = sprintf('%02d',$i);
								if($i == $data03)		$chk = 'selected';
								else						$chk = '';

								echo ("<option value='$i' $chk>$set_rh_no : 00</option>");
							}
						?>
							</select>
						</div>
					</div>
					<?
						}else{
					?>
					
				<?
					}
					if($table_id == 'table_1642307954'){
				?>
					<div class="tbl-st-row-wrap clearfix">
					<div class="tbl-st-row clearfix"> 
						<div class="tbl-st-col col-1">출원일</div>
						<div class="tbl-st-col col-2"><input name="data03" type="text" style='width:99%;' value="<?=$data03?>"></div>
					</div>

					<div class="tbl-st-row clearfix"> 
						<div class="tbl-st-col col-1">등록일</div>	
						<div class="tbl-st-col col-2">
							<input name="data04" type="text" style='width:99%;' value="<?=$data04?>">
						</div>
					</div>

				</div>
				
				<div class="tbl-st-row clearfix"> 
					<div class="tbl-st-col col-1">연락처</div>	
					<div class="tbl-st-col col-2">
						<input name="data02" type="text" style='width:99%;' value="<?=$data02?>">
					</div>
				</div>

				<?
					}	
				?>

				<div class="tbl-st-row-wrap clearfix">
					<div class="tbl-st-row clearfix"> 
						<div class="tbl-st-col col-1">작성자</div>
						<div class="tbl-st-col col-2"><input name="name" id="user_name" type="text" style='width:98%;' value="<?=$name?>"></div>
					</div>
					<div class="tbl-st-row clearfix"> 
						<div class="tbl-st-col col-1">비밀번호</div>	
						<div class="tbl-st-col col-2">
							<input name="passwd" type="password" style='width:50%;' value="<?=$passwd?>">&nbsp;
									
							<input type='radio' name='pwd_chk' value='' <?if(!$pwd_chk) echo 'checked';?>>공개
							<input type='radio' name='pwd_chk' value='1' <?if($pwd_chk) echo 'checked';?>>비공개
						
						</div>
					</div>
				</div>

<?

	if($GBL_MTYPE == 'A'){
?>
				<div class="tbl-st-row clearfix">
					<div class="tbl-st-col col-1">등록일시</div>
					<div class="tbl-st-col col-2">
						<select name='set_ry' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
						<?
							for($i=date('Y')+1; $i>=2016; $i--){
								if($i == $set_ry)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>년
						<select name='set_rm' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
						<?
							for($i=1; $i<=12; $i++){
								$set_rm_no = sprintf('%02d',$i);
								if($i == $set_rm)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>월
						<select name='set_rd' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
						<?
							for($i=1; $i<=31; $i++){
								$set_rd_no = sprintf('%02d',$i);
								if($i == $set_rd)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>일&nbsp;&nbsp;

						<select name='set_rh' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
						<?
							for($i=0; $i<=23; $i++){
								$set_rh_no = sprintf('%02d',$i);
								if($i == $set_rh)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시
						<select name='set_ri' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
						<?
							for($i=0; $i<=59; $i++){
								$set_ri_no = sprintf('%02d',$i);
								if($i == $set_ri)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>분
						<select name='set_rs' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
						<?
							for($i=0; $i<=59; $i++){
								$set_rs_no = sprintf('%02d',$i);
								if($i == $set_rs)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>초&nbsp;&nbsp;
						<input type='button' name='btn_set' value='현재시간' onclick='setToDate(this.form);' style='padding:0 10px; height:30px; border:1px solid #e1e1e1; border-radius:4px; cursor:pointer;'>
					</div>
				</div>
<?
	}
?>


<?
	for($i=1; $i<=$upload_chk; $i++){
		$file_num = sprintf("%02d",$i);

		$upfile = ${'userfile'.$file_num};
		$realfile = ${'realfile'.$file_num};

		if($list_mod == '갤러리형' || $list_mod == '블로그형'){
			if($i == 1)	$fileTitle = "썸네일";
			else			$fileTitle = "첨부파일 #".($i-1);

		}else{
			$fileTitle = "첨부파일 #".$i;
		}
?>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><?=$fileTitle?></div>
		<div class="tbl-st-col col-2">
			<div class="file_input">
				<input type="text" readonly title="File Route" id="file_route<?=$file_num?>" style="width:290px;padding:0 0 0 10px;">
				<label>찾아보기<input type="file" name="upfile<?=$file_num?>" onchange="javascript:document.getElementById('file_route<?=$file_num?>').value=this.value"></label>
			</div>
		</div>
		<?
			if($upfile){
		?>
		
		<div class="enable_btn">
			<div class="squaredThree">
				<input type="checkbox"  id="squaredDel<?=$file_num?>" type="checkbox" name="del_upfile<?=$file_num?>" value="Y" />
				<label for="squaredDel<?=$file_num?>"></label>										
			</div>
			<p style='margin:0 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile01?>)</p>
		</div>
			
		<?
			}
		?>
	</div>
<?
	}								
?>

	<div>
		<div style='padding:5px 0px;'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></div>
	</div>

<div class="con clearfix">
	<table style="float:right;">
	<?
	if($type == 'write'){
	?>
		<tr>
			<td align='right' height='50'>
				<a href="javascript:check_form();" class="btn blk">등록</a>&nbsp;
				<a href="javascript:reg_list();" class="btn gry"><!--<a href="javascript:reg_list();">-->취소</a>
			</td>
		</tr>
	<?
	}else{
	?>
		<tr>
			<td align='right' height='50'>
				<a href="javascript:check_form();" class="btn grn">수정</a>&nbsp;
				<a href="javascript:reg_del();" class="btn red">삭제</a>&nbsp;
				<a href="javascript:reg_list();" class="btn blk">목록보기</a>
			</td>
		</tr>
	<?
	}
	?>
				
	</table>
</div>

</div>


</form>

<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>