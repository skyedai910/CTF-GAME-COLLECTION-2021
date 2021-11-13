<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>正在为您跳转到支付页面，请稍候...</title>
    <style type="text/css">
        body {margin:0;padding:0;}
        p {position:absolute;
            left:50%;top:50%;
            width:330px;height:30px;
            margin:-35px 0 0 -160px;
            padding:20px;font:bold 14px/30px "宋体", Arial;
            background:#f9fafc url(/assets/images/load.gif) no-repeat 20px 26px;
            text-indent:22px;border:1px solid #c5d0dc;}
        #waiting {font-family:Arial;}
    </style>
<script>
function open_without_referrer(link){
document.body.appendChild(document.createElement('iframe')).src='javascript:"<script>top.location.replace(\''+link+'\')<\/script>"';
}
</script>
</head>
<body>
<?php 
$is_defend = true;
require './includes/common.php';
@header('Content-Type: text/html; charset=UTF-8');
$type = daddslashes($_GET['type']);
$money = daddslashes($_GET['money']);
$trade_no = daddslashes($_GET['trade_no']);
$sitename = urlencode(base64_encode(daddslashes($queryArr['sitename'])));
$row = $DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if (!$row) {
    exit('该订单号不存在，请返回来源地重新发起请求！');
}
$DB->query("update `pay_order` set `type` ='{$type}',`addtime` ='{$date}' where `trade_no`='{$trade_no}'");
if ($type == 'alipay') {
    if ($conf['alipay_api'] == 0) {
        exit($conf['ali_close_info']);
    } elseif ($conf['alipay_api'] == 3) {
        echo "<script>window.location.href='./submit/msubmit.php?trade_no={$trade_no}&type={$type}&name={$row['name']}&money={$row['money']}&sitename={$sitename}';</script>";
    } elseif ($conf['alipay_api'] == 2) {
        echo "<script>window.location.href='./submit/epay/epay.php?trade_no={$trade_no}&type={$type}&name={$row['name']}&money={$row['money']}&sitename={$sitename}';</script>";
    } elseif ($conf['alipay_api'] == 1) {
        require_once SYSTEM_ROOT . "alipay/alipay.config.php";
        require_once SYSTEM_ROOT . "alipay/alipay_submit.class.php";
        if (checkmobile() == true) {
            $alipay_service = "alipay.wap.create.direct.pay.by.user";
        } else {
            $alipay_service = "create_direct_pay_by_user";
        }
        $parameter = array("service" => $alipay_service, "partner" => trim($alipay_config['partner']), "seller_id" => trim($alipay_config['partner']), "payment_type" => "1", "notify_url" => 'http://' . $conf['local_domain'] . '/submit/alipay/alipay_notify.php', "return_url" => 'http://' . $_SERVER['HTTP_HOST'] . '/submit/alipay/alipay_return.php', "out_trade_no" => $trade_no, "subject" => $row['name'], "total_fee" => $row['money'], "_input_charset" => strtolower('utf-8'));
        if (checkmobile() == true) {
            $parameter['app_pay'] = "Y";
        }
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "正在跳转");
        echo $html_text;
    } else {
        exit("本站还未配置有效的接口！");
    }
} elseif ($type == 'wxpay') {
    if ($userrow['wxpay']==2) {
        sysmsg("商户微信支付功能被关闭，无法正常支付，请选择其他支付方式！");
    }
    if ($conf['wxpay_api'] == 4){
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            echo "<script>window.location.href='./submit/eshanghu/eshanghujspay.php?trade_no={$trade_no}&d=1';</script>";
        } elseif (checkmobile() == true) {
            echo "<script>window.location.href='./submit/eshanghu/eshanghuapppay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
        } else {
            echo "<script>window.location.href='./submit/eshanghu/eshanghu.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
        }
    }
    if ($conf['wxpay_api'] == 0) {
        exit($conf['wx_close_info']);
    } elseif ($conf['wxpay_api'] == 3) {
        echo "<script>window.location.href='./submit/msubmit.php?trade_no={$trade_no}&type={$type}&name={$row['name']}&money={$row['money']}&sitename={$sitename}';</script>";
    } elseif ($conf['wxpay_api'] == 2) {
        echo "<script>window.location.href='./submit/epay/epay.php?trade_no={$trade_no}&type={$type}&name={$row['name']}&money={$row['money']}&sitename={$sitename}';</script>";
    } elseif ($conf['wxpay_api'] == 1) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            echo "<script>window.location.href='./submit/wxpay/wxjspay.php?trade_no={$trade_no}&d=1';</script>";
        } elseif (checkmobile() == true) {
        if($conf['h5_open']==1){
          echo "<script>window.location.href='./submit/wxpay/wxwappay2.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
        } else{
            echo "<script>window.location.href='./submit/wxpay/wxwappay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
			}
        } else {
            echo "<script>window.location.href='./submit/wxpay/wxpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
        }
    }
} elseif ($type == 'qqpay') {
    if ($userrow['qqpay']==2) {
        sysmsg("商户QQ支付功能被关闭，无法正常支付，请选择其他支付方式！");
    }
    if ($conf['qqpay_api'] == 0) {
        exit($conf['qq_close_info']);
    } elseif ($conf['qqpay_api'] == 3) {
        echo "<script>window.location.href='./submit/codepay/msubmit.php?trade_no={$trade_no}&type={$type}&name={$row['name']}&money={$row['money']}&sitename={$sitename}';</script>";
    } elseif ($conf['qqpay_api'] == 2) {
        echo "<script>window.location.href='./submit/epay/epay.php?trade_no={$trade_no}&type={$type}&name={$row['name']}&money={$row['money']}&sitename={$sitename}';</script>";
    } elseif ($conf['qqpay_api'] == 1) {
        echo "<script>window.location.href='./submit/qqpay/qqpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
    }
} elseif ($type == 'tenpay') {
    if ($userrow['tenpay']==2) {
        sysmsg("商户财付通支付功能被关闭，无法正常支付，请选择其他支付方式！");
    }
    if ($conf['tenpay_api'] == 0) {
        exit($conf['ten_close_info']);
    } elseif ($conf['tenpay_api'] == 3) {
        echo "<script>window.location.href='./submit/codepay/msubmit.php?trade_no={$trade_no}&type={$type}&name={$row['name']}&money={$row['money']}}&sitename={$sitename}';</script>";
    } elseif ($conf['tenpay_api'] == 2) {
        echo "<script>window.location.href='./submit/epay/epay.php?trade_no={$trade_no}&type={$type}&name={$row['name']}&money={$row['money']}&sitename={$sitename}';</script>";
    } elseif ($conf['tenpay_api'] == 1) {
	require_once(SYSTEM_ROOT."tenpay/tenpay.config.php");
	require_once(SYSTEM_ROOT."tenpay/RequestHandler.class.php");

    $name=$row['name'];
    //$name = 'Opao-'.time();

	/* 创建支付请求对象 */
	$reqHandler = new RequestHandler();
	$reqHandler->init();
	$reqHandler->setKey($tenpay_config['key']);
	$reqHandler->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");

	//----------------------------------------
	//设置支付参数 
	//----------------------------------------
	$reqHandler->setParameter("partner", trim($tenpay_config['mch']));
	$reqHandler->setParameter("out_trade_no", $trade_no);
	$reqHandler->setParameter("total_fee", $money*100);  //总金额
	$reqHandler->setParameter("return_url", 'http://'.$_SERVER['HTTP_HOST'].'/submit/qqpay/tenpay_return.php');
	$reqHandler->setParameter("notify_url", 'http://'.$conf['local_domain'].'/submit/qqpay/tenpay_notify.php');
	$reqHandler->setParameter("body", $name);
	$reqHandler->setParameter("bank_type", "DEFAULT");  	  //银行类型，默认为财付通
	$reqHandler->setParameter("spbill_create_ip", $clientip);//客户端IP
	$reqHandler->setParameter("fee_type", "1");               //币种
	$reqHandler->setParameter("subject",$name);          //商品名称，（中介交易时必填）
	//系统可选参数
	$reqHandler->setParameter("sign_type", "MD5");  	 	  //签名方式，默认为MD5，可选RSA
	$reqHandler->setParameter("service_version", "1.0"); 	  //接口版本号
	$reqHandler->setParameter("input_charset", "utf-8");   	  //字符集
	$reqHandler->setParameter("sign_key_index", "1");    	  //密钥序号

	//请求的URL
	$reqUrl = $reqHandler->getRequestURL();

	echo '<script>open_without_referrer("'.$reqUrl.'");</script>';

   }
} else {
    echo "<script>window.location.href='./submit/default.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
}
?>
<p>正在为您跳转到支付页面，请稍候...</p>
</body>
</html>