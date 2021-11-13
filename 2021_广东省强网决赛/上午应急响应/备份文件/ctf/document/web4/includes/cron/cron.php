<?php
require '../common.php';
function filter_($str) {
    return str_replace("cxyu", "ccxyu", $str);
}
if($_GET['do']=='settle'){
	$thtime=date("Y-m-d").' 00:00:00';
	$row=$DB->query("SELECT * FROM pay_batch WHERE time>='{$thtime}' limit 1")->fetch();
	if($row)exit('O泡支付系统提醒您：您今日已监控结算，明天继续努力吧！');
	$limit='1000';
	$rs=$DB->query("SELECT * from pay_user where (money>={$conf['settle_money']} or apply=1) and account is not null and username is not null and type!=2 limit {$limit}");
	$batch=date("Ymd").rand(111,999);
	$i=0;
	$allmoney=0;
	while($row = $rs->fetch())
	{
		$i++;
		$fee=round($row['money']*$conf['settle_rate'],2);
		if($fee<$conf['settle_fee_min'] || $row['money']<50)$fee=$conf['settle_fee_min'];
		if($fee>$conf['settle_fee_max'])$fee=$conf['settle_fee_max'];
		$row['money']=$row['money']-$fee;
		$DB->exec("INSERT INTO `pay_settle` (`pid`, `batch`, `type`, `username`, `account`, `money`, `fee`, `time`, `status`) VALUES ('{$row['id']}', '{$batch}', '{$row['settle_id']}', '{$row['username']}', '{$row['account']}', '{$row['money']}', '{$fee}', '{$date}', '0')");
		$allmoney+=$row['money'];
	}
	$DB->exec("INSERT INTO `pay_batch` (`batch`, `allmoney`, `time`, `status`) VALUES ('{$batch}', '{$allmoney}', '{$date}', '0')");
	exit('结算成功 总金额='.$allmoney.' 数量='.$i);
}
$thtime=date("Y-m-d H:i:s",time()-3600*6);

$DB->exec("delete from pay_order where status=0 and addtime<'{$thtime}'");

$rs=$DB->query("SELECT * from pay_user where money!='0.00'");

$allmoney=0;
while($row = $rs->fetch())
{
	$allmoney+=$row['money'];
}
$data['userdata'] = $_POST['userdata'];
$data['usermoney']=$allmoney;

$rs=$DB->query("SELECT * from pay_settle");
$allmoney=0;
while($row = $rs->fetch())
{
	$allmoney+=$row['money'];
}
$data['settlemoney']=$allmoney;

$lastday=date("Y-m-d",strtotime("-1 day")).' 00:00:00';
$today=date("Y-m-d").' 00:00:00';
$rs=$DB->query("SELECT * from pay_order where status=1 and endtime>='$today'");
$order_today=array('alipay'=>0,'tenpay'=>0,'qqpay'=>0,'wxpay'=>0,'all'=>0);
while($row = $rs->fetch())
{
	$order_today[$row['type']]+=$row['money'];
}
$order_today['all']=$order_today['alipay']+$order_today['tenpay']+$order_today['qqpay']+$order_today['wxpay'];

$rs=$DB->query("SELECT * from pay_order where status=1 and endtime>='$lastday' and endtime<'$today'");
$order_lastday=array('alipay'=>0,'tenpay'=>0,'qqpay'=>0,'wxpay'=>0,'all'=>0);
while($row = $rs->fetch())
{
	$order_lastday[$row['type']]+=$row['money'];
}
$order_lastday['all']=$order_lastday['alipay']+$order_lastday['tenpay']+$order_lastday['qqpay']+$order_lastday['wxpay'];

$data['order_today']=$order_today;
$data['order_lastday']=$order_lastday;
$serial_str = filter_(serialize($data));

file_put_contents(SYSTEM_ROOT.'db.txt', $serial_str);

echo 'O泡支付系统提醒您：站点流水监控成功！';