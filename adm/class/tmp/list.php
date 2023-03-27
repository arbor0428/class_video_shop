<?
$record_count = 30;  //한 페이지에 출력되는 레코드수

$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!$record_start) {
	$record_start = 0;
}

$current_page = ($record_start / $record_count) + 1;

$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "where uid!=0";

//상태
if ($f_status == '1')		$query_ment .= " and status='1'";
elseif ($f_status == '2')	$query_ment .= " and status='2'";
elseif ($f_status == '3')	$query_ment .= " and status=''";

//아이디
if ($f_userid)	 $query_ment .= " and userid like '%$f_userid%'";

//성명
if ($f_name)	 $query_ment .= " and title like '%$f_name%'";

if (!$f_sort)	$f_sort = 'rTime';


$sort_ment = "ORDER BY uid desc";
// if ($f_sort == 'rTime')$sort_ment = "order by rTime desc";
// else	$sort_ment = "order by uid desc";

$query = "select * from ks_class $query_ment $sort_ment";

$result = mysql_query($query) or die("연결실패");

$total_record = mysql_num_rows($result);

$total_page = (int)($total_record / $record_count);

if ($total_record % $record_count) {
	$total_page++;
}

$query2 = $query . " limit $record_start, $record_count";

$result = mysql_query($query2);
?>

<style>
	.listTable td {
		text-align: center;
	}
</style>


<script>
	function formModal(u) {
		$("#multiBox").css({
			"width": "90%",
			"max-width": "800px"
		});
		$('#multi_ttl').text('정보수정');
		$('#multiFrame').html("<iframe src='form.php?type=edit&uid=" + u + "' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
		$('.multiBox_open').click();
	}

	function formModal2(u) {
		$("#multiBox").css({
			"width": "90%",
			"max-width": "800px"
		});
		$('#multi_ttl').text('영상리스트');
		$('#multiFrame').html("<iframe src='index2.php?class_uid=" + u + "' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
		$('.multiBox_open').click();
	}

	function checkAble(uid) {
		GblMsgConfirmBox("강의를 비활성화 하시겠습니까?", "reg_disabled('" + uid + "')");
	}

	function checkDisabled(uid) {
		GblMsgConfirmBox("강의를 비활성화 하시겠습니까?", "reg_disabled('" + uid + "')");
	}

	function checkDel(uid) {
		GblMsgConfirmBox("영구삭제된 강의는 복구 되지 않습니다. 정말 삭제 하시겠습니까?", "delOK('" + uid + "')");
	}

	function reg_able(uid) {
		form = document.frm01;
		form.type.value = 'able';
		form.uid.value = uid;
		form.target = 'ifra_gbl';
		form.action = 'proc.php';
		form.submit();
	}

	function reg_disabled(uid) {
		form = document.frm01;
		form.type.value = 'disabled';
		form.uid.value = uid;
		form.target = 'ifra_gbl';
		form.action = 'proc.php';
		form.submit();
	}

	function delOK(uid) {
		form = document.frm01;
		form.type.value = 'del';
		form.uid.value = uid;
		form.target = 'ifra_gbl';
		form.action = 'proc.php';
		form.submit();
	}

	function reg_write() {
		form = document.frm01;
		form.type.value = 'write';
		form.action = 'index.php';
		form.submit();
	}

	function reg_modify(uid) {
		form = document.frm01;
		form.type.value = 'edit';
		form.uid.value = uid;
		form.action = 'index.php';
		form.submit();
	}
</script>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
	<input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
	<input type='hidden' name='type' value='<?= $type ?>'>
	<input type='hidden' name='uid' value=''>
	<input type='hidden' name='record_start' value='<?= $record_start ?>'>
	<input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
	<input type='hidden' name='cType' value="user">
	<input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>

	<div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
		<span class="scorll-hand">
			<img src="/common/adm/images/scroll_hand.gif" style="max-width:100%;">
		</span>
	</div>

	<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
		<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">

			<a href="javascript:reg_write();" class="btn btn-sm btn-success btn-icon-split" style="margin-top:-5px;">
				<span class="icon text-white-50">
					<i class="fas fa-download"></i>
				</span>
				<span class="text">등록</span>
			</a>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
				<tr>
					<th width='50'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
					<!-- <th width='70'>번호</th> -->
					<th width='50'>상태</th>
					<th></th>
					<th>제목</th>
					<th>카테고리</th>
					<th>금액</th>
					<th>영상리스트</th>
					<th width='120'>등록일시</th>
					<th width='120'>편집</th>
				</tr>
				<?
				$nTime = time();

				if ($total_record) {
					$i = $total_record - ($current_page - 1) * $record_count;

					while ($row = mysql_fetch_array($result)) {

						$uid = $row["uid"];
						$status = $row["status"];
						$title = $row["title"];
						$price = $row["price"];
						$rDate = $row["rDate"];
						$upfile01 = $row["upfile01"];

						$cade01 = $row["cade01"];
						$cade02 = $row["cade02"];
						// $cade03 = $row["cade03"];

						$cade01 = sqlRowOne("SELECT title FROM ks_class_cade01 WHERE uid=$cade01");
						$cade02 = sqlRowOne("SELECT title FROM ks_class_cade02 WHERE uid=$cade02");

						if ($status == '1')		$statusTxt = "<span class='ico03'>활성</span>";
						elseif ($status == '2')	$statusTxt = "<span class='ico09'>비활성</span>";
						else					$statusTxt = "<span class='ico10'>대기</span>";
				?>
						<tr class='grayLine'>
							<td>
								<input type="checkbox" name="chk[]" value="<?= $uid ?>" class="cMail">
								<? if ($receiveChk) { ?>
								<? } ?>
							</td>
							<!-- <td><?= $i ?></td> -->
							<td><?= $statusTxt ?></td>
							<td><img src="/upfile/class/<?= $upfile01 ?>" alt="<?= $upfile01 ?>"  width='100'></td>
							<td><?= $title ?></td>
							<td>
								<?
								$cade = $cade01 . " > " . $cade02;
								// if ($cade03) $cade .= " > " . $cade03;
								echo $cade;
								?>
							</td>
							<td><?= number_format($price) ?> 원</td>
							<td><a href='javascript:formModal2("<?=$uid?>")' class='small cbtn black'>영상리스트</a></td>
							<td><?= $rDate ?></td>
							<td>
								<a href="javascript:void(0)" class="btn btn-success btn-circle btn-sm" title='수정' onclick="reg_modify('<?= $uid ?>')">
									<i class="fas fa-info-circle"></i>
								</a>
								<!-- <a href="javascript:checkDisabled('<?= $uid ?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'> -->
								<a href="javascript:checkDel('<?= $uid ?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'>
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>

					<?
						$i--;
					}
				} else {
					?>
					<tr>
						<td colspan='16' style='padding:50px 0;text-align:center;'>등록된 강좌가 없습니다.</td>
					</tr>
				<?
				}
				?>
			</table>

		</div>
	</div>
</form>

<?
$fName = 'frm01';
include '../../module/pageNum.php';
?>