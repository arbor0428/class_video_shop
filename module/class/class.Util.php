<?
class Util
{
	//콤보 박스를 생성한다. Y-년, M-월, D-일 
	function getCboCalender($verYear, $verMonth, $verDay, $selYear="", $selMonth="", $selDay="", $mtype="D", $is_print="1", $class=''){
		$msg = "";

		//if($selYear == "")	$selYear	= date('Y');
		//if($selMonth == "")	$selMonth	= date('n');
		//if($selDay == "")	$selDay		= date('j');

		if($class!='')	$class = 'class='.$class;

		if($mtype == "Y" || $mtype == "M" || $mtype == "D"){		
			$msg = '<select name="'.$verYear.'" '.$class.'>';
			$msg .= '<option value="">====</option>';
			for($i=1997; $i<=2007; $i++){
				if($i == $selYear)
					$msg .= '<option value="'.$i.'" selected>'.$i.'</option>';
				else
					$msg .= '<option value="'.$i.'">'.$i.'</option>';
			}
			$msg .= "</select>년&nbsp;&nbsp;&nbsp;";
		}

		if($mtype == "M" || $mtype == "D"){		
			$msg .= '<select name="'.$verMonth.'" '.$class.'>';
			$msg .= '<option value="">==</option>';
			for($i=1; $i<=12; $i++){
				if($i == $selMonth)
					$msg .= '<option value="'.$i.'" selected>'.$i.'</option>';
				else
					$msg .= '<option value="'.$i.'">'.$i.'</option>';
			}
			$msg .= "</select>월&nbsp;&nbsp;&nbsp;";
		}

		if($mtype == "D"){		
			$msg .= '<select name="'.$verDay.'" '.$class.'>';
			$msg .= '<option value="">==</option>';
			for($i=1; $i<=31; $i++){
				if($i == $selDay)
					$msg .= '<option value="'.$i.'" selected>'.$i.'</option>';
				else
					$msg .= '<option value="'.$i.'">'.$i.'</option>';
			}
			$msg .= "</select>일&nbsp;&nbsp;&nbsp;";
		}

		if($is_print)
			echo $msg;
		else
			return $msg;
	}

	function getSelectBox($name, $arr_value, $arr_caption, $selected_value='', $class='', $function='', $print=true){
		$select_box = '<select name="'.$name.'" ';

		if($class!='')		$select_box .= ' class="'.$class.'" ';
		if($function!='')	$select_box .= ' onChange="javascript:'.$function.'"';

		$select_box .= '>';
		$select_box .= '<option value="">==</option>';

		//if($selected_value=="")	$selected_value = $arr_value[0];

		for($i=0; $i<count($arr_value); $i++){
			if($arr_value[$i]==$selected_value)	$selected='selected';	else $selected = '';
			$select_box .= '<option value="'.$arr_value[$i].'" '.$selected.'>'.$arr_caption[$i].'</option>';
		}
		$select_box .= '</select>';

		if($print)
			echo $select_box;
		else
			return $select_box;
	}

	/* 확장명 추출 하는 메소드 */
	function getExt($file_name){
		$_file_name = explode(".",$file_name);
		$ext = strtolower($_file_name[count($_file_name)-1]); 

		return $ext;
	}

	//특정 확장자의 아이콘을 링크테그형태로 만들어 주는 메소드 //
	function getLinkFileIcon($img_dir, $file_dir, $file_name){
		$_file_name = explode(".",$file_name);
		$ext = strtolower($_file_name[count($_file_name)-1]); 

		switch ($ext){
			case 'hwp':
				$img_name = "hwp.gif";
				break;

			case 'doc':
				$img_name = "doc.gif";
				break;

			case 'ppt':
				$img_name = "ppt.gif";
				break;

			case 'xls':
				$img_name = "xls.gif";
				break;

			case 'zip':
				$img_name = "zip.gif";
				break;

			case 'exe':
				$img_name = "exe.gif";
				break;

			case 'gif':
				$img_name = "gif.gif";
				break;

			case 'jpg':
				$img_name = "jpg.gif";
				break;

			case 'pdf':
				$img_name = "pdf.gif";
				break;

			default:
				$img_name = "txt.gif";
		}

		$linkImg = "<a href=javascript:downFile('".$file_dir."','".$file_name."')><img src='".$img_dir."/".$img_name."' border=0></a>";
		return $linkImg;
	}

	// 한글용 ksubstr //
	function ksubstr($string,$start,$length){
		if($length>=strlen($string)) return $string;
		$klen=$length-1;
		while(ord($string[$klen]) & 0x80) $klen--;
		return $add.substr($string,$start,$length-(($length+$klen+1)%2));
	}

	function delFile($dir, $file_name){
		if(file_exists($dir.'/'.$file_name)){
			unlink($dir.'/'.$file_name);
			return true;
		}
		else
			return false;
	}

	/* date1 과 date2의 차이를 날짜로 반환하는 메소드 */
	function dateDiff($date1, $date2){
		$_date1 = explode("-",$date1);
		$_date2 = explode("-",$date2);

		$tm1 = mktime(0,0,0,$_date1[1],$_date1[2],$_date1[0]);
		$tm2 = mktime(0,0,0,$_date2[1],$_date2[2],$_date2[0]);

		return ($tm1 - $tm2) / 86400;
	}

