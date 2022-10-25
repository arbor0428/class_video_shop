<?
	include '../header.php';
	$side_menu=2;
?>


<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="grytitBox dp_sb">
				<p class="dp_f dp_c">읽지 않은 알림<span class="f18 c_bora01 bold2" style="margin: 0 5px;">1</span>개</p>
				<div class="checkboxWrap">
					<input type="checkbox">
					<label for="">모두 읽음 표시</label>
				</div>
			</div>


			<a class="morescroll dp_f dp_c dp_cc bora01 c_w" href="" title="알림 확인 하기">알림 확인 하기 <img src="../images/s_down.svg" alt=""> </a>
		</div>
    </div>
</div>


<?
	include '../footer.php';
?>
