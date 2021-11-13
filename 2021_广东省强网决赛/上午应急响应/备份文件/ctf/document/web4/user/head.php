<?php
@header('Content-Type: text/html; charset=UTF-8');
if($userrow['active']==0){
  sysmsg($conf['user_no']);
}
?>
<!-- opao.kucat.cn -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $conf['web_name']?>">
  <title><?php echo $title?> - <?php echo $conf['web_name']?></title>
  <meta name="keywords" content="<?php echo $conf['web_name']?>">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/fortawesome.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/css/opao.min.css" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
</head>
<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="index.php" style="font-weight: bold;color: bule"><?php echo $conf['web_name']?></a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
		    <li class="nav-item"><a class="nav-link"href="./"><i class="ni ni-compass-04 text-primary"></i><span class="nav-link-text">商户中心</span></a></li>
			<li class="nav-item"><a class="nav-link"href="#dingdanyujiesuanleft"data-toggle="collapse"role="button"aria-expanded="false"aria-controls="navbar-examples"><i class="ni ni-calendar-grid-58 text-orange"></i>
			 <span class="nav-link-text">订单与结算</span></a>
			 <div class="collapse"id="dingdanyujiesuanleft">
			 <ul class="nav nav-sm flex-column">
			  <li class="nav-item"><a href="order.php"class="nav-link">订单明细</a></li>
			  <li class="nav-item"><a href="settle.php"class="nav-link">结算明细</a></li>
			  <li class="nav-item"><a href="alisettle.php"class="nav-link">实时明细</a></li>
			  <li class="nav-item"><a href="apply.php"class="nav-link">手动结算</a></li>
			 </ul>
			 </div>
			</li>
			<li class="nav-item"><a class="nav-link"href="test.php"><i class="ni ni-atom text-green"></i><span class="nav-link-text">在线测试</span></a></li>
			<li class="nav-item"><a class="nav-link"href="tgfl.php"><i class="ni ni-like-2 text-pink"></i><span class="nav-link-text">推广返利</span></a></li>
			<li class="nav-item"><a class="nav-link"href="phb.php"><i class="ni ni-chart-bar-32 text-info"></i><span class="nav-link-text">商户排行</span></a></li>
			<li class="nav-item"><a class="nav-link"onclick="return confirm('请在进群验证信息中填写您的商户ID，点击确定立即加群！')"href="<?php echo $conf['qun']?>"target="blank"><i class="ni ni-hat-3 text-default"></i><span class="nav-link-text">商户群聊</span></a></li>
        	</ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">集成包下载</h6>
          <ul class="navbar-nav mb-md-3"><li class="nav-item"><a class="nav-link"onclick="return confirm('您将要下载易支付系统集成包文件，点击确定开始下载！')"href="<?php echo $conf['sdk']?>"target="_blank"><i class="ni ni-diamond"></i><span class="nav-link-text">三网对接</span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-<?php echo $conf['usermb_ys']?> border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- 搜索框 -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3"id="navbar-search-main"action="https://www.baidu.com/s?ie=utf-8&"><div class="form-group mb-0"><div class="input-group input-group-alternative input-group-merge"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search"></i></span></div><input class="form-control"placeholder="百度一下,你就知道"type="text"name="wd"></div></div><button type="button"class="close"data-action="search-close"data-target="#navbar-search-main"aria-label="Close"><span aria-hidden="true">×</span></button>
          </form>
          <!-- 工具栏 -->
          <ul class="navbar-nav align-items-center ml-md-auto"><li class="nav-item d-xl-none"><!--Sidenav toggler--><div class="pr-3 sidenav-toggler sidenav-toggler-dark"data-action="sidenav-pin"data-target="#sidenav-main"><div class="sidenav-toggler-inner"><i class="sidenav-toggler-line"></i><i class="sidenav-toggler-line"></i><i class="sidenav-toggler-line"></i></div></div></li><li class="nav-item d-sm-none"><a class="nav-link"href="#"data-action="search-show"data-target="#navbar-search-main"><i class="ni ni-zoom-split-in"></i></a></li>
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0"><li class="nav-item dropdown"><a class="nav-link pr-0"href="#"role="button"data-toggle="dropdown"aria-haspopup="true"aria-expanded="false"><div class="media align-items-center"><span class="avatar avatar-sm rounded-circle"><img alt="Avatar"src="<?php echo ($userrow['qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'./assets/images/user.png'?>"></span><div class="media-body ml-2 d-none d-lg-block"><span class="mb-0 text-sm font-weight-bold"><?php echo $userrow['username']?></span></div></div></a><div class="dropdown-menu dropdown-menu-right"><div class="dropdown-header noti-title"><h6 class="text-overflow m-0">欢迎使用<?php echo $conf['web_name']?>!</h6></div><a href="userinfo.php"class="dropdown-item"><i class="ni ni-single-02"></i><span>朕的资料</span></a><a href="order.php"class="dropdown-item"><i class="ni ni-calendar-grid-58"></i><span>订单明细</span></a><div class="dropdown-divider"></div><a href="login.php?logout"class="dropdown-item"><i class="ni ni-user-run"></i><span>钱圈够了，赶紧溜！</span></a></div></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header结束 -->
    <?php if(isset($msg)){?>
    <div class="alert alert-info">
    <?php echo $msg?>
    </div>
    <?php }?>