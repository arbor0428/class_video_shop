<?
include "/home/edufim/www/adm/header.php";
$sideArr[1] = 'active';
$showArr[1] = 'show';
$subArr['all'] = 'active';
include _ADM . '/sidemenu.php';

$query = "SELECT c.*, v.filename, v.snapshot_url
FROM ks_class_list c 
LEFT JOIN kollus_video v ON c.kollus_video_id=v.id
WHERE c.class_uid='$uid'";

$result = mysql_query($query) or die(mysql_error());
$num_rows = mysql_num_rows($result);

$last_sort = ($num_rows > 0) ? $num_rows + 1 : 1;


$query_preview = "SELECT c.*, v.filename, v.snapshot_url
FROM ks_class_list_preview c 
LEFT JOIN kollus_video v ON c.kollus_video_id=v.id
WHERE c.class_uid='$uid'";
$result_preview = mysql_query($query_preview) or die(mysql_error());
$num_rows_preview = mysql_num_rows($result_preview);

$last_sort_preview = ($num_rows_preview > 0) ? $num_rows_preview + 1 : 1;
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
                    <div class="card shadow mb-4" style='margin-top:10px;'>
                        <div class="card-body">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-check"></i> 영상 편집</h6>
                            <form name='frm01' action="./proc.php" method='post'>
                                <input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
                                <input type='hidden' name='next_url' value='<?= $_SERVER['PHP_SELF'] ?>'>
                                <input type='hidden' name='type' value='<?= $type ?>'>
                                <input type='hidden' name='uid' value='<?= $uid ?>'>
                                <input type='hidden' name='last_sort' value='<?= $last_sort ?>'>
                                <input type='hidden' name='last_sort_preview' value='<?= $last_sort_preview ?>'>
                                <input type='hidden' name='f_cat' value=''>

                                <!-- class_list -->
                                <div class="@tbl-st-w01 @tbl-st-w @tbl-st">
                                    <!-- <div class="font-weight-bold text-primary mb-2">강좌목록</div> -->
                                    <div class="flex-between">
                                        <div class="text-right mb-2">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-icon-split ml-1" onclick="remove_list();">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">삭제</span>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success btn-icon-split ml-1" onclick="add_list();">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">추가</span>
                                            </a>
                                        </div>
                                    </div>
                                    <table width="100%" cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
                                        <tr>
                                            <th width='10'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
                                            <th width='100'>미리보기</th>
                                            <th width='100'>비디오</th>
                                            <th width='10'>순서</th>
                                            <th width='1000'>제목</th>
                                            <th width='1000'>설명</th>
                                            <th width='10'>편집</th>
                                        </tr>

                                        <?
                                        while ($row = mysql_fetch_assoc($result)) {
                                            foreach ($row as $k => $v) {
                                                ${$k} = $v;
                                            }
                                            if ($status == '0')     $status = "<span class='ico09'>비활성</span>";
                                            elseif ($status == '1') $status = "<span class='ico03'>활성</span>";
                                        ?>
                                            <tr class='grayLine'>
                                                <td>
                                                    <input type="checkbox" name="chk[]" value="<?= $row['sort'] ?>">
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="status_<?= $uid ?>" value='<?= $row['uid'] ?>' class="switch-input" style="position:fixed" <? if ($row['is_preview'] == 1) echo 'checked'; ?>>
                                                        <span class="switch-label" data-on="무료" data-off="유료"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="kollus_video_id[]" id="kollus_video_id_<?= $row['sort'] ?>" value="<?= $row['kollus_video_id'] ?>" data-sort="<?= $row['sort'] ?>" data-value="class_list" onchange="getVideoInfo(this)">
                                                    <a href="javascript:void(0)" onclick="formModal('kollus_video_id_<?= $row['sort'] ?>');">
                                                        <img id="snapshot_<?= $row['sort'] ?>" src="<?= $row['snapshot_url'] ?>" alt="<?= $row['title'] ?>" width="100">
                                                        <span class="icon">검색 <i class="fas fa-search"></i></span>
                                                    </a>
                                                </td>
                                                <td><?= $row['sort'] ?></td>
                                                <td><input type='text' name='title[]' id="title_<?= $row['sort'] ?>" class="form-control" style='width:100%' value='<?= $row['title'] ?>'></td>
                                                <td><input type='text' name='exp[]' class="form-control" style='width:100%' value='<?= $row['exp'] ?>'></td>
                                                <td></td>
                                            </tr>
                                        <? } ?>
                                    </table>
                                </div>
                                <div style='width:100%;margin:40px 0 10px 0;text-align:center;'>
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
        let last_sort = ('<?= $last_sort ?>' != '')? parseInt('<?= $last_sort ?>') : 1;
        let last_sort_preview = ('<?= $last_sort_preview ?>' != '')? parseInt('<?= $last_sort_preview ?>') : 1;

        const form = document.frm01;

        const add_list = function() {
            if (last_sort > 120) {
                GblMsgBox('최대 등록 강좌수를 초과 했습니다.');
                return;
            } else {
                form.type.value = 'ADD';
                form.submit();
            }
        }

        const remove_list = function() {
            form.type.value = 'REMOVE';
            form.submit();
        }

        const add_list_preview = function() {
            if (last_sort_preview > 10) {
                GblMsgBox('최대 등록 강좌수를 초과 했습니다.');
                return;
            } else {
                form.type.value = 'ADD_preview';
                form.submit();
            }
        }

        const remove_list_preview = function() {
            form.type.value = 'REMOVE_preview';
            form.submit();
        }

        const reg_list = function() {
            form.action = '/adm/prod/all/';
            form.type.value = 'list';
            form.submit();
        }

        const reg_write = function() {
            form.type.value = 'WRITE';
            form.submit();
        }

        function getVideoInfo(e) {
            const video_id = e.value
            const sort = e.dataset.sort
            const value = e.dataset.value

            $.ajax({
                url: './proc.php',
                data: {
                    'type': 'VIDEO',
                    'video_id': video_id
                },
                success: function(response) {
                    response = response.trim()
                    const data = JSON.parse(response)
                    if (value == 'class_list') {
                        $('#title_' + sort).val(data.title)
                        $('#snapshot_' + sort).attr('src', data.snapshot_url)
                        $('#snapshot_' + sort).attr('alt', data.title)

                    } else if (value == 'class_list_preview') {
                        $('#title_preview_' + sort).val(data.title)
                        $('#snapshot_preview_' + sort).attr('src', data.snapshot_url)
                        $('#snapshot_preview_' + sort).attr('alt', data.title)
                    } else {
                        console.log('not found value');
                    }

                },
                error: function(request, status, error) {
                    console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            })
        }

        const formModal = function(value1) {
            const f_cat = document.frm01.f_cat.value
            
            $("#multiBox").css({
                "width": "90%",
                "max-width": "1200px"
            });
            $('#multi_ttl').text('업로드리스트');
            $('#multiFrame').html("<iframe src='/adm/prod/kollus_video/index.php?value1=" + value1 + "&f_cat=" + f_cat + "' name='kollusFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
            $('.multiBox_open').click();
        }

        $(function() {
            $('.switch-input').change(function() {
                if ($(this).is(":checked")) status = '1';
                else status = '0';
                type = 'preview';
                uid = $(this).val();

                $.post('./proc.php', {
                    'type': type,
                    'uid': uid,
                    'status': status,
                }, function(res) {
                    console.log(res);
                });
            });
        })
    </script>

    <!-- End of Main Content -->
    <? include _ADM . '/footer.php'; ?>
</div>
<!-- End of Content Wrapper -->