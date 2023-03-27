<?
include "/home/edufim/www/module/class/class.DbCon.php";
include "/home/edufim/www/module/class/class.Msg.php";
include '/home/edufim/www//module/class/class.Util.php';
include "/home/edufim/www/module/class/class.FileUpload.php";
include "/home/edufim/www/module/class/class.gd.php";

switch ($type) {
    case 'write':
    case 'edit':

        if ($type == 'write') {
            $sql = "insert into ks_class_list (class_uid, title, exp, kollus_video_id, kollus_video_filename, media_content_key, length) values ";
            $sql .= "('$class_uid', '$title', '$exp', '$kollus_video_id', '$kollus_video_filename', '$media_content_key', '$length')";
            
            $result = mysql_query($sql);
            $msg = '등록되었습니다';
        } else {
            $sql = "update ks_class_list set ";
            $sql .= "title='$title', ";
            $sql .= "exp='$exp', ";
            $sql .= "kollus_video_id='$kollus_video_id', ";
            $sql .= "kollus_video_filename='$kollus_video_filename', ";
            $sql .= "media_content_key='$media_content_key', ";
            $sql .= "length='$length' ";
            $sql .= " where uid=$uid";

            $result = mysql_query($sql);
            $msg = '수정되었습니다';
        }
        break;

    case 'del':
        $sql = "delete from ks_class_list where uid=$uid";
        $result = mysql_query($sql);

        $msg = '삭제되었습니다';
        break;

    case 'all_del':
        for ($k = 0; $k < count($chk); $k++) {
            $sql = "delete from ks_class_list where uid=$chk[$k]";
            $result = mysql_query($sql);
        }

        $msg = '삭제되었습니다';
        break;
}

unset($objProc);
unset($dbconn);
?>

<form name='frm' method='post' action='<?= $next_url ?>'>
    <input type='hidden' name='class_uid' value='<?= $class_uid ?>'>
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