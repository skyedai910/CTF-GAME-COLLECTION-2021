<?php
$mod='blank';
include("../includes/common.php");
$title='商户列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$alipay=$DB->query("select * from pay_user where id='10001' limit 1")->fetch();
$numrows=$DB->query("SELECT * from pay_user WHERE 1")->rowCount();
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">商户列表</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">商户管理</a></li><li class="breadcrumb-item active" aria-current="page">商户列表</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <?php
        $my=isset($_GET['my'])?$_GET['my']:null;
        if($my=='add'){
          echo '<div class="row"><div class="col"><div class="card"><div class="card-header"><h3 class="mb-0">添加商户</h3></div><div class="card-body"><form action="./op_ulist.php?my=add_submit"method="POST"><div class="form-group"><label>结算方式:</label><select class="form-control"name="settle_id">'.($conf['stype_1']?'<option value="1">支付宝</option>':null).''.($conf['stype_2']?'<option value="2">微信</option>':null).''.($conf['stype_3']?'<option value="3">QQ钱包</option>':null).''.($conf['stype_4']?'<option value="4">银行卡</option>':null).'</select></div><div class="form-group"><label>*结算账号:</label><input type="text"class="form-control"name="account"value=""></div><div class="form-group"><label>*真实姓名:</label><input type="text"class="form-control"name="username"value=""></div><div class="form-group"><label>*邮箱地址:</label><input type="text"class="form-control"name="email"value=""></div><div class="form-group"><label>网站域名:</label><input type="text"class="form-control"name="url"value=""placeholder="可留空"></div><div class="form-group"><label>ＱＱ:</label><input type="text"class="form-control"name="qq"value=""placeholder="可留空"></div><div class="form-group"><label>QQ自定义分成比例:</label><input type="text"class="form-control"name="qqrate"value=""placeholder="填写百分数，例如98.5"></div><div class="form-group"><label>微信自定义分成比例:</label><input type="text"class="form-control"name="wxrate"value=""placeholder="填写百分数，例如98.5"></div><div class="form-group"><label>支付宝自定义分成比例:</label><input type="text"class="form-control"name="alirate"value=""placeholder="填写百分数，例如98.5"></div><div class="form-group"><label>财付通自定义分成比例:</label><input type="text"class="form-control"name="tenrate"value=""placeholder="填写百分数，例如98.5"></div><div class="form-group"><label>是否结算:</label><select class="form-control"name="type"><option value="1">1_是</option><option value="2">2_否</option></select></div><div class="form-group"><label>是否激活:</label><select class="form-control"name="active"><option value="1">1_激活</option><option value="0">0_封禁</option></select></div><input type="submit"class="btn btn-'.$conf['adminmb_ys'].' btn-block"value="确定添加"></form><br/><a href="./op_ulist.php">>>返回商户列表</a></div></div></div></div>';
        }
        elseif($my=='edit'){
          $id=$_GET['id'];
          $row=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
         if(!$row){
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
          }else{
          echo '<div class="row"><div class="col"><div class="card"><div class="card-header"><h3 class="mb-0">修改商户信息</h3></div><div class="card-body"><form action="./op_ulist.php?my=edit_submit&id='.$id.'"method="POST"><div class="form-group"><label>结算方式:</label><select class="form-control"name="settle_id"default="'.$row['settle_id'].'">'.($conf['stype_1']?'<option value="1">支付宝</option>':null).''.($conf['stype_2']?'<option value="2">微信</option>':null).''.($conf['stype_3']?'<option value="3">QQ钱包</option>':null).''.($conf['stype_4']?'<option value="4">银行卡</option>':null).'</select></div><div class="form-group"><label>*结算账号:</label><input type="text"class="form-control"name="account"value="'.$row['account'].'"></div><div class="form-group"><label>*真实姓名:</label><input type="text"class="form-control"name="username"value="'.$row['username'].'"></div><div class="form-group"><label>*商户密匙:</label><input type="text"class="form-control"name="key"value="'.$row['key'].'"maxlength="32"></div><div class="form-group"><label>*邮箱地址:</label><input type="text"class="form-control"name="email"value="'.$row['email'].'"></div><div class="form-group"><label>商户余额:</label><input type="text"class="form-control"name="money"value="'.$row['money'].'"required></div><div class="form-group"><label>网站域名:</label><input type="text"class="form-control"name="url"value="'.$row['url'].'"placeholder="可留空"></div><div class="form-group"><label>ＱＱ:</label><input type="text"class="form-control"name="qq"value="'.$row['qq'].'"placeholder="可留空"></div><div class="form-group"><label>QQ自定义分成比例:</label><input type="text"class="form-control"name="qqrate"value="'.$row['qqrate'].'"placeholder="填写百分数，例如98.5"></div><div class="form-group"><label>微信自定义分成比例:</label><input type="text"class="form-control"name="wxrate"value="'.$row['wxrate'].'"placeholder="填写百分数，例如98.5"></div><div class="form-group"><label>支付宝自定义分成比例:</label><input type="text"class="form-control"name="alirate"value="'.$row['alirate'].'"placeholder="填写百分数，例如98.5"></div><div class="form-group"><label>财付通自定义分成比例:</label><input type="text"class="form-control"name="tenrate"value="'.$row['tenrate'].'"placeholder="填写百分数，例如98.5"></div><div class="form-group"><label>是否结算:</label><select class="form-control"name="type"default="'.$row['type'].'"><option value="1">1_是</option><option value="2">2_否</option></select></div><input type="submit"class="btn btn-'.$conf['adminmb_ys'].' btn-block"value="确定修改"></form><br/><a href="./op_ulist.php">>>返回商户列表</a></div></div></div></div>';
        }
        }
        elseif($my=='add_submit'){
          $settle_id=$_POST['settle_id'];
          $key=$_POST['key'];
          $account=$_POST['account'];
          $username=$_POST['username'];
          $money='0.00';
          $url=$_POST['url'];
          $email=$_POST['email'];
          $qq=$_POST['qq'];
          $qqrate=$_POST['qqrate'];
          $wxrate=$_POST['wxrate'];
          $alirate=$_POST['alirate'];
          $tenrate=$_POST['tenrate'];
          $type=$_POST['type'];
          $active=$_POST['active'];
          if($account==NULL or $username==NULL or $email==NULL){
          echo "<script language='javascript'>alert('保存错误,请确保加*项都不为空!');history.go(-1);</script>";
         }else{
         $key = random(32);
         $sds=$DB->exec("INSERT INTO `pay_user` (`key`, `account`, `username`, `money`, `url`, `addtime`, `type`, `settle_id`, `email`, `qq`, `qqrate`, `wxrate`, `alirate`, `tenrate`, `active`) VALUES ('{$key}', '{$account}', '{$username}', '{$money}', '{$url}', '{$date}', '{$type}', '{$settle_id}', '{$email}', '{$qq}', '{$qqrate}', '{$wxrate}', '{$alirate}', '{$tenrate}', '{$active}')");
         $pid=$DB->lastInsertId();
          if($sds){
            echo "<script language='javascript'>alert('报告老大，添加商户成功！');window.location.href='./op_ulist.php';</script>";
          }else{
            echo "<script language='javascript'>alert('报告老大，添加商户失败！');history.go(-1);</script>";
          }
        }
      }elseif($my=='edit_submit'){
          $id=$_GET['id'];
          $rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
       if(!$rows){
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
          }else{
          $settle_id=$_POST['settle_id'];
          $key=$_POST['key'];
          $account=$_POST['account'];
          $username=$_POST['username'];
          $money=$_POST['money'];
          $url=$_POST['url'];
          $email=$_POST['email'];
          $qq=$_POST['qq'];
          $qqrate=$_POST['qqrate'];
          $wxrate=$_POST['wxrate'];
          $alirate=$_POST['alirate'];
          $tenrate=$_POST['tenrate'];
          $type=$_POST['type'];
          if($account==NULL or $username==NULL or $key==NULL or $email==NULL){
          echo "<script language='javascript'>alert('保存错误,请确保加*项都不为空!');history.go(-1);</script>";
        }elseif(strlen($key)<8){
        	  echo "<script language='javascript'>alert('报告老大，密匙不能小于八位数！');history.go(-1);</script>";
        }else{
          $sql="update `pay_user` set `key` ='{$key}',`account` ='{$account}',`username` ='{$username}',`money` ='{$money}',`url` ='{$url}',`type` ='$type',`settle_id` ='$settle_id',`email` ='$email',`qq` ='$qq',`qqrate` ='$qqrate',`wxrate` ='$wxrate',`alirate` ='$alirate',`tenrate` ='$tenrate' where `id`='$id'";
          if($DB->exec($sql)||$sqs){
            echo "<script language='javascript'>window.location.href='./op_ulist.php';</script>";
          }else{
            echo "<script language='javascript'>alert('报告老大，修改商户信息失败！');history.go(-1);</script>";
          }
        }
        }
        }elseif($my=='delete'){
          $id=$_GET['id'];
          $rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
          $urls=explode(',',$rows['url']);
          $sql="DELETE FROM pay_user WHERE id='$id'";
          if($DB->exec($sql)){
            echo "<script language='javascript'>window.location.href='./op_ulist.php';</script>";
          }else{
            echo "<script language='javascript'>alert('报告老大，修改商户信息失败！');history.go(-1);</script>";
          }
        }elseif ($my=='alipay'){
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `alipay` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
 echo "<script language='javascript'>alert('报告老大，开启商户支付宝接口成功！');window.location.href='./op_ulist.php';</script>";
else
echo "<script language='javascript'>alert('报告老大，开启商户支付宝接口失败！');history.go(-1);</script>";
}
}elseif ($my=='alipay_n'){
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `alipay` ='2' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	echo "<script language='javascript'>alert('报告老大，关闭商户支付宝接口成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，关闭商户支付宝接口失败！');history.go(-1);</script>";
}
}elseif ($my=='wxpay'){
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `wxpay` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	echo "<script language='javascript'>alert('报告老大，开启商户微信接口成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，开启商户微信接口失败！');history.go(-1);</script>";
}
}elseif ($my=='wxpay_n'){
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `wxpay` ='2' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	echo "<script language='javascript'>alert('报告老大，关闭商户微信接口成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，关闭商户微信接口失败！');history.go(-1);</script>";
}
}elseif ($my=='qqpay'){
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `qqpay` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	echo "<script language='javascript'>alert('报告老大，开启商户QQ接口成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，开启商户QQ接口失败！');history.go(-1);</script>";
}
}elseif ($my=='qqpay_n'){
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `qqpay` ='2' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	echo "<script language='javascript'>alert('报告老大，关闭商户QQ接口成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，关闭商户QQ接口失败！');history.go(-1);</script>";
}
}elseif ($my=='tenpay'){
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `tenpay` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	echo "<script language='javascript'>alert('报告老大，开启商户财付通接口成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，开启商户财付通接口失败！');history.go(-1);</script>";
}
}elseif ($my=='tenpay_n'){
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `tenpay` ='2' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
	echo "<script language='javascript'>alert('报告老大，关闭商户财付通接口成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，关闭商户财付通接口失败！');history.go(-1);</script>";
}
}elseif ($my=='stype')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `stype` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
		echo "<script language='javascript'>alert('报告老大，开启商户实时结算成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，开启商户实时结算失败！');history.go(-1);</script>";
}
}elseif ($my=='stype_n')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `stype` ='0' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
		echo "<script language='javascript'>alert('报告老大，关闭商户实时结算成功！');window.location.href='./op_ulist.php';</script>";
