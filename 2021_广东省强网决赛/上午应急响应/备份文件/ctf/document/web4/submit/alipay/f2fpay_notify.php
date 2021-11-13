<?php
/* *
 * 支付宝当面付异步通知页面
 */

require_once('../../includes/common.php');
require_once(SYSTEM_ROOT."f2fpay/config.php");
require_once(SYSTEM_ROOT."f2fpay/AlipayTradeService.php");

$out_trade_no = daddslashes($_POST['out_trade_no']);
$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1 for update")->fetch();
$userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$srow['pid']}' limit 1")->fetch();
//计算得出通知验证结果
$alipaySevice = new AlipayTradeService($config); 
//$alipaySevice->writeLog(var_export($_POST,true));
$verify_result = $alipaySevice->check($_POST);

if($verify_result) {//验证成功
	//商户订单号

	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号

	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];

	//买家支付宝
	$buyer_id = $_POST['buyer_id'];

    if($_POST['trade_status'] == 'TRADE_FINISHED') {
		//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
    }
    else if ($_POST['trade_status'] == 'TRADE_SUCCESS' && $srow['status']==0) {
		//付款完成后，支付宝系统发送该交易状态通知
 $pid=$srow['pid'];
		$alipayid=$srow['alipayid'];
		$username=$srow['username'];
		$money=$srow['addmoney'];
		$bz=$srow['bz'];
		if ($money >= 0.1 and $userrow['stype']==1) {
			$DB->exec("INSERT INTO `pay_alisettle` (`pid`,`out_trade_no`,`username`,`account`,`money`, `bz`) VALUES ('{$pid}', '{$out_trade_no}', '{$username}', '{$alipayid}', '{$money}', '{$bz}')");
		}
		$DB->query("update `pay_order` set `status` ='1',`endtime` ='$date',`buyer` ='$buyer_id' where `trade_no`='$out_trade_no'");
		processOrder($srow);
    }

	echo "success";
}
else {
    //验证失败
    echo "fail";
}
?>