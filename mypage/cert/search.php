<?
include "/home/edufim/www/adm/head.php";

foreach ($_POST as $key => $value) {
    echo "$key : $value <br>";
}
?>

<style>
    .row_tit {width: 20%;}
    .row_det {width: 80%;}
    .row_det input {
        width: 30%;
        box-sizing: border-box;
        height: 40px;
        border-radius: 3px;
        border: 1px solid #EFEFEF;
        font-size: 0.875rem;
    }
    .cerSearchBtn {
        margin: 0 auto;
        width: 240px;
        height: 50px;
        border-radius: 5px;
    }
    @media (max-width:600px){
        .cerSearchBtn {
            height: 40px;
        }
    }
</style>

<form name="frm01" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <p class="f24 bold2 m_40">발급 조회</p>

    <div class="dp_f dp_c m_40">
        <div class="row_tit f18 bold2">발급번호</div>
        <div class="row_det dp_f dp_c">
            <input type="text" name="search1">
            &nbsp;-&nbsp;
            <input type="text" name="search2">
            &nbsp;-&nbsp;
            <input type="text" name="search3">
        </div>
    </div>

    <button class="bora01 c_w dp_f dp_c dp_cc cerSearchBtn">조회하기</button>
</form>

<script>

</script>

<?
include '/home/edufim/www/adm/footer.php';
?>