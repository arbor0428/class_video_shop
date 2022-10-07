<?
class DbCon
{
	var	$DB_SERVER		= "localhost";
	var	$DB_LOGIN		= "edufim";
	var $DB_PASSWORD	= "i-edu0903";
	var $DB				= "edufim";

	function getConnection(){
		$dbconn = mysqli_connect($this->DB_SERVER, $this->DB_LOGIN, $this->DB_PASSWORD, $this->DB) or die("데이타베이스 연결에 실패했습니다.");
		$status = mysqli_select_db($dbconn,$this->DB);

		if($status)
			return $dbconn;
		else
			return $status;
	}
}

$db = new DbCon();
$dbc = $db->getConnection();
$GLOBALS['dbc'] = $dbc;

function stripslashes_fnc($varData){
	$varData = is_array($varData) ? array_map('stripslashes_fnc', $varData) : stripslashes($varData); 
    return $varData;
}
 
function mysqli_real_escape_string_fnc($varData){
	$varData = is_array($varData) ? array_map('mysqli_real_escape_string_fnc', $varData) : mysqli_real_escape_string($GLOBALS['dbc'],$varData); 
    return $varData;
}

function sql_injection($varData){
	if(get_magic_quotes_gpc()){
		$varData = stripslashes_fnc($varData);
	}

	$varData = mysqli_real_escape_string_fnc($varData);

	return $varData;
}


$_POST = sql_injection($_POST);
$_GET = sql_injection($_GET);

//해당 항수가 없으면 선언
if(!function_exists('mysqli_result')){
	function mysqli_result($res,$row=0,$col=0){ 
		$nums=mysqli_num_rows($res);
		if($nums && $row<=($nums-1) && $row>=0){
			mysqli_data_seek($res,$row);
			$resrow=(is_numeric($col))?mysqli_fetch_row($res):mysqli_fetch_assoc($res);
			if(isset($resrow[$col])){
				return $resrow[$col];
			}
		}
		return false;
	}

	@extract($_GET); 
	@extract($_POST); 
	@extract($_SERVER);
}
?>