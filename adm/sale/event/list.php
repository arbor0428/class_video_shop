<?php
$record_count = 10;  //한 페이지에 출력되는 레코드수
$link_count = 10; //한 페이지에 출력되는 페이지 링크수

if (!($record_start)) $record_start = 0;

$current_page = ($record_start / $record_count) + 1;
$group = floor($record_start / ($record_count * $link_count));

//쿼리조건
$query_ment = "where 1=1";

//상태
// if ($f_status == '0')        $query_ment .= " AND status='0'";
// elseif ($f_status == '1')    $query_ment .= " AND status='1'";
// elseif ($f_status == '1')    $query_ment .= " AND status='1'";

//선생님
// if ($f_tuid) $query_ment .= " AND tuid='$f_tuid'";

//분류
// if ($f_category1) $query_ment .= " AND cade01='$f_category'";
// elseif ($f_category2) $query_ment .= " AND cade02='$f_category'";

$sort_ment = "ORDER BY status DESC, uid DESC";
// if ($f_sort == 'rTime')$sort_ment = "order by rTime desc";
// else	$sort_ment = "order by uid desc";

$query = "SELECT *, (SELECT title FROM ks_coupon WHERE ks_coupon.uid=ks_event.coupon_uid) AS coupon_title FROM ks_event $query_ment $sort_ment";

$result = mysql_query($query) or die(mysql_error());
$total_record = mysql_num_rows($result);

$total_page = (int)($total_record / $record_count);
if ($total_record % $record_count) $total_page++;

$query .= " limit $record_start, $record_count";
$result = mysql_query($query) or die(mysql_error());
?>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
	<input type="text" style="display: none;"> <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
    <input type='hidden' name='type' value='<?= $type ?>'>
    <input type='hidden' name='uid' value=''>
    <input type='hidden' name='record_start' value='<?= $record_start ?>'>
    <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
    <input type='hidden' name='total_record' id='total_record' value='<?= $total_record ?>'>

	<div class="tbl-st-wrap01 @tbl-st-wrap" style="clear:both;border-top:0;">
		<div class="@tbl-st-w01 @tbl-st-w @tbl-st mb20 clearfix">
			
            <a href="javascript:void(0)" onclick="reg_write();" class="btn btn-sm btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">등록</span>
            </a>
            <!-- <a href="./cade/" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-bars-sort"></i>
                </span>
                <span class="text">카테고리</span>
            </a> -->

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable' style='min-width:900px;margin:5px 0;'>
				<tr>
					<th width='10'><input type="checkbox" name="allChk" value="" onclick="All_chk('allChk','chk[]');"></th>
					<th width='10'>상태</th>
					<th width=''>썸네일</th>
					<th width=''>제목</th>
					<th width=''>기간</th>
					<th width=''>쿠폰</th>
					<th width=''>편집</th>
				</tr>
				<?
				$nTime = time();

				if ($total_record) {
					// $i = $total_record - ($current_page - 1) * $record_count;

					while ($row = mysql_fetch_array($result)) {
						foreach ($row as $k => $v) {
							${$k} = $v;
						}
						if ($status == '1')		$statusTxt = "<span class='ico03'>진행중</span>";
						elseif ($status == '2')	$statusTxt = "<span class='ico09'>종료</span>";
						else					$statusTxt = "<span class='ico10'>대기</span>";
				?>
						<tr class='grayLine'>
							<td>
								<input type="checkbox" name="chk[]" value="<?= $uid ?>" class="cMail">
							</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="status_<?= $uid ?>" value='<?= $uid ?>' class="switch-input" style="position:fixed" <? if ($status == 1) echo 'checked'; ?>>
                                    <span class="switch-label" data-on="활성" data-off="비활성"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </td>
							<td><img src="/upfile/event/<?= $upfile01 ?>" alt="썸네일" width='100'></td>
							<td><?= $title ?></td>
							<td><?= $sDate ?> ~ <?= $eDate ?></td>
							<td><?= is_null($coupon_title)? "-" : $coupon_title ?></td>
							<!-- <td><a href="javascript:void(0)" onclick="formModal('<?= $uid ?>')" class='small cbtn bora01'>편집</a></td> -->
							<td>
								<a href="javascript:void(0)" class="btn btn-success btn-circle btn-sm" title='수정' onclick="reg_edit('<?= $uid ?>')">
									<i class="fas fa-info-circle"></i>
								</a>
							</td>
						</tr>
					<?
					}
				} else {
					?>
					<tr>
						<td colspan='16' style='padding:50px 0;text-align:center;'>등록된 이벤트가 없습니다.</td>
					</tr>
				<?
				}
				?>
			</table>
		</div>
	</div>
</form>

<script>
    $(function() {
        $('.switch-input').change(function() {
            if ($(this).is(":checked")) status = '1';
            else status = '0';
            type = 'able';
            uid = $(this).val();

            $.post('./proc.php', {
                'type': type,
                'uid': uid,
                'status': status
            }, function() {});
        });
    })
</script>

<?
$fName = 'frm01';
include _WWW . '/module/pageNum.php';
?>