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
			$sideArr[3] = 'active';
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
							<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 검사관리</h6>							
							<?
								//달력
								include '../../module/datepicker/Calendar.php';

								if(!$type)	$type = 'list';

								if($type == 'list')			include 'list.php';
								elseif($type == 'write')	include 'write.php';
								elseif($type == 'edit')	include 'write.php';
								elseif($type == 'view')	include 'view.php';	//결제완료인 경우..
							?>
						</div>
                    </div>
					<!--준비중 이미지 -->
					<div style="width:100%; margin: 100px auto; text-align:center;">
						<img src="../img/repare.png" alt="준비중">
					</div>
					<!--준비중 이미지 -->
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