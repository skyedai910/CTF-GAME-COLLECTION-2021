<?php
$mod='blank';
include("../includes/common.php");
$title='站点信息配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的站点信息已修改成功！');window.location.href='./op_webset.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">站点信息配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">站点信息配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">站点信息配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_webset.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">网站名称:</label><input type="text"name="web_name"class="form-control"value="<?php echo $conf['web_name']; ?>"required><small>显示调用数据库表"['web_name']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">站点URL:</label><input type="text"name="local_domain"class="form-control"value="<?php echo $conf['local_domain']; ?>"required><small>显示调用数据库表"['local_domain']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">站点备案号:</label><input type="text"name="beian"class="form-control"value="<?php echo $conf['beian']; ?>"required><small>显示调用数据库表"['beian']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">极验CAPTCHA_ID:</label><input type="text"name="CAPTCHA_ID"class="form-control"value="<?php echo $conf['CAPTCHA_ID']; ?>"required><small>显示调用数据库表"['CAPTCHA_ID']"（留空用户将无法修改商户信息及使用手机号注册商户）</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">极验PRIVATE_KEY:</label><input type="text"name="PRIVATE_KEY"class="form-control"value="<?php echo $conf['PRIVATE_KEY']; ?>"required><small>显示调用数据库表"['PRIVATE_KEY']"（留空用户将无法修改商户信息及使用手机号注册商户）</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">客服QQ:</label><input type="text"name="web_qq"class="form-control"value="<?php echo $conf['web_qq']; ?>"required><small>显示调用数据库表"['web_qq']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">商户群号:</label><input type="text"name="shqh"class="form-control"value="<?php echo $conf['shqh']; ?>"required><small>显示调用数据库表"['shqh']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">商户群链接:</label><input type="text"name="qun"class="form-control"value="<?php echo $conf['qun']; ?>"required><small>显示调用数据库表"['qun']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">SDK下载地址:</label><input type="text"name="sdk"class="form-control"value="<?php echo $conf['sdk']; ?>"required><small>显示调用数据库表"['sdk']"</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">商户密钥验证错误提示内容:</label><textarea name="key_no"rows="3"class="form-control"><?php echo $conf['key_no'];?></textarea><small>此内容强烈建议填写，否则支付时商户密钥验证错误弹出阻断页中提示内容为空，容易误导用户！</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">已封禁商户提示内容:</label><textarea name="user_no"rows="3"class="form-control"><?php echo $conf['user_no'];?></textarea><small>此内容强烈建议填写，否则已封禁账户登录及支付时弹出阻断页中提示内容为空，容易误导用户！</small></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">网站运营开关:</label><select class="form-control"name="web_is"default="<?php echo $conf['web_is']?>"><option value="0">正常运营</option><option value="1">停止运营</option></select></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>