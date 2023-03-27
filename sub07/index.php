<?
include '../header.php';

$query = "SELECT * FROM ks_store";
$row_arr = sqlArray($query);
?>

<div class="subWrap">
    <div class="s_center">
        <div class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc">스토어</div>
        <div class="dp_f dp_wrap nVdSlickBox_04_wrap">
            <?
            if($_SERVER['REMOTE_ADDR'] == "106.246.92.23z7"){
            foreach($row_arr as $row) {
                foreach ($row as $k => $v) {
                    ${$k} = $v;
                }
            ?>
                <div class="nVdSlickBox">
                    <a href="./view.php?&code=<?= $uid ?>" title="">
                        <div class="imgWrap c_gry02 p_r" style="background-image:url('/upfile/store/<?= $upfile01 ?>');">
                            <button type="button" title="관심" class="likeMark"></button>
                            <img src="" alt="">
                        </div>
                        <div class="nVdCont">
                            <div class="nVdTop">
                                <p class="nVdtit01 bold2 dotdot"><?= $title ?></p>
                                <p class="nVdtit02 c_gry03 dotdot"><?= $exp ?></p>
                                <ul class="clickicon dp_f dp_c">
                                    <li class="dp_f dp_c">
                                        <img src="/images/likeChk_gry.png" alt="">
                                        <span><?= $wish ?></span>
                                    </li>
                                    <li class="dp_f dp_c">
                                        <img src="/images/bestChk_gry.png" alt="">
                                        <span><?= $like ?>%</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="nVdBot">
                                <? if ($isSale) { ?>
                                    <span class="c_red bold priceDet">46%</span>
                                <? } ?>
                                <span class="bold"><?= number_format($price) ?>원</span>
                            </div>
                        </div>
                    </a>
                </div>
            <? }} else { ?>
                <div style="width:100%; margin: 100px auto; text-align:center;">
                    <img src="https://www.imomtae.com/adm/img/repare.png" alt="not_ready">
                </div>
            <? } ?>
            <!-- <div class="nVdSlickBox">
            <a href="./view.php" title="">
               <div class="imgWrap c_gry02 p_r" style="background-image:url('../images/sum_2023_02.png');">
                  <button type="button" title="관심" class="likeMark"></button>
                  <img src="" alt="">
               </div>
               <div class="nVdCont">
                  <div class="nVdTop">
                     <p class="nVdtit01 bold2 dotdot">EMS 어깨 마사지기기</p>
                     <p class="nVdtit02 c_gry03 dotdot">최첨단 건강의료가전 어깨 저주파 마사지기기</p>
                     <ul class="clickicon dp_f dp_c">
                        <li class="dp_f dp_c">
                           <img src="/images/likeChk_gry.png" alt="">
                           <span>10884</span>
                        </li>
                        <li class="dp_f dp_c">
                           <img src="/images/bestChk_gry.png" alt="">
                           <span>97%</span>
                        </li>
                     </ul>
                  </div>
                  <div class="nVdBot">
                     <span class="c_red bold">46%</span>
                     <span class="priceDet bold">89,000원</span>
                  </div>
               </div>
            </a>
         </div> -->
        </div>
    </div>


    <?
    include '../footer.php';
    ?>