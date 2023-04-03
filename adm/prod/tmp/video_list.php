<script>
	function go_reg() {
		form = document.frm01;
		form.type.value = 'write';
		form.action = '<?= $PHP_SELF ?>';
		form.submit();
	}
	function go_modify(uid) {
		form = document.frm01;
		form.type.value = 'edit';
		form.uid.value = uid;
		form.action = '<?= $PHP_SELF ?>';
		form.submit();
	}
</script>

<form name='frm01' method='post' action='<?= $PHP_SELF ?>'>
	<input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='uid' value=''>
	<input type='hidden' name='class_uid' value='<?= $class_uid ?>'>

	<input type='hidden' name='mtype' value='<?= $mtype ?>'>
	<input type='hidden' name='record_start' value='<?= $record_start ?>'>
	<input type='hidden' name='next_url' value='<?= $PHP_SELF ?>'>

	<a href='javascript:go_reg()' class='small cbtn green'>영상등록</a>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable'>
		<tr bgcolor="" align='center'>
			<th width="*" class='w'>영상제목</td>
			<th width="20%" class='w'>시간</td>
		</tr>

		<?
		$i = 0;
		$query = "select * from ks_class_list where class_uid=$class_uid";

		$result = mysql_query($query);

		while ($row = mysql_fetch_array($result)) {
			$uid = $row["uid"];
			$title = $row["title"];
			$exp = $row["exp"];
			$length = $row["length"];
		?>
			<tr onclick='javascript:go_modify("<?= $uid ?>")'>
				<td><?= $title ?></td>
				<td><?= $length ?></td>
			</tr>

		<? } ?>
	</table>
</form>