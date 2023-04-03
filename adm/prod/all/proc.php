<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
include "/home/edufim/www/module/class/class.FileUpload.php";
include "/home/edufim/www/module/class/class.Util.php";

$tot_num = '6';    //첨부파일 최대갯수
$UPLOAD_DIR = "/home/edufim/www/upfile/class";

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

        // ks_class_cade
        // $cade01 = replaceZero($cade01);
        // $cade02 = replaceZero($cade02);
        // $cade03 = replaceZero($cade03);

        // editor
        // if ($ment01)	$ment01 = $UTIL->textareaEncodeing($ment01);
        // if ($ment02)	$ment02 = $UTIL->textareaEncodeing($ment02);

        if ($type == 'write') {
            $shipPrice = 0;
            $userip = $_SERVER['REMOTE_ADDR'];
            $rTime = time();
            // $rDate = date('Y-m-d H:i:s');

            $query = "INSERT INTO ks_class (status, prod_type, cade01, cade02, cade03, tuid, title, exp, target, period, price, discountPrice, discountRate, shipPrice, certPrice, ment01, upfile01, realfile01, upfile02, realfile02, upfile03, realfile03, upfile04, realfile04, upfile05, realfile05, upfile06, realfile06, userip, rTime) VALUES";
            $query .= " (0, '$prod_type', '$cade01', '$cade02', '$cade03', '$tuid', '$title', '$exp', '$target', '$period', '$price', '$discountPrice', '$discountRate', '$shipPrice', '$certPrice', '$ment01', '$arr_new_file[1]', '$real_name[1]', '$arr_new_file[2]', '$real_name[2]', '$arr_new_file[3]', '$real_name[3]', '$arr_new_file[4]', '$real_name[4]', '$arr_new_file[5]', '$real_name[5]', '$arr_new_file[6]', '$real_name[6]', '$userip', '$rTime')";
            $result = mysql_query($query) or die("DB Error : " . mysql_error() . "<br>" . $query);
            $msg = '등록되었습니다';

        } elseif ($type == 'edit') {
            $query = "UPDATE ks_class SET";
            $query .= " prod_type='$prod_type',";
            $query .= " cade01='$cade01',";
            $query .= " cade02='$cade02',";
            $query .= " cade03='$cade03',";
            // $query .= " cade04='$cade04',";
            $query .= " tuid='$tuid',";
            $query .= " title='$title',";
            $query .= " exp='$exp',";
            $query .= " target='$target',";
            $query .= " period='$period',";
            $query .= " price='$price',";
            $query .= " discountPrice='$discountPrice',";
            $query .= " discountRate='$discountRate',";
            $query .= " certPrice='$certPrice',";
            $query .= " ment01='$ment01',";

            if ($arr_new_file[1] || $del_upfile01 == 'Y') {
                $query .= " upfile01='$arr_new_file[1]',";
                $query .= " realfile01='$real_name[1]',";
            }
            if ($arr_new_file[2] || $del_upfile02 == 'Y') {
                $query .= " upfile02='$arr_new_file[2]',";
                $query .= " realfile02='$real_name[2]',";
            }
            if ($arr_new_file[3] || $del_upfile03 == 'Y') {
                $query .= " upfile03='$arr_new_file[3]',";
                $query .= " realfile03='$real_name[3]',";
            }
            if ($arr_new_file[4] || $del_upfile04 == 'Y') {
                $query .= " upfile04='$arr_new_file[4]',";
                $query .= " realfile04='$real_name[4]',";
            }
            if ($arr_new_file[5] || $del_upfile05 == 'Y') {
                $query .= " upfile05='$arr_new_file[5]',";
                $query .= " realfile05='$real_name[5]',";
            }
            if ($arr_new_file[6] || $del_upfile06 == 'Y') {
                $query .= " upfile06='$arr_new_file[6]',";
                $query .= " realfile06='$real_name[6]',";
            }
            $query = substr($query , 0, -1);

            $query .= " WHERE uid=$uid";
            $result = mysql_query($query) or die("DB Error : " . mysql_error() . "<br>" . $query);
            $msg = '수정되었습니다';

        } else {
            $msg = "INVALID TYPE";
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

    case 'CADE2':
        if (!$cade01 || !$cade02) {
            echo "NULL";
            exit;
        } else {
            $cade03 = sqlArray("SELECT * FROM ks_class_cade03 WHERE cade01=$cade01 AND cade02=$cade02 ORDER BY sort");
            echo json_encode($cade03, JSON_UNESCAPED_UNICODE);
        }
        exit;
        break;

    case 'CADE3':
        if (!$cade01 || !$cade02 || !$cade03) {
            echo "NULL";
            exit;
        } else {
            $cade04 = sqlArray("SELECT * FROM ks_class_cade04 WHERE cade01=$cade01 AND cade02=$cade02 AND cade03=$cade03 ORDER BY sort");
            echo json_encode($cade04, JSON_UNESCAPED_UNICODE);
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