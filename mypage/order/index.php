<?
include '../../header.php';

if (!isLogin()) redirectLogin();

if (!isset($class_uids)) {
    $MSG->goNext_New("/mypage/cart/");
    exit;

} else if (count($class_uids) <= 0) {
    $MSG->goNext_New("/mypage/cart/");
    exit;

} else {
    $clause = "(";
    foreach ($class_uids as $key => $class_uid) {
        $clause .= ($key != count($class_uids) - 1) ? $class_uid . "," : $class_uid . ")";
    }
    $query = "SELECT * FROM ks_class WHERE uid IN $clause";

    $orderArr = sqlArray($query);
    $numOforder = sqlRowCount($query);
    $member = sqlRow("SELECT name, point FROM ks_member WHERE userid='$GBL_USERID'");

    $buyr_name = $member['name'];
    $point = $member['point'];
    $use_coupon_price = 0;
    $use_point = 0;

    $data = array();

    if (count($orderArr) > 1) $good_name = $orderArr[0]['title'] . " 외 " . ($numOforder - 1) . "건";
    else $good_name = $orderArr[0]['title'] . " " . $numOforder . "건";

    $class_uids_str = '';
    foreach ($class_uids as $class_uid) {
        $class_uids_str .= $class_uid . "|";
    }
    $class_uids = substr($class_uids_str, 0, -1);

    $data['site_cd'] = 'T0000';
    $data['site_name'] = 'EDUFIM';

    $data['buyr_name'] = $buyr_name;
    $data['buyr_mail'] = $GBL_USERID;

    $data['good_name'] = $good_name;
    $data['good_mny'] = $good_mny;

    $data['class_uids'] = $class_uids;
    $data['price'] = $price;
    $data['discountPrice'] = $discountPrice;
    $data['use_coupon_price'] = $use_coupon_price;
    $data['point'] = $point;
    $data['use_point'] = $use_point;

    echo "<script>var data = " . json_encode($data) . "</script>";
}
?>
<script type="text/javascript">
    /****************************************************************/
    /* m_Completepayment  설명                                      */
    /****************************************************************/
    /* 인증완료시 재귀 함수                                         */
    /* 해당 함수명은 절대 변경하면 안됩니다.                        */
    /* 해당 함수의 위치는 payplus.js 보다먼저 선언되어여 합니다.    */
    /* Web 방식의 경우 리턴 값이 form 으로 넘어옴                   */
    /****************************************************************/
    function m_Completepayment(FormOrJson, closeEvent) {
        var frm = document.order_info;

        /********************************************************************/
        /* FormOrJson은 가맹점 임의 활용 금지                               */
        /* frm 값에 FormOrJson 값이 설정 됨 frm 값으로 활용 하셔야 됩니다.  */
        /* FormOrJson 값을 활용 하시려면 기술지원팀으로 문의바랍니다.       */
        /********************************************************************/
        GetField(frm, FormOrJson);


        if (frm.res_cd.value == "0000") {
            // alert("결제 승인 요청 전,\n\n반드시 결제창에서 고객님이 결제 인증 완료 후\n\n리턴 받은 ordr_chk 와 업체 측 주문정보를\n\n다시 한번 검증 후 결제 승인 요청하시기 바랍니다."); //업체 연동 시 필수 확인 사항.
            /*
                가맹점 리턴값 처리 영역
            */
            const ordr_chk_val = frm.ordr_chk.value.split('|');

            if (ordr_chk_val[0] === frm.ordr_idxx.value && ordr_chk_val[1] === frm.good_mny.value) {
                frm.submit();
            } else {
                alert("잘못된 접근입니다");
                closeEvent();
                location.reload(true);
            }
        } else {
            alert("[" + frm.res_cd.value + "] " + frm.res_msg.value);

            closeEvent();
        }
    }
