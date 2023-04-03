<?
	if($type=='view' && $uid){
		$row = sqlRow("select * from ks_contact where uid='".$uid."'");
	}
?>

<script>
function reg_list(){
	form = document.frm01;
	form.type.value = 'list';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function checkDel(){
	GblMsgConfirmBox("해당 내용을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.frm01;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
</script>


<form name='frm01' action="<?=$_SERVER['PHP_SELF']?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$_SERVER['PHP_SELF']?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_company' value='<?=$f_company?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>
<!-- /검색관련 -->

<div class="card shadow mb-4" style='margin-top:10px;width:100%;max-width:1000px;'>
	<div class="card-body">
		<div class="tbl-st-wrap01" style="clear:both;border-top:0;">
			<div class="mb20 clearfix">
				<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable' style='min-width:900px;'>
					<tr>
						<th width='17%'>업체명</th>
						<td width='83%'><?=$row['company']?></td>
					</tr>

					<tr>
						<th>담당자</th>
						<td><?=$row['name']?></td>
					</tr>

					<tr>
						<th>연락처</th>
						<td><?=$row['name']?></td>
					</tr>

					<tr>
						<th>이메일</th>
						<td><?=$row['email']?></td>
					</tr>

					<tr>
						<th>문의내용</th>
						<td><?=$row['ment']?></td>
					</tr>

					<tr>
						<th>접수일시</th>
						<td><?=$row['rDate']?></td>
					</tr>
				</table>

				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<tr>
						<td align='center' style='padding:30px 0;'>
							<a href="javascript:reg_list();" class='big cbtn black'>목록</a>
							<a href="javascript:checkDel();" class='big cbtn blood'>삭제</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>


</form>