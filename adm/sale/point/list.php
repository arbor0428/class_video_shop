<?
$record_count = 10;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!($record_start)) $record_start = 0;
$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "where uid>0";

//구분
// if ($f_ptype)	$query_ment .= " and ptype='$f_ptype'";

//아이디
// if ($f_userid)	 $query_ment .= " and userid like '%$f_userid%'";

//처리일 시작
// if ($f_sDate) {
// 	$f_sTime = strtotime($f_sDate);
// 	$query_ment .= " and rTime>='$f_sTime'";
// }

//처리일 종료
// if ($f_eDate) {
// 	$f_eTime = strtotime($f_eDate);
// 	$query_ment .= " and rTime<='$f_eTime'";
// }

$sort_ment = "ORDER BY uid DESC";

$query = "SELECT * FROM ks_point $query_ment $sort_ment";

$result = mysql_query($query) or die(mysql_error());
$total_record = mysql_num_rows($result);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) $total_page++;

$query2 = $query . " limit $record_start, $record_count";
$result = mysql_query($query) or die(mysql_error());
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
            <a href="javascript:void(0)" onclick="return; reg_write();" class="btn btn-sm btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">포인트지급</span>
            </a>
            <a href="javascript:void(0)" onclick="setPoint();" class="btn btn-sm btn-warning btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">포인트설정</span>
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
                    <th>구분</th>
                    <th>아이디</th>
                    <th>포인트</th>
                    <th>내용</th>
                    <th width='180'>처리일시</th>
                    <th width='10'>-</th>
                </tr>
                <?
                if ($total_record) {
                    $i = $total_record - ($current_page - 1) * $record_count;

                    while ($row = mysql_fetch_array($result)) {
                        $uid = $row["uid"];
                        $ptype = $row["ptype"];
                        $userid = $row["userid"];
                        $member_name = $row["member_name"];
                        $point = $row["point"];
                        $content = $row["content"];
                        $orderNum = $row["orderNum"];
                        $rDate = $row['rDate'];

                        if ($ptype == 'M') {
                            $ptxt = '사용';
                            $pico = "<span class='btn-danger btn-circle btn-sm'>-</span>";
                        } elseif ($ptype == 'P') {
                            $ptxt = '적립';
                            $pico = "<span class='btn-primary btn-circle btn-sm'>+</span>";
                        }
                ?>
                        <tr class='grayLine'>
                            <td>
                                <input type="checkbox" name="chk[]" value="<?= $uid ?>" class="cMail">
                            </td>
                            <td><?= $i ?></td>
                            <td><?= $ptxt ?></td>
                            <td><?= $userid ?> (<?= $member_name ?>)</td>
                            <td><?= $pico ?> <?= number_format($point) ?></td>
                            <td><?= $content ?></td>
                            <td><?= $rDate ?></td>
                            <td></td>
                        </tr>
                    <?
                        $i--;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan='6' style='padding:50px 0;text-align:center;'>포인트 내역이 없습니다.</td>
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
include '../../module/pageNum.php';
?>