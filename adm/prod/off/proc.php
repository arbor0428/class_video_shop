<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
include "/home/edufim/www/module/class/class.FileUpload.php";
include "/home/edufim/www/module/class/class.Util.php";

$tot_num = '1';
$UPLOAD_DIR = "/home/edufim/www/upfile/prod/off";
$category01 = '4';

// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// foreach($_POST as $k => $v){
// 	echo "$k : $v <br>";
// }

switch ($type) {
    case 'write':
    case 'edit':
        //첨부파일제한
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

            $query = "INSERT INTO ks_class (status, category01, tuid, title, exp, target, period, price, discountPrice, discountRate, ment01, upfile01, realfile01, userip, rTime) VALUES";
            $query .= " ('0', '$category01', '$tuid', '$title', '$exp', '$target', '$period', '$price', '$discountPrice', '$discountRate', '$ment01', '$arr_new_file[1]', '$real_name[1]', '$userip', '$rTime')";
            $result = mysql_query($query) or die(mysql_error());
            $msg = '등록되었습니다';

        } elseif ($type == 'edit') {
            $query = "UPDATE ks_class SET ";
            // $query .= "cade01='$cade01', ";
            // $query .= "cade02='$cade02', ";
            $query .= "tuid='$tuid', ";
            $query .= "title='$title', ";
            $query .= "exp='$exp', ";
            $query .= "target='$target', ";
            $query .= "period='$period', ";
            $query .= "price='$price', ";
            $query .= "discountPrice='$discountPrice', ";
            $query .= "discountRate='$discountRate', ";
            $query .= "ment01='$ment01' ";
            // $query .= "ment02='$ment02' ";

            if ($arr_new_file[1] || $del_upfile01 == 'Y') {
                $query .= ", upfile01='$arr_new_file[1]' ";
                $query .= ", realfile01='$real_name[1]' ";
            }
            // for ($i = 1; $i <= $tot_num; $i++) {
            //     $file_num = sprintf("%02d", $i);

            //     if ($arr_new_file[$i] || $del_upfile == 'Y') {
            //         $sql .= ", upfile$file_num='$arr_new_file[$i]' ";
            //         $sql .= ", realfile$file_num='$real_name[$i]' ";
            //     }
            // }

            $query .= " WHERE uid=$uid";
            $result = mysql_query($query) or die("DB Error : " . mysql_error());
            $msg = '수정되었습니다';
        } else {
            $msg = "type is undefined";
        }

        break;

    case 'del':
        $query = "SELECT * FROM ks_class WHERE uid='$uid'";
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);
        $del_file01 = $row['upfile01'];

        if ($del_file01) {
            unlink($UPLOAD_DIR . "/" . $del_file01);
            if (is_file($UPLOAD_DIR . "/thumb_" . $del_file01)) unlink($UPLOAD_DIR . "/thumb_" . $del_file01);
        }

        $query = "DELETE FROM ks_class WHERE uid='$uid'";
        $result = mysql_query($query) or die(mysql_error());

        $msg = '삭제되었습니다';
        break;

    case 'able':
        sqlExe("UPDATE ks_class SET status='$status' WHERE uid='$uid'");
        break;
        
    case 'CADE':
        if (!$cade01) {
            echo "NULL";
            exit;
        } else {
            $cade02 = sqlArray("SELECT * FROM ks_class_cade02 WHERE cade01=$cade01 ORDER BY sort");
            echo json_encode($cade02, JSON_UNESCAPED_UNICODE);
        }
        exit;
        break;
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
	<input type='hidden' name='cade01' value='<?= $cade01 ?>'>
</form>

<script language='javascript'>
	alert('<?= $msg ?>');
	document.frm.submit();ㅋㅋ
</script> -->