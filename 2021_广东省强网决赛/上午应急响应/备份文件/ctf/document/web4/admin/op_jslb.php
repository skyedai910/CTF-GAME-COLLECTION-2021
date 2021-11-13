<?php
include("../includes/common.php");
$title='实时明细';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$numrows=$DB->query("SELECT count(*) from pay_alisettle WHERE 1")->fetchColumn();
$rs=$DB->query("SELECT * FROM pay_alisettle WHERE 1 order by id desc limit 0,$numrows");
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">实时明细</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">资金管理</a></li><li class="breadcrumb-item active" aria-current="page">实时明细</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                实时明细查询
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows ?></b> 条记录
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>ID</th><th>商户号</th><th>姓名</th><th>结算账号</th><th>结算金额</th><th>备注</th><th>转账状态</th><th>状态信息</th><th>结算时间</th><th>状态</th></tr></thead><tfoot><tr><th>ID</th><th>商户号</th><th>姓名</th><th>结算账号</th><th>结算金额</th><th>备注</th><th>转账状态</th><th>状态信息</th><th>结算时间</th><th>状态</th></tr></tfoot>
                <tbody>
                  <?php
                    foreach($rs as $res){
                    echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['pid'].'</td><td>'.$res['username'].'</td><td>'.$res['account'].'</td><td>'.$res['money'].'</td><td>'.$res['bz'].'</td><td>'.($res['transfer_status']==1?'<font color=green>成功</font>':'<font color=red>失败</font>').'</td><td>'.$res['transfer_result'].'</td><td>'.$res['transfer_date'].'</td><td>'.($res['status']==1?'<font color=green>已完成</font>':'<font color=red>未完成</font>').'</td></tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>