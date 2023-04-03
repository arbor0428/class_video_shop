<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

$MSG = new Msg();

if ($type == 'write') {
	$w_cade01 = trim($_POST['w_cade01']);

	$result = mysql_query("select * from ks_license_cade01 where title='$w_cade01'");
	$here = mysql_num_rows($result);

	if ($here) {
		$MSG->backMsg("동일한 카테고리가 존재합니다.");
		exit;
	} else {
		//제일 큰 sort 가져오기
		$sql = "select max(sort) as top from ks_license_cade01";
		$result = mysql_query($sql);
		$one = mysql_result($result, 0, 'top');
		if ($one == '') {
			$one = 1;
		} else {
			$one = $one + 1;
		}

		$sql = "insert into ks_license_cade01 (title, sort) values ('$w_cade01', $one)";
		$result = mysql_query($sql);
	}

} elseif ($type == 'edit') {
	$e_cade01 = trim($_POST['e_cade01']);
	$o_cade01 = trim($_POST['o_cade01']);

	$result = mysql_query("select * from ks_license_cade01 where title='$e_cade01'");
	$here = mysql_num_rows($result);
	if ($here) {
		$MSG->backMsg("동일한 카테고리가 존재합니다.");
		exit;
	} else {
		$sql = "update ks_license_cade01 set title='$e_cade01' where title='$o_cade01'";
		$result = mysql_query($sql);

		$sql = "update ks_license_cade02 set title='$e_cade01' where title='$o_cade01'";
		$result = mysql_query($sql);
	}

	$result = mysql_query($sql);
} elseif ($type == 'del') {
	$o_cade01 = trim($_POST['o_cade01']);

	$cade01 = sqlRowOne("SELECT uid FROM ks_license_cade01 WHERE title='$o_cade01'");

	$class_num_rows = sqlRowOne("SELECT COUNT(1) FROM ks_license WHERE cade01='$cade01'");

	if ($class_num_rows > 0) {
		$MSG->backMsg('해당 카테고리에 등록된 강의가 존재합니다.\n등록된 강의를 먼저 삭제해주세요.');
		exit;
	} else {
		$sql = "delete from ks_license_cade02 where title='$o_cade01'";
		$result = mysql_query($sql);
	
		$sql = "select sort from ks_license_cade01 where title='$o_cade01'";
		$result = mysql_query($sql);
		$old_sort = mysql_result($result, 0, 'sort');
	
		$sql = "delete from ks_license_cade01 where title='$o_cade01'";
		$result = mysql_query($sql);
	
		$query2 = "select * from ks_license_cade01 where sort > $old_sort order by sort asc";
		$result = mysql_query($query2);
		$num = mysql_num_rows($result);
	
		if ($num != '0') {
			for ($i = 0; $i < $num; $i++) {
				$info = mysql_fetch_array($result);
				$Edit_uid = $info['uid'];
				$Edit_sort = $old_sort + $i;
	
				$Edit_sql = "update ks_license_cade01 set sort='$Edit_sort' where uid='$Edit_uid'";
				$Edit_result = mysql_query($Edit_sql);
			}
		}
	}

} elseif ($type == 'sort') {
	$cade_list = explode("|+|", $sort_cade01);
	$num = count($cade_list) - 1;

	for ($i = 0; $i < $num; $i++) {
		$sort = $i + 1;
		$sql = "update ks_license_cade01 set sort=$sort where title='$cade_list[$i]'";
		$result = mysql_query($sql);
	}
}

$MSG->goNext($next_url);
