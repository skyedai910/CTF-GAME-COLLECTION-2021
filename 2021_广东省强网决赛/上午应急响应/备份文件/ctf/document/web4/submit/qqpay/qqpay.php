<?php
$is_defend=true;
require '../../includes/common.php';

@header('Content-Type: text/html; charset=UTF-8');

$trade_no=daddslashes($_GET['trade_no']);
$sitename=base64_decode(daddslashes($_GET['sitename']));
$row=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if(!$row)sysmsg('该订单号不存在，请返回来源地重新发起请求！');

if(isset($_GET['type']))$DB->query("update `pay_order` set `type` ='qqpay',`addtime` ='$date' where `trade_no`='$trade_no'");

$name=$row['name'];
//$name = 'Opao-'.time();

require_once (SYSTEM_ROOT.'qqpay/qpayMchAPI.class.php');

//入参
$params = array();
$params["out_trade_no"] = $trade_no;
$params["body"] = $name;
$params["fee_type"] = "CNY";
$params["notify_url"] = 'http://'.$conf['local_domain'].'/submit/qqpay/qqpay_notify.php';
$params["spbill_create_ip"] = $clientip;
$params["total_fee"] = $row['money']*100;
$params["trade_type"] = "NATIVE";

//api调用
$qpayApi = new QpayMchAPI('https://qpay.qq.com/cgi-bin/pay/qpay_unified_order.cgi', null, 10);
$ret = $qpayApi->reqQpay($params);
$result = QpayMchUtil::xmlToArray($ret);
//print_r($arr);

if($result['return_code']=='SUCCESS' && $result['result_code']=='SUCCESS'){
	$code_url = 'https://myun.tenpay.com/mqq/pay/qrcode.html?_wv=1027&_bid=2183&t='.$result['prepay_id'];
}else{
	sysmsg('QQ钱包支付下单失败！['.$result['err_code'].']'.$result['err_code_desc']);
}
/* 
if($result['return_code']=='SUCCESS' && $result['result_code']=='SUCCESS'){
	$code_url = $result['code_url'];
}else{
	sysmsg('QQ钱包支付失败！['.$result['err_code'].']'.$result['err_code_desc']);
} 
*/
if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/')!==false){
	exit("<script>window.location.href='{$code_url}';</script>");
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="zh-cn">
<meta name="renderer" content="webkit">
<title>QQ钱包安全支付 - <?php echo $sitename?></title>
<link href="/assets/pay/css/mqq_pay.css?v=1" rel="stylesheet" media="screen">
</head>
<body>
<div class="body">
<h1 class="mod-title">
<span class="ico-wechat"></span><span class="text">QQ钱包支付</span>
</h1>
<div class="mod-ct">
<div class="order">
</div>
<div class="amount">￥<?php echo $row['money']?></div>
<div class="qr-image" id="qrcode">
</div>
 
<div class="detail" id="orderDetail">
<dl class="detail-ct" style="display: none;">
<dt>商家</dt>
<dd id="storeName"><?php echo $sitename?></dd>
<dt>购买物品</dt>
<dd id="productName"><?php echo $row['name']?></dd>
<dt>商户订单号</dt>
<dd id="billId"><?php echo $row['trade_no']?></dd>
<dt>创建时间</dt>
<dd id="createTime"><?php echo $row['addtime']?></dd>
</dl>
<a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
</div>
<div class="tip">
<span class="dec dec-left"></span>
<span class="dec dec-right"></span>
<div class="ico-scan"></div>
<div class="tip-text">
<p>请使用手机QQ扫一扫</p>
<p>扫描二维码完成支付</p>
</div>
</div>
<div class="tip-text">
</div>
</div>
<div class="foot">
<div class="inner">
<p>手机用户可保存上方二维码到手机中</p>
<p>在手机QQ扫一扫中选择“相册”即可</p>
</div>
</div>
</div>
<script src="/assets/pay/js/qrcode.min.js"></script>
<script src="/assets/pay/js/qcloud_util.js"></script>
<script src="/assets/layer/layer.js"></script>
<script>
	var isSafari = navigator.userAgent.indexOf("Safari") > -1;
    var code_url = '<?php echo $code_url?>';
    var qrcode = new QRCode("qrcode", {
        text: code_url,
        width: 230,
        height: 230,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    var	tencentSeries = 'mqqapi://forward/url?src_type=web&style=default&=1&version=1&url_prefix='+window.btoa(code_url);
	if(isSafari){
		location.href = tencentSeries;
	}
	else{
		var iframe = document.createElement("iframe");
        iframe.style.display = "none";
        iframe.src = tencentSeries;
        document.body.appendChild(iframe);
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
            data: {type: "qqpay", trade_no: "<?php echo $row['trade_no']?>"}, //post数据
            success: function (data, textStatus) {
                //从服务器得到数据，显示数据并继续查询
                if (data.code == 1) {
					layer.msg('支付成功，正在跳转中...', {icon: 16,shade: 0.01,time: 15000});
					setTimeout(window.location.href=data.backurl, 1000);
                }else{
                    setTimeout("loadmsg()", 4000);
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
    window.onload = loadmsg();
</script>
</body>
</html>