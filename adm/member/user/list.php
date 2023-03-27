<?
$record_count = 10;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!($record_start)) $record_start = 0;

$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "WHERE 1=1";

// 
if ($f_status == '1')        $query_ment .= " and status='1'";
elseif ($f_status == '2')    $query_ment .= " and status='2'";
elseif ($f_status == '3')    $query_ment .= " and status=''";

//상태
if ($f_mtype == 'M')        $query_ment .= " AND mtype='M'";
elseif ($f_mtype == 'T')    $query_ment .= " AND mtype='T'";
elseif ($f_mtype == 'A')    $query_ment .= " AND mtype='A'";


//등급
// if ($f_level == '1')			$query_ment .= " and level='VIP'";
// elseif ($f_level == '2')	$query_ment .= " and level=''";

//아이디
if ($f_userid)     $query_ment .= " AND userid LIKE '%$f_userid%'";

//성명
if ($f_name)     $query_ment .= " AND name LIKE '%$f_name%'";

if (!$f_sort)    $f_sort = 'rTime';

if ($f_sort == 'rTime')                $sort_ment = "order by rTime desc";
elseif ($f_sort == 'loginTime')        $sort_ment = "order by loginTime desc";

$query = "SELECT * FROM ks_member $query_ment $sort_ment";

$result = mysql_query($query) or die(mysql_error());
$total_record = mysql_num_rows($result);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) $total_page++;

$query2 = $query . " limit $record_start, $record_count";
$result = mysql_query($query2) or die(mysql_error());
?>

<input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>

<!-- <div class="mo-hand1 mo-hand" style="float:right;text-align:right;">
	<span class="scorll-hand">
		<img src="/common/adm/images/scroll_hand.gif" style="max-width:100%;">
	</span>
</div> -->

<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
    <div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">

        <!-- <a href="javascript:modalOpen('m');" class="btn btn-sm btn-primary btn-icon-split" style="margin-top:-5px;" title="광고수신 미동의 회원에게는 발송되지 않습니다.">
			<span class="icon text-white-50">
				<span class="lnr lnr-envelope"></span>
			</span>
			<span class="text">메일 보내기</span>
		</a>

		<a href="javascript:ifra_xls();" class="btn btn-sm btn-success btn-icon-split" style="margin-top:-5px;">
			<span class="icon text-white-50">
				<i class="fas fa-download"></i>
			</span>
			<span class="text">엑셀다운로드</span>
		</a>
        
        <a href="javascript:modalOpen('c');" class="btn btn-sm btn-info btn-icon-split">
        <a href="javascript:alert('준비중입니다');" class="btn btn-sm btn-info btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">쿠폰발급</span>
		</a> -->

        <table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
            <tr>
                <th width='10'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
                <th width='35'>분류</th>
                <th width='35'>상태</th>
                <th width='35'>소셜로그인</th>
                <th>이메일</th>
                <th>이름</th>
                <th>연락처</th>
                <!-- <th>마케팅동의</th> -->
                <th width='120'>가입일시</th>
                <th width='120'>최근접속일시</th>
                <th width='60'>편집</th>
            </tr>
            <?
            // $nTime = time();

            if ($total_record) {
                $i = $total_record - ($current_page - 1) * $record_count;

                while ($row = mysql_fetch_assoc($result)) {
                    foreach ($row as $k => $v) {
                        ${$k} = $v;
                    }
                    if ($status == '1')     $statusTxt = "<span class='ico03'>정상</span>";
                    elseif ($status == '2') $statusTxt = "<span class='ico07'>휴먼</span>";
                    elseif ($status == '3') $statusTxt = "<span class='ico10'>탈퇴</span>";
                    else                    $statusTxt = "<span class='ico09'>정지</span>";

                    if ($mtype == 'M')      $typeTxt = "<span class='ico01'>회원</span>";
                    elseif ($mtype == 'T')  $typeTxt = "<span class='ico05'>강사</span>";
                    else                    $typeTxt = "<span class='sco07'>관리자</span>";
            ?>
                    <tr class='grayLine'>
                        <td>
                            <input type="checkbox" name="chk[]" value="<?= $uid ?>" class="cMail">
                        </td>
                        <td><?= $typeTxt ?></td>
                        <td><?= $statusTxt ?></td>
                        <td>
                            <i></i>
                        </td>
                        <td><?= $userid ?></td>
                        <td><?= $name ?></td>
                        <td><?= $phone ?></td>
                        <td><?= $rDate ?></td>
                        <td><?= $loginDate ?></td>
                        <td>
                            <a href="javascript:formModal('<?= $uid ?>');" class="btn btn-success btn-circle btn-sm" title='수정'>
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <!-- <a href="javascript:checkDel('<?= $name ?>','<?= $uid ?>');" class="btn btn-danger btn-circle btn-sm" title='삭제'>
								<i class="fas fa-trash"></i>
							</a> -->
                        </td>
                    </tr>


                <?
                    $i--;
                }
            } else {
                ?>
                <tr>
                    <td colspan='16' style='padding:50px 0;text-align:center;'>회원정보가 없습니다.</td>
                </tr>
            <?
            }
            ?>
        </table>
    </div>
</div>

<?
$fName = 'frm01';
include _WWW . '/module/pageNum.php';
?>