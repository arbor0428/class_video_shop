<?
include "/home/edufim/www/adm/header.php";
$sideArr[1] = 'active';
$showArr[1] = 'show';
$subArr['all'] = 'active';
include _ADM . '/sidemenu.php';

$query = "SELECT * FROM ks_exam WHERE etype='CLASS' AND class_uid='$uid' ORDER BY qnum";
$result = mysql_query($query) or die(mysql_error());
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
                    <div class="card shadow mb-4" style='margin-top:10px;'>
                        <div class="card-body">
                            <form name='frm01' method='post' action='./proc.php' ENCTYPE="multipart/form-data">
                                <input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
                                <input type='hidden' name='type' value=''>
                                <input type='hidden' name='uid' value='<?= $uid ?>'>
                                <input type='hidden' name='last_q' value=''>
                                <input type='hidden' name='next_url' value='<?= $PHP_SELF ?>'>

                                <div class="m-0 font-weight-bold text-primary mb-4">수료시험</div>
                                <div class="tbl-st">
                                    <div class="cols">
                                        <div class="cols_5 cols_ th">번호</div>
                                        <div class="cols_90 cols_ th">문제</div>
                                    </div>
                                    <?
                                    $i = 0;
                                    while ($row = mysql_fetch_assoc($result)) {
                                        foreach ($row as $k => $v) {
                                            ${$k} = $v;
                                        }
                                    ?>
                                        <div class="mb-4">
                                            <div class="cols">
                                                <input type="hidden" name="qnum[]" value="<?= $qnum ?>">
                                                <div class="cols_5 cols_ th"><?= $qnum ?>&nbsp;번</div>
                                                <div class="cols_90 cols_">
                                                    <input type="text" name="qtitle[]" id="qtitle" class="form-control" value="<?= $qtitle ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="cols">
                                                <div class="cols_5 cols_ th">사진</div>
                                                <div class="cols_90 cols_">
                                                    <?
                                                    if ($upfile01) {
                                                        $imgFile = $path . 'thumb_' . $upfile01;
                                                        if (!is_file($imgFile))    $imgFile = $path . $upfile01;
                                                        $imgFile = "/upfile/exam/" . $upfile01;
                                                    ?>
                                                        <img src='<?= $imgFile ?>' width="500">
                                                        <span>
                                                            <input type="checkbox" class="form-control" data-index="<?= $qnum ?>" onchange="setDelChk(this)" style="display:inline-block;">
                                                            <span class='ico09'>삭제</span>
                                                            <span><?= $realfile01 ?></span>
                                                        </span>
                                                        <?
                                                    }
                                                    ?>
                                                    <input type="hidden" name="del_file[]" id="del_file_<?= $qnum ?>" value="N">
                                                    <input type="hidden" name="upfile01[]" value="<?= $upfile01 ?>">
                                                    <input type="hidden" name="realfile[]" value="<?= $realfile01 ?>">
                                                    <input type="file" name="file01[]" class="form-control" onchange="fileChk(this)">
                                                    <!-- (가로:800px * 세로:450px) -->
                                                </div>
                                                <div class="cols_5 cols_ th">정답</div>
                                            </div>
                                            <div class="cols">
                                                <div class="cols_5 cols_ th">보기</div>
                                                <div class="cols_90 cols_">
                                                    <div>
                                                        <span>1. </span>
                                                        <input type="text" name="q1[]" id="q1" class="form-control" value="<?= $q1 ?>" autocomplete="off" style="display:inline-block; width:90%;margin:0 5px;">
                                                        <input type="radio" name="a1[<?= $i ?>]" value="1" <? if ($a1 == 1) echo 'checked'; ?>>
                                                    </div>
                                                    <div>
                                                        <span>2. </span>
                                                        <input type="text" name="q2[]" id="q2" class="form-control" value="<?= $q2 ?>" autocomplete="off" style="display:inline-block; width:90%;margin:0 5px;">
                                                        <input type="radio" name="a1[<?= $i ?>]" value="2" <? if ($a1 == 2) echo 'checked'; ?>>
                                                    </div>
                                                    <div>
                                                        <span>3. </span>
                                                        <input type="text" name="q3[]" id="q3" class="form-control" value="<?= $q3 ?>" autocomplete="off" style="display:inline-block; width:90%;margin:0 5px;">
                                                        <input type="radio" name="a1[<?= $i ?>]" value="3" <? if ($a1 == 3) echo 'checked'; ?>>
                                                    </div>
                                                    <div>
                                                        <span>4. </span>
                                                        <input type="text" name="q4[]" id="q4" class="form-control" value="<?= $q4 ?>" autocomplete="off" style="display:inline-block; width:90%;margin:0 5px;">
                                                        <input type="radio" name="a1[<?= $i ?>]" value="4" <? if ($a1 == 4) echo 'checked'; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?
                                        $i++;
                                    }
                                    echo "<script>const last_q = $i</script>";
                                    ?>
                                </div>

                                <div style='width:100%;margin:40px 0;text-align:right;'>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-icon-split" onclick="remove_list();">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">제거</span>
                                    </a>
                                    <a heft="javascript:void(0)" class="btn btn-sm btn-success btn-icon-split ml-1" onclick="add_list();">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">추가</span>
                                    </a>
                                </div>

                                <div style='width:100%;margin:40px 0;text-align:center;'>
                                    <a href="javascript:void(0)" class="btn btn-secondary btn-icon-split" onclick="reg_list();">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-list"></i>
                                        </span>
                                        <span class="text">목록</span>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-info btn-icon-split ml-3" onclick="reg_write()">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">저장</span>
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </div>

    <script>
        const form = document.frm01;
        form.last_q.value = last_q;

        const add_list = function() {
            if (last_q >= 10) {
                alert('10문제를 초과하였습니다')
                return
            } else {
                form.type.value = 'ADD';
                form.submit();
            }
        }
        const remove_list = function() {
            form.type.value = 'REMOVE';
            form.submit();
        }

        const reg_list = function() {
            form.action = '/adm/class/all/';
            form.type.value = 'list';
            form.submit();
        }

        const reg_write = function() {
            form.type.value = 'SAVE';
            form.submit();
        }

        const fileChk = function(file) {
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
        
        const setDelChk = function(e) {
            document.getElementById('del_file_' + e.dataset.index).value = (e.checked)? 'Y' : 'N'
        }
    </script>

    <!-- End of Main Content -->
    <? include _ADM . '/footer.php'; ?>
</div>
<!-- End of Content Wrapper -->