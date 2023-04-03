<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "";

	if($word)	$query_ment .= "where $field like '%$word%'";

	$sort_ment = "order by uid desc";



	$query = "select * from tb_board_set $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_board_set $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>

<script language='javascript'>

var win;

function click_del(txt,uid){

	if(confirm(txt+' 게시판을 삭제하시겠습니까?')){
		form = document.frm01;
		form.uid.value = uid;
		form.type.value = 'del'
		form.action = 'proc.php';
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
		alert('삭제하실 게시판을 선택하여 주십시오.');
		return;
	}

	if(confirm('게시판을 삭제할 경우 등록되어있는 모든 글이 삭제됩니다.\n선택하신 게시판을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = 'proc.php';
		form.submit();

	}

}


function reg_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = 'up_index.php';
	form.submit();
}


function toclip(id){
	var idxs = document.getElementsByName("clip[]");
	if(idxs[id].value==''){ document.body.focus(); return; }
	idxs[id].select();
	var clip=idxs[id].createTextRange();
	clip.execCommand('copy');
	alert('복사되었습니다');
}
</script>



<form name='frm01' method='post' action='<?=$_SERVER['PHP_SELF']?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<style>
	input[type="text"], input[type="password"] {
		/*display: block;*/
		width: 100%;
		min-width: inherit;
	   /* max-width: 29.2em;*/
		height:32px; 
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
	.board-select {height:32px;border:1px solid #dddddd;border-radius:3px;padding:0 2em 0 1em;vertical-align:middle; background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%235a5c69' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") right 0.75rem center/8px 10px no-repeat; -webkit-appearance: none; -moz-appearance: none; appearance: none;}
</style>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr style="height:60px;">
		<td><a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='/images/common/allselect.gif' align='absmiddle'></a> <a href="javascript:All_del()"><img src='/images/common/alldelete.gif' align='absmiddle'></a></td>
		<td height='30' align='right'>
			<select class="board-select" name="field"><option value='title' selected>게시판명</option></select>
			<input name="word" type="text" size="20" value='<?=$word?>' style="display:inline-block; width:200px;" > <a class="btn blk" href='javascript:document.frm01.submit();'>검색</a>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable'>
				<tr> 
					<th width="5%"><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></th>
					<th width="5%">번호</th>
					<th width="28%">게시판명</th>
					<th width="12%">리스트방식</th>
					<th width="8%">쓰기권한</th>
					<th width="10%">읽기권한</th>
					<th width="13%">등록일</th>
					<th width="19%">편집</th>
				</tr>
<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$table_id = $row["table_id"];
		$title = $row["title"];
		$list_mod = $row["list_mod"];
		$write_chk = $row["write_chk"];
		$read_chk = $row["read_chk"];

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);

		
?>
				<INPUT TYPE="hidden" id="clip[]" NAME="clip[]" value='<?=$table_id?>'>

				<tr> 
					<th style="background-color:#fff;"><input name='chk[]' type='checkbox' value='<?=$uid?>'></th>
					<td align='center'><?=$i?></td>
					<td align='center'><a onclick="javascript:toclip(<?=$line_num?>);" style='cursor:hand;'><?=$title?></a></td>
					<td align='center'><?=$list_mod?></td>
					<td align='center'><?=$write_chk?></td>
					<td align='center'><?=$read_chk?></td>
					<td align='center'><?=$reg_date?></td>
					<td align='center'><a class="btn grn" href="javascript:reg_modify('<?=$uid?>');" style="margin:0 5px;">수정</a> <a class="btn red" href="javascript:click_del('<?=$title?>','<?=$uid?>')" style="margin:0 5px;">삭제</a></td>
				</tr>
<?
		$i--;
		$line_num++;
	}
}else{
?>
				<tr> 
					<td colspan="8" align='center'>등록된 게시판이 없습니다</td>
				</tr>
<?
}
?>
			</table>
		</td>
	</tr>

	<tr> 
		<td colspan='2' style='padding:20px 0;' align='right'><a  class="btn blk" href='./up_index.php?type=write'>등록하기<!-- <img src='/images/common/register.gif'> --></a></td>
	</tr>
</table>


<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td align='center'>
			<table border="0" align="center" cellpadding="1" cellspacing="0" style='margin-top:15px;'>
				<tr>

<?
if($total_record != '0'){
	if($total_record > $record_count){
		
		echo ("<td>");

		if($current_page * $record_count > $record_count * $link_count) {
			$pre_group_start = ($group * $record_count * $link_count) - $record_count;
			echo("<a href=javascript:pageing('frm01','$pre_group_start');><img src='/images/common/prev2.gif'></a>");
		}else{
			echo("<img src='/images/common/prev2.gif'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start !=0 )) {
			$pre_page_start = $record_start - $record_count;
			echo("<a href=javascript:pageing('frm01','$pre_page_start');><img src='/images/common/prev1.gif'></a>");
		}else{
			echo ("<img src='/images/common/prev1.gif'>");
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		for($i=0; $i<$link_count; $i++){
			$input_start = ($group * $link_count + $i) * $record_count; 

			$link = ($group * $link_count + $i) + 1;

			if($input_start < $total_record) {
				if($input_start != $record_start) {
					echo("<a onclick=pageing('frm01','$input_start'); style='cursor:hand'>$link</a>&nbsp;&nbsp;");
				} else {
					echo("<b>$link</b>&nbsp;&nbsp;");
				}
			}
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start != ($total_page * $record_count - $record_count))) {
			$next_page_start = $record_start + $record_count;
			echo("<a href=javascript:pageing('frm01','$next_page_start');><img src='/images/common/next1.gif'></a>");
		}else{
			echo ("<img src='/images/common/next1.gif'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_record > (($group + 1) * $record_count * $link_count)) {
			$next_group_start = ($group + 1) * $record_count* $link_count;
			echo("<a href=javascript:pageing('frm01','$next_group_start');><img src='/images/common/next2.gif'></a>");
		}else{
			echo ("<img src='/images/common/next2.gif'>");
		}

		echo ("</td>");



		  
	}else{
		echo "<td><b>1</b></td>";
	}
}
?>

				</td>
			</tr>
		</table>
	</tr>
</table>



</form>