<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.FileUpload.php";
include "../../module/class/class.Msg.php";

$UPLOAD_DIR = './upfile';

$doc_name	= 'upfile01';

$userip = $_SERVER['REMOTE_ADDR'];

function TextAreaEncodeing($str){
	if($str){
		$str = str_replace("<", "&lt;", $str);
		$str = str_replace(">", "&gt;", $str);
		$str = str_replace("\"", "&quot;", $str);
		$str = str_replace("\|", "&#124;", $str);
		$str = str_replace("\r\n", "<P>", $str);
		$str = str_replace("\n", "<BR>", $str);
	}

	return $str;
}

if($_FILES[$doc_name]['name']){
	$temp_doc = $_FILES[$doc_name]['name'];

	$ext = FileUpload::getFileExtension($_FILES[$doc_name]['name']);
	if($ext != 'xls' && $ext != 'xlsx'){
		Msg::backMsg("엑셀파일을 다시 선택해 주십시오");
		exit();
	}

	$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'E');

	if($fileUpload->uploadFile()){
		$upload_filename = $fileUpload->fileInfo['rename'];
	}else{
		Msg::backMsg("파일을 다시 선택해 주십시오");
		exit();
	}


	$excelName = $temp_doc;
	$excelDate = date('Y-m-d H:i:s');


	require_once "../../module/PHPExcel-1.8/Classes/PHPExcel.php"; // PHPExcel.php을 불러옴.
	$objPHPExcel = new PHPExcel();
	require_once "../../module/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러옴.

	$filename = './upfile/'.$upload_filename; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

	try{
		// 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
		$objReader = PHPExcel_IOFactory::createReaderForFile($filename);

		// 읽기전용으로 설정
		$objReader->setReadDataOnly(true);

		// 엑셀파일을 읽는다
		$objExcel = $objReader->load($filename);

		// 첫번째 시트를 선택
		$objExcel->setActiveSheetIndex(0);
		$objWorksheet = $objExcel->getActiveSheet();
		$rowIterator = $objWorksheet->getRowIterator();

		foreach($rowIterator as $row){ // 모든 행에 대해서
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false);
		}

		$maxRow = $objWorksheet->getHighestRow();

		$userip = $_SERVER['REMOTE_ADDR'];

		for($i=2; $i<=$maxRow; $i++){

			$cade01 = addslashes(trim($objWorksheet->getCell('A' . $i)->getValue()));
			$cade02 = addslashes(trim($objWorksheet->getCell('B' . $i)->getValue()));
			$cade03 = addslashes(trim($objWorksheet->getCell('C' . $i)->getValue()));
			$title = addslashes(trim($objWorksheet->getCell('D' . $i)->getValue()));
			$price = trim($objWorksheet->getCell('E' . $i)->getValue());
			$inven = trim($objWorksheet->getCell('F' . $i)->getValue());
			$memo = trim($objWorksheet->getCell('G' . $i)->getValue());
			$status = trim($objWorksheet->getCell('H' . $i)->getValue());
			$date = trim($objWorksheet->getCell('I' . $i)->getValue());

			$price = str_replace(',','',$price);
			$inven = str_replace(',','',$inven);
			$memo = TextAreaEncodeing($memo);

			if($status == 'O')		$status = '1';
			else						$status = '';

			$date = ($date - 25569) * 86400 - 60 * 60 * 9;
			$date = round( $date * 10 ) / 10;
			$rDate = date('Y-m-d', $date);

			$rTime = strtotime($rDate);

			$sql = "insert into ks_product (status,cade01,cade02,cade03,title,price,inven,memo,upfile01,realfile01,userip,rDate,rTime,excelName,excelFile,excelDate) values ";
			$sql .= "('$status','$cade01','$cade02','$cade03','$title','$price','$inven','$memo','','','$userip','$rDate','$rTime','$excelName','$upload_filename','$excelDate')";
			sqlExe($sql);
		}

		echo ("<script>parent.searchChk();</script>");
		exit;



	}catch(exception $e){
		Msg::backMsg("엑셀파일 오류입니다");
		exit();
	}
}
?>