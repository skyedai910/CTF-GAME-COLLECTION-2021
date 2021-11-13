<?php
$mod='blank';
include("../includes/common.php");
$title='系统监控配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的系统监控信息已修改成功！');window.location.href='./op_jkset.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">系统监控配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">系统监控配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">系统监控配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_jkset.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">监控识别码配置:</label><input type="text"name="cron_key"class="form-control"value="<?php echo $conf['cron_key']; ?>"required></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">系统监控说明</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-12"><p class="mb-0"><code>温馨提示：</code>如需开启第四方易支付接口自动补单监控，请在监控前修改“/includes/cron/”目录对应文件中的提示部分（即接口地址、商户ID、商户密钥），不修改监控无效！<br/>如果您所有接口都是对接的同一家易支付平台，则只需要监控其中的一个自动补单功能即可！</p></div>
                </div><hr>
                <li class="list-group-item"><b>余额监控地址：</b>http://<?php echo $_SERVER['HTTP_HOST']; ?>/includes/cron/cron.php?key=<?php echo $conf['cron_key']; ?> <a href="/includes/cron/cron.php?key=<?php echo $conf['cron_key']; ?>" target="_blank" class="btn btn-sm btn-danger">点此访问</a></li>
                <li class="list-group-item"><b>结算监控地址：</b>http://<?php echo $_SERVER['HTTP_HOST']; ?>/includes/cron/cron.php?key=<?php echo $conf['cron_key']; ?>&do=settle <a href="/includes/cron/cron.php?key=<?php echo $conf['cron_key']; ?>&do=settle" target="_blank" class="btn btn-sm btn-danger">点此访问</a></li>
                <li class="list-group-item"><b>支付宝自动补单监控：</b>http://<?php echo $_SERVER['HTTP_HOST']; ?>/includes/cron/budan_alipay.php?key=<?php echo $conf['cron_key']; ?> <a href="/includes/cron/budan_alipay.php?key=<?php echo $conf['cron_key']; ?>" target="_blank" class="btn btn-sm btn-danger">点此访问</a></li>
                <li class="list-group-item"><b>微信自动补单监控：</b>http://<?php echo $_SERVER['HTTP_HOST']; ?>/includes/cron/budan_wxpay.php?key=<?php echo $conf['cron_key']; ?> <a href="/includes/cron/budan_wxpay.php?key=<?php echo $conf['cron_key']; ?>" target="_blank" class="btn btn-sm btn-danger">点此访问</a></li>
                <li class="list-group-item"><b>QQ自动补单监控：</b>http://<?php echo $_SERVER['HTTP_HOST']; ?>/includes/cron/budan_qqpay.php?key=<?php echo $conf['cron_key']; ?> <a href="/includes/cron/budan_qqpay.php?key=<?php echo $conf['cron_key']; ?>" target="_blank" class="btn btn-sm btn-danger">点此访问</a></li>
                <li class="list-group-item"><b>财付通自动补单监控：</b>http://<?php echo $_SERVER['HTTP_HOST']; ?>/includes/cron/budan_tenpay.php?key=<?php echo $conf['cron_key']; ?> <a href="/includes/cron/budan_tenpay.php?key=<?php echo $conf['cron_key']; ?>" target="_blank" class="btn btn-sm btn-danger">点此访问</a></li>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>