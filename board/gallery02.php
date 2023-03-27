<script type="text/javascript">
$(document).ready(function(){
	$("body").bind("contextmenu", function(e) {
		alert('마우스 오른쪽 버튼을 사용할수 없습니다');
		return false;
	});
});
</script>
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

.certification-list-wrap{width:100%;}
.certification-list-container{width:100%;}
.certification-list-container > li{float:left; width:48%; padding-right:2%; margin-bottom:4%;}
.certification-list-con{width:100%; display:table;}
.certification-list-con > dt, .certification-list-con > dd{display:table-cell; /*vertical-align:middle;*/vertical-align:top;}
.certification-list-con > dt{width:39%;}
.certification-list-img-thum{width:100%; position:relative; padding-top:133.6%; background-color:#fff;}
.certification-list-img-thum > span{position:absolute; top:0; left:0; bottom:0; right:0;}
.certification-list-img-thum > span img{max-width:99%; display:block; margin:0px auto; border:1px solid #9b9b9b; width:100%; height:100%; max-height:318px;transition:all 0.5s;}
.certification-list-img-thum > span img:hover{transform:scale(1.05)}
.certification-list-con > dd{width:61%; padding:3% 0 0 5%;}
.certification-tit{font-size:1.3rem; line-height:33px; color:#111; font-weight:400; letter-spacing:-1px; border-bottom:1px solid #cfcfcf; margin-bottom:5%;text-align:left;}
.certification-tit > span{display:inline-block; position:relative; padding-bottom:6%; /*word-break:keep-all*/;}
.certification-tit > span:after{display:block; position:absolute; bottom:-1px; left:0; content:""; width:100%; height:1px; background-color:#333;}
.certification-txt{display:table; width:100%; }
.certification-txt > dt, .certification-txt > dd{display:table-cell; vertical-align:top;}
.certification-txt > dt{width:25%; font-size:16px; line-height:33px; color:#111; font-weight:400; letter-spacing:-0.75px;}
.certification-txt > dd{width:75%; padding-left:3%;}
.certification-txt > dd p{font-size:16px; line-height:36px; color:#5e5e5e; letter-spacing:-0.5px; position:relative;}
.certification-txt > dd p:first-child:before{display:inline-block; content:""; vertical-align:middle; width:1px; height:8px; background-color:#cfcfcf; position:absolute; left:-5%; top:16px; margin-top:-4px;}
.certification-more-btn{display:block; width:185px; height:43px; background-color:#f4f4f4; border:1px solid #cfcfcf; margin-top:5%;}
.certification-more-btn > em, .certification-more-btn > span{float:left; height:43px; line-height:43px; text-align:center; color:#111;}
.certification-more-btn > em{width:43px; border-right:1px solid #cfcfcf;}
.certification-more-btn > em i{vertical-align:middle; line-height:43px;}
.certification-more-btn > span{width:141px; font-size:15px;}
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
	.certification-list-container {    
    display: flex;
    flex-wrap: wrap;
		padding: 0 15px;
		box-sizing: border-box;
	}
	.certification-list-container > li {    
    width: calc(50% - 26px);

	}
	.certification-list-con{
		display: flex;
	}
	
	
}


@media screen and (max-width:1200px){
	.gal_eff li{width:calc(33.33% - 40px);}
	.gal_eff .photo_cell {height:auto !important; min-height: auto;}
}

@media screen and (max-width:980px){
	.gal_eff li{min-height:420px;}
	.certification-tit{
		font-size: 1rem;
	}
	.certification-list-con > dd{
		padding-top: 0;
	}
	.certification-txt > dd p{
		font-size: 0.85rem;
		line-height: 2.5;
	}
}
@media screen and (max-width:768px){
	.hit_, .name_ {display:none;}
	.btn2 {margin:2px 0;}
	.gal_eff li {width: 48%; margin: 20px 1%; min-height:500px;}
	.board-cade03 ul > li a {font-size: 1rem !important;}
	.eff3_ttl {font-size: 1rem; transform: skew(0.03deg); text-overflow: ellipsis; overflow: hidden; white-space: nowrap;}
	.certification-list-con{

		gap: 20px;
	}
	.certification-list-container > li {    
    width: 100%;

	}

	.certification-list-con > dt, .certification-list-con > dd{
		width: 100%;
	}
	.certification-list-img-thum{
		padding-top: 111.6%;
	}
	.certification-list-container{
		justify-content: space-between;
		gap: 10px;
	}
}

@media screen and (max-width:640px){
	.date_ {width:20%;}
	.certification-tit{
		line-height: unset;
	}
	.certification-tit > span{		
    width: 100%;  
		padding: 0;
		/*word-break: break-all;*/
	}
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
	/*
	if(mod == 'r'){
		alert('글읽기 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
	*/
}

function reg_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = 0;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function sortModal(){
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('인증정보 정렬');
	$('#multiFrame').html("<iframe src='/board/sort.php' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_close').attr("onclick", "location.reload();");
	$('.multiBox_open').click();
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
<?=$btn_write?>
<?
	if($GBL_MTYPE=='A'){
?>
	<a href="javascript:sortModal()" class="btn blk">순서변경</a>
<?
	}

?>
<?
	//분류 설정 시 나오기
	if($table_id=='table_1646310371'){
		include $boardRoot.'/cade03.php';
	}
?>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<!-- <tr>
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
							<option value='ment' <?if($field == 'ment') echo 'selected';?>>내용</option>
						</select>
						<input name="word" type="text" class="board-input" value='<?=$word?>' onkeypress="if(event.keyCode==13){goSearch();}"> <a href="javascript:goSearch();" class="btn blk">검색</a>
					</td>
				</td>
			</table>
		</td>
	</tr> -->

	<tr>
		<td id='list_table' class='certification-list-wrap'>
			<ul class="certification-list-container clearfix">


<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 1;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$site = $row["site"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
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
					<li <?=$btn_link?>>
						<dl class="certification-list-con">
							<dt>
								<div class="certification-list-img-thum"><span><?=$userfile?></span></div>
							</dt>
							<dd>
								<h3 class="certification-tit"><span><?=$title?></span></h3>
								<dl class="certification-txt clearfix">
									<dt>규격</dt>
									<dd>
										<p>
											<?=$data01?>
										</p>
									</dd>
								</dl>
								<dl class="certification-txt clearfix">
									<dt>등록일자</dt>
									<dd>
										<p><?=$data02?></p>
									</dd>
								</dl>
								<!-- <a href="javascript:;" class="certification-more-btn clearfix" onclick="javascript:layerLoad('./certification_popup.php?gu=1'); return false;">
									<em><i class="material-icons"></i></em><span>자세히보기</span>
								</a> -->
							</dd>
						</dl>
					</li>
<!-- 
					<li style='cursor:pointer;'>
						<a href="javascript:<?=$btn_link?>">
							<div class="photo_cell" style='background:url(<?=$geturl?>)no repeat center center; background-size:cover;'>
								<div style='position:absolute;top:5%;left:0;'><?=$siteTxt?></div>
								<?=$userfile?>								
							</div>
							<div class="eff3_ttl limitTxt"><?=$title?></div>
						</a>
					</li>

 -->
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