<?
	include "/home/edufim/www/module/login/head.php";
?>

<div class="addrRegisterWrap">
    <p class="f24 bold2 m_40">배송지 등록/수정</p>

    <div class="form_row_wrap">
        <div class="row dp_sb dp_c">
            <div class="input_tit f15 bold">배송지명<span class="c_bora01">*</span></div>
            <div class="inputWrap">
                <input type="text" placeholder="ex) 집/회사/학교">
            </div>
        </div>
        <div class="row dp_sb dp_c">
            <div class="input_tit f15 bold">이&nbsp;&nbsp;름<span class="c_bora01">*</span></div>
            <div class="inputWrap">
                <input type="text" placeholder="이름">
            </div>
        </div>
        <div class="row dp_sb">
            <div class="input_tit f15 bold">주&nbsp;&nbsp;소<span class="c_bora01">*</span></div>
            <div class="inputWrap">
                <div class="two_inputWrap">
                    <input type="text" placeholder="우편번호 검색">
                    <button class="addrSearchBtn bold2">검색</button>
                </div>
                <input type="text" placeholder="주소를 입력해주세요">
                <input type="text" placeholder="나머지 주소를 입력해주세요">
            </div>
        </div>
        <div class="row dp_sb dp_c">
            <div class="input_tit f15 bold">연락처<span class="c_bora01">*</span></div>
            <div class="inputWrap">
                <input type="text" placeholder="휴대전화번호 입력">
                <div class="dp_f dp_c">
                    <input type="checkbox">
                    <label class="f14" for="">기본 배송지로 저장</label>
                </div>
            </div>
        </div>
    </div>

    <p class="addr_caution f12 c_gry04 m-24">- 입력/수정하신 배송지는 배송지 목록에 저장됩니다.<br>
    - 주소지 확인 부탁드립니다. 주소지 오류로 수신이 되지않은 경우는 책임지지 않습니다.<br> 
    - 주소를 배송지목록에 추가하는 경우 개인정보 수집에 동의하는 것으로 간주됩니다.</p>

</div>