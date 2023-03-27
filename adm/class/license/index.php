<?
include "/home/edufim/www/adm/header.php";
$sideArr[1] = 'active';
$showArr[1] = 'show';
$subArr['license'] = 'active';
include _ADM . '/sidemenu.php';

define('_TITLE', '자격증과정');
define('_UPLOAD_DIR', '/upfile/license/');
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
	<!-- Main Content -->
	<div id="content">
		<? include _ADM . '/nav.php'; ?>
		<!-- Page Content -->
		<div class="container-fluid">
			<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> <?= _TITLE ?></h6>
			<div class="card shadow mb-4" style='margin-top:10px;'>
				
                <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">1. 상위 카테고리</h5>
                    <?
                    include './search.php';
                    ?>
                </div> -->
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
    </script>

	<? include _ADM . '/footer.php'; ?>
</div>
<!-- End of Content Wrapper -->