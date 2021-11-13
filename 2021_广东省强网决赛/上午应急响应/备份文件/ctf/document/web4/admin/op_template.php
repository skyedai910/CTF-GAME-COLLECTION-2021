<?php
$mod='blank';
include("../includes/common.php");
$title='首页模板配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的首页模板信息已修改成功！');window.location.href='./op_template.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">首页模板配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">其他配置</a></li><li class="breadcrumb-item active" aria-current="page">首页模板配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">首页模板配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-8"><p class="mb-0"><code>当前使用模板目录：</code>站点根目录/includes/template/<?php echo $conf['template']?><br/><code>温馨提示：</code>如需更改模板，请自行进入模板目录修改，感谢您的支持！</p></div>
                </div><hr>
                	<div class="form-group">
	               <label class="form-control-label">模板预览图片:</label><br><img src="<?php echo '../template/'.$conf['template'].'/demo.png' ?>" style="max-width:100%"></div><hr>
                <form class="needs-validation"action="./op_template.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">首页模板切换:</label><select class="form-control" name="template" default="<?php echo $conf['template']?>"><?php echo file_get_contents("../muban.txt")?>;</select></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button><hr><a href="../index.php"<button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control">预览模板</a></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>