<?
include "/home/edufim/www/adm/header.php";
$sideArr[10] = 'active';
$showArr[10] = 'show';
$subArr['setting'] = 'active';

if (!$type)    $type = 'list';

include _ADM . '/sidemenu.php';
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <?
        include _ADM . '/nav.php';
        ?>
        <!-- Page Content -->
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <div class="col-sm mb-4">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 게시판관리</h6>
                    <div class="card shadow mb-4" style='margin-top:10px;'>
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <?
                            //include 'search.php';
                            ?>
                        </div>

                        <div class="card-body">
                            <?
                            switch ($type) {
                                case 'write':
                                case 'edit':
                                    include 'write.php';
                                    break;
                                case 'list':
                                    include 'list.php';
                                    break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </div>
    <!-- End of Main Content -->
    <?
    include _ADM . '/footer.php';
    ?>
</div>
<!-- End of Content Wrapper -->