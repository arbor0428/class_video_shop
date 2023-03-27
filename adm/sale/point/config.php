<?
include "/home/edufim/www/adm/header.php";

$arr_rows = sqlArray("SELECT * FROM config_sale");
$config = array();
foreach ($arr_rows as $key => $row) {
    $config[$row['config_key']] = $row['config_value'];
}

?>

<style>
    .th {font-size:14px;color:#666;}
    .input-30 {width:80%;display:inline-block;}
    .form-group {margin-bottom:0 !important;}
    .text-white-50 {padding-top:10px !important;}

    @media (max-width: 768px){
        .input-30{width:30% !important;}
    }
</style>

<form name='frm01' id='frm01' class="user" method='post' action=''>
    <input type='text' style='display:none;'>
    <input type='hidden' name='next_url' value="<?= $_SERVER['PHP_SELF'] ?>">

    <div class="tbl-st">
        <div class="cols">
            <div class="cols_30 cols_ th">회원가입 포인트</div>
            <div class="cols_70 cols_">
                <div class="form-group">
                    <input type="text" name="signup_point" id="signup_point" class="form-control input_won"
                         value="<?= number_format($config['signup_point']) ?>" maxlength="7">
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_30 cols_ th">리뷰작성 포인트</div>
            <div class="cols_70 cols_">
                <div class="form-group">
                    <input type="text" name="review_point" id="review_point" class="form-control input_won"
                         value="<?= number_format($config['review_point']) ?>" maxlength="7">
                </div>
            </div>
        </div>

        <div class="cols">
            <div class="cols_30 cols_ th">포인트 자동소멸</div>
            <div class="cols_70 cols_">
                <div class="form-group">
                    <select name="point_del_day" id="point_del_day" class="form-control">
                        <option value='' <? if ($config['point_del_day'] == '') echo 'selected'; ?>>없음</option>
                        <option value='30' <? if ($config['point_del_day'] == '30') echo 'selected'; ?>>30일</option>
                        <option value='60' <? if ($config['point_del_day'] == '60') echo 'selected'; ?>>60일</option>
                        <option value='90' <? if ($arr['point_del_day'] == '90') echo 'selected'; ?>>90일</option>
                        <option value='150' <? if ($config['point_del_day'] == '150') echo 'selected'; ?>>150일</option>
                        <option value='180' <? if ($config['point_del_day'] == '180') echo 'selected'; ?>>180일</option>
                        <option value='365' <? if ($config['point_del_day'] == '365') echo 'selected'; ?>>365일</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div style='width:100%;margin:40px 0;text-align:center;'>
        <a href="javascript:void(0)" onclick="formChk();" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">저장</span>
        </a>
    </div>
</form>

<script>
    function formChk() {
        form = document.frm01;
        if (isFrmEmpty(form.signup_point, "회원가입 포인트를 입력해 주십시오.")) return;
        if (isFrmEmpty(form.review_point, "리뷰작성 포인트를 입력해 주십시오.")) return;

        setTimeout(function() {
            var params = $("#frm01").serialize();
            $.ajax({
                url: './config_proc.php',
                type: 'POST',
                data: params,
                dataType: 'html',
                success: function(response) {
                    console.log(response);
                    if (response.trim() === 'SUCCESS')
                        parent.$('.multiBox_close').click();
                },
                error: function(error) {
                    alert('통신오류');
                    return;
                }
            });
        }, 100);
    }
</script>