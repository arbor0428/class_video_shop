<?
include '../../header.php';
$side_menu = 10;
$topTxt01 = '장바구니';

$data = array();
$data['userid'] = $GBL_USERID;

$query = "SELECT ca.*, c.*";
$query .= " FROM ks_cart ca";
$query .= " JOIN ks_class c ON ca.class_uid=c.uid";
$query .= " WHERE ca.userid='iweb'";
$query .= " ORDER BY ca.rDate DESC";

$result = mysql_query($query . $sort) or die("FAILED : " . mysql_error());
$num_row = mysql_num_rows($result);
?>

<?
include '../location03.php';
?>
<div class="subWrap">
    <div class="s_center dp_sb">

        <? include '../sidemenu.php'; ?>

        <div class="s_cont">
            <form class="form-cart" name="frm01" method="post">
                <input type="hidden" name="type" value="">
                <input type="hidden" name="userid" value="">
                <input type="hidden" name="numOfProd" value="">
                <input type="hidden" name="price" value="">
                <input type="hidden" name="discountPrice" value="">
                <input type="hidden" name="shippingFee" value="">
                <input type="hidden" name="good_mny" value="">
                <input type="hidden" name="class_uid" value="">

                <div class="s_cont_tit f20 bold2 c_bora01 nobrb">장바구니</div>

                <? if ($num_row > 0) { ?>
                    <!--수강중인 강좌가 있을때 보여지는 부분-->
                    <div class="tableWrap">
                        <div class="dp_sb m_10">
                            <div class="dp_f dp_c">
                                <input type="checkbox" class="cart_all_check" onclick="selectAll(this); selectCart();">
                                <label class="f14" for="">전체선택</label>
                                <span class="nmBox f14" style="margin: 0 5px;"><span id="num_of_cart_seleted" class="c_bora01 f14">0</span>/<?= $num_row ?></span>
                            </div>
                            <a class="dp_f dp_c c_gry04 f14" href="javascript:void(0)" onclick="deleteSeletedCartConfirm()">선택삭제<span class="lnr lnr-cross" style="margin: 0 5px;"></span></a>
                        </div>
                        <table class="subTbl cartTbl">
                            <colgroup>
                                <col style="width: 3%;">
                                <col style="width: 77%;">
                                <col style="width: 20%;">
                            </colgroup>
                            <tbody>
                                <tr class="brb000">
                                    <th></th>
                                    <th>상품정보</th>
                                    <th>금액</th>
                                </tr>

                                <?
                                while ($row = mysql_fetch_assoc($result)) {
                                    foreach ($row as $k => $v) {
                                        ${$k} = $v;
                                    }
                                    $data['cart'][$uid]['title'] = $title;
                                    $data['cart'][$uid]['price'] = $price;
                                    $data['cart'][$uid]['discountPrice'] = ($discountPrice == null) ? $price : $discountPrice;
                                ?>
                                    <tr>
                                        <td class="nopadd">
                                            <input type="checkbox" name="class_uids[]" class="class_uids" onclick="selectCart();" value="<?= $uid ?>">
                                        </td>
                                        <td>
                                            <a href="/sub01/view.php?&code=<?= $uid ?>" title="<?= $title ?>">
                                                <div class="dp_f">
                                                    <div class="imgWrap gry">
                                                        <img src="/upfile/class/<?= $upfile01 ?>" alt="<?= $title ?>" width="150">
                                                    </div>
                                                    <div class="cart_tit">
                                                        <p class="cart_tit01 bold2 txt-l"><?= $title ?></p>
                                                        <p class="c_gry04 f14 txt-l"><?= $exp ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>

                                        <td>
                                            <a class="trDelBtn" href="javascript:void(0)" title="삭제" onclick="deleteCartConfirm(this)" data-code="<?= $uid ?>"><span class="lnr lnr-cross"></span></a>

                                            <? if (!$discountPrice) { ?>
                                                <span class="f14 f18 bold2"><?= number_format($price) ?></span>
                                                <span class="f14" style="margin-left:3px;">원</span>
                                            <? } else { ?>
                                                <a class="trDelBtn" href="javascript:void(0)" title="삭제" onclick="deleteCartConfirm(this)" data-code="<?= $uid ?>"><span class="lnr lnr-cross"></span></a>
                                                <p class="c_gry03 strkt"><?= number_format($price) ?>원</p>
                                                <span class="f14 f18 bold2"><?= number_format($discountPrice) ?></span>
                                                <span class="f14" style="margin-left:3px;">원</span>
                                            <? } ?>

                                        </td>
                                    </tr>
                                <? } ?>

                            </tbody>
                        </table>
                        <span class="dp_b wid100 txt-r c_gry04 f12" style="margin-top: 5px;">※ 장바구니 리스트는 1주일 단위로 삭제됩니다.</span>
                    </div>

                <? } else { ?>
                    <!--수강중인 강좌가 없을때 보여지는 부분-->
                    <div class="noListShow">
                        <p class="txt-c bold2">장바구니에 담긴 상품이 없습니다.</p>
                        <p class="txt-c c_gry04 f15">나를 성장 시켜줄 좋은 강좌들을 찾아보세요.</p>
                        <a class="goClassList c_bora01 dp_f dp_c dp_cc" href="/sub01" title="강좌리스트 보러가기">강좌리스트 보러가기</a>
                    </div>
                <? } ?>

            </form>

            <div class="totalAmtWrap dp_sb m-50">
                <div class="wid50">
                    <p class="f20 bold2 totalAmt_tit">총 결제금액</p>
                </div>
                <div class="tableWrap wid50">
                    <table class="subTbl02">
                        <tbody>
                            <tr>
                                <th>결제상품 수</th>
                                <td><span id="numOfProd">0</span> 개</td>
                            </tr>
                            <tr>
                                <th>상품금액</th>
                                <td><span id="total_price">0</span> 원</td>
                            </tr>
                            <tr>
                                <th>할인금액</th>
                                <td>-&nbsp;<span id="total_discountPrice">0</span> 원</td>
                            </tr>
                            <tr>
                                <th>배송비</th>
                                <td><span id="total_shippingFee">0</span> 원</td>
                            </tr>
                            <tr class="totalTrWrap">
                                <th>최종 결제금액</th>
                                <td><span id="total_amount" class="f20 bold2 c_bora01" style="margin: 0 5px;">0</span> 원</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="twoBtnWrap dp_f dp_cc m-40 m_40">
                <!-- <a class="bora01 c_w dp_f dp_c dp_cc" href="javascript:void(0)" onclick="selected_pay()" title="선택상품 구매">선택상품 구매(테스트)</a> -->
                <!-- <a class="c_bora01 dp_f dp_c dp_cc" href="javascript:void(0)" onclick="return;" title="주문하기">전체상품 주문하기</a> -->
                <a class="bora01 c_w dp_f dp_c dp_cc" href="javascript:void(0)" onclick="order()" title="주문하기">선택상품 주문하기</a>
            </div>

            <div class="recommend_box">
                <div class="s_cont_tit f20 bold2 c_bora01 nobrb">추천 강좌</div>
                <div class="newVdSlick02">
                    <?
                    $row_arr = sqlArray("SELECT * FROM ks_class WHERE `status`=1 LIMIT 5");
                    foreach ($row_arr as $row) {
                        ?>
                            <div class="nVdSlickBox">
                                <a href="/sub01/view.php?&code=<?= $row['uid'] ?>" title="<?= $row['title'] ?>">
                                    <div class="imgWrap c_gry02 p_r" style="background-image: url('/upfile/class/<?= $row['upfile01'] ?>')">
                                        <!-- <button type="button" title="관심" class="likeMark <? if ($row['is_wish']) echo 'on'; ?>" onclick="thumbWish(this)" data-id="<?= $row['uid'] ?>"></button> -->
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
                    <? } ?>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var data = <?= json_encode($data) ?>;
    console.log(data);

    const selectAll = function(cart_all_check) {
        const checkboxes = document.querySelectorAll('.class_uids')
        checkboxes.forEach((checkbox) => {
            checkbox.checked = cart_all_check.checked
        })
    }

    const selectCart = function() {
        const cart_all_check = document.querySelector(".cart_all_check")

        const class_uids = document.querySelectorAll('.class_uids')
        const seleted_class_uids = document.querySelectorAll('.class_uids:checked')

        if (class_uids.length === seleted_class_uids.length) cart_all_check.checked = true
        else cart_all_check.checked = false

        setOrderData(seleted_class_uids)
    }

    const deleteCart = function(uid) {
        const form = document.frm01;
        form.type.value = 'DEL';
        form.userid.value = data.userid;
        form.class_uid.value = uid;

        form.action = "./proc.php"
        form.target = 'ifra_gbl';
        form.submit();
    }

    const deleteSeletedCart = function(uid) {
        const form = document.frm01;
        form.type.value = 'DEL_SELETED';
        form.userid.value = data.userid;

        form.action = "./proc.php"
        // form.target = 'ifra_gbl';
        form.submit();
    }

    const deleteCartConfirm = function(param) {
        GblMsgConfirmBox("삭제 하겠습니까?", `deleteCart(${param.dataset.code})`);
    }

    const deleteSeletedCartConfirm = function() {
        const numOfCartSeleted = document.querySelectorAll('.class_uids:checked').length
        if (numOfCartSeleted <= 0) GblMsgBox("상품을 선택하세요.")
        else GblMsgConfirmBox("삭제 하겠습니까?", `deleteSeletedCart()`);
    }

    const order = function() {
        const numOfCartSeleted = document.querySelectorAll('.class_uids:checked').length
        if (numOfCartSeleted <= 0) GblMsgBox("상품을 선택하세요.")
        else {
            const form = document.frm01
            const seleted_class_uids = document.querySelectorAll('.class_uids:checked')
            form.type.value = 'ORDER'
            form.userid.value = data.userid
            setOrderData(seleted_class_uids)
            form.action = "../order/"
            form.submit();
        }
    }

    const setOrderData = function(seleted_class_uids) {
        // 결제상품 수
        $('#num_of_cart_seleted').text(seleted_class_uids.length)
        $('#numOfProd').text(seleted_class_uids.length)
        $('input[name=numOfProd]').val(seleted_class_uids.length)

        // 상품금액
        let total_price = 0
        seleted_class_uids.forEach(ele => {
            let uid = ele.value
            total_price += parseInt(data.cart[uid].price)
        });
        $('#total_price').text(number_format(total_price))
        $('input[name=price]').val(total_price)

        // 할인금액
        let total_discountPrice = 0
        seleted_class_uids.forEach(ele => {
            let uid = ele.value
            console.log(data.cart[uid].price);
            console.log(data.cart[uid].discountPrice);
            total_discountPrice += (data.cart[uid].price - data.cart[uid].discountPrice)
        })
        $('#total_discountPrice').text(number_format(total_discountPrice))
        $('input[name=discountPrice]').val(total_discountPrice)

        // 배송비
        let total_shippingFee = 0
        // seleted_class_uids.forEach(ele => {
        // 	let uid = ele.value
        // 	total_shippingFee += data.cart[uid].shippingFee
        // });
        $('#total_shippingFee').text(number_format(total_shippingFee))
        $('input[name=shippingFee]').val(total_shippingFee)

        // 최종 결제금액
        let total_amount = total_price - total_discountPrice + total_shippingFee
        $('#total_amount').text(number_format(total_amount))
        $('input[name=good_mny]').val(total_amount)
    }

    $(function() {
        $('.newVdSlick02').slick({
            fade: false,
            dots: false,
            arrows: true,
            autoplay: false, // 자동 스크롤 사용 여부
            autoplaySpeed: 5000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
            slidesToShow: 3, // 한 화면에 보여질 컨텐츠 개수
            slidesToScroll: 1, //스크롤 한번에 움직일 컨텐츠 개수
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        centerMode: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: false
                    }
                }
            ]
        });
    })
</script>

<?
include '../../footer.php';
?>