<?php
$mod='blank';
include("../includes/common.php");
include("../submit/wxpay/wxpay_notify.php");
$title='管理首页';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$count1=$DB->query("SELECT count(*) from pay_order")->fetchColumn();
$count2=$DB->query("SELECT count(*) from pay_user")->fetchColumn();

$data=unserialize(file_get_contents(SYSTEM_ROOT.'db.txt'));

$mysqlversion=$DB->query("select VERSION()")->fetch();
?>
<!-- 森度易支付:pay.sd129.cn -->
		<div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">管理中心</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">仪表盘</a></li></ol></nav></div></div><div class="row"><div class="col-xl-3 col-md-6"><div class="card card-stats"><div class="card-body"><div class="row"><div class="col"><h5 class="card-title text-uppercase text-muted mb-0">总计流水</h5><span class="h2 font-weight-bold mb-0">￥<?php echo $data['usermoney']?></span></div><div class="col-auto"><div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow"><i class="ni ni-chart-pie-35"></i></div></div></div><p class="mt-3 mb-0 text-sm"><span class="text-nowrap">截止：<?=$date?></span></p></div></div></div><div class="col-xl-3 col-md-6"><div class="card card-stats"><!--Card body--><div class="card-body"><div class="row"><div class="col"><h5 class="card-title text-uppercase text-muted mb-0">商户数量</h5><span class="h2 font-weight-bold mb-0"><?php echo $count2?>个</span></div><div class="col-auto"><div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow"><i class="ni ni-circle-08"></i></div></div></div><p class="mt-3 mb-0 text-sm"><span class="text-nowrap">截止：<?=$date?></span></p></div></div></div><div class="col-xl-3 col-md-6"><div class="card card-stats"><div class="card-body"><div class="row"><div class="col"><h5 class="card-title text-uppercase text-muted mb-0">订单总数</h5><span class="h2 font-weight-bold mb-0"><?php echo $count1?>条</span></div><div class="col-auto"><div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow"><i class="ni ni-cart"></i></div></div></div><p class="mt-3 mb-0 text-sm"><span class="text-nowrap">截止：<?=$date?></span></p></div></div></div><div class="col-xl-3 col-md-6"><div class="card card-stats"><div class="card-body"><div class="row"><div class="col"><h5 class="card-title text-uppercase text-muted mb-0">结算总额</h5><span class="h2 font-weight-bold mb-0"><?php echo $data['settlemoney']?>元</span></div><div class="col-auto"><div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow"><i class="ni ni-credit-card"></i></div></div></div><p class="mt-3 mb-0 text-sm"><span class="text-nowrap">截止：<?=$date?></span></p></div></div></div></div></div></div>
    </div>
    <!-- 页面核心 -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">四网收入详情</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-<?php echo $conf['adminmb_ys']?>">￥莫宇币</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush"><thead class="thead-light"><tr><th scope="col">通道</th><th scope="col">今日</th><th scope="col">昨日</th></tr></thead><tbody><tr><th scope="row">支付宝</th><td><?php echo round($data['order_today']['alipay'],2)?></td><td><?php echo round($data['order_lastday']['alipay'],2)?></td></tr><tr><th scope="row">微信</th><td><?php echo round($data['order_today']['wxpay'],2)?></td><td><?php echo round($data['order_lastday']['wxpay'],2)?></td></tr><tr><th scope="row">QQ</th><td><?php echo round($data['order_today']['qqpay'],2)?></td><td><?php echo round($data['order_lastday']['qqpay'],2)?></td></tr><tr><th scope="row">财付通</th><td><?php echo round($data['order_today']['tenpay'],2)?></td><td><?php echo round($order_lastday['tenpay'],2)?></td></tr><tr><th scope="row">总和</th><td><?php echo round($data['order_today']['all'],2)?></td><td><?php echo round($data['order_lastday']['all'],2)?></td></tr></tbody>
              </table>
            </div>
          </div>
        </div>
      <div class="col-xl-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">站点服务器信息</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush"><thead class="thead-light"><tr><th scope="col"><?php echo $conf['web_name']?></th><th scope="col">信息详情</th></tr></thead><tbody><tr><th scope="row">PHP 版本：</th><td><?php echo phpversion() ?> <?php if(ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?></td></tr><tr><th scope="row">MySQL 版本：</th><td><?php echo $mysqlversion[0] ?></td></tr><tr><th scope="row">服务器软件：</th><td><?php echo $_SERVER['SERVER_SOFTWARE'] ?></td></tr><tr><th scope="row">程序最大运行时间：</th><td><?php echo ini_get('max_execution_time') ?>s</td></tr><tr><th scope="row">O泡易支付系统版本：</th><td>公益版，正版功能更多哦，购买正版请前往www.xsq6.com</td></tr></tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
<?php include 'foot.php';?>