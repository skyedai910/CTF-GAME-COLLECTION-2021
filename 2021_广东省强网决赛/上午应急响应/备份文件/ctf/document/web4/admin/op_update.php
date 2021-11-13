<?php
include("../includes/common.php");
$title='检查版本更新';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if($_SESSION['connet']!=true){
	if(file_get_contents('http://auth.ccxyu.com/')){//服务器系统
		$connect='<font color="green">连接正常</font>';
		$_SESSION['connet']==true;//防止过多访问造成卡顿
	}else{
		$connect='<font color="red">连接失败</font>';
		$_SESSION['connet']==true;//防止过多访问造成卡顿 直接结束
	}
}
if($_SESSION['connet']!=true){
	if(file_get_contents('http://auth.ccxyu.com/')){//服务器系统
		$connect2='<font color="green">连接正常</font>';
		$_SESSION['connet']==true;//防止过多访问造成卡顿
	}else{
		$connect2='<font color="red">连接失败</font>';
		$_SESSION['connet']==true;//防止过多访问造成卡顿 直接结束
	}
}
?>
<?php
	//解压函数
	function zipExtract ($src,$dest){
		$zip=new ZipArchive();
		if($zip->open($src)===true){
			$zip->extractTo($dest);
			$zip->close();
			return true;
		}
		return false;
	}
?>
<!-- 
 * =======================================================
 * O泡易支付系统：www.xsq6.com  AuthQQ：2871583806
 * =======================================================
-->
	<div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">检查版本更新</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">系统配置</a></li><li class="breadcrumb-item active" aria-current="page">检查版本更新</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">检查版本更新</h3>
              </div>
              <!-- Card body -->
       <div class="card-body">
	   <small><?php echo file_get_contents("http://www.xsq6.com/update.txt");?></small><hr>
       
<div class="alert alert-info">站长您好</p>
授权系统检测到您网站未授权</p>
授权联系QQ:2871583806</p>
正版特惠28RMB</p>
<font color='red'><a href="http://www.xsq6.com/">点我进入正版授权官网</a></font></p>
<a id="color_href" href="http://wpa.qq.com/msgrd?v=3&uin=287158806&site=qq&menu=yes">点我联系O泡授权</a></div></div></div></div></div>
 <div class="col-xl-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">授权连接信息</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
			   <thead class="thead-light"><tr><th scope="col">O泡易支付系统</th><th scope="col">信息详情</th><th scope="col">操作</th></tr></thead>
			   <tbody>
			    <tr><th scope="row">O泡授权服务器：</th><td><?php echo $connect?></td><td><a href="http://www.xsq6.com/"><font color="green">查看</font></a></td></tr>
			    <tr><th scope="row">O泡主控服务器：</th><td><?php echo $connect2?></td><td><a href="http://www.xsq6.com/"><font color="green">查看</font></a></td></tr>
			   </tbody>
              </table>
            </div>
          </div>
 </div>
</div>
<?php include 'foot.php';?>