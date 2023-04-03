<?
if ($type == 'edit' && $uid) { //수정할때
    $row = sqlRow("SELECT *,
    (SELECT uid FROM ks_member WHERE ks_member.uid=ks_class.tuid) AS tuid, 
    (SELECT name FROM ks_member WHERE ks_member.uid=ks_class.tuid) AS tname 
    FROM ks_class WHERE uid='$uid'");

    if ($row) {
        foreach ($row as $k => $v) {
            ${$k} = $v;
        }
    } else {
        Msg::backMsg('접근오류');
        exit;
    }
    if ($ment01)    $ment01 = Util::textareaDecodeing($ment01);
    if ($ment02)    $ment02 = Util::textareaDecodeing($ment02);
}

$cade01_arr = sqlArray("SELECT * FROM ks_class_cade01 ORDER BY sort");
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
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>강사</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <select type="text" name="tuid" id="tuid" class="form-control" value="<?= $tname ?>">
                        <option value="">없음</option>
                        <?
                        $teacher_arr = sqlArray("SELECT uid, name FROM ks_member WHERE mtype='T'");
                        foreach ($teacher_arr as $teacher) {
                        ?>
                            <option value="<?= $teacher['uid'] ?>" <? if ($tuid == $teacher['uid']) echo 'selected'; ?>><?= $teacher['name'] ?></option>
                        <? } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>상품명</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control" value="<?= $title ?>">
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
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>대상</div>
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
                    <input type="file" name="upfile01" class="form-control" onchange="fileChk(this)">
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
                    <input type="text" name="price" id="price" class="form-control input_won txt-r" value="<?= number_format($price) ?>" onkeyup="getDiscountRate();" maxlength="11">
                </div>
            </div>
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>할인가</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <input type="text" name="discountPrice" id="discountPrice" class="form-control input_won txt-r" value="<?= number_format($discountPrice) ?>" onkeyup="getDiscountRate();" maxlength="11">
                </div>
            </div>
            <div class="cols_5 cols_ th"><span class='eqc'>*</span>할인율</div>
            <div class="cols_15 cols_">
                <div class="form-group">
                    <input type="number" name="discountRate" id="discountRate" class="form-control input_number txt-r" value="<?= number_format($discountRate) ?>" onkeyup="" readonly>
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
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>강의자료</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <!-- <input type="file" name='upfile02' id='upfile02' class="form-control" onchange="fileChk2(this)"> -->
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
    // var oEditors2 = [];
    // nhn.husky.EZCreator.createInIFrame({
    //     oAppRef: oEditors2,
    //     elPlaceHolder: "ment02",
    //     sSkinURI: "/smarteditor/SmartEditor2Skin.html",

    //     /* 페이지 벗어나는 경고창 없애기 */
    //     htParams: {
    //         bUseToolbar: true,
    //         bUseVerticalResizer: false,
    //         fOnBeforeUnload: function() {},
    //         fOnAppLoad: function() {}
    //     },
    //     fCreator: "createSEditor2"
    // });

    const form_confirm = function() {
        const form = document.frm01;

        if (isFrmEmpty(form.title, "강좌명을 입력해 주십시오.")) return;

        form.price.value = uncomma(form.price.value)
        form.discountPrice.value = uncomma(form.discountPrice.value)

        oEditors.getById["ment01"].exec("UPDATE_CONTENTS_FIELD", []);
        // oEditors2.getById["ment02"].exec("UPDATE_CONTENTS_FIELD", []);

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

    const fileChk2 = function(obz) {
        let obj = obz.files[0]
        console.log(obj);
        const fileTypes = ['application/pdf', 'image/gif', 'image/jpeg', 'image/png', 'image/bmp', 'image/tif', 'application/haansofthwp', 'application/x-hwp'];
        if (obj.name.length > 100) {
            alert("파일명이 100자 이상인 파일은 제외되었습니다.");
            return false;
        } else if (obj.size > (100 * 1024 * 1024)) {
            alert("최대 파일 용량인 100MB를 초과한 파일은 제외되었습니다.");
            return false;
        } else if (obj.name.lastIndexOf('.') == -1) {
            alert("확장자가 없는 파일은 제외되었습니다.");
            return false;
        } else if (!fileTypes.includes(obj.type)) {
            alert("첨부가 불가능한 파일은 제외되었습니다.");
            return false;
        } else {
            return true;
        }
    }
</script>