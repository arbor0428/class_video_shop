<?
    $side[$side_menu]="content_box_a03";
    $side02[$side_menu02]="on";
?>

<div class='sidemenu sidemenu02'>
	<a href="/sub01/allList.php" class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc" title="ALL클래스">ALL클래스</a>
	<ul class="sidemenu_list">
		<li class='<?=$side[1]?>'>
            <img src="/images/sub/arr_btn1.svg" alt="화살표">
            <a class="dp_sb dp_c" href='/sub01/sub01.php'>체형분석 전문가</a>
            <ul class="depth2">
                <li class='<?=$side02[1]?>'><a href="/sub01/sub01_01.php" title="하위메뉴">하위메뉴</a></li>
                <li class='<?=$side02[2]?>'><a href="/sub01/sub01_02.php" title="하위메뉴">하위메뉴</a></li>
                <li class='<?=$side02[3]?>'><a href="" title="하위메뉴">하위메뉴</a></li>
            </ul>
        </li>
	</ul>
	<ul class="sidemenu_list">
		<li class='<?=$side[2]?>'>
            <img src="/images/sub/arr_btn1.svg" alt="화살표">
            <a class="dp_sb dp_c" href='/sub01/sub02.php'>전문가 심화</a>
            <ul class="depth2">
                <li class='<?=$side02[4]?>'><a href="/sub01/sub02_01.php" title="하위메뉴">하위메뉴</a></li>
                <li class='<?=$side02[5]?>'><a href="/sub01/sub02_02.php" title="하위메뉴">하위메뉴</a></li>
                <li class='<?=$side02[6]?>'><a href="" title="하위메뉴">하위메뉴</a></li>
            </ul>
        </li>
	</ul>
	<ul class="sidemenu_list">
		<li class='<?=$side[3]?>'>
            <img src="/images/sub/arr_btn1.svg" alt="화살표">
            <a href='/sub01/sub03_01.php'>필라테스 처방사</a>
            <ul class="depth2">
                <li class='<?=$side02[7]?>'><a href="" title="하위메뉴">하위메뉴</a></li>
                <li class='<?=$side02[8]?>'><a href="" title="하위메뉴">하위메뉴</a></li>
                <li class='<?=$side02[9]?>'><a href="" title="하위메뉴">하위메뉴</a></li>
            </ul>
        </li>
	</ul>
	<ul class="sidemenu_list">
		<li class='<?=$side[4]?>'>
            <img src="/images/sub/arr_btn1.svg" alt="화살표">
            <a class="dp_sb dp_c" href='/sub09/sub04.php'>오프라인 자격증</a>
            <ul class="depth2">
                <li class='<?=$side02[10]?>'><a href="" title="하위메뉴">하위메뉴</a></li>
                <li class='<?=$side02[11]?>'><a href="" title="하위메뉴">하위메뉴</a></li>
                <li class='<?=$side02[12]?>'><a href="" title="하위메뉴">하위메뉴</a></li>
            </ul>
        </li>
	</ul>
</div>

<script>
    	var flag = true;
		$(".sidemenu02 .sidemenu_list > li > img").click(function(){

            if($(this).parent().hasClass("content_box_a03")){

                $(this).parent().removeClass("content_box_a03");
                $(this).siblings(".depth2").stop().slideUp();
                                
            }else{

                $(this).parent().addClass("content_box_a03");
                $(this).parent().siblings().children(".depth2").stop().hide();
                $(this).siblings(".depth2").stop().slideDown();

            }
		});

</script>