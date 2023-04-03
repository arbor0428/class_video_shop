<?
	include '../../module/class/class.DbCon.php';

	$userid = $_POST['userid'];

	$userList = Array();

	$row = sqlRow("select * from ks_member where userid='".$userid."'");
	if($row){
		$userList['name'] = urlencode($row['name']);
		$userList['phone'] = urlencode($row['phone']);
		$userList['zipcode'] = $row['zipcode'];
		$userList['addr01'] = urlencode($row['addr01']);
		$userList['addr02'] = urlencode($row['addr02']);
		$userList['email'] = urlencode($row['email']);


		$json = json_encode($userList);
		echo $json;

	}else{
		echo '100';
	}
?>