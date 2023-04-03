<script language='javascript'>
    function setUpDown04(mode) {
        var form = document.frm01;
        var code_list = form.code_list04;
        var intPos = code_list.selectedIndex;
        var intLen = code_list.length;
        var strValue, strText;


        if (intPos == -1) {
            GblMsgBox('카테고리을 선택해 주십시오.');
            return;

        } else {

            if (mode == 'up') {
                if (intPos != 0 && intLen >= 2) {
                    strValue = code_list[intPos - 1].value;
                    strText = code_list[intPos - 1].text;
                    code_list[intPos - 1].value = code_list[intPos].value;
                    code_list[intPos - 1].text = code_list[intPos].text;
                    code_list[intPos].value = strValue;
                    code_list[intPos].text = strText;
                    code_list[intPos - 1].selected = true;
                }
            } else {
                if (intPos != intLen - 1 && intLen >= 2) {
                    strValue = code_list[intPos + 1].value;
                    strText = code_list[intPos + 1].text;
                    code_list[intPos + 1].value = code_list[intPos].value;
                    code_list[intPos + 1].text = code_list[intPos].text;
                    code_list[intPos].value = strValue;
                    code_list[intPos].text = strText;
                    code_list[intPos + 1].selected = true;
                }
            }
        }
    }

    function saveOrder04() {
        var form = document.frm01;
        var order_list = "";

        code_list = form.code_list04;

        for (i = 0; i < code_list.length; i++) {
            order_list += code_list[i].value + "|+|";
        }

        form.sort_cade04.value = order_list;

        form.type.value = 'sort';
        form.action = 'cade04_proc.php';
        form.submit();
    }

    function selChk04() {
        c1 = $('#code_list01').find('option:selected').val();
        c2 = $('#code_list02').find('option:selected').val();
        c3 = $('#code_list03').find('option:selected').val();
        c4 = $('#code_list04').find('option:selected').val();

        form = document.frm01;

        form.e_cade01.value = c1;
        form.o_cade01.value = c1;

        form.e_cade02.value = c2;
        form.o_cade02.value = c2;

        form.e_cade03.value = c3;
        form.o_cade03.value = c3;
        
        form.e_cade04.value = c4;
        form.o_cade04.value = c4;
        
        // $.post('cade03_set.php', {
        //     'c1': c1,
        //     'c2': c2,
        //     'c3': c3,
        // }, function(c4) {
        //     //진료항목 selectbox 초기화
        //     $('#code_list04').empty();

        //     c4 = urldecode(c4);
        //     parData = JSON.parse(c4);

        //     //진료항목 selectbox 옵션설정	
        //     for (i = 0; i < parData.length; i++) {
        //         txt = parData[i];
        //         option = $("<option value='" + txt + "' style='padding:5px !important;'>" + txt + "</option>");
        //         $('#code_list04').append(option);
        //     }
        // });
    }

    function cade04_save() {
        form = document.frm01;
        var code_list = form.code_list01;
        var intPos = code_list.selectedIndex;

        var code_list2 = form.code_list02;
        var intPos2 = code_list2.selectedIndex;

        var code_list3 = form.code_list02;
        var intPos3 = code_list2.selectedIndex;

        if (intPos == -1 || intPos2 == -1 || intPos3 == -1) {
            GblMsgBox('상위 카테고리를 선택해 주십시오');
            return;

        } else {
            if (isFrmEmptyModal(form.w_cade04, "카테고리을 입력해 주십시오")) return;

            form.type.value = 'write';
            form.action = 'cade04_proc.php';
            form.submit();
        }
    }

    function cade04_modify() {
        form = document.frm01;
        var code_list = form.code_list04;
        var intPos = code_list.selectedIndex;

        if (intPos == -1) {
            GblMsgBox('수정하실 카테고리을 선택해 주십시오');
            return;

        } else {
            if (isFrmEmptyModal(form.e_cade04, "카테고리을 입력해 주십시오")) return;

            c4 = $('#code_list04').find('option:selected').val();
            e4 = $('#e_cade04').val();

            if (c4 == e4) {
                GblMsgBox('카테고리이 변경되지 않았습니다.');
                return;

            } else {
                form.type.value = 'edit';
                form.action = 'cade04_proc.php';
                form.submit();
            }

        }
    }

    function cade04_delete() {
        form = document.frm01;
        var code_list = form.code_list04;
        var intPos = code_list.selectedIndex;

        if (intPos == -1) {
            GblMsgBox('삭제하실 카테고리을 선택해 주십시오');
            return;

        } else {
            // let cade02_cnt = $('#code_list02 option').length;
            strText = code_list[intPos].text;
            if (confirm(strText + '을(를) 삭제하시겠습니까?')) {
                form.type.value = 'del';
                form.action = 'cade04_proc.php';
                form.submit();

                // if (cade02_cnt > 0) {
                //     if (confirm('하위 카테고리가 존재합니다. 하위 카테고리와 함께 정말 삭제하시겠습니까?')) {
                //         form.type.value = 'del';
                //         form.action = 'cade03_proc.php';
                //         form.submit();
                //     } else {
                //         return;
                //     }
                // } else {
                //     form.type.value = 'del';
                //     form.action = 'cade03_proc.php';
                //     form.submit();
                // }

            } else {
                return;

            }

        }
    }
