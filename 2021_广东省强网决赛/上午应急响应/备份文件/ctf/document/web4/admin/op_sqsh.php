<?php
$mod='blank';
include("../includes/common.php");
$title='申请商户配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的配置信息已修改成功！');window.location.href='./op_sqsh.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">申请商户配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">申请商户配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">申请商户配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_sqsh.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">是否开启自助申请商户:</label><select class="form-control" name="is_reg" default="<?php echo $conf['is_reg']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">是否开启商户付费申请:</label><select class="form-control" name="is_payreg" default="<?php echo $conf['is_payreg']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">关闭自助申请商户提示信息:</label><textarea name="reg_offtext" rows="3" class="form-control"><?php echo $conf['reg_offtext']; ?></textarea></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">注册页公告:</label><textarea name="reggg"rows="3"class="form-control"><?php echo $conf['reggg'];?></textarea></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">付费申请收款商户ID:</label><input type="text"name="reg_pid"value="<?php echo $conf['reg_pid']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">商户申请价格:</label><input type="text"name="reg_price"value="<?php echo $conf['reg_price']; ?>"class="form-control"required/></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">验证方式:</label><select class="form-control" name="verifytype" default="<?php echo $conf['verifytype']?>"><option value="0">邮箱验证</option><option value="1">手机验证</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">是否开启支付宝结算:</label><select class="form-control" name="stype_1" default="<?php echo $conf['stype_1']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">是否开启微信结算:</label><select class="form-control" name="stype_2" default="<?php echo $conf['stype_2']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">是否开启QQ钱包结算:</label><select class="form-control" name="stype_3" default="<?php echo $conf['stype_3']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">是否开启银行卡结算:</label><select class="form-control" name="stype_4" default="<?php echo $conf['stype_4']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>