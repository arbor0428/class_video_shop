<?
include "/home/edufim/www/adm/header.php";
$sideArr[1] = 'active';
$showArr[1] = 'show';
$subArr['best'] = 'active';
include _ADM . '/sidemenu.php';

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

$query = "SELECT c.*, c1.title c1t, c2.title c2t, l.*
FROM ks_class c
LEFT JOIN ks_class_cade01 c1 ON c.cade01=c1.uid
LEFT JOIN ks_class_cade02 c2 ON c.cade02=c2.uid
LEFT JOIN ks_best_list l ON c.uid=l.class_uid AND l.best_uid='$uid'";

$record_count = 10;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 수

if (!isset($record_start) || empty($record_start)) $record_start = 0;

$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

// else	$sort_ment = "order by uid desc";

// $query .= " JOIN ks_class c ON M.CLASS_UID=c.uid";
// $query .= " WHERE M.CLASS_UID IS NOT NULL";

$result = mysql_query("$query WHERE l.class_uid IS NOT NULL ORDER BY sort") or die(mysql_error());
$result2 = mysql_query("$query WHERE l.class_uid IS NULL ORDER BY c.status DESC") or die(mysql_error());
$total_record = mysql_num_rows($result2);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) {
    $total_page++;
}
$result2 = mysql_query("$query WHERE l.class_uid IS NULL ORDER BY c.status DESC LIMIT $record_start, $record_count") or die(mysql_error());


$data = array(
    'best_uid' => $uid,
    'class_uid' => null,
);
echo "<script>const data=" . json_encode($data) . "</script>";
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <? include _ADM . '/nav.php'; ?>
        <!-- Page Content -->
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <div class="col-sm mb-4">
                    <div class="card shadow mb-4" style='margin-top:10px;'>
                        <div class="card-body">
                            <div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
                                <div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
                                    <form name='frm01' action="./proc.php" method='post' ENCTYPE="multipart/form-data" class="user">
                                        <input type="text" style="display: none;">
                                        <input type='hidden' name='type' value=''>
                                        <input type='hidden' name='best_uid' value='<?= $uid ?>'>
                                        <input type='hidden' name='class_uid' value=''>
                                        <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] . "?uid=" . $uid ?>">
                                        <div class="m-0 font-weight-bold text-primary">추가목록</div>
                                        <table width="100%" cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
                                            <tr>
                                                <th width="65">상태</th>
                                                <th width="120">강좌</th>
                                                <th width="*">제목</th>
                                                <th width="175">카테고리 1</th>
                                                <th width="230">카테고리 2</th>
                                                <th width="125">금액(원)</th>
                                                <th width="65"></th>
                                            </tr>
                                            <?
                                            while ($row = mysql_fetch_assoc($result)) {
                                                if ($row['status'] == '0')     $statusTxt = "<span class='ico09'>비활성</span>";
                                                elseif ($row['status'] == '1') $statusTxt = "<span class='ico03'>활성</span>";
                                            ?>
                                                <tr class='grayLine'>
                                                    <td><?= $statusTxt ?></td>
                                                    <td><img src="/upfile/class/<?= $row['upfile01'] ?>" alt="썸네일" width='100'></td>
                                                    <td><?= $row['title'] ?></td>
                                                    <td><?= $row['c1t'] ?></td>
                                                    <td><?= $row['c2t'] ?></td>
                                                    <td>
                                                        <? if (is_null($row['discountPrice'])) { ?>
                                                            <span class="bold1"><?= number_format($row['price']) ?></span>
                                                        <? } else { ?>
                                                            <span class="c_gry02 strkt"><?= number_format($row['price']) ?></span><br>
                                                            <span class="bold1"><?= number_format($row['discountPrice']) ?></span>
                                                        <? } ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-danger btn-icon-split" onclick="removeClass('<?= $row['uid'] ?>')">
                                                            <span class="text">제거</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </table>
                                    </form>
                                    <form name='frm02' action="./proc.php" method='post' ENCTYPE="multipart/form-data" class="user">
                                        <input type="text" style="display: none;">
                                        <input type='hidden' name='type' value=''>
                                        <input type='hidden' name='best_uid' value='<?= $uid ?>'>
                                        <input type='hidden' name='class_uid' value=''>
                                        <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] . "?uid=" . $uid ?>">
                                        <input type='hidden' name='record_start' value='<?= $record_start ?>'>
                                        <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>
                                        <div class="mt-5 font-weight-bold text-primary">강의</div>
                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
                                            <tr>
                                                <th width="65">상태</th>
                                                <th width="120">강좌</th>
                                                <th width="*">제목</th>
                                                <th width="175">카테고리 1</th>
                                                <th width="230">카테고리 2</th>
                                                <th width="125">금액(원)</th>
                                                <th width="65"></th>
                                            </tr>
                                            <?
                                            while ($row = mysql_fetch_assoc($result2)) {
                                                if ($row['status'] == '0')     $statusTxt = "<span class='ico09'>비활성</span>";
                                                elseif ($row['status'] == '1') $statusTxt = "<span class='ico03'>활성</span>";
                                            ?>
                                                <tr class='grayLine'>
                                                    <td><?= $statusTxt ?></td>
                                                    <td><img src="/upfile/class/<?= $row['upfile01'] ?>" alt="썸네일" width='100'></td>
                                                    <td><?= $row['title'] ?></td>
                                                    <td><?= $row['c1t'] ?></td>
                                                    <td><?= $row['c2t'] ?></td>
                                                    <td>
                                                        <? if (is_null($row['discountPrice'])) { ?>
                                                            <span class="bold1"><?= number_format($row['price']) ?></span>
                                                        <? } else { ?>
                                                            <span class="c_gry02 strkt"><?= number_format($row['price']) ?></span><br>
                                                            <span class="bold1"><?= number_format($row['discountPrice']) ?></span>
                                                        <? } ?>
                                                    </td>
                                                    <td>
                                                        <? if ($row['status'] == '1') { ?>
                                                            <button class="btn btn-sm btn-success btn-icon-split" onclick="addClass('<?= $row['uid'] ?>')">
                                                                <span class="text">추가</span>
                                                            </button>
                                                        <? } ?>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </table>
                                    </form>
                                    <?
                                    $fName = 'frm02';
                                    include _WWW . '/module/pageNum.php';
                                    ?>

                                    <div style='width:100%;margin:40px 0 10px 0;text-align:center;'>
                                        <a href="javascript:void(0)" class="btn btn-secondary btn-icon-split" onclick="reg_list();">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-list"></i>
                                            </span>
                                            <span class="text">목록</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </div>

    <script>
        const removeClass = function(uid) {
            const form = document.frm01;
            form.type.value = 'REMOVE';
            form.best_uid.value = data.best_uid;
            form.class_uid.value = uid;
            form.submit();
        }
        const addClass = function(uid) {
            const form = document.frm02;
            form.type.value = 'ADD';
            form.best_uid.value = data.best_uid;
            form.class_uid.value = uid;
            form.submit();
        }

        const reg_list = function() {
            location.href = '/adm/class/best/'
        }
    </script>

    <!-- End of Main Content -->
    <?
    include _ADM . '/footer.php';
    ?>
</div>
<!-- End of Content Wrapper -->