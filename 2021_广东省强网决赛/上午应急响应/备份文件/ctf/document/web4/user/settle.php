<?php
include("../includes/common.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
$title='结算记录';
include './head.php';
?>
<?php
$numrows=$DB->query("SELECT * from pay_settle WHERE pid={$pid}")->rowCount();
$list=$DB->query("SELECT * FROM pay_settle WHERE pid={$pid} order by id desc limit 0,$numrows")->fetchAll();
?>
<!-- opao.kucat.cn -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">结算明细</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">订单与结算</a></li><li class="breadcrumb-item active" aria-current="page">结算明细</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                结算明细表
              </h3>
              <p class="text-sm mb-0">
                要钱没有，要命也没有，跑路使我快乐，删库使我舒畅。小老弟你怎么回事？你竟然有
                <?php echo $numrows?>
                  条结算记录
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>结算ID</th><th>结算账号</th><th>结算金额</th><th>手续费</th><th>结算时间</th><th>订单状态</th></tr></thead><tfoot><tr><th>订单ID</th><th>结算账号</th><th>结算金额</th><th>手续费</th><th>结算时间</th><th>结算状态</th></tr></tfoot>
                <tbody>
                  <?php
                    foreach($list as $res){
                    echo '<tr><td>'.$res['id'].'</td><td>'.$res['account'].'</td><td>￥ <b>'.$res['money'].'</b></td><td>￥ <b>'.$res['fee'].'</b></td><td>'.$res['time'].'</td><td>'.($res['status']==1?'<font color=green>已完成</font>':'<font color=red>未完成</font>').'</td></tr>';
                   }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';