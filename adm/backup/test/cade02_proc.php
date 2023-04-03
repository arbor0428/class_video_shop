<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Msg.php';


if($type == 'write'){
	$o_cade01 = trim($_POST['o_cade01']);
	$w_cade02 = trim($_POST['w_cade02']);

	$next_url .= '?cade01='.$o_cade01;

	$result = mysql_query("select * from ks_itemCode02 where cade01='$o_cade01' and cade02='$w_cade02'");
	$here = mysql_num_rows($result);
	
	if($here){
		$msg = "동일한 2차분류가 등록되어있습니다.";
		Msg::goMsg($msg,$next_url);
		exit;

	}else{
		//제일 큰 sort 가져오기
		$sql = "select max(sort) as top from ks_itemCode02 where cade01='$o_cade01'";
		$result = mysql_query($sql);
		$one = mysql_result($result,0,'top');
		if($one==''){
			$one = 0;
		}else{
			$one = $one + 1;
		}

		$sql = "insert into ks_itemCode02 (cade01,cade02,sort) values ('$o_cade01','$w_cade02',$one)";
		$result = mysql_query($sql);
	}





}elseif($type == 'edit'){
	$o_cade01 = trim($_POST['o_cade01']);
	$o_cade02 = trim($_POST['o_cade02']);
	$e_cade02 = trim($_POST['e_cade02']);

	$next_url .= '?cade01='.$o_cade01.'&cade02='.$e_cade02;

	$result = mysql_query("select * from ks_itemCode02 where cade01='$o_cade01' and cade02='$e_cade02' and uid!='$uid_cade02'");
	$here = mysql_num_rows($result);
	if($here){
		$msg = "동일한 2차분류가 등록되어있습니다.";
		Msg::goMsg($msg,$next_url);
		exit;

	}else{
		$sql = "update ks_itemCode02 set cade02='$e_cade02' where cade01='$o_cade01' and cade02='$o_cade02'";
		$result = mysql_query($sql);

		//3차분류
		$sql = "update ks_itemCode03 set cade02='$e_cade02' where cade01='$o_cade01' and cade02='$o_cade02'";
		$result = mysql_query($sql);

	}





}elseif($type == 'del'){
	$o_cade01 = trim($_POST['o_cade01']);
	$o_cade02 = trim($_POST['o_cade02']);

	//삭제하려는 2차분류에 해당하는 3차분류 삭제
	$sql = "delete from ks_itemCode03 where cade01='$o_cade01' and cade02='$o_cade02'";
	$result = mysql_query($sql);


	//삭제하려는 2차분류의 sort 값
	$sql = "select sort from ks_itemCode02 where cade01='$o_cade01' and cade02='$o_cade02'";
	$result = mysql_query($sql);
	$old_sort = mysql_result($result,0,'sort');

	//2차분류 삭제
	$sql = "delete from ks_itemCode02 where cade01='$o_cade01' and cade02='$o_cade02'";
	$result = mysql_query($sql);


	//삭제한 2차분류의 sort보다 상위인 2차분류 수정
	$query2 = "select * from ks_itemCode02 where cade01='$o_cade01' and sort > $old_sort order by sort asc";
	$result = mysql_query($query2);
	$num = mysql_num_rows($result);

	if($num!='0'){
		for($i=0; $i<$num; $i++){
			$info = mysql_fetch_array($result);
			$Edit_uid = $info[uid];
			$Edit_sort = $old_sort + $i;

			$Edit_sql = "update ks_itemCode02 set sort='$Edit_sort' where uid='$Edit_uid'";
			$Edit_result = mysql_query($Edit_sql);
		}
	}




	$next_url .= '?cade01='.$o_cade01;





}elseif($type == 'sort'){
	$o_cade01 = trim($_POST['o_cade01']);

	$cade_list = explode("|+|",$sort_cade02);
	$num = count($cade_list)-1;

	for($i=0; $i<$num; $i++){
		$sql = "update ks_itemCode02 set sort=$i where cade01='$o_cade01' and cade02='$cade_list[$i]'";
		$result = mysql_query($sql);
	}



	$next_url .= '?cade01='.$o_cade01;
}




Msg::goNext($next_url);

?>

<form name="frm" method='post' action='<?=$next_url?>'>
<input type='hidden' name='cade01' value="<?=$o_cade01?>">
</form>

<script language='javascript'>
//document.frm.submit();
</script>