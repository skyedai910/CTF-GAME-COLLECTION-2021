<?php
require '../../includes/common.php';

@header('Content-Type: text/html; charset=UTF-8');

$trade_no=daddslashes($_GET['trade_no']);
$sitename=base64_decode(daddslashes($_GET['sitename']));
$row=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if(!$row)sysmsg('该订单号不存在，请返回来源地重新发起请求！');

if(isset($_GET['type']))$DB->query("update `pay_order` set `type` ='wxpay',`addtime` ='$date' where `trade_no`='$trade_no'");

require(SYSTEM_ROOT.'eshanghu/Signer.php');
require(SYSTEM_ROOT.'eshanghu/Eshanghu.php');
$pay_config = require(SYSTEM_ROOT.'eshanghu/config.php');

$name=$row['name'];
//$name = 'Opao-'.time();

$pay = new Eshanghu($pay_config);
$result = $pay->create($trade_no, $name, $row['money']*100);

if($result['code'] == "200"){
    $code_url = $result['data']['code_url'];
}else{
    sysmsg('微信支付下单失败 '.$result['message']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="renderer" content="webkit">
    <title>微信安全支付 - <?php echo $sitename?></title>
    <link href="/assets/pay/css/wechat_pay.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico-wechat"></span><span class="text">微信支付</span>
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
                <p>请使用微信扫一扫</p>
                <p>扫描二维码完成支付</p>
            </div>
        </div>
        <div class="tip-text">
        </div>
    </div>
    <div class="foot">
        <div class="inner">
            <p>手机用户可保存上方二维码到手机中</p>
            <p>在微信扫一扫中选择“相册”即可</p>
        </div>
    </div>
</div>
<script src="/assets/pay/js/qrcode.min.js"></script>
<script src="/assets/pay/js/qcloud_util.js"></script>
<script src="/assets/layer/layer.js"></script>
<script>
    var qrcode = new QRCode("qrcode", {
        text: "<?php echo $code_url?>",
        width: 230,
        height: 230,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
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