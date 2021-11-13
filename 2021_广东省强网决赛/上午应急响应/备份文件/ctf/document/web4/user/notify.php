<?php 
require_once('../includes/common.php');
$alipay_config['partner'] = $conf['reg_pid'];
$alipay_config['key'] = $DB->query("SELECT `key` FROM `pay_user` WHERE `id`='{$conf['reg_pid']}' limit 1")->fetchColumn();
require_once("./epay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
  //商户订单号
  $out_trade_no = $_GET['out_trade_no'];

  //支付宝交易号
  $trade_no = $_GET['trade_no'];

  //交易状态
  $trade_status = $_GET['trade_status'];

    if ($_GET['trade_status'] == 'TRADE_SUCCESS' && $srow['status']==0) {
    //付款完成后，系统发送该交易状态通知
    $srow=$DB->query("SELECT * FROM pay_regcode WHERE trade_no='{$trade_no}' limit 1")->fetch();
    $array = explode('|',$srow['data']);
    $type = addslashes($array[0]);
    $account = addslashes($array[1]);
    $username = addslashes($array[2]);
    $url = addslashes($array[3]);
    $tid = addslashes($array[5]);
    if($srow['type']==1){
      $phone = addslashes($srow['email']);
      $email = addslashes($array[4]);
    }else{
      $email = addslashes($srow['email']);
    }
    if($srow['status']==0){
    $DB->exec("update `pay_regcode` set `status` ='1' where `id`='{$srow['id']}'");
    $key = random(32);
    $sds=$DB->exec("INSERT INTO `pay_user` (`key`, `account`, `username`, `money`, `url`, `email`, `phone`, `addtime`, `type`, `active`) VALUES ('{$key}', '{$account}', '{$username}', '0', '{$url}', '{$email}', '{$phone}', '{$date}', '1', '1')");
    $pid=$DB->lastInsertId();
      if($sds){
        if(!empty($tid)){
          $sj=$conf['price'];
          $abc=$DB->exec("UPDATE `pay_user` SET `money`=money+'{$sj}',`price`=price+'{$sj}' WHERE `id`='$tid'");
          $abc1=$DB->exec("UPDATE `pay_user` SET `tgrs`=tgrs+'1' WHERE `id`='$tid'");
        }
        $scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
        $sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
        $siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';
        $sub = $conf['web_name'].' - 注册成功通知';
        $msg = '<h2>商户注册成功通知</h2>感谢您注册'.$conf['web_name'].'！<br/>您的商户ID：'.$pid.'<br/>您的商户秘钥：'.$key.'<br/>'.$conf['web_name'].'官网：<a href="http://'.$_SERVER['HTTP_HOST'].'/" target="_blank">'.$_SERVER['HTTP_HOST'].'</a><br/>【<a href="'.$siteurl.'" target="_blank">商户管理后台</a>】';
        $result = send_mail($email, $sub, $msg);
      }
    }
    }

  echo "success";
}
else {
    //验证失败
    echo "fail";
}

?>