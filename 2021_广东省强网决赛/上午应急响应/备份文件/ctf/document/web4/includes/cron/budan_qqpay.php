<?php
/*O泡支付QQ自动补单-code's by O泡！
说明：本页面用于O泡支付系统对接第三方易支付时，请求支付接口订单列表，同步未通知到本站的订单，防止漏单。
温馨提示：监控频率建议5分钟一次，千万不要监控太快或使用多节点监控，否则可能会被支付接口自动屏蔽IP地址！
*/
include("../common.php");
$key = isset($_GET['key']) ? $_GET['key'] : null;
if (!($conf['cron_key'] && $key && $key == $conf['cron_key'])) {
    exit('O泡支付系统提醒您：您的监控识别码不正确，请前往系统后台查看或修改！');
}
if (function_exists("set_time_limit"))
{
	@set_time_limit(0);
}
if (function_exists("ignore_user_abort"))
{
	@ignore_user_abort(true);
}
@header('Content-Type: text/html; charset=UTF-8');
$data = get_curl('http://接口地址/api.php?act=orders&limit=50&pid=商户ID&key=商户密匙');
$arr = json_decode($data, true);
if($arr['code']==1){
	foreach($arr['data'] as $row){
		if($row['status']==1){
			$out_trade_no = $row['out_trade_no'];
		$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1")->fetch();
		if($srow['status']==0){
			$DB->query("update `pay_order` set `status` ='1',`endtime` ='$date' where `trade_no`='$out_trade_no'");
  processOrder($srow);
				echo 'O泡支付程序非常负责的告诉您，已成功补单的有：'.$out_trade_no.'<br/>';
			}
		}
	}
	exit('ok');
}else{
	exit($arr['msg']);
}
?>