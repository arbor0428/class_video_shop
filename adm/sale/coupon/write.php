<?
if ($type == 'edit' && $uid) { //수정할때
    $result = mysql_query("SELECT * FROM ks_coupon WHERE uid=$uid");
    $row = mysql_fetch_assoc($result);
    if ($row) {
        foreach ($row as $k => $v) {
            ${$k} = $v;
        }
    } else {
        $MSG->backMsg('접근오류');
        exit;
    }
}
?>

<form name='frm01' class="user" method='post' ENCTYPE="multipart/form-data">
    <input type='text' style='display:none;'>
    <input type='hidden' name='uid' value='<?= $uid ?>'>
    <input type='hidden' name='type' id='type' value='<?= $type ?>'>
    <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">
    <input type='hidden' name='f_status' value="<?= $f_status ?>">
    <input type='hidden' name='f_userid' value="<?= $f_userid ?>">
    <input type='hidden' name='f_name' value="<?= $f_name ?>">
    <input type='hidden' name='f_sort' value="<?= $f_sort ?>">

    <div class="tbl-st">
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>쿠폰 명</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control" value="<?= $title ?>">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>할인 금액</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="discountPrice" id="discountPrice" class="form-control input_won" value="<?= is_null($discountPrice)? "" : number_format($discountPrice) ?>" maxlength="8">
                </div>
            </div>
        </div>
        <div class="cols">
            <div class="cols_20 cols_ th"><span class='eqc'>*</span>사용기간</div>
            <div class="cols_80 cols_">
                <div class="form-group">
                    <input type="text" name="discountPeriod" id="discountPeriod" class="form-control input_won" value="<?= $discountPeriod ?>" maxlength="8">
                </div>
            </div>
        </div>
        <!-- <div class="cols">
			<div class="cols_20 cols_ th"><span class='eqc'>*</span>발급 가능 대상</div>
			<div class="cols_80 cols_">
				<div class="form-group">
					<?
                    if ($type == 'write') {
                    ?>
						<input type="text" name="userid" id="userid" class="form-control input-30" value="<?= $userid ?>" list="userList" placeholder="전체회원">
						<datalist id="userList">
						<?
                        $uArr = sqlArray("select * from ks_member where mtype='M' order by uid");
                        foreach ($uArr as $k => $v) {
                            if ($userid == $v['userid'])    $chk = 'selected';
                            else                        $chk = '';
                        ?>
							<option value="<?= $v['userid'] ?>" label="<?= $v['name'] ?>" <?= $chk ?>><?= $v['userid'] ?></option>
						<?
                        }
                        ?>
						</datalist>
					<?
                    } elseif ($type == 'edit') {
                        $result = mysql_query("SELECT * FROM MAP_MEMBER_COUPON WHERE coupon_uid='$uid'");
                        $num_row = mysql_num_rows($result);
                        if ($num_row > 1) {
                            echo "전체회원";
                        } else {
                            $row = mysql_fetch_array($result);
                            echo $row['userid'];
                        }
                    }
                    ?>
				</div>
			</div>
		</div>
	    <div class="cols">
			<div class="cols_10 cols_ th"><span class='eqc'>*</span>쿠폰 사용 기간</div>
			<div class="cols_80 cols_">
				<div class="form-group datapicker-wrap">
					<input type="text" name="discountDate" id="discountDate" class="form-control fpicker" value="<?= $discountDate ?>" placeholder='종료 날짜'>
				</div>
			</div>
		</div>
	</div> -->

        <div style='width:100%;margin:40px 0;text-align:center;'>
            <a href="javascript:void(0);" onclick="reg_list();" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-list"></i>
                </span>
                <span class="text">목록으로</span>
            </a>
            <a href="javascript:void(0);" onclick="form_confirm();" class="btn btn-info btn-icon-split" style="margin-left:20px;">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <? if ($type == 'write') { ?>
                    <span class="text">등록하기</span>
                <? } else { ?>
                    <span class="text">수정하기</span>
                <? } ?>
            </a>
            <?
            if ($type == 'edit') {
            ?>
                <a href="javascript:void(0);" onclick="reg_del_confirm('<?= $uid ?>');" class="btn btn-danger btn-icon-split" style="margin-left:20px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">삭제하기</span>
                </a>
            <? } ?>
        </div>

</form>

<script type="text/javascript">
    function goList() {
        history.back();
    }

    function form_confirm() {
        const form = document.frm01;

        form.discountPrice.value = uncomma(form.discountPrice.value)
        if (isFrmEmpty(form.title, "필수 항목을 입력하세요.")) return;
        if (isFrmEmpty(form.discountPrice, "필수 항목을 입력하세요.")) return;
        if (isFrmEmpty(form.discountPeriod, "필수 항목을 입력하세요.")) return;

        /*
        let isValidDate = (new Date()) <= (new Date(form.discountDate.value))
        if(!isValidDate) {
        	alert('올바른 기간을 입력하세요.')
        	// form.eDate.focus
        }
        */

        //form.target = 'ifra_gbl';
        form.action = 'proc.php';
        form.submit();
    }

    function userDel() {
        if (confirm('해당 데이터를 삭제하시겠습니까?')) {
            const form = document.frm01;

            form.type.value = 'del';
            //	form.target = 'ifra_gbl';
            form.action = 'proc.php';
            form.submit();
        }
    }
</script>