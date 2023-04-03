<?php
define('_WWW', '/home/edufim/www');
include _WWW . "/module/class/class.DbCon.php";
include _WWW . "/module/class/class.Msg.php";
$MSG = new Msg();

$etype = 'CLASS';
$UPLOAD_DIR = _WWW . '/upfile/exam';

$input_name = 'file01';
$file = $_FILES[$input_name];
$file_names = $file['name'];

if ($type == 'ADD') {
    $last_q++;
    if ($last_q > 0 && $last_q <= 10) {
        $query = "INSERT INTO ks_exam (class_uid, etype, qnum) VALUES";
        $query .= " ('$uid', '$etype', '$last_q')";
        $result = mysql_query($query) or die($query . '<br/>Query Could not connect: ' . mysql_error());
    } else {
        $MSG->onlyMsg('10문제를 초과하였습니다');
    }
} elseif ($type == 'REMOVE') {
    if ($last_q > 0 && $last_q <= 10) {
        $query = "DELETE FROM ks_exam WHERE class_uid='$uid' AND etype='$etype' AND qnum='$last_q'";
        $result = mysql_query($query) or die($query . '<br/>Query Could not connect: ' . mysql_error());
    } else {
        $MSG->onlyMsg('문제를 추가해주세요');
    }
} elseif ($type == 'SAVE') {
    include "/home/edufim/www/module/class/class.FileUpload.php";
    include '/home/edufim/www/module/file_filtering.php';

    // Upload image file
    $arr_new_file = array();
    $real_name = array();
    for ($i = 0; $i < count($qnum); $i++) {
        // $file_num = sprintf("%02d", $i);
        $db_set_file = $upfile01[$i];
        $db_real_file = $realfile01[$i];

        if ($file_names[$i]) {
            $temp_doc = $file_names[$i];

            $fsize = $file['size'][$i] / 1024;

            if ($fsize > 10240) {
                Msg::goMsg('10MB 이하로 등록 해주세요', $next_url);
                exit();
            }

            // Validate image file
            $etxt = '사진 파일만 등록이 가능합니다.';
            $filelist = 'jpg|gif|png';
            file_strip_cut($temp_doc, $etxt, $filelist);

            $fileInfo = array(
                'name' => $file['name'][$i],
                'type' => $file['type'][$i],
                'tmp_name' => $file['tmp_name'][$i],
                'error' => $file['error'][$i],
                'size' => $file['size'][$i],
            );

            $fileUpload = new FileUpload($UPLOAD_DIR, $fileInfo, 'E');

            if ($fileUpload->uploadFile()) {
                $arr_new_file[$i] = $fileUpload->fileInfo['rename'];
            } else {
                Msg::goMsg("파일을 다시 선택해 주십시오", $next_url);
                exit();
            }

            if ($db_set_file) {
                unlink($UPLOAD_DIR . "/" . $db_set_file);
            }
            $real_name[$i] = $temp_doc;

        } else {
            if ($del_file[$i] == 'Y') {
                unlink($UPLOAD_DIR . "/" . $db_set_file);

                $arr_new_file[$i] = "";
                $real_name[$i] = "";
            } else {
                $arr_new_file[$i] = $db_set_file;
                $real_name[$i] = $db_real_file;
            }
        }
    }

    for ($i = 0; $i < count($qnum); $i++) {
        $_qnum = $qnum[$i];
        $_qtitle = $qtitle[$i];
        $upfile01 = $arr_new_file[$i];
        $realfile01 = $real_name[$i];
        $_q1 = $q1[$i];
        $_q2 = $q2[$i];
        $_q3 = $q3[$i];
        $_q4 = $q4[$i];
        $_a1 = $a1[$i];
        $query = "UPDATE ks_exam SET qtitle='$_qtitle', upfile01='$upfile01', realfile01='$realfile01', q1='$_q1', q2='$_q2', q3='$_q3', q4='$_q4', a1='$_a1' WHERE class_uid='$uid' AND etype='$etype' AND qnum='$_qnum'";
        $result = mysql_query($query) or die($query . '<br/>Query Could not connect: ' . mysql_error());
    }

    $MSG->onlyMsg('저장되었습니다');
} else {
    die("INVALID ACCESS");
}
?>

<form name='frm' method='get' action='<?= $next_url ?>'>
    <input type='hidden' name='uid' value='<?= $uid ?>'>
</form>

<script language='javascript'>
    document.frm.submit();
</script>