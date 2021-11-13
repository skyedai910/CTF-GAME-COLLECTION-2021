<?php
include("../includes/common.php");
if($islogin2==1){}else exit('{"code":-3,"msg":"No Login"}');
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

@header('Content-Type: application/json; charset=UTF-8');

switch($act){
case 'sendcode':
	$situation=trim(daddslashes($_POST['situation']));
	$target=trim(strip_tags(daddslashes($_POST['target'])));
	if(isset($_SESSION['send_mail']) && $_SESSION['send_mail']>time()-10){
		exit('{"code":-1,"msg":"请勿频繁发送验证码"}');
	}
	require_once SYSTEM_ROOT.'class.geetestlib.php';
	$GtSdk = new GeetestLib($conf['CAPTCHA_ID'], $conf['PRIVATE_KEY']);

	$data = array(
		'user_id' => $pid, # 网站用户id
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
	if($conf['verifytype']==1){
		if($situation=='bind'){
			$phone=$target;
			if(empty($phone) || strlen($phone)!=11){
				exit('{"code":-1,"msg":"请填写正确的手机号码！"}');
			}
			if($phone==$userrow['phone']){
				exit('{"code":-1,"msg":"你填写的手机号码和之前一样"}');
			}
			$row=$DB->query("select * from pay_user where phone='$target' limit 1")->fetch();
			if($row){
				exit('{"code":-1,"msg":"该手机号码已经绑定过其它商户"}');
			}
		}else{
			if(empty($userrow['phone']) || strlen($userrow['phone'])!=11){
				exit('{"code":-1,"msg":"请先绑定手机号码！"}');
			}
			$phone=$userrow['phone'];
		}
		$row=$DB->query("select * from pay_regcode where email='$phone' order by id desc limit 1")->fetch();
		if($row['time']>time()-60){
			exit('{"code":-1,"msg":"两次发送短信之间需要相隔60秒！"}');
		}
		$count=$DB->query("select count(*) from pay_regcode where email='$phone' and time>'".(time()-3600*24)."'")->fetchColumn();
		if($count>2){
			exit('{"code":-1,"msg":"该手机号码发送次数过多，暂无法发送！"}');
		}
		$count=$DB->query("select count(*) from pay_regcode where ip='$clientip' and time>'".(time()-3600*24)."'")->fetchColumn();
		if($count>5){
			exit('{"code":-1,"msg":"你今天发送次数过多，已被禁止发送"}');
		}
		$code = rand(111111,999999);
		$result = send_sms($phone, $code, '4');
		if($result===true){
			if($DB->exec("insert into `pay_regcode` (`type`,`code`,`email`,`time`,`ip`,`status`) values ('3','".$code."','".$phone."','".time()."','".$clientip."','0')")){
				$_SESSION['send_mail']=time();
				exit('{"code":0,"msg":"succ"}');
			}else{
				exit('{"code":-1,"msg":"写入数据库失败。'.$DB->errorCode().'"}');
			}
		}else{
			exit('{"code":-1,"msg":"短信发送失败 '.$result.'"}');
		}
	}else{
		if($situation=='bind'){
			$email=$target;
			if(!preg_match('/^[A-z0-9._-]+@[A-z0-9._-]+\.[A-z0-9._-]+$/', $email)){
				exit('{"code":-1,"msg":"邮箱格式不正确"}');
			}
			if($email==$userrow['email']){
				exit('{"code":-1,"msg":"你填写的邮箱和之前一样"}');
			}
			$row=$DB->query("select * from pay_user where email='$email' limit 1")->fetch();
			if($row){
				exit('{"code":-1,"msg":"该邮箱已经绑定过其它商户"}');
			}
		}else{
			if(empty($userrow['email']) || strpos($userrow['email'],'@')===false){
				exit('{"code":-1,"msg":"请先绑定邮箱！"}');
			}
			$email=$userrow['email'];
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
			exit('{"code":-1,"msg":"你今天发送次数过多，已被禁止发送"}');
		}
		$sub = $conf['web_name'].' - 验证码获取';
		$code = rand(1111111,9999999);
		if($situation=='settle')$msg = '您正在修改结算账号信息，验证码是：'.$code;
		elseif($situation=='mibao')$msg = '您正在修改密保邮箱，验证码是：'.$code;
		elseif($situation=='bind')$msg = '您正在绑定新邮箱，验证码是：'.$code;
		else $msg = '您的验证码是：'.$code;
		$result = send_mail($email, $sub, $msg);
		if($result===true){
			if($DB->exec("insert into `pay_regcode` (`type`,`code`,`email`,`time`,`ip`,`status`) values ('2','".$code."','".$email."','".time()."','".$clientip."','0')")){
				$_SESSION['send_mail']=time();
				exit('{"code":0,"msg":"succ"}');
			}else{
				exit('{"code":-1,"msg":"写入数据库失败。'.$DB->errorCode().'"}');
			}
		}else{
			file_put_contents('mail.log',$result);
			exit('{"code":-1,"msg":"邮件发送失败"}');
		}
	}
break;
case 'verifycode':
	$code=trim(strip_tags(daddslashes($_POST['code'])));
	if($conf['verifytype']==1){
		$row=$DB->query("select * from pay_regcode where type=3 and code='$code' and email='{$userrow['phone']}' order by id desc limit 1")->fetch();
	}else{
		$row=$DB->query("select * from pay_regcode where type=2 and code='$code' and email='{$userrow['email']}' order by id desc limit 1")->fetch();
	}
	if(!$row){
		exit('{"code":-1,"msg":"验证码不正确！"}');
	}
	if($row['time']<time()-3600 || $row['status']>0){
		exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
	}
	$_SESSION['verify_ok']=$pid;
	$DB->exec("update `pay_regcode` set `status` ='1' where `id`='{$row['id']}'");
	exit('{"code":1,"msg":"succ"}');
break;
case 'edit_settle':
	$type=intval($_POST['stype']);
	$account=trim(strip_tags(daddslashes($_POST['account'])));
	$username=trim(strip_tags(daddslashes($_POST['username'])));

	if($account==null || $username==null){
		exit('{"code":-1,"msg":"请确保每项都不为空"}');
	}
	if($type==1 && strlen($account)!=11 && strpos($account,'@')==false){
		exit('{"code":-1,"msg":"请填写正确的支付宝账号！"}');
	}
	if($type==2 && strlen($account)<3){
		exit('{"code":-1,"msg":"请填写正确的微信"}');
	}
	if($userrow['type']!=2 && !empty($userrow['account']) && !empty($userrow['username']) && ($userrow['account']!=$account || $userrow['username']!=$username) && $_SESSION['verify_ok']!==$pid){
		if($conf['verifytype']==1 && (empty($userrow['phone']) || strlen($userrow['phone'])!=11)){
			exit('{"code":-1,"msg":"请先绑定手机号码！"}');
		}elseif(empty($userrow['email']) || strpos($userrow['email'],'@')===false){
			exit('{"code":-1,"msg":"请先绑定邮箱！"}');
		}
		exit('{"code":2,"msg":"need verify"}');
	}
	$sqs=$DB->exec("update `pay_user` set `settle_id` ='{$type}',`account` ='{$account}',`username` ='{$username}' where `id`='$pid'");
	if($sqs || $DB->errorCode()=='0000'){
		exit('{"code":1,"msg":"succ"}');
	}else{
		exit('{"code":-1,"msg":"保存失败！'.$DB->errorCode().'"}');
	}
break;
case 'edit_info':
	$email=daddslashes(strip_tags($_POST['email']));
	$qq=daddslashes(strip_tags($_POST['qq']));
	$url=daddslashes(strip_tags($_POST['url']));

	if($qq==null || $url==null){
		exit('{"code":-1,"msg":"请确保每项都不为空"}');
	}
	if($conf['verifytype']==1){
		$sqs=$DB->exec("update `pay_user` set `email` ='{$email}',`qq` ='{$qq}',`url` ='{$url}' where `id`='$pid'");
	}else{
		$sqs=$DB->exec("update `pay_user` set `qq` ='{$qq}',`url` ='{$url}' where `id`='$pid'");
	}
	if($sqs || $DB->errorCode()=='0000'){
		exit('{"code":1,"msg":"succ"}');
	}else{
		exit('{"code":-1,"msg":"保存失败！'.$DB->errorCode().'"}');
	}
break;
case 'edit_bind':
	$email=daddslashes(strip_tags($_POST['email']));
	$phone=daddslashes(strip_tags($_POST['phone']));
	$code=daddslashes(strip_tags($_POST['code']));

	if($code==null || $email==null && $phone==null){
		exit('{"code":-1,"msg":"请确保每项都不为空"}');
	}
	if($conf['verifytype']==1){
		$row=$DB->query("select * from pay_regcode where type=3 and code='$code' and email='$phone' order by id desc limit 1")->fetch();
	}else{
		$row=$DB->query("select * from pay_regcode where type=2 and code='$code' and email='$email' order by id desc limit 1")->fetch();
	}
	if(!$row){
		exit('{"code":-1,"msg":"验证码不正确！"}');
	}
	if($row['time']<time()-3600 || $row['status']>0){
		exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
	}
	if($conf['verifytype']==1){
		$sqs=$DB->exec("update `pay_user` set `phone` ='{$phone}' where `id`='$pid'");
	}else{
		$sqs=$DB->exec("update `pay_user` set `email` ='{$email}' where `id`='$pid'");
	}
	if($sqs || $DB->errorCode()=='0000'){
		exit('{"code":1,"msg":"succ"}');
	}else{
		exit('{"code":-1,"msg":"保存失败！'.$DB->errorCode().'"}');
	}
break;
case 'checkbind':
	if($conf['verifytype']==1 && (empty($userrow['phone']) || strlen($userrow['phone'])!=11)){
		exit('{"code":1,"msg":"bind"}');
	}elseif($conf['verifytype']==0 && (empty($userrow['email']) || strpos($userrow['email'],'@')===false)){
		exit('{"code":1,"msg":"bind"}');
	}elseif(isset($_SESSION['verify_ok']) && $_SESSION['verify_ok']===$pid){
		exit('{"code":1,"msg":"bind"}');
	}else{
		exit('{"code":2,"msg":"need verify"}');
	}
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
?>