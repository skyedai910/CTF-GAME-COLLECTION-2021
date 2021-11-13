<?php
$mod='blank';
include("../includes/common.php");
$title='商户登录配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的商户登录信息已修改成功！');window.location.href='./op_shdl.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">商户登录配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">商户登录配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">商户登录配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_shdl.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">是否允许商户登录:</label><select class="form-control"name="login_is"default="<?php echo $conf['login_is']?>"><option value="0">允许登录</option><option value="1">禁止登录</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">禁止登录提示信息:</label><textarea name="login_offtext"rows="3"class="form-control"><?php echo $conf['login_offtext'];?></textarea></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">登录页公告:</label><textarea name="logingg"rows="3"class="form-control"><?php echo $conf['logingg'];?></textarea></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">快捷登录方式:</label><select class="form-control"name="quicklogin"default="<?php echo $conf['quicklogin']?>"><option value="0">全部开启</option><option value="1">支付宝快捷登录</option><option value="2">QQ快捷登录</option><option value="3">关闭快捷登录</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">支付宝应用APPID:</label><input type="text"name="alipay_appid"value="<?php echo $conf['alipay_appid']; ?>"class="form-control"required/><small>QQ应用配置请修改includes/QC.conf.php</small></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>