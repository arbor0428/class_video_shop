<?
include '/home/edufim/www/header.php';

// if progress not 80

// already passed

$member = sqlRow("SELECT * FROM ks_member WHERE userid='$GBL_USERID'");

$class = sqlRow("SELECT c.title, c.uid FROM ks_class c JOIN ks_learning l ON c.uid=l.class_uid WHERE l.uid=$uid");

$remained_num = sqlRowOne("SELECT remained_num FROM ks_cert_completion WHERE learning_uid='$uid'");
?>

<form class="form-cart" name="frm01" method="post" action="./test_form.php">
    <input type="hidden" name="learning_uid" value="<?= $uid ?>">
    <input type="hidden" name="class_uid" value="<?= $class['uid'] ?>">
    <input type="hidden" name="name" value="<?= $member['name'] ?>">
    <input type="hidden" name="ctitle" value="<?= $class['title'] ?>">
    <input type="hidden" name="edate" value="<?= date('Y-m-d') ?>">
    <div class="subWrap">
        <div class="s_center">
            <div class="test_goBox">
                <div class="test_go_top bora01 dp_sb">
                    <p class="test_go_top_tit dp_f dp_c">
                        <span class="dp_f dp_c bold2 c_w">에듀핌</span>
                        <span class="c_w">- <?= $class['title'] ?> [필기시험]</span>
                    </p>
                    <a class="test_closeBtn" href="/mypage/sub08.php" title="뒤로가기"><img src="/images/sub/test_go_x_icon.svg" alt=""></a>
                </div>
                <div class="test_go_bot">
                    <div class="gry04 test_gry_box">
                        <div class="row dp_f dp_c">
                            <div class="row_tit">응시자</div>
                            <div class="row_det"><?= $member['name'] ?> (<?= $GBL_USERID ?>)</div>
                        </div>
                        <div class="row dp_f dp_c">
                            <div class="row_tit">응시강좌</div>
                            <div class="row_det"><?= $class['title'] ?></div>
                        </div>
                        <div class="row dp_f dp_c">
                            <div class="row_tit">응시일</div>
                            <div class="row_det"><?= date('Y-m-d') ?></div>
                        </div>
                        <div class="row dp_f dp_c">
                            <div class="row_tit">잔여 응시기회</div>
                            <div class="row_det"><?= $remained_num ?>회</div>
                        </div>
                        <div class="row dp_f dp_c">
                            <div class="row_tit">영문 이름</div>
                            <div class="row_det"><input type="text" name="eng_name" value="<?= $member['eng_name'] ?>"></div>
                        </div>
                    </div>
                    <ul class="small_info_list">
                        <li>- (필수) 응시 전 수료증, 자격증에 표시할 영문 이름을 입력해주세요.</li>
                        <li>- 입력하신 영문 대/소문자, 띄어쓰기 형태 그대로 표기되니 정확하게 기재 부탁드립니다.</li>
                    </ul>
                    <p class="before_cau_tit c_bora01 bold2">시험 응시 전 유의사항</p>
                    <ul class="small_info_list">
                        <li>1. 시험 문항은 <span class="bold2">총 10문항 (객관식 4지선다)</span> 입니다.</li>
                        <li>2. 각 문항당 10점으로 전체 점수의 <span class="bold2">80점 이상 시 합격</span>입니다.</li>
                        <li>3. 시험 응시시 <span class="bold2">총 3번의 응시 기회</span>가 주어집니다.</li>
                        <li>4. 시험 응시 기회가 모두 소진되었을 경우, 추가 응시권을 구매 하셔야 합니다.</li>
                        <li>5. 시험문제 유출 방지를 위하여 종료 후 시험 문제를 다시 확인하는 것은 불가능합니다.</li>
                        <li>6. 원활한 시험 진행을 위해 <span class="bold2">PC에서 응시를 권장</span>드립니다.</li>
                    </ul>
                    <p class="test_btn_cau c_bora01">※ 시험 응시버튼을 클릭하는 순간 시험이 진행되며 시험 응시로 간주되오니 시험 시작에 신중해주세요.</p>

                    <?
                    if ($remained_num > 0) {
                    ?>
                        <div class="two_btn_wrap dp_f dp_c dp_cc">
                            <a class="two_btn dp_f dp_c dp_cc bold2 bora01 c_w" href="javascript:void(0)" onclick="GblMsgConfirmBox('시험 응시 회수가 차감됩니다.\n시험을 응시하겠습니까?', 'document.frm01.submit()')" title="시험응시">
                                시험 응시
                            </a>
                        <?
                    } else {
                        ?>
                            <p class="c_red01 txt-c">※ 시험 응시 잔여 회수가 없어 추가 결제 해야합니다. ※</p>
                            <div class="two_btn_wrap dp_f dp_c dp_cc">
                                <!-- <a class="two_btn dp_f dp_c dp_cc bold2 bora01 c_w" href="javascript:void(0)" onclick="GblMsgConfirmBox('결제 하겠습니까?', 'proc_order()')" title="시험응시"> -->
                                <a class="two_btn dp_f dp_c dp_cc bold2 bora01 c_w" href="javascript:void(0)" onclick="proc_order();" title="시험응시">
                                    결제하기
                                </a>
                            <?
                        }
                            ?>

                            <!-- <a class="two_btn dp_f dp_c dp_cc bold2 gry03 c_blk" href="javascript:void(0)" title="시험응시">
							응시기회 초과
						</a> -->

                            <a class="two_btn dp_f dp_c dp_cc bold2 c_bora01" href="/mypage/learning/" title="다음에응시">
                                다음에 응시
                            </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- 기기 정보 -->
        <input type='hidden' name='UserOS' value='<?= $UserOS ?>'>

        <input type='hidden' name='userid' value='<?= $GBL_USERID ?>'>
        <input type='hidden' name='prod_uid' value='<?= $prod_uid ?>'>
        <input type='hidden' name='test_uids' value='<?= $row['test_uids'] ?>'>
        <input type='hidden' name='type' value=''>
        <input type='hidden' name='buyChk' value='<?= $numB ?>'>
        <input type='hidden' name='amt' value='<?= $row['price'] ?>'>

        <input type='hidden' name='next_url' value='<?= $PHP_SELF ?>'>
        <input type='hidden' name='callChk' id='callChk' value='1'><!-- 모바일 결제창 호출용 -->
