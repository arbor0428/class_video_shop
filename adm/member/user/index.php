<?
include "/home/edufim/www/adm/header.php";
$sideArr[2] = 'active';
$showArr[2] = 'show';
$subArr['user'] = 'active';
include _ADM . '/sidemenu.php';
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <? include _ADM . '/nav.php'; ?>
        <!-- Page Content -->
        <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
                <div class="col-sm mb-4">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 회원</h6>
                    <div class="card shadow mb-4" style='margin-top:10px;'>
                        <form name='frm01' id='frm01' method='post' action="<?= $_SERVER['PHP_SELF'] ?>">
                            <input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
                            <input type='hidden' name='type' value=''>
                            <input type='hidden' name='uid' value=''>
                            <input type='hidden' name='record_start' value='<?= $record_start ?>'>
                            <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
                            <input type='hidden' name='cType' value="user">
                            <input type='hidden' name='f_mtype' value="<?= $f_mtype ?>">

                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <?
                                include 'search.php';
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

    <script>
        function reg_write() {
            const form = document.frm01;
            form.type.value = 'write';
            form.action = 'index.php';
            form.submit();
        }

        function reg_list() {
            const form = document.frm01;
            form.type.value = 'list';
            form.action = 'index.php';
            form.submit();
        }

        function reg_edit(uid) {
            const form = document.frm01;
            form.type.value = 'edit';
            form.uid.value = uid;
            form.action = 'index.php';
            form.submit();
        }

        function reg_del(uid) {
            form = document.frm01;
            form.type.value = 'del';
            form.uid.value = uid;
            form.action = 'proc.php';
            form.submit();
        }

        function reg_able(uid) {
            const form = document.frm01;
            form.type.value = 'able';
            form.uid.value = uid;
            form.target = 'ifra_gbl';
            form.action = 'proc.php';
            form.submit();
        }

        function reg_disable(uid) {
            const form = document.frm01;
            form.type.value = 'disabled';
            form.uid.value = uid;
            form.target = 'ifra_gbl';
            form.action = 'proc.php';
            form.submit();
        }

        function reg_del_confirm(uid) {
            GblMsgConfirmBox("영구삭제된 강의는 복구 되지 않습니다. 정말 삭제 하시겠습니까?", "reg_del('" + uid + "')");
        }

        function reg_del_able(uid) {
            GblMsgConfirmBox("강의를 비활성화 하시겠습니까?", "reg_able('" + uid + "')");
        }

        function reg_del_disable(uid) {
            GblMsgConfirmBox("강의를 비활성화 하시겠습니까?", "reg_disable('" + uid + "')");
        }

        function searchChk() {
            form = document.frm01;
            form.type.value = '';
            form.record_start.value = '';
            form.target = '';
            form.action = "<?= $_SERVER['PHP_SELF'] ?>";
            form.submit();
        }

        function formModal(u) {
            $("#multiBox").css({
                "width": "90%",
                "max-width": "800px"
            });
            $('#multi_ttl').text('정보수정');
            $('#multiFrame').html("<iframe src='form.php?type=edit&uid=" + u + "' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
            $('.multiBox_open').click();
        }

        function modalOpen(c) {
            mt = $("#memType option:selected").val();

            if (mt == 'search') {
                total_record = $('#total_record').val();
                if (total_record == 0) {
                    GblMsgBox('검색된 회원이 없습니다.', '');
                    return;
                }

            } else if (mt == 'choice') {
                len = $('input:checkbox[class=cMail]:checked').length;
                if (len == 0) {
                    GblMsgBox('선택된 회원이 없습니다.', '');
                    return;
                }
            }

            if (c == 'm') {
                $("#multiBox").css({
                    "width": "90%",
                    "max-width": "1000px"
                });
                $('#multi_ttl').text('메일 작성');
                $('#multiFrame').html("<iframe src='about:blank' name='mailFrame' style='width:100%;height:700px;' frameborder='0' scrolling='auto'></iframe>");

                form = document.frm01;
                form.target = 'mailFrame';
                form.action = 'emailEditor.php';
                form.submit();

                $('.multiBox_open').click();

            } else if (c == 'c') {
                $("#multiBox").css({
                    "width": "90%",
                    "max-width": "700px"
                });
                $('#multi_ttl').text('쿠폰발급');
                $('#multiFrame').html("<iframe src='about:blank' name='couponFrame' style='width:100%;height:450px;' frameborder='0' scrolling='auto'></iframe>");

                form = document.frm01;
                form.target = 'couponFrame';
                form.action = '/adm/coupon/modalForm.php';
                form.submit();

                $('.multiBox_open').click();
            }
        }

        function modalClose() {
            $(".multiBox_close").click();
        }

        function ifra_xls() {
            form = document.frm01;
            form.type.value = '';
            form.target = '';
            form.action = 'excelDown.php';
            form.submit();
        }
    </script>

    <? include _ADM . '/footer.php'; ?>
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

</div>