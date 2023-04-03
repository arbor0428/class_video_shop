<?
include '../head.php';
include '../../module/loading.php';

if(!$GBL_USERID){
	header('Location:/');
	exit;
}
?>


<link rel="stylesheet" type="text/css" href="/mobile/css/m_test.css?v=7">
<link rel="stylesheet" type="text/css" href="/mobile/css/m_main2.css?v=7">
<link rel="stylesheet" type="text/css" href="/mobile/css/m_parenting.css?v=7">

<style>
	body{font-size:20px;}
	.magazine-inner-tit{font-size:20px !important;}
	.magazine-sec01{padding:0;margin-top:0}
	.magazine-inner{margin-top:0}
</style>


<div id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">
		<?
			$sideArr[4] = 'active';
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
						<div class="col-sm mb-4">
							<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 아맘때매거진 관리</h6>
							<div class="card shadow mb-4" style='margin-top:10px;max-width:768px;font-size:20px;'>
								

								
	
								<?
									if (!$type)  $type = 'list';
									if($type!='list'){
								?>
									<a href="javascript:backTotal();">
										<div class="test-header-arr" style='padding:20px;'>
											<img src="/mobile/images/arr-left.svg"> <!--화살표 자리 -->
										</div>
									</a>
								<?
									}
									
									$table_id = 'table_1668131129';

									//게시판 환경설정
									include $boardRoot . "config.php";

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