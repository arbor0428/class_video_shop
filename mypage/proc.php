<?
	include "/home/edufim/www/module/class/class.DbCon.php";
	include "/home/edufim/www/module/class/class.Msg.php";
	include "/home/edufim/www/module/class/class.Util.php";

	/*
	error_reporting( E_ALL );
	ini_set( "display_errors", 1 );
	*/


	$type = $_POST['type'];
	if(!$type) $type = 'write';


	$default_addr = $_POST['default_addr'];
	$userid = $_POST['userid'];
	$title = $_POST['title'];
	$name = $_POST['name'];
	$zipcode = $_POST['zipcode'];
	$addr01 = $_POST['addr01'];
	$addr02 = $_POST['addr02'];
	$phone = $_POST['phone'];
	

switch ($type) {
  case "write":

		$sql = "insert into ks_address (default_addr, userid, title, name, zipcode, addr01, addr02, phone) values ($default_addr, '$userid', '$title', '$name', '$zipcode', '$addr01', '$addr02', '$phone');";
		$result = mysql_query($sql);

		Msg::goMsgReload("작성완료되었습니다.");

		break;
	
	case "edit":
		$sql = "update ks_address set default_addr='$default_addr', userid='$userid',  title='$title', name='$name',  zipcode='$zipcode', addr01= '$addr01',addr02='$addr02', phone='$phone' where uid=$uid ";
		$result = mysql_query($sql);

		Msg::goMsgReload("수정완료되었습니다.");
    break;

  case "del":

    $sql = "delete from ks_address where uid = '$uid'";
    $result = mysql_query($sql);	

		Msg::goMsg("삭제되었습니다.", '/mypage/edit');

    break;
	
	}


?>	
