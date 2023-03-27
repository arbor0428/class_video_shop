<?
include "/home/edufim/www/adm/header.php";
// include "/home/edufim/www/module/datepicker/Calendar.php";
// $sideArr[3] = 'active';
// $showArr[3] = 'show';
// $subArr['event'] = 'active';
// include _ADM . '/sidemenu.php';

if (isset($type)) $type = 'list';

// $chk_icon01 = "<span class='eqc'>*</span>";

// $query = "SELECT c.*, v.filename 
//     FROM ks_class_list c 
//     LEFT JOIN kollus_video v ON c.kollus_video_id=v.id
//     WHERE c.class_uid='$uid'";
// $row_arr = sqlArray($query);

$query = "SELECT c.*, m.*, c1.title c1t, c2.title c2t 
    FROM ks_class c 
    LEFT JOIN ks_event_map m ON c.uid=m.class_uid
    LEFT JOIN ks_class_cade01 c1 ON c.cade01=c1.uid 
    LEFT JOIN ks_class_cade02 c2 ON c.cade02=c2.uid";
// $query .= " JOIN ks_class c ON M.CLASS_UID=c.uid";
// $query .= " WHERE M.CLASS_UID IS NOT NULL";
// echo $query;
$result = mysql_query("$query WHERE m.event_uid='$event_uid'") or die(mysql_error());
$result2 = mysql_query("$query WHERE m.event_uid IS NULL") or die(mysql_error());

?>

<style>
	.listTable td {
		text-align: center;
	}
	.set-class-list {
		border: 1px solid #4e73df;
		margin-bottom: 30px;
	}
</style>

<form name='frm01' action="./proc.php" method='post' ENCTYPE="multipart/form-data" class="user" style="width: 100%;">
	<input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
	<input type='hidden' name='type' value='<?= $type ?>'>
	<input type='hidden' name='event_uid' value='<?= $event_uid ?>'>
	<input type='hidden' name='class_uid' value=''>
	<input type='hidden' name='next_url' value="<?= $PHP_SELF ?>">
	<!-- <input type='hidden' name='record_start' value='<?= $record_start ?>'> -->
	<!-- <input type='hidden' name='cType' value="user"> -->
	<!-- <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'> -->
	<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
		<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
			<div class="m-0 font-weight-bold text-primary">추가목록</div>
			<table width="100%" cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='max-width:800px;'>
				<tr>
					<th>상태</th>
					<th>강좌</th>
					<th>제목</th>
					<th>카테고리 1</th>
					<th>카테고리 2</th>
					<th>금액(원)</th>
					<th>-</th>
				</tr>

				<?
				while ($row = mysql_fetch_assoc($result)) {
					foreach ($row as $k => $v) {
						${$k} = $v;
					}
					if ($status == '0')		$status = "<span class='ico09'>비활성</span>";
					elseif ($status == '1') $status = "<span class='ico03'>활성</span>";
				?>
					<tr class='grayLine'>
						<td><?= $status ?></td>
						<td><img src="/upfile/class/<?= $upfile01 ?>" alt="썸네일" width='100'></td>
						<td><?= $title ?></td>
						<td><?= $c1t ?></td>
						<td><?= $c2t ?></td>
						<td><?= number_format($price) ?></td>
						<td>
							<button class="btn btn-sm btn-danger btn-icon-split" onclick="removeClass(<?= $uid ?>)">
								<span class="text">제거</span>
							</button>
						</td>
					</tr>
				<? } ?>
			</table>
			<div class="mt-5 font-weight-bold text-primary">강의</div>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='max-width:800px;'>
				<?
				while ($row = mysql_fetch_assoc($result2)) {
					foreach ($row as $k => $v) {
						${$k} = $v;
					}
					if ($status == '1')		$statusTxt = "<span class='ico03'>활성</span>";
					elseif ($status == '2')	$statusTxt = "<span class='ico09'>비활성</span>";
					else					$statusTxt = "<span class='ico10'>대기</span>";
				?>
					<tr class='grayLine'>
						<td><?= $statusTxt ?></td>
						<td><img src="/upfile/class/<?= $upfile01 ?>" alt="썸네일" width='100'></td>
						<td><?= $title ?></td>
						<td><?= $c1t ?></td>
						<td><?= $c2t ?></td>
						<td><?= number_format($price) ?></td>
						<td>
							<button class="btn btn-sm btn-success btn-icon-split" onclick="addClass(<?= $uid ?>)">
								<span class="text">추가</span>
							</button>
						</td>
					</tr>
				<? } ?>
			</table>

		</div>
	</div>
</form>
<script>
	const addClass = function(uid) {
		const form = document.frm01;
		form.type.value = 'ADD';
		form.class_uid.value = uid;
		// form.target = 'ifra_gbl';
		// form.action = 'proc.php';
		form.submit();
	}
	const removeClass = function(uid) {
		const form = document.frm01;
		form.type.value = 'REMOVE';
		form.class_uid.value = uid;
		// form.target = 'ifra_gbl';
		// form.action = 'proc.php';
		form.submit();
	}
</script>

<?
// include _ADM . '/footer.php';
?>