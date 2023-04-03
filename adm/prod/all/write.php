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
            <div class="cols_05 cols_ th"><span class='eqc'>*</span>1차 분류</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <select type="text" name="cade01" id="cade01" class="form-control" value="" onchange="getCade(this);">
                        <option value="">선택</option>
                        <?
                        $cade01_arr = sqlArray("SELECT * FROM ks_class_cade01 ORDER BY sort");
                        foreach ($cade01_arr as $cade) {
                        ?>
                            <option value="<?= $cade['uid'] ?>" <? if ($cade['uid'] == $cade01) echo "selected"; ?>><?= $cade['title'] ?></option>
                        <?
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="cols_05 cols_ th"><span class='eqc'>*</span>2차 분류</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <select type="text" name="cade02" id="cade02" class="form-control" value="" onchange="getCade2(this);">
                        <option value="">선택</option>
                        <?
                        if ($type == 'edit') {
                            $cade02_arr = sqlArray("SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort");
                            foreach ($cade02_arr as $cade) {
                        ?>
                                <option value="<?= $cade['uid'] ?>" <? if ($cade['uid'] == $cade02) echo "selected"; ?>><?= $cade['title'] ?></option>
                        <?
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="cols_05 cols_ th"><span class='eqc'>*</span>3차 분류</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <select type="text" name="cade03" id="cade03" class="form-control" value="">
                    <!-- <select type="text" name="cade03" id="cade03" class="form-control" value="" onchange="getCade3(this);"> -->
                        <option value="">선택</option>
                        <?
                        if ($type == 'edit') {
                            $cade03_arr = sqlArray("SELECT * FROM ks_class_cade03 WHERE cade01=$cade01 AND cade02=$cade02 ORDER BY sort");
                            foreach ($cade03_arr as $cade) {
                        ?>
                                <option value="<?= $cade['uid'] ?>" <? if ($cade['uid'] == $cade03) echo "selected"; ?>><?= $cade['title'] ?></option>
                        <?
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>4차 분류</div>
            <div class="cols_40 cols_">
                <div class="form-group">
                    <select type="text" name="cade04" id="cade04" class="form-control" value="">
                        <option value="">선택</option>
                        <?
                        if ($type == 'edit') {
                            $cade04_arr = sqlArray("SELECT * FROM ks_class_cade04 WHERE cade01=$cade01 AND cade02=$cade02 AND cade03=$cade03 ORDER BY sort");
                            foreach ($cade04_arr as $cade) {
                        ?>
                                <option value="<?= $cade['uid'] ?>" <? if ($cade['uid'] == $cade04) echo "selected"; ?>><?= $cade['title'] ?></option>
                        <?
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div> -->

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

            <div class="cols_10 cols_ th"><span class='eqc'>*</span>강사</div>
            <div class="cols_30 cols_">
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

            <div class="cols_5 cols_ th"><span class='eqc'>*</span>클래스<br>타입</div>
            <div class="cols_15 cols_">
                <div class="form-group">
                    <select name="prod_type" id="prod_type">
                        <option value="CLASS_ONLINE" <? if ($prod_type == "CLASS_ONLINE") echo "selected"; ?>>온라인</option>
                        <option value="CLASS_OFFLINE" <? if ($prod_type == "CLASS_OFFLINE") echo "selected"; ?>>오프라인</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>썸네일</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <?
                    if ($upfile01) {
                        $imgFile = $path . 'thumb_' . $upfile01;
                        if (!is_file($imgFile))    $imgFile = $path . $upfile01;
                        $imgFile = "/upfile/class/" . $upfile01;
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

            <div class="cols_10 cols_ th"><span class='eqc'>*</span>시험<br>가격</div>
            <div class="cols_30 cols_">
                <div class="form-group">
                    <div class="form-group">
                        <input type="text" name="certPrice" id="certPrice" class="form-control input_won txt-r" value="<?= number_format($certPrice) ?>" onkeyup="getDiscountRate();" maxlength="11">
                    </div>
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
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>강의자료1</div>
            <div class="cols_90 cols_">
                <input type="file" name='upfile02' id='upfile02' class="form-control" style="width:49%;" onchange="fileChk2(this)">
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

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>강의자료2</div>
            <div class="cols_90 cols_">
                <input type="file" name='upfile03' id='upfile03' class="form-control" style="width:49%;" onchange="fileChk2(this)">
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

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>강의자료3</div>
            <div class="cols_90 cols_">
                <input type="file" name='upfile04' id='upfile04' class="form-control" style="width:49%;" onchange="fileChk2(this)">
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

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>강의자료4</div>
            <div class="cols_90 cols_">
                <input type="file" name='upfile05' id='upfile05' class="form-control" style="width:49%;" onchange="fileChk2(this)">
                <?
                if ($upfile05) {
                ?>
                    <input type="hidden" name="del_upfile05" id="del_upfile05" value="N">
                    <input type="hidden" name="dbfile05" id="dbfile05" value="<?= $upfile05 ?>">
                    <input type="checkbox" class="form-control" style="display:inline-block;" data-index="del_upfile05" onchange="setDelChk(this)">
                    <span class='ico09'>삭제</span>
                    <a href="/upfile/class/<?= $upfile05 ?>" download="<?= $realfile05 ?>"><input type="text" name="realfile05" id="realfile05" class="bold" value="<?= $realfile05 ?>" style="cursor:pointer;" readonly></a>
                <?
                }
                ?>
            </div>
        </div>

        <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>강의자료5</div>
            <div class="cols_90 cols_">
                <input type="file" name='upfile06' id='upfile06' class="form-control" style="width:49%;" onchange="fileChk2(this)">
                <?
                if ($upfile06) {
                ?>
                    <input type="hidden" name="del_upfile06" id="del_upfile06" value="N">
                    <input type="hidden" name="dbfile06" id="dbfile06" value="<?= $upfile06 ?>">
                    <input type="checkbox" class="form-control" style="display:inline-block;" data-index="del_upfile06" onchange="setDelChk(this)">
                    <span class='ico09'>삭제</span>
                    <a href="/upfile/class/<?= $upfile06 ?>" download="<?= $realfile06 ?>"><input type="text" name="realfile06" id="realfile06" class="bold" value="<?= $realfile06 ?>" style="cursor:pointer;" readonly></a>
                <?
                }
                ?>
            </div>
        </div>
        <!-- <div class="cols">
            <div class="cols_10 cols_ th"><span class='eqc'>*</span>유의사항</div>
            <div class="cols_90 cols_">
                <div class="form-group">
                    <textarea name='ment02' id='ment02' style='width:100%;height:540px;border:1px solid #ccc;resize:none;'><? //$ment02 
                                                                                                                            ?></textarea>
                </div>
            </div>
        </div> -->
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

        if (isFrmEmpty(form.cade01, "필수항목을 입력해 주십시오.")) return;
        if (isFrmEmpty(form.cade02, "필수항목을 입력해 주십시오.")) return;
        if (isFrmEmpty(form.cade03, "필수항목을 입력해 주십시오.")) return;
        if (isFrmEmpty(form.title, "필수항목을 입력해 주십시오.")) return;

        form.price.value = uncomma(form.price.value)
        form.discountPrice.value = uncomma(form.discountPrice.value)
        form.certPrice.value = uncomma(form.certPrice.value)

        oEditors.getById["ment01"].exec("UPDATE_CONTENTS_FIELD", []);
        // oEditors2.getById["ment02"].exec("UPDATE_CONTENTS_FIELD", []);

        form.action = './proc.php';
        form.submit();
    }

    const getCade = function(input) {
        const cade01 = input.value
        if (cade01 == '') {
            $('select[name=cade02]').empty();
            $('select[name=cade03]').empty();
            $('select[name=cade04]').empty();
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
                let ele = '<option value="">선택</option>';
                for (const cade of cade02) {
                    const uid = cade['uid']
                    const title = cade['title']
                    ele += `<option value="${uid}">${title}</option>`;
                }
                $('select[name=cade02]').empty();
                $('select[name=cade03]').empty();
                $('select[name=cade04]').empty();

                $('select[name=cade02]').append(ele);
            },
            error: (xhr, status, errorThrown) => {
                GblMsgBox("구매오류 관리자에게 문의 바랍니다");
                console.log(xhr, errorThrown, status);
            }
        })
    }

    const getCade2 = function(input) {
        const cade01 = document.frm01.cade01.value
        const cade02 = input.value
        if (cade01 == '' || cade02 == '') {
            $('select[name=cade03]').empty();
            $('select[name=cade04]').empty();
            return;
        }
        $.ajax({
            url: "./proc.php",
            data: {
                'type': 'CADE2',
                'cade01': cade01,
                'cade02': cade02,
            },
            method: "get",
            success: (response) => {
                const cade03 = JSON.parse(response)
                let ele = '<option value="">선택</option>';
                for (const cade of cade03) {
                    const uid = cade['uid']
                    const title = cade['title']
                    ele += `<option value="${uid}">${title}</option>`;
                }
                $('select[name=cade03]').empty();
                $('select[name=cade04]').empty();

                $('select[name=cade03]').append(ele);
            },
            error: (xhr, status, errorThrown) => {
                GblMsgBox("구매오류 관리자에게 문의 바랍니다");
                console.log(xhr, errorThrown, status);
            }
        })
    }

    const getCade3 = function(input) {
        const cade01 = document.frm01.cade01.value
        const cade02 = document.frm01.cade02.value
        const cade03 = input.value
        if (cade01 == "") {
            $('select[name=cade04]').empty();
            return;
        }
        $.ajax({
            url: "./proc.php",
            data: {
                'type': 'CADE3',
                'cade01': cade01,
                'cade02': cade02,
                'cade03': cade03,
            },
            method: "get",
            success: (response) => {
                const cade04 = JSON.parse(response)
                let ele = '<option value="">선택</option>';
                for (const cade of cade04) {
                    const uid = cade['uid']
                    const title = cade['title']
                    ele += `<option value="${uid}">${title}</option>`;
                }
                $('select[name=cade04]').empty();

                $('select[name=cade04]').append(ele);
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

    const fileChk2 = function(file) {
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