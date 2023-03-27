<?
$record_count = 30;  //한 페이지에 출력되는 레코드수

$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!$record_start) {
	$record_start = 0;
}

$current_page = ($record_start / $record_count) + 1;

$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "where uid>0";

//구분
if ($f_ptype)	$query_ment .= " and ptype='$f_ptype'";

//아이디
if ($f_userid)	 $query_ment .= " and userid like '%$f_userid%'";

//처리일 시작
if ($f_sDate) {
	$f_sTime = strtotime($f_sDate);
	$query_ment .= " and rTime>='$f_sTime'";
}

//처리일 종료
if ($f_eDate) {
	$f_eTime = strtotime($f_eDate);
	$query_ment .= " and rTime<='$f_eTime'";
}

$sort_ment = "order by rTime desc";

$query = "select * from ks_point $query_ment $sort_ment";

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

	span.btn-sm {
		height: 1.1rem !important;
		width: 1.1rem !important;
		font-size: 0.75rem !important;
	}
</style>

<div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
	<span class="scorll-hand">
		<img src="/adm/img/scroll_hand.gif" style="max-width:100%;">
	</span>
</div>

<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
	<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
		<a href="javascript:setPoint();" class="btn btn-sm btn-primary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-download"></i>
			</span>
			<span class="text">포인트설정</span>
		</a>
		<a href="javascript:ifra_xls();" class="btn btn-sm btn-success btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-download"></i>
			</span>
			<span class="text">엑셀다운로드</span>
		</a>

		<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
			<tr>
				<th width='70'>번호</th>
				<th>구분</th>
				<th>아이디</th>
				<th>포인트</th>
				<th>내용</th>
				<th width='180'>처리일시</th>
			</tr>
			<?
			if ($total_record) {
				$i = $total_record - ($current_page - 1) * $record_count;

				while ($row = mysql_fetch_array($result)) {

					$ptype = $row["ptype"];
					$userid = $row["userid"];
					$point = $row["point"];
					$pMent = $row["pMent"];
					$orderNum = $row["orderNum"];
					$rDate = $row['rDate'];

					if ($ptype == 'M') {
						$ptxt = '차감';
						$pico = "<span class='btn-danger btn-circle btn-sm'>-</span>";
					} elseif ($ptype == 'P') {
						$ptxt = '적립';
						$pico = "<span class='btn-primary btn-circle btn-sm'>+</span>";
					}
			?>
					<tr class='grayLine'>
						<td><?= $i ?></td>
						<td><?= $ptxt ?></td>
						<td><?= $userid ?> (<?= $sArr[$userid] ?>)</td>
						<td><?= $pico ?> <?= number_format($point) ?></td>
						<td><?= $pMent ?></td>
						<td><?= $rDate ?></td>
					</tr>
				<?
					$i--;
				}
			} else {
				?>
				<tr>
					<td colspan='6' style='padding:50px 0;text-align:center;'>포인트 내역이 없습니다.</td>
				</tr>
			<?
			}
			?>
		</table>
	</div>
</div>

<script>
	const setPoint = function() {
		$("#multiBox").css({"width":"90%","max-width":"550px"});
		$('#multi_ttl').text('포인트 설정');
		$('#multiFrame').html("<iframe src='./pointConfig.php' name='configFrame' style='width:100%;height:400px;' frameborder='0' scrolling='auto'></iframe>");
		$('.multiBox_open').click();
	}
	function formModal(u) {
		$("#multiBox").css({
			"width": "90%",
			"max-width": "750px"
		});
		$('#multi_ttl').text('정보수정');
		$('#multiFrame').html("<iframe src='form.php?type=edit&uid=" + u + "' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
		$('.multiBox_open').click();
	}

	function checkDel(name, uid) {
		GblMsgConfirmBox("[" + name + "]님의 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.", "delOK('" + uid + "')");
	}

	function delOK(uid) {
		form = document.frm01;
		form.type.value = 'del';
		form.uid.value = uid;
		form.target = 'ifra_gbl';
		form.action = 'proc.php';
		form.submit();
	}

	function ifra_xls() {
		form = document.frm01;
		form.type.value = '';
		form.target = '';
		form.action = 'excelDown.php';
		form.submit();
	}
</script>

<?
$fName = 'frm01';
include '../../module/pageNum.php';
?>