<?
include '/home/edufim/www/header.php';
$side_menu = 5;
$topTxt01 = '나의 리뷰';

include 'location02.php';
?>
<div class="subWrap">
    <div class="s_center dp_sb">

        <?
        include _WWW . '/mypage/sidemenu.php';
        ?>

        <div class="s_cont">
			<div class="s_cont_tit f20 bold2 c_bora01">질문</div>
            <div class="selectwrap dp_f dp_c">
                <form action="./proc.php" method="post" name="frm01" onsubmit="return reg_write()">
                    <table class="write_tbl">
						<tr>
							<th>강좌</th>
							<td>
								<select name="uid" id="uid">
									<option value="">선택</option>

									<?
									$row_arr = sqlArray("SELECT l.*, c.title FROM ks_learning l JOIN ks_class c ON l.class_uid=c.uid WHERE l.userid='$GBL_USERID'");
									foreach ($row_arr as $row) {
									?>
									
										<option value="<?= $row['uid'] ?>"><?= $row['title'] ?></option>

									<? } ?>

								</select>
							</td>
						</tr>
						<tr>
							<th>내용</th>
							<td>
								<textarea name="content" id="content" cols="30" rows="10"></textarea>
							</td>
						</tr>
					</table>
                    <div class="write_tbl_btn dp_f dp_c dp_cc">
                        <button type="submit" class="btn large bora c_w">등록</button>
                        <button type="button" onclick="reg_list()" class="btn large">취소</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const reg_list = function() {
        location.href = '/mypage/qna/'
    }
    const reg_write = function() {
        const form = document.frm01
		if (isFrmEmptyModal(form.uid, "강좌를 선택해 주십시오.")) return false;
		else if (isFrmEmptyModal(form.content, "내용을 입력해 주십시오.")) return false;
        else return true
    }
</script>

<?
include _WWW . '/footer.php';
?>