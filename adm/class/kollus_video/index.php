<?
include "/home/edufim/www/adm/header.php";

$query = "SELECT * FROM kollus_video ORDER BY status=2 DESC";
$result = mysql_query($query) or die(mysql_error());

function setStatus($status)
{
    $kollusStatusMap = array(
        '0'     =>  '<span class="ico07">인코딩중</span>',
        '1'     =>  '<span class="ico10">채널등록대기</span>',
        '2'     =>  '<span class="ico03">활성</span>',
        '3'     =>  '<span class="ico08">비활성</span>',
        '11'    =>  '<span class="ico09">인코딩실패</span>',
        '99'    =>  '<span class="ico09">관리자문의</span>',
    );
    return $kollusStatusMap[$status];
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
<!-- <div>
    <span class='ico01'>ico01</span><br>
    <span class='ico02'>ico02</span><br>
    <span class='ico03'>ico03</span><br>
    <span class='ico04'>ico04</span><br>
    <span class='ico05'>ico05</span><br>
    <span class='ico06'>ico06</span><br>
    <span class='ico07'>ico07</span><br>
    <span class='ico08'>ico08</span><br>
    <span class='ico09'>ico09</span><br>
    <span class='ico10'>ico10</span><br>
    <span class='ico11'>ico11</span><br>
    <span class='sco01'>sco01</span><br>
    <span class='sco02'>sco02</span><br>
    <span class='sco03'>sco03</span><br>
    <span class='sco04'>sco04</span><br>
    <span class='sco05'>sco05</span><br>
    <span class='sco06'>sco06</span><br>
    <span class='sco07'>sco07</span><br>
    <span class='ssco01'>ssco01</span><br>
    <span class='ssco02'>ssco02</span><br>
    <span class='ssco03'>ssco03</span><br>
    <span class='ssco04'>ssco04</span><br>
    <span class='ssco05'>ssco05</span><br>
    <span class='ssco06'>ssco06</span><br>
    <span class='ssco07'>ssco07</span><br>
</div> -->
<form name='kollus_frm' method='post' ENCTYPE="multipart/form-data" class="user" style="width: 100%;">
    <input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
    <input type="hidden" name="index" value="<?= $index ?>">
    <input type="hidden" name="id" value="">
    <input type="hidden" name="kollus_video_id" value="">
    <input type="hidden" name="filename" value="">
    <div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
        <div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
            <div class="mb-2 font-weight-bold text-primary">Kollus 동영상 목록</div>
            <table width="100%" cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
                <tr>
                    <th>상태</th>
                    <th>영상</th>
                    <th>제목</th>
                    <th>길이</th>
                    <th>카테고리</th>
                    <th>채널</th>
                    <th>등록일</th>
                    <th>-</th>
                </tr>
                <?
                while ($row = mysql_fetch_assoc($result)) {
                    foreach ($row as $k => $v) {
                        ${$k} = $v;
                    }

                    if (strpos($full_filename, "/")) $category_name = substr(explode('/', $full_filename)[0], 1);
                    else $category_name = '없음';

                    $_length = gmdate('H:i:s', $length);
                    $_reg_date = date('Y-m-d H:i', strtotime($reg_date));
                ?>
                    <tr class='grayLine'>
                        <td><?= setStatus($status) ?></td>
                        <!-- <td><img src="/upfile/class/<?= $upfile01 ?>" alt="썸네일" width='100'></td> -->
                        <td><img src="<?= $snapshot_url ?>" alt="썸네일" width='100'></td>
                        <td><?= $filename ?></td>
                        <td><?= $_length ?></td>
                        <td><?= $category_name ?></td>
                        <td><?= $channel_name ?></td>
                        <td><?= $_reg_date ?></td>
                        <!-- <td><?= $reg_date ?></td> -->
                        <td>
                            <? if ($status == 1 || $status == 3) {
                            } ?>
                            <? if ($status == '2') { ?>
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-icon-split" onclick="select('<?= $id ?>')">
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
    let value1 = '<?= $value1 ?>';

    const select = function(id) {
        // const filename_split = filename.split('.')
        // const title = filename.replace('.' + filename_split[filename_split.length - 1], '')

        parent.document.getElementById(value1).value = id;
        parent.document.getElementById(value1).dispatchEvent(new Event('change'))
        parent.$('.multiBox_close').click();

        
        // if (index == 0 && last_sort == 0) {
        //     parent.frm01['kollus_video_id[]'].value = id
        //     parent.frm01['kollus_video_filename[]'].value = filename
        //     parent.frm01['title[]'].value = title
        //     parent.frm01['length[]'].value = length
        // } else {
        //     parent.frm01['kollus_video_id[]'][parseInt(index)].value = id
        //     parent.frm01['kollus_video_filename[]'][parseInt(index)].value = filename
        //     parent.frm01['title[]'][parseInt(index)].value = title
        //     parent.frm01['length[]'][parseInt(index)].value = length
        // }

    }
</script>

<?
include _ADM . '/footer.php';
?>