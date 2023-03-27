<?
include '/home/edufim/www/header.php';
$side_menu = 6;
$topTxt01 = '나의 리뷰';

include 'location02.php';

if(isEmpty($uid)) deny('/mypage/review/');

?>
<div class="subWrap">
    <div class="s_center dp_sb">
        
        <?
        include _WWW . '/mypage/sidemenu.php';
        ?>

        <div class="s_cont">
			<div class="s_cont_tit f20 bold2 c_bora01">리뷰</div>
            <div class="selectwrap dp_f dp_c">
                <form name="frm01" action="./proc.php" method="post">
					<table class="write_tbl">
						<tr>
							<th>
								<input type="hidden" name="uid" value="<?= $uid ?>">
								제목
							</th>
							<td>
								<input type="text" name="title" id="title" value="">
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
                        <button class="btn large bora c_w">등록</button>
                        <button class="btn large">취소</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?
include _WWW . '/footer.php';
?>