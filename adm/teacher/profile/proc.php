<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
include "/home/edufim/www/module/class/class.Util.php";
include "/home/edufim/www/module/class/class.FileUpload.php";
include '/home/edufim/www/module/file_filtering.php';

//첨부파일 최대갯수
$tot_num = '1';
$UPLOAD_DIR = '/home/edufim/www/upfile/member/';

switch ($type) {
    case 'write':
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

        $query = "UPDATE ks_member SET";
        $query .= " name='$name',";
        $query .= " job='$job',";
        $query .= " ment01='$ment01',";
        $query .= " class_uid='$class_uid'";
        if ($arr_new_file[1] || $del_upfile01 == 'Y') {
            $query .= ", upfile01='$arr_new_file[1]'";
            $query .= ", realfile01='$real_name[1]'";
        }
        $query .= " WHERE uid=$uid";
        $result = mysql_query($query) or die(mysql_error());

        $msg = '저장되었습니다';

        break;
}

Msg::goMsg($msg, $next_url);