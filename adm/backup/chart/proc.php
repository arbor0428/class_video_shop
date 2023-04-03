<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';
include '../../module/class/class.FileUpload.php';
include '../../module/file_filtering.php';


if($type == 'write' || $type == 'edit'){	

	//파일업로드
	include 'fileChk.php';


	$title = addslashes(trim($_POST['title']));

	//상품가격
	$price = str_replace(',','',$price);

	//재고수량
	$inven = str_replace(',','',$inven);

	//상품설명
	if($memo)	$memo = Util::textareaEncodeing($memo);

	if($type == 'write'){
		$userip = $_SERVER['REMOTE_ADDR'];
		$rDate = date('Y-m-d H:i:s');
		$rTime = time();

		$sql = "insert into ks_product (status,cade01,cade02,cade03,title,price,inven,memo,upfile01,realfile01,userip,rDate,rTime) values ";
		$sql .= "('$status','$cade01','$cade02','$cade03','$title','$price','$inven','$memo','$arr_new_file[1]','$real_name[1]','$userip','$rDate','$rTime')";
		sqlExe($sql);

		Msg::GblMsgBoxParent("등록되었습니다.","location.href='".$next_url."';");
		exit;



	}elseif($type == 'edit'){
		$sql = "update ks_product set ";
		$sql .= "status='$status', ";
		$sql .= "cade01='$cade01', ";
		$sql .= "cade02='$cade02', ";
		$sql .= "cade03='$cade03', ";
		$sql .= "title='$title', ";
		$sql .= "price='$price', ";
		$sql .= "inven='$inven', ";		
		$sql .= "memo='$memo', ";
		$sql .= "upfile01='$arr_new_file[1]', ";
		$sql .= "realfile01='$real_name[1]' ";
		$sql .= " where uid=$uid";
		sqlExe($sql);

		Msg::GblMsgBoxParent("수정되었습니다.","javascript:parent.reg_list();");
		exit;
	}



}elseif($type == 'del'){
	$row = sqlRow("select * from ks_product where uid='".$uid."'");
	$upfile01 = $row['upfile01'];

	if($upfile01)	@unlink("../../upfile/".$upfile01);

	sqlExe("delete from ks_product where uid='".$uid."'");

	echo ("<script>parent.reg_list();</script>");
	exit;
}
?>