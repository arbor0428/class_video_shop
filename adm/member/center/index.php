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
			$sideArr[2] = 'active';
			$showArr[2] = 'show';
			$subArr['center'] = 'active';
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
							<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 센터회원</h6>
							<div class="card shadow mb-4" style='margin-top:10px;'>
								<form name='frm01' id='frm01' method='post' action="<?=$_SERVER['PHP_SELF']?>">
								<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
								<input type='hidden' name='type' value=''>
								<input type='hidden' name='uid' value=''>
								<input type='hidden' name='record_start' value='<?=$record_start?>'>
								<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
								<input type='hidden' name='cType' value="user">

								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
								<?
									//include 'search.php';
								?>
								</div>

								<div class="card-body">
								<?
									include 'list.php';
								?>
								</div>

								</form>
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