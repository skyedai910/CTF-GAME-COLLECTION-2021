<?php
$mod='blank';
include("../includes/common.php");
$title='功能模块配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的功能模块已修改成功！');window.location.href='./op_webgn.php';</script>";
    exit();
}
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">功能模块配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">功能模块配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">功能模块配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_webgn.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">商户排行模块:</label><select class="form-control"name="phb_open"default="<?php echo $conf['phb_open']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">QQ防红模块:</label><select class="form-control" name="qqtz" default="<?php echo $conf['qqtz']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">在线测试模块:</label><select class="form-control"name="sdk_is"default="<?php echo $conf['sdk_is']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">推广返利模块:</label><select class="form-control"name="yq_open"default="<?php echo $conf['yq_open']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><?php if($conf['yq_open']!=1){?><div id="yqfl" style="display: none;" ><?php }else{ ?><div id="yqfl" style="display: block;" ><?php } ?><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">*推广返利佣金:</label><input type="text"name="price"value="<?php echo $conf['price']; ?>"class="form-control"></div></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">手动结算模块:</label><select class="form-control" name="settle_open" default="<?php echo $conf['settle_open']?>"><option value="0">关闭</option><option value="1">开启</option></select></div></div><?php if($conf['settle_open']!=1){?><div id="sdjs" style="display: none;" ><?php }else{ ?><div id="sdjs" style="display: block;" ><?php } ?><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">*手动结算最低金额:</label><input type="text"name="sdtx_money_min"value="<?php echo $conf['sdtx_money_min']; ?>"class="form-control"></div></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>
$("select[name=\'yq_open\']").change(function(){
	if($(this).val() == 0){
		$("#yqfl").css("display","none");
	}else{
		$("#yqfl").css("display","inherit");
	}
});
$("select[name=\'settle_open\']").change(function(){
	if($(this).val() == 0){
		$("#sdjs").css("display","none");
	}else{
		$("#sdjs").css("display","inherit");
	}
});
</script>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>