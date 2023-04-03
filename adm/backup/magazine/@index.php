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
			$sideArr[1] = 'active';
			$showArr[1] = 'show';
			$subArr['magazine'] = 'active';
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
							<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 매거진</h6>							
							<?
								if(!$type)	$type = 'list';

								if($type == 'list')			include 'list.php';
								elseif($type == 'write')	include 'write.php';
								elseif($type == 'edit')	include 'write.php';
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