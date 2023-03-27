<?
include '../../header.php';
$side_menu = 2;
$topTxt01 = '알림';

$query = "SELECT * FROM tb_board_list WHERE table_id='table_1675005604'";
$row_arr = sqlArray($query);
?>

<?
include '../location01.php';
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="grytitBox dp_sb">
                <p class="dp_f dp_c">읽지 않은 알림<span class="f18 c_bora01 bold2" style="margin: 0 5px;"><?= sqlRowCount($query) ?></span>개</p>
                <div class="checkboxWrap readAllwrap">
                    <input type="checkbox" id="readAll">
                    <label for="readAll">모두 읽음 표시</label>
                </div>
            </div>

            <div class="alertListWrap">
                <? foreach ($row_arr as $key => $row) { ?>
                    <div class="alertList">
                        <div class="dp_sb dp_c">
                            <div class="alertTit read">[공지사항]<?= $row['title'] ?></div>
                            <div class="alertDet f14"><?= date('d일전', time() - intval($row['reg_date'])) ?></div>
                        </div>
                    </div>
                <? } ?>
            </div>

            <div id="js-btn-wrap">
                <a class="morescroll dp_f dp_c dp_cc bora01 c_w" href="" title="알림 확인 하기">알림 확인 하기 <img src="../images/s_down.svg" alt=""> </a>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $(".alertList").slice(0, 5).show(); // 최초 5개 선택
        $(".morescroll").click(function(e) { // Load More를 위한 클릭 이벤트e
            e.preventDefault();
            $(".alertList:hidden").slice(0, 10).show(); // 숨김 설정된 다음 10개를 선택하여 표시
            if ($(".alertList:hidden").length == 0) { // 숨겨진 DIV가 있는지 체크
                $('#js-btn-wrap').hide();
            }
        });
    });
</script>

<?
include '../../footer.php';
?>