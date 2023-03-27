<?php

$query = "SELECT *";
$query .= " FROM ks_order";

$result = mysql_query($query) or die("연결실패");
$total_record = mysql_num_rows($result);

?>

<style>
    .listTable td {
        text-align: center;
    }
</style>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
    <input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
    <input type='hidden' name='type' value='<?= $type ?>'>
    <input type='hidden' name='uid' value=''>
    <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">

    <div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
        <span class="scorll-hand">
            <img src="/common/adm/images/scroll_hand.gif" style="max-width:100%;">
        </span>
    </div>

    <div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
        <div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">

            <a href="javascript:reg_write();" class="btn btn-sm btn-success btn-icon-split" style="margin-top:-5px;">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">등록</span>
            </a>

            <table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
                <tr>
                    <th width='*'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
                    <!-- <th width='70'>번호</th> -->
                    <th width='*'>상태</th>
                    <th width='*'>주문번호</th>
                    <th width='*'>주문자</th>
                    <th width='*'>주문내용</th>
                    <th width='*'>결제대기</th>
                    <th width='*'>반품요청</th>
                    <th width='*'>입금대기</th>
                    <th width='*'>결제완료</th>
                    <th width='*'>주문금액</th>
                    <th width='*'>주문일</th>
                    <th width='*'>편집</th>
                </tr>
                <?
                $nTime = time();

                if ($total_record) {
                    // $i = $total_record - ($current_page - 1) * $record_count;

                    while ($row = mysql_fetch_array($result)) {
                        foreach ($row as $k => $v) {
                            ${$k} = $v;
                        }
                        if ($status == '0')     $statusTxt = "<span class='ico10'>결제대기</span>";
                        elseif ($status == '1') $statusTxt = "<span class='ico03'>결제완료</span>";
                        elseif ($status == '2') $statusTxt = "<span class='ico06'>배송준비중</span>";
                        elseif ($status == '3') $statusTxt = "<span class='ico17'>배송중</span>";
                        elseif ($status == '4') $statusTxt = "<span class='ico17'>배송완료</span>";
                        elseif ($status == '5') $statusTxt = "<span class='ico17'>반품신청</span>";
                        elseif ($status == '5') $statusTxt = "<span class='ico17'>교환신청</span>";
                        elseif ($status == '5') $statusTxt = "<span class='ico17'>반품접수</span>";
                        elseif ($status == '5') $statusTxt = "<span class='ico17'>교환접수</span>";
                ?>
                        <tr class='grayLine'>
                            <td>
                                <input type="checkbox" name="chk[]" value="<?= $uid ?>" class="cMail">
                            </td>
                            <td><?= $statusTxt ?></td>
                            <td><?= $orderId ?></td>
                            <td><?= $userid ?></td>
                            <td><?= $title ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?= number_format($amount) ?> 원</td>
                            <td><?= $rDate ?></td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-success btn-circle btn-sm" title='수정' onclick="reg_modify('<?= $uid ?>')">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <!-- <a href="javascript:checkDisabled('<?= $uid ?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'> -->
                                <a href="javascript:checkDel('<?= $uid ?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'>
                                    <i class="fas fa-trash"></i>
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