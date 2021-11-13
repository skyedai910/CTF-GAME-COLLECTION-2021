<?php 
require_once('../../includes/common.php');
require(SYSTEM_ROOT.'eshanghu/Signer.php');
require(SYSTEM_ROOT.'eshanghu/Eshanghu.php');
$pay_config = require(SYSTEM_ROOT.'eshanghu/config.php');

$pay = new Eshanghu($pay_config);

if($pay->checkSign($_POST)){
	
	if($_POST['status'] == 9){
		$out_trade_no = daddslashes($_POST['out_trade_no']);
		$order_sn = $_POST['order_sn'];
		$total_fee = $_POST['total_fee'];
		$srow=$DB->query("SELECT * FROM pay_order WHERE trade_no='{$out_trade_no}' limit 1 for update")->fetch();
		if($srow['status']==0){
			if($DB->exec("update `pay_order` set `status` ='1' where `trade_no`='$out_trade_no'")){
				$DB->exec("update `pay_order` set `endtime` ='$date' where `trade_no`='$out_trade_no'");
				processOrder($srow);
			}
		}

		echo 'success';
	}else{
		echo 'fail';
	}
}else{
	echo 'fail';
}
?>