<div id="location">
	<div class="all-wrap">
		<div class="loca-wrap clearfix">
			<div class="loca-area clearfix">
				<ul>
					<li>
						<button type="button"><span>학습 관리</span></button>
						<div class="next-depth">
							<ul style="display: none;">
								<li><a href="./sub01.php">HOME</a></li>
								<li><a href="./cart.php">강좌신청 관리</a></li>
								<li><a href="./sub14.php">설정</a></li>
							</ul>
						</div>
					</li>
				</ul>
				<ul>
					<li class="submenu-list">
						<button type="button"><span><?=$topTxt01?></span></button>
						<div class="next-depth">
							<ul style="display: none;">
								<li><a href="./learning/index.php">수강중인 강좌</a></li>
								<li><a href="./sub04.php">찜한 강좌</a></li>
								<li><a href="./sub05.php">나의 학습질문</a></li>
								<li><a href="./sub06.php">나의 리뷰</a></li>
								<li><a href="./sub07.php">수강증 발급</a></li>
								<li><a href="./sub08.php">수료증 발급</a></li>
								<li><a href="./sub09.php">자격증 발급</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
	// 로케이션 바 하위뎁스 관련
	var loca_v = false;
    var clk_area = "";
    var _this = "";
    $(".loca-area ul li button").on("click", function(){
        _this = $(this);
        clk_area = _this.parent("li"); 
        if ( loca_v == false ){
            _this.addClass("active"); 
			clk_area.find(".next-depth ul").slideDown();
            loca_v = true;
        } else {
            _this.removeClass("active"); 
            loca_v = false;
			clk_area.find(".next-depth ul").slideUp();
        }
        clk_area.mouseleave(function(){
            clk_area.find("button").removeClass("active"); 
            loca_v = false;
			clk_area.find(".next-depth ul").slideUp();
        })
    })
</script>