<?php
if ($type == 'edit' && $uid) { //수정할때
    $row = sqlRow("select * from ks_store where uid=$uid");
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
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>분류</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="cade01" id="cade01" class="form-control " value="<?= $cade01 ?>">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>상품명</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control " value="<?= $title ?>">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>설명</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="exp" id="exp" class="form-control " value="<?= $exp ?>">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>금액</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <input type="text" name="price" id="price" class="form-control " value="<?= $price ?>">
                </div>
            </div>

            <div class="cols_20 cols_ th"><span class='eqc'>*</span>배송비</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <input type="text" name="shipPrice" id="shipPrice" class="form-control " value="<?= $shipPrice ?>">
                </div>
            </div>

            <!-- <div class="cols_20 cols_ th"><span class='eqc'>*</span>광고</div>
			<div class="cols_30 cols_">
				<div class="form-group">
					<input type="text" name="key02" id="key02" class="form-control " value="<?= $key02 ?>">
				</div>
			</div> -->
        </div>
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
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>제품사진</div>
            <div class="cols_80 cols_">
                <div class="form-group">

                    <div class="attach-img-wrap">
                        <?
                        if ($upfile01) {
                            $imgFile = $path . 'thumb_' . $upfile01;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile01;
                            $imgFile = "/upfile/store/" . $upfile01;
                        ?>
                            <label class="attach-img-box active" for="upfile01" id="userfile01" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile01" id="upfile01" style="display:none;" onchange="fileChk('01');">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile01" id="userfile01">
                                <input type="file" name="upfile01" id="upfile01" style="display:none;" onchange="fileChk('01');">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>

                        <?
                        if ($upfile02) {
                            $imgFile = $path . 'thumb_' . $upfile02;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile02;
                            $imgFile = "/upfile/store/" . $upfile02;
                        ?>
                            <label class="attach-img-box active" for="upfile02" id="userfile02" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile02" id="upfile02" style="display:none;" onchange="fileChk('02');">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile02" id="userfile02">
                                <input type="file" name="upfile02" id="upfile02" style="display:none;" onchange="fileChk('02');">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>

                        <?
                        if ($upfile03) {
                            $imgFile = $path . 'thumb_' . $upfile03;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile03;
                            $imgFile = "/upfile/store/" . $upfile03;
                        ?>
                            <label class="attach-img-box active" for="upfile03" id="userfile03" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile03" id="upfile03" style="display:none;" onchange="fileChk('03');">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile03" id="userfile03">
                                <input type="file" name="upfile03" id="upfile03" style="display:none;" onchange="fileChk('03');">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>

                        <?
                        if ($upfile04) {
                            $imgFile = $path . 'thumb_' . $upfile04;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile04;
                            $imgFile = "/upfile/store/" . $upfile04;
                        ?>
                            <label class="attach-img-box active" for="upfile04" id="userfile04" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile04" id="upfile04" style="display:none;" onchange="fileChk('04');">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile04" id="userfile04">
                                <input type="file" name="upfile04" id="upfile04" style="display:none;" onchange="fileChk('04');">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>

                        <?
                        if ($upfile05) {
                            $imgFile = $path . 'thumb_' . $upfile05;
                            if (!is_file($imgFile))    $imgFile = $path . $upfile05;
                            $imgFile = "/upfile/store/" . $upfile05;
                        ?>
                            <label class="attach-img-box active" for="upfile05" id="userfile05" style="background-image: url('<?= $imgFile ?>')">
                                <input type="file" name="upfile05" id="upfile05" style="display:none;" onchange="fileChk('05');">
                                <img src="/images/search-close-btn.png" />
                            </label>
                        <?
                        } else {
                        ?>
                            <label class="attach-img-box" for="upfile05" id="userfile05">
                                <input type="file" name="upfile05" id="upfile05" style="display:none;" onchange="fileChk('05');">
                                <img src="/images/plus-icon02.svg" />
                            </label>
                        <? } ?>


                    </div>

                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>상세정보</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <textarea name='ment01' id='ment01' style='width:100%;height:540px;border:1px solid #ccc;resize:none;'><?= $ment01 ?></textarea>
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>유의사항</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <textarea name='ment02' id='ment02' style='width:100%;height:540px;border:1px solid #ccc;resize:none;'><?= $ment02 ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div style='width:100%;margin:40px 0;text-align:center;'>
        <a href="javascript:goList();" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-list"></i>
            </span>
            <span class="text">목록으로</span>
        </a>

        <a href="javascript:formChk();" class="btn btn-success btn-icon-split" style="margin-left:20px;">
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
            <a href="javascript:userDel();" class="btn btn-danger btn-icon-split" style="margin-left:20px;">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">삭제하기</span>
            </a>
        <?
        }
        ?>
    </div>

    <iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>

</form>

<script>
    const formModal = function(u) {
        $("#multiBox").css({
            "width": "90%",
            "max-width": "800px"
        });
        $('#multi_ttl').text('업로드리스트');
        $('#multiFrame').html("<iframe src='/adm/class/tmp/?class_uid=" + u + "' name='memberFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
        $('.multiBox_open').click();
    }

    function goList() {
        history.back();
    }

    function formChk() {
        form = document.frm01;

        if (isFrmEmpty(form.title, "강좌명을 입력해 주십시오.")) return;

        oEditors.getById["ment01"].exec("UPDATE_CONTENTS_FIELD", []);
        oEditors2.getById["ment02"].exec("UPDATE_CONTENTS_FIELD", []);
        //form.target = 'ifra_gbl';
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

    const getCade = function(input) {
        const cade01 = input.value
        if (cade01 == "") {
            $('select[name=cade02]').empty();
            return;
        }
        $.ajax({
            url: "/module/common/proc_class_cade.php",
            data: {
                "cade01": cade01,
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

    /*파일체크 & 썸네일*/
    function fileChk(no) {
        upFile = $("#upfile" + no).val();

        if (upFile != "") {
            var ext = $('#upfile' + no).val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['jpg', 'gif', 'png']) == -1) {
                GblMsgBox('jpg, gif, png\n파일만 등록이 가능합니다.', '');
                $("#upfile" + no).val('');

                return;

            } else {
                var fileSize = 0;

                // 브라우저 확인
                var browser = navigator.appName;

                file = document.frm01['upfile' + no];

                // 익스플로러일 경우
                if (browser == "Microsoft Internet Explorer") {
                    var oas = new ActiveXObject("Scripting.FileSystemObject");
                    fileSize = oas.getFile(file.value).size;

                    // 익스플로러가 아닐경우			
                } else {
                    fileSize = file.files[0].size;
                }

                fS = Math.round(fileSize / 1024);

                if (fS > 5120) {
                    GblMsgBox('5M이상의 파일은 등록할 수 없습니다.', '');
                    $("#upfile'" + no).val('');

                    return;
                }
            }
        }

        setThumbnail(event);

    }

    function setThumbnail(e) {
        var reader = new FileReader();
        const id = $(e.target).parent().attr('id');
        if (id == 'userfile01') {
            reader.onload = function(e) {
                const previewImage = $('#userfile01');

                previewImage.addClass('active');

                $('#userfile01').children('img').attr('src', '/images/search-close-btn.png');

                previewImage.css({
                    'background-image': `url(${e.target.result})`
                });

            }
        }
        if (id == 'userfile02') {
            reader.onload = function(e) {

                const previewImage = $('#userfile02');

                previewImage.addClass('active');
                $('#userfile02').children('img').attr('src', '/images/search-close-btn.png');

                previewImage.css({
                    'background-image': `url(${e.target.result})`
                });
            }
        }
        if (id == 'userfile03') {
            reader.onload = function(e) {

                const previewImage = $('#userfile03');

                previewImage.addClass('active');
                $('#userfile03').children('img').attr('src', '/images/search-close-btn.png');
                previewImage.css({
                    'background-image': `url(${e.target.result})`
                });
            }
        }
        if (id == 'userfile04') {
            reader.onload = function(e) {

                const previewImage = $('#userfile04');

                previewImage.addClass('active');
                $('#userfile04').children('img').attr('src', '/images/search-close-btn.png');

                previewImage.css({
                    'background-image': `url(${e.target.result})`
                });
            }
        }
        if (id == 'userfile05') {
            reader.onload = function(e) {

                const previewImage = $('#userfile05');

                previewImage.addClass('active');
                $('#userfile05').children('img').attr('src', '/images/search-close-btn.png');

                previewImage.css({
                    'background-image': `url(${e.target.result})`
                });
            }
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

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<script type="text/javascript">
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
</script>