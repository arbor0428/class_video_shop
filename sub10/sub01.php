<?
include '../header.php';
$side_menu = 1;
?>


<div class="subWrap">
	<div class="s_center dp_sb">
		<?
		include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit f20 bold2 c_bora01">공지사항</div>

			<div class="">
				<?
				$table_id = 'table_1675005604';

				if (!$type)	$type = 'list';

				//게시판 환경설정
				include $boardRoot . "config.php";
                
                if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
                    echo $boardRoot. "<br>";
                    echo $type. "<br>";
                    echo $write_file. "<br>";
                    echo $list_file. "<br>";
                    echo $view_file. "<br>";
                }
				switch ($type) {
					case 'write':
					case 'edit':
						include $boardRoot . $write_file;
						break;

					case 'list':
						include $boardRoot . 'query.php';	//게시판 내용 쿼리
						include $boardRoot . $list_file;	//게시판 리스트
						include $boardRoot . 'pageNum.php';	//게시판 리스트
						break;

					case 'view':
						include $boardRoot . $view_file;
						break;

					case 're_write':
					case 're_edit':
						include $boardRoot . 're_write.php';
						break;

					case 're_view':
						include $boardRoot . 're_view.php';
						break;
				}
				?>
			</div>
		</div>
	</div>
</div>

<?
include '../footer.php';
?>