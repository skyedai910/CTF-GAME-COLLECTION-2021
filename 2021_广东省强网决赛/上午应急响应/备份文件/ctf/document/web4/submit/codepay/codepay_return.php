<?php 
define('SYSTEM_ROOT_E', dirname(CAEFEBDAEDD) . '/');
require '../../includes/common.php';
function showalert($msg, $status, $orderid = null)
{
    global $ereturn;
    echo '<meta charset="utf-8"/><script>window.location.href="' . $ereturn . $orderid . '";</script>';
}
$_POST = $_GET;
ksort($_POST);
reset($_POST);
$sign = '';
foreach ($_POST as $key => $val) {
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
$type = isset($_POST['type']) ? $_POST['type'] : exit('No type!');
if ($type == '1') {
    $typepay = "alipay";
    $ua = "mzf";
} elseif ($type == '2') {
    $type = "qqpay";
    $ua = "mzf";
}  elseif ($type == '3') {
    $type = "wxpay";
    $ua = "mzf";
} else {
    $type = "tenpay";
    $ua = "mzf";
}
if (!$_POST['pay_no'] || md5($sign . $conf[$ua . '_key']) != $_POST['sign']) {
    exit("订单验证失败！");
} else {
    $trade_no = $_POST['trade_no'];
    $out_trade_no = $_POST['param'];
    $money = $_POST['money'];
    $trade_status = $_POST['status'];
    $srow = $DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
    if ($srow) {
        $url = creat_callback($srow);
        if ($srow['status'] == 0) {
            $DB->query("update `pay_order` set `status` ='1',`endtime` ='{$date}',`buyer` ='{$buyer_email}' where `trade_no`='{$out_trade_no}'");
            processOrder($srow);
            echo '<script>window.location.href="' . $url['return'] . '";</script>';
        } else {
            echo '<script>window.location.href="' . $url['return'] . '";</script>';
        }
    } else {
        echo "订单记录获取验证失败！";
    }
}
?>