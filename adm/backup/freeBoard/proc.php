<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';

$sTime = 0;
$eTime = 0;

if($chk_enable == '2'){
	//시작일시
	$dTxt = explode('-',$sDate);
	$sYear = $dTxt[0];
	$sMonth = $dTxt[1];
	$sDay = $dTxt[2];
	$sTime = mktime($sHour,$sMin,0,$sMonth,$sDay,$sYear);

	//종료일시
	$dTxt = explode('-',$eDate);
	$eYear = $dTxt[0];
	$eMonth = $dTxt[1];
	$eDay = $dTxt[2];
	$eTime = mktime($eHour,$eMin,59,$eMonth,$eDay,$eYear);
}

$reg_date = time();


if($type == 'write'){	 //팝업 등록
	$title = addslashes(trim($_POST['title']));

	$sql = "insert into tb_popup (ptype,chk_width,pop_width,pop_height,pop_location,pop_left,pop_top,pos_mod,scrolling,title,ment,pop_day,chk_enable,reg_date,sTime,eTime)values('$ptype','$chk_width','$pop_width','$pop_height','$pop_location','$pop_left','$pop_top','$pos01','$scrolling','$title','$ment','$pop_day','$chk_enable','$reg_date','$sTime','$eTime')"; 

	sqlExe($sql);


}elseif($type == 'edit'){	 //팝업 수정
	$title = addslashes(trim($_POST['title']));

	$sql = "update tb_popup set ";
	$sql .= "ptype='$ptype', ";
	$sql .= "chk_width='$chk_width', ";
	$sql .= "pop_width='$pop_width', ";
	$sql .= "pop_height='$pop_height', ";
	$sql .= "pop_left='$pop_left', ";
	$sql .= "pop_top='$pop_top', ";
	$sql .= "pos_mod='$pos01', ";
	$sql .= "scrolling='$scrolling', ";
	$sql .= "title='$title', ";
	$sql .= "ment='$ment', ";
	$sql .= "pop_day='$pop_day', ";
	$sql .= "chk_enable='$chk_enable', ";
	$sql .= "sTime='$sTime', ";
	$sql .= "eTime='$eTime' ";
	$sql .= "where uid='$uid'";

	sqlExe($sql);





}elseif($type == 'del'){	//팝업 삭제

	sqlExe("delete from tb_popup where uid='$uid'");


}
?>

<script>parent.reg_list();</script>