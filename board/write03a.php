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

	}

	if($GBL_MTYPE == 'A'){
		if(!$name)	$name = 'Admin';
		if(!$passwd)	$passwd = '1234';
	}



?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;
	
	if(isFrmEmptyModal(form.data01,"한글제목을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.data02,"영문제목을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.data03,"한글내용을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.data04,"영문내용을 입력해 주십시오"))	return;


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
	box-shadow: 0 0 0 0.2rem rgba(212, 219, 228, .5);
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


				<div class="tbl-st-row clearfix"> 
					<div class="tbl-st-col col-1">한글제목</div>
					<div class="tbl-st-col col-2"><input name="data01" type="text" id='data01' style='width:99%;' value="<?=$data01?>"></div>
				</div>

				<div class="tbl-st-row clearfix"> 
					<div class="tbl-st-col col-1">영문제목</div>
					<div class="tbl-st-col col-2"><input name="data02" type="text" id='data02' style='width:99%;' value="<?=$data02?>"></div>
				</div>

				<div class="tbl-st-row clearfix"> 
					<div class="tbl-st-col col-1">한글내용</div>
					<div class="tbl-st-col col-2"><input name="data03" type="text" id='data03' style='width:99%;' value="<?=$data03?>"></div>
				</div>

				<div class="tbl-st-row clearfix"> 
					<div class="tbl-st-col col-1">영문내용</div>
					<div class="tbl-st-col col-2"><input name="data04" type="text" id='data04' style='width:99%;' value="<?=$data04?>"></div>
				</div>
		

<?
	for($i=1; $i<=$upload_chk; $i++){
		$file_num = sprintf("%02d",$i);

		$upfile = ${'userfile'.$file_num};
		$realfile = ${'realfile'.$file_num};

		if($list_mod == '갤러리형' || $list_mod == '블로그형'){
			$fileTitle = "실적사진 #".($i);

		}else{
			$fileTitle = "실적사진 #".$i;
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

	<div class='mentNone' style='display:none;'>
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