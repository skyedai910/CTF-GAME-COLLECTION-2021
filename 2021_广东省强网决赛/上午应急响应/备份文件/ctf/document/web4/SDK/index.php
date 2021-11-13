<?php
include("../includes/common.php");
if($conf['sdk_is']==0)sysmsg('在线测试支付页面已关闭，如有疑问请联系站点管理员！');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $conf['web_name']?>">
  <title>在线测试 - <?php echo $conf['web_name']?></title>
  <meta name="keywords" content="<?php echo $conf['web_name']?>">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.axiwl.com/assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="https://cdn.axiwl.com/assets/css/fortawesome.css" type="text/css">
  <link rel="stylesheet" href="https://cdn.axiwl.com/assets/css/open.min.css" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
</head>
<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="/"><?php echo $conf['web_name']?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/"><?php echo $conf['web_name']; ?></a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="/user/agreement.php" class="nav-link">
              <span class="nav-link-inner--text">服务条款</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/doc.php" class="nav-link">
              <span class="nav-link-inner--text">开发文档</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/user/login.php" class="nav-link">
              <span class="nav-link-inner--text">商户登录</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/user/reg.php" class="nav-link">
              <span class="nav-link-inner--text">商户注册</span>
            </a>
          </li>
          <li class="nav-item">
            <a onclick="return confirm('有事请直奔主题,不要问在不在')" href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['web_qq']; ?>&site=qq&menu=yes" class="nav-link">
              <span class="nav-link-inner--text">联系客服</span>
            </a>
          </li>
        </ul>
   
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-<?php echo $conf['usermb_ys']?> py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white"><?php echo $conf['web_name']?></h1>
              <p class="text-lead text-white">您好，欢迎体验<?php echo $conf['web_name']?>在线测试功能</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>请您不要恶意提交测试,我们有权利追究责任!</small>
              </div>
              <form method="post" action="epayapi.php" role="form"> 
                <div class="form-group mb-2">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i>订单编号</span>
                    </div>
                    <input class="form-control" placeholder="商户订单号" value="<?php echo date("YmdHis").mt_rand(100,999); ?>" name="WIDout_trade_no" type="text" readonly="readonly">
                  </div>
                </div>
                <div class="form-group mb-2">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i>商品名称</span>
                    </div>
                    <input class="form-control" placeholder="商品名称" value="日用百货" name="WIDsubject" type="text" readonly="readonly">
                  </div>
                </div>
                <div class="form-group mb-2">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i>付款金额</span>
                    </div>
                    <input class="form-control" placeholder="付款金额" value="<?php echo mt_rand(1,10);?>" name="WIDtotal_fee" type="text" >
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">同意<a href="../user/agreement.php">商户服务协议</a></span>
                  </label>
                </div>
               <div class="text-center">
                  <button type="radio" value="qqpay" name="type" class="btn btn-<?php echo $conf['usermb_ys']?> my-3">QQ钱包</button><button type="radio" value="wxpay" name="type" class="btn btn-<?php echo $conf['usermb_ys']?> my-3">微信支付</button><button type="radio" value="alipay" name="type" class="btn btn-<?php echo $conf['usermb_ys']?> my-3">支付宝</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-3" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; <?=date('Y')?> <a href="/" class="font-weight-bold ml-1" target="_blank"><?php echo $conf['web_name']; ?></a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="http://beian.miit.gov.cn/" class="nav-link" target="_blank">备案号：<?php echo $conf['beian']; ?></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
<script src="https://cdn.axiwl.com/assets/js/jquery.min.js"></script>
<script src="https://cdn.axiwl.com/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>