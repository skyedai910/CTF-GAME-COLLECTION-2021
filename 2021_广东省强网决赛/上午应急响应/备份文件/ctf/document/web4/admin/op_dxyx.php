<?php
$mod='blank';
include("../includes/common.php");
$title='短信邮箱配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的短信邮箱信息已修改成功！');window.location.href='./op_dxyx.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">短信邮箱配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">短信邮箱配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">短信邮箱配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_dxyx.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">发信方式:</label><select class="form-control" name="mail_cloud" default="<?php echo $conf['mail_cloud']?>"><option value="1">sendcloud</option><option value="0">SMTP</option></select></div></div><?php if($conf['mail_cloud']==0){?><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">SMTP地址:</label><input type="text"name="mail_smtp"value="<?php echo $conf['mail_smtp']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">SMTP端口:</label><input type="text"name="mail_port"value="<?php echo $conf['mail_port']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">邮箱账号:</label><input type="text"name="mail_name"value="<?php echo $conf['mail_name']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">邮箱密码（QQ邮箱为授权码）:</label><input type="text"name="mail_pwd"value="<?php echo $conf['mail_pwd']; ?>"class="form-control"required/></div></div><?php }else{ ?><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">API_USER:</label><input type="text"name="mail_apiuser"value="<?php echo $conf['mail_apiuser']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">API_KEY:</label><input type="text"name="mail_apikey"value="<?php echo $conf['mail_apikey']; ?>"class="form-control"required/></div></div><?php } ?><hr/><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">短信接口密钥:</label><input type="text"name="sms_appkey"value="<?php echo $conf['sms_appkey']; ?>"class="form-control"required/><small>开启短信验证服务需前往admin.978w.cn注册账号并充值余额，接口密钥在［我的接口］页面获取，非必须配置，还是推荐邮箱验证。</small></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>