else
		echo "<script language='javascript'>alert('报告老大，关闭商户实时结算成功！');window.location.href='./op_ulist.php';</script>";
}
}elseif ($my=='active')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `active` ='1' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
		echo "<script language='javascript'>alert('报告老大，激活商户成功！');window.location.href='./op_ulist.php';</script>";
else
	echo "<script language='javascript'>alert('报告老大，激活商户失败！');history.go(-1);</script>";
}
}elseif ($my=='active_n')
{
$id=$_GET['id'];
$rows=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if (!$id) {
	echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
}else{
	$sqs=$DB->exec("update `pay_user` set `active` ='0' where `id`='$id'");
	if($DB->exec($sql)||$sqs)
		echo "<script language='javascript'>alert('报告老大，禁封商户成功！');window.location.href='./op_ulist.php';</script>";
else
		echo "<script language='javascript'>alert('报告老大，禁封商户失败！！');history.go(-1);</script>";
}
}elseif ($my=='banstype')
{
$sqs=$DB->exec("update `pay_user` set `stype` ='1'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键开启实时结算成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键开启实时结算失败！');history.go(-1);</script>";
}
}
elseif ($my=='banalipay')
{
$sqs=$DB->exec("update `pay_user` set `alipay` ='1'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键开启支付宝接口成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键开启支付宝接口成功！');window.location.href='./op_ulist.php';</script>";
}
}
elseif ($my=='banwxpay')
{
$sqs=$DB->exec("update `pay_user` set `wxpay` ='1'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键开启微信接口成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键开启微信接口失败！');history.go(-1);</script>";
}
}
elseif ($my=='banqqpay')
{
$sqs=$DB->exec("update `pay_user` set `qqpay` ='1'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键开启Q Q接口成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键开启Q Q接口失败！');history.go(-1);</script>";
}
}
elseif ($my=='bantenpay')
{
$sqs=$DB->exec("update `pay_user` set `tenpay` ='1'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键开启Q Q接口成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键开启Q Q接口失败！');history.go(-1);</script>";
}
}
elseif ($my=='dbanstype')
{
$sqs=$DB->exec("update `pay_user` set `stype` ='0'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键关闭实时结算成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键关闭实时结算失败！');history.go(-1);</script>";
}
}
elseif ($my=='dbanalipay')
{
$sqs=$DB->exec("update `pay_user` set `alipay` ='2'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键关闭支付宝接口成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键关闭支付宝接口失败！');history.go(-1);</script>";
}
}
elseif ($my=='dbanwxpay')
{
$sqs=$DB->exec("update `pay_user` set `wxpay` ='2'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键关闭微信接口成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键关闭微信接口失败！');history.go(-1);</script>";
}
}
elseif ($my=='dbanqqpay')
{
$sqs=$DB->exec("update `pay_user` set `qqpay` ='2'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键关闭Q Q接口成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键关闭Q Q接口失败！');history.go(-1);</script>";
}
}
elseif ($my=='dbantenpay')
{
$sqs=$DB->exec("update `pay_user` set `tenpay` ='2'");
  if($DB->exec($sql)||$sqs){
 echo "<script language='javascript'>alert('报告老大，一键关闭财付通接口成功！');window.location.href='./op_ulist.php';</script>";
}else{
 echo "<script language='javascript'>alert('报告老大，一键关闭财付通接口失败！');history.go(-1);</script>";
}
}
?>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                商户列表
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows ?></b> 个商户
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>商户号</th><th>密钥</th><th>余额/佣金</th><th>结算账号/真实姓名</th><th>域名/添加时间</th><th>QQ钱包</th><th>微信钱包</th><th>支付宝</th><th>财付通</th><th>实时结算</th><th>操作</th></tr></thead><tfoot><tr><th>商户号</th><th>密钥</th><th>余额/佣金</th><th>结算账号/真实姓名</th><th>域名/添加时间</th><th>QQ钱包</th><th>微信钱包</th><th>支付宝</th><th>财付通</th><th>实时结算</th><th>操作</th></tr></tfoot>
                <tbody>
                  <?php
                    $rs=$DB->query("SELECT * FROM pay_user WHERE 1 order by id desc limit 0,$numrows");
                    foreach($rs as $res){
                    echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['key'].'</td><td>'.$res['money'].'<br/>'.$res['price'].'</td><td>'.($res['settle_id']==2?'<font color="green">WX:</font>':null).($res['settle_id']==3?'<font color="green">QQ:</font>':null).$res['account'].'<br/>'.$res['username'].'</td><td>'.$res['url'].'<br/>'.$res['addtime'].'</td><td>'.($res['qqpay']==1?'<a href="./op_ulist.php?my=qqpay_n&id='.$res['id'].'" class="btn btn-sm btn-success">正常</font></a>':null).($res['qqpay']==2?'<a href="./op_ulist.php?my=qqpay&id='.$res['id'].'" class="btn btn-sm btn-danger">关闭</a>':null).'</td><td>'.($res['wxpay']==1?'<a href="./op_ulist.php?my=wxpay_n&id='.$res['id'].'" class="btn btn-sm btn-success">正常</a>':null).($res['wxpay']==2?'<a href="./op_ulist.php?my=wxpay&id='.$res['id'].'" class="btn btn-sm btn-danger">关闭</a>':null).'</td><td>'.($res['alipay']==1?'<a href="./op_ulist.php?my=alipay_n&id='.$res['id'].'" class="btn btn-sm btn-success">正常</a>':null).($res['alipay']==2?'<a href="./op_ulist.php?my=alipay&id='.$res['id'].'" class="btn btn-sm btn-danger">关闭</a>':null).'</td><td>'.($res['tenpay']==1?'<a href="./op_ulist.php?my=tenpay_n&id='.$res['id'].'" class="btn btn-sm btn-success">正常</font></a>':null).($res['tenpay']==2?'<a href="./op_ulist.php?my=tenpay&id='.$res['id'].'" class="btn btn-sm btn-danger">关闭</a>':null).'</td><td>'.($res['stype']==1?'<a href="./op_ulist.php?my=stype_n&id='.$res['id'].'" class="btn btn-sm btn-success">正常</a>':null).($res['stype']==0?'<a href="./op_ulist.php?my=stype&id='.$res['id'].'" class="btn btn-sm btn-danger">关闭</a>':null).'</td><td>'.($res['active']==1?'<a href="./op_ulist.php?my=active_n&id='.$res['id'].'" class="btn btn-sm btn-success">正常</a>':null).($res['active']==0?'<a href="./op_ulist.php?my=active&id='.$res['id'].'" class="btn btn-sm btn-danger">禁封</a>':null).'&nbsp;<a href="./op_ulist.php?my=edit&id='.$res['id'].'" class="btn btn-sm btn-info">编辑</a>&nbsp;<a href="./op_ulist.php?my=delete&id='.$res['id'].'" class="btn btn-sm btn-danger" onclick="return confirm(\'你确实要删除此商户吗？\');">删除</a></td></tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
          <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">一键配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"role="form"><?php if($alipay['alipay']==1){ ?><a href="./op_ulist.php?my=dbanalipay" class="btn btn-danger form-control">一键关闭支付宝接口</a><?php }else{ ?><a href="./op_ulist.php?my=banalipay" class="btn btn-success form-control">一键开启支付宝接口</a><?php } ?><br><br><?php if($alipay['tenpay']==1){ ?><a href="./op_ulist.php?my=dbantenpay" class="btn btn-danger form-control">一键关闭财付通接口</a><?php }else{ ?><a href="./op_ulist.php?my=bantenpay" class="btn btn-success form-control">一键开启财付通接口</a><?php } ?><br><br><?php if($alipay['wxpay']==1){ ?><a href="./op_ulist.php?my=dbanwxpay" class="btn btn-danger form-control">一键关闭微信接口</a><?php }else{ ?><a href="./op_ulist.php?my=banwxpay" class="btn btn-success form-control">一键开启微信接口</a><?php } ?><br><br><?php if($alipay['qqpay']==1){ ?><a href="./op_ulist.php?my=dbanqqpay" class="btn btn-danger form-control">一键关闭Q Q接口</a><?php }else{ ?><a href="./op_ulist.php?my=banqqpay" class="btn btn-success form-control">一键开启Q Q接口</a><?php } ?><br><br><?php if($alipay['stype']==1){ ?><a href="./op_ulist.php?my=dbanstype" class="btn btn-danger form-control">一键关闭实时结算</a><?php }else{ ?><a href="./op_ulist.php?my=banstype" class="btn btn-success form-control">一键开启实时结算</a><?php } ?>
                </form>
              </div>
            </div>
          </div>   
      <!-- 主页结束 -->
      </div>
      </div>
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>