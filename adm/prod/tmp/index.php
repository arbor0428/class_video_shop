<?
include "/home/edufim/www/adm/header.php";

$query = "SELECT * FROM kollus_video";
$result = mysql_query($query) or die("FAILED");

function setStatus($status)
{
    if ($status == '0')     return "<span class='ico01'>트랜스코딩중</span>";
    elseif ($status == '1') return "<span class='ico03'>활성</span>";
    elseif ($status == '2') return "<span class='ico09'>비활성</span>";
    elseif ($status == '3') return "<span class='ico05'>채널배포중</span>";
    elseif ($status == '4') return "<span class='ico08'>채널삭제됨</span>";
    // elseif ($status == '3') return "<span class='ico09'>영상삭제</span>";
    else return "<span class='ico10'>오류</span>";
}
?>

<style>
    .listTable td {
        text-align: center;
    }

    .set-class-list {
        border: 1px solid #4e73df;
        margin-bottom: 30px;
    }
</style>

<form name='frm01' action="<?= $_SERVER['PHP_SELF'] ?>" method='post' ENCTYPE="multipart/form-data" class="user" style="width: 100%;">
    <input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
    <!-- <input type='text' name='kollus_video_id' value='<?= $id ?>'> -->
    <!-- <input type='text' name='media_content_key' value='<?= $media_content_key ?>'> -->
    <!-- <input type='hidden' name='record_start' value='<?= $record_start ?>'> -->
    <!-- <input type='hidden' name='cType' value="user"> -->
    <!-- <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'> -->
    <div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
        <div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
            <div class="mb-2 font-weight-bold text-primary">Kollus 동영상 목록</div>
            <table width="100%" cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
                <tr>
                    <th>상태</th>
                    <th></th>
                    <th>제목</th>
                    <th>카테고리</th>
                    <th>채널</th>
                    <th>등록일</th>
                    <th>수정일</th>
                    <th>-</th>
                </tr>
                <?
                while ($row = mysql_fetch_assoc($result)) {
                    foreach ($row as $k => $v) {
                        ${$k} = $v;
                    }
                    if (strpos($full_filename, "/")) $category_name = explode('/', $full_filename)[0];
                    else $category_name = '-';
                ?>
                    <tr class='grayLine'>
                        <td><?= setStatus($status) ?></td>
                        <!-- <td><img src="/upfile/class/<?= $upfile01 ?>" alt="썸네일" width='100'></td> -->
                        <td></td>
                        <td><?= $filename ?></td>
                        <td><?= $category_name ?></td>
                        <td><?= $channel_name ?></td>
                        <td><?= $reg_date ?></td>
                        <td><?= $reg_date ?></td>
                        <td>
                            <? if ($status == 1 || $status == 3) {} ?>
                            <? if (true) { ?>
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-icon-split" onclick="select('<?= $id ?>', '<?= $media_content_key ?>', '<?= $filename ?>')">
                                <span class="text">선택</span>
                            </a>
                            <? } ?>
                        </td>
                    </tr>
                <? } ?>
            </table>
        </div>
    </div>
</form>

<script>
    const select = function(id, key, filename) {
        parent.frm01.kollus_video_id.value = id
        parent.frm01.kollus_video_filename.value = filename
        parent.frm01.media_content_key.value = key
        parent.frm01.key01.value = key
    }
</script>

<?
include _ADM . '/footer.php';
?>