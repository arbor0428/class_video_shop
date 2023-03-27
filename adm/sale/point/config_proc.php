<?
// include "/home/edufim/www/adm/header.php";
include "/home/edufim/www/module/class/class.DbCon.php";

if ($next_url == '/adm/sale/point/config.php') {
    $signup_point = str_replace(',', '', $_POST['signup_point']);
    $review_point = str_replace(',', '', $_POST['review_point']);
    $point_del_day = $_POST['point_del_day'];

    sqlExe("UPDATE config_sale SET config_value='$signup_point' WHERE config_key='signup_point'");
    sqlExe("UPDATE config_sale SET config_value='$review_point' WHERE config_key='review_point'");
    sqlExe("UPDATE config_sale SET config_value='$point_del_day' WHERE config_key='point_del_day'");

    echo 'SUCCESS';
} else {
    echo 'FAIL';
}
