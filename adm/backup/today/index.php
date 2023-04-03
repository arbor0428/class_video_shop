<?
include '../head.php';
include '../../module/loading.php';

if(!$GBL_USERID){
	header('Location:/');
	exit;
}
?>




<div id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">
		<?
			$sideArr[5] = 'active';
			$showArr[5] = 'show';
			$subArr['today'] = 'active';
			include '../sidemenu.php';
		?>
		
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
				<?
					include '../nav.php';
				?>
				<!-- Page Content -->
				<div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
						<div class="col-sm mb-4" style='max-width:1000px;'>
							<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 오늘의 한마디</h6>							
							<?
								if (!$type)  $type = 'list';
								$table_id = 'table_1668996838';

									//게시판 환경설정
									include $boardRoot . "config.php";
									$list_file='gallery01_today.php';
									$view_file='view01a.php';
									$write_file='write01a_today.php';

									switch ($type) {
										case 'write':
										case 'edit':
											include $boardRoot . $write_file;
											break;

										case 'list':
											include $boardRoot . 'query.php';  //게시판 내용 쿼리
											include $boardRoot . $list_file;  //게시판 리스트
											// include $boardRoot . 'pageNum.php';  //게시판 페이지번호
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
				<!-- End of Page Content -->
			</div>
			<!-- End of Main Content -->			

			<?
				include '../footer.php';
			?>
		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

</div>