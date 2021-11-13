<?php

//---------------------------------------------------------
//财付通即时到帐支付后台回调示例，商户按照此文档进行开发即可
//---------------------------------------------------------
require_once('../../includes/common.php');
require_once(SYSTEM_ROOT.'qqpay/qpayNotify.class.php');
@header('Content-Type: text/html; charset=UTF-8');

$qpayNotify = new QpayNotify();
$result = $qpayNotify->getParams();
//判断签名
if($qpayNotify->verifySign()) {

//判断签名及结果（即时到帐）
	if($result['trade_state'] == "SUCCESS") {
		//商户订单号
		$out_trade_no = $result['out_trade_no'];
		//QQ钱包订单号
		$transaction_id = $result['transaction_id'];
		//金额,以分为单位
		$total_fee = $result['total_fee'];
		//币种
		$fee_type = $result['fee_type'];

		//------------------------------
		//处理业务开始
		//------------------------------
		$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
		$userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$srow['pid']}' limit 1")->fetch();
		if($srow['status']==0){
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
		}
		//------------------------------
		//处理业务完毕
		//------------------------------
		echo "<xml>
<return_code>SUCCESS</return_code>
</xml>";
	} else {
		echo "<xml>
<return_code>FAIL</return_code>
</xml>";
	}

} else {
	//回调签名错误
	echo "<xml>
<return_code>FAIL</return_code>
<return_msg>签名失败</return_msg>
</xml>";
} 

?>