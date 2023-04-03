<style>
    .searchBox .form-control {
        background-color: #fff;
        display: inline-block;
    }

    .searchBox .btn-icon-split .text {
        padding: 0.31rem 0.75rem;
    }
</style>

<div class='searchBox' style='width:100%;'>
    <div style="float:left;">
        <select name="f_status" id="f_status" class="form-control" style="width:120px;" onchange="searchChk();">
            <option value=''>상태</option>
            <option value='1' <? if ($f_status == '1') echo 'selected'; ?>>활성</option>
            <option value='0' <? if ($f_status == '0') echo 'selected'; ?>>비활성</option>
        </select>

        <select name="f_tuid" id="f_tuid" class="form-control" style="width:120px;" onchange="searchChk();">
            <option value=''>선생님</option>
            <?
            $row = sqlArray("SELECT tuid, (SELECT name FROM ks_member WHERE ks_member.uid=ks_class.tuid) tname FROM ks_class GROUP BY tuid ORDER BY tname");
            if ($row) {
                foreach ($row as $k => $v) {
                    $db_tuid = $v['tuid'];
                    $db_tname = $v['tname'];

                    if ($f_tuid == $db_tuid)    $chk = 'selected';
                    else                        $chk = '';
            ?>
                    <option value="<?= $db_tuid ?>" style='padding:5px;' <?= $chk ?>><?= $db_tname ?></option>
            <?
                }
            }
            ?>
        </select>

        <select name="f_cade01" id="f_cade01" class="form-control" style="width:200px;" onchange="selChk01();">
            <option value=''>1차분류</option>
            <?
            $row = sqlArray("SELECT * FROM ks_class_cade01 ORDER BY sort ASC");
            if ($row) {
                foreach ($row as $k => $v) {
                    $cade01_uid = $v['uid'];
                    $db_cade01 = $v['title'];

                    if ($f_cade01 == $cade01_uid)    $chk = 'selected';
                    else                            $chk = '';
            ?>
                    <option value="<?= $cade01_uid ?>" style='padding:5px;' <?= $chk ?>><?= $db_cade01 ?></option>
            <?
                }
            }
            ?>
        </select>

        <select name="f_cade02" id="f_cade02" class="form-control" style="width:200px;" onchange="selChk02();">
            <option value=''>2차분류</option>
            <?
            if ($f_cade01) {
                $row = sqlArray("SELECT * FROM ks_class_cade02 where cade01='" . $f_cade01 . "' order by sort asc");
                if ($row) {
                    foreach ($row as $k => $v) {
                        $cade02_uid = $v['uid'];
                        $db_cade02 = $v['title'];

                        if ($f_cade02 == $cade02_uid)    $chk = 'selected';
                        else                            $chk = '';
            ?>
                        <option value="<?= $cade02_uid ?>" style='padding:5px;' <?= $chk ?>><?= $db_cade02 ?></option>
            <?
                    }
                }
            }
            ?>
        </select>

        <select name="f_cade03" id="f_cade03" class="form-control" style="width:200px;">
            <option value=''>3차분류</option>
            <?
            if ($f_cade01 && $f_cade02) {
                $row = sqlArray("SELECT * FROM ks_class_cade03 where cade01='" . $f_cade01 . "' and cade02='" . $f_cade02 . "' order by sort asc");
                if ($row) {
                    foreach ($row as $k => $v) {
                        $cade03_uid = $v['uid'];
                        $db_cade03 = $v['title'];

                        if ($f_cade03 == $cade03_uid)    $chk = 'selected';
                        else                                    $chk = '';
            ?>
                        <option value="<?= $cade03_uid ?>" style='padding:5px;' <?= $chk ?>><?= $db_cade03 ?></option>
            <?
                    }
                }
            }
            ?>
        </select>

        <input type="text" name="f_title" class="form-control" value="<?= $f_title ?>" style='width:200px;' placeholder='상품명' onkeypress="if(event.keyCode==13){searchChk();}">
        <a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
            <span class="text">검색</span>
        </a>
    </div>
</div>

<script>
    function selChk01() {
        c1 = $('#f_cade01').find('option:selected').val();

        form = document.frm01;

        //2차분류
        $.post('./cade/cade01_set.php', {
            'c1': c1
        }, function(c2) {
            //2차분류 selectbox 초기화
            $('#f_cade02').empty();
            $('#f_cade02').append("<option value=''>2차분류</option>");

            //3차분류 selectbox 초기화
            $('#f_cade03').empty();
            $('#f_cade03').append("<option value=''>3차분류</option>");

            c2 = urldecode(c2);
            parData = JSON.parse(c2);

            //2차분류 selectbox 옵션설정	
            for (i = 0; i < parData.length; i++) {
                txt = parData[i];
                option = $("<option value='" + txt + "' style='padding:5px !important;'>" + txt + "</option>");
                $('#f_cade02').append(option);
            }
        });
    }

    function selChk02() {
        c1 = $('#f_cade01').find('option:selected').val();
        c2 = $('#f_cade02').find('option:selected').val();

        form = document.frm01;

        //3차분류
        $.post('./cade/cade02_set.php', {
            'c1': c1,
            'c2': c2
        }, function(c3) {
            //3차분류 selectbox 초기화
            $('#f_cade03').empty();
            $('#f_cade03').append("<option value=''>3차분류</option>");

            c3 = urldecode(c3);
            parData = JSON.parse(c3);

            //3차분류 selectbox 옵션설정	
            for (i = 0; i < parData.length; i++) {
                txt = parData[i];
                option = $("<option value='" + txt + "' style='padding:5px !important;'>" + txt + "</option>");
                $('#f_cade03').append(option);
            }
        });
    }

    function searchChk() {
        const form = document.frm01;
        form.record_start.value = '';
        // form.target = '';
        form.action = "<?= $_SERVER['PHP_SELF'] ?>";
        form.submit();
    }
</script>
