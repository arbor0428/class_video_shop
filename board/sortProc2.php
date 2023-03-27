<?
	include "/home/atx/www/module/login/head2.php";	
	include "/home/atx/www/module/class/class.DbCon.php";
	include "/home/atx/www/module/class/class.Util.php";
	include "/home/atx/www/module/class/class.Msg.php";


	$sql = "update tb_board_list set msort='' where table_id='table_1674052533'";
	$result = mysql_query($sql);

	//순서변경
	for($i=0; $i<count($chk); $i++){
		$sql = "update tb_board_list set msort='$i' where uid='$chk[$i]'";
		$result = mysql_query($sql);
		
	}
		
	Msg::goMsg('저장되었습니다.','/board/sort.php');
?>