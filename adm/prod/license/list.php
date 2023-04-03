<?
$record_count = 10;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!($record_start)) $record_start = 0;

$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "where 1=1";

//상태
// if ($f_status == '0')        $query_ment .= " AND status='0'";
// elseif ($f_status == '1')    $query_ment .= " AND status='1'";

// 정렬
$sort_ment = "ORDER BY status DESC, uid DESC";
// if ($f_sort == 'rTime')$sort_ment = "order by rTime desc";
// else	$sort_ment = "order by uid desc";

$query = "SELECT * FROM ks_license $query_ment $sort_ment";
$result = mysql_query($query) or die(mysql_error());
$total_record = mysql_num_rows($result);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) {
	$total_page++;
}

$query .= " limit $record_start, $record_count";
$result = mysql_query($query);
?>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
    <input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
    <input type='hidden' name='type' value='<?= $type ?>'>
    <input type='hidden' name='uid' value=''>
    <input type='hidden' name='record_start' value='<?= $record_start ?>'>
    <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
    <input type='hidden' name='cType' value="user">
    <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>

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
            <?
            if($_SERVER['REMOTE_ADDR'] == '175.112.52.47') {?>
                <a href="javascript:void(0)" onclick="reg_write();" class="btn btn-sm btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">등록</span>
            </a>

            <?}?>
            <table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
                <tr>
                    <th width='10'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
                    <th width='10'>상태</th>
                    <th>자격증 과정</th>
                    <th>제목</th>
                    <th>카테고리</th>
                    <th>강좌목록</th>
                    <th>금액</th>
                    <th>클래스 구성 편집</th>
                    <!-- <th>자격증 시험 편집</th> -->
                    <th>편집</th>
                </tr>
                <?
                $nTime = time();

                if ($total_record) {
                    $i = $total_record - ($current_page - 1) * $record_count;

                    while ($row = mysql_fetch_array($result)) {
                        $uid = $row["uid"];
                        $status = $row["status"];
                        $prod_type = $row["prod_type"];
                        $cade01 = $row["cade01"];
                        $cade02 = $row["cade02"];
                        $title = $row["title"];
                        $price = $row["price"];
                        $discountPrice = $row["discountPrice"];
                        $rDate = $row["rDate"];
                        $upfile01 = $row["upfile01"];
                ?>
                        <tr class='grayLine'>
                            <td>
                                <input type="checkbox" name="chk[]" value="<?= $uid ?>" class="cMail">
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="status_<?= $uid ?>" value='<?= $uid ?>' class="switch-input" style="position:fixed" <? if ($status == 1) echo 'checked'; ?>>
                                    <span class="switch-label" data-on="활성" data-off="비활성"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </td>
                            <td><img src="<?= _UPLOAD_DIR . $upfile01 ?>" alt="썸네일" width='100'></td>
                            <td><?= $title ?></td>
                            <td>
                                <?
                                if ($cade01 != 0) $cade = sqlRowOne("SELECT title FROM ks_license_cade01 WHERE uid=$cade01");
                                if ($cade02 != 0) $cade .= "<br>&#8735; " . sqlRowOne("SELECT title FROM ks_license_cade02 WHERE uid=$cade02");
                                echo $cade;
                                ?>
                            </td>
                            <td>
                                <?
                                $title_row_arr = sqlArray("SELECT (SELECT title FROM ks_class WHERE ks_class.uid=ks_license_list.class_uid) AS title FROM ks_license_list WHERE license_uid='$uid'");
                                foreach ($title_row_arr as $key => $title_row) {
                                    echo "<p class='m0'>" . $title_row['title'] . "</p>";
                                }
                                ?>
                            </td>
                            <td>
                                <? if ($discountPrice != null) { ?>
                                    <span class="c_gry02 strkt"><?= number_format($price) ?></span><br>
                                    <span class="bold1"><?= number_format($discountPrice) ?></span>
                                <? } else { ?>
                                    <span class="bold1"><?= number_format($price) ?></span>
                                <? } ?>
                            </td>
                            <td>
                                <?
                                if ($prod_type == 'LICENSE_ONLINE') {
                                ?>
                                <span style="color:red;"><? echo sqlRowOne("SELECT COUNT(1) FROM ks_license_list WHERE license_uid='$uid'") ?>강</span>
                                <a href='./license_list/index.php?uid=<?= $uid ?>' class='btn btn-primary btn-circle btn-sm bora01'><i class="fas fa-info-circle"></i></a>
                                <?
                                } elseif ($prod_type === 'LICENSE_OFFLINE') {
                                ?>
                                    <span>오프라인</span>
                                <?
                                }
                                ?>
                            </td>
                            <!-- <td>
                                -
                                <span><? //echo sqlRowOne("SELECT COUNT(1) FROM ks_exam WHERE etype='LICENSE' AND class_uid='$uid'"); ?>문항</span>
                                <a href='./exam/index.php?uid=<?= $uid ?>'class='btn btn-info btn-circle btn-sm bora01'><i class="fas fa-info-circle"></i></a>
                            </td> -->
                            <td>
                                <a href="javascript:void(0)" class="btn btn-success btn-circle btn-sm" title='편집' onclick="reg_edit('<?= $uid ?>')">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                    <?
                        $i--;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan='16' style='padding:50px 0;text-align:center;'>등록된 과정이 없습니다.</td>
                    </tr>
                <?
                }
                ?>
            </table>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('.switch-input').change(function() {
            if ($(this).is(":checked")) status = '1';
            else status = '0';
            type = 'able';
            uid = $(this).val();

            $.post('./proc.php', {
                'type': type,
                'uid': uid,
                'status': status
            }, function() {});
        });
    })
</script>

<?
$fName = 'frm01';
include _WWW . '/module/pageNum.php';
?>