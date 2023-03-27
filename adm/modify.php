<?
include "/home/edufim/www/adm/head.php";

$row = sqlRow("SELECT * FROM ks_member WHERE userid='$GBL_USERID'");

?>

<style>
    .btn-info {
        color: #fff;
        background-color: #36b9cc;
        border-color: #36b9cc;
    }
</style>

<form name='frm01' class="user" method='post' action='./proc.php'>
    <input type='text' style='display:none;'>
    <input type='hidden' name="uid">

    <table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
        <tr>
            <th width='30%'><span class='eqc'>*</span>이메일</th>
            <td width='70%'><?= $row['userid'] ?></td>
        </tr>
        <tr>
            <th><span class='eqc'>*</span>현재 비밀번호</th>
            <td><input type='password' name='o_pwd' id='o_pwd' value='' style='width:100%;' class='textBox01'></td>
        </tr>
        <tr>
            <th><span class='eqc'>*</span>신규 비밀번호</th>
            <td><input type='password' name='n_pwd1' id='n_pwd1' style='width:100%;' class='textBox01'></td>
        </tr>

        <tr>
            <th><span class='eqc'>*</span>비밀번호 확인</th>
            <td><input type='password' name='n_pwd2' id='n_pwd2' style='width:100%;' class='textBox01'></td>
        </tr>
    </table>

    <div style='width:100%;margin:20px 0;text-align:center;'>
        <a href="javascript:void(0)" onclick="modifyChk();" class="btn btn-sm btn-success btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-download"></i>
            </span>
            <span class="text">수정</span>
        </a>
    </div>

    <iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>
</form>

<script>
    function modifyChk() {
        form = document.frm01;

        if (isFrmEmpty(form.n_pwd1, "신규 비밀번호를 입력해 주십시오.")) return;
        if (isFrmEmpty(form.n_pwd2, "신규 비밀번호를 한번더 입력해 주십시오.")) return;

        n_pwd1 = $('#n_pwd1').val();
        n_pwd2 = $('#n_pwd2').val();

        if (n_pwd1 != n_pwd2) {
            alert('입력하신 신규 비밀번호를 확인해 주시기 바랍니다.');
            $('#n_pwd2').focus();
            return;
        }

        if (isFrmEmpty(form.o_pwd, "현재 비밀번호를 입력해 주십시오.")) return;

        form.uid.value = '<?= $GBL_UID ?>';

        // form.target = 'ifra_gbl';
        form.submit();
    }
</script>

</body>

</html>