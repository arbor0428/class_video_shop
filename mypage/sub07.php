<?
	include '../header.php';
	$side_menu=7;
?>


<div class="subWrap">
    <div class="s_center dp_sb">
        <?
			include 'sidemenu.php';
		?>
		<div class="s_cont">
			<div class="s_cont_tit m_10">
				<ul class="s_cont_tabbtn dp_f">
					<li><a href="/sub11/sub03.php">수강중인 강좌</a></li>
					<li><a href="/sub11/sub04.php">찜한 강좌</a></li>
					<li><a href="/sub11/sub05.php">나의 학습질문</a></li>
					<li><a href="/sub11/sub06.php">나의 리뷰</a></li>
					<li class="on"><a href="/sub11/sub07.php">수강증 발급</a></li>
					<li><a href="/sub11/sub08.php">수료증 발급</a></li>
					<li><a href="/sub11/sub09.php">자격증 발급</a></li>
				</ul>
			</div>
			<p class="c_gry04 f14 m_40">수강신청하신 강좌 또는 패스의 수강증 발급이 가능합니다.</p>
			
			<!--수강중인 강좌가 없을때 보여지는 부분-->
			<div class="noListShow">
				<p class="txt-c bold2">수강중인 강좌가 없습니다.</p>
				<p class="txt-c c_gry04 f15">나를 성장 시켜줄 좋은 지식들을 수강해보세요.</p>
				<a class="goClassList c_bora01 dp_f dp_c dp_cc" href="" title="강좌리스트 보러가기">강좌리스트 보러가기</a>
			</div>


			<!--수강중인 강좌가 있을때 보여지는 부분-->
			<div class="class_searchBar">
				<p class="chkBoxTit dp_f dp_c m_10 bold2">수강증 발급을 원하시는 강좌 또는 패스를 선택해 주세요.</p>
				<div class="chkBoxwrap dp_f dp_c">
					<div class="selectwrap dp_f dp_c wid400">
						<select name="" id="">
							<option value="">강좌명 선택</option>
						</select>
					</div>
					<div class="inputwrap dp_f dp_c">
						<input type="checkbox">
						<label for="">결제 금액</label>
					</div>
					<div class="inputwrap dp_f dp_c">
						<input type="checkbox">
						<label for="">학습 진도</label>
					</div>
				</div>
				<p class="c_gry04 f14 m-12">* 패스 상품의 개별 강좌 수강 확인증은 발급이 어렵습니다.</p>
				<a class="classRegiBtn dp_f dp_c dp_cc" href="" title="신청하기">신청하기</a>
			</div>
		</div>
    </div>
</div>

<script>
	function tema(t){
		$('#classConsFrame').html("<iframe src='/sub09/classConfirm.php?uid="+t+"' name='' style='width:100%;height:650px;' frameborder='0' scrolling='auto'></iframe>");
		$('.classConsBox_open').click();
	}

	$(".classRegiBtn ").click(function(event){
		tid = $(this).data('tid');
		tema(tid);
		event.preventDefault();
	});
</script>


<?
	include '../footer.php';
?>
