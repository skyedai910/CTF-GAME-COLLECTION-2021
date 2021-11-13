<?php
$mod='blank';
include("../includes/common.php");
$title='维护信息配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的维护信息已修改成功！');window.location.href='./op_jkwh.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">维护信息配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">接口设置</a></li><li class="breadcrumb-item active" aria-current="page">维护信息配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">维护信息配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_jkwh.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">支付宝维护提示:</label><textarea name="ali_close_info" rows="2" class="form-control"><?php echo $conf['ali_close_info']; ?></textarea></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">微信维护提示:</label><textarea name="wx_close_info" rows="2" class="form-control"><?php echo $conf['wx_close_info']; ?></textarea></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">QQ维护提示:</label><textarea name="qq_close_info" rows="2" class="form-control"><?php echo $conf['qq_close_info']; ?></textarea></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">财付通维护提示:</label><textarea name="ten_close_info" rows="2" class="form-control"><?php echo $conf['ten_close_info']; ?></textarea></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>