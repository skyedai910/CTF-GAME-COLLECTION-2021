<?php
include("../includes/common.php");
$title='易支付配置';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
header("Content-type: text/html; charset=utf-8");
if(isset($_POST['submit'])) {
    foreach ($_POST as $x => $value) {
        if($x=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into opao_config set `x`='{$x}',`j`='{$value}' on duplicate key update `j`='{$value}'");
    }
    echo "<script language='javascript'>alert('报告老大，您的接口信息已修改成功！');window.location.href='./op_yzf.php';</script>";
    exit();
}
if(empty($conf['ali_epay_api_id'])||$conf['ali_epay_api_id']==''||empty($conf['ali_epay_api_key'])||$conf['ali_epay_api_key']==''){
    $cyzt1 = "非法参数或不正确！";
}else{
    $post1 = json_decode(curl_get($conf['ali_epay_api_url'].'api.php?act=query&pid='.$conf['ali_epay_api_id'].'&key='.$conf['ali_epay_api_key']),1);
    $cyzt1 = "获取成功！";
    if($post1[code]=='1'){
    }else{
        $cyzt1 = "连接失败！";
    }
}
if(empty($conf['wx_epay_api_id'])||$conf['wx_epay_api_id']==''||empty($conf['wx_epay_api_key'])||$conf['wx_epay_api_key']==''){
    $cyzt2 = "非法参数或不正确！";
}else{
    $post2 = json_decode(curl_get($conf['wx_epay_api_url'].'api.php?act=query&pid='.$conf['wx_epay_api_id'].'&key='.$conf['wx_epay_api_key']),1);
    $cyzt2 = "获取成功！";
    if($post2[code]=='1'){
    }else{
        $cyzt2 = "连接失败！";
    }
}
if(empty($conf['qq_epay_api_id'])||$conf['qq_epay_api_id']==''||empty($conf['qq_epay_api_key'])||$conf['qq_epay_api_key']==''){
    $cyzt3 = "非法参数或不正确！";
}else{
    $post3 = json_decode(curl_get($conf['qq_epay_api_url'].'api.php?act=query&pid='.$conf['qq_epay_api_id'].'&key='.$conf['qq_epay_api_key']),1);
    $cyzt3 = "获取成功！";
    if($post3[code]=='1'){
    }else{
        $cyzt3 = "连接失败！";
    }
}
if(empty($conf['ten_epay_api_id'])||$conf['ten_epay_api_id']==''||empty($conf['ten_epay_api_key'])||$conf['ten_epay_api_key']==''){
    $aszt4 = "非法参数或不正确！";
}else{
    $post4 = json_decode(curl_get($conf['ten_epay_api_url'].'api.php?act=query&pid='.$conf['ten_epay_api_id'].'&key='.$conf['ten_epay_api_key']),1);
    $aszt4 = "获取成功！";
    if($post4[code]=='1'){
    }else{
        $aszt4 = "连接失败！";
    }
}
?>
<!-- 森度易支付:pay.sd129.cn -->
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">易支付配置</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">接口设置</a></li><li class="breadcrumb-item active" aria-current="page">易支付配置</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">  
	  <div class="row">
       <div class="col-xl-6">
	    <div class="card-wrapper">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">官方商家推荐</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush"><thead class="thead-light"><tr><th sccye="col">名称</th><th sccye="col">星级</th><th sccye="col">操作</th></tr></thead>
			  <tbody><?php echo file_get_contents("../yzf.txt");?></tbody>
              </table>
            </div>
          </div>
		</div>
	    <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">易支付接口调用状态</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-8"><p class="mb-0"><code>温馨提示：</code>请时刻留意对接信息是否被篡改，如发现异常，请及时联系上家修改！</p></div>
                </div><hr>
                <li class='list-group-item'><b>当前支付宝接口：</b><?php echo $conf['ali_epay_api_url']?> <a href="<?php echo $conf['ali_epay_api_url']?>"class="btn btn-danger">点此访问</a></li><li class='list-group-item'><b>获取状态：</b><?php echo $cyzt1?><br/><b>余额：</b><?php echo $post1[money]?>元<br/><b>结算账号：</b><?php echo $post1[account]?><br/><b>结算姓名：</b><?php echo $post1[username]?></li><li class='list-group-item'><b>当前微信支付接口：</b><?php echo $conf['wx_epay_api_url']?> <a href="<?php echo $conf['wx_epay_api_url']?>"class="btn btn-danger">点此访问</a></li><li class='list-group-item'><b>获取状态：</b><?php echo $cyzt2?><br/><b>余额：</b><?php echo $post2[money]?>元<br/><b>结算账号：</b><?php echo $post2[account]?><br/><b>结算姓名：</b><?php echo $post2[username]?></li><li class='list-group-item'><b>当前QQ钱包接口：</b><?php echo $conf['qq_epay_api_url']?> <a href="<?php echo $conf['qq_epay_api_url']?>"class="btn btn-danger">点此访问</a></li><li class='list-group-item'><b>获取状态：</b><?php echo $cyzt3?><br/><b>余额：</b><?php echo $post3[money]?>元<br/><b>结算账号：</b><?php echo $post3[account]?><br/><b>结算姓名：</b><?php echo $post3[username]?></li><li class='list-group-item'><b>当前财付通接口：</b><?php echo $conf['ten_epay_api_url']?> <a href="<?php echo $conf['ten_epay_api_url']?>"class="btn btn-danger">点此访问</a></li><li class='list-group-item'><b>获取状态：</b><?php echo $aszt4?><br/><b>余额：</b><?php echo $post4[money]?>元<br/><b>结算账号：</b><?php echo $post4[account]?><br/><b>结算姓名：</b><?php echo $post4[username]?></li>
              </div>
            </div>
        </div>
       </div>
       <div class="col-xl-6">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">易支付配置</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form class="needs-validation"action="./op_yzf.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">支付宝接口地址:</label><input type="text"name="ali_epay_api_url"class="form-control"value="<?php echo $conf['ali_epay_api_url']; ?>"></div><div class="col-md-12 mb-3"><label class="form-control-label">支付宝接口商户ID:</label><input type="text"name="ali_epay_api_id"class="form-control"value="<?php echo $conf['ali_epay_api_id']; ?>"></div><div class="col-md-12 mb-3"><label class="form-control-label">支付宝接口商户密钥:</label><input type="text"name="ali_epay_api_key"class="form-control"value="<?php echo $conf['ali_epay_api_key']; ?>"></div></div><hr/><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">微信支付接口地址:</label><input type="text"name="wx_epay_api_url"class="form-control"value="<?php echo $conf['wx_epay_api_url']; ?>"></div><div class="col-md-12 mb-3"><label class="form-control-label">微信支付接口商户ID:</label><input type="text"name="wx_epay_api_id"class="form-control"value="<?php echo $conf['wx_epay_api_id']; ?>"></div><div class="col-md-12 mb-3"><label class="form-control-label">微信支付接口商户密钥:</label><input type="text"name="wx_epay_api_key"class="form-control"value="<?php echo $conf['wx_epay_api_key']; ?>"></div></div><hr/><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">QQ钱包接口地址:</label><input type="text"name="qq_epay_api_url"class="form-control"value="<?php echo $conf['qq_epay_api_url']; ?>"></div><div class="col-md-12 mb-3"><label class="form-control-label">QQ钱包接口商户ID:</label><input type="text"name="qq_epay_api_id"class="form-control"value="<?php echo $conf['qq_epay_api_id']; ?>"></div><div class="col-md-12 mb-3"><label class="form-control-label">QQ钱包接口商户密钥:</label><input type="text"name="qq_epay_api_key"class="form-control"value="<?php echo $conf['qq_epay_api_key']; ?>"></div></div><hr/><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">财付通接口地址:</label><input type="text"name="ten_epay_api_url"class="form-control"value="<?php echo $conf['ten_epay_api_url']; ?>"></div><div class="col-md-12 mb-3"><label class="form-control-label">财付通接口商户ID:</label><input type="text"name="ten_epay_api_id"class="form-control"value="<?php echo $conf['ten_epay_api_id']; ?>"></div><div class="col-md-12 mb-3"><label class="form-control-label">财付通接口商户密钥:</label><input type="text"name="ten_epay_api_key"class="form-control"value="<?php echo $conf['ten_epay_api_key']; ?>"></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已确保为本人修改信息</label></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定修改</button>
                </form>
              </div>
            </div>
          </div>
        </div>
     </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>