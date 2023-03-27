<?
$record_count = 10;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!($record_start)) $record_start = 0;
$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "where uid>0";

$sort_ment = "ORDER BY status DESC, uid DESC";

$query = "SELECT * FROM ks_coupon $query_ment $sort_ment";

$result = mysql_query($query) or die(mysql_error());
$total_record = mysql_num_rows($result);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) $total_page++;

$query2 = $query . " limit $record_start, $record_count";
$result = mysql_query($query) or die(mysql_error());

// 가입쿠폰
$config_coupon_uid = sqlRowOne("SELECT config_value FROM config_sale WHERE config_key='signup_coupon'");
?>


<form name='frm01' id='frm01' method='post' action="<?= $_SERVER['PHP_SELF'] ?>">
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
            <a href="javascript:void(0)" onclick="couponList();" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">쿠폰내역</span>
            </a>
            <a href="javascript:void(0)" onclick="setCoupon();" class="btn btn-sm btn-warning btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">쿠폰설정</span>
            </a>
            <!-- <a href="javascript:void(0)" onclick="ifra_xls();" class="btn btn-sm btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">엑셀다운로드</span>
            </a> -->

            <table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
                <tr>
                    <th width='10'></th>
                    <th width='10'>No</th>
                    <th width='10'>상태</th>
                    <th>쿠폰명</th>
                    <th>할인가격(원)</th>
                    <th>사용기간(일)</th>
                    <th>등록된이벤트</th>
                    <th>등록일</th>
                    <th>편집</th>
                </tr>
                <?
                if ($total_record) {
                    $i = $total_record - ($current_page - 1) * $record_count;

                    while ($row = mysql_fetch_array($result)) {
                        $uid = $row["uid"];
                        $status = $row['status'];
                        $title = $row["title"];
                        $discountPrice = $row["discountPrice"];
                        $discountPeriod = $row["discountPeriod"];
                        $rDate = $row["rDate"];

                        // if ($orderNum) {
                        // 	$status = '사용';
                        // 	//주문내역 uid값
                        // 	$orderUid = sqlRowOne("select orderId from ks_order where use_coupon_uid='" . $uid . "'");
                        // } else {
                        // 	$status = '미사용';
                        // 	$orderUid = '';

                        // 	//만료확인
                        // }

                        // if (strtotime($discountDate) > strtotime($rDate)) {
                        //     $status = "<span class='ico03'>활성</span>";
                        //     $dateColor = "style='color:#BC00FF;font-weight:600;'";
                        // } else {
                        //     $status = "<span class='ico10'>만료</span>";
                        //     $dateColor = "";
                        // }
                ?>
                        <tr class='grayLine'>
                            <td>
                                <input type="checkbox" name="chk[]" value="<?= $uid ?>" class="cMail">
                            </td>
                            <td><?= $i ?></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="status_<?= $uid ?>" value='<?= $uid ?>' class="switch-input" style="position:fixed" onchange="switchAble(this);" data-isset="<? echo ($uid == $config_coupon_uid) ? 1 : 0; ?>" <? if ($status == 1) echo 'checked'; ?>>
                                    <span class="switch-label" data-on="활성" data-off="비활성"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </td>
                            <td><?= $title ?></td>
                            <td><?= number_format($discountPrice) ?></td>
                            <td><?= $discountPeriod ?></td>
                            <td>
                                <ul style="margin:0;list-style:disc; display:inline-block;">
                                    <?
                                    if ($uid == $config_coupon_uid) echo "<li>회원가입쿠폰<br></li>";
                                    $arr_rows = sqlArray("SELECT title FROM ks_event WHERE coupon_uid='$uid'");
                                    foreach ($arr_rows as $key => $value) {
                                        echo "<li>" . $value['title'] . "<br></li>";
                                    }
                                    ?>
                                </ul>
                            </td>
                            <!-- <td class="c_bora01" <? echo $dateColor; ?>> ~ <?= $discountDate ?></td> -->
                            <td><?= $rDate ?></td>
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
                        <td colspan='10' style='padding:50px 0;text-align:center;'>쿠폰정보가 없습니다.</td>
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