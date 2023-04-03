<?
include "/home/edufim/www/adm/header.php";
$sideArr[1] = 'active';

include _ADM . '/sidemenu-T.php';
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 프로필 편집</h6>
                    <div class="card shadow mb-4" style='margin-top:10px;'>
                        <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <?
                                include 'search.php';
                                ?>
                            </div> -->

                        <div class="card-body">
                            <?
                            include 'write.php';
                            ?>
                        </div>
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
            form.action = 'proc.php';
            form.submit();
        }
        
        function fileChk(file) {
            if (file.value != "") {
                var ext = file.value.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpg', 'gif', 'png']) == -1) {
                    // GblMsgBox('jpg, gif, png\n파일만 등록이 가능합니다.', '');
                    GblMsgBox('사진 파일만 등록이 가능합니다', '');
                    file.value = '';
                    return;

                } else {
                    var fileSize = 0;

                    // 브라우저 확인
                    var browser = navigator.appName;

                    // 익스플로러일 경우
                    if (browser == "Microsoft Internet Explorer") {
                        var oas = new ActiveXObject("Scripting.FileSystemObject");
                        fileSize = oas.getFile(file.value).size;

                        // 익스플로러가 아닐경우
                    } else {
                        fileSize = file.files[0].size;
                    }

                    fS = Math.round(fileSize / 1024);

                    if (fS > 10240) {
                        GblMsgBox('10MB 이하로 등록 해주세요', '');
                        file.value = '';
                        return;
                    } else {
                        console.log("upload");
                    }
                }
            } else {
                GblMsgBox('파일을 선택해 주세요', '');
                file.value = '';
                return;
            }
        }
    </script>

    <!-- <script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
    <script>
        function openDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var fullAddr = ''; // 최종 주소 변수
                    var extraAddr = ''; // 조합형 주소 변수

                    // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        fullAddr = data.roadAddress;

                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        fullAddr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                    if (data.userSelectedType === 'R') {
                        //법정동명이 있을 경우 추가한다.
                        if (data.bname !== '') {
                            extraAddr += data.bname;
                        }
                        // 건물명이 있을 경우 추가한다.
                        if (data.buildingName !== '') {
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                        fullAddr += (extraAddr !== '' ? ' (' + extraAddr + ')' : '');
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.			
                    /*
                    			document.getElementById('zip01').value = data.postcode1;
                    			document.getElementById('zip02').value = data.postcode2;
                    */
                    //			document.getElementById('zipcode').value = data.zonecode;
                    document.getElementById('uid').value = fullAddr;
                    document.getElementById('addr02').focus();
                }
            }).open();
        }

        function formChk() {
            form = document.frm01;

            //	if(isFrmEmpty(form.name,"이름을 입력해 주십시오."))	return;
            if (isFrmEmpty(form.phone, "연락처를 입력해 주십시오.")) return;
            /*
            	if(isFrmEmpty(form.zipcode,"우편번호를 입력해 주십시오."))	return;
            	if(isFrmEmpty(form.addr01,"기본주소를 입력해 주십시오."))	return;
            	if(isFrmEmpty(form.addr02,"상세주소를 입력해 주십시오."))	return;
            	if(isFrmEmpty(form.email,"이메일을 입력해 주십시오."))	return;

            	email = $('#email').val();
            	okEmail = isEmailChk(email);
            	if(!okEmail){
            		GblMsgBox('이메일을 정확히 기재해 주시기 바랍니다.');
            		$('#email').focus();
            		return;
            	}

            	if(isFrmEmpty(form.bDate,"생년월일을 입력해 주십시오."))	return;
            */

            form.target = 'ifra_gbl';
            form.action = 'proc.php';
            form.submit();
        }

        function userDel() {
            if (confirm('해당 데이터를 삭제하시겠습니까?')) {
                form = document.frm01;
                form.type.value = 'del';
                form.target = 'ifra_gbl';
                form.action = 'proc.php';
                form.submit();
            }
        }
    </script> -->

    <? include _ADM . '/footer.php'; ?>
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

</div>