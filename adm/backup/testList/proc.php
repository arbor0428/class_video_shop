<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';


if($type == 'write' || $type == 'edit'){

	$stylist = addslashes(trim($_POST['stylist']));
	$userid = addslashes(trim($_POST['userid']));
	$name = addslashes(trim($_POST['name']));
	$phone = addslashes(trim($_POST['phone']));
	$zipcode = trim($_POST['zipcode']);
	$addr01 = trim($_POST['addr01']);
	$addr02 = addslashes(trim($_POST['addr02']));
	$email = addslashes(trim($_POST['email']));
	$Delivery = addslashes(trim($_POST['Delivery']));
	$DeliveryNum = addslashes(trim($_POST['DeliveryNum']));
	$orderDate = trim($_POST['orderDate']);
	$orderTime = strtotime($orderDate);


	if($type == 'write'){

		$status = '결제대기';
		$payAmt = 0;

		$userip = $_SERVER['REMOTE_ADDR'];
		$rDate = date('Y-m-d H:i:s');
		$rTime = time();

		//주문정보
		$sql = "insert into ks_order (stylist,userid,name,status,prodCnt,prodAmt,payAmt,orderDate,orderTime,phone,zipcode,addr01,addr02,email,Delivery,DeliveryNum,userip,rDate,rTime) values ";
		$sql .= "('$stylist','$userid','$name','$status','$prodCnt','$prodAmt','$payAmt','$orderDate','$orderTime','$phone','$zipcode','$addr01','$addr02','$email','$Delivery','$DeliveryNum','$userip','$rDate','$rTime')";
		sqlExe($sql);

		//주문상품정보
		for($i=0; $i<$prodCnt; $i++){
			$pid = $uChk[$i];
			$title = $tChk[$i];
			$price = $pChk[$i];
			$status = $sChk[$i];

			$sql = "insert into ks_orderList (userid,pid,title,price,status,rTime) values ('$userid','$pid','$title','$price','$status','$rTime')";
			sqlExe($sql);

			//주문상품 재고차감
			sqlExe("update ks_product set inven=inven-1 where uid='$pid'");
		}


		//알림톡발송
		$talkType = $_POST['talkType'];
		if($talkType == 'orderList'){
			$clientName = $name;
			$clientNumber = $phone;
			$clientID = $userid;

			include '../../module/kakao/alimtalk.php';
		}


		Msg::GblMsgBoxParent("주문이 등록되었습니다.","location.href='".$next_url."';");
		exit;



	}elseif($type == 'edit'){
		//주문정보
		$sql = "update ks_order set ";
		$sql .= "stylist='$stylist', ";
		$sql .= "userid='$userid', ";
		$sql .= "name='$name', ";
		$sql .= "phone='$phone', ";
		$sql .= "zipcode='$zipcode', ";
		$sql .= "addr01='$addr01', ";
		$sql .= "addr02='$addr02', ";
		$sql .= "email='$email', ";
		$sql .= "Delivery='$Delivery', ";
		$sql .= "DeliveryNum='$DeliveryNum', ";
		$sql .= "prodCnt='$prodCnt', ";
		$sql .= "prodAmt='$prodAmt', ";
		$sql .= "orderDate='$orderDate', ";
		$sql .= "orderTime='$orderTime' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		$rTime = sqlRowOne("select rTime from ks_order where uid='$uid'");

		//주문상품정보
		sqlExe("delete from ks_orderList where rTime='$rTime'");

		for($i=0; $i<$prodCnt; $i++){
			$pid = $uChk[$i];
			$title = $tChk[$i];
			$price = $pChk[$i];
			$status = $sChk[$i];
			$reMsg = $reText[$i];
			$reDate = $reDateChk[$i];
			$reTime = $reTimeChk[$i];

			if($reMsg)	$reMsg = Util::textareaEncodeing($reMsg);

			if($status == '결제대기' || $status == '결제완료'){
				$reMsg = '';
				$reDate = '';
				$reTime = '';
			}

			$sql = "insert into ks_orderList (userid,pid,title,price,status,rTime,reMsg,reDate,reTime) values ";
			$sql .= "('$userid','$pid','$title','$price','$status','$rTime','$reMsg','$reDate','$reTime')";
			sqlExe($sql);			
		}

		//알림톡발송
		$talkType = $_POST['talkType'];
		if($talkType == 'orderList'){
			$clientName = $name;
			$clientNumber = $phone;
			$clientID = $userid;

			include '../../module/kakao/alimtalk.php';
		}

		Msg::GblMsgBoxParent("수정되었습니다.","javascript:parent.reg_list();");
		exit;
	}


//반품확인
}elseif($type == 'reCheck'){
	sqlExe("update ks_orderList set reChk='".$t."' where uid='".$uid."'");


//상태변경
}elseif($type == 'sCheck'){
	sqlExe("update ks_orderList set status='".$status."' where uid='".$uid."'");

	//모든 주문상품이 결제대기일 경우 주문상태를 결제대기로 변경
	$rTime = sqlRowOne("select rTime from ks_orderList where uid='".$uid."'");
	$rChk = sqlRowOne("select count(*) from ks_orderList where rTime='".$rTime."' and status!='결제대기'");
	if(!$rChk){
		sqlExe("update ks_order set status='결제대기' where rTime='".$rTime."'");
	}


//환불처리
}elseif($type == 'cancel'){
	$cDate = $_POST['cDate'];
	$cTime = strtotime($cDate);

	//주문내역
	sqlExe("update ks_order set status='환불', cDate='".$cDate."', cTime='".$cTime."' where uid='".$uid."'");

	//결제내역
	$orderNum = sqlRowOne("select rTime from ks_order where uid='".$uid."'");
	sqlExe("update ks_payment set payOk='환불' where orderNum='".$orderNum."'");

	echo ("<script>parent.reg_list();</script>");
	exit;


//환불처리취소
}elseif($type == 'cancel2'){
	//주문내역
	sqlExe("update ks_order set status='결제완료', cDate='', cTime='' where uid='".$uid."'");

	//결제내역
	$orderNum = sqlRowOne("select rTime from ks_order where uid='".$uid."'");
	sqlExe("update ks_payment set payOk='결제완료' where orderNum='".$orderNum."'");

	echo ("<script>parent.reg_list();</script>");
	exit;

}elseif($type == 'del'){
	$row = sqlRow("select * from ks_order where uid='".$uid."'");
	$userid = $row['userid'];
	$rTime = $row['rTime'];

	sqlExe("delete from ks_order where uid='".$uid."'");
	sqlExe("delete from ks_orderList where userid='".$userid."' and rTime='".$rTime."'");

	sqlExe("delete from ks_coupon where orderNum='".$rTime."'");
	sqlExe("delete from ks_payment where orderNum='".$rTime."'");
	sqlExe("delete from ks_pointList where orderNum='".$rTime."'");
	sqlExe("delete from ks_review where orderNum='".$rTime."'");	

	echo ("<script>parent.reg_list();</script>");
	exit;
}
?>