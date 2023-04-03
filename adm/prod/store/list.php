<?php
$record_count = 10;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!($record_start)) $record_start = 0;
echo "<script>console.log('$record_start')</script>";

$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "where prod_type='STORE'";

//상태
// if ($f_status == '0')        $query_ment .= " AND status='0'";
// elseif ($f_status == '1')    $query_ment .= " AND status='1'";

//선생님
// if ($f_tuid) $query_ment .= " AND tuid='$f_tuid'";

//분류
// if ($f_category1) $query_ment .= " AND cade01='$f_category'";
// elseif ($f_category2) $query_ment .= " AND cade02='$f_category'";

$sort_ment = "ORDER BY status DESC, uid DESC";
// if ($f_sort == 'rTime')$sort_ment = "order by rTime desc";
// else	$sort_ment = "order by uid desc";

$query = "SELECT * FROM ks_class $query_ment $sort_ment";

$result = mysql_query($query) or die(mysql_error());
$total_record = mysql_num_rows($result);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) $total_page++;

$query .= " limit $record_start, $record_count";
$result = mysql_query($query) or die(mysql_error());

?>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
    <input type="text" style="display: none;">
    <input type='hidden' name='type' value='<?= $type ?>'>
    <input type='hidden' name='uid' value=''>
    <input type='hidden' name='record_start' value='<?= $record_start ?>'>
    <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
    <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>

    <div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
        <div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
            <a href="javascript:void(0)" onclick="reg_write();" class="btn btn-sm btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">등록</span>
            </a>
            <table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
                <tr>
                    <th width='10'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
                    <th width='10'>상태</th>
                    <th>썸네일</th>
                    <th>제목</th>
                    <th>설명</th>
                    <th>금액(원)</th>
                    <th>배송비</th>
                    <th>재고</th>
                    <th>편집</th>
                </tr>
                <?
                if ($total_record) {
                    $i = $total_record - ($current_page - 1) * $record_count;

                    while ($row = mysql_fetch_array($result)) {
                        foreach ($row as $k => $v) {
                            ${$k} = $v;
                        }
                ?>
                        <tr class='grayLine'>
                            <td>
                                <input type="checkbox" name="chk[]" value="<?= $uid ?>" class="cMail">
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="status_<?= $uid ?>" class="switch-input" value='<?= $uid ?>' style="position:fixed" onchange="switch_able(this);" <? if ($status == 1) echo 'checked'; ?>>
                                    <span class="switch-label" data-on="활성" data-off="비활성"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </td>
                            <td><img src="<?= _UPLOAD_DIR . '/' . $upfile01 ?>" alt="썸네일" width='100'></td>
                            <td><?= $title ?></td>
                            <td><?= $exp ?></td>
                            <td><?= number_format($price) ?></td>
                            <td><?= number_format($shipPrice) ?></td>
                            <td>-</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-success btn-circle btn-sm" title='편집' onclick="reg_edit('<?= $uid ?>')">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                    <?
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan='16' style='padding:50px 0;text-align:center;'>등록된 상품이 없습니다.</td>
                    </tr>
                <?
                }
                ?>
            </table>
        </div>
    </div>
</form>

<script>
    function checkAble(uid) {
        GblMsgConfirmBox("상품을 비활성화 하시겠습니까?", "reg_disabled('" + uid + "')");
    }

    function checkDisabled(uid) {
        GblMsgConfirmBox("상품을 비활성화 하시겠습니까?", "reg_disabled('" + uid + "')");
    }

    function checkDel(uid) {
        GblMsgConfirmBox("영구삭제된 상품은 복구 되지 않습니다. 정말 삭제 하시겠습니까?", "delOK('" + uid + "')");
    }

    function reg_able(uid) {
        form = document.frm01;
        form.type.value = 'able';
        form.uid.value = uid;
        form.target = 'ifra_gbl';
        form.action = 'proc.php';
        form.submit();
    }

    function reg_disabled(uid) {
        form = document.frm01;
        form.type.value = 'disabled';
        form.uid.value = uid;
        form.target = 'ifra_gbl';
        form.action = 'proc.php';
        form.submit();
    }

    function delOK(uid) {
        form = document.frm01;
        form.type.value = 'del';
        form.uid.value = uid;
        form.target = 'ifra_gbl';
        form.action = 'proc.php';
        form.submit();
    }

    function reg_write() {
        form = document.frm01;
        form.type.value = 'write';
        form.action = 'index.php';
        form.submit();
    }

    function reg_modify(uid) {
        form = document.frm01;
        form.type.value = 'edit';
        form.uid.value = uid;
        form.action = 'index.php';
        form.submit();
    }
</script>