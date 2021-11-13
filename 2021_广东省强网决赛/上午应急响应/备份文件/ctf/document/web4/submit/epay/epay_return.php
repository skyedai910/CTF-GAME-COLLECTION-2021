<?php
/* * 
 * 功能：O泡易支付页面跳转同步通知页面
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见epay_notify_class.php中的函数verifyReturn
 */
require_once('../../includes/common.php');
require_once(SYSTEM_ROOT."alipay/alipay.config.php");
require_once(SYSTEM_ROOT."epay/epay_notify.class.php");

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//支付方式
$type = $_GET['type'];

   if($type == "alipay"){
            $ua = "ali";
        }elseif($type == "wxpay"){
             $ua = "wx";
        }elseif($type == "qqpay"){
             $ua = "qq";
        }elseif($type == "tenpay"){
             $ua = "ten";
        }
file_put_contents("b.txt", $type);
   //写文件

$alipay_config['partner'] = $conf[$ua.'_epay_api_id'];
$alipay_config['key'] = $conf[$ua.'_epay_api_key'];
$alipay_config['apiurl'] = $conf[$ua.'_epay_api_url'];
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	//商户订单号
	$out_trade_no = $_GET['out_trade_no'];
	//OPay交易号
	$trade_no = $_GET['trade_no'];
	//交易状态
	$trade_status = $_GET['trade_status'];
	
	       $money = $_GET['money'];
        $srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
	        $url=creat_callback($srow);
        if($_GET['trade_status'] == 'TRADE_SUCCESS' and $money==$srow['money']) {
            echo '<script>window.location.href="'.$url['return'].'";</script>';
        }else {
            echo "创宇易支付系统已拦截异常支付";
          }

	echo "验证成功<br />";
}
else {
    //验证失败
    //如要调试，请看notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
<title><?php echo $conf['web_name']?>即时到账交易接口</title>
</head>
</html>