</script>
<script type="text/javascript" src="https://testpay.kcp.co.kr/plugin/payplus_web.jsp"></script>
<script type="text/javascript">
    /* 표준웹 실행 */
    function jsf__pay(form) {
        try {
            // console.log(data);return;
            // form.usable_point.value = data.point

            form.class_uids.value = data.class_uids;

            form.price.value = data.price;
            form.discountPrice.value = data.discountPrice;
            form.use_point.value = data.use_point;

            form.site_cd.value = data.site_cd;
            form.site_name.value = data.site_name;

            form.buyr_name.value = data.buyr_name;
            form.buyr_mail.value = data.buyr_mail;

            form.ordr_idxx.value = data.buyr_mail.split('@')[0].toUpperCase() + (new Date().getTime()).toString();
            form.good_name.value = data.good_name;
            form.good_mny.value = data.good_mny;

            if (form.UserOS.value == 'pc') {
                form.pay_method.value = '100000000000';

                form.action = "result.php";
                KCP_Pay_Execute(form);

            } else if (form.UserOS.value == 'mobile') {
                form.pay_method.value = 'CARD';
                // form.van_code.value = ''

                form.action = "kcp_api_trade_reg.php";
                form.submit();
            }
            
        } catch (e) {
            /* IE 에서 결제 정상종료시 throw로 스크립트 종료 */
            console.log(e);
        }
    }
</script>

