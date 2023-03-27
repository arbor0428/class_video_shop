<?
include "/home/edufim/www/adm/header.php";

$tot_num = '1';    //첨부파일 최대갯수
$upfile = '/upfile/event';
$UPLOAD_DIR = _WWW . $upfile;

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
                    echo "$UPLOAD_DIR . "/" . $db_set_file";
                    unlink($UPLOAD_DIR . "/" . $db_set_file);
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
                    if (is_file($UPLOAD_DIR . "/" . $db_set_file))    unlink($UPLOAD_DIR . "/" . $db_set_file);
                    $arr_new_file[$i] = '';
                    $real_name[$i] = '';
                } else {
                    $arr_new_file[$i] = $db_set_file;
                    $real_name[$i] = $db_real_file;
                }
            }
        }

        if ($type == 'write') {
            $sDate = date('Y-m-d', strtotime($sDate));
            $eDate = date('Y-m-d', strtotime($eDate));
            $rTime = time();

            $sql = "INSERT INTO ks_event (status, title, exp, target, upfile01, realfile01, coupon_uid, sDate, eDate, ment01,  rTime) VALUES";
            $sql .= " (0, '$title', '$exp', '$target', '$arr_new_file[1]', '$real_name[1]', '$coupon_uid', '$sDate', '$eDate', '$ment01',  $rTime)";
            $result = sqlExe($sql);
            $msg = '등록되었습니다';

        } else if ($type == 'edit') {
            $sql = "UPDATE ks_event SET ";
            $sql .= "title='$title',";
            $sql .= "exp='$exp',";
            $sql .= "target='$target',";
            $sql .= "coupon_uid='$coupon_uid',";
            $sql .= "sDate='$sDate',";
            $sql .= "eDate='$eDate',";
            $sql .= "ment01='$ment01'";

            if ($arr_new_file[1] || $del_upfile01 == 'Y') {
                $sql .= ", upfile01='$arr_new_file[1]'";
                $sql .= ", realfile01='$real_name[1]'";
            }

            $sql .= " WHERE uid=$uid";
            $result = sqlExe($sql);

            $msg = '수정되었습니다';
        } else {
            $msg = "type is undefined";
        }

        break;

    case 'del':
        $sql = "SELECT * FROM ks_event WHERE uid='$uid'";
        $result = sqlExe($sql);
        $row = mysql_fetch_array($result);

        $del_file01 = $row['upfile01'];

        if ($del_file01) {
            unlink($UPLOAD_DIR . "/" . $del_file01);
            if (is_file($UPLOAD_DIR . "/thumb_" . $del_file01))    unlink($UPLOAD_DIR . "/thumb_" . $del_file01);
        }

        $sql = "DELETE FROM ks_event WHERE uid=$uid";
        $result = sqlExe($sql);

        $msg = '삭제되었습니다';

        break;

    case 'able':
        sqlExe("UPDATE ks_event SET status='$status' WHERE uid='$uid'");
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
</form>

<script language='javascript'>
	alert('<?= $msg ?>');
	document.frm.submit();
</script> -->