<style>
.ment img{
	max-width:100%;
}
</style>
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
<?
	if($uid){

		//조회수증가
		$sql = "update tb_board_list set hit = hit + 1 where uid='$uid'";
		$result = mysql_query($sql);


		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$site = $row["site"];
		$userid = $row["userid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d H:i:s",$reg_date);

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

		if($site=='재단'){
			$ment = str_replace("src=\"/smarteditor/upload/","src=\"https://ansanyouth.or.kr/smarteditor/upload/",$ment);
		}elseif($site=='상록'){
			$ment = str_replace("src=\"/smarteditor/upload/","src=\"https://sangnok.ansanyouth.or.kr/smarteditor/upload/",$ment);
		}elseif($site=='단원'){
			$ment = str_replace("src=\"/smarteditor/upload/","src=\"https://danwon.ansanyouth.or.kr/smarteditor/upload/",$ment);
		}elseif($site=='일동'){
			$ment = str_replace("src=\"/smarteditor/upload/","src=\"https://ildong.ansanyouth.or.kr/smarteditor/upload/",$ment);
		}elseif($site=='사동'){
			$ment = str_replace("src=\"/smarteditor/upload/","src=\"https://sadong.ansanyouth.or.kr/smarteditor/upload/",$ment);
		}elseif($site=='선부'){
			$ment = str_replace("src=\"/smarteditor/upload/","src=\"https://seonbu.ansanyouth.or.kr/smarteditor/upload/",$ment);
		}elseif($site=='예절'){
			$ment = str_replace("src=\"/smarteditor/upload/","src=\"https://etiquette.ansanyouth.or.kr/smarteditor/upload/",$ment);
		}

	}




?>



