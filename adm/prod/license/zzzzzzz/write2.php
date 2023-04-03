<?
include "/home/edufim/www/adm/header.php";

if ($class_uids != '') $ment = "c.uid NOT IN ($class_uids) AND";
else $ment = '';

$query = "SELECT c.*, c1.title c1t, c2.title c2t, l.*
FROM ks_class c
LEFT JOIN ks_class_cade01 c1 ON c.cade01=c1.uid
LEFT JOIN ks_class_cade02 c2 ON c.cade02=c2.uid
LEFT JOIN ks_license_list l ON c.uid=l.class_uid AND l.license_uid='$uid'
WHERE $ment c.prod_type='CLASS_ONLINE' AND l.class_uid IS NULL ORDER BY c.status DESC";

$record_count = 2;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 수

if (!$record_start) $record_start = 0;

$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

// else	$sort_ment = "order by uid desc";

// $query .= " JOIN ks_class c ON M.CLASS_UID=c.uid";
// $query .= " WHERE M.CLASS_UID IS NOT NULL";

$result2 = mysql_query("$query") or die(mysql_error());
$total_record = mysql_num_rows($result2);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) {
    $total_page++;
}
// $result2 = mysql_query("$query LIMIT $record_start, $record_count") or die(mysql_error());


$data = array(
    'license_uid' => $uid,
    'class_uid' => null,
);
echo "<script>const data=" . json_encode($data) . "</script>";
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="card-body">
        <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between m_10">
                <h5 class="m-0 font-weight-bold text-primary">1. 클래스 추가</h5>
            </div> -->
        <form name='frm01' action="./proc.php" method='post' class="user">
            <input type="text" style="display: none;">
            <input type='hidden' name='type' value='<?= $type ?>'>
            <input type='hidden' name='license_uid' value='<?= $uid ?>'>
            <input type='hidden' name='class_uid' value=''>
            <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>?type=write">
            <input type='hidden' name='record_start' value='<?= $record_start ?>'>
            <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>
            
            <div class="font-weight-bold text-primary">추가할 클래스를 추가해주세요</div>

            <table id="table02" cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
                <tr>
                    <th width="50">상태</th>
                    <th width="120">강좌</th>
                    <th width="*">제목</th>
                    <th width="200">카테고리 1</th>
                    <th width="200">카테고리 2</th>
                    <th width="20">기간</th>
                    <th width="125">금액(원)</th>
                    <th width="50">추가</th>
                </tr>
                <?
                while ($row = mysql_fetch_assoc($result2)) {
                    if ($row['status'] == '0')     $statusTxt = "<span class='ico09'>비활성</span>";
                    elseif ($row['status'] == '1') $statusTxt = "<span class='ico03'>활성</span>";
                ?>
                    <tr id="list_<?= $row['uid'] ?>" class='grayLine'>
                        <td><?= $statusTxt ?></td>
                        <td><img src="/upfile/class/<?= $row['upfile01'] ?>" alt="썸네일" width='100'></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['c1t'] ?></td>
                        <td><?= $row['c2t'] ?></td>
                        <td><?= $row['period'] ?></td>
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
                                <a class="btn btn-sm btn-success btn-icon-split" data-uid="<?= $row['uid'] ?>" data-title="<?= $row['title'] ?>" data-price="<?= $row['price'] ?>" data-dprice="<?= $row['discountPrice'] ?>" onclick="addClass(this)">
                                    <span class="text"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </a>
                                <!-- <a class="btn btn-sm btn-danger btn-icon-split" onclick="removeClass('<?= $row['uid'] ?>')">
                                    <span class="text"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                </a> -->
                            <? } ?>
                        </td>
                    </tr>
                <? } ?>
            </table>
        </form>

        <!-- <div style='width:100%;margin:40px 0 10px 0;text-align:center;'>
            <a href="javascript:void(0)" class="btn btn-success btn-icon-split" style="margin-left:20px;" onclick="console.log($('#multiBox'));">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">확인</span>
            </a>
        </div> -->
    </div>

    <?
    $fName = 'frm01';
    // include _WWW . '/module/pageNum.php';
    ?>
</div>

<script>
    const addClass = function(ele) {
        let dataset_dprice = ele.dataset.dprice;
        if (dataset_dprice == '') dataset_dprice = ele.dataset.price;

        const str = `<div id="class_info_${ele.dataset.uid}" data-price="${ele.dataset.price}" data-dprice="${dataset_dprice}">
          <input type="text" name="class_titles[]" id="class_titles" class="wid49" value="${ele.dataset.title}">
          <button type="button" class="btn-circle btn-danger btn-sm" onclick="removeClass(${ele.dataset.uid})" style="width: 1.1rem;height: 1.1rem;">
            <span class="text"><i class="fa fa-minus" aria-hidden="true"></i></span>
          </button>
          <input type="text" name="class_uids[]" id="class_uids" class="form-control" value="${ele.dataset.uid}">
        </div>`;

        parent.document.getElementById('class_info').insertAdjacentHTML('beforebegin', str);

        parent.document.frm01.price_tmp.value = comma(parseInt(uncomma(parent.document.frm01.price_tmp.value)) + parseInt(uncomma(ele.dataset.price)));

        parent.document.frm01.discountPrice_tmp.value = comma(parseInt(uncomma(parent.document.frm01.discountPrice_tmp.value)) + parseInt(uncomma(dataset_dprice)));

        $('tr').remove('#list_' + ele.dataset.uid);
    }
    const removeClass = function(uid) {
        // console.log('remove');
        // $('#table02').append($('#list_' + uid))
        // const form = document.frm01;
        // form.type.value = 'REMOVE';
        // form.license_uid.value = data.license_uid;
        // form.class_uid.value = uid;
        // form.submit();
    }
</script>