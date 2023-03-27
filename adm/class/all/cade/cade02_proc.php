<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

$MSG = new Msg();

error_reporting(E_ALL);
ini_set('display_errors', '1');
if ($type == 'write') {
	$o_cade01 = trim($_POST['o_cade01']);
	$w_cade02 = trim($_POST['w_cade02']);

	$cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='$o_cade01'");
	// $next_url .= '?cade01=' . $cade01;

	$result = mysql_query("select * from ks_class_cade02 where cade01='$cade01' and title='$w_cade02'");
	$here = mysql_num_rows($result);

	if ($here) {
		$msg = "동일한 카테고리가 존재합니다.";
		$MSG->goMsg($msg, $next_url);
		exit;
	} else {
		//제일 큰 sort 가져오기
		$sql = "select max(sort) as top from ks_class_cade02 where cade01='$cade01'";
		$result = mysql_query($sql);
		$one = mysql_result($result, 0, 'top');
		if ($one == '') {
			$one = 1;
		} else {
			$one = $one + 1;
		}

		$sql = "insert into ks_class_cade02 (cade01, title, sort) values ($cade01, '$w_cade02', $one)";
		$result = mysql_query($sql);
	}
} elseif ($type == 'edit') {
	$o_cade01 = trim($_POST['o_cade01']);
	$o_cade02 = trim($_POST['o_cade02']);
	$e_cade02 = trim($_POST['e_cade02']);

	$cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='$o_cade01'");
	// $next_url .= '?cade01=' . $cade01;

	$result = mysql_query("select * from ks_class_cade02 where cade01='$cade01' and title='$e_cade02'");
	$here = mysql_num_rows($result);
	if ($here) {
		$msg = "동일한 카테고리가 존재합니다.";
		$MSG->goMsg($msg, $next_url);
		exit;
	} else {
		$sql = "update ks_class_cade02 set title='$e_cade02' where cade01='$cade01' and title='$o_cade02'";
		$result = mysql_query($sql);
	}
} elseif ($type == 'del') {
	$o_cade01 = trim($_POST['o_cade01']);
	$o_cade02 = trim($_POST['o_cade02']);

	$cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='$o_cade01'");
	$cade02 = sqlRowOne("SELECT uid FROM ks_class_cade02 WHERE title='$o_cade02'");

	$class_num_rows = sqlRowOne("SELECT COUNT(1) FROM ks_class WHERE cade01='$cade01' AND cade02='$cade02'");

    if ($class_num_rows > 0) {
		$MSG->backMsg('해당 카테고리에 등록된 강의가 존재합니다.\n등록된 강의를 먼저 삭제해주세요.');
		exit;
	} else {
        //삭제하려는 진료항목의 sort 값
        $sql = "select sort from ks_class_cade02 where cade01='$cade01' and title='$o_cade02'";
        $result = mysql_query($sql);
        $old_sort = mysql_result($result, 0, 'sort');
    
        //진료항목 삭제
        $sql = "delete from ks_class_cade02 where cade01='$cade01' and title='$o_cade02'";
        $result = mysql_query($sql);
    
        //삭제한 진료항목의 sort보다 상위인 진료항목 수정
        $query2 = "select * from ks_class_cade02 where cade01='$cade01' and sort > $old_sort order by sort asc";
        $result = mysql_query($query2);
        $num = mysql_num_rows($result);
    
        if ($num != '0') {
            for ($i = 0; $i < $num; $i++) {
                $info = mysql_fetch_array($result);
                $Edit_uid = $info['uid'];
                $Edit_sort = $old_sort + $i;
    
                $Edit_sql = "update ks_class_cade02 set sort='$Edit_sort' where uid='$Edit_uid'";
                $Edit_result = mysql_query($Edit_sql);
            }
        }
    }


} elseif ($type == 'sort') {
	$o_cade01 = trim($_POST['o_cade01']);

	$cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='$o_cade01'");
	// $next_url .= '?cade01=' . $cade01;

	$cade_list = explode("|+|", $sort_cade02);
	$num = count($cade_list) - 1;

	for ($i = 0; $i < $num; $i++) {
		$sort = $i + 1;
		$sql = "update ks_class_cade02 set sort=$sort where cade01='$cade01' and title='$cade_list[$i]'";
		$result = mysql_query($sql);
	}
}
// $MSG->goNext($next_url);
?>

<form name="frm" method='post' action='<?=$next_url?>'>
	<input type='hidden' name='cade01' value="<?=$cade01?>">
</form>
<script language='javascript'>
	document.frm.submit();
</script>