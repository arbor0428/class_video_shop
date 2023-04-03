<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include '../../module/class/class.Util.php';
include "../../module/class/class.FileUpload.php";
include "../../module/class/class.gd.php";

$MSG = new Msg();
$UTIL = new Util();

$tot_num = '1';    //첨부파일 최대갯수

$UPLOAD_DIR = "../../upfile/class";

switch ($type) {
    case 'write':
    case 'edit':

        //첨부파일제한
        include '../../module/file_filtering.php';

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


        //$cade01 = $UTIL->conv_nll($cade01);
        //$cade02 = $UTIL->conv_nll($cade02);
        // $cade03 = $UTIL->conv_nll($cade03);

        //비고
        //if ($ment01)	$ment01 = $UTIL->textareaEncodeing($ment01);
        //if ($ment02)	$ment02 = $UTIL->textareaEncodeing($ment02);

        if ($type == 'write') {
            $userip = $_SERVER['REMOTE_ADDR'];
            // $rDate = date('Y-m-d H:i:s');
            $rTime = time();

            $sql = "insert into ks_class (cade01, cade02, title, exp, target, period, price, ment01, ment02, upfile01, realfile01, key01, key02, userip, rTime) values ";
            $sql .= "('$cade01', '$cade02', '$title', '$exp', '$target', '$period', '$price', '$ment01', '$ment02', '$arr_new_file[1]', '$real_name[1]', '$key01', '$key02', '$userip', $rTime)";
            $result = mysql_query($sql);
            $msg = '등록되었습니다';

        } else if ($type == 'edit') {
            $sql = "update ks_class set ";
            $sql .= "cade01='$cade01', ";
            $sql .= "cade02='$cade02', ";
            $sql .= "title='$title', ";
            $sql .= "exp='$exp', ";
            $sql .= "target='$target', ";
            $sql .= "period='$period', ";
            $sql .= "price='$price', ";
            $sql .= "ment01='$ment01', ";
            $sql .= "ment02='$ment02', ";
            $sql .= "key01='$key01', ";
            $sql .= "key02='$key02' ";

            if ($arr_new_file[1] || $del_upfile01 == 'Y') {
                $sql .= ", upfile01='$arr_new_file[1]' ";
                $sql .= ", realfile01='$real_name[1]' ";
            }

            $sql .= " where uid=$uid";
            $result = mysql_query($sql);

            $msg = '수정되었습니다';
        } else {
            $msg = "type is undefined";
        }
        
        break;

    case 'del':
        $sql = "select * from ks_class where uid='$uid'";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);

        $del_file01 = $row['upfile01'];

        if ($del_file01) {
            unlink($UPLOAD_DIR . "/" . $del_file01);
            if (is_file($UPLOAD_DIR . "/thumb_" . $del_file01))    unlink($UPLOAD_DIR . "/thumb_" . $del_file01);
        }

        $sql = "delete from ks_class where uid=$uid";
        $result = mysql_query($sql);

        $msg = '삭제되었습니다';

        break;

    case 'able':
        sqlExe("update ks_class set status=1 where uid=$uid");
        $msg = '활성화 되었습니다';
        break;

    case 'disabled':
        sqlExe("update ks_class set status=2 where uid=$uid");
        $msg = '비활성화 되었습니다';
        break;

        // for ($k = 0; $k < count($chk); $k++) {
        // 	$sql = "select * from ks_class where uid='$chk[$k]'";
        // 	$result = mysql_query($sql);
        // 	$row = mysql_fetch_array($result);

        // 	$del_file01 = $row['upfile01'];

        // 	if ($del_file01) {
        // 		unlink($UPLOAD_DIR . "/" . $del_file01);
        // 		if (is_file($UPLOAD_DIR . "/thumb_" . $del_file01))	unlink($UPLOAD_DIR . "/thumb_" . $del_file01);
        // 	}

        // 	$sql = "delete from ks_class where uid=$chk[$k]";
        // 	$result = mysql_query($sql);
        // }

        // $msg = '삭제되었습니다';
        // break;
}

unset($objProc);
unset($dbconn);

?>

<form name='frm' method='post' action='<?= $next_url ?>'>
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
    document.frm.submit();
</script>