<script language='javascript'>
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

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_modify(){
	form = document.FRM;
	form.type.value = 'edit';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_reply(){
	form = document.FRM;
	form.type.value = 're_write';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function error_msg(mod){
	if(mod == 'r'){
		alert('답글작성 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='upid' value='<?=$uid?>'><!-- 답글작성용 -->
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>

<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$userfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$userfile03?>'>
<input type='hidden' name='dbfile04' value='<?=$userfile04?>'>
<input type='hidden' name='dbfile05' value='<?=$userfile05?>'>

<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='realfile03' value='<?=$realfile03?>'>
<input type='hidden' name='realfile04' value='<?=$realfile04?>'>
<input type='hidden' name='realfile05' value='<?=$realfile05?>'>

<input type='hidden' name='site' value='<?=$site?>'>

<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>

				<tr align="" height='30'>
									
					
					<td>
						<div class="tbl-st-row clearfix"> 
							<div class="tbl-st-col col-1">제목</div>
							<div class="tbl-st-col col-2"><input name="title" type="text" id='title' style='width:99%;' value="<?=$title?>"></div>
						</div>

						<div class="tbl-st-row-wrap clearfix">
							<div class="tbl-st-row clearfix"> 
								<div class="tbl-st-col col-1">작성자</div>
								<div class="tbl-st-col col-2"><input name="name" id="user_name" type="text" style='width:98%;' value="<?=$name?>"></div>
							</div>
							<div class="tbl-st-row clearfix"> 
								<div class="tbl-st-col col-1">업체명</div>	
								<div class="tbl-st-col col-2"><input name="data01" id="user_name" type="text" style='width:98%;' value="<?=$data01?>"></div>
							</div>
						</div>

						<div class="tbl-st-row-wrap clearfix">
							<div class="tbl-st-row clearfix"> 
								<div class="tbl-st-col col-1">일반전화</div>
								<div class="tbl-st-col col-2"><input name="data02" id="user_name" type="text" style='width:98%;' value="<?=$data02?>"></div>
							</div>
							<div class="tbl-st-row clearfix"> 
								<div class="tbl-st-col col-1">휴대전화</div>
								<div class="tbl-st-col col-2"><input name="data03" id="user_name" type="text" style='width:98%;' value="<?=$data03?>"></div>
							</div>
						</div>
						<div class="tbl-st-row clearfix"> 
							<div class="tbl-st-col col-1">이메일</div>
							<div class="tbl-st-col col-2"><input name="data04" id="user_name" type="text" style='width:98%;' value="<?=$data04?>"></div>
						</div>
					</td>
				</tr>

				

				<tr height="300" valign="top">
					<td class='bbs01' colspan='5' style="padding:30 0" id='ment'><?=$ment?></td>
				</tr>



<?

$fno = 0;
if($download_chk == '')	$upload_chk = 0;

if($list_mod == '갤러리형')	$s = 2;
else								$s = 1;

for($i=$s; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
	$file_name = ${'realfile'.$file_num};

	if($file_name){
		$fno++;
?>

				<tr>
					<th class='bbs'>첨부파일#<?=$fno?></th>
					<td class='bbs01' colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><?=$file_name?></td>
							<?
								if($download_chk){
									if($UserOS=='pc'){
							?>
								<td width='80' align='right'><a href="javascript:file_down('FRM','<?=$file_num?>');" class='mini cbtn black'>다운로드</a></td>
							<?
									}else{
							?>
								<td width='80' align='right'><a href="javascript:file_down_m('<?=${'userfile'.$file_num}?>','<?=${'realfile'.$file_num}?>');" class='mini cbtn black'>다운로드</a></td>
							<?
									}
								}
							?>
							</tr>
						</table>
					</td>
				</tr>

<?
	}
}
?>


			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='40%'>

					<!-- 수정 or 삭제시 비밀번호 입력 테이블 -->

<script language='javascript'>


function isEnter4(){
	if(event.keyCode==13){
		mod_pwd();
		return;
	}
}

function mod_pwd(){
	form = document.FRM;

	if(isFrmEmpty(form.mod_pwd,"비밀번호를 입력해 주십시오"))	return;
	form.action = '<?=$boardRoot?>pwd_proc.php';
	form.submit();

}

function tblDataPwd(mod){

	form = document.FRM;

	var tr = document.getElementById("tbl_mod");


	if(mod == 'del'){
		if(!confirm('삭제하시겠습니까?')){
			return;
		}
	}

	tr.style.display='';
	form.type.value = mod;
	form.mod_pwd.focus();


}

</script>

						<table cellpadding='0' cellspacing='0' border='0' id='tbl_mod' style="display:none;">
							<tr>
								<td><b>비밀번호</b></td>
								<td width='5'></td>
								<td><input type='password' name='mod_pwd' style='width:130px;' onKeyPress="javascript:isEnter4()"></td>
								<td width='5'></td>
								<td><a href="javascript:mod_pwd();"><img src="<?=$boardRoot?>img/pwd_ok.gif" alt="확인"></a></td>
							</tr>
						</table>

					<!-- /수정 or 삭제시 비밀번호 입력 테이블 -->

					</td>


<?
//답글쓰기 권한설정
include $boardRoot.'chk_reply.php';
?>



<?
//수정 & 삭제버튼 설정
if($GBL_MTYPE){
	if(($GBL_MTYPE == 'A' && $site==$GBL_SITE) || $GBL_USERID == $userid){
		$btn_tbl_type = 'ok';

	}else{
		$btn_tbl_type = 'pwd';

	}

}else{
	$btn_tbl_type = 'pwd';
}
?>


				<?
					if($btn_tbl_type == 'ok'){
				?>

					<td width='60%' align='right'>
						<?=$btn_re_write?>
						<a href="javascript:reg_modify();" class='btn grn'>수정</a>&nbsp;
						<a href="javascript:reg_del();" class='btn red'>삭제</a>&nbsp;
						<a href="javascript:reg_list();" class='btn blk'>목록보기</a>
					</td>

				<?
					}else{
				?>
					<td width='60%' align='right'>
					<!--
						<?=$btn_re_write?>
						<a href="javascript:tblDataPwd('edit');"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:tblDataPwd('del');"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
					-->
						<a href="javascript:reg_list();" class='btn blk'>목록보기</a>
					</td>
				<?
					}
				?>
				</tr>
			</table>
		</td>
	</tr>
</table>





<!-- 한줄의견-->
<?
include $boardRoot.'coment.php';
?>
<!-- /한줄의견 -->




</form>

<iframe name='ifra_down' src='about:blank' width='0' height='0' frameborder='0' scrolling='0'></iframe>