<?
// include "/home/edufim/www/adm/header.php";
include "/home/edufim/www/module/class/class.DbCon.php";

if($next_url == '/adm/sale/coupon/config.php'){
	$signup_coupon = $_POST['signup_coupon'];

    sqlExe("UPDATE config_sale SET config_value='$signup_coupon' WHERE config_key='signup_coupon'");

    echo 'SUCCESS';
}