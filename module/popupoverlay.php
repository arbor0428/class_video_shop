<!-- 알림 메세지 -->
<a id="GblNotice_open" class="GblNotice_open"></a>

<div id="GblNotice" class="popup_background" style="min-width:250px;display:none;">
    <div class="cls_buttonali2" id="alertCloseBtn"><button class="GblNotice_close close_button_pop"></button></div>
    <div class="popup_notice">
        <div class="clearfix">
            <div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif"></div>
            <div class="pop_ttl0">알림</div>
        </div>
        <div class="pop_div_dotted"></div>
        <div class="write_it"><span id="alertTxt" class="txt_bold"></span></div>
        <div class="btn_ali_pop2" id="alertBtn"><input type="button" class="btn_notice_reg GblNotice_close" value="확인" /></div>
    </div>
</div>

<!-- confirm창 -->
<a id="conFirm_open" class="conFirm_open"></a>
<div id="conFirm" class="popup_background" style="min-width:250px;display:none;">
    <div class="cls_buttonali2"><button class="conFirm_close close_button_pop"></button></div>
    <div class="popup_notice">
        <div class="clearfix">
            <div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif"></div>
            <div class="pop_ttl0">확인</div>
        </div>
        <div class="pop_div_dotted"></div>
        <div class="write_it"><span id="confirmTxt" class="txt_bold"></span></div>
        <a class="conFirm_close" href="#">
            <div class="btn2_wrap">
                <div class="btn_ali_pop3" id="confirmCancelBtn"><input type="button" class="btn_notice_reg_cancel" value="취소" /></div>
                <div class="btn_ali_pop3" id="confirmBtn"><input type="button" class="btn_notice_reg_add" value="확인"></div>
            </div>
        </a>
    </div>
</div>


<a id="titleBox_open" class="titleBox_open"></a>
<div id="titleBox" class="popup_background" style="min-width:250px;display:none;">
    <div class="popup_notice">
        <div class="clearfix">
            <div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif"></div>
            <div class="pop_ttl0" id='title_ttl'>팝업제목</div>
            <div class="cls_buttonali"><button class="titleBox_close close_button_pop"></button></div>
        </div>
        <div class="pop_div_dotted"></div>
        <div class="write_it">
            <div id='titleFrame' style="background:#fff;overflow:hidden;position:relative;"></div>
        </div>
    </div>
</div>

<a id="multiBox_open" class="multiBox_open"></a>
<div id="multiBox" class="popup_background">
    <div class="popup_notice">
        <div class="clearfix">
            <div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif"></div>
            <div class="pop_ttl0" id='multi_ttl'>팝업제목</div>
            <div class="cls_buttonali2">
                <button class="multiBox_close close_button_pop"></button>
            </div>
        </div>
        <div class="pop_div_dotted"></div>
        <div class="write_it">
            <div id='multiFrame' style="background:#fff;overflow:hidden;position:relative;"></div>
        </div>
    </div>
</div>

<a id="classConsBox_open" class="classConsBox_open"></a>
<div id="classConsBox" class="popup_background">
    <div class="cls_buttonali2"><button class="newsConsBox_close close_button_pop"><img src="/images/x_icon.svg" alt=""></button></div>
    <div id='classConsFrame' style="background:#fff; overflow:hidden; position:relative;"></div>
</div>

<a id="cerPrint_open" class="cerPrint_open"></a>
<div id="cerPrint" class="popup_background">
    <div class="cls_buttonali2"><button class="cerPrint_close close_button_pop"><img src="/images/x_icon.svg" alt=""></button></div>
    <div id='cerPrintFrame' style="background:#fff; overflow:hidden; position:relative;"></div>
</div>

<a id="cerSearch_open" class="cerSearch_open"></a>
<div id="cerSearch" class="popup_background">
    <div class="cls_buttonali2"><button class="cerSearch_close close_button_pop"><img src="/images/x_icon.svg" alt=""></button></div>
    <div id='cerSearchFrame' style="background:#fff; overflow:hidden; position:relative;"></div>
</div>

<a id="couponList_open" class="couponList_open"></a>
<div id="couponList" class="popup_background">
    <!-- <div class="cls_buttonali2"><button class="cerPrint_close close_button_pop"><img src="../images/x_icon.svg" alt=""></button></div> -->
    <div id='couponListFrame' style="background:#fff; overflow:hidden; position:relative;"></div>
    <a class="couponApplyBtn dp_f dp_c dp_cc bold2" href="javascript:void(0)" title="확인">확인</a>
</div>

<a id="addrRegister_open" class="addrRegister_open"></a>
<div id="addrRegister" class="popup_background">
    <div class="cls_buttonali2"><button class="cerPrint_close close_button_pop"><img src="/images/x_icon.svg" alt=""></button></div>
    <div id='addrRegisterFrame' style="background:#fff; position:relative;"></div>
