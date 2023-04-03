<?
include '../head.php';
include '../../module/loading.php';

$row = sqlRowOne("SELECT response FROM ks_pointPayList");
echo $row;