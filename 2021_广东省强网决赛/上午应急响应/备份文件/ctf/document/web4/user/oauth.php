<?php
/**
 * 登录
**/
include("../includes/common.php");

if(isset($_GET['user_id']) && isset($_GET['token'])){

require_once(SYSTEM_ROOT."alipay/alipay.config.php");

//合作身份者id，以2088开头的16位纯数字
$alipay_config['partner']		= '合作者身份者ID';

//安全检验码，以数字和字母组成的32位字符
$alipay_config['key']			= 'sse5jtujl3uyz2i9p9lca2z1f047vyo7';
require_once(SYSTEM_ROOT."alipay/alipay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功

	//支付宝用户号
	$user_id = daddslashes($_GET['user_id']);

	$userrow=$DB->query("SELECT * FROM pay_user WHERE alipay_uid='{$user_id}' limit 1")->fetch();
	if($userrow){
		$pid=$userrow['id'];
		$key=$userrow['key'];
		if($islogin2==1){
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('当前支付宝已绑定商户ID:{$pid}，请勿重复绑定！');window.location.href='./';</script>");
		}
		$session=md5($pid.$key.$password_hash);
		$expiretime=time()+604800;
		$token=authcode("{$pid}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
		setcookie("user_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>window.location.href='./';</script>");
	}elseif($islogin2==1){
		$sds=$DB->exec("update `pay_user` set `alipay_uid` ='$user_id' where `id`='$pid'");
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('已成功绑定支付宝账号！');window.location.href='./';</script>");
	}else{
		$_SESSION['Oauth_alipay_uid']=$user_id;
		exit("<script language='javascript'>alert('请输入商户ID和密钥完成登录');window.location.href='./login.php?connect=true';</script>");
	}
}
else {
    //验证失败
    exit("<script language='javascript'>alert('验证失败');window.location.href='./login.php';</script>");
}

}elseif(isset($_GET['logout'])){
	setcookie("user_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogin2==1 && isset($_GET['unbind'])){
	$DB->exec("update `pay_user` set `alipay_uid` =NULL where `id`='$pid'");
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功解绑支付宝账号！');window.location.href='./';</script>");
}elseif($islogin2==1 && !isset($_GET['bind'])){
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>支付宝快捷登录</title>
</head>
<body>
<?php

require_once(SYSTEM_ROOT."alipay/alipay.config.php");

//合作身份者id，以2088开头的16位纯数字
$alipay_config['partner']		= '合作者身份ID';

//安全检验码，以数字和字母组成的32位字符
$alipay_config['key']			= '安全校验码';

require_once(SYSTEM_ROOT."alipay/alipay_submit.class.php");

/**************************请求参数**************************/

//目标服务地址
$target_service = "user.auth.quick.login";
//必填，页面跳转同步通知页面路径
$return_url = "http://".$_SERVER['HTTP_HOST']."/user/oauth.php";
//需http://格式的完整路径，不允许加?id=123这类自定义参数

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => "alipay.auth.authorize",
		"partner" => trim($alipay_config['partner']),
		"target_service"	=> $target_service,
		"return_url"	=> $return_url,
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;

?>
</body>
</html>