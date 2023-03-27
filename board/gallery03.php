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
if($GBL_MTYPE == 'A'){	 //관리자일 경우에만 버튼을 활성화 한다.
?>

<?=$btn_write?>
<?
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr style='display:none;'>
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
		<td id='list_table'>
			<ul class="imgWrap clearfix ">


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
		$name = $row["name"];
		$pwd_chk = $row["pwd_chk"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);
		
		//$geturl = $boardRoot."img/no_txt.gif";
		$geturl = $boardRoot."img/no_txt2.gif";

		if($userfile01){
			$file_s = $userfile01;
			$file_tmp = explode(".", $file_s);
			$file_tmp_len = count($file_tmp);
			$file_name = $file_tmp[$file_tmp_len-1];

			$file_exe = strtolower($file_name);

			if($file_exe == 'jpg' || $file_exe == 'jpeg' || $file_exe == 'gif' || $file_exe == 'png' || $file_exe == 'bmp'){

			$file_path='/board/upfile/';

				$geturl = $file_path.$userfile01;
			}
		}



		$userfile = "<img src='".$geturl."' class='grow'>";


		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';
		if($GBL_MTYPE=='A')		$btn_link = "onclick=\"javascript:onclick=reg_modify('$uid','$i');\"";
		else							$btn_link = "";

?>
					<a <?=$btn_link?>>
						<div style='width:100%;background:url(<?=$geturl?>) center center no-repeat #f5f5f5;background-size:contain; position: relative;' class='listImg  zoom-in'></div>
						<div class='listTitle'><?=$title?></div>
						<div class='listName'><?=$data01?></div>
						
					</a>


<?
		$i--;
	}

}else{
?>


					<p class="f16" style='padding:30px 0;'>등록된 제품이 없습니다.</p>


<?
}
?>


			</ul>
		</td>
	</tr>
</table>
<style type='text/css'>
    .imgWrap {display: flex; flex-wrap: wrap; justify-content: left; }
    .imgWrap > a {width: calc(33.33%);border:1px solid #d1d1d1;border-left:none;border-top:0;box-sizing:border-box;	cursor:pointer; }

.listImg{
  position: relative;
  overflow: hidden;
}
    .imgWrap > a:nth-child(1),.imgWrap > a:nth-child(2),.imgWrap > a:nth-child(3) {border-top:2px solid #11368d;}
    .imgWrap > a:nth-child(3n+1) {border-left:1px solid #d1d1d1;}
    .listTitle {padding:20px;padding-bottom:5px;font-size:20px;margin-top:10px;font-weight:bold;}
    .listName {padding:20px;padding-top:0;font-size:16px;margin-bottom:10px;}
    .listDate {font-size:14px;color:#888888}
    .container p {font-size: 16px; font-weight: bold;margin-top: 10px; margin-bottom: 20px;}
	/* 모바일 */
	@media screen and (max-width:768px) {
		.selectBox{width:70%;}
		.imgWrap > a {width: 47%;	margin-right:6%; }
		.menuWrap > div{font-size:14px !important;}
		.imgWrap > a:nth-child(2n) {margin-right:0px; }
	}

.zoom-in::after{
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: inherit;
  transform-origin: center;
  transition: transform 0.4s ease-in-out;
}
.zoom-in:focus::after, .zoom-in:hover::after {
  transform: scale(1.05);
}
</style>

</form>

<script>
$(function(){
	$(".photo_cell").height($(".photo_cell").width());
});
</script>

<script>
heightH=7/7;
$('.listImg').each(function(){
	$(this).height($(this).width()*heightH);
})
$(function(){
	$('.listImg').each(function(){
		$(this).height($(this).width()*heightH);
	})
	$(window).resize(function(){
		
		$('.listImg').each(function(){
			$(this).height($(this).width()*heightH);
		})
	})
})
</script>