</script>

<div class='cadeBox'>
    <div class='cadeLeft'><input type="text" name="w_cade04" class="form-control" value="" style='width:100%;display:inline-block;' placeholder='카테고리 입력' onkeypress="if(event.keyCode==13){cade04_save();}"></div>
    <div class='cadeRight'><a href="javascript:cade04_save();" class="btn btn-sm btn-primary btn-icon-split" style="margin-top:3px;"><span class="text">등록하기</span></a></div>
</div>

<div class='cadeBox' style='padding:5px 0;'>
    <div class='cadeLeft'>
        <select name="code_list04" id="code_list04" class="form-control" size='2' style='width:100%;height:260px;background:none;' onchange="selChk04();">
            <?
            if ($cade01 && $cade02 && $cade03) {
                $rows = sqlArray("SELECT * FROM ks_class_cade04 WHERE cade01='$cade01' AND cade02='$cade02' AND cade03='$cade03' ORDER BY sort ASC");
                if ($rows) {
                    foreach ($rows as $row) {
                        $db_cade04 = $row['title'];
                        $chk = '';
                        if ($cade04) {
                            $cade04_title = sqlRowOne("SELECT title FROM ks_class_cade04 WHERE uid='$cade04' AND cade01='$cade01' AND cade02='$cade02' AND cade03='$cade03'");
                            if ($cade04_title == $db_cade04)    $chk = 'selected';
                        }
            ?>
                        <option value="<?= $db_cade04 ?>" style='padding:5px;' <?= $chk ?>><?= $db_cade04 ?></option>
            <?
                    }
                }
            }
            ?>
        </select>
    </div>
    <div class='cadeRight'>
        <table cellpadding='0' cellspacing='0' border='0' style='margin-top:100px;'>
            <tr>
                <td>
                    <p style='margin:0;'><a href="javascript:setUpDown04('up')" title='위로'><img src="./img/up.gif"></a></p>
                    <p style='margin:3px 0 0 0;'><a href="javascript:setUpDown04('down')" title='아래로'><img src="./img/down.gif"></a></p>
                </td>
                <td style='padding-left:12px;'><a href="javascript:saveOrder04();" class="btn btn-sm btn-secondary btn-icon-split"><!--<img src="./img/save.gif">--><span class="text">순서<br>저장</span></a></td>
            </tr>
        </table>
    </div>
</div>

<div class='cadeBox'>
    <div class='cadeLeft'><input type="text" name="e_cade04" id="e_cade04" class="form-control" value="<?= $cade04_title ?>" style='width:100%;display:inline-block;' placeholder='카테고리 선택' onkeypress="if(event.keyCode==13){cade04_modify();}"></div>
    <div class='cadeRight'>
        <a href="javascript:cade04_modify();" class="btn btn-sm btn-secondary btn-icon-split" style="margin-top:3px;"><span class="text">수정</span></a>
        <a href="javascript:cade04_delete();" class="btn btn-sm btn-danger btn-icon-split" style="margin-top:3px;"><span class="text">삭제</span></a>
    </div>
</div>

<input type='hidden' name='o_cade04' value="<?= $cade04_title ?>">
<input type='hidden' name='sort_cade04' value="">

<iframe src="<?= $gurl ?>" name='ifra00' width='0' height='0' frameborder='0' scrolling='no'></iframe>