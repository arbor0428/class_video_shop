<?
   // if (!isLogin()) redirectLogin();
	
    $userid = $GBL_USERID;
	$side[$side_menu]="content_box_a";
?>

<div class='sidemenu'>
	<div class="bora c_w sideTit f22 bold2 dp_inline dp_c dp_cc">Q&A</div>
	<ul class="sidemenu_list">
		<li class='<?=$side[1]?>'><a href='/sub10/sub01.php'>공지사항</a></li>
		<li class='<?=$side[2]?>'><a href='/sub10/sub02.php'>창업문의</a></li>
		<li class='<?=$side[3]?>'><a href='/sub10/sub03.php'>지부문의</a></li>
	</ul>
</div>