	/* date1 과 date2의 차이를 날짜로 반환하는 메소드 */
	function dateDiffTime($date){
		$date1 = date('Y-m-d');
		$date2 = date('Y-m-d',$date);

		$_date1 = explode("-",$date1);
		$_date2 = explode("-",$date2);

		$tm1 = mktime(0,0,0,$_date1[1],$_date1[2],$_date1[0]);
		$tm2 = mktime(0,0,0,$_date2[1],$_date2[2],$_date2[0]);

		return ($tm1 - $tm2) / 86400;
	}

	/* 코드를 리턴하는 메소드 */
	function getCode($db, $strTable, $strKey, $intLen, $strC){
		$intCLen = strlen($strC);
		$intLen -= $intCLen;

		$strZero = "";
		for($i=1; $i<=$intLen; $i++){
			$strZero .= "0";
		}

		
		$intCLen += 1;
		$strSql = "select right(concat('".$strZero."',(max(cast(substring(".$strKey.",".$intCLen.",".$intLen.") as SIGNED))+1)),".$intLen.") from ".$strTable;
		$result = mysql_query($strSql, $db);
		if($result){
			$db_code = mysql_result($result,0,0);
			if($db_code==0){

				$db_code = substr($strZero."1",-1*$intLen);
			}
		}
		else{
			$db_code = "";
		}

		if($db_code!=""){
			return $strC.$db_code;
		}
		else{
			return $strC.substr($strZero."1",-1*$intLen);
		}
	}



	function Shorten_String($String, $MaxLen, $ShortenStr){
		$StringLen = strlen($String);
		$EffectLen = $MaxLen - strlen($ShortenStr);
		
		if ( $StringLen < $MaxLen )return $String; 
		
		for ($i = 0; $i <= $EffectLen; $i++) { 
			$LastStr = substr($String, $i, 1); 
			if ( ord($LastStr) > 127 ) $i++; 
		} 

		$RetStr = substr($String, 0, $i); 

		return $RetStr .= $ShortenStr; 
	}



	
	function cutStringWithTags($String, $MaxLen, $ShortenStr){ 
		
		$StringLen = strlen($String); // 원래 문자열의 길이를 구함 

			for ($i = 0, $count = 0, $tag = 0; $i <= $StringLen && $count < $MaxLen; $i++ ) { 
		$LastStr = substr($String, $i, 1); 
				if ($LastStr == '<') $tag = 1; // 태그 시작 
				if ($tag && $LastStr == '>') { $tag = 0; continue; } // 태그 끝 
				if ($tag) continue; 
		if ( ord($LastStr) > 127 ) { $count++; $i++; } 
				$count++; 
		// 2바이트문자라고 생각되면 $i를 1을 더 증가시켜 
		// 결국은 2가 증가하게 된다. 
		// 다음에 오는 1바이트는 당연 지금 바이트의 문자에 귀속되는 문자이다. 

			} 

		$RetStr = substr($String, 0, $i); 
		// 위에서 구한 문자열의 길이만큼으로 자른다. 
			if ($count<$MaxLen) 
				return $RetStr; 
			else 
				return $RetStr .= $ShortenStr; 
		// 여기에 말줄임문자를 붙여서 리턴해준다. 
	}



	function AutoImgSize($url, $w, $h){ 

		$size = getimagesize($url);

		if($size[0] > $w)	$width = $w; //임의로 정하는 넓이
		else	$width = $size[0];

		$height = $width*$size[1]/$size[0]; //원본 이미지의 넓이값 대비 높이와 같은 비율로 줄어든 높이값
		if($height > $h){$height = $h;}
		if($size[0] < $size[1]){$width = $height*$size[0]/$size[1];}

		$width = intval($width);
		$height = intval($height);

		$ReSize = "width='$width' height='$height'";

		return $ReSize;

	}




	function price_trans($price) {
			$ptxt = '';
			$trans_kor=array("","일","이","삼","사","오","육","칠","팔","구");
			$price_unit=array("","십","백","천","만","십만","백만","천만","억","십억","백억","천억","조","십조","백조");
			$value=strlen($price);
			for($i=0;$i<=$value;$i++) {
					$str[$i]=substr($price,$i,1);
			}
			$code=$value;
			for($i=0;$i<=$value;$i++) {
					$code=$code-1;
					if($trans_kor[$str[$i]] == "") {
							$price_unit[$code]="";
					}
					if($code>4) {
							$two=$i+1;
							if($trans_kor[$str[$two]] != "") {
									$price_unit[$code]=substr($price_unit[$code],0,2);
							}
					}
					$ptxt .= $trans_kor[$str[$i]].$price_unit[$code];
			}

			return $ptxt;
	}




	function NameCutStr($str, $skip, $suffix){ 
		preg_match_all( "/[\x80-\xff].|./", $str, $matches );

		for( ;$skip --; ) $h .= array_shift( $matches[0] ); 
		$b = str_repeat($suffix,  count( $matches[0] ) ); 
		return $h . $b; 
	}



