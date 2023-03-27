<?
include './header.php';
include './sidemenu.php';

$query = "SELECT * FROM config_main ORDER BY sort";
$row_arr = sqlArray($query);
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <? include './nav.php'; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <div class="col-sm mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table me-1"></i> 메인화면</h6>
                        </div>
                        <div class="card-body">
                            <div class="mo-hand1 mo-hand" style="text-align:right;">
                                <span class="scorll-hand">
                                    <!-- <img src="img/scroll_hand.gif" style="max-width:100%;"> -->
                                </span>
                            </div>
                            <div>
                                <!-- <div>
                                    <img src="/images/mainslide01.jpg" alt="" width="384" height="80">
                                    <button class="big cbtn bora">찾아보기</button>
                                </div>
                                <div>
                                    <img src="/images/mainslide01.jpg" alt="" width="384" height="80">
                                    <button class="big cbtn bora">찾아보기</button>
                                </div>
                                <div>
                                    <img src="/images/mainslide01.jpg" alt="" width="384" height="80">
                                    <button class="big cbtn bora">찾아보기</button>
                                </div>
                                <div>
                                    <img src="/images/mainslide01.jpg" alt="" width="384" height="80">
                                    <button class="big cbtn bora">찾아보기</button>
                                </div> -->
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            
            <!-- Content Row -->
            <div class="row">
                <div class="col-sm mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table me-1"></i> 신규강좌</h6>
                        </div>
                        <div class="card-body">
                            <div class="mo-hand1 mo-hand" style="text-align:right;">
                                <span class="scorll-hand">
                                    <!-- <img src="img/scroll_hand.gif" style="max-width:100%;"> -->
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Content Row -->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-area me-1"></i> 인기강좌</h6>
                            <!--
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
									-->
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-pie"></i> 접속자</h6>
                            <!--
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
									-->
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text1"></i> 신규회원
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text2"></i> 방문자
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text3"></i> 결제회원
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text4"></i> 탈퇴회원
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of Container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->

<!-- *** 이부분을.... head.php에 선언하려 했으나... 차트 작동이 안되는 문제로.... *** -->

<!-- Page level plugins -->
<script src="/common/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/common/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<? include "./footer.php"; ?>
<!-- Page level custom scripts -->

<!-- <script src="/common/js/demo/chart-area-demo.js"></script> -->
<!-- <script src="/common/js/demo/chart-pie-demo.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="/common/js/demo/datatables-demo.js"></script> -->