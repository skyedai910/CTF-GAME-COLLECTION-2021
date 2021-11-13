<?php
$mod='blank';
include("../includes/common.php");
$title='盈利费率配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的盈利费率已修改成功！');window.location.href='./op_ylfl.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">盈利费率配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">盈利费率配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">盈利费率配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_ylfl.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">QQ每笔交易费率（百分数）:</label><input type="text"name="qqrate"value="<?php echo $conf['qqrate']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">微信每笔交易费率（百分数）:</label><input type="text"name="wxrate"value="<?php echo $conf['wxrate']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">支付宝每笔交易费率（百分数）:</label><input type="text"name="alirate"value="<?php echo $conf['alirate']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">财付通每笔交易费率（百分数）:</label><input type="text"name="tenrate"value="<?php echo $conf['tenrate']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">每天满多少元自动结算:</label><input type="text"name="settle_money"value="<?php echo $conf['settle_money']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">结算费率:</label><input type="text"name="settle_rate"value="<?php echo $conf['settle_rate']; ?>"class="form-control"required/><small>实际费率为<?php $a=100;$b=$conf['settle_rate'];echo $a*$b?>%</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">结算手续费最小:</label><input type="text"name="settle_fee_min"value="<?php echo $conf['settle_fee_min']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">结算手续费最大:</label><input type="text"name="settle_fee_max"value="<?php echo $conf['settle_fee_max']; ?>"class="form-control"required/></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>