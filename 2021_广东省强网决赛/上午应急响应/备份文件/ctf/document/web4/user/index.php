<?php
include("../includes/common.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
$title='商户中心';
include './head.php';
$orders=$DB->query("SELECT count(*) from pay_order WHERE pid={$pid}")->fetchColumn();
$lastday=date("Ymd",strtotime("-1 day")).'00000000000';
$today=date("Ymd").'00000000000';
$order_today['alipay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today' and type='alipay'")->fetchColumn();
$order_today['wxpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today' and type='wxpay'")->fetchColumn();
$order_today['qqpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today' and type='qqpay'")->fetchColumn();
$order_today['tenpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today' and type='tenpay'")->fetchColumn();
$order_lastday['alipay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today' and type='alipay'")->fetchColumn();
$order_lastday['wxpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today' and type='wxpay'")->fetchColumn();
$order_lastday['qqpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today' and type='qqpay'")->fetchColumn();
$order_lastday['tenpay']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today' and type='tenpay'")->fetchColumn();
$order_today['all']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$today'")->fetchColumn();
$order_lastday['all']=$DB->query("SELECT sum(money) from pay_order where pid={$pid} and status=1 and trade_no>='$lastday' and trade_no<'$today'")->fetchColumn();
$rs=$DB->query("SELECT * from pay_settle where pid={$pid} and status=1 ORDER BY time DESC LIMIT 10");
$numrows=$DB->query("SELECT * from pay_settle WHERE pid={$pid}")->rowCount();
$settle_money=0;
$max_settle=0;
$chart='';
$i=0;
while($row = $rs->fetch())
{
  $settle_money+=$row['money'];
  if($row['money']>$max_settle)$max_settle=$row['money'];
  if($i<10)$chart.=''.$row['money'].',';
  $i++;
}
$chart=substr($chart,0,-1);
?>
<!-- opao.kucat.cn -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">商户中心</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">仪表盘</a></li></ol></nav></div></div><div class="row"><div class="col-xl-3 col-md-6"><div class="card card-stats"><div class="card-body"><div class="row"><div class="col"><h5 class="card-title text-uppercase text-muted mb-0">商户余额</h5><span class="h2 font-weight-bold mb-0">￥<?php echo $userrow['money']?></span></div><div class="col-auto"><div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow"><i class="ni ni-diamond"></i></div></div></div><p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-arrow-up"></i>100%</span><span class="text-nowrap">做人不能太攀比。</span></p></div></div></div><div class="col-xl-3 col-md-6"><div class="card card-stats"><!--Card body--><div class="card-body"><div class="row"><div class="col"><h5 class="card-title text-uppercase text-muted mb-0">订单总数</h5><span class="h2 font-weight-bold mb-0"><?php echo $orders?>条</span></div><div class="col-auto"><div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow"><i class="ni ni-chart-pie-35"></i></div></div></div><p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-arrow-up"></i>100%</span><span class="text-nowrap">踏踏实实做自己。</span></p></div></div></div><div class="col-xl-3 col-md-6"><div class="card card-stats"><div class="card-body"><div class="row"><div class="col"><h5 class="card-title text-uppercase text-muted mb-0">结算金额</h5><span class="h2 font-weight-bold mb-0">￥<?php echo $settle_money?></span></div><div class="col-auto"><div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow"><i class="ni ni-money-coins"></i></div></div></div><p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-arrow-up"></i>100%</span><span class="text-nowrap">如果非要比一比。</span></p></div></div></div><div class="col-xl-3 col-md-6"><div class="card card-stats"><div class="card-body"><div class="row"><div class="col"><h5 class="card-title text-uppercase text-muted mb-0">结算总数</h5><span class="h2 font-weight-bold mb-0"><?php echo $numrows?>条</span></div><div class="col-auto"><div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow"><i class="ni ni-chart-bar-32"></i></div></div></div><p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-arrow-up"></i>100%</span><span class="text-nowrap">不如比比激光雨。</span></p></div></div></div></div></div></div>
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
                  <a href="#!" class="btn btn-sm btn-<?php echo $conf['usermb_ys']?>">￥人民币</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush"><thead class="thead-light"><tr><th scope="col">通道</th><th scope="col">今日</th><th scope="col">昨日</th></tr></thead><tbody><tr><th scope="row">支付宝</th><td><?php echo round($order_today['alipay'],2)?></td><td><?php echo round($order_lastday['alipay'],2)?></td></tr><tr><th scope="row">微信</th><td><?php echo round($order_today['wxpay'],2)?></td><td><?php echo round($order_lastday['wxpay'],2)?></td></tr><tr><th scope="row">QQ</th><td><?php echo round($order_today['qqpay'],2)?></td><td><?php echo round($order_lastday['qqpay'],2)?></td></tr><tr><th scope="row">财付通</th><td><?php echo round($order_today['tenpay'],2)?></td><td><?php echo round($order_lastday['tenpay'],2)?></td></tr><tr><th scope="row">总和</th><td><?php echo round($order_today['all'],2)?></td><td><?php echo round($order_lastday['all'],2)?></td></tr></tbody>
              </table>
            </div>
          </div>
        </div>
        <!--分割-->
         <div class="col-xl-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">四网费率详情</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-<?php echo $conf['usermb_ys']?>">￥百分比</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush"><thead class="thead-light"><tr><th scope="col">通道</th><th scope="col">默认费率</th><th scope="col">当前费率</th></tr></thead><tbody><tr><th scope="row">支付宝</th><td><?php $yibai=100;$tyfeilv=$conf['alirate'];echo $yibai-$tyfeilv?>%</td><?php if($userrow['alirate']==null){?><td><?php $yibai=100;$tyfeilv=$conf['alirate'];echo $yibai-$tyfeilv?>%<?php }else{?><td><?php $yibai=100;$tyfeilv=$userrow['alirate'];echo $yibai-$tyfeilv?>%<?php }?></td></tr><tr><th scope="row">微信</th><td><?php $yibai=100;$tyfeilv=$conf['wxrate'];echo $yibai-$tyfeilv?>%</td><?php if($userrow['wxrate']==null){?><td><?php $yibai=100;$tyfeilv=$conf['wxrate'];echo $yibai-$tyfeilv?>%<?php }else{?><td><?php $yibai=100;$tyfeilv=$userrow['wxrate'];echo $yibai-$tyfeilv?>%<?php }?></td></tr><tr><th scope="row">QQ</th><td><?php $yibai=100;$tyfeilv=$conf['qqrate'];echo $yibai-$tyfeilv?>%</td><?php if($userrow['qqrate']==null){?><td><?php $yibai=100;$tyfeilv=$conf['qqrate'];echo $yibai-$tyfeilv?>%<?php }else{?><td><?php $yibai=100;$tyfeilv=$userrow['qqrate'];echo $yibai-$tyfeilv?>%<?php }?></td></tr><tr><th scope="row">财付通</th><td><?php $yibai=100;$tyfeilv=$conf['tenrate'];echo $yibai-$tyfeilv?>%</td><?php if($userrow['tenrate']==null){?><td><?php $yibai=100;$tyfeilv=$conf['tenrate'];echo $yibai-$tyfeilv?>%<?php }else{?><td><?php $yibai=100;$tyfeilv=$userrow['qqrate'];echo $yibai-$tyfeilv?>%<?php }?></td></tr></tbody>
              </table>
            </div>
          </div>
        </div>
        <!--分割-->
        <?php
        $numrows=$DB->query("SELECT * from opao_gg WHERE 1")->rowCount();
        if($numrows!=0){
         ?>
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">商业广告详情</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-<?php echo $conf['usermb_ys']?>">商业广告</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush"><thead class="thead-light"><tr><th scope="col">编号</th><th scope="col">名称</th><th scope="col">内容</th><th scope="col">操作</th></tr></thead>
              <tbody>
                <?php
                    $rs=$DB->query("SELECT * FROM opao_gg WHERE 1 order by id");
                    foreach($rs as $res){    
                    echo '<tr><th scope="row"><b>'.$res['id'].'</b></th><td>'.$res['title'].'</td><td>'.$res['nr'].'</td><td><a target="_blank" href="http://'.$res['url'].'/"><font color="green">立即查看</font></a></td></tr>';  
                  }?>
           </tbody>
           </table>
            </div>
          </div>
        </div>  
        <?php } ?>
        <!--O泡制作-->
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>