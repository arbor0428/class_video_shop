<!-- 알림 메세지 -->
<a id="GblNotice_open" class="GblNotice_open"></a>

<div id="GblNotice" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali2" id="alertCloseBtn"><button class="GblNotice_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif"></div><div class="pop_ttl0">알림</div></div>
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
		<div class="clearfix"><div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif"></div><div class="pop_ttl0">확인</div></div>
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
<div id="multiBox" class="popup_background" style="min-width:250px;display:none;">
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif"></div><div class="pop_ttl0" id='multi_ttl'>팝업제목</div><div class="cls_buttonali2"><button class="multiBox_close close_button_pop"></button></div></div>
		<div class="pop_div_dotted"></div>
		<div class="write_it">
			<div id='multiFrame' style="background:#fff;overflow:hidden;position:relative;"></div>
		</div>
	</div>
</div>

<a id="classConsBox_open" class="classConsBox_open"></a>
<div id="classConsBox" class="popup_background" style="padding: 20px; min-width: 1000px; position:relative; display:none;">
	<div style="height: 54px;">
		<div class="printBtnWrap"><a class="printBtn dp_f dp_c"><img src="../images/print.svg" alt=""><span class="f12 bold2" style="margin-left: 8px;">인쇄하기</span></a></div>
		<div class="cls_buttonali2"><button class="newsConsBox_close close_button_pop"><img src="../images/x_icon.svg" alt=""></button></div>
	</div>
	<div id='classConsFrame' style="background:#fff; overflow:hidden; position:relative;"></div>
</div>


<!-- 팝업 스크립트 -->
<script>
$(document).ready(function () {
	$('#GblNotice,#conFirm').popup({
		transition: 'all 0.3s',
		blur: false,
		escape:false,
		scrolllock: false
	});

	$('#multiBox,#titleBox,#classConsBox').popup({
		transition: 'all 0.3s',
		blur: false,
		escape:false,
		scrolllock: false
	});


	//숫자만 입력받기
	// $('input.numberOnly').keydown(function(e){
	// 	fn_Number($(this),e);
	// }).keyup(function(e){
	// 	fn_Number($(this),e);
	// }).css('imeMode','disabled');

	//input필드 자동완성기능
	jQuery('input').attr("autocomplete","off");
});
</script>
<!-- 팝업 스크립트 -->




<iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>