	//처음과 마지막 문자를 제외한 모든문자 *표시
	function NameCutStr2($str){
		$nameTxt = '';

		mb_internal_encoding(mb_detect_encoding($str,'UTF-8,EUC-KR')); 
		$nameTxt = ($len=mb_strlen($str))>2 ? mb_substr($str,0,1).str_repeat('*',$len-2).mb_substr($str,-1,1) : $str;

		return $nameTxt;
	}


	function LoginChk($userid){
		if(!$userid){
			echo("<script language=javascript>");
			echo("top.location.href = '/';");
			echo("</script>");
		}
	}


	function ServiceChk($userid,$scode){
		if(!$userid || !$scode){
			echo("<script language=javascript>");
			echo("top.location.href = '/';");
			echo("</script>");
		}
	}






	function NumberSet($num01){	//num01:기준숫자
		$cno = explode('.',$num01);
		$clen = count($cno);

/*
		if($clen > 1)	$no = number_format($num01,1);
		else	$no = number_format($num01);
*/

		if($num01 != 0)	$no = number_format($num01,2);
		else	$no = $num01;

		return $no;
	}



	function NumberSet2($num01){	//num01:기준숫자
		$cno = explode('.',$num01);
		$clen = count($cno);
		$fno = $cno[$clen-1];

		$filter = false;

		if($num01 != 0){
			$filter = true;

			if(($clen > 1 && $fno == '00') || $clen == 1){
				$filter = false;
			}
		}

		if($filter)	$no = number_format($num01,2);
		else	$no = number_format($num01);

		return $no;
	}


	function NumberSet3($num01){	//num01:기준숫자
		$cno = explode('.',$num01);
		$clen = count($cno);
		$fno = $cno[$clen-1];

		$filter = false;

		if($num01 != 0){
			$filter = true;

			if(($clen > 1 && $fno == '000') || $clen == 1){
				$filter = false;
			}
		}

		if($filter)	$no = number_format($num01,3);
		else	$no = number_format($num01);

		if($no == '-0')	 $no = 0;

		return $no;
	}



	function NumberSet4($num01){	//num01:기준숫자
		$cno = explode('.',$num01);
		$clen = count($cno);
		$fno = $cno[$clen-1];

		$filter = false;

		if($num01 != 0){
			$filter = true;

			if(($clen > 1 && $fno == '000') || $clen == 1){
				$filter = false;
			}
		}

		$no = round($num01,3);

		if($no == '-0')	 $no = 0;

		return $no;
	}


	//textarea 인코딩
	function TextAreaEncodeing($str){
		if($str){
			$str = str_replace('<', '&lt;', $str);
			$str = str_replace('>', '&gt;', $str);
			$str = str_replace('\'', '&quot;', $str);
			$str = str_replace('\|', '&#124;', $str);
			$str = str_replace('\r\n\r\n', '<P>', $str);
			$str = str_replace('\r\n', '<BR>', $str);
		}

		return $str;
	}


	//textarea 디코딩
	function TextAreaDecodeing($str){
		if($str){
			$str = str_replace('&lt;', '<', $str);
			$str = str_replace('&gt;', '>', $str);
			$str = str_replace('&quot;', '\'', $str);
			$str = str_replace('&#124;', '\|', $str);
			$str = str_replace('<P>', '\r\n\r\n', $str);
			$str = str_replace('<BR>', '\r\n', $str);
		}

		return $str;
	}


	//날짜형식
	function chkDate($str){
		if(preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $str)){
			return true;
		}else{
			return false;
		}
	}

	//모바일형식
	function chkMobile($str){
		$ph = preg_replace("/[^0-9]*/s", "", $str);
		$ph_len = strlen($ph);
		
		if($ph_len >= '8' && $ph_len <= '11'){
			switch($ph_len){
				case 8:
					$ph = "010".$ph;
					$ph = substr($ph,0,3)."-".substr($ph,3,4)."-".substr($ph,7);
					break;

				case 9:
					$ph = "0".$ph;
					$ph = substr($ph,0,3)."-".substr($ph,3,3)."-".substr($ph,6);
					break;
					
				case 10:
					if(substr($ph,0,1) == '0'){
						$ph = substr($ph,0,3)."-".substr($ph,3,3)."-".substr($ph,6);
					}elseif(substr($ph,0,1) == '1'){
						$ph = "0".$ph;
						$ph = substr($ph,0,3)."-".substr($ph,3,4)."-".substr($ph,7);
					}
					break;
					
				case 11:
					$ph = substr($ph,0,3)."-".substr($ph,3,4)."-".substr($ph,7);
					break;
			}
			
			$pattern = "/^01[016789]-[0-9]{3,4}-[0-9]{4}$/";
			$rs = (preg_match($pattern, $ph)) ? true : false;
			return $ph;
		}
	}
	//비밀번호 초기화
	function rePassWord(){
		$str01 = "1234567890abcdefghijklmnopqrstuvwxyz";
		$str02 = "!@#$";

		$code = substr(str_shuffle($str01),0,5);
		$code .= substr(str_shuffle($str02),0,2);

		return $code;
	}


}



?>