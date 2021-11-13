<?php
$baidu='1234567890-';
include("../includes/common.php");
@header('Content-Type: application/json; charset=UTF-8');
if($islogin!=1){
	exit('{"code":0}');
}elseif($islogin==1){
	exit('{"code":1}');
}
@$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
?>