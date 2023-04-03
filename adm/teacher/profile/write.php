<?php
$query = "SELECT * FROM ks_member WHERE userid='$GBL_USERID' AND (mtype='T' OR mtype='A')";

$row = sqlRow($query);

if ($row) {
    foreach ($row as $k => $v) {
        ${$k} = $v;
    }
} else {
    $MSG->goMsg('강사 권한이 없습니다.', "/adm/main.php");
    exit;
}
?>

<style>
    .input-50 {
        width: 50%;
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
        .input-50 {
            width: 50% !important;
        }

        .input-30 {
            width: 30% !important;
        }
    }
</style>

<form name='frm01' class="user wid100" method='post' action='./proc.php' ENCTYPE="multipart/form-data">
    <input type='text' style='display:none;'>
    <input type='hidden' name='uid' value='<?= $GBL_UID ?>'>
    <input type='hidden' name='next_url' value='<?= $_SERVER['PHP_SELF'] ?>'>
    <input type='hidden' name='type' id='type' value='<?= $type ?>'>

    <div class="tbl-st">
        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>이메일　　</div>
            <div class="cols_90 cols_">
                <div class="form-group"><?= $userid ?></div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>이름　　　</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control input-50" value="<?= $name ?>" maxlength='15'>
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>직위　　　</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <input type="text" name="job" id="job" class="form-control input-50" value="<?= $job ?>" maxlength='15'>
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>프로필사진&nbsp;</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <?
                    if ($upfile01) {
                        $imgFile = $path . 'thumb_' . $upfile01;
                        if (!is_file($imgFile))    $imgFile = $path . $upfile01;
                        $imgFile = "/upfile/member/" . $upfile01;
                    ?>
                        <a href="/upfile/member/<?= $upfile01 ?>" target="_blank"><img src='<?= $imgFile ?>' alt="프로필사진" width="100"></a>
                    <?
                    }
                    ?>
                    <!-- <div class="file_input">
                        <input type="text" class="form-control" title="File Route" id="file_route01" readonly>
                        <label>찾아보기<input type="file" name="upfile01" onchange="javascript:document.getElementById('file_route01').value=this.value"></label><br>
                    </div> -->
                    <input type="file" name="upfile01" class="form-control input-50" onchange="fileChk(this)">
                    <!-- (가로:800px * 세로:450px) -->
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>약력　　　</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <textarea type="textarea" name="ment01" id="ment01" rows="10" class="form-control input-50"><?= trim($ment01) ?></textarea>
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>대표강좌　</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <select name="class_uid" id="class_uid" class="form-control input-50">
                        <option value="">없음</option>
                        <?
                        $query = "SELECT uid, title FROM ks_class WHERE tuid='$GBL_UID'";
                        $arr_classes = sqlArray($query);
                        foreach ($arr_classes as $class) {
                        ?>
                            <option value="<?= $class['uid'] ?>" <? if ($class['uid'] == $class_uid) echo "selected"; ?>><?= $class['title'] ?></option>
                        <?
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div style='width:100%;margin:40px 0;text-align:center;'>
        <a href="javascript:void(0)" onclick="reg_write();" class="btn btn-info btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">저장하기</span>
        </a>
    </div>
    <iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>
</form>