<?
include "/home/edufim/www/adm/head.php";
include '/home/edufim/www/module/loading.php';

if (!$GBL_USERID) {
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
		$subArr['homet'] = 'active';
		include '../../sidemenu.php';
		?>
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<?
				include '../../nav.php';
				?>
				<!-- Page Content -->
				<div class="container-fluid">
					<style>
						.sample-re{
							font-family: 'NanumSquare', sans-serif;
							transform: skew(-0.001deg);
							padding:300px 0 200px 0;
							color:#333;
							word-break:keep-all;
							font-size:18px;
							line-height:150%;
							text-align:center;
						}
						.sample-re .img{width:13%; margin:0 auto;}
						.sample-re .txt>h1{font-size:50px; font-weight:400; margin:50px 0;line-height:150%;}
						.sample-re .txt .txt-s{color:#666;}

						@media screen and (max-width:768px){
							.sample-re{
								padding:200px 0 100px 0;
								font-size:16px;
								transform: skew(-0.001deg);
							}
							.sample-re .img{width:25%; margin:0 auto;}
							.sample-re .txt>h1{font-size:30px; margin:30px 0 20px;}
						}
					</style>
					<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 홈트</h6>
					<div class="sample-re">
						<div class="img">
							<img src="http://i-web.kr/wlsdud0812/uploaded/smart/N201222101346vkz57wrbtp.png" alt="pic" style="width:100%;">
						</div>
						<div class="txt">
							<h1>페이지 준비중입니다.</h1>
							<div class="txt-s">
								이용에 불편을 드려 죄송합니다.<br>
								빠른 시일내에 준비하도록 하겠습니다.
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