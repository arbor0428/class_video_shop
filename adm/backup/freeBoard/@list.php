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

	if($word)		$query_ment .= "where $field like '%$word%'";

	$sort_ment = "order by uid desc";



	$query = "select * from tb_popup $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_popup $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>

<script language='javascript'>
function popWrite(){
	form = document.frm01;
	form.type.value = 'write';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function popEdit(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function checkDel(uid){
	GblMsgConfirmBox("해당 팝업을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk("+uid+")");
}

function checkDelOk(uid){
	form = document.frm01;
	form.uid.value = uid;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function reg_list(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}
</script>

<form name='frm01' method='post' action="<?=$_SERVER['PHP_SELF']?>">
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<div class="card shadow mb-4" style='margin-top:10px;'>
	<div class="card-body">
		<a href="javascript:popWrite();" class="btn btn-sm btn-secondary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">팝업등록</span>
		</a>

		<div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
			<span class="scorll-hand">
				<img src="/adm/img/scroll_hand.gif" style="max-width:100%;">
			</span>
		</div>

		<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
			<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
				<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
					<tr>
						<th width='70'>번호</th>
						<th>제목</th>
						<th width="10%">넓이/높이</th>
						<th width="8%">활성화</th>
						<th width='120'>등록일</th>
						<th width='120'>편집</th>
					</tr>
	<?
	$nTime = mktime();

	if($total_record != '0'){
		$i = $total_record - ($current_page - 1) * $record_count;

		$line_num = 0;

		while($row = mysql_fetch_array($result)){

			$uid=$row["uid"];
			$cade=$row["cade"];
			$title=$row["title"];
			$pop_width=$row["pop_width"];
			$pop_height=$row["pop_height"];
			$real_pop_height=$pop_height+30;
			$pop_left=$row["pop_left"];
			$pop_top=$row["pop_top"];
			$pos_mod=$row["pos_mod"];


			$chk_enable=$row["chk_enable"];
			if($chk_enable == "0")		$chk_enable_ment = "비활성화";
			elseif($chk_enable == "1")	$chk_enable_ment = "활성화";
			elseif($chk_enable == "2"){
				$chk_enable_ment = "활성화";
				$eTime = $row["eTime"];

				if($nTime > $eTime)	$chk_enable_ment = '기간만료';
			}


			$reg_date=$row["reg_date"];
			$reg_date = date("Y-m-d",$reg_date);

	?>
					<tr <?if($chk_enable_ment == '활성화'){?>style='background:#f6f6f6;'<?}?>>
						<td align='center'><?=$i?></td>
						<td align='center'><?=$title?></td>
						<td align='center'><?=$pop_width?> / <?=$pop_height?></td>
						<td align='center'><?=$chk_enable_ment?></td>
						<td align='center'><?=$reg_date?></td>
						<td align='center'>
							<a href="javascript:popEdit('<?=$uid?>');" class="btn btn-success btn-circle btn-sm" title='수정'>
								<i class="fas fa-info-circle"></i>
							</a>
							<a href="javascript:checkDel('<?=$uid?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'>
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
	<?
			$i--;
		}
	}else{
	?>
					<tr> 
						<td colspan="8" style='padding:50px 0;text-align:center;'>등록된 팝업이 없습니다</td>
					</tr>
	<?
	}
	?>

				</table>
			</div>
		</div>
	
<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
?>
</div>
</form>




