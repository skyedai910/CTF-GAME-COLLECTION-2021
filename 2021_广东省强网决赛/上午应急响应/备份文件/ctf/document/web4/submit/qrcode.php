<?php
require '../includes/common.php';
include 'conf.php';

@header('Content-Type: text/html; charset=UTF-8');

if(isset($_GET['pid'])){
	$queryArr=$_GET;
}else{
	$queryArr=$_POST;
	if(!isset($queryArr['pid']))exit('{"code":-4,"msg":"提交方式错误"}');
}

$prestr=createLinkstring(argSort(paraFilter($queryArr)));
$pid=intval($queryArr['pid']);
if(empty($pid))exit('{"code":-3,"msg":"PID不存在"}');
$userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$pid}' limit 1")->fetch();
if(!md5Verify($prestr, $queryArr['sign'], $userrow['key']))exit('{"code":-2,"msg":"签名校验失败，请返回重试！"}');

if($userrow['active']==0)exit('{"code":-3,"msg":"商户已封禁，无法支付！"}');

$type=daddslashes($queryArr['type']);
$out_trade_no=daddslashes($queryArr['out_trade_no']);
$notify_url=strip_tags(daddslashes($queryArr['notify_url']));
$name=strip_tags(daddslashes($queryArr['name']));
$money=daddslashes($queryArr['money']);
$spbill_create_ip=daddslashes($queryArr['spbill_create_ip']);
$sitename=urlencode(daddslashes($queryArr['sitename']));


if(empty($out_trade_no))exit('{"code":-2,"msg":"订单号(out_trade_no)不能为空"}');
if(empty($notify_url))exit('{"code":-2,"msg":"通知地址(notify_url)不能为空"}');
if(empty($name))exit('{"code":-2,"msg":"商品名称(name)不能为空"}');
if(empty($money))exit('{"code":-2,"msg":"金额(money)不能为空"}');
if(empty($type))exit('{"code":-2,"msg":"支付方式(type)不能为空"}');
if($money<=0 || !is_numeric($money))exit('{"code":-2,"msg":"金额不合法"}');
if(!preg_match('/^[a-zA-Z0-9.\_\-]+$/',$out_trade_no))exit('{"code":-2,"msg":"订单号(out_trade_no)格式不正确"}');

$trade_no=date("YmdHis").rand(11111,99999);
$domain=getdomain($notify_url);
if(!$DB->query("insert into `pay_order` (`trade_no`,`out_trade_no`,`notify_url`,`return_url`,`type`,`pid`,`addtime`,`name`,`money`,`domain`,`ip`,`status`) values ('".$trade_no."','".$out_trade_no."','".$notify_url."','".$return_url."','".$type."','".$pid."','".$date."','".$name."','".$money."','".$domain."','".$clientip."','0')"))exit('{"code":-2,"msg":"创建订单失败，请返回重试！"}');

if($type=='wxpay'){

$name = $nameconf[$pid]?$nameconf[$pid]:'onlinepay-'.time();

require_once SYSTEM_ROOT."wxpay/WxPay.Api.php";
require_once SYSTEM_ROOT."wxpay/WxPay.NativePay.php";
$notify = new NativePay();
$input = new WxPayUnifiedOrder();
$input->SetBody($name);
$input->SetOut_trade_no($trade_no);
$input->SetTotal_fee($money*100);
$input->SetSpbill_create_ip($spbill_create_ip?$spbill_create_ip:$clientip);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetNotify_url('http://'.$conf['local_domain'].'/submit/wxpay/wxpay_notify.php');
$input->SetTrade_type("NATIVE");
$result = $notify->GetPayUrl($input);
if($result["result_code"]=='SUCCESS'){
	$code_url = $result['code_url'];
	exit('{"code":1,"type":"wxpay","trade_no":"'.$trade_no.'","code_url":"'.$code_url.'"}');
}else{
	exit('{"code":-1,"msg":"微信支付下单失败！['.$result["err_code"].'] '.$result["err_code_des"].'"}');
}

}elseif($type=='qqpay'){

$name = $nameconf[$pid]?$nameconf[$pid]:'Opao-'.time();

require_once (SYSTEM_ROOT.'qqpay/qpayMchAPI.class.php');

//入参
$params = array();
$params["out_trade_no"] = $trade_no;
$params["body"] = $name;
$params["fee_type"] = "CNY";
$params["notify_url"] = 'http://'.$conf['local_domain'].'/submit/qqpay/qqpay_notify.php';
$params["spbill_create_ip"] = $spbill_create_ip?$spbill_create_ip:$clientip;
$params["total_fee"] = intval($money*100);
$params["trade_type"] = "NATIVE";

//api调用
$qpayApi = new QpayMchAPI('https://qpay.qq.com/cgi-bin/pay/qpay_unified_order.cgi', null, 10);
$ret = $qpayApi->reqQpay($params);
$result = QpayMchUtil::xmlToArray($ret);
//print_r($arr);

if($result['return_code']=='SUCCESS' && $result['result_code']=='SUCCESS'){
	$code_url = $result['code_url'];
	exit('{"code":1,"type":"qqpay","trade_no":"'.$trade_no.'","code_url":"'.$code_url.'"}');
}else{
	exit('{"code":-1,"msg":"QQ钱包支付下单失败！['.$result['err_code'].']'.$result['err_code_desc'].'"}');
}

}else{
	exit('{"code":-2,"msg":"支付方式不存在"}');
}

?>