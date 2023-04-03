<?
$side[$cade02] = "content_box_a03";
$side2[$cade03] = "on";

$cade01_row = sqlRow("SELECT * FROM ks_class_cade01 WHERE uid='$cade01' ORDER BY sort");
?>

<div class='sidemenu sidemenu02'>
    <a href="/sub01/index.php?cade01=<?= $cade01 ?>" class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc" title="<?= $cade01_row['title'] ?>"><?= $cade01_row['title'] ?></a>

    <?
    $cade02_row_arr = sqlArray("SELECT * FROM ks_class_cade02 WHERE cade01='$cade01' ORDER BY sort");
    foreach ($cade02_row_arr as $cade02_row) {
    ?>
        <ul class="sidemenu_list">
            <li class='<?= $side[$cade02_row['uid']] ?>'>
                <img src="/images/sub/arr_btn1.svg" alt="화살표">
                <a class="dp_sb dp_c" href='sub01.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02_row['uid'] ?>'><?= $cade02_row['title'] ?></a>
                <ul class="depth2">
                    <?
                    $cade03_row_arr = sqlArray("SELECT * FROM ks_class_cade03 WHERE cade01='$cade01' AND cade02=" . $cade02_row['uid'] . " ORDER BY sort");
                    foreach ($cade03_row_arr as $cade03_row) {
                    ?>
                        <li class='<?= $side2[$cade03_row['uid']] ?>'>
                            <a href="sub02.php?cade01=<?= $cade01 ?>&cade02=<?= $cade02_row['uid'] ?>&cade03=<?= $cade03_row['uid'] ?>" title="<?= $cade03_row['title'] ?>">
                                <?= $cade03_row['title'] ?>
                            </a>
                        </li>
                    <?
                    $j++;
                    }
                    ?>
                </ul>
            </li>
        </ul>
    <?
        $i++;
    }
    ?>
</div>

<script>
    var flag = true;
    $(".sidemenu02 .sidemenu_list > li > img").click(function() {

        if ($(this).parent().hasClass("content_box_a03")) {

            $(this).parent().removeClass("content_box_a03");
            $(this).siblings(".depth2").stop().slideUp();

        } else {

            $(this).parent().addClass("content_box_a03");
            $(this).parent().siblings().children(".depth2").stop().hide();
            $(this).siblings(".depth2").stop().slideDown();

        }
    });
</script>