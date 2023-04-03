<?
include '../../module/class/class.DbCon.php';

$type = $_POST['t'];
$uid = $_POST['u'];

if($type == 'status' && $uid){
	$status = $_POST['v'];	
	sqlExe("update ks_product set status='$status' where uid=$uid");

}elseif($type == 'inven' && $uid){
	$inven = $_POST['v'];	
	sqlExe("update ks_product set inven='$inven' where uid=$uid");
}
?>