<?php
/**
* 	配置账号信息
*/
include_once '../common.php';
define('MCHS_ID',$conf['wx_api_appid']);

define('MCHS_PID',$conf['wx_api_mchid']);

define('MCHS_KEY',$conf['wx_api_key']);

define('MCHS_APP',$conf['wx_api_appsecret']);
class WxPayConfig
{
	 const APPID = MCHS_ID;
	 const MCHID = MCHS_PID;
	 const KEY = MCHS_KEY;
	 const APPSECRET = MCHS_APP;

	const SSLCERT_PATH = '/home/cert/apiclient_cert.pem';
	const SSLKEY_PATH = '/home/cert/apiclient_key.pem';
	const CURL_PROXY_HOST = "0.0.0.0";//"10.152.18.220";
	const CURL_PROXY_PORT = 0;//8080;
	const REPORT_LEVENL = 1;
}
?>