<?
include "/home/edufim/www/adm/header.php";
$sideArr[1] = 'active';
$showArr[1] = 'show';
$subArr['all'] = 'active';
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

            <script>
                $(function() {
                    $('.textBox01').keyup(function() {
                        txt = $(this).val();
                        var RegExp = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+┼<>@\#$%&\'\"\\\(\=]/gi; //정규식 구문
                        if (RegExp.test(txt)) {
                            alert('특수문자는 사용할 수 없습니다.');
                            // 특수문자 모두 제거    
                            txt = txt.replace(RegExp, '');
                            $(this).val(txt);
                        } else if (event.keyCode == 13) {
                            name = $(this).attr('name');

                            if (name == 'w_cade01') cade01_save();
                            else if (name == 'e_cade01') cade01_modify();
                            else if (name == 'w_cade02') cade02_save();
                            else if (name == 'e_cade02') cade02_modify();
                        }
                    });
                });
            </script>

            <style>
                .cadeBox {
                    width: 100%;
                    clear: both;
                    overflow: auto;
                }

                .cadeLeft {
                    float: left;
                    width: 65%;
                }

                .cadeRight {
                    float: right;
                    width: 35%;
                    padding-left: 5px;
                }
            </style>
            <h6 class="font-weight-bold text-primary"><i class="far fa-calendar-check"></i> ALL클래스 - 카테고리</h6>
            <form name='frm01' action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
                <input type='hidden' name='type' value=''>
                <input type='hidden' name='next_url' value='<?= $_SERVER['PHP_SELF'] ?>'>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-primary">1차 카테고리</h5>
                            </div>
                            <div class="card-body">
                                <?
                                include 'cade01.php';
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-primary">2차 카테고리</h5>
                            </div>
                            <div class="card-body">
                                <?
                                include 'cade02.php';
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-primary">3차 카테고리</h5>
                            </div>
                            <div class="card-body">
                                <?
                                include 'cade03.php';
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-primary">4차 카테고리</h5>
                            </div>
                            <div class="card-body">
                                <?
                                //include 'cade04.php';
                                ?>
                            </div>
                        </div>
                    </div> -->
                </div>
            </form>

            <div style='width:100%;margin:40px 0;text-align:center;'>
                <a href="../"class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-list"></i>
                    </span>
                    <span class="text">목록으로</span>
                </a>
            </div>


        </div>
        <!-- End of Page Content -->
    </div>
    <!-- End of Main Content -->
    <? include _ADM . '/footer.php'; ?>
</div>
<!-- End of Content Wrapper -->