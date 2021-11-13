<?php
header("content-type:text/html;charset=utf-8");
error_reporting(E_ALL); ini_set("display_errors", 1);
error_reporting(0); 	
define('SYSTEM_ROOT', dirname(__FILE__).'/');
include SYSTEM_ROOT."common.php";
$update=update_version();//获得更新内容
$check=$update['code'];
if($check=='-1'){
	$update = $_POST['update'];
	// uppercase headings
	$update = preg_replace('(<h([1-6])>(.*?)</h\1>)e','"<h$1>" . strtoupper("$2") . "</h$1>"',$update);//防止post替换更新数据
}
?>