</form>

<script>
    const proc_order = function() {
        const form = document.frm01;
        
        if (form.UserOS.value == 'pc') {
            console.log(form.UserOS.value);
            
            // $('#couponListFrame').html("<iframe src='./coupon.php?userid=" + data.buyr_mail + "&use_coupon_uid=" + data.use_coupon_uid + "' name='couponListFrame' style='width:100%;height:655px;' frameborder='0' scrolling='auto'></iframe>");
            // $('.couponList_open').click();

            $('#pgFrame').html("<iframe src='about:blank' name='ifra_kcp' id='ifra_kcp' width='740' height='565' frameborder='0' scrolling='no'></iframe>");
            $(".pgBox_open").click();
            
            form.type.value = 'write';
            form.target = 'ifra_kcp';
            form.action = '/module/kcp/sample/order.html';
            form.submit();
            
        } else if (form.UserOS.value == 'mobile') {
            
            // console.log(form.UserOS.value);
            $('#pgFrame').html("<iframe src='about:blank' name='ifra_kcp' id='ifra_kcp' width='320' height='600' frameborder='0' scrolling='no'></iframe>");
            $(".pgBox_open").click();

            // form.type.value = 'write';
            // form.target = 'ifra_kcp';
            // form.action = '/module/kcp/mobile_sample/order_mobile.php';
            // form.submit();
        }
    }
</script>
<?
include '/home/edufim/www/footer.php';
?>