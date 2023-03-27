<?
include '../../header.php';
$side_menu = 15;
$topTxt01 = '모바일기기 초기화';
?>


<?
include '../location04.php';
?>
<div class="subWrap">
    <div class="s_center dp_sb">
        <?
        include '../sidemenu.php';
        ?>
        <div class="s_cont">
            <div class="s_cont_tit f20 bold2 c_bora01">
                모바일기기 초기화
                <span class="s_cont_tit_det f14 c_blk regular">총 등록가능 기기 수 : 1대</span>
            </div>
            <p>콘텐츠 보안 및 공유 방지를 위하여 한 개의 아이디로 한 분만 사용하실 수 있습니다.<br>
                모바일 앱의 경우, 최초 로그인한 기기가 자동으로 등록되고 있으며 등록 기기 변경을 희망하시는 경우<br>
                계정에 등록된 모바일 기기 정보의 초기화 작업이 진행되어야 합니다.</p>

            <div class="grytitBox m-20 m_20">
                <p class="dp_f dp_c">등록된 휴대폰이 아닙니다. 초기 로그인하신 휴대폰으로만 이용이 가능합니다.</p>
            </div>

            <p>위 안내 메시지가 나타나는 경우는 최초 로그인하신 휴대기기와 다른 경우입니다.<br>
                최초 로그인하신 휴대기기로 로그인하시거나, 모바일기기 초기화 후 이용이 가능합니다.</p>

            <div class="totalPointWrap dp_sb dp_c m-40">
                <div class="inputwrap dp_f dp_c">
                    <input type="checkbox">
                    <label for=""> Android 11 SM-N981N</label>
                </div>
                <select class="reason_reset" name="" id="">
                    <option value="">초기화 사유</option>
                </select>
            </div>

            <p class="m-12 f12 c_gry05">초기화를 원하는 기기 선택 후 하단의 기기 초기화 버튼을 클릭해주시기 바랍니다.</p>

            <ul class="mobile_resetWrap m-28">
                <li class="f14 dp_f">모바일 기기 초기화는 아래 기기 초기화 버튼을 통해 진행할 수 있습니다.</li>
                <li class="f14 dp_f">모바일 기기 초기화를 위해 접수된 사유는 담당 부서를 통해 모니터링이 진행되고 있으며, 모니터링 과정에서 아이디 판매/공유가 의심되는 경우<br> 확인을 위해 연락이 진행될 수 있습니다.</li>
                <li class="f14 dp_f">아이디 판매/공유가 적발되는 경우, 이용 중이신 상품 및 콘텐츠의 이용이 제한되거나 회원 자격이 상실될 수 있습니다.</li>
            </ul>

            <a class="resetBtn dp_f dp_c dp_cc bora01 c_w" href="" title="기기 초기화">기기 초기화</a>
        </div>
    </div>
</div>


<?
include '../../footer.php';
?>