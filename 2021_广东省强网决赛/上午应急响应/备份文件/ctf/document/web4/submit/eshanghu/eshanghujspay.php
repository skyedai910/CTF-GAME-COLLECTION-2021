<?php
require '../../includes/common.php';

/*微信公众号支付
开发步骤：https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=7_3
*/

$trade_no=daddslashes($_GET['trade_no']);

@header('Content-Type: text/html; charset=UTF-8');
$row=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if(!$row)exit('该订单号不存在，请返回来源地重新发起请求！');

if(isset($_GET['type']))$DB->query("update `pay_order` set `type` ='wxpay',`addtime` ='$date' where `trade_no`='$trade_no'");

require(SYSTEM_ROOT.'eshanghu/Signer.php');
require(SYSTEM_ROOT.'eshanghu/Eshanghu.php');
$pay_config = require(SYSTEM_ROOT.'eshanghu/config.php');

$name=$row['name'];
//$name = 'Opao-'.time();

$pay = new Eshanghu($pay_config);

if(!isset($_GET['openid'])){
	$return_url = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/submit/eshanghu/eshanghujspay.php?trade_no='.$trade_no;
	$url = $pay->getOpenidUrl($return_url);
	exit("<script>window.location.replace('{$url}');</script>");
}

$openid = trim($_GET['openid']);
$result = $pay->mp($trade_no, $name, $row['money']*100, $openid);

if($result['code'] == "200"){
	$arr = array('appId'=>$result['data']['jsapi_app_id'], 'timeStamp'=>$result['data']['jsapi_timeStamp'], 'nonceStr'=>$result['data']['jsapi_nonceStr'], 'package'=>$result['data']['jsapi_package'], 'signType'=>$result['data']['jsapi_signType'], 'paySign'=>$result['data']['jsapi_paySign']);
	$jsApiParameters=json_encode($arr);
}else{
	sysmsg('微信支付下单失败 '.$result['message']);
}


if($_GET['d']==1){
	$redirect_url='data.backurl';
}else{
	$redirect_url='\'wap_ok.php\'';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link href="/assets/css/ionic.min.css" rel="stylesheet" />
</head>
<body>
<div class="bar bar-header bar-light" align-title="center">
	<h1 class="title">微信安全支付</h1>
</div>
<div class="has-header" style="padding: 5px;position: absolute;width: 100%;">
<div class="text-center" style="color: #a09ee5;">
<i class="icon ion-information-circled" style="font-size: 80px;"></i><br>
<span>正在跳转...</span>
<script src="/assets/pay/js/qcloud_util.js"></script>
<script src="/assets/layer/layer.js"></script>
<script>
	$(document).on('touchmove',function(e){
		e.preventDefault();
	});
    //调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				if(res.err_msg == "get_brand_wcpay_request:ok" ) {
					loadmsg();
				}
				//WeixinJSBridge.log(res.err_msg);
				//alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
    // 订单详情
    $('#orderDetail .arrow').click(function (event) {
        if ($('#orderDetail').hasClass('detail-open')) {
            $('#orderDetail .detail-ct').slideUp(500, function () {
                $('#orderDetail').removeClass('detail-open');
            });
        } else {
            $('#orderDetail .detail-ct').slideDown(500, function () {
                $('#orderDetail').addClass('detail-open');
            });
        }
    });
    // 检查是否支付完成
    function loadmsg() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "../getshop.php",
            timeout: 10000, //ajax请求超时时间10s
            data: {type: "wxpay", trade_no: "<?php echo $row['trade_no']?>"}, //post数据
            success: function (data, textStatus) {
                //从服务器得到数据，显示数据并继续查询
                if (data.code == 1) {
					layer.msg('支付成功，正在跳转中...', {icon: 16,shade: 0.01,time: 15000});
                    window.location.href=<?php echo $redirect_url?>;
                }else{
                    setTimeout("loadmsg()", 2000);
                }
            },
            //Ajax请求超时，继续查询
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                if (textStatus == "timeout") {
                    setTimeout("loadmsg()", 1000);
                } else { //异常
                    setTimeout("loadmsg()", 4000);
                }
            }
        });
    }
    window.onload = callpay();
</script>
</div>
</div>
</body>
</html>