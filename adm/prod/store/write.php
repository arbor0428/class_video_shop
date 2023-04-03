<?php
if ($type == 'edit' && $uid) { //수정할때
    $row = sqlRow("SELECT * FROM ks_class WHERE uid='$uid'");
    if ($row) {
        foreach ($row as $k => $v) {
            ${$k} = $v;
        }
    } else {
        Msg::backMsg('접근오류');
        exit;
    }
    //비고
    if ($ment01) $ment01 = $UTIL->textareaDecodeing($ment01);
    if ($ment02) $ment02 = $UTIL->textareaDecodeing($ment02);
}
?>

<style>
    .attach-img-wrap {
        width: 100%;
        margin-top: 8px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .attach-img-box {
        width: 60px;
        height: 60px;
        position: relative;
        border: 1px dotted #ddd;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }

    .attach-img-box.active img {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 15px;
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
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>상품명</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control " value="<?= $title ?>">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>설명</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <input type="text" name="exp" id="exp" class="form-control " value="<?= $exp ?>">
                </div>
            </div>
        </div>
<div class="cols">
    <div class="cols_10 cols_ th"><span class='eqc'>*</span>대상</div>
    <div class="cols_40 cols_">
        <div class="form-group">
            <input type="text" name="target" id="target" class="form-control" value="<?= $target ?>">
        </div>
    </div>
    <div class="cols_10 cols_ th"><span class='eqc'>*</span>썸네일</div>
    <div class="cols_40 cols_">
        <div class="form-group">
            <?
            if ($upfile01) {
                $imgFile = $path . 'thumb_' . $upfile01;
                if (!is_file($imgFile))    $imgFile = $path . $upfile01;
                $imgFile = _UPLOAD_DIR . '/' . $upfile01;
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
</div>
        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>정가(원)</div>
            <div class="cols_15 cols_">
                <div class="form-group">
                    <input type="text" name="price" id="price" class="form-control input_won txt-r" value="<?= number_format($price) ?>" onkeyup="getDiscountRate();" maxlength="11">
                </div>
            </div>
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>할인가</div>
            <div class="cols_15 cols_">
                <div class="form-group">
                    <input type="text" name="discountPrice" id="discountPrice" class="form-control input_won txt-r" value="<?= number_format($discountPrice) ?>" onkeyup="getDiscountRate();" maxlength="11">
                </div>
            </div>
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>할인율</div>
            <div class="cols_15 cols_">
                <div class="form-group">
                    <input type="number" name="discountRate" id="discountRate" class="form-control input_number txt-r" value="<?= number_format($discountRate) ?>" readonly>
                </div>
            </div>
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>배송비</div>
            <div class="cols_15 cols_">
                <div class="form-group">
                    <input type="text" name="shipPrice" id="shipPrice" class="form-control input_won txt-r" value="<?= number_format($shipPrice) ?>">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>제품사진</div>
            <div class="cols_90 cols_">
                <div class="form-group">

                    <div class="attach-img-wrap">
                        <?
                        if ($upfile02) {
                            $imgFile = $path . 'thumb_' . $upfile02;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile02;
                            $imgFile = _UPLOAD_DIR . '/' . $upfile02;
                        ?>
                            <label class="attach-img-box active" for="upfile02" id="userfile02" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile02" id="upfile02" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile02" id="userfile02">
                                <input type="file" name="upfile02" id="upfile02" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>

                        <?
                        if ($upfile03) {
                            $imgFile = $path . 'thumb_' . $upfile03;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile03;
                            $imgFile = _UPLOAD_DIR . '/' . $upfile03;
                        ?>
                            <label class="attach-img-box active" for="upfile03" id="userfile03" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile03" id="upfile03" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile03" id="userfile03">
                                <input type="file" name="upfile03" id="upfile03" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>

                        <?
                        if ($upfile04) {
                            $imgFile = $path . 'thumb_' . $upfile04;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile04;
                            $imgFile = _UPLOAD_DIR . '/' . $upfile04;
                        ?>
                            <label class="attach-img-box active" for="upfile04" id="userfile04" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile04" id="upfile04" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile04" id="userfile04">
                                <input type="file" name="upfile04" id="upfile04" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>

                        <?
                        if ($upfile05) {
                            $imgFile = $path . 'thumb_' . $upfile05;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile05;
                            $imgFile = _UPLOAD_DIR . '/' . $upfile05;
                        ?>
                            <label class="attach-img-box active" for="upfile05" id="userfile05" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile05" id="upfile05" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile05" id="userfile05">
                                <input type="file" name="upfile05" id="upfile05" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>
                        
                        <?
                        if ($upfile06) {
                            $imgFile = $path . 'thumb_' . $upfile06;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile06;
                            $imgFile = _UPLOAD_DIR . '/' . $upfile06;
                        ?>
                            <label class="attach-img-box active" for="upfile06" id="userfile06" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile06" id="upfile06" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile06" id="userfile06">
                                <input type="file" name="upfile06" id="upfile06" style="display:none;" onchange="fileChk(this);">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>


                    </div>

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

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<script type="text/javascript">
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
    
    const form_confirm = function() {
        const form = document.frm01;

        if (isFrmEmpty(form.title, "상품명을 입력해 주십시오.")) return;

        form.price.value = uncomma(form.price.value)
        form.discountPrice.value = uncomma(form.discountPrice.value)
        form.shipPrice.value = uncomma(form.shipPrice.value)

        oEditors.getById["ment01"].exec("UPDATE_CONTENTS_FIELD", []);

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

                if (fileSize > 10 * 1024 * 1024) {
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

        setThumbnail(event);
    }

    /*파일체크 & 썸네일*/
    // function fileChk(no) {
    //     upFile = $("#upfile" + no).val();

    //     if (upFile != "") {
    //         var ext = $('#upfile' + no).val().split('.').pop().toLowerCase();
    //         if ($.inArray(ext, ['jpg', 'gif', 'png']) == -1) {
    //             GblMsgBox('jpg, gif, png\n파일만 등록이 가능합니다.', '');
    //             $("#upfile" + no).val('');

    //             return;

    //         } else {
    //             var fileSize = 0;

    //             // 브라우저 확인
    //             var browser = navigator.appName;

    //             file = document.frm01['upfile' + no];

    //             // 익스플로러일 경우
    //             if (browser == "Microsoft Internet Explorer") {
    //                 var oas = new ActiveXObject("Scripting.FileSystemObject");
    //                 fileSize = oas.getFile(file.value).size;

    //                 // 익스플로러가 아닐경우			
    //             } else {
    //                 fileSize = file.files[0].size;
    //             }

    //             fS = Math.round(fileSize / 1024);

    //             if (fS > 5120) {
    //                 GblMsgBox('5M이상의 파일은 등록할 수 없습니다.', '');
    //                 $("#upfile'" + no).val('');

    //                 return;
    //             }
    //         }
    //     }

    //     setThumbnail(event);

    // }

    function setThumbnail(e) {
        var reader = new FileReader();
        const id = e.target.parentNode.id;
        // return
        console.log(id);
        reader.onload = function(e) {
            const previewImage = $('#' + id);

            previewImage.addClass('active');
            $('#' + id).children('img').attr('src', '/images/search-close-btn.png');

            previewImage.css({
                'background-image': `url(${e.target.result})`
            });
        }
        reader.readAsDataURL(e.target.files[0]);
        let imgNum = $('.attach-img-box.active').length;
        $('.img-cnt').text(imgNum + 1);
    }

    $('.attach-img-box').each(function() {
        $(this).click(function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');

                $(this).children('input[type=file]').val('');

                $(this).css('background-image', '');
                $(this).children('img').attr('src', '/images/plus-icon02.svg');
            }
        })
    });
</script>