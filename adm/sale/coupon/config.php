<?
include "/home/edufim/www/adm/header.php";

$arr = sqlArray("SELECT * FROM ks_coupon");
$coupon_uid = sqlRowOne("SELECT config_value FROM config_sale WHERE config_key='signup_coupon'");
?>

<style>
    .th {font-size:14px;color:#666;}
    .input-30 {width:30%;display:inline-block;}
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
            <div class="cols_30 cols_ th">회원가입 쿠폰</div>
            <div class="cols_70 cols_">
                <div class="form-group">
                    <select name="signup_coupon" id="signup_coupon">
                        <option value="">없음</option>
                        <?
                        foreach ($arr as $k => $v) {
                        ?>
                            <option value="<?= $v['uid'] ?>" <? if ($v['uid'] == $coupon_uid) echo 'selected'; ?>><?= $v['title'] ?></option>
                        <?
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div style='width:100%;margin:40px 0;text-align:center;'>
        <a href="javascript:formChk();" class="btn btn-secondary btn-icon-split">
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

        setTimeout(function() {
            var params = jQuery("#frm01").serialize();
            jQuery.ajax({
                url: 'config_proc.php',
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