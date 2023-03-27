<style type='text/css'>
.gal_eff{
	margin:0px auto;
	width:100%;/*게시판 넓이*/
	/*
	display:flex;
	flex-wrap:wrap;
	*/
}

/*.gal_eff li:nth-child(4n+4) { margin-right:0;}*/

.gal_eff li{
/*
	width:23.5%;
	float:left;
	overflow:hidden;
	margin-right:2%;
	margin-bottom:5%;
*/
	float:left;
	width:calc(33% - 40px);
	margin:20px;
	min-height:470px;
}

.gal_eff a{
	display:block;
	height:100%;
}

.gal_eff .photo_cell{
	position:relative;
	overflow:hidden;
	/*width:90%;*/
	height:auto;
	margin:5% auto;
	text-align:center;
	min-height:395px;
}

.gal_eff .grow {
	transition: all .35s ease-in-out;
	width:100%;
}

.gal_eff li:hover .grow {
	transform: scale(1.05);

}
/*
.gal_eff_ttl{
	text-align:center;
	font-size:1.125rem;
	color:#333;
}
*/
.eff3_ttl {font-size:1.125rem; font-weight:500; border-bottom:1px solid #ddd; padding-bottom:12px;}

.b-text{font-size:0.875rem;}
.b-text-s{font-size:0.875rem;}
.board-select {height:32px;border:1px solid #dddddd;border-radius:3px;padding:0 2em 0 1em;vertical-align:middle; background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%235a5c69' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") right 0.75rem center/8px 10px no-repeat; -webkit-appearance: none; -moz-appearance: none; appearance: none;}
.board-input {width:200px;height:20px;border:1px solid #e1e1e1;border-radius:3px;padding:5px; vertical-align:middle; background: #fff; -webkit-appearance: none;}
.board-select:focus, .board-input:focus {background-color: #fff; outline: 0; box-shadow: 0 0 0 0.1rem rgba(196, 216, 206, .5);}




@media screen and (max-width:1280px){
	.gal_eff{width:95%;}
	.gal_eff .photo_cell {min-height:340px;}
	
}


@media screen and (max-width:1200px){
	.gal_eff li{width:calc(33.33% - 40px);}
	.gal_eff .photo_cell {height:auto !important; min-height: auto;}
}

@media screen and (max-width:980px){
	.gal_eff li{min-height:420px;}
}
@media screen and (max-width:768px){
	.hit_, .name_ {display:none;}
	.btn2 {margin:2px 0;}
	.gal_eff li {width: 48%; margin: 20px 1%; min-height:500px;}
	.board-cade03 ul > li a {font-size: 1rem !important;}
	.eff3_ttl {font-size: 1rem; transform: skew(0.03deg); text-overflow: ellipsis; overflow: hidden; white-space: nowrap;}
}

@media screen and (max-width:640px){
	.date_ {width:20%;}
}

@media screen and (max-width:500px) {
	.gal_eff li{min-height:350px;}
}

@media screen and (max-width:480px) {
	.board-input {width:150px;}
	.btn {padding:5px 24px;}
	
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

function reg_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = 0;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');" style="display: none;">


<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<?
	//글쓰기 권한 설정
	include $boardRoot.'chk_write.php';
?>

<?
	//분류 설정 시 나오기
	if($table_id=='table_1646310371'){
		include $boardRoot.'/cade03.php';
	}
?>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style='padding:0 0 5px 0;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr height='30'>
				<?
					if($GBL_MTYPE == 'A'){	 //관리자일 경우에만 버튼을 활성화 한다.
				?>
					<td style="padding-bottom:1%;"><a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='<?=$BTN_allsel?>' align='absmiddle' alt='전체선택'></a> <a href="javascript:All_del()"><img src='<?=$BTN_alldell?>' align='absmiddle' alt='선택삭제'></a></td>
					<?=$btn_write?>
				<?
					}
				?>
					<td align='right' style="padding-bottom:1%;">
						<select name="field" class="board-select">
							<option value='title' <?if($field == 'title') echo 'selected';?>>제목</option>
							<!--<option value='name' <?if($field == 'name') echo 'selected';?>>글쓴이</option>-->
							<option value='ment' <?if($field == 'ment') echo 'selected';?>>내용</option>
						</select>
						<input name="word" type="text" class="board-input" value='<?=$word?>' onkeypress="if(event.keyCode==13){goSearch();}"> <a href="javascript:goSearch();" class="btn blk">검색</a>
					</td>
				</td>
			</table>
		</td>
	</tr>

	<tr>
		<td align='center' id='list_table'>
			<ul class="gal_eff clearfix ">


<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 1;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$site = $row["site"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$pwd_chk = $row["pwd_chk"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);
		
		$site=$row["site"];
		if($site)	$siteTxt = "<span class='".$siteClass2[$site]."'>".$site."</span>";
		else		$siteTxt = '';
		//제목 글자수 제한





		//$geturl = $boardRoot."img/no_txt.gif";
		$geturl = $boardRoot."img/no_txt2.gif";

		if($userfile01){
			$file_s = $userfile01;
			$file_tmp = explode(".", $file_s);
			$file_tmp_len = count($file_tmp);
			$file_name = $file_tmp[$file_tmp_len-1];

			$file_exe = strtolower($file_name);

			if($file_exe == 'jpg' || $file_exe == 'jpeg' || $file_exe == 'gif' || $file_exe == 'png' || $file_exe == 'bmp'){

			$file_path='../board/upfile/';
/*
				if($site=='재단'){
					$file_path='https://ansanyouth.or.kr/board/upfile/';
				}elseif($site=='상록'){
					$file_path='https://sangnok.ansanyouth.or.kr//board/upfile/';
				}elseif($site=='단원'){
					$file_path='https://danwon.ansanyouth.or.kr/board/upfile/';
				}elseif($site=='일동'){
					$file_path='https://ildong.ansanyouth.or.kr/board/upfile/';
				}elseif($site=='사동'){
					$file_path='https://sadong.ansanyouth.or.kr/board/upfile/';
				}elseif($site=='선부'){
					$file_path='https://seonbu.ansanyouth.or.kr/board/upfile/';
				}elseif($site=='예절'){
					$file_path='https://etiquette.ansanyouth.or.kr/board/upfile/';
				}
*/

				//$file_path = $boardRoot.'upfile/';
/*
				//원본이미지 넓이
				$fw = Util::GetImgSize($file_path.$userfile01);

				//썸네일 넓이와 비교후 파일설정
				if($fw > $img_w)	$geturl = $file_path.'small/s_'.$userfile01;
				else					$geturl = $file_path.$userfile01;
*/
				$geturl = $file_path.$userfile01;
			}
		}



		$userfile = "<img src='".$geturl."' class='grow'>";


		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';



?>
					<li style='cursor:pointer;'>
						<a href="javascript:<?=$btn_link?>">
							<div class="photo_cell" style='background:url(<?=$geturl?>)no repeat center center; background-size:cover;'>
								<div style='position:absolute;top:5%;left:0;'><?=$siteTxt?></div>
								<?=$userfile?>								
							</div>
							<div class="eff3_ttl limitTxt"><?=$title?></div>
						</a>
					</li>


<?
		$i--;
	}

}else{
?>


					<p class="f16" style='padding:30px 0;'>등록된 게시물이 없습니다.</p>


<?
}
?>


			</ul>
		</td>
	</tr>
</table>


</form>

<script>
$(function(){
	$(".photo_cell").height($(".photo_cell").width());
});
</script>