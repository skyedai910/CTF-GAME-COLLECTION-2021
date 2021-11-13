<?php
$mod='blank';
include("../includes/common.php");
$title='订单明细';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$numrows=$DB->query("SELECT count(*) from pay_order WHERE 1")->fetchColumn();
$rs=$DB->query("SELECT * FROM pay_order WHERE 1 order by trade_no desc limit 0,$numrows");
$url=creat_callback($res);
?>
		<div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">订单明细</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">资金管理</a></li><li class="breadcrumb-item active" aria-current="page">订单明细</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                订单明细查询
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows ?></b> 条订单
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>订单号/商户订单号</th><th>商户号/网站域名</th><th>商品名称/金额</th><th>支付方式</th><th>创建时间/完成时间</th><th>支付状态</th></tr></thead><tfoot><tr><th>订单号/商户订单号</th><th>商户号/网站域名</th><th>商品名称/金额</th><th>支付方式</th><th>创建时间/完成时间</th><th>支付状态</th></tr></tfoot>
                <tbody>
                  <?php
                    foreach($rs as $res){
                    echo '<tr><td><b><a href="'.$url['notify'].'" title="支付通知" target="_blank" rel="noreferrer">'.$res['trade_no'].'</a></b><br/>'.$res['out_trade_no'].'</td><td>'.$res['pid'].'<br/>'.getdomain($res['notify_url']).'</td><td>'.$res['name'].'<br/>￥'.$res['money'].'</td><td>'.$res['type'].'</td><td>'.$res['addtime'].'<br/>'.$res['endtime'].'</td><td>'.($res['status']==1?'<font color=green>已完成</font>':'<font color=blue>未完成</font>').'</td></tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>