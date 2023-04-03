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
			$subArr['test'] = 'active';
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

					<script>
					$(function(){
						$('.textBox01').keyup(function(){
							txt = $(this).val();
							var RegExp = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+┼<>@\#$%&\'\"\\\(\=]/gi;	//정규식 구문
							if(RegExp.test(txt)) {
								alert('특수문자는 사용할 수 없습니다.');
								// 특수문자 모두 제거    
								txt = txt.replace(RegExp , '');
								$(this).val(txt);
							}else if(event.keyCode == 13){
								name = $(this).attr('name');

								if(name == 'w_cade01')			cade01_save();
								else if(name == 'e_cade01')	cade01_modify();
								else if(name == 'w_cade02')	cade02_save();
								else if(name == 'e_cade02')	cade02_modify();
								else if(name == 'w_cade03')	cade03_save();
								else if(name == 'e_cade03')	cade03_modify();
							}
						});
					});
					</script>

					<style>
					.cadeBox{width:100%;clear:both;overflow:auto;}
					.cadeLeft{float:left;width:65%;}
					.cadeRight{float:right;width:35%;padding-left:5px;}
					</style>

					<form name='frm01' action="<?=$_SERVER['PHP_SELF']?>" method='post'>
					<input type='hidden' name='type' value=''>
					<input type='hidden' name='next_url' value='<?=$_SERVER['PHP_SELF']?>'>
					<div class="row">
                        <!-- First Column -->
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">1차 분류</h6>
                                </div>
                                <div class="card-body">
								<?
									include 'cade01.php';
								?>
                                </div>
                            </div>
                        </div>

                        <!-- Second Column -->
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">2차 분류</h6>
                                </div>
                                <div class="card-body">
								<?
									include 'cade02.php';
								?>
                                </div>
                            </div>

                        </div>

                        <!-- Third Column -->
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">3차 분류</h6>
                                </div>
                                <div class="card-body">
								<?
									include 'cade03.php';
								?>
                                </div>
                            </div>
                        </div>
                    </div>
					</form>


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