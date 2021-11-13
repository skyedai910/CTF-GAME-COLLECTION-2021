<?php
//php防注入和XSS攻击通用过滤. 
$_GET     && SafeFilter($_GET);
$_POST    && SafeFilter($_POST);
$_COOKIE  && SafeFilter($_COOKIE);
function SafeFilter (&$arr){
  $ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');
  if (is_array($arr)){
    foreach ($arr as $key => $value){
      if(!is_array($value)){
        if (!get_magic_quotes_gpc()){             //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
          $value=addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
        }
        $value=preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
        $arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
      }else{
        SafeFilter($arr[$key]);
      }
    }
  }
}
$is_defend=true;
include("../includes/common.php");
if(isset($_POST['user']) && isset($_POST['pass'])){
    $user=daddslashes($_POST['user']);
    $pass=daddslashes($_POST['pass']);
    $userrow=$DB->query("SELECT * FROM pay_user WHERE id='{$user}' limit 1")->fetch();
    if($user==$userrow['id'] && $pass==$userrow['key']) {
        if($user_id=$_SESSION['Oauth_alipay_uid']){
            $DB->exec("update `pay_user` set `alipay_uid` ='$user_id' where `id`='$user'");
            unset($_SESSION['Oauth_alipay_uid']);
        }
        if($qq_openid=$_SESSION['Oauth_qq_uid']){
            $DB->exec("update `pay_user` set `qq_uid` ='$qq_openid' where `id`='$user'");
            unset($_SESSION['Oauth_qq_uid']);
        }
        $DB->query("insert into `panel_log` (`uid`,`type`,`date`,`data`) values ('".$user."','登录用户中心','".$date."','".$clientip."')");
        $session=md5($user.$pass.$password_hash);
        $expiretime=time()+86400;
        $token=authcode("{$user}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
        setcookie("user_token", $token, time() + 86400);
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('登录用户中心成功！');window.location.href='./';</script>");
    }else {
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
    }
}elseif(isset($_GET['logout'])){
    setcookie("user_token", "", time() - 86400);
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('您已成功注销本次登录！');window.location.href='./login.php';</script>");
}elseif($islogin2==1){
    exit("<script language='javascript'>alert('您已登录！');window.location.href='./';</script>");
}
if($conf['web_is']==1)sysmsg($conf['web_offtext']);
if($conf['web_is']==2)sysmsg($conf['web_offtext']);
if($conf['login_is']==1)sysmsg($conf['login_offtext']);
?>
<!-- opao.kucat.cn -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $conf['web_name']?>">
  <title>商户登录 - <?php echo $conf['web_name']?></title>
  <meta name="keywords" content="<?php echo $conf['web_name']?>">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/fortawesome.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/opao.min.css" type="text/css">
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
            <a href="agreement.php" class="nav-link">
              <span class="nav-link-inner--text">服务条款</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/doc.php" class="nav-link">
              <span class="nav-link-inner--text">开发文档</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link">
              <span class="nav-link-inner--text">商户登录</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="reg.php" class="nav-link">
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
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-<?php echo $conf['usermb_ys']?> py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">自助登录商户</h1>
              <p class="text-lead text-white"><?php echo $conf['logingg']; ?></p>
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
            <div class="card-header bg-transparent pb-5">
            <?php if($conf['quicklogin']==3){?>
              <div class="text-muted text-center mt-2 mb-3"><small><?php echo $conf['web_name']; ?>已关闭使用第三方快捷登录</small></div>
               	<?php }else{?>
               	   <div class="text-muted text-center mt-2 mb-3"><small><?php echo $conf['web_name']; ?>诚邀您使用第三方快捷登录</small></div>
               	      <?php }?>
              <div class="btn-wrapper text-center">
              <?php if($conf['quicklogin']==0){?>
                <a href="oauth.php" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--text">支付宝快捷登录</span>
                </a>
                <a href="connect.php" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--text">QQ快捷登录</span>
                </a>
                 <?php }?>
                <?php if($conf['quicklogin']==1){?>
                <a href="oauth.php" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--text">支付宝快捷登录</span>
                </a>
               <?php }?>
               <?php if($conf['quicklogin']==2){?>
                <a href="connect.php" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--text">QQ快捷登录</span>
                </a>
                <?php }?>
              </div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small><?php echo $conf['web_name']; ?>欢迎您回家！</small>
              </div>
              <form method="post" action="login.php">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" placeholder="输入您的商户ID" name="user" type="text" required="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="输入您的商户密钥" name="pass" type="password" required="">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">同意<a href="agreement.php">商户服务协议</a></span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-<?php echo $conf['usermb_ys']?> my-4">立即登录</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="findpwd.php" class="text-light"><small>找回商户信息</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="reg.php" class="text-light"><small>申请注册商户</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
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
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>