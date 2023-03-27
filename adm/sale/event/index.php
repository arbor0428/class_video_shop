<?
include "/home/edufim/www/adm/header.php";
include "/home/edufim/www/module/datepicker/Calendar.php";
$sideArr[3] = 'active';
$showArr[3] = 'show';
$subArr['event'] = 'active';
include _ADM . '/sidemenu.php';
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
	<!-- Main Content -->
	<div id="content">
		<? include _ADM . '/nav.php'; ?>
		<!-- Page Content -->
		<div class="container-fluid">
			<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 이벤트</h6>
			<div class="card shadow mb-4" style='margin-top:10px;'>
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<? //include 'search.php'; ?>
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
		<!-- End of Page Content -->
	</div>
	<!-- End of Main Content -->
    
    <script>
        function formModal(u) {
            $("#multiBox").css({
                "width": "90%",
                "max-width": "800px"
            });
            $('#multi_ttl').text('쿠폰리스트');
            $('#multiFrame').html("<iframe src='./event_map/?event_uid=" + u + "' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
            $('.multiBox_open').click();
        }
        
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
            GblMsgConfirmBox("영구삭제된 데이터는 복구 되지 않습니다. 정말 삭제 하시겠습니까?", "reg_del('" + uid + "')");
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
