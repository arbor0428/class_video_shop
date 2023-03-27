<?
	$sql_c = "select * from tb_board_set where table_id='$table_id'";
	$result_c = mysql_query($sql_c);
	$num_c = mysql_num_rows($result_c);
	$row_c = mysql_fetch_array($result_c);
	$cade03_chk = $row_c['cade03'];
	$cade03sort = $row_c['cade03sort'];

?>
<style>
.board-cade03{
	margin:50px auto;
	text-align:center;
}
.board-cade03 ul{
	font-size:0px;
	text-align:center;
}
.board-cade03 li.active{
	border:2px solid #183728;
	text-align:center;
	border-radius:30px;
}
.board-cade03 ul > li {
    display: inline-block;
    margin: 0 0px;
	padding:0 12px;
    transition: all 0.25s ease-in;
}
.board-cade03 ul > li.active a {
    font-weight: 500;
    color: #212121;
}
.board-cade03 ul > li a {
    display: block;
    padding: 8px 10px;
    transition: all 0.25s;
    font-size: 1.125rem;
	letter-spacing:-1px;
}

</style>
<script>
function board_cade03(c){
	form = document.frm01;
	form.f_cade03.value = c;
	form.record_start.value = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}
</script>
<input type='hidden' name='f_cade03' value='<?=$f_cade03?>'>
<div class="board-cade03">
	<ul>
		<?
				if(!$cade03sort)		$query_sort='order by cade03 asc';
				else					$query_sort='order by cade03 desc';

				$sql_c = "select distinct(cade03) from tb_board_list where table_id='$table_id' ".$query_sort;

				$result_c = mysql_query($sql_c);
				$num_c = mysql_num_rows($result_c);

				if($num_c>=1){
				?>
				<li class="<?if(!$f_cade03){echo'active';}?>">
					<a href='javascript:board_cade03("")'>전체</a>
				</li>
				<?
				}
				while($row_c = mysql_fetch_array($result_c)){
					$cade03Txt = $row_c["cade03"];
					if($cade03Txt){
		?>
			<li class='<?if($f_cade03==$cade03Txt){echo'active';}?>'><a href='javascript:board_cade03("<?=$cade03Txt?>")'><?=$cade03Txt?></a></li>
		<?
					}
				}	
			
		?>
	</ul>
</div>
