<?php
/**
 * 功能：DIY云端创建订单 (需具有一定的开发能力 适用于前端开发)
 * 版本：1.0
 * 修改日期：2016-12-11
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究接口使用，只是提供一个参考。
 * ============================
 *
 * 云端接口URL：http://codepay.fateqq.com:52888/creat_order/
 * 注意：仅支持GET传参。
 * 创建订单提交参数：
 * ============================
 * POST参数：不支持。请使用GET参数
 * ============================
 *
 * ============================
 * GET参数：
 *
 * id：码支付平台ID
 * type:   支付方式  1：支付宝  2：QQ钱包或财付通   3微信   目前仅接受：1 2 3
 * price： 商品原始价格 精确到2位小数
 * pay_id：网站唯一标识如网站订单号,用户ID,用户名(尽量传递英文跟数字 遇编码困扰无法解决 万能解决方法使用base64或urlencode加密后发送 通知地址需解密)
 * param： 自定义参数 可留空 (如1|2|3 用于区分游戏分区或用户 尽量避免带特殊字符 中文需要确认编码无误)
 * act:    免挂机模式 支持参数 1或0  1为启用  该功能需要另行开通才能使用未开通传递0
 * call：  需要返回给哪个javascript函数使用 为空将返回json为高级模式使用
 * chart： 编码 支持参数 utf-8 gbk gb2312 1 默认UTF-8 非utf-8编码请确认调试无误 我们兼容GBK 但如有问题请反馈我们更新
 * sign:   自动生成不需要自定义 数据签名防止别人恶意提交订单导致您的订单创建失败
 * ============================
 *
 *
 * ============================
 * 功能：创建订单后从云服务器智能选择一个二维码。 只有通过云端创建订单 才能实现自动充值
 * 返回示例：{"msg":"ok","qrcode":"//codepay.fateqq.com:52888/qr/1/2/1/0.png","status":0,"chart":"utf-8","pay_id":"888888888","type":2,"price":111,"money":"111.00","userID":1,"tag":0,"serverTime":1481453112,"endTime":1481453412}
 *
 * 解释返回参数：
 * -----------------------------------------------
 * status： 0：创建成功 -2：参数错误，-1：创建失败
 * (status 为-1 一般是由于您的金额范围限制导致返回-1 非支付宝支付返回非0都将无法充值成功 可软件端调整允许范围为少1元 多0元)
 * msg：   返回的错误或成功信息  可能返回 ok|too long|not vip|sign fail|creat fail|undefined|qrcode too little
 * money： 云服务器智能选择一个有效的金额返回 这是真实支付的金额 价格范围为您云端设置的允许范围
 * tag：   支付宝的备注。0-10或您传递的pay_id  非支付宝支付完全可无视
 * order_id：云端订单号用于检索订单状态。
 * notiry_key：云端通知服务器密钥 云端随机生成 用于支付完成后同步通知支付客户。
 * serverTime：服务器上的时间戳 (用于准确的核对超时时间)
 * endTime： 二维码过期时间戳 status非0此参数返回0 或不返回
 * type:   支付方式  支付宝: 1  QQ钱包或财付通：2 微信：3
 * pay_id：您传递的网站的唯一标识作为充值的标识 如您网站创建的订单号，用户ID，用户名
 * qrcode: 二维码支付地址  如status非0 返回您的自定义金额转账的二维码或者严重错误返回无二维码。
 *-------------------------------------------------
 */
if (empty($parameter)) exit('不支持直接访问 表单请提交至codepay.php');

$parameter["call"] = "callback"; //回调的Javascript函数
$codepaySubmit = new CodepaySubmit($codepay_config);
$codepay_json_url = getApiHost() . "creat_order/?";
$codepay_json_url .= $codepaySubmit->buildRequestParaToString($parameter);

if (empty($type)) $type = (int)$_GET["type"];
if (empty($type)) $type = 1;
$typeName = getTypeName($type);
if ((int)$codepay_config["outTime"] < 60) $codepay_config["outTime"] = 360;
$subject = ''; //商品名 如 会员账号：张三 充值100元 该模式可自行开发
$user_data = array("subject" => $subject, "return_url" => $codepay_config["return_url"],
    "type" => $type, "outTime" => $codepay_config["outTime"], "codepay_id" => $codepay_config["id"]);

//如果开启了本地二维码 则使用本地的二维码。(只有软件版才有用 将二维码根据规则放到qr目录)
$user_data["qrcode_url"] = !empty($codepay_config["qrcode_url"]) && (int)$codepay_config["act"] <= 0 ? $codepay_config["qrcode_url"] : '';

//中间那log 默认为10秒后隐藏
//改为自己的替换img目录下的use_开头的图片 你要保证你的二维码遮挡不会影响扫码
//二容错率决定你能遮挡多少部分维码
$user_data["logShowTime"]=1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $codepay_config['chart'] ?>">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo $typeName ?>扫码支付 - O泡易支付系统</title>
    <link href="./css/wechat_pay.css" rel="stylesheet" media="screen">

</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-<?php echo $type ?>"></span>
    </h1>

    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="money">￥<?php echo $price ?></div>
        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
            <div data-role="qrPayImg" class="qrcode-img-area">
                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">加载中</div>
                <div style="position: relative;display: inline-block;">
                    <img id='show_qrcode' alt="加载中..." src="" width="210" height="210" style="display: block;">
                    <img onclick="$('#use').hide()" id="use" src="./img/use_<?php echo $type ?>.png"
                         style="position: absolute;top: 50%;left: 50%;width:32px;height:32px;margin-left: -16px;margin-top: -16px">
                </div>
            </div>


        </div>
        <div class="time-item" id="msg">
            <h1>二维码过期时间</h1>
            <strong id="hour_show">0时</strong>
            <strong id="minute_show">0分</strong>
            <strong id="second_show">0秒</strong>
        </div>

        <div class="tip">
            <div class="ico-scan"></div>
            <div class="tip-text">
                <p>请使用<?php echo $typeName ?>扫一扫</p>
                <p>扫描二维码完成支付</p>
            </div>
        </div>

        <div class="detail" id="orderDetail">
            <dl class="detail-ct" id="desc" style="display: none;">

                <dt>状态</dt>
                <dd id="createTime">订单创建</dd>

            </dl>
            <a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
        </div>

        <div class="tip-text">
        </div>


    </div>
    <div class="foot">
        <div class="inner">
            <p>手机用户可保存上方二维码到手机中</p>
            <p>在<?php echo $typeName ?>扫一扫中选择“相册”即可</p>
        </div>
    </div>

</div>

<!--注意下面加载顺序 顺序错乱会影响业务-->
<script src="./js/jquery-1.10.2.min.js"></script>
<!--[if lt IE 8]>
<script src="./js/json3.min.js"></script>
<![endif]-->
<script>
    var user_data =<?php echo json_encode($user_data);?>;
</script>
<script src="./js/notify.js"></script>
<script src="./js/codepay_util.js"></script>
<script src="<?php echo $codepay_json_url ?>"></script>
<script>
    setTimeout(function () {
        $('#use').hide()
    },user_data.logShowTime||10000)
</script>
</body>
</html>