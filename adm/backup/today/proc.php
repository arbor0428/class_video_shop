<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';

if($type == 'del'){
	sqlExe("delete from ks_contact where uid='".$uid."'");

	echo ("<script>parent.reg_list();</script>");
	exit;
}
?>