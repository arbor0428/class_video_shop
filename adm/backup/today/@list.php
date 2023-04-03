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

	//업체명
	if($f_company)	 $query_ment .= " and company like '%$f_company%'";

	//담당자
	if($f_name)	 $query_ment .= " and name like '%$f_name%'";

	//접수일 시작
	if($f_sDate){
		$f_sTime = strtotime($f_sDate);
		$query_ment .= " and rTime>='$f_sTime'";
	}

	//접수일 종료
	if($f_eDate){
		$f_eTime = strtotime($f_eDate);
		$query_ment .= " and rTime<='$f_eTime'";
	}

	$sort_ment = "order by rTime desc";

	$query = "select * from ks_contact $query_ment $sort_ment";

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
	GblMsgConfirmBox("해당 문의를 삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.","delOK('"+uid+"')");
}

function delOK(uid){
	form = document.frm01;
	form.type.value = 'del';
	form.uid.value = uid;
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function prdView(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
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
						<th width='150'>업체명</th>
						<th width='120'>담당자</th>
						<th width='150'>연락처</th>
						<th width='220'>이메일</th>
						<th>내용</th>
						<th width='120'>접수일시</th>
						<th width='80'>삭제</th>
					</tr>
	<?
	if($total_record){
		$i = $total_record - ($current_page - 1) * $record_count;

		while($row = mysql_fetch_array($result)){

			$uid = $row["uid"];
			$company = $row["company"];
			$name = $row["name"];
			$phone = $row["phone"];
			$email = $row["email"];
			$title = $row["title"];
			$ment = $row["ment"];
			$rDate =$row['rDate'];
	?>
					<tr class='grayLine'>
						<td><?=$i?></td>
						<td><?=$company?></td>
						<td><?=$name?></td>
						<td><?=$phone?></td>
						<td><?=$email?></td>
						<td><?=$ment?></td>
						<td><?=$rDate?></td>
						<td>
						<!--
							<a href="javascript:prdView('<?=$uid?>');" class="btn btn-success btn-circle btn-sm" title='보기'>
								<i class="fas fa-info-circle"></i>
							</a>
						-->
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
						<td colspan='8' style='padding:50px 0;text-align:center;'>접수된 내역이 없습니다.</td>
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



