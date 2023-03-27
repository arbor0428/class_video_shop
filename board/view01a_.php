<style>
	
	.box-content{
		padding: 0 15px;
		box-sizing: border-box;
	}
	.ment img{
		max-width:100%;
	}

	.viewTit {
		margin-bottom: 18px;
		font-size: 2rem;
		font-weight: 600;
		text-align: center;
	}

	.viewDet {
		margin-bottom: 100px;
		font-size: 1.125rem;
		text-align: right;
		word-break:keep-all;
	}
	.contList {
		padding: 45px 0;
		border-bottom: 1px solid #DDDDDD;
	}
	.contList .contListImg {
		width:100%;
		max-width: 580px;
		height: 320px;
		background-repeat: no-repeat; 
		background-position: top center;
		background-size: cover;
		border:1px solid #e1e1e1;
		box-sizing:border-box;
	}

	.contList .contListTxt  {
		width:calc(100% - 580px);
		padding-left:40px;
		box-sizing:border-box;
	}
	.contList.prev .contListImg {
		background-image:url('/images/list01Pic.png');
	}
	.contList.next .contListImg {
		background-image:url('/images/list02Pic.png');
	}

	
	.contList .contListTxt .contListTit {
		margin-bottom: 20px;
		font-weight: 600;
		font-size: 1.5rem;
		text-overflow:ellipsis;
		white-space:nowrap;
		overflow:hidden;
	}

	.contList .contListTxt .contListDet {
		margin-bottom: 42px;
		color:#666;
		line-height:1.5;
		white-space:normal;
		display:-webkit-box;
		-webkit-line-clamp:3;
		-webkit-box-orient:vertical;
		overflow:hidden;
	}

	.contList .contListTxt .contListDate {
		color: #878787;
		font-size:0.875rem;
	}
	.viewShow{
		border-top: 1px solid #DDDDDD;
		border-bottom: 1px solid #DDDDDD;
		padding: 60px 0 80px;
		line-height:1.8;
	}

	.prevNextWrap .moreBtnTit {
		margin-bottom: 40px;
		padding-top: 80px;
		font-size: 2rem;
		font-weight: 600;
		text-align: center;
		 font-family: "Roboto", "NanumSquare", sans-serif;
	}

	

	.listBtn {margin: 80px auto 0; padding:0 20px; box-sizing:border-box; width:260px; height:62px; border: 1px solid #01010D; overflow:hidden;}
	.listBtn a {position: relative;  display: block; padding: 0 30px; box-sizing:border-box; width: 100%; height: 100%; }
	.listBtn .hoverCir {position: absolute; bottom: -1px; left: 50%; transform: translateX(-50%); width: 1px; height: 1px; border-radius: 50%; background-color: #e6182e; transition: all 0.5s;}
	.listBtn:hover {border:1px solid #e6182e;}
	.listBtn:hover .hoverCir {transform: scale(380);}
	.listBtn:hover span.submiTxt_f {color: #fff; }
	.listBtn:hover .lnr-arrow-right {color: #fff;}
	.listBtn .submitTxt {position: absolute; top:0; left: 0; padding: 0 30px; box-sizing:border-box; width: 100%; height: 100%;}
	.listBtn .submitTxt .submiTxt_f {font-size: 1.125rem;  font-family: "Roboto", "NanumSquare", sans-serif;}
	.listBtn .submitTxt .lnr-arrow-right {font-weight: bold; font-size: 20px;}

	.adm_write_btn {
		margin:20px 0; 
		display:flex; 
		justify-content:flex-end;
	}
	.viewShow {
		padding: 60px 0px 80px;

	}
	@media (max-width:760px){	 
		.contList .contListImg {
			background-size: cover !important;
			margin: 0 auto 22px;
		}		
		.viewShow img {
			width: 100%;
		}
		.more__list-wrap {
			flex-direction: column;
		}
		.more__list-wrap .contListTxt{
			width: 100%;
			padding: 0;
		}
		.box-content.m_140 {
			margin-top: 30px;
		}
		.viewDet{
			margin-bottom: 60px;
		}
	}
	@media (max-width:500px){	
		.viewDet{
			margin-bottom: 20px;
			font-size: 1rem;
		}
		.viewShow {
			padding: 20px 0px 40px;
		}
		.prevNextWrap .moreBtnTit{
	    margin-bottom: 40px;
			padding-top: 40px;
			font-size: 1.5rem;
		}
		.contList{
			padding-top: 10px;
		}
		.viewTit{
			font-size: 1.5rem;
		}
		.contList.prev .contListImg {
			height: 200px;
		}
		
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


		$sql2 = "select * from tb_board_list where table_id='$table_id' and reg_date>'$reg_date' order by reg_date asc limit 1";
		$result2 = mysql_query($sql2);
		$row2 = mysql_fetch_array($result2);
		$uid2 = $row2["uid"];
		$title2 = $row2["title"];
		$data012 = $row2["data01"];
		$userfile012 = $row2["userfile01"];		

		if(!$userfile012)	$userfile012='no_img.jpg';	
		$reg_date2=$row2["reg_date"];
		$reg_date2 = date("Y.m.d",$reg_date2);

		$sql2 = "select * from tb_board_list where table_id='$table_id' and reg_date<'$reg_date' order by reg_date desc limit 1";
		$result2 = mysql_query($sql2);
		$row2 = mysql_fetch_array($result2);
		$uid3 = $row2["uid"];
		$title3 = $row2["title"];
		$data013 = $row2["data01"];
		$userfile013 = $row2["userfile01"];
		if(!$userfile013)	$userfile013='no_img.jpg';	
		$reg_date3=$row2["reg_date"];
		$reg_date3 = date("Y.m.d",$reg_date3);



		$reg_date = date("Y.m.d",$reg_date);
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

function reg_view(uid){
	form = document.FRM;
	form.uid.value = uid;
	form.type.value = 'view';
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

	<div class="viewTit"><?=$title?></div>
	<div class="viewDet"><?=$reg_date?></div>

	<div class="viewShow">
		<?=$ment?>
	</div>

<?
	if($GBL_MTYPE){
?>
<!--관리자 로그인시 나오는 등록버튼-->
<div class="adm_write_btn">
	<a href="javascript:reg_modify();" class='btn grn'>수정</a>&nbsp;
</div>
<?
	}	
?>

<?
	if($uid2 || $uid3){
?>
	<div class="prevNextWrap">
		<p class="moreBtnTit">더 알아보기</p>
		<?
			if($uid2){
		?>
		<div class="contList dp_f dp_cc prev">
			<a class="dp_f more__list-wrap" style="width: 100%; height: 100%;cursor:pointer" onclick='reg_view("<?=$uid2?>")'>
				<div class="contListImg" style='background:url(/board/upfile/<?=$userfile012?>) no-repeat top center / cover; '>
					<!--사진 배경으로-->
				</div>
				<div class="contListTxt">
					<p class="contListTit"><?=$title2?></p>
					<p class="contListDet"><?=$data012?></p>
					<p class="contListDate"><?=$reg_date2?></p>
				</div>
			</a>
		</div>
		<?
			}	
		?>
		<?
			if($uid3){
		?>
		<div class="contList dp_f dp_cc prev">
			<a class="dp_f more__list-wrap" style="width: 100%; height: 100%;cursor:pointer" onclick='reg_view("<?=$uid3?>")'>
				<div class="contListImg" style='background:url(/board/upfile/<?=$userfile013?>) no-repeat top center / cover;'>

					<!--사진 배경으로-->
				</div>
				<div class="contListTxt">
					<p class="contListTit"><?=$title3?></p>
					<p class="contListDet"><?=$data013?></p>
					<p class="contListDate"><?=$reg_date3?></p>
				</div>
			</a>
		</div>
		<?
			}	
		?>
	</div>
<?
	}	
?>


	<div class="listBtn">
		<a href="javascript:reg_list()">
			<div class="hoverCir"></div>
			<div class="submitTxt dp_sb dp_c">
				<span class="submiTxt_f">목록보기</span>
				<span class="lnr lnr-arrow-right"></span>
			</div>
		</a>
	</div>




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

<?
//답글쓰기 권한설정
include $boardRoot.'chk_reply.php';
?>




<!-- 한줄의견-->
<?
	//include $boardRoot.'coment.php';
?>
<!-- /한줄의견 -->




</form>



<iframe name='ifra_down' src='about:blank' width='0' height='0' frameborder='0' scrolling='0'></iframe>