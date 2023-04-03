<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";

$MSG = new Msg();

$o_cade01 = trim($_POST['o_cade01']);
$o_cade02 = trim($_POST['o_cade02']);
$o_cade03 = trim($_POST['o_cade03']);

$cade01 = sqlRowOne("SELECT uid FROM ks_class_cade01 WHERE title='$o_cade01'");
$cade02 = sqlRowOne("SELECT uid FROM ks_class_cade02 WHERE cade01='$cade01' AND title='$o_cade02'");
$cade03 = sqlRowOne("SELECT uid FROM ks_class_cade03 WHERE cade01='$cade01' AND cade02='$cade02' AND title='$o_cade03'");
// $next_url .= '?cade01=' . $cade01;

if ($type == 'write') {
    $w_cade03 = trim($_POST['w_cade03']);

    $result = mysql_query("SELECT * FROM ks_class_cade03 WHERE cade01='$cade01' AND cade02='$cade02' AND title='$w_cade03'");
    $here = mysql_num_rows($result);

    if ($here) {
        $msg = "동일한 카테고리가 존재합니다.";
        $MSG->goMsg($msg, $next_url);
        exit;
    } else {
        //제일 큰 sort 가져오기
        $sql = "SELECT MAX(sort) AS top FROM ks_class_cade03 WHERE cade01='$cade01' AND cade02='$cade02'";
        $result = mysql_query($sql);
        $one = mysql_result($result, 0, 'top');
        if ($one == '') {
            $one = 1;
        } else {
            $one = $one + 1;
        }

        $sql = "INSERT INTO ks_class_cade03 (cade01, cade02, title, sort) VALUES ($cade01, $cade02, '$w_cade03', $one)";
        $result = mysql_query($sql);
    }

} elseif ($type == 'edit') {
    $e_cade03 = trim($_POST['e_cade03']);

    $result = mysql_query("SELECT * FROM ks_class_cade03 WHERE cade01='$cade01' AND cade02='$cade02' AND title='$e_cade03'");
    $here = mysql_num_rows($result);
    if ($here) {
        $msg = "동일한 카테고리가 존재합니다.";
        $MSG->goMsg($msg, $next_url);
        exit;
    } else {
        $sql = "UPDATE ks_class_cade03 SET title='$e_cade03' WHERE cade01='$cade01' AND cade02='$cade02' AND title='$o_cade03'";
        $result = mysql_query($sql);
    }

} elseif ($type == 'del') {
    $class_num_rows = sqlRowOne("SELECT COUNT(1) FROM ks_class WHERE cade01='$cade01' AND cade02='$cade02' AND cade03='$cade03'");

    if ($class_num_rows > 0) {
        $MSG->backMsg('해당 카테고리에 등록된 강의가 존재합니다.\n등록된 강의를 먼저 삭제해주세요.');
        exit;
    } else {
        //삭제 항목 sort 값
        $sql = "SELECT sort FROM ks_class_cade03 WHERE cade01='$cade01' AND cade02='$cade02' AND title='$o_cade03'";
        $result = mysql_query($sql) or die("DB Error : " . mysql_error() . "<br>". $sql);
        $old_sort = mysql_result($result, 0, 'sort');

        //항목 삭제
        $sql = "DELETE FROM ks_class_cade03 WHERE cade01='$cade01' AND cade02='$cade02' AND title='$o_cade03'";
        $result = mysql_query($sql) or die("DB Error : " . mysql_error() . "<br>". $sql);

        //삭제한 항목의 sort보다 상위인 항목 수정
        $query2 = "SELECT * FROM ks_class_cade03 WHERE cade01='$cade01' AND cade02='$cade02' AND sort > $old_sort ORDER BY sort ASC";
        $result = mysql_query($query2);
        $num = mysql_num_rows($result);

        if ($num != '0') {
            for ($i = 0; $i < $num; $i++) {
                $info = mysql_fetch_array($result);
                $Edit_uid = $info['uid'];
                $Edit_sort = $old_sort + $i;

                $Edit_sql = "UPDATE ks_class_cade03 SET sort='$Edit_sort' WHERE uid='$Edit_uid'";
                $Edit_result = mysql_query($Edit_sql) or die("DB Error : " . mysql_error() . "<br>". $sql);
            }
        }
    }

} elseif ($type == 'sort') {
    $cade_list = explode("|+|", $sort_cade03);
    $num = count($cade_list) - 1;

    for ($i = 0; $i < $num; $i++) {
        $sort = $i + 1;
        $sql = "UPDATE ks_class_cade03 SET sort=$sort WHERE cade01='$cade01' AND cade02='$cade02' AND title='$cade_list[$i]'";
        $result = mysql_query($sql);
    }
}
// $MSG->goNext($next_url);
?>

<form name="frm" method='post' action='<?= $next_url ?>'>
    <input type='hidden' name='cade01' value="<?= $cade01 ?>">
    <input type='hidden' name='cade02' value="<?= $cade02 ?>">
</form>
<script language='javascript'>
    document.frm.submit();
</script>