<?php
$record_count = 10;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!($record_start)) $record_start = 0;
echo "<script>console.log('$record_start')</script>";

$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "WHERE 1=1";

//상태
if ($f_status == '0')        $query_ment .= " AND status='0'";
elseif ($f_status == '1')    $query_ment .= " AND status='1'";
else                         $query_ment .= " AND status='1'";

//선생님
if ($f_tuid) $query_ment .= " AND tuid='$f_tuid'";

//분류
if ($f_cade01) $query_ment .= " AND cade01='$f_cade01'";
if ($f_cade02) $query_ment .= " AND cade02='$f_cade02'";
if ($f_cade03) $query_ment .= " AND cade03='$f_cade03'";

// 검색어
if ($f_title) $query_ment .= " AND title LIKE '%$f_title%'";

$sort_ment = "ORDER BY status DESC, cade01, cade02, cade03, title DESC";

$teacher = ", (SELECT name FROM ks_member WHERE ks_member.uid=ks_class.tuid) AS tname";

$query = "SELECT *, (SELECT name FROM ks_member WHERE ks_member.uid=ks_class.tuid) AS tname FROM ks_class $query_ment $sort_ment";
$result = mysql_query($query) or die(mysql_error());
$total_record = mysql_num_rows($result);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) $total_page++;

$query .= " limit $record_start, $record_count";
$result = mysql_query($query) or die(mysql_error());
?>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <?
        include './search.php';
        ?>
    </div>
    <input type="text" style="display: none;">
    <input type='hidden' name='type' value='<?= $type ?>'>
    <input type='hidden' name='uid' value=''>
    <input type='hidden' name='record_start' value='<?= $record_start ?>'>
    <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
    <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>

    <!-- <div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
        <span class="scorll-hand">
            <img src="/common/adm/images/scroll_hand.gif" style="max-width:100%;">
        </span>
    </div> -->

    <div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
        <div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
            <a href="javascript:void(0)" onclick="reg_write();" class="btn btn-sm btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">등록</span>
            </a>
            <a href="./cade/" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-bars-sort"></i>
                </span>
                <span class="text">카테고리</span>
            </a>
            <a href="../kollus_video/" class="btn btn-sm btn-warning btn-icon-split">
                <!-- <span class="icon text-white-50">
                    <i class="fa-solid fa-bars-sort"></i>
                </span> -->
                <span class="text">kollus</span>
            </a>
            <table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
                <tr>
                    <th width='10'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
                    <th width='10'>상태</th>
                    <th></th>
                    <th>제목</th>
                    <th>카테고리</th>
                    <th>선생님</th>
                    <th width='70'>금액(원)</th>
                    <th width='70'>기간(일)</th>
                    <th>영상 편집</th>
                    <th>수료 시험 편집</th>
                    <!-- <th>등록일</th> -->
                    <th>편집</th>
                </tr>
                <?
                if ($total_record) {
                    $i = $total_record - ($current_page - 1) * $record_count;

                    while ($row = mysql_fetch_array($result)) {
                        $uid = $row["uid"];
                        $status = $row["status"];
                        $prod_type = $row["prod_type"];
                        $cade01 = $row["cade01"];
                        $cade02 = $row["cade02"];
                        $cade03 = $row["cade03"];
                        // $cade04 = $row["cade04"];
                        $title = $row["title"];
                        $price = $row["price"];
                        $discountPrice = $row["discountPrice"];
                        $rDate = $row["rDate"];
                        $period = $row['period'];
                        $upfile01 = $row["upfile01"];
                        $tname = $row['tname'];
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
                            <td><img src="<?= _UPLOAD_DIR . $upfile01 ?>" alt="썸네일" width='100'></td>
                            <td><?= $title ?></td>
                            <td>
                                <?
                                if ($cade01) $cade = sqlRowOne("SELECT title FROM ks_class_cade01 WHERE uid=$cade01");
                                if ($cade02) $cade .= "<br>&#8735; " . sqlRowOne("SELECT title FROM ks_class_cade02 WHERE uid=$cade02");
                                if ($cade03) $cade .= "<br>&#8735; " . sqlRowOne("SELECT title FROM ks_class_cade03 WHERE uid=$cade03");
                                // if ($cade04) $cade .= "<br>&#8735; " . sqlRowOne("SELECT title FROM ks_class_cade04 WHERE uid=$cade04");
                                echo $cade;
                                ?>
                            </td>
                            <td><?= $tname ?></td>
                            <td>
                                <? if ($discountPrice != null) { ?>
                                    <span class="c_gry02 strkt"><?= number_format($price) ?></span><br>
                                    <span class="bold1"><?= number_format($discountPrice) ?></span>
                                <? } else { ?>
                                    <span class="bold1"><?= number_format($price) ?></span>
                                <? } ?>
                            </td>
                            <td><?= $period ?></td>
                            <td>
                                <?
                                if ($prod_type == 'CLASS_ONLINE') {
                                ?>
                                    <span><? echo sqlRowOne("SELECT COUNT(1) FROM ks_class_list WHERE class_uid='$uid'") ?>강</span>
                                    <a href='./class_list/index.php?uid=<?= $uid ?>' class='btn btn-primary btn-circle btn-sm bora01'><i class="fas fa-info-circle"></i></a>
                                <?
                                } elseif ($prod_type === 'CLASS_OFFLINE') {
                                ?>
                                    <span>오프라인</span>
                                <?
                                }
                                ?>
                            </td>
                            <td>
                                <span><? echo sqlRowOne("SELECT COUNT(1) FROM ks_exam WHERE etype='CLASS' AND class_uid='$uid'"); ?>문항</span>
                                <a href='./exam/index.php?uid=<?= $uid ?>' class='btn btn-info btn-circle btn-sm bora01'><i class="fas fa-info-circle"></i></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-success btn-circle btn-sm" title='편집' onclick="reg_edit('<?= $uid ?>')">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <!-- <a href="javascript:checkDisabled('<?= $uid ?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'> -->
                                <!-- <a href="javascript:reg_del_confirm('<?= $uid ?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'>
                                    <i class="fas fa-trash"></i>
                                </a> -->
                            </td>
                        </tr>

                    <?
                        $i--;
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

<?
$fName = 'frm01';
include _WWW . '/module/pageNum.php';
?>