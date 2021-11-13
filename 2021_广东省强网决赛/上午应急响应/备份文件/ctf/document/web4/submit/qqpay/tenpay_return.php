<?php

//---------------------------------------------------------
//O泡财付通即时到帐支付页面回调示例，商户按照此文档进行开发即可
//---------------------------------------------------------
require_once('../../includes/common.php');
require (SYSTEM_ROOT."tenpay/tenpay.config.php");
require (SYSTEM_ROOT."tenpay/ResponseHandler.class.php");
require (SYSTEM_ROOT."tenpay/RequestHandler.class.php");
require (SYSTEM_ROOT."tenpay/client/ClientResponseHandler.class.php");
require (SYSTEM_ROOT."tenpay/client/TenpayHttpClient.class.php");

@header('Content-Type: text/html; charset=UTF-8');

/* 创建支付应答对象 */
$resHandler = new ResponseHandler();
$resHandler->setKey($tenpay_config['key']);

//判断签名
if($resHandler->isTenpaySign()) {
	
	//通知id
	$notify_id = $resHandler->getParameter("notify_id");
	
	//通过通知ID查询，确保通知来至财付通
	//创建查询请求
	$queryReq = new RequestHandler();
	$queryReq->init();
	$queryReq->setKey($tenpay_config['key']);
	$queryReq->setGateUrl("https://gw.tenpay.com/gateway/verifynotifyid.xml");
	$queryReq->setParameter("partner", $tenpay_config['mch']);
	$queryReq->setParameter("notify_id", $notify_id);
	
	//通信对象
	$httpClient = new TenpayHttpClient();
	$httpClient->setTimeOut(5);
	//设置请求内容
	$httpClient->setReqContent($queryReq->getRequestURL());
	
	//后台调用
	if($httpClient->call()) {
		//设置结果参数
		$queryRes = new ClientResponseHandler();
		$queryRes->setContent($httpClient->getResContent());
		$queryRes->setKey($tenpay_config['key']);
		
		//判断签名及结果
		//只有签名正确,retcode为0，trade_state为0才是支付成功
		if($queryRes->isTenpaySign() && $queryRes->getParameter("retcode") == "0" && $queryRes->getParameter("trade_state") == "0" && $queryRes->getParameter("trade_mode") == "1" ) {
			//取结果参数做业务处理
			$out_trade_no = $queryRes->getParameter("out_trade_no");
			//财付通订单号
			$transaction_id = $queryRes->getParameter("transaction_id");
			//金额,以分为单位
			$total_fee = $queryRes->getParameter("total_fee");
			//如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
			$discount = $queryRes->getParameter("discount");
			
			//------------------------------
			//处理业务开始
			//------------------------------
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

		} else {
			//当做不成功处理
			sysmsg('财付通即时到帐支付失败！');
		}
	}else {
		//后台调用通信失败,写日志，方便定位问题，这些信息注意保密，最好不要打印给用户
		showmsg('订单通知查询失败:' . $httpClient->getResponseCode() .',' . $httpClient->getErrInfo().$resHandler->getDebugInfo(),4,'shop');
	} 
} else {
	showmsg('认证签名失败！'.$resHandler->getDebugInfo(),4,'shop');
}

?>