<?php
include("../includes/common.php");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="O泡安全支付系统,免签支付接口">
  <meta name="description" content="O泡安全支付系统专为行业各大程序系统，提供优质的支付集成一键对接！">
  <meta name="author" content="opao.kucat.cn">
  <title><?php echo $conf['web_name']?>- 会支付会生活</title>
  <link rel="shortcut icon" href="/favicon.ico" />
  <link rel="apple-touch-icon" sizes="76x76" href="/favicon.ico">
  <link rel="stylesheet" href="../assets/css/opao.min.css" type="text/css">
  <style type="text/css">.row {margin:0;}</style>
</head>
<body>
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="./"><?php echo $conf['web_name']?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./"><?php echo $conf['web_name']?></a>
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
            <a onclick="return confirm('请直奔主题,不要问在不在,节省彼此的时间,懂?')" href="http://wpa.qq.com/msgrd?v=3&uin=435184519&site=qq&menu=yes" class="nav-link">
              <span class="nav-link-inner--text">联系客服</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pt-5 pb-7">
      <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
            <h1 class="text-white">服务条款</h1>
            <p class="text-lead text-white">请使用本支付系统前，先认真阅读商户服务条款，O泡安全支付有权力随时更新条款，请您严格遵守我们服务条款内的条约，注册商户后则默认代表您已同意我们的服务条款。</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="row" style="overflow-y:auto">
          <div class="col-lg-12">
          <?php echo $conf['agreement']; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2020 <a href="./" class="font-weight-bold ml-1" target="_blank">O泡支付系统</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="http://beian.miit.gov.cn/" class="nav-link" target="_blank">备案号：蜀ICP备100000000号</a>
            </li>
            <li class="nav-item">
              <a href="https://pay.sd129.cn" class="nav-link" target="_blank">KuCat</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
          