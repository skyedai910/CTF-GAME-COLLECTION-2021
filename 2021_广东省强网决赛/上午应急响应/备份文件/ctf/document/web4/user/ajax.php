<?php
include("../includes/common.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

@header('Content-Type: application/json; charset=UTF-8');

switch($act){
case 'captcha':
  require_once SYSTEM_ROOT.'class.geetestlib.php';
  $GtSdk = new GeetestLib($conf['CAPTCHA_ID'], $conf['PRIVATE_KEY']);
  $data = array(
    'user_id' => isset($pid)?$pid:'public', # 网站用户id
    'client_type' => "web", # web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
    'ip_address' => $clientip # 请在此处传输用户请求验证时所携带的IP
  );
  $status = $GtSdk->pre_process($data, 1);
  $_SESSION['gtserver'] = $status;
  $_SESSION['user_id'] = isset($pid)?$pid:'public';
  echo $GtSdk->get_response_str();
break;
case 'sendcode':
  $email=trim(daddslashes($_POST['email']));
  if($conf['is_reg']==0)exit('{"code":-1,"msg":"未开放商户申请"}');
  if(isset($_SESSION['send_mail']) && $_SESSION['send_mail']>time()-10){
    exit('{"code":-1,"msg":"请勿频繁发送验证码"}');
  }
  $row=$DB->query("select * from pay_user where email='$email' limit 1")->fetch();
  if($row){
    exit('{"code":-1,"msg":"该邮箱已经注册过商户，如需找回商户信息，请返回登录页面点击找回商户"}');
  }
  $row=$DB->query("select * from pay_regcode where email='$email' order by id desc limit 1")->fetch();
  if($row['time']>time()-60){
    exit('{"code":-1,"msg":"两次发送邮件之间需要相隔60秒！"}');
  }
  $count=$DB->query("select count(*) from pay_regcode where email='$email' and time>'".(time()-3600*24)."'")->fetchColumn();
  if($count>6){
    exit('{"code":-1,"msg":"该邮箱发送次数过多，请更换邮箱！"}');
  }
  $count=$DB->query("select count(*) from pay_regcode where ip='$clientip' and time>'".(time()-3600*24)."'")->fetchColumn();
  if($count>10){
    exit('{"code":-1,"msg":"你今天发送次数过多，已被禁止注册"}');
  }
  $sub = $conf['web_name'].' - 验证码获取';
  $code = rand(1111111,9999999);
  $msg = '您的验证码是：'.$code;
  $result = send_mail($email, $sub, $msg);
  if($result===true){
    if($DB->exec("insert into `pay_regcode` (`type`,`code`,`email`,`time`,`ip`,`status`) values ('0','".$code."','".$email."','".time()."','".$clientip."','0')")){
      $_SESSION['send_mail']=time();
      exit('{"code":0,"msg":"succ"}');
    }else{
      exit('{"code":-1,"msg":"写入数据库失败。'.$DB->errorCode().'"}');
    }
  }else{
    file_put_contents('mail.log',$result);
    exit('{"code":-1,"msg":"邮件发送失败"}');
  }
break;
case 'sendsms':
  $phone=trim(daddslashes($_POST['phone']));
  if($conf['is_reg']==0)exit('{"code":-1,"msg":"未开放商户申请"}');
  if(isset($_SESSION['send_mail']) && $_SESSION['send_mail']>time()-10){
    exit('{"code":-1,"msg":"请勿频繁发送验证码"}');
  }
  require_once SYSTEM_ROOT.'class.geetestlib.php';
  $GtSdk = new GeetestLib($conf['CAPTCHA_ID'], $conf['PRIVATE_KEY']);

  $data = array(
    'user_id' => 'public', # 网站用户id
    'client_type' => "web", # web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
    'ip_address' => $clientip # 请在此处传输用户请求验证时所携带的IP
  );

  if ($_SESSION['gtserver'] == 1) {   //服务器正常
    $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
    if ($result) {
      //echo '{"status":"success"}';
    } else{
      exit('{"code":-1,"msg":"验证失败，请重新验证"}');
    }
  }else{  //服务器宕机,走failback模式
    if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
      //echo '{"status":"success"}';
    }else{
      exit('{"code":-1,"msg":"验证失败，请重新验证"}');
    }
  }
  $row=$DB->query("select * from pay_user where phone='$phone' limit 1")->fetch();
  if($row){
    exit('{"code":-1,"msg":"该手机号已经注册过商户，如需找回商户信息，请返回登录页面点击找回商户"}');
  }
  $row=$DB->query("select * from pay_regcode where email='$phone' order by id desc limit 1")->fetch();
  if($row['time']>time()-60){
    exit('{"code":-1,"msg":"两次发送短信之间需要相隔60秒！"}');
  }
  $count=$DB->query("select count(*) from pay_regcode where email='$phone' and time>'".(time()-3600*24)."'")->fetchColumn();
  if($count>2){
    exit('{"code":-1,"msg":"该手机号码发送次数过多，请更换号码！"}');
  }
  $count=$DB->query("select count(*) from pay_regcode where ip='$clientip' and time>'".(time()-3600*24)."'")->fetchColumn();
  if($count>5){
    exit('{"code":-1,"msg":"你今天发送次数过多，已被禁止注册"}');
  }
  $code = rand(111111,999999);
  $result = send_sms($phone, $code);
  if($result===true){
    if($DB->exec("insert into `pay_regcode` (`type`,`code`,`email`,`time`,`ip`,`status`) values ('1','".$code."','".$phone."','".time()."','".$clientip."','0')")){
      $_SESSION['send_mail']=time();
      exit('{"code":0,"msg":"succ"}');
    }else{
      exit('{"code":-1,"msg":"写入数据库失败。'.$DB->errorCode().'"}');
    }
  }else{
    exit('{"code":-1,"msg":"短信发送失败 '.$result.'"}');
  }
break;
case 'reg':
  $type=intval($_POST['type']);
  $account=trim(strip_tags(daddslashes($_POST['account'])));
  $username=trim(strip_tags(daddslashes($_POST['username'])));
  $url=trim(strip_tags(daddslashes($_POST['url'])));
  $email=trim(strip_tags(daddslashes($_POST['email'])));
  $phone=trim(strip_tags(daddslashes($_POST['phone'])));
  $code=trim(strip_tags(daddslashes($_POST['code'])));
  $tid=trim(strip_tags(daddslashes($_POST['tid'])));
  if($conf['is_reg']==0)exit('{"code":-1,"msg":"未开放商户申请"}');
  if(isset($_SESSION['reg_submit']) && $_SESSION['reg_submit']>time()-600){
    exit('{"code":-1,"msg":"请勿频繁注册"}');
  } 
    if (!empty($tid)) {
      $row=$DB->query("select * from pay_user where id='$tid' limit 1")->fetch();
      if (!$row) {
        exit('{"code":-1,"msg":"邀请人商户ID不存在！"}');
      }else{
        $tid_n = $tid;
      }
    }
    
  if($conf['verifytype']==1){
    $row=$DB->query("select * from pay_user where phone='$phone' limit 1")->fetch();
    if($row){
      exit('{"code":-1,"msg":"该手机号已经注册过商户，如需找回商户信息，请返回登录页面点击找回商户"}');
    }
  }
  $row=$DB->query("select * from pay_user where email='$email' limit 1")->fetch();
  if($row){
    exit('{"code":-1,"msg":"该邮箱已经注册过商户，如需找回商户信息，请返回登录页面点击找回商户"}');
  }
  $row=$DB->query("select * from pay_user where account='$account' limit 1")->fetch();
  if($row){
    exit('{"code":-1,"msg":"当前结算账号对应商户已存在，如需找回商户信息，请返回登录页面点击找回商户"}');
  }
  if($type==1 && strlen($account)!=11 && strpos($account,'@')==false){
    exit('{"code":-1,"msg":"请填写正确的支付宝账号！"}');
  }
  if($type==2 && strlen($account)<3){
    exit('{"code":-1,"msg":"请填写正确的微信'.$$username[$url].'"}');
  }
  if(strlen($url)<4 || strpos($url,'.')==false){
    exit('{"code":-1,"msg":"请填写正确的网站域名！"}');
  }
  if($conf['verifytype']==0 && !preg_match('/^[A-z0-9._-]+@[A-z0-9._-]+\.[A-z0-9._-]+$/', $email)){
    exit('{"code":-1,"msg":"邮箱格式不正确"}');
  }
  if($conf['verifytype']==1){
    $row=$DB->query("select * from pay_regcode where type=1 and code='$code' and email='$phone' order by id desc limit 1")->fetch();
  }else{
    $row=$DB->query("select * from pay_regcode where type=0 and code='$code' and email='$email' order by id desc limit 1")->fetch();
  }
  if(!$row){
    exit('{"code":-1,"msg":"验证码不正确！"}');
  }
  if($row['time']<time()-3600 || $row['status']>0){
    exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
  }
  $scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
  $sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
  $siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';
  if($conf['is_payreg']==1){
    $notify_url = $siteurl.'notify.php';
    $return_url = $siteurl.'regok.php';
    $trade_no=date("YmdHis").rand(11111,99999);
    $out_trade_no=date("YmdHis").rand(111,999);
    $domain=getdomain($notify_url);
    if(!$DB->query("insert into `pay_order` (`trade_no`,`out_trade_no`,`notify_url`,`return_url`,`type`,`pid`,`addtime`,`name`,`money`,`domain`,`ip`,`status`) values ('".$trade_no."','".$out_trade_no."','".$notify_url."','".$return_url."','no','".$conf['reg_pid']."','".$date."','商户申请','".$conf['reg_price']."','".$domain."','".$clientip."','0')"))exit('{"code":-1,"msg":"创建订单失败，请返回重试！"}');

    $data = $type.'|'.$account.'|'.$username.'|'.$url.'|'.$email.'|'.$tid_n.'|'.$clientip;
    $sds=$DB->exec("UPDATE `pay_regcode` SET `trade_no`='$trade_no',`data`='$data' WHERE `id`='{$row['id']}'");
    if($sds){
      exit('{"code":2,"msg":"订单创建成功！","trade_no":"'.$trade_no.'","need":"'.$conf['reg_price'].'"}');
    }else{
      exit('{"code":-1,"msg":"订单创建失败！'.$DB->errorCode().'"}');
    }
  }else{
    $key = random(32); 
    $sds=$DB->exec("INSERT INTO `pay_user` (`key`, `account`, `username`, `money`, `url`, `email`, `phone`, `addtime`, `type`, `active`) VALUES ('{$key}', '{$account}', '{$username}', '0', '{$url}', '{$email}', '{$phone}', '{$date}', '1', '1')");
    $pid=$DB->lastInsertId();
    if($sds){
    if(!empty($tid_n)){
    $sj=$conf['price'];
    $abc=$DB->exec("UPDATE `pay_user` SET `money`=money+'{$sj}',`price`=price+'{$sj}' WHERE `id`='$tid_n'");
    $abc1=$DB->exec("UPDATE `pay_user` SET `tgrs`=tgrs+'1' WHERE `id`='$tid_n'");
    }
    $sub = $conf['web_name'].' - 注册成功通知';
    $msg = '<h2>商户注册成功通知</h2>感谢您注册'.$conf['web_name'].'！<br/>您的商户ID：'.$pid.'<br/>您的商户秘钥：'.$key.'<br/>'.$conf['web_name'].'官网：<a href="http://'.$_SERVER['HTTP_HOST'].'/" target="_blank">'.$_SERVER['HTTP_HOST'].'</a><br/>【<a href="'.$siteurl.'" target="_blank">商户管理后台</a>】';
    $result = send_mail($email, $sub, $msg);
    $DB->exec("update `pay_regcode` set `status` ='1' where `id`='{$row['id']}'");
    $_SESSION['reg_submit']=time();
    exit('{"code":1,"msg":"申请商户成功！","pid":"'.$pid.'","key":"'.$key.'"}');
    }else{
    exit('{"code":-1,"msg":"申请商户失败！'.$DB->errorCode().'"}');
    }
    }
break;
case 'find':
  $email=trim(daddslashes($_POST['email']));
  if(isset($_SESSION['find_mail']) && $_SESSION['find_mail']>time()-600){
    exit('{"code":-1,"msg":"请勿频繁发送邮件，如果未收到请尝试在垃圾邮件箱寻找"}');
  }
  $row=$DB->query("select * from pay_user where email='$email' limit 1")->fetch();
  if(!$row){
    exit('{"code":-1,"msg":"该邮箱未注册过商户，如需找回请联系客服"}');
  }
  $scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
  $sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
  $siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';
  $sub = $conf['web_name'].' - 商户信息找回';
  $code = rand(1111111,9999999);
  $msg = '商户信息找回<br/>您的商户ID：'.$row['id'].'<br/>您的商户秘钥：'.$row['key'].'<br/>'.$conf['web_name'].'官网：<a href="http://'.$_SERVER['HTTP_HOST'].'/" target="_blank">'.$_SERVER['HTTP_HOST'].'</a><br/>【<a href="'.$siteurl.'" target="_blank">商户管理后台</a>】';
  $result = send_mail($email, $sub, $msg);
  if($result===true){
    $_SESSION['find_mail']=time();
    exit('{"code":0,"msg":"succ"}');
  }else{
    file_put_contents('mail.log',$result);
    exit('{"code":-1,"msg":"邮件发送失败"}');
  }
break;
default:
  exit('{"code":-4,"msg":"No Act"}');
break;
}
?>