<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Msg.php';


if($type == 'write'){
	$w_cade01 = trim($_POST['w_cade01']);

	$result = mysql_query("select * from ks_itemCode01 where cade01='$w_cade01'");
	$here = mysql_num_rows($result);
	
	if($here){
		Msg::backMsg('동일한 1차 분류가 등록되어있습니다.');
		exit;

	}else{

		//제일 큰 sort 가져오기
		$sql = "select max(sort) as top from ks_itemCode01";
		$result = mysql_query($sql);
		$one = mysql_result($result,0,'top');
		if($one==''){
			$one = 0;
		}else{
			$one = $one + 1;
		}

		$sql = "insert into ks_itemCode01 (cade01,sort) values ('$w_cade01',$one)";
		$result = mysql_query($sql);
	}




}elseif($type == 'edit'){
	$e_cade01 = trim($_POST['e_cade01']);
	$o_cade01 = trim($_POST['o_cade01']);

	$result = mysql_query("select * from ks_itemCode01 where cade01='$e_cade01'");
	$here = mysql_num_rows($result);
	if($here){
		Msg::backMsg("동일한 1차분류가 등록되어있습니다.");
		exit;

	}else{
		//1차분류
		$sql = "update ks_itemCode01 set cade01='$e_cade01' where cade01='$o_cade01'";
		$result = mysql_query($sql);

		//2차분류
		$sql = "update ks_itemCode02 set cade01='$e_cade01' where cade01='$o_cade01'";
		$result = mysql_query($sql);

		//3차분류
		$sql = "update ks_itemCode03 set cade01='$e_cade01' where cade01='$o_cade01'";
		$result = mysql_query($sql);

	}

	$result = mysql_query($sql);

	$next_url .= '?cade01='.$e_cade01;




}elseif($type == 'del'){
	$o_cade01 = trim($_POST['o_cade01']);

	//삭제하려는 1차분류에 해당하는 2차분류 삭제
	$sql = "delete from ks_itemCode02 where cade01='$o_cade01'";
	$result = mysql_query($sql);

	//삭제하려는 1차분류에 해당하는 3차분류 삭제
	$sql = "delete from ks_itemCode03 where cade01='$o_cade01'";
	$result = mysql_query($sql);

	//삭제하려는 1차분류의 sort 값
	$sql = "select sort from ks_itemCode01 where cade01='$o_cade01'";
	$result = mysql_query($sql);
	$old_sort = mysql_result($result,0,'sort');

	//1차분류 삭제
	$sql = "delete from ks_itemCode01 where cade01='$o_cade01'";
	$result = mysql_query($sql);



	//삭제한 1차분류 sort보다 상위인 1차분류수정
	$query2 = "select * from ks_itemCode01 where sort > $old_sort order by sort asc";
	$result = mysql_query($query2);
	$num = mysql_num_rows($result);

	if($num!='0'){
		for($i=0; $i<$num; $i++){
			$info = mysql_fetch_array($result);
			$Edit_uid = $info[uid];
			$Edit_sort = $old_sort + $i;

			$Edit_sql = "update ks_itemCode01 set sort='$Edit_sort' where uid='$Edit_uid'";
			$Edit_result = mysql_query($Edit_sql);
		}
	}




}elseif($type == 'sort'){
	$cade_list = explode("|+|",$sort_cade01);
	$num = count($cade_list)-1;

	for($i=0; $i<$num; $i++){
		$sql = "update ks_itemCode01 set sort=$i where cade01='$cade_list[$i]'";
		$result = mysql_query($sql);
	}


}





Msg::goNext($next_url);

?>