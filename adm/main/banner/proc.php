<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
include "/home/edufim/www/module/class/class.Util.php";
include "/home/edufim/www/module/class/class.FileUpload.php";
include '/home/edufim/www/module/file_filtering.php';

//첨부파일 최대갯수
$tot_num = '5';

$UPLOAD_DIR = '/home/edufim/www/upfile/main/';
$main_type = 'BANNER';

// pc
$input_name = 'file';
$file = $_FILES[$input_name];
$file_names = $file['name'];

$arr_new_file = array();
$real_name = array();
for ($i = 0; $i < $tot_num; $i++) {
    // $file_num = sprintf("%02d", $i);
    $db_set_file = $upfile[$i];
    $db_real_file = $realfile[$i];

    if ($file_names[$i]) {
        $temp_doc = $file_names[$i];
        
        $fsize = $file['size'][$i] / 1024;
        
        if ($fsize > 10240) {
            Msg::goMsg('10MB 이하로 등록 해주세요', $next_url);
            exit;
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

        $fileUpload = new FileUpload($UPLOAD_DIR, $fileInfo, 'P');
        
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

// mobile
$input_name = 'file_m';
$file = $_FILES[$input_name];
$file_names = $file['name'];

$arr_new_file_m = array();
$real_name_m = array();
for ($i = 0; $i < $tot_num; $i++) {
    $db_set_file = $upfile_m[$i];
    $db_real_file = $realfile_m[$i];

    if ($file_names[$i]) {
        $temp_doc = $file_names[$i];
        
        $fsize = $file['size'][$i] / 1024;
        
        if ($fsize > 10240) {
            Msg::goMsg('10MB 이하로 등록 해주세요', $next_url);
            exit;
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

        $fileUpload = new FileUpload($UPLOAD_DIR, $fileInfo, 'M');
        
        if ($fileUpload->uploadFile()) {
            $arr_new_file_m[$i] = $fileUpload->fileInfo['rename'];
        } else {
            Msg::goMsg("파일을 다시 선택해 주십시오", $next_url);
            exit();
        }

        if ($db_set_file) {
            unlink($UPLOAD_DIR . "/" . $db_set_file);
        }
        $real_name_m[$i] = $temp_doc;

    } else {
        if ($del_file_m[$i] == 'Y') {
            unlink($UPLOAD_DIR . "/" . $db_set_file);

            $arr_new_file_m[$i] = "";
            $real_name_m[$i] = "";
        } else {
            $arr_new_file_m[$i] = $db_set_file;
            $real_name_m[$i] = $db_real_file;
        }
    }
}

if ($type == 'write') {
    for ($i = 0; $i < $tot_num; $i++) {
        $sort = $i + 1;
        $query = "UPDATE config_main SET ";
        $query .= " sort='$sort',";
        $query .= " upfile='$arr_new_file[$i]',";
        $query .= " realfile='$real_name[$i]',";
        $query .= " upfile_m='$arr_new_file_m[$i]',";
        $query .= " realfile_m='$real_name_m[$i]',";
        $query .= " url='$url[$i]',";
        $query .= " target='$target[$i]'";
        $query .= " WHERE sort='$sort' AND type='$main_type'";
        sqlExe($query);
    }
    Msg::goMsg('수정되었습니다', $next_url);
} elseif ($type == 'sort') {
    Msg::goMsg('작업중', $next_url);
}
