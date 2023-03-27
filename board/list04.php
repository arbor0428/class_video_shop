<style>
	.contList {
		padding: 45px 15px;
		box-sizing: border-box;
		border-bottom: 1px solid #DDDDDD;
	}

	.contList .contListImg {
		width: 580px;
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

	.adm_write_btn {
		margin:20px 0; 
		display:flex; 
		justify-content:flex-end;
	}

	@media (max-width:760px){	 
		.contList .contListImg {background-size: cover !important; margin: 0 auto 22px;}		
	}

	@media (max-width:1070px){	
		.contList > a {display: block;}
		.contList .contListImg {margin: 0 auto 49px; width: 100%;}
		.contList .contListTxt {margin: 0 auto; max-width: 100%; width: 100%; padding: 0;}
		.contList .contListTxt .contListTit {text-align: center; font-size: 1.125rem;}
		.contList .contListTxt .contListDet {text-align: center; font-size: 0.875rem;}
		.contList .contListTxt .contListDate {text-align: center; font-size: 0.875rem;}
		#fullpage_sub03 .tabBtn {margin: 0 20px;}
		#fullpage_sub03 .tabBtn a {font-size: 1.125rem;}
		.adm_write_btn {margin: 20px auto; text-align: center;}

	}

	@media (max-width:760px){	
		.contList .contListImg {height: 250px;}
		.top_titWrap {justify-content: space-between;}
		.top_titWrap > p {margin: 0 10px;}
		.viewTit {font-size: 1.375rem; line-height: 1.3;}
		.viewDet {margin-bottom: 50px; font-size: 1rem;}
		.viewShow {padding: 40px 0;}
		.prevNextWrap .moreBtnTit {margin-bottom: 0; font-size: 1.625rem; padding-top: 40px;}
		.listBtn {padding: 0; margin: 40px auto; width: 195px; height: 55px;}
		.listBtn a {padding: 0 10px;}
		.listBtn .submitTxt {padding: 0 10px;}
		.listBtn .submitTxt .submiTxt_f {font-size: 1rem;}
	}
	@media (max-width:550px){	
		.boardCont.m-60{
			margin-top:0;
		}
		.box-content.m_140 {
			margin-top: 0px;
		}
		.contList .contListImg {
			margin: 0 auto 20px;
		}

	}
</style>

<script language='javascript'>

function click_del(txt,uid){

	if(confirm(txt+' 글을 삭제하시겠습니까?')){
		form = document.frm01;
		form.uid.value = uid;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

	

}


function All_del(){

    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('삭제하실 글을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 글을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();

	}

}


function reg_register(){
	form = document.frm01;
	form.type.value = 'write';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_view(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


function error_msg(mod){
	if(mod == 'r'){
		alert('글읽기 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}

function goSearch(){
	form = document.frm01;

	form.type.value = '';
	form.uid.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.target = '';
	form.submit();
}

</script>

<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>
<!--관리자 로그인시 나오는 등록버튼-->

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>




<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<div class="boardCont m-60">

<?
//새글표시기간
$newday = 3;

if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;


	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$site = $row["site"];
		$userid = $row["userid"];
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];
		$userfile03 = $row["userfile03"];
		$userfile04 = $row["userfile04"];
		$userfile05 = $row["userfile05"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$name = $row["name"];
		$data01 = $row["data01"];
		$hit = $row["hit"];
		$hitTxt = number_format($hit);

		$reg_date=$row["reg_date"];



		$reg_date = date("Y.m.d",$reg_date);




		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';

		if(!$userfile01)	$userfile01='no_img.jpg';	
	

?>


	<div class="contList">
		<a class="dp_f" style="width: 100%; height: 100%;cursor:pointer;" <?=$btn_link?>>
			<div class="contListImg" style='background:url(/board/upfile/<?=$userfile01?>)no-repeat top center; background-size: cover;'>
				<!--사진 배경으로-->
			</div>
			<div class="contListTxt">
				<p class="contListTit"><?=$title?></p>
				<!-- <p class="contListDet"><?=$data01?></p> -->
				<p class="contListDate"><?=$reg_date?></p>
			</div>
		</a>
	</div>




<?
//답글리스트
include $boardRoot.'reply_list01.php';
?>





<?
		$i--;
	}
}else{
?>

				<p class="f16 txt_c p-45">
					등록된 게시물이 없습니다
				</p>

<?
}
?>


</div>

</form>

<div class="adm_write_btn">
	<?=$btn_write?>
</div>

