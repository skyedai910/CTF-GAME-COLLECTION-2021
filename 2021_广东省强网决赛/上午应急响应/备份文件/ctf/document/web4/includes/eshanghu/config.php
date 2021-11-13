<?php
/*易商户支付配置*/
include '../common.php';
return [
    'app_key' => $conf['wx_eshanghu_app_key'], //用户中心开发设置中获取
    'app_secret' => $conf['wx_eshanghu_app_secret'], //用户中心开发设置中获取
    'sub_mch_id' => $conf['wx_eshanghu_sub_mch_id'],  //https://www.1shanghu.com/user/wechat/certification 获取
    'notify' => 'http://'.$_SERVER['HTTP_HOST'].'/submit/eshanghu/eshanghu_notify.php', //回调地址
];
?>