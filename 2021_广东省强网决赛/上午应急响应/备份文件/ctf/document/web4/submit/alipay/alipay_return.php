<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once('../../includes/common.php');
require_once(SYSTEM_ROOT."alipay/alipay.config.php");
require_once(SYSTEM_ROOT."alipay/alipay_notify.class.php");

@header('Content-Type: text/html; charset=UTF-8');

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {
	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	//买家支付宝
	$buyer_email = $_GET['buyer_email'];

	$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
	$userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$srow['pid']}' limit 1")->fetch();
 if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		$url=creat_callback($srow);
		if($srow['status']==0){
		$pid=$srow['pid'];
		$alipayid=$srow['alipayid'];
		$username=$srow['username'];
		$money=$srow['addmoney'];
		$bz=$srow['bz'];
		if ($money >= 0.1 and $userrow['stype']==1) {
			$DB->exec("INSERT INTO `pay_alisettle` (`pid`,`out_trade_no`,`username`,`account`,`money`, `bz`) VALUES ('{$pid}', '{$out_trade_no}', '{$username}', '{$alipayid}', '{$money}', '{$bz}')");
		}
			$DB->query("update `pay_order` set `status` ='1',`endtime` ='$date',`buyer` ='$buyer_email' where `trade_no`='$out_trade_no'");
			processOrder($srow);
			echo '<script>window.location.href="'.$url['return'].'";</script>';
		}else{
			echo '<script>window.location.href="'.$url['return'].'";</script>';
		}
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
}
else {
    //验证失败
	sysmsg('支付宝返回验证失败！');
}

?>