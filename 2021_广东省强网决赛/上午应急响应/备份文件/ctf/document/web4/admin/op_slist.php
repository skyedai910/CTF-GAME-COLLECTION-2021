<?php
$mod='blank';
include("../includes/common.php");
$title='结算列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
function display_type($type){
	if($type==1)
		return '支付宝';
	elseif($type==2)
		return '微信';
	elseif($type==3)
		return 'QQ钱包';
	elseif($type==4)
		return '银行卡';
	else
		return 1;
}
$numrows=$DB->query("SELECT * from pay_settle WHERE 1")->rowCount();
$rs=$DB->query("SELECT * FROM pay_settle WHERE 1 order by id desc limit 0,$numrows");
?>
		<div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">结算列表</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">资金管理</a></li><li class="breadcrumb-item active" aria-current="page">结算列表</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                结算列表
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows ?></b> 笔结算记录
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>ID</th><th>商户号</th><th>结算方式</th><th>结算账号/姓名</th><th>结算金额/手续费</th><th>结算时间</th><th>状态</th></tr></thead><tfoot><tr><th>ID</th><th>商户号</th><th>结算方式</th><th>结算账号/姓名</th><th>结算金额/手续费</th><th>结算时间</th><th>状态</th></tr></tfoot>
                <tbody>
                  <?php
                    foreach($rs as $res){
                    echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['pid'].'</td><td>'.display_type($res['type']).'</td><td>'.$res['account'].'&nbsp;'.$res['username'].'</td><td><b>'.$res['money'].'</b>&nbsp;/&nbsp;<b>'.$res['fee'].'</b></td><td>'.$res['time'].'</td><td>'.($res['status']==1?'<font color=green>已完成</font>':'<font color=blue>未完成</font>').'</td></tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>