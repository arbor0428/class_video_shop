<?
if ($type == 'edit' && $uid) { //수정할때
    $result = mysql_query("SELECT * FROM ks_event WHERE uid='$uid'");
    $row = mysql_fetch_assoc($result);
    if ($row) {
        foreach ($row as $k => $v) {
            ${$k} = $v;
        }
    } else {
        $MSG->backMsg('접근오류');
        exit;
    }
    if ($ment01)    $ment01 = Util::textareaDecodeing($ment01);
    if ($ment02)    $ment02 = Util::textareaDecodeing($ment02);
}
?>
<style>
    .tilde {
        margin: 0 5px;
    }

    .input-30 {
        width: 30%;
    }

    .form-group {
        margin-bottom: 0 !important;
    }

    .text-white-50 {
        padding-top: 10px !important;
    }

    @media (max-width: 768px) {
        .input-30 {
            width: 30% !important;
        }
    }
</style>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
    <input type='text' style='display:none;'>
    <input type='hidden' name='uid' value='<?= $uid ?>'>
    <input type='hidden' name='type' id='type' value='<?= $type ?>'>
    <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">

    <input type='hidden' name='f_status' value="<?= $f_status ?>">
    <input type='hidden' name='f_userid' value="<?= $f_userid ?>">
    <input type='hidden' name='f_name' value="<?= $f_name ?>">
    <input type='hidden' name='f_sort' value="<?= $f_sort ?>">

    <div class="tbl-st">
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>이벤트 명</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control" value="<?= $title ?>">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>설명</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="exp" id="exp" class="form-control" value="<?= $exp ?>">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>이벤트 대상</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="target" id="target" class="form-control" value="<?= $target ?>">
                    <!-- <input type="radio" name="target" id="target_0" value="0">
                    <label for="target_0">없음</label> -->
                    <!-- <input type="radio" name="target" id="target_1" value="수강생 전원" <? if ($target == '수강생 전원') echo 'checked'; ?>>
                    <label for="target_1">수강생 전원</label> -->
                    <!-- <input type="radio" name="eventarget" id="target" value="신규회원">
                    <input type="radio" name="eventarget" id="target" value="신규회원"> -->
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>썸네일</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <?
                    if ($upfile01) {
                        $imgFile = $path . 'thumb_' . $upfile01;
                        if (!is_file($imgFile))    $imgFile = $path . $upfile01;
                        $imgFile = "/upfile/event/" . $upfile01;
                    ?>
                        <img src='<?= $imgFile ?>' width="200">
                        <input type="hidden" name="del_upfile01" id="del_upfile01" value="N">
                        <input type="hidden" name="dbfile01" id="dbfile01" value="<?= $upfile01 ?>">
                        <input type="checkbox" class="form-control" style="display:inline-block;" data-index="del_upfile01" onchange="setDelChk(this)">
                        <span class='ico09'>삭제</span>
                        <a href="/upfile/class/<?= $upfile01 ?>" download="<?= $realfile01 ?>"><input type="text" name="realfile01" id="realfile01" class="bold" value="<?= $realfile01 ?>" style="cursor:pointer;" readonly></a>
                    <?
                    }
                    ?>
                    <input type="file" name='upfile01' id='upfile01' class="form-control" style="width:49%;" onchange="fileChk(this)">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>이벤트 기간</div>
            <div class="cols_80 cols_">
                <div class="form-group datapicker-wrap">
                    <input type="text" name="sDate" id="sDate" class="form-control fpicker" value="<?= $sDate ?>" placeholder='시작 날짜'>
                    <span class="tilde">~</span>
                    <input type="text" name="eDate" id="eDate" class="form-control fpicker" value="<?= $eDate ?>" placeholder='종료 날짜'>
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th">쿠폰</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <select name="coupon_uid" id="coupon_uid" class="form-control input-30" value="<?= $coupon_uid ?>">
                        <option value="NULL">쿠폰 없음</option>
                        <?
                        $arr_rows = sqlArray("SELECT * FROM ks_coupon WHERE status=1 ORDER BY uid");
                        foreach ($arr_rows as $k => $row) {
                            if ($coupon_uid == $row['uid']) $chk = 'selected';
                            else $chk = '';
                        ?>
                            <option value="<?= $row['uid'] ?>" <?= $chk ?>><?= $row['title'] ?></option>
                        <?
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="cols">
            <div class="cols_20 cols_ th">영상</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <select name="kollus_video_id">
                        <option value="">없음</option>
                        <?
                        $query = "SELECT id, filename FROM kollus_video ORDER BY filename";
                        $videos = sqlArray($query);
                        foreach ($videos as $key => $video) {
                            if ($kollus_video_id == $video['id']) $chk = 'selected';
                            else $chk = '';
                        ?>
                        <option value="<?= $video['id'] ?>" <?= $chk ?>><?= $video['filename'] ?></option>
                        <?
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="cols">
            <div class="cols_20 cols_ th">업로드 # 1</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="file" name='upfile02' id='upfile02' class="form-control" style="width:49%;" onchange="fileChk(this)">
                    <?
                    if ($upfile02) {
                    ?>
                        <input type="hidden" name="del_upfile02" id="del_upfile02" value="N">
                        <input type="hidden" name="dbfile02" id="dbfile02" value="<?= $upfile02 ?>">
                        <input type="checkbox" class="form-control" style="display:inline-block;" data-index="del_upfile02" onchange="setDelChk(this)">
                        <span class='ico09'>삭제</span>
                        <a href="/upfile/class/<?= $upfile02 ?>" download="<?= $realfile02 ?>"><input type="text" name="realfile02" id="realfile02" class="bold" value="<?= $realfile02 ?>" style="cursor:pointer;" readonly></a>
                    <?
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th">업로드 # 2</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="file" name='upfile03' id='upfile03' class="form-control" style="width:49%;" onchange="fileChk(this)">
                    <?
                    if ($upfile03) {
                    ?>
                        <input type="hidden" name="del_upfile03" id="del_upfile03" value="N">
                        <input type="hidden" name="dbfile03" id="dbfile03" value="<?= $upfile03 ?>">
                        <input type="checkbox" class="form-control" style="display:inline-block;" data-index="del_upfile03" onchange="setDelChk(this)">
                        <span class='ico09'>삭제</span>
                        <a href="/upfile/class/<?= $upfile03 ?>" download="<?= $realfile03 ?>"><input type="text" name="realfile03" id="realfile03" class="bold" value="<?= $realfile03 ?>" style="cursor:pointer;" readonly></a>
                    <?
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th">업로드 # 3</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="file" name='upfile04' id='upfile04' class="form-control" style="width:49%;" onchange="fileChk(this)">
                    <?
                    if ($upfile04) {
                    ?>
                        <input type="hidden" name="del_upfile04" id="del_upfile04" value="N">
                        <input type="hidden" name="dbfile04" id="dbfile04" value="<?= $upfile04 ?>">
                        <input type="checkbox" class="form-control" style="display:inline-block;" data-index="del_upfile04" onchange="setDelChk(this)">
                        <span class='ico09'>삭제</span>
                        <a href="/upfile/class/<?= $upfile04 ?>" download="<?= $realfile04 ?>"><input type="text" name="realfile04" id="realfile04" class="bold" value="<?= $realfile04 ?>" style="cursor:pointer;" readonly></a>
                    <?
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>내용</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <textarea name='ment01' id='ment01' style='width:100%;height:540px;border:1px solid #ccc;resize:none;'><?= $ment01 ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div style='width:100%;margin:40px 0;text-align:center;'>
        <a href="javascript:void(0);" onclick="reg_list();" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-list"></i>
            </span>
            <span class="text">목록으로</span>
        </a>
        <a href="javascript:void(0);" onclick="form_confirm();" class="btn btn-info btn-icon-split" style="margin-left:20px;">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <? if ($type == 'write') { ?>
                <span class="text">등록하기</span>
            <? } else { ?>
                <span class="text">수정하기</span>
            <? } ?>
        </a>
        <?
        if ($type == 'edit') {
        ?>
            <a href="javascript:void(0);" onclick="reg_del_confirm('<?= $uid ?>');" class="btn btn-danger btn-icon-split" style="margin-left:20px;">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">삭제하기</span>
            </a>
        <? } ?>
    </div>

</form>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<script type="text/javascript">
    /** Smart Editor */
    var oEditors = [];

    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "ment01",
        sSkinURI: "/smarteditor/SmartEditor2Skin.html",

        /* 페이지 벗어나는 경고창 없애기 */
        htParams: {
            bUseToolbar: true,
            bUseVerticalResizer: false,
            fOnBeforeUnload: function() {},
            fOnAppLoad: function() {}
        },
        fCreator: "createSEditor01"
    });
    /** End of Smart Editor */

    function goList() {
        history.back();
    }

    function form_confirm() {
        const form = document.frm01;

        if (isFrmEmpty(form.title, "필수 항목을 입력하세요.")) return;
        if (isFrmEmpty(form.exp, "필수 항목을 입력하세요.")) return;
        if (isFrmEmpty(form.target, "필수 항목을 입력하세요.")) return;
        if (isFrmEmpty(form.sDate, "필수 항목을 입력하세요.")) return;
        if (isFrmEmpty(form.eDate, "필수 항목을 입력하세요.")) return;

        let isValidDate = (new Date(form.sDate.value)) <= (new Date(form.eDate.value))
        if (!isValidDate) {
            alert('올바른 기간을 입력하세요.')
            form.eDate.focus
            return
        }
        oEditors.getById["ment01"].exec("UPDATE_CONTENTS_FIELD", []);

        form.action = 'proc.php';
        form.submit();
    }

    function userDel() {
        if (confirm('해당 데이터를 삭제하시겠습니까?')) {
            form = document.frm01;

            form.type.value = 'del';
            //	form.target = 'ifra_gbl';
            form.action = 'proc.php';
            form.submit();
        }
    }

    function formModal(u) {
        $("#multiBox").css({
            "width": "90%",
            "max-width": "800px"
        });
        $('#multi_ttl').text('강의리스트');
        $('#multiFrame').html("<iframe src='class_index.php' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
        $('.multiBox_open').click();
    }

    function func() {
        valz = $('#class_uid').val()
        console.log(valz);
    }

    const fileChk = function(file) {
        let obj = file.files[0];

        const fileTypes = ['application/pdf', 'image/gif', 'image/jpeg', 'image/png', 'image/bmp', 'image/tif', 'application/haansofthwp', 'application/x-hwp'];
        if (obj.name.length > 100) {
            alert("파일명이 100자 이상입니다.");
            file.value = '';
            return false;
        } else if (obj.size > (100 * 1024 * 1024)) {
            alert("최대 파일 용량인 100MB를 초과하였습니다.");
            file.value = '';
            return false;
        } else if (obj.name.lastIndexOf('.') == -1) {
            alert("확장자가 없는 파일입니다.");
            file.value = '';
            return false;
        } else if (!fileTypes.includes(obj.type)) {
            alert("첨부가 불가능한 파일입니다.");
            file.value = '';
            return false;
        } else {
            return true;
        }
    }
    
    const setDelChk = function(e) {
        document.getElementById(e.dataset.index).value = (e.checked) ? 'Y' : 'N'
    }
</script>