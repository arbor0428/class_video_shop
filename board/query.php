<?

if($list_mod != '스케쥴러형'){

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where table_id='$table_id'";

	if($word)		$query_ment .= " and $field like '%$word%'";

	if($only_you)	$query_ment .= " and userid='$GBL_USERID'";


	if($f_data01)	$query_ment .= " and data01='$f_data01'";

	if($table_id=='table_1668476679'){
		$sort_ment = "order by msort asc";
	}else{
		$sort_ment = "order by notice_chk desc, reg_date desc";
	}
	


	if($f_cade03)						$query_ment .= "and cade03 = '$f_cade03'";


	$query = "select * from tb_board_list $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_board_list $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


	if($table_id=='table_1482988371' && $GBL_MTYPE!='A'){		//1:1문의하기 처리
		$query = "select * from tb_board_list $query_ment and userid='$GBL_USERID'";		
		$result = mysql_query($query);
	}

}
?>