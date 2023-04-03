<?
include "/home/edufim/www/adm/header.php";
$sideArr[5] = 'active';
$showArr[5] = 'show';
$subArr['event'] = 'active';
define('_TITLE', '메인 이벤트 배너');
$main_type = 'EVENT';

include _ADM . '/sidemenu.php';
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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                </div>
                <div class="card-body">
                    <form name='frm01' action="./proc.php" method='post' ENCTYPE="multipart/form-data">
                        <input type="hidden" name="type" value="">
                        <input type="hidden" name="next_url" value="<?= $PHP_SELF ?>">
                        <input type="hidden" name="tot_num" value="">

                        <div style='width:1000px;'>
                            <div class='mCadeTit02' style='margin-bottom:3px;'>
                                <?= _TITLE ?> 이미지 사이즈<br>
                                ※ PC : <b style='color:red'>1920px * 200px</b><br>
                                ※ Tablet, Mobile : <b style='color:red'>450px * 450px</b><br>
                                ※ 2개이상의 이미지를 넣어야 슬라이드 모션이 실행됩니다.<br>
                                <!-- ※ 노출기간을 입력하지 않으면 상시 표시됩니다. -->
                            </div>

                            <table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
                                <?php
                                $query = "SELECT * FROM config_main WHERE type='$main_type' ORDER BY sort";
                                $row_arr = sqlArray($query);

                                for ($i = 0; $i < count($row_arr); $i++) {
                                    $row = $row_arr[$i];
                                    $index = $i + 1;

                                    $sort = $row['sort'];
                                    $upfile = $row['upfile'];
                                    $realfile = $row['realfile'];
                                    $upfile_m = $row['upfile_m'];
                                    $realfile_m = $row['realfile_m'];
                                    $url = $row['url'];
                                    $target = $row['target'];
                                ?>

                                    <tr>
                                        <!-- <th width='15%' rowspan='4'>이미지 #<?= $index ?></th> -->
                                        <th width='15%' rowspan='3'>이미지 # <?= $index ?></th>
                                        <th>PC</th>
                                        <td>
                                            <table cellpadding='0' cellspacing='0' border='0'>
                                                <?
                                                if ($upfile) {
                                                ?>
                                                    <tr>
                                                        <td colspan='2' style="padding-bottom:5px;">
                                                            <a href="/upfile/main/<?= $upfile ?>" target="_blank">
                                                                <img src='/upfile/main/<?= $upfile ?>' width='200'>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="sort[]" class="form-control" value="<?= $index ?>">
                                                        <input type="hidden" name="upfile[]" class="form-control" value="<?= $upfile ?>">
                                                        <input type="file" name="file[]" class="form-control" onchange="fileChk(this)" data-index="<?= $index ?>" style="font-size:0.8rem; height:29px; padding: 1px 0.5rem">
                                                        <!-- <div class="file_input">
                                                            <input type="text" readonly title="File Route" id="file_route<?= $no ?>" style="width:250px;padding:0 0 0 10px;" placeholder="PC 화면에서 보여지는 이미지 입니다.">
                                                            <label>파일선택<input type="file" name="upfile<?= $no ?>" id="upfile<?= $no ?>" onchange="fileChk('<?= $no ?>');"></label>
                                                        </div> -->
                                                    </td>
                                                    <?
                                                    if ($upfile) {
                                                    ?>
                                                        <td style='padding:0 0 0 10px;'>
                                                            <input type="hidden" name="del_file[]" id="del_file_<?= $index ?>" value="N">
                                                            <input type="checkbox" class="form-control" style="display:inline-block;" data-index="<?= $index ?>" onchange="setDelChk(this)">
                                                            <span class='ico09'>삭제</span>
                                                            <!-- &nbsp;&nbsp;(<?= $realfile ?>) -->
                                                            <input type="text" name="realfile[]" value="<?= $realfile ?>" style="background-color:#fff;" readonly>
                                                        </td>
                                                    <?
                                                    }
                                                    ?>
                                                </tr>
                                            </table>
                                        </td>
                                        <!-- <td width='10%' rowspan='2'></td> -->
                                    </tr>

                                    <tr>
                                        <th>Tablet, Mobile</th>
                                        <td>
                                            <table cellpadding='0' cellspacing='0' border='0'>
                                                <?
                                                if ($upfile_m) {
                                                ?>
                                                    <tr>
                                                        <td colspan='2' style="padding-bottom:5px;">
                                                            <a href="/upfile/main/<?= $upfile_m ?>" target="_blank">
                                                                <img src='/upfile/main/<?= $upfile_m ?>' width='200'>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="upfile_m[]" class="form-control" value="<?= $upfile_m ?>">
                                                        <input type="file" name="file_m[]" class="form-control" onchange="fileChk(this)" data-index="<?= $index ?>" style="font-size:0.8rem; height:29px; padding: 1px 0.5rem">
                                                    </td>
                                                    <?
                                                    if ($upfile_m) {
                                                    ?>
                                                        <td style='padding:0 0 0 10px;'>
                                                            <input type="hidden" name="del_file_m[]" id="del_file_m_<?= $index ?>" value="N">
                                                            <input type="checkbox" class="form-control" style="display:inline-block;" data-index="<?= $index ?>" onchange="setDelChk_m(this)">
                                                            <span class='ico09'>삭제</span>
                                                            <input type="text" name="realfile_m[]" value="<?= $realfile_m ?>" style="background-color:#fff;" readonly>
                                                        </td>
                                                    <?
                                                    }
                                                    ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width='15%'>링크 <?= $url ?> (PC)</th>
                                        <td width='60%'>
                                            <select name='target[]'>
                                                <option value='_self' <? if ($target == '_self') echo 'selected'; ?>>현재창</option>
                                                <option value='_blank' <? if ($target == '_blank') echo 'selected'; ?>>새창</option>
                                            </select>
                                            <input name="url[]" class="form-control" style="display:inline-block; width:80%;" type="text" value="<?= $url ?>">
                                        </td>
                                    </tr>

                                    <!-- <tr>
                                        <th width='15%'>링크 <?= $ino ?> (MOBILE)</th>
                                        <td width='60%'>
                                            <select name='target<?= $ino ?>'>
                                                <option value='_self' <? if ($target == '_self') 
                                                                            echo 'selected';
                                                                         ?>>현재창</option>
                                                <option value='_blank' <? if ($target == '_blank') 
                                                                            echo 'selected';
                                                                         ?>>새창</option>
                                            </select>
                                            <input name="M_link<?= $ino ?>" id="M_link<?= $ino ?>" style="width:80%" type="text" value="<?= $M_link ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>MOBILE</th>
                                        <td>
                                            <table cellpadding='0' cellspacing='0' border='0'>
                                                <?
                                                if ($upfile) {
                                                ?>
                                                    <tr>
                                                        <td colspan='2'><img src='/upfile/main/<?= $upfile ?>' style='max-width:250px'></td>
                                                    </tr>
                                                <?
                                                }
                                                ?>
                                                <tr>
                                                    <td width='360'>
                                                        <div class="file_input">
                                                            <input type="text" readonly title="File Route" id="file_route<?= $no ?>" style="width:250px;padding:0 0 0 10px;" placeholder="모바일 화면에서 보여지는 이미지 입니다.">
                                                            <label>파일선택<input type="file" name="upfile<?= $no ?>" id="upfile<?= $no ?>" onchange="fileChk('<?= $no ?>');"></label>
                                                        </div>
                                                    </td>
                                                    <?
                                                    if ($upfile) {
                                                    ?>
                                                        <td style='padding:0 0 0 10px;'>
                                                            <div class="squaredThree">
                                                                <input type="checkbox" value="Y" id="fDel<?= $no ?>" name="del_upfile<?= $no ?>">
                                                                <label for="fDel<?= $no ?>"></label>
                                                            </div>
                                                            <p style='margin:3px 0 0 25px;font-size:12px;'><span class='ico09'>삭제</span>&nbsp;&nbsp;(<?= $realfile ?>)</p>
                                                        </td>
                                                    <?
                                                    }
                                                    ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr> -->

                                <? } ?>
                            </table>

                            <div style='width:100%;margin:40px 0;text-align:center;'>
                                <a href="javascript:void(0);" onclick="reg_write();" class="btn btn-info btn-icon-split" style="margin-left:20px;">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">저장하기</span>
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </div>
    <!-- End of Main Content -->

    <script>
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

        const setDelChk = function(e) {
            document.getElementById('del_file_' + e.dataset.index).value = (e.checked) ? 'Y' : 'N'
        }

        const setDelChk_m = function(e) {
            document.getElementById('del_file_m_' + e.dataset.index).value = (e.checked)? 'Y' : 'N'
        }

        function go_sort(num, dir) {
            form = document.frm01;
            form.type.value = 'sort';
            form.submit();
        }

        function reg_write() {
            const form = document.frm01;
            form.type.value = 'write';
            form.submit();
        }
    </script>

    <? include _ADM . '/footer.php'; ?>
</div>
<!-- End of Content Wrapper -->