<div class="subWrap">
    <div class="s_center dp_sb">
        <div class="s_cont" style="margin: 0 auto;">

            <form class="form-cart" name="order_info" method="post" action="result.php">
                <div class="s_cont_tit f20 bold2 c_bora01 nobrb">주문상품정보</div>
                <div class="tableWrap">
                    <table class="subTbl">
                        <colgroup>
                            <col style="width: 80%;">
                            <col style="width: 20%;">
                        </colgroup>
                        <tbody>
                            <tr class="brb000">
                                <th>상품정보</th>
                                <th>금액</th>
                            </tr>

                            <?
                            foreach ($orderArr as $order) {
                            ?>
                                <tr>
                                    <td>
                                        <div class="dp_f">
                                            <div class="imgWrap gry">
                                                <img src="/upfile/class/<?= $order['upfile01'] ?>" alt="<?= $order['title'] ?>" width="150">
                                            </div>
                                            <div class="cart_tit">
                                                <p class="cart_tit01 bold2 txt-l"><?= $order['title'] ?></p>
                                                <p class="c_gry04 f14 txt-l"><?= $order['exp'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>

                                        <? if ($order['discountPrice'] == null) { ?>
                                            <span class="f14 f18 bold2"><?= number_format($order['price']) ?></span>
                                            <span class="f14" style="margin-left:3px;">원</span>
                                        <? } else { ?>
                                            <p class="c_gry03" style="text-decoration: line-through;text-decoration-color:#000;"><?= number_format($order['price']) ?>원</p>
                                            <span class="f14 f18 bold2"><?= number_format($order['discountPrice']) ?></span>
                                            <span class="f14" style="margin-left:3px;">원</span>
                                        <? } ?>

                                    </td>
                                </tr>
                            <? } ?>

                        </tbody>
                    </table>
                </div>

                <div class="tableWrap" style="margin-top: 20px;">
                    <p class="discount_tit f18 bold2">할인 금액</p>
                    <table class="subTbl brbt0">
                        <colgroup>
                            <col style="width: 15%;">
                            <col style="width: 85%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="txt-l">쿠폰 할인</th>
                                <td class="txt-l">
                                    <input type="hidden" name="use_coupon_uid" value="0" readonly>
                                    <input type="hidden" name="use_coupon_price" value="0" readonly>
                                    <input type="hidden" name="use_coupon_time" value="0" readonly>
                                    <input type="text" name="use_coupon_title" class="gryinput" style="width:30%;" value="" readonly>
                                    <a class="couponBtn bora01 c_w dp_f dp_c dp_cc couponListopen" href="javascript:void(0)" onclick="coupon()" title="쿠폰 적용">쿠폰 적용</a>
                                </td>
                            </tr>
                            <tr>
                                <th class="txt-l">적립금 사용</th>
                                <td class="txt-l">
                                    <input class="gryinput input_won " type="text" name="use_point" value="" maxlength="8" onchange="setOrderData();" onkeyup="setPoint(this);">
                                    <span class="f12">원</span>
                                    <span class="f14">(사용가능 적립금 <span class="bold c_bora01" style="margin: 0 3px;"><?= number_format($point) ?></span>원)</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tableWrap" style="margin-top: 20px;">
                    <p class="discount_tit f18 bold2">결제 방법</p>
                    <table class="subTbl brbt0">
                        <colgroup>
                            <col style="width: 15%;">
                            <col style="width: 85%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="txt-l">결제 방식</th>
                                <td class="txt-l selectwrap">
                                    <select name="pay_type" id="pay_type" class="form-control">
                                        <option value="">선택</option>
                                        <option value="100000000000">신용카드</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="totalAmtWrap dp_sb m-50">
                    <div class="wid50">
                        <p class="f20 bold2">총 결제금액</p>
                    </div>
                    <div class="tableWrap wid50">
                        <table class="subTbl02">
                            <tbody>
                                <tr>
                                    <th>결제상품 수</th>
                                    <td><span id="numOfProd"><?= $numOfProd ?></span>개</td>
                                </tr>
                                <tr>
                                    <th>상품금액</th>
                                    <td><span id="price"><?= number_format($price) ?></span>원</td>
                                </tr>
                                <tr>
                                    <th>할인금액</th>
                                    <td>-&nbsp;<span id="discountPrice"><?= number_format($discountPrice) ?></span>원</td>
                                </tr>

                                <tr>
                                    <th>쿠폰사용</th>
                                    <td>-&nbsp;<span id="use_coupon_price">0</span>원</td>
                                </tr>

                                <tr>
                                    <th>적립금</th>
                                    <td>-&nbsp;<span id="use_point">0</span>원</td>
                                </tr>

                                <tr>
                                    <th>배송비</th>
                                    <td>-&nbsp;<span id="shippingFee"><?= number_format($shippingFee) ?></span>원</td>
                                </tr>

                                <tr class="totalTrWrap">
                                    <th>최종 결제금액</th>
                                    <td><span id="good_mny" class="f20 bold2 c_bora01" style="margin: 0 5px;"><?= number_format($good_mny) ?></span>원</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="twoBtnWrap dp_f dp_cc m-40 m_40">
                    <a class="bora01 c_w dp_f dp_c dp_cc" href="javascript:void(0)" onclick="jsf__pay(document.order_info)" title="결제하기">결제하기</a>
                </div>

                <!-- 기기 정보 -->
                <input type='hidden' name='UserOS' value='<?= $UserOS ?>'>

                <!-- 모바일 -->
                <!-- 리턴 URL (kcp와 통신후 결제를 요청할 수 있는 암호화 데이터를 전송 받을 가맹점의 주문페이지 URL) -->
                <input type="hidden" name="Ret_URL" value="http://edupimcampus.com/mypage/order/result.php" />
                <input type="hidden" name="user_agent" value="" /> <!--사용 OS-->
                <!--<input type="hidden"   name="site_cd"         value="T0000" />--> <!--사이트코드-->

                <!-- 인증시 필요한 파라미터(변경불가)-->
                <!-- <input type="hidden" name="pay_method"      value=""> -->
                <input type="hidden" name="van_code" value="">

                <!-- PC -->
                <!-- 사용자 정보 -->
                <input type="hidden" name="class_uids" value="<?= ($class_uids) ?>" readonly>
                <input type="hidden" name="price" value="" readonly>
                <input type="hidden" name="discountPrice" value="" readonly>
                <!-- <input type="hidden" name="use_point" value="" readonly> -->

                <!-- 가맹점 정보 설정-->
                <input type="hidden" name="site_cd" value="<?= $site_cd ?>" />
                <input type="hidden" name="site_name" value="<?= $site_name ?>" />

                <input type="hidden" name="buyr_name" value="<?= $buyr_name ?>" />
                <input type="hidden" name="buyr_mail" value="<?= $GBL_USERID ?>" />
                <!-- 
                ※필수 항목
                표준웹에서 값을 설정하는 부분으로 반드시 포함되어야 합니다.값을 설정하지 마십시오
                -->
                <input type="hidden" name="ordr_idxx" />
                <input type="hidden" name="good_name" value="<?= $good_name ?>" />
                <input type="hidden" name="good_mny" value="<?= $good_mny ?>" maxlength="9" />

                <input type="hidden" name="res_cd" value="" />
                <input type="hidden" name="res_msg" value="" />
                <input type="hidden" name="enc_info" value="" />
                <input type="hidden" name="enc_data" value="" />
                <input type="hidden" name="ret_pay_method" value="" />
                <input type="hidden" name="tran_cd" value="" />
                <input type="hidden" name="use_pay_method" value="" />
                <!-- 주문정보 검증 관련 정보 : 표준웹 에서 설정하는 정보입니다 -->
                <input type="hidden" name="ordr_chk" value="" />
                <!--  현금영수증 관련 정보 : 표준웹 에서 설정하는 정보입니다 -->
                <input type="hidden" name="cash_yn" value="" />
                <input type="hidden" name="cash_tr_code" value="" />
                <input type="hidden" name="cash_id_info" value="" />

                <!-- 
                ====================================================
                                 추가 옵션 정보
                                ※ 옵션 - 결제에 필요한 추가 옵션 정보를 입력 및 설정합니다. 
                ====================================================
                -->

                <!--사용카드 설정 여부 파라미터 입니다.(통합결제창 노출 유무) -->
                <!-- <input type="hidden" name="used_card_YN"        value="Y" /> -->
                <!-- 사용카드 설정 파라미터 입니다. (해당 카드만 결제창에 보이게 설정하는 파라미터입니다. used_card_YN 값이 Y일때 적용됩니다. -->
                <!-- <input type="hidden" name="used_card"        value="CCBC:CCKM:CCSS" /> -->

                <!--
                           신용카드 결제시 OK캐쉬백 적립 여부를 묻는 창을 설정하는 파라미터 입니다
                            포인트 가맹점의 경우에만 창이 보여집니다
                -->
                <!-- <input type="hidden" name="save_ocb"        value="Y" /> -->

                <!-- 고정 할부 개월 수 선택
                value값을 "7" 로 설정했을 경우 => 카드결제시 결제창에 할부 7개월만 선택가능  -->
                <!-- <input type="hidden" name="fix_inst"        value="07" /> -->

                <!-- 무이자 옵션
                    ※ 설정할부    (가맹점 관리자 페이지에 설정 된 무이자 설정을 따른다) - "" 로 설정
                    ※ 일반할부    (KCP 이벤트 이외에 설정 된 모든 무이자 설정을 무시한다) - "N" 로 설정
                    ※ 무자 할부 (가맹점 관리자 페이지에 설정 된 무이자 이벤트 중 원하는 무이자 설정을 세팅한다) - "Y" 로 설정 -->
                <!-- <input type="hidden" name="kcp_noint"       value="" /> -->

                <!-- 무이자 설정
                    ※ 주의 1 : 할부는 결제금액이 50,000 원 이상일 경우에만 가능
                    ※ 주의 2 : 무이자 설정값은 무이자 옵션이 Y일 경우에만 결제 창에 적용
                    예) BC 2,3,6개월, 국민 3,6개월, 삼성 6,9개월 무이자 : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04 -->
                <!-- <input type="hidden" name="kcp_noint_quota" value="CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09" /> -->


                <!--  해외카드 구분하는 파라미터 입니다.(해외비자, 해외마스터, 해외JCB로 구분하여 표시) -->
                <!-- <input type="hidden" name="used_card_CCXX"        value="Y"/> -->

                <!--  가상계좌 은행 선택 파라미터
                 ※ 해당 은행을 결제창에서 보이게 합니다.(은행코드는 매뉴얼을 참조)  -->
                <!-- <input type="hidden" name="wish_vbank_list" value="05:03:04:07:11:23:26:32:34:81:71" /> -->

                <!--  가상계좌 입금 기한 설정하는 파라미터 - 발급일 + 3일 -->
                <!-- <input type="hidden" name="vcnt_expire_term" value="3"/> -->

                <!-- 가상계좌 입금 시간 설정하는 파라미터
                HHMMSS형식으로 입력하시기 바랍니다
                          설정을 안하시는경우 기본적으로 23시59분59초가 세팅이 됩니다 -->
                <!-- <input type="hidden" name="vcnt_expire_term_time" value="120000" /> -->

                <!-- 포인트 결제시 복합 결제(신용카드+포인트) 여부를 결정할 수 있습니다.- N 일경우 복합결제 사용안함 -->
                <!-- <input type="hidden" name="complex_pnt_yn" value="N" /> -->

                <!-- 현금영수증 등록 창을 출력 여부를 설정하는 파라미터 입니다
                       ※ Y : 현금영수증 등록 창 출력
                       ※ N : 현금영수증 등록 창 출력 안함 
                       ※ 주의 : 현금영수증 사용 시 KCP 상점관리자 페이지에서 현금영수증 사용 동의를 하셔야 합니다 -->
                <!-- <input type="hidden" name="disp_tax_yn"     value="Y" /> -->

                <!--  결제창에 가맹점 사이트의 로고를 표준웹 좌측 상단에 출력하는 파라미터 입니다
                      업체의 로고가 있는 URL을 정확히 입력하셔야 하며, 최대 150 X 50  미만 크기 지원
                      ※ 주의 : 로고 용량이 150 X 50 이상일 경우 site_name 값이 표시됩니다. -->
                <!-- <input type="hidden" name="site_logo"       value="" /> -->

                <!-- 결제창 영문 표시 파라미터 입니다. 영문을 기본으로 사용하시려면 Y로 세팅하시기 바랍니다 -->
                <!-- <input type="hidden" name="eng_flag"      value="Y"> -->

                <!--  KCP는 과세상품과 비과세상품을 동시에 판매하는 업체들의 결제관리에 대한 편의성을 제공해드리고자, 
                    복합과세 전용 사이트코드를 지원해 드리며 총 금액에 대해 복합과세 처리가 가능하도록 제공하고 있습니다
                    복합과세 전용 사이트 코드로 계약하신 가맹점에만 해당이 됩니다
                    상품별이 아니라 금액으로 구분하여 요청하셔야 합니다
                    총결제 금액은 과세금액 + 부과세 + 비과세금액의 합과 같아야 합니다. 
                (good_mny = comm_tax_mny + comm_vat_mny + comm_free_mny) -->
                <!-- <input type="hidden" name="tax_flag"       value="TG03" /> --> <!-- 변경불가     -->
                <!-- <input type="hidden" name="comm_tax_mny"   value=""     /> --> <!-- 과세금액     -->
                <!-- <input type="hidden" name="comm_vat_mny"   value=""     /> --> <!-- 부가세      -->
                <!-- <input type="hidden" name="comm_free_mny"  value=""     /> --> <!-- 비과세 금액 -->

                <!--  skin_indx 값은 스킨을 변경할 수 있는 파라미터이며 총 7가지가 지원됩니다. 
                     변경을 원하시면 1부터 7까지 값을 넣어주시기 바랍니다. -->
                <!-- <input type="hidden" name="skin_indx"      value="1" /> -->
                <!-- 상품코드 설정 파라미터 입니다.(상품권을 따로 구분하여 처리할 수 있는 옵션기능입니다.) -->
                <!-- <input type="hidden" name="good_cd"      value="" /> -->

                <!-- 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다. 상품권 결제 시 반드시 입력하시기 바랍니다. -->
                <!-- <input type="hidden" name="shop_user_id"    value="" /> -->

                <!--  복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다. -->
                <!-- <input type="hidden" name="pt_memcorp_cd"   value="" /> -->

                <!--  결제창의 상단문구를 변경할 수 있는 파라미터 입니다. -->
                <!-- <input type="hidden" name="kcp_pay_title"   value="상단문구추가" /> -->
            </form>

            <div class="recommend_box">
                <div class="s_cont_tit f20 bold2 c_bora01 nobrb">추천 강좌</div>
                <div class="dp_f dp_wrap">
                    <?
                    $row_arr = sqlArray("SELECT * FROM ks_class WHERE `status`=1 LIMIT 3");
                    foreach ($row_arr as $row) {
                    ?>
                        <div class="nVdSlickBox">
                            <a href="/sub01/view.php?&code=<?= $row['uid'] ?>" title="<?= $row['title'] ?>">
                                <div class="imgWrap c_gry02 p_r" style="background-image: url('/upfile/class/<?= $row['upfile01'] ?>')">
                                    <button type="button" title="관심" class="likeMark <? if ($row['is_wish']) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $row['uid'] ?>"></button>
                                </div>
                                <div class="nVdCont">
                                    <div class="nVdTop">
                                        <p class="nVdtit01 bold2 dotdot"><?= $row['title'] ?></p>
                                        <p class="nVdtit02 c_gry03 dotdot"><?= $row['exp'] ?></p>
                                        <ul class="clickicon dp_f dp_c">
                                            <li class="dp_f dp_c">
                                                <img src="/images/likeChk.svg" alt="">
                                                <span><?= $row['wish'] ?></span>
                                            </li>
                                            <li class="dp_f dp_c">
                                                <img src="/images/bestChk.svg" alt="">
                                                <span><?= $row['hit'] ?>%</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div><?= price_tag($row['price'], $row['discountPrice'], $row['discountRate'], $row['period']) ?></div>
                                </div>
                            </a>
                        </div>
                    <?
                    }
                    ?>
                </div>
            </div>

            <section id="detail_sec03">
                <div class="detail_cont_sub_tit">
                    <!-- <span class="bora01 c_w bold2">환불</span> -->
                </div>
                <div class="detail_cont_subcont caution_subcont">
                    <span class="c_bora01 bold2 m_10">환불 규정</span><br>
                    평생교육법 시행령 제23조 및 소비자분쟁해결기준에서 규정하고 있는 수강료 반환 등에 관한 규정을 기본 원칙으로 하여 환불금액을 산정하고 있습니다. 단, 기본 원칙은 본 사이트 내 상품에 대한 포괄적인 규정이며 각 상품의 경우, 사전계약원칙이 적용되어 자사에서 규정한 별도의 결제취소, 변경 및 환불규정에 따라 환불금액이 산정되는 점 유의하시길 바랍니다.<br><br>


                    <div class="caution_depth01">
                        <b class="m_10">1. 환불 공통 규정</b><br>
                        <div class="caution_depth02">
                            1) 구매 후 모든 강좌는 2강 이하 수강한 경우를 미수강으로 규정합니다.<br>
                            <div class="caution_depth02">
                                1-1) 학습 자료 다운로드 시 자료가 포함된 해당 강좌는 수강 강좌로 규정됩니다.<br>
                            </div>
                            2) 회원의 본인의사로 환불 시 추가적인 혜택 (사은품, 교재, 쿠폰 등)이 있는 경우 모두 반환되어야 하며, 사용되었거나 상품가치가 감소했을 경우 환불금액에서 공제됩니다.<br>

                            3) 환불 시 발생하는 교재/사은품 반품 배송비 3,000원은 회원 부담이며, 배송 시 무료배송 받으신 경우 해당 배송비 3,000원을 포함한 총 6,000원을 부담하셔야 합니다.<br>

                            4) 환불신청 시, 결제수단으로 환불이 진행되며, 다른 결제수단으로 환불이 불가합니다.<br>
                            <div class="caution_depth02">
                                4-1) 실시간계좌이체/무통장 입금건의 경우 환불접수일로부터 영업일 기준 3~5일정도 소요됩니다. <br>

                                4-2) 카드취소는 카드부분결제취소로 환불이 되며, 이는 카드사 영업일 기준 2~3일정도 소요됩니다.
                            </div>
                        </div>
                    </div>
                    <div class="caution_depth01">
                        <b class="m_10">2. 단강좌 환불 규정</b><br>
                        <div class="caution_depth02">
                            1) 결제일로부터 7일이내 환불 신청 시 다음과 같이 환불 규정을 적용합니다.<br>

                            ① 미수강(2강 이하 수강)인 경우 : 전액 환불<br>

                            ② 2강을 초과하여 수강한 경우 : 일할 차감<br>

                            * 일할차감 산출 방식 : 단강좌 실결제금액 - [단강좌 정가금액/기본수강기간*실수강기간] = 환불금액<br>

                            2) 결제일로부터 7일을 초과한 경우 다음과 같이 환불 규정을 적용합니다.<br>

                            * 일할차감 후 환불 : 단강좌 실결제금액 - [단강좌 정가금액/기본수강기간*실수강기간] = 환불금액<br>

                            3) 교습시작 전일지라도 수강기간이 종료된 경우 환불이 불가합니다.<br>

                            4) 강의 다운로드 시 강의 수강으로 간주됩니다.
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    const order_frm = document.order_info;
    console.log(data);

    const coupon = function() {
        $('#couponListFrame').html("<iframe src='./coupon.php?userid=" + data.buyr_mail + "&use_coupon_uid=" + data.use_coupon_uid + "' name='couponListFrame' style='width:100%;height:655px;' frameborder='0' scrolling='auto'></iframe>");
        $('.couponList_open').click();
    }

    function setOrderData() {
        let use_coupon_uid = order_frm.use_coupon_uid.value;
        let use_coupon_price = uncomma(order_frm.use_coupon_price.value);
        let use_point = uncomma(order_frm.use_point.value);
        console.log(use_point);
        let good_mny = parseInt(data.price) - parseInt(data.discountPrice) - use_coupon_price - use_point

        data.use_coupon_uid = use_coupon_uid
        data.use_coupon_price = use_coupon_price
        data.use_point = use_point
        data.good_mny = good_mny

        $('#use_coupon_price').text(number_format(use_coupon_price))
        $('#use_point').text(number_format(use_point))
        $('#good_mny').text(number_format(good_mny))

        console.log(data);
    }

    function setPoint(event) {

        if (uncomma(event.value) > parseInt(data.point)) {
            alert('보유하신 적립금을 초과하였습니다');
            event.value = data.point;
        }
    }
</script>

<?
include '../../footer.php';
?>