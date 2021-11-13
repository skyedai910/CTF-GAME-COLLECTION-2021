<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>正在验证订单信息...</title>
</head>
<?php
include("../../includes/common.php");
require_once(SYSTEM_ROOT."alipay/alipay.config.php");
require_once(SYSTEM_ROOT."epay/epay_submit.class.php");
/**************************请求参数**************************/
        $notify_url = "http://".$conf['local_domain']."/submit/epay/epay_notify.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = "http://".$conf['local_domain']."/submit/epay/epay_return.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //商户订单号
        $out_trade_no = $_GET['trade_no'];
        //商户网站订单系统中唯一订单号，必填
	//支付方式
        $type = $_GET['type'];
        //商品名称
        $name = $_GET['name'];
	//付款金额
        $money = $_GET['money'];
	//站点名称
        $sitename =  $_GET['sitename'];
        
        if($type == "alipay"){
            $ua = "ali";
        }elseif($type == "wxpay"){
             $ua = "wx";
        }elseif($type == "qqpay"){
             $ua = "qq";
        }elseif($type == "tenpay"){
             $ua = "ten";
        }
        
        $alipay_config['partner'] = $conf[$ua.'_epay_api_id'];
        $alipay_config['key'] = $conf[$ua.'_epay_api_key'];
        $alipay_config['apiurl'] = $conf[$ua.'_epay_api_url'];
      //  exit($alipay_config['apiurl']);
/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"pid" => trim($alipay_config['partner']),
		"type" => $type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"name"	=> $name,
		"money"	=> $money,
		"sitename"	=> $sitename
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;

?>
</body>
</html>