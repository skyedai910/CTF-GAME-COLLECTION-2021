<?php
/**
 * QQ互联
**/
include("../includes/common.php");
require_once(SYSTEM_ROOT."QC.conf.php");
require_once(SYSTEM_ROOT."QC.class.php");


$QC=new QC($QC_config);

if($_GET['code']){
	$access_token=$QC->qq_callback();
	$openid=$QC->get_openid($access_token);

	$userrow=$DB->query("SELECT * FROM pay_user WHERE qq_uid='{$openid}' limit 1")->fetch();
	if($userrow){
		$pid=$userrow['id'];
		$key=$userrow['key'];
		if($islogin2==1){
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('当前QQ已绑定商户ID:{$pid}，请勿重复绑定！');window.location.href='./';</script>");
		}
		$session=md5($pid.$key.$password_hash);
		$expiretime=time()+604800;
		$token=authcode("{$pid}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
		setcookie("user_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>window.location.href='./';</script>");
	}elseif($islogin2==1){
		$sds=$DB->exec("update `pay_user` set `qq_uid` ='$openid' where `id`='$pid'");
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('已成功绑定QQ！');window.location.href='./';</script>");
	}else{
		$_SESSION['Oauth_qq_uid']=$openid;
		exit("<script language='javascript'>alert('请输入商户ID和密钥完成登录');window.location.href='./login.php?connect=true';</script>");
	}
}elseif($islogin2==1 && isset($_GET['unbind'])){
	$DB->exec("update `pay_user` set `qq_uid` =NULL where `id`='$pid'");
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功解绑QQ！');window.location.href='./';</script>");
}elseif($islogin2==1 && !isset($_GET['bind'])){
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}else{
	$QC->qq_login();
}
?>