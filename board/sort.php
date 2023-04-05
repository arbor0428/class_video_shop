<?

	include "/home/atx/www/module/login/head2.php";	
	include "/home/atx/www/module/class/class.DbCon.php";
	include "/home/atx/www/module/class/class.Util.php";
	include "/home/atx/www/module/class/class.Msg.php";



?>


  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
	function check_form(){
		form = document.frm01;
		form.action = '/board/sortProc.php';
		form.submit();
	}

  $(function() {
	$( "#sortable" ).sortable({
      placeholder: "ui-state-highlight"
    });
	$("#sortable").sortable();	
});

</script>
<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
  html>body #sortable li { height: 1.5em; line-height: 1.2em; }
  .ui-state-highlight { height: 111px; line-height: 1.2em; }
  </style>

			<link href="/css/button.css" rel="stylesheet">


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='pid' value='<?=$pid?>'>

<input type='hidden' name='mtype' value='<?=$mtype?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<div style='margin:20px auto;'>
	<a href='javascript:check_form()' class='btn blk'>저장하기</a>
	<span style='float:right;'>
		※ 드래그로 순서를 변경해주세요.<br>
		※ '저장하기' 버튼을 눌러야 저장됩니다.
	</span>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class='zTable'>
	<thead>
	<tr align="center">
		<th width="30%" class="b-text">이미지</th>
		<th width="70%" class="b-text b-text-tit">인증서명</th>
	</tr>
	</thead>
	<tbody id='sortable'>
	<?			
		$query = "select * from tb_board_list where table_id='table_1668476679' order by msort asc";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result)){
			$uid = $row["uid"];
			$title = $row["title"];
			$upfile01 = $row["userfile01"];
	?>
		<tr>
			<td>
				<input name='chk[]' type='hidden' value='<?=$uid?>'>
				<img src='/board/upfile/<?=$upfile01?>' style='height:100px;'>
			</td>
			<td><?=$title?></td>
		</tr>
	<?
		}	
	?>
	</tbody>
</table>