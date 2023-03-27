<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where puid=$uid";

	//상태
	if($f_status == '1')		$query_ment .= " and status='1'";
	elseif($f_status == '2')	$query_ment .= " and status='2'";
	elseif($f_status == '3')	$query_ment .= " and status=''";

	//등급
	if($f_level == '1')			$query_ment .= " and level='VIP'";
	elseif($f_level == '2')	$query_ment .= " and level=''";

	//아이디
	if($f_userid)	 $query_ment .= " and userid like '%$f_userid%'";

	//성명
	if($f_name)	 $query_ment .= " and name like '%$f_name%'";

	if(!$f_sort)	$f_sort = 'rTime';

	if($f_sort == 'rTime')				$sort_ment = "order by rTime desc";
	elseif($f_sort == 'loginTime')	$sort_ment = "order by loginTime desc";

	$query = "select * from ks_member_child $query_ment $sort_ment";

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
function formModal(u){
	$("#multiBox").css({"width":"90%","max-width":"800px"});
	$('#multi_ttl').text('정보수정');
	$('#multiFrame').html("<iframe src='write02.php?type=edit&uid="+u+"' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function formModal2(u){
	$("#multiBox").css({"width":"90%","max-width":"800px"});
	$('#multi_ttl').text('아이목록');
	$('#multiFrame').html("<iframe src='index2.php?type=edit&uid="+u+"' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}

function checkDel(name,uid){
	GblMsgConfirmBox("["+name+"]님의 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.","delOK('"+uid+"')");
}

function delOK(uid){
	form = document.frm01;
	form.type.value = 'del';
	form.uid.value = uid;
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
function reg_modify(uid){
	form = document.frm01;
	
	form.type.value = 'edit';
	form.uid.value = uid;
	//form.target = 'ifra_gbl';
	form.action = 'index2.php';
	form.submit();

}

function modalOpen(c){
	mt = $("#memType option:selected").val();

	if(mt == 'search'){
		total_record = $('#total_record').val();
		if(total_record == 0){
			GblMsgBox('검색된 회원이 없습니다.','');
			return;
		}

	}else if(mt == 'choice'){
		len = $('input:checkbox[class=cMail]:checked').length;
		if(len == 0){
			GblMsgBox('선택된 회원이 없습니다.','');
			return;
		}
	}

	if(c == 'm'){
		$("#multiBox").css({"width":"90%","max-width":"1000px"});
		$('#multi_ttl').text('메일 작성');
		$('#multiFrame').html("<iframe src='about:blank' name='mailFrame' style='width:100%;height:700px;' frameborder='0' scrolling='auto'></iframe>");

		form = document.frm01;
		form.target = 'mailFrame';
		form.action = 'emailEditor.php';
		form.submit();

		$('.multiBox_open').click();

	}else if(c == 'c'){
		$("#multiBox").css({"width":"90%","max-width":"700px"});
		$('#multi_ttl').text('쿠폰발급');
		$('#multiFrame').html("<iframe src='about:blank' name='couponFrame' style='width:100%;height:450px;' frameborder='0' scrolling='auto'></iframe>");

		form = document.frm01;
		form.target = 'couponFrame';
		form.action = '/adm/coupon/modalForm.php';
		form.submit();

		$('.multiBox_open').click();
	}
}

function modalClose(){
	$(".multiBox_close").click();
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
</style>

<input type='hidden' name='total_record' id='total_record' value='<?=$total_record?>'>



<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
	<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
<!--
		<select name="memType" id="memType" class="form-control" style="width:150px;height:32px;display:inline-block;">
			<option value='choice' <?if($memType == 'choice'){echo 'selected';}?>>선택된 회원</option>
			<option value='search' <?if($memType == 'search'){echo 'selected';}?>>검색된 회원</option>
			<option value='all' <?if($memType == 'all'){echo 'selected';}?>>전체 회원</option>
		</select>
		<a href="javascript:modalOpen('m');" class="btn btn-sm btn-primary btn-icon-split" style="margin-top:-5px;" title="광고수신 미동의 회원에게는 발송되지 않습니다.">
			<span class="icon text-white-50">
				<span class="lnr lnr-envelope"></span>
			</span>
			<span class="text">메일 보내기</span>
		</a>

		<a href="javascript:ifra_xls();" class="btn btn-sm btn-success btn-icon-split" style="margin-top:-5px;">
			<span class="icon text-white-50">
				<i class="fas fa-download"></i>
			</span>
			<span class="text">엑셀다운로드</span>
		</a>
-->
		<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:300px;margin:5px 0;'>
			<tr>
				<th width='4%'>번호</th>
				<th width='7%'>이름</th>
				<th width='4%'>성별</th>
				<th width='8%'>타이틀</th>
				<th width='10%'>치료영역</th>
				<th width='10%'>학력</th>
				<th width='10%'>자격증</th>
				<th width='10%'>경력</th>
			</tr>
<?
$nTime = time();

if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$puid = $row["puid"];
		$name01 = $row["name01"];
		$bDate01 = $row["bDate01"];
		$bTime01 = $row["bTime01"];
		$gender01 = $row["gender01"];
		$rDate = $row["rDate"];
		$rTime = $row["rTime"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$ment01 = $row["ment01"];
		$ment02 = $row["ment02"];
		$ment03 = $row["ment03"];
		$ment04 = $row["ment04"];

		if($gender01 == '1'){
			$gender01 = '남';
		} else {
			$gender01 = '여';
		}
		

		if($status == '1')		$statusTxt = "<span class='ico03'>정상</span>";
		elseif($status == '2')	$statusTxt = "<span class='ico09'>중지</span>";
		else						$statusTxt = "<span class='ico10'>탈퇴</span>";

		if($level)		$levelTxt = "<span class='ico03'>VIP</span>";
		else			$levelTxt = "<span class='ico10'>일반</span>";

		$genderTxt = '';
		if($gender == '1')			$genderTxt = "<span class='ico06'>남</span>";
		elseif($gender == '2')	$genderTxt = "<span class='ico09'>여</span>";
?>
			<tr class='grayLine' onclick="reg_modify('<?=$uid?>')">
				<td><?=$i?></td>
				<td><?=$name01?></td>
				<td><?=$gender01?></td>
				<td><?=$data02?></td>
				<td><?=$data03?></td>
				<td><?=$ment02?></td>
				<td><?=$ment03?></td>
				<td><?=$ment04?></td>
			</tr>


<?
		$i--;
	}

}else{
?>
			<tr>
				<td colspan='16' style='padding:50px 0;text-align:center;'>등록된 선생님이 없습니다.</td>
			</tr>
<?
}
?>
		</table>

	<?
		if($total_record === '사용안함'){
	?>
		<!--
		<a href="javascript:modalOpen('c');" class="btn btn-sm btn-info btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">쿠폰발급</span>
		</a>
		-->
	<?
		}
	?>
	</div>
</div>

<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
?>

