<?
$side[$cade01] = "content_box_a03";
$side2[$cade02] = "on";
?>

<div class='sidemenu sidemenu02'>
	<a href="/sub01/" class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc" title="ALL클래스">ALL클래스</a>

	<?
	$sql = "SELECT * FROM ks_class_cade01 ORDER BY sort";
	$rowArr = sqlArray($sql);
	foreach ($rowArr as $row) {
		$sql2 = "SELECT * FROM ks_class_cade02 WHERE cade01=" . $row['uid'] . " ORDER BY sort";
		$rowArr2 = sqlArray($sql2);
	?>
		<ul class="sidemenu_list">
			<li class='<?= $side[$row['uid']] ?>'>
				<img src="/images/sub/arr_btn1.svg" alt="화살표">
				<a class="dp_sb dp_c" href='sub01.php?&cade01=<?= $row['uid'] ?>'><?= $row['title'] ?></a>
				<ul class="depth2">
					<? foreach ($rowArr2 as $row2) { ?>
						<li class='<?= $side2[$row2['uid']] ?>'><a href="sub02.php?&cade01=<?= $row['uid'] ?>&cade02=<?= $row2['uid'] ?>" title="<?= $row2['title'] ?>"><?= $row2['title'] ?></a></li>
					<? $j++;
					} ?>
				</ul>
			</li>
		</ul>
	<? $i++;
	} ?>
</div>

<script>
	var flag = true;
	$(".sidemenu02 .sidemenu_list > li > img").click(function() {

		if ($(this).parent().hasClass("content_box_a03")) {

			$(this).parent().removeClass("content_box_a03");
			$(this).siblings(".depth2").stop().slideUp();

		} else {

			$(this).parent().addClass("content_box_a03");
			$(this).parent().siblings().children(".depth2").stop().hide();
			$(this).siblings(".depth2").stop().slideDown();

		}
	});
</script>