</div>

<a id="classShow_open" class="classShow_open"></a>
<div id="classShow" class="popup_background">
    <div style="height: 20px;">
        <div class="cls_buttonali2"><button class="cerPrint_close close_button_pop"><img src="/images/x_icon.svg" alt=""></button></div>
    </div>
    <div id='classShowFrame' style="background:#fff; overflow:hidden; position:relative;"></div>
</div>

<!-- pg팝업 -->
<a id="pgBox_open" class="pgBox_open"></a>
<a id="pgBox_close" class="pgBox_close"></a>
<div id="pgBox" class="popup_background" style="min-width:300px;display:none;">
	<div class="cls_buttonali" id="alertCloseBtn"><button class="GblNotice_close close_button_pop2"></button></div>
	<div class="popup_notice">
		<div class="write_it">
			<div id='pgFrame' style="background:#fff;overflow:hidden;position:relative;"></div>
		</div>
	</div>
</div>

<style>
    #multiBox {
        min-width: 250px;
        display: none;
    }

    #classConsBox {
        padding: 20px;
        box-sizing: border-box;
        min-width: 1000px;
        position: relative;
        display: none;
    }

    #cerPrint {
        padding: 20px;
        box-sizing: border-box;
        min-width: 550px;
        position: relative;
        display: none;
    }

    #cerSearch {
        padding: 20px;
        box-sizing: border-box;
        min-width: 550px;
        position: relative;
        display: none;
    }

    #couponList {
        position: relative;
        padding: 20px;
        box-sizing: border-box;
        min-width: 600px;
        position: relative;
        display: none;
    }

    #addrRegister {
        position: relative;
        padding: 20px;
        box-sizing: border-box;
        min-width: 720px;
        position: relative;
        display: none;
    }

    #classShow {
        padding: 20px 40px;
        box-sizing: border-box;
        min-width: 800px;
        position: relative;
        display: none;
    }

    @media (max-width:1240px) {
        #classConsBox {
            min-width: 90%;
            width: 90%;
            padding: 10px;
            height: 80%;
            overflow: hidden;
        }

        #cerPrint {
            min-width: 90%;
            width: 90%;
            padding: 10px;
            height: 80%;
            overflow: hidden;
        }

        #cerSearch {
            min-width: 90%;
            width: 90%;
            padding: 10px;
            height: 350px;
            overflow: hidden;
        }

        #couponList {
            min-width: 90%;
            width: 90%;
            padding: 10px;
            height: 80%;
            overflow: hidden;
        }

        #addrRegister {
            min-width: 90%;
            width: 90%;
            padding: 10px;
            height: 92%;
            overflow: hidden;
        }

        #classShow {
            min-width: 90%;
            width: 90%;
            padding: 10px;
            height: 80%;
            overflow: hidden;
        }
    }
</style>


<!-- 팝업 스크립트 -->
<script>
    $(document).ready(function() {
        $('#GblNotice,#conFirm,#pgBox').popup({
            transition: 'all 0.3s',
            blur: false,
            escape: false,
            scrolllock: false
        });

        $('#multiBox,#titleBox,#classConsBox').popup({
            transition: 'all 0.3s',
            blur: false,
            escape: false,
            scrolllock: false
        });

        $('#cerPrint, #couponList, #addrRegister, #classShow, #cerSearch').popup({
            transition: 'all 0.3s',
            blur: false,
            escape: false,
            scrolllock: false
        });


        //숫자만 입력받기
        // $('input.numberOnly').keydown(function(e){
        // 	fn_Number($(this),e);
        // }).keyup(function(e){
        // 	fn_Number($(this),e);
        // }).css('imeMode','disabled');

        //input필드 자동완성기능
        jQuery('input').attr("autocomplete", "off");


        $(".close_button_pop,.close_button_pop2").click(function(event) {
            $('#multiBox').popup('hide');
            $('#titleBox').popup('hide');
            $('#pgBox').popup('hide');
            $('#classConsBox').popup('hide');
            $('#cerPrint').popup('hide');
            $('#cerSearch').popup('hide');
            $('#addrRegister').popup('hide');
            $('#classShow').popup('hide');
            $("html, body").removeClass("not_scroll");

            $("section").css("top", 0);
        });

        $(".couponApplyBtn").click(function(event) {
            $('#couponList').popup('hide');
        });

        function printPage() {
            if (window.print) {
                agree = confirm('현재 페이지를 출력하시겠습니까?');
                if (agree) window.print();
            }
        }
        $('.printBtn').on('click', function() {
            printPage()
        })
        // setTimeout('printPage();', 100);
    });
</script>
<!-- 팝업 스크립트 -->




<iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>