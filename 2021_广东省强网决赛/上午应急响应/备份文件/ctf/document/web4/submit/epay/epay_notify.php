<?php
/* *
 * 功能：O泡易支付异步通知页面
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见epay_notify_class.php中的函数verifyNotify
 */
require_once('../../includes/common.php');
require_once(SYSTEM_ROOT."alipay/alipay.config.php");
require_once(SYSTEM_ROOT."epay/epay_notify.class.php");

$type = $_REQUEST['type'];
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
//exit($alipay_config['apiurl']);

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();
$date = date("Y-m-d H:i:s");

if($verify_result) {//验证成功
       // file_put_contents("c.txt", "异步OK");
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//商户订单号
	$out_trade_no = $_GET['out_trade_no'];
	//支付交易号
	$trade_no = $_GET['trade_no'];
	//交易状态
	$trade_status = $_GET['trade_status'];
	//支付方式
	//$type = $_GET['type'];
    $money = $_GET['money'];

	if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理
		//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
		//如果有做过处理，不执行商户的业务程序
		//注意：
		//付款完成后，OPay系统发送该交易状态通知
	$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
 $userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$srow['pid']}' limit 1")->fetch();
		if($srow['status']==0){
			$url=creat_callback($srow);
			$pid=$srow['pid'];
			$alipayid=$srow['alipayid'];
			$username=$srow['username'];
			$money=$srow['addmoney'];
			$bz=$srow['bz'];
		if ($money >= 0.1 and $userrow['stype']==1) {
			$DB->exec("INSERT INTO `pay_alisettle` (`pid`,`out_trade_no`,`username`,`account`,`money`, `bz`) VALUES ('{$pid}', '{$out_trade_no}', '{$username}', '{$alipayid}', '{$money}', '{$bz}')");
		}
			$DB->query("update `pay_order` set `status` ='1',`endtime` ='$date' where `trade_no`='$out_trade_no'");
			processOrder($srow);
			curl_get($url['notify']);
			proxy_get($url['notify']);
		}

    }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        
	echo "success";		//请不要修改或删除
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";
}
?>