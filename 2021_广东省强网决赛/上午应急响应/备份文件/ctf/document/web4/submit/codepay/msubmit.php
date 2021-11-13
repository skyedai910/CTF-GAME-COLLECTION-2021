<?php
define('SYSTEM_ROOT_E', dirname(BEAEBCBDEE) . '/');
require '../../includes/common.php';
@header('Content-Type: text/html; charset=UTF-8');
$type = isset($_GET['type']) ? $_GET['type'] : exit('No type!');
if ($type == 'alipay') {
    $type = 1;
    $ua = "mzf";
} elseif ($type == 'qqpay') {
    $type = 2;
    $ua = "mzf";
} elseif ($type == 'wxpay') {
    $type = 3;
    $ua = "mzf";
} else {
    $type = 4;
    $ua = "mzf";
}
$trade_no = daddslashes($_GET['trade_no']);
$row = $DB->query("SELECT * FROM pay_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if (!$row) {
    exit('该订单号不存在，请返回来源地重新发起请求！');
}
date_default_timezone_set('PRC');
$codepay_config['id'] = $conf[$ua . '_id'];
$codepay_config['key'] = $conf[$ua . '_key'];
$codepay_config['chart'] = strtolower('utf-8');
$codepay_config['act'] = "0";
function isHTTPS()
{
    if (defined('HTTPS') && HTTPS) {
        return true;
    }
    if (!isset($_SERVER)) {
        return FALSE;
    }
    if (!isset($_SERVER['HTTPS'])) {
        return FALSE;
    }
    if ($_SERVER['HTTPS'] === 1) {
        return TRUE;
    } elseif ($_SERVER['HTTPS'] === 'on') {
        return TRUE;
    } elseif ($_SERVER['SERVER_PORT'] == 443) {
        return TRUE;
    }
    return FALSE;
}
$codepay_config['domain'] = (isHTTPS() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
$codepay_config['path'] = $codepay_config['domain'] . dirname($_SERVER['REQUEST_URI']);
if ((int) $codepay_config['id'] < 1) {
    exit('请先到后台配置ID跟密钥');
}
$codepay_config['page'] = 4;
$codepay_config['style'] = 1;
$codepay_config['outTime'] = 180;
$codepay_config['min'] = 0.01;
$codepay_config['return_url'] = $codepay_config['path'] . '/codepay_return.php';
$codepay_config['notify_url'] = $codepay_config['path'] . '/codepay_notify.php';
function getIp()
{
    static $realip;
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            if (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
    }
    return $realip;
}
$pay_id = getIp();
$param = $trade_no;
if ($type <= 0) {
    $type = 3;
}
$price = $row['money'];
if ($conf['qrcode'] == '1') {
    $codepay_config["qrcode_url"] = "../../includes/codepay/qrcode.php";
}
$codepay_config['pay_type'] = 1;
if ($codepay_config['pay_type'] == 1 && $type == 1) {
    $codepay_config["qrcode_url"] = '';
}
$data = array("id" => (int) $codepay_config['id'], "type" => $type, "price" => (double) $price, "pay_id" => $pay_id, "param" => $param, "act" => (int) $codepay_config['act'], "outTime" => (int) $codepay_config['outTime'], "page" => (int) $codepay_config['page'], "return_url" => $codepay_config["return_url"], "notify_url" => $codepay_config["notify_url"], "style" => (int) $codepay_config['style'], "user_ip" => getIp(), "pay_type" => $codepay_config['pay_type'], "qrcode_url" => $codepay_config['qrcode_url'], "chart" => trim(strtolower($codepay_config['chart'])));
function create_link($params, $codepay_key, $host = "")
{
    ksort($params);
    reset($params);
    $sign = '';
    $urls = '';
    foreach ($params as $key => $val) {
        if ($val == '') {
            continue;
        }
        if ($key != 'sign') {
            if ($sign != '') {
                $sign .= "&";
                $urls .= "&";
            }
            $sign .= "{$key}={$val}";
            $urls .= "{$key}=" . urlencode($val);
        }
    }
    $key = md5($sign . $codepay_key);
    $query = $urls . '&sign=' . $key;
    $apiHost = $host ? $host : "https://codepay.fateqq.com/creat_order/?";
    $url = $apiHost . $query;
    return array("url" => $url, "query" => $query, "sign" => $sign, "param" => $urls);
}
$back = create_link($data, $codepay_config['key']);
switch ((int) $type) {
    case 1:
        $typeName = '支付宝';
        break;
    case 2:
        $typeName = 'QQ';
        break;
    default:
        $typeName = '微信';
}
$user_data = array("return_url" => $codepay_config["return_url"], "type" => $type, "outTime" => $codepay_config["outTime"], "codePay_id" => $codepay_config["id"]);
$user_data["qrcode_url"] = $codepay_config["qrcode_url"];
$user_data["logShowTime"] = 1;
if (function_exists('file_get_contents')) {
    $codepay_json = file_get_contents($back['url']);
} else {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $back['url']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $codepay_json = curl_exec($ch);
    curl_close($ch);
}
if (empty($codepay_json)) {
    $data['call'] = "callback";
    $data['page'] = "3";
    $back = create_link($data, $codepay_config['key']);
    $codepay_html = '<script src="' . $back['url'] . '"></script>';
} else {
    $codepay_data = json_decode($codepay_json);
    $qr = $codepay_data ? $codepay_data->qrcode : '';
    $codepay_html = "<script>callback({$codepay_json})</script>";
}
if (!is_dir('../../includes/codepay')) {
    $codepay_path = "https://codepay.fateqq.com";
} else {
    $codepay_path = "../../includes/codepay";
}
?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $codepay_config['chart'];?>">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo $typeName;?>扫码支付 - <?php echo $conf['web_name']?></title>
    <link href="<?php echo $codepay_path;?>/css/wechat_pay.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-<?php echo $type;?>"></span>
    </h1>
	
    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="money">￥<?php echo $price;?></div>
        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
            <div data-role="qrPayImg" class="qrcode-img-area">
                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">点击重新加载</div>
                <div style="position: relative;display: inline-block;">
                    <img id='show_qrcode' alt="加载中..." src="<?php echo $qr;?>" width="210" height="210" style="display: block;">
                    <img onclick="$('#use').hide()" id="use" src="<?php echo $codepay_path;?>/img/use_<?php echo $type;?>.png" style="position: absolute;top: 50%;left: 50%;width:32px;height:32px;margin-left: -21px;margin-top: -21px">
                </div>
            </div>
        </div>
        <div class="time-item" id="msg">
            <h1>二维码过期时间</h1>
            <strong id="hour_show">0时</strong>
            <strong id="minute_show">0分</strong>
            <strong id="second_show">0秒</strong>
            <br><br><font color="red">请付款时与提示金额相同 否则无法充值成功<br></font>
        </div>

        <div class="tip">
            <div class="ico-scan"></div>
            <div class="tip-text">
                <p>请使用<?php echo $typeName;?>扫一扫</p>
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
            <p>在<?php echo $typeName;?>扫一扫中选择“相册”即可</p>
        </div>
    </div>
</div>

<!--注意下面加载顺序 顺序错乱会影响业务-->
<script src="<?php echo $codepay_path;?>/js/jquery-1.10.2.min.js"></script>
<!--[if lt IE 8]>
<script src="<?php echo $codepay_path;?>/js/json3.min.js"></script><![endif]-->
<script>
    var user_data =<?php echo json_encode($user_data);?>
</script>
<script src="<?php echo $codepay_path;?>/js/notify.js"></script>
<script src="<?php echo $codepay_path;?>/js/codepay_util.js"></script>
<?php 
echo $codepay_html;
?>
<script>
    setTimeout(function () {
        $('#use').hide()
    }, user_data.logShowTime || 10000)
</script>
</body>
</html>