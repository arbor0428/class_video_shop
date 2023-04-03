<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
include '/home/edufim/www//module/class/class.Util.php';

define('_UPLOAD_DIR', '/upfile/prod/store');
$tot_num = '6';
$UPLOAD_DIR = "/home/edufim/www" . _UPLOAD_DIR;
$category01 = '5';

switch ($type) {
    case 'write':
    case 'edit':
        include "/home/edufim/www/module/class/class.FileUpload.php";
        include '/home/edufim/www/module/file_filtering.php';

        //파일관련처리
        for ($i = 1; $i <= $tot_num; $i++) {
            $file_num = sprintf("%02d", $i);
            $doc_name    = 'upfile' . $file_num;
            $db_set_file = ${'dbfile' . $file_num};
            $db_real_file = ${'realfile' . $file_num};

            if ($_FILES[$doc_name]['name']) {
                $temp_doc = $_FILES[$doc_name]['name'];

                //파일필터링
                file_strip($temp_doc);

                //이미지의 경우 자동번호 부여
                $ext = FileUpload::getFileExtension($_FILES[$doc_name]['name']);
                $fileUpload = new FileUpload($UPLOAD_DIR, $_FILES[$doc_name], 'P');

                if ($db_set_file) {
                    unlink($UPLOAD_DIR . "/" . $db_set_file);
                    if (is_file($UPLOAD_DIR . "/s_" . $db_set_file))    unlink($UPLOAD_DIR . "/s_" . $db_set_file);
                }

                if ($fileUpload->uploadFile()) {
                    $arr_new_file[$i] = $fileUpload->fileInfo['rename'];
                } else {
                    Msg::backMsg("파일을 다시 선택해 주십시오");
                    exit();
                }

                $real_name[$i] = $temp_doc;
            } else {
                if ($_POST["del_" . $doc_name] == 'Y') {
                    unlink($UPLOAD_DIR . "/" . $db_set_file);
                    if (is_file($UPLOAD_DIR . "/s_" . $db_set_file))    unlink($UPLOAD_DIR . "/s_" . $db_set_file);
                    $arr_new_file[$i] = '';
                    $real_name[$i] = '';
                } else {
                    $arr_new_file[$i] = $db_set_file;
                    $real_name[$i] = $db_real_file;
                }
            }
        }

        if ($type == 'write') {
            $userip = $_SERVER['REMOTE_ADDR'];
            $rTime = time();

            $query = "INSERT INTO ks_class (status, category01, title, exp, target, price, discountPrice, discountRate, shipPrice, ment01, upfile01, realfile01, upfile02, realfile02, upfile03, realfile03, upfile04, realfile04, upfile05, realfile05, upfile06, realfile06, userip, rTime) VALUES";
            $query .= " ('0', '$category01', '$title', '$exp', '$target', '$price', '$discountPrice', '$discountRate', '$shipPrice', '$ment01', '$arr_new_file[1]', '$real_name[1]', '$arr_new_file[2]', '$real_name[2]', '$arr_new_file[3]', '$real_name[3]', '$arr_new_file[4]', '$real_name[4]', '$arr_new_file[5]', '$real_name[5]', '$arr_new_file[6]', '$real_name[6]', '$userip', '$rTime')";
            $result = mysql_query($query) or die(mysql_error());
            $msg = '등록되었습니다';
            
        } elseif ($type == 'edit') {
            $query = "UPDATE ks_class SET ";
            // $query .= "cade01='$cade01', ";
            $query .= "title='$title', ";
            $query .= "exp='$exp', ";
            $query .= "target='$target', ";
            $query .= "price='$price', ";
            $query .= "discountPrice='$discountPrice', ";
            $query .= "discountRate='$discountRate', ";
            $query .= "shipPrice='$shipPrice', ";
            $query .= "ment01='$ment01' ";

            for ($i = 1; $i <= $tot_num; $i++) {
                $file_num = sprintf("%02d", $i);

                if ($arr_new_file[$i] || $del_upfile == 'Y') {
                    $query .= ", upfile$file_num='$arr_new_file[$i]' ";
                    $query .= ", realfile$file_num='$real_name[$i]' ";
                }
            }

            $query .= " WHERE uid=$uid";
            $result = mysql_query($query) or die("DB Error : " . mysql_error());
            $msg = '수정되었습니다';

        } else {
            $msg = "type is undefined";
        }

        break;

    case 'del':
        $sql = "SELECT * FROM ks_class WHERE uid='$uid'";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);

        for ($i = 1; $i <= $tot_num; $i++) {
            $file_num = sprintf("%02d", $i);
            $del_file = $row["upfile$file_num"];

            if ($del_file) {
                unlink($UPLOAD_DIR . "/" . $del_file);
                if (is_file($UPLOAD_DIR . "/thumb_" . $del_file))    unlink($UPLOAD_DIR . "/thumb_" . $del_file);
            }
        }

        $sql = "DELETE FROM ks_class WHERE uid='$uid'";
        $result = mysql_query($sql);

        $msg = '삭제되었습니다';
        break;

    case 'able':
        sqlExe("UPDATE ks_class SET status='$status' WHERE uid='$uid'");
        break;

    case 'empty':
        // sqlExe("UPDATE ks_class SET status=2 where uid=$uid");
        // $msg = '재고없음으로 변경 되었습니다';
        // break;
}

unset($dbconn);
Msg::goMsg($msg, $next_url);
?>

<!-- <form name='frm' method='post' action='<?= $next_url ?>'>
    <input type='hidden' name='record_start' value='<?= $record_start ?>'>
    <input type='hidden' name='f_c02a' value='<?= $f_c02a ?>'>
    <input type='hidden' name='f_c02b' value='<?= $f_c02b ?>'>
    <input type='hidden' name='f_c02c' value='<?= $f_c02c ?>'>
    <input type='hidden' name='f_c02d' value='<?= $f_c02d ?>'>
    <input type='hidden' name='f_title' value='<?= $f_title ?>'>
    <input type='hidden' name='f_enable01' value='<?= $f_enable01 ?>'>
    <input type='hidden' name='f_enable02' value='<?= $f_enable02 ?>'>
</form>

<script language='javascript'>
    alert('<?= $msg ?>');
    document.frm.submit();
</script> -->