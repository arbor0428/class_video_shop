<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where uid>0";

	//상태
	if($f_status == '1')		$query_ment .= " and status='1'";
	elseif($f_status == '2')	$query_ment .= " and status=''";

	//분류
	if($f_cade01)	$query_ment .= " and cade01='$f_cade01'";
	if($f_cade02)	$query_ment .= " and cade02='$f_cade02'";
	if($f_cade03)	$query_ment .= " and cade03='$f_cade03'";

	//상품명
	if($f_title)	 $query_ment .= " and title like '%$f_title%'";

	$sort_ment = "order by rTime desc";

	$query = "select * from ks_product $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = $query." limit $record_start, $record_count";

	$result = mysql_query($query2);
?>

<script>
function checkDel(uid){
	GblMsgConfirmBox("해당 상품을 삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.","delOK('"+uid+"')");
}

function delOK(uid){
	form = document.frm01;
	form.type.value = 'del';
	form.uid.value = uid;
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function prdEdit(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function prdWrite(){
	form = document.frm01;
	form.type.value = 'write';
	form.uid.value = '';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function reg_list(){
	form = document.frm01;
	form.type.value = 'list';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function excelModal(){
	$("#multiBox").css({"width":"90%","max-width":"750px"});
	$('#multi_ttl').text('상품등록 엑셀 업로드');
	$('#multiFrame').html("<iframe src='ExcelUpload.php' name='excelFrame' style='width:100%;height:480px;' frameborder='0' scrolling='auto'></iframe>");

	$('.multiBox_open').click();
}

function ifra_xls(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = 'excelDown.php';
	form.submit();
}
</script>

<style>
.listTable td{text-align:center;}
.listTable td p{margin:0;}
</style>

<form name='frm01' id='frm01' method='post' action="<?=$_SERVER['PHP_SELF']?>">
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">

<div class="card shadow mb-4" style='margin-top:10px;'>
	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<?
		include 'search.php';
	?>
	</div>

	<div class="card-body">
		<a href="javascript:prdWrite();" class="btn btn-sm btn-secondary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">상품등록</span>
		</a>

		<a href="javascript:excelModal();" class="btn btn-sm btn-primary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-upload"></i>
			</span>
			<span class="text">엑셀업로드</span>
		</a>

		<a href="javascript:ifra_xls();" class="btn btn-sm btn-success btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-download"></i>
			</span>
			<span class="text">엑셀다운로드</span>
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
						<th width='90'>상태</th>
						<th width='110'>이미지</th>
						<th>(1차/2차/3차) 분류</th>
						<th>상품정보</th>
						<th>상품가격</th>
						<th>재고수량</th>
						<th width='120'>등록일</th>
						<th width='120'>편집</th>
					</tr>
	<?
	if($total_record){
		$i = $total_record - ($current_page - 1) * $record_count;

		while($row = mysql_fetch_array($result)){

			$uid = $row["uid"];
			$upfile01 = $row["upfile01"];
			$status = $row["status"];
			$cade01 = $row["cade01"];
			$cade02 = $row["cade02"];
			$cade03 = $row["cade03"];
			$title = $row["title"];
			$memo = $row["memo"];
			$price = $row["price"];
			$inven = $row["inven"];
			$rDate = date('Y-m-d',$row['rTime']);

			if($status)	$statusTxt = "<span class='ico03'>판매중</span>";
			else			$statusTxt = "<span class='ico10'>판매중지</span>";

			if(!$upfile01)	$upfile01 = 'no_img.png';
	?>
					<tr class='grayLine'>
						<td><?=$i?></td>
						<td><?=$statusTxt?></td>
						<td><img src='/upfile/<?=$upfile01?>' style='max-width:60px;max-height:60px;'></td>
						<td style='text-align:left;'><?=$cade01?><br><?=$cade02?><br><?=$cade03?></td>
						<td style='text-align:left;'>
							<p style="font-weight:800;margin-bottom:5px;"><?=$title?></p>
							<p><?=$memo?></p>
						</td>
						<td><?=number_format($price)?>원</td>
						<td><?=number_format($inven)?>개</td>
						<td><?=$rDate?></td>
						<td>
							<a href="javascript:prdEdit('<?=$uid?>');" class="btn btn-success btn-circle btn-sm" title='수정'>
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
						<td colspan='9' style='padding:50px 0;text-align:center;'>상품정보가 없습니다.</td>
					</tr>
	<?
	}
	?>
				</table>
			</div>
		</div>
	</div>
<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
?>
</div>
</form>



