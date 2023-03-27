<?
if ($type == 'edit' && $uid) { //수정할때
    $row = sqlRow("SELECT * FROM ks_license WHERE uid='$uid'");

    if ($row) {
        foreach ($row as $k => $v) {
            ${$k} = $v;
        }
    } else {
        Msg::backMsg('접근오류');
        exit;
    }
    //비고
    if ($ment01)    $ment01 = Util::textareaDecodeing($ment01);
    if ($ment02)    $ment02 = Util::textareaDecodeing($ment02);
}

$cade01_arr = sqlArray("SELECT * FROM ks_license_cade01 ORDER BY sort");
?>

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
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>1차 분류</div>
            <div class="cols_40 cols_">
                <div class="form-group">
                    <select type="text" name="cade01" id="cade01" class="form-control" value="" onchange="getCade(this);">
                        <option value="">선택</option>
                        <? foreach ($cade01_arr as $cade) { ?>
                            <option value="<?= $cade['uid'] ?>" <? if ($cade['uid'] == $cade01) echo "selected"; ?>><?= $cade['title'] ?></option>
                        <? } ?>
                    </select>
                </div>
            </div>
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>2차 분류</div>
            <div class="cols_40 cols_">
                <div class="form-group">
                    <select type="text" name="cade02" id="cade02" class="form-control" value="">
                        <?
                        if ($type == 'edit') {
                            $cade02_arr = sqlArray("SELECT * FROM ks_license_cade02 WHERE cade01=$cade01 ORDER BY sort");
                            foreach ($cade02_arr as $cade) {
                        ?>
                                <option value="<?= $cade['uid'] ?>" <? if ($cade['uid'] == $cade02) echo "selected"; ?>><?= $cade['title'] ?></option>
                            <? } ?>
                        <? } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>과정명</div>
            <div class="cols_40 cols_">
                <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control" value="<?= $title ?>">
                </div>
            </div>
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>영문명</div>
            <div class="cols_40 cols_">
                <div class="form-group">
                    <input type="text" name="eng_title" id="eng_title" class="form-control" value="<?= $eng_title ?>">
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>설명</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <input type="text" name="exp" id="exp" class="form-control" value="<?= $exp ?>">
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>대상,부위</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <input type="text" name="target" id="target" class="form-control" value="<?= $target ?>">
                </div>
            </div>
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>썸네일</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <?
                    if ($upfile01) {
                        $imgFile = $path . 'thumb_' . $upfile01;
                        if (!is_file($imgFile))    $imgFile = $path . $upfile01;
                        $imgFile = _UPLOAD_DIR . $upfile01;
                    ?>
                        <img src='<?= $imgFile ?>' style='width:100px;'>
                    <?
                    }
                    ?>
                    <!-- <div class="file_input">
                        <input type="text" class="form-control" title="File Route" id="file_route01" readonly>
                        <label>찾아보기<input type="file" name="upfile01" onchange="javascript:document.getElementById('file_route01').value=this.value"></label><br>
                    </div> -->
                    <input type="file" name="upfile01" class="form-control">
                    <!-- (가로:800px * 세로:450px) -->
                </div>
            </div>
            <div class="cols_5 cols_ th"><span class='eqc'>*</span>수강일</div>
            <div class="cols_15 cols_">
                <div class="form-group">
                    <input type="text" name="period" id="period" class="form-control input_number txt-r" value="<?= $period ?>" maxlength="4">
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>정가(원)</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <input type="text" name="price" id="price" class="form-control input_won txt-r" value="<?= $price ?>" onkeyup="getDiscountRate();" maxlength="11">
                </div>
            </div>
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>할인가</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <input type="text" name="discountPrice" id="discountPrice" class="form-control input_won txt-r" value="<?= $discountPrice ?>" onkeyup="getDiscountRate();" maxlength="11">
                </div>
            </div>
            <div class="cols_5 cols_ th"><span class='eqc'>*</span>할인율</div>
            <div class="cols_15 cols_">
                <div class="form-group">
                    <input type="number" name="discountRate" id="discountRate" class="form-control input_number txt-r" value="<?= $discountRate ?>" onkeyup="" readonly>
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>상세정보</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <textarea name='ment01' id='ment01' style='width:100%;height:540px;border:1px solid #ccc;resize:none;'><?= $ment01 ?></textarea>
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>유의사항</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <textarea name='ment02' id='ment02' style='width:100%;height:540px;border:1px solid #ccc;resize:none;'><?= $ment02 ?></textarea>
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
    <iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>
</form>


<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script>
	// editor
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
        fCreator: "createSEditor2"
    });
    var oEditors2 = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors2,
        elPlaceHolder: "ment02",
        sSkinURI: "/smarteditor/SmartEditor2Skin.html",

        /* 페이지 벗어나는 경고창 없애기 */
        htParams: {
            bUseToolbar: true,
            bUseVerticalResizer: false,
            fOnBeforeUnload: function() {},
            fOnAppLoad: function() {}
        },
        fCreator: "createSEditor2"
    });

    const form_confirm = function() {
        const form = document.frm01;

        if (isFrmEmpty(form.title, "과정명을 입력해 주십시오.")) return;

        form.price.value = uncomma(form.price.value)
        form.discountPrice.value = uncomma(form.discountPrice.value)

        oEditors.getById["ment01"].exec("UPDATE_CONTENTS_FIELD", []);
        oEditors2.getById["ment02"].exec("UPDATE_CONTENTS_FIELD", []);

        form.action = './proc.php';
        form.submit();
    }

    const getCade = function(input) {
        const cade01 = input.value
        if (cade01 == "") {
            $('select[name=cade02]').empty();
            return;
        }
        $.ajax({
            url: "./proc.php",
            data: {
                'type': 'CADE',
                'cade01': cade01,
            },
            method: "get",
            success: (response) => {
                const cade02 = JSON.parse(response)
                let ele = '';
                for (const cade of cade02) {
                    const uid = cade['uid']
                    const title = cade['title']
                    ele += `<option value="${uid}">${title}</option>`;
                }
                $('select[name=cade02]').empty();
                $('select[name=cade02]').append(ele);
            },
            error: (xhr, status, errorThrown) => {
                GblMsgBox("구매오류 관리자에게 문의 바랍니다");
                console.log(xhr, errorThrown, status);
            }
        })
    }

    const getDiscountRate = function() {
        const price = uncomma($('input[name=price]').val())
        const dis_price = uncomma($('input[name=discountPrice]').val())

        if (price != 0 && price != '' && dis_price != '') {
            let dis_rate = parseInt(100 - (dis_price / price * 100))
            if (dis_rate < 0) dis_rate = 0
            $('input[name=discountRate]').val(dis_rate)
        } else {
            return
        }
    }
</script>