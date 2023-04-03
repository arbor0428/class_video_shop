<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Msg.php';


if($type == 'write'){
	$o_cade01 = trim($_POST['o_cade01']);
	$o_cade02 = trim($_POST['o_cade02']);
	$w_cade03 = trim($_POST['w_cade03']);

	$next_url .= '?cade01='.$o_cade01.'&cade02='.$o_cade02;

	$result = mysql_query("select * from ks_itemCode03 where cade01='$o_cade01' and cade02='$o_cade02' and cade03='$w_cade03'");
	$here = mysql_num_rows($result);
	
	if($here){
		$msg = "동일한 3차분류가 등록되어있습니다.";
		Msg::goMsg($msg,$next_url);
		exit;

	}else{
		//제일 큰 sort 가져오기
		$sql = "select max(sort) as top from ks_itemCode03 where cade01='$o_cade01' and cade02='$o_cade02'";
		$result = mysql_query($sql);
		$one = mysql_result($result,0,'top');
		if($one==''){
			$one = 0;
		}else{
			$one = $one + 1;
		}

		$sql = "insert into ks_itemCode03 (cade01,cade02,cade03,sort) values ('$o_cade01','$o_cade02','$w_cade03',$one)";
		$result = mysql_query($sql);
	}




}elseif($type == 'edit'){
	$o_cade01 = trim($_POST['o_cade01']);
	$o_cade02 = trim($_POST['o_cade02']);
	$o_cade03 = trim($_POST['o_cade03']);
	$e_cade03 = trim($_POST['e_cade03']);

	$next_url .= '?cade01='.$o_cade01.'&cade02='.$o_cade02;

	$result = mysql_query("select * from ks_itemCode03 where cade01='$o_cade01' and cade02='$o_cade02' and cade03='$e_cade03' and uid!='$uid_cade03'");
	$here = mysql_num_rows($result);
	if($here){
		$msg = "동일한 3차분류가 등록되어있습니다.";
		Msg::goMsg($msg,$next_url);
		exit;

	}else{
		//사업수정
		$sql = "update ks_itemCode03 set cade03='$e_cade03' where cade01='$o_cade01' and cade02='$o_cade02' and cade03='$o_cade03'";
		$result = mysql_query($sql);


	}




}elseif($type == 'del'){
	$o_cade01 = trim($_POST['o_cade01']);
	$o_cade02 = trim($_POST['o_cade02']);
	$o_cade03 = trim($_POST['o_cade03']);

	//삭제하려는 3차분류의 sort 값
	$sql = "select sort from ks_itemCode03 where cade01='$o_cade01' and cade02='$o_cade02' and cade03='$o_cade03'";
	$result = mysql_query($sql);
	$old_sort = mysql_result($result,0,'sort');

	//3차분류 삭제
	$sql = "delete from ks_itemCode03 where cade01='$o_cade01' and cade02='$o_cade02' and cade03='$o_cade03'";
	$result = mysql_query($sql);


	//삭제한 3차분류의 sort보다 상위인 3차분류 수정
	$query2 = "select * from ks_itemCode03 where cade01='$o_cade01' and cade02='$o_cade02' and sort > $old_sort order by sort asc";
	$result = mysql_query($query2);
	$num = mysql_num_rows($result);

	if($num!='0'){
		for($i=0; $i<$num; $i++){
			$info = mysql_fetch_array($result);
			$Edit_uid = $info[uid];
			$Edit_sort = $old_sort + $i;

			$Edit_sql = "update ks_itemCode03 set sort='$Edit_sort' where uid='$Edit_uid'";
			$Edit_result = mysql_query($Edit_sql);
		}
	}




	$next_url .= '?cade01='.$o_cade01.'&cade02='.$o_cade02;





}elseif($type == 'sort'){
	$o_cade01 = trim($_POST['o_cade01']);
	$o_cade02 = trim($_POST['o_cade02']);

	$cade_list = explode("|+|",$sort_cade03);
	$num = count($cade_list)-1;

	for($i=0; $i<$num; $i++){
		$sql = "update ks_itemCode03 set sort=$i where cade01='$o_cade01' and cade02='$o_cade02' and cade03='$cade_list[$i]'";
		$result = mysql_query($sql);
	}



	$next_url .= '?cade01='.$o_cade01.'&cade02='.$o_cade02;



}




Msg::goNext($next_url);

?>

<form name="frm" method='post' action='<?=$next_url?>'>
<input type='hidden' name='cade02' value="<?=$o_cade02?>">
</form>

<script language='javascript'>
//document.frm.submit();
</script>