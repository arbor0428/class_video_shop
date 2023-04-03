<?php
define('_WWW', '/home/edufim/www');
include _WWW . "/module/class/class.DbCon.php";
include _WWW . "/module/class/class.Msg.php";

switch ($type) {
    case 'ADD':
        sqlExe("INSERT INTO ks_class_list (class_uid, sort) VALUES ('$uid', '$last_sort')");
        Msg::goNext($next_url . '?uid=' . $uid);
        break;

    case 'REMOVE':
        foreach ($chk as $key => $sort) {
            sqlExe("DELETE FROM ks_class_list WHERE class_uid='$uid' AND sort='$sort'");
        }
        $arr_sort = sqlArray("SELECT sort FROM ks_class_list WHERE class_uid='$uid' ORDER BY sort");
        for ($i = 0; $i < count($arr_sort); $i++) {
            $value_sort = $arr_sort[$i]['sort'];
            $sort = $i + 1;
            sqlExe("UPDATE ks_class_list SET sort='$sort' WHERE class_uid='$uid' AND sort='$value_sort'");
        }
        Msg::goNext($next_url . '?uid=' . $uid);
        break;

    case 'ADD_preview':
        sqlExe("INSERT INTO ks_class_list_preview (class_uid, sort) VALUES ('$uid', '$last_sort_preview')");
        Msg::goNext($next_url . '?uid=' . $uid);
        break;

    case 'REMOVE_preview':
        foreach ($chk_preview as $key => $sort) {
            sqlExe("DELETE FROM ks_class_list_preview WHERE class_uid='$uid' AND sort='$sort'");
        }
        $arr_sort = sqlArray("SELECT sort FROM ks_class_list_preview WHERE class_uid='$uid' ORDER BY sort");
        for ($i = 0; $i < count($arr_sort); $i++) {
            $value_sort = $arr_sort[$i]['sort'];
            $sort = $i + 1;
            sqlExe("UPDATE ks_class_list_preview SET sort='$sort' WHERE class_uid='$uid' AND sort='$value_sort'");
        }

        Msg::goNext($next_url . '?uid=' . $uid);
        break;
    
    case 'preview':
		$query = "UPDATE ks_class_list SET is_preview='$status' WHERE uid='$uid'";
		$result = mysql_query($query) or die(mysql_error());
        
        echo $result;

		break;

    case 'VIDEO':
        $row = sqlRow("SELECT * FROM kollus_video WHERE id='$video_id'");

        $ext = end(explode('.', $row['filename']));
        $title = str_replace('.' . $ext, '', $row['filename']);

        $data = array(
            'title' => $title,
            'snapshot_url' => $row['snapshot_url'],
        );
        echo json_encode($data);
        exit;

    case 'WRITE':
        // for ($i = 0; $i < count($kollus_video_id_preview); $i++) {
        //     $_kollus_video_id = $kollus_video_id_preview[$i];
        //     $_title = $title_preview[$i];
        //     $_exp = $exp_preview[$i];
        //     $_length = $length_preview[$i];
        //     $_sort = $i + 1;

        //     sqlExe("UPDATE ks_class_list_preview SET kollus_video_id='$_kollus_video_id', title='$_title', exp='$_exp', length='$_length' WHERE class_uid='$uid' AND sort='$_sort'");
        // }

        for ($i = 0; $i < count($kollus_video_id); $i++) {
            $_kollus_video_id = $kollus_video_id[$i];
            $_title = $title[$i];
            $_exp = $exp[$i];
            // $_length = $length[$i];
            $_sort = $i + 1;

            sqlExe("UPDATE ks_class_list SET kollus_video_id='$_kollus_video_id', title='$_title', exp='$_exp' WHERE class_uid='$uid' AND sort='$_sort'");
        }
        $msg = "저장되었습니다.";
        Msg::goMsg($msg, "/adm/prod/all/");
        break;
    default:
        $msg = "INVALID TYPE ERROR";
        Msg::goMsg($msg, "/adm/prod/all/");
        break;
}
unset($dbconn);
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
	document.frm.submit();
</script> -->