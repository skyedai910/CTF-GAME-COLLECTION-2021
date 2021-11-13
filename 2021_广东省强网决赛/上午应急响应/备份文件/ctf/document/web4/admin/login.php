<?php
//php防注入和XSS攻击通用过滤. 
$_GET     && SafeFilter($_GET);
$_POST    && SafeFilter($_POST);
$_COOKIE  && SafeFilter($_COOKIE);
function SafeFilter(&$arr)
{
	$ra = array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '/script/', '/javascript/', '/vbscript/', '/expression/', '/applet/', '/meta/', '/xml/', '/blink/', '/link/', '/style/', '/embed/', '/object/', '/frame/', '/layer/', '/title/', '/bgsound/', '/base/', '/onload/', '/onunload/', '/onchange/', '/onsubmit/', '/onreset/', '/onselect/', '/onblur/', '/onfocus/', '/onabort/', '/onkeydown/', '/onkeypress/', '/onkeyup/', '/onclick/', '/ondblclick/', '/onmousedown/', '/onmousemove/', '/onmouseout/', '/onmouseover/', '/onmouseup/', '/onunload/');
	if (is_array($arr)) {
		foreach ($arr as $key => $value) {
			if (!is_array($value)) {
				if (!get_magic_quotes_gpc()) {             //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
					$value = addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
				}
				$value = preg_replace($ra, '', $value);     //删除非打印字符，粗暴式过滤xss可疑字符串
				$arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
			} else {
				SafeFilter($arr[$key]);
			}
		}
	}
}
include("../includes/common.php");
@header('Content-Type: text/html; charset=UTF-8');
if (isset($_POST['user']) && isset($_POST['pass'])) {
	if (!$_SESSION['pass_error']) $_SESSION['pass_error'] = 0;
	$user = daddslashes($_POST['user']);
	$pass = daddslashes($_POST['pass']);
	if ($_SESSION['pass_error'] > 5) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	} elseif ($user == $conf['admin_user'] && $pass == $conf['admin_pwd']) {
		$DB->query("insert into `panel_log` (`uid`,`type`,`date`,`data`) values ('1','登录系统后台','" . $date . "','" . $clientip . "')");
		$session = md5($user . $pass . $password_hash);
		$token = authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("admin_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('登陆管理中心成功！');window.location.href='./';</script>");
	} elseif ($pass != $conf['admin_pwd']) {
		$_SESSION['pass_error']++;
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
} elseif (isset($_GET['logout'])) {
	setcookie("admin_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
} elseif ($islogin == 1) {
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./index.php';</script>");
}
?>
<!-- 森度易支付:pay.sd129.cn -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $conf['web_name'] ?>">
	<title>后台登录 - <?php echo $conf['web_name'] ?></title>
	<meta name="keywords" content="<?php echo $conf['web_name']; ?>">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="/assets/css/nucleo.css" type="text/css">
	<link rel="stylesheet" href="/assets/css/fortawesome.css" type="text/css">
	<link rel="stylesheet" href="/assets/css/opao.min.css" type="text/css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
</head>

<body class="bg-default">
	<div class="main-content">
		<!-- Header -->
		<div class="header bg-gradient-<?php echo $conf['adminmb_ys'] ?> py-6">
			<div class="container">
				<div class="header-body text-center mb-7">
					<div class="row justify-content-center">
						<div class="col-xl-5 col-lg-6 col-md-8 px-5">
							<h1 class="text-white">后台登录管理</h1>
							<p class="text-lead text-white">欢迎主人回来，今天又赚了不少钱呢。快进来看看吧~</p>
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
								<small><?php echo $conf['web_name']; ?>欢迎您回家！</small>
							</div>
							<form method="post" action="login.php" role="form">
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="ni ni-circle-08"></i></span>
										</div>
										<input class="form-control" placeholder="请输入管理员账号" name="user" type="text" required="">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
										</div>
										<input class="form-control" placeholder="请输入管理员密码" name="pass" type="password" required="">
									</div>
								</div>
								<div class="custom-control custom-control-alternative custom-checkbox">
									<input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
									<label class="custom-control-label" for=" customCheckLogin">
										<span class="text-muted">同意使用<?php echo $conf['web_name']; ?></span>
									</label>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-<?php echo $conf['adminmb_ys'] ?> my-4">立即登录</button>
								</div>
							</form>
							<div>&#22823;&#37327;&#28304;&#30721;&#65292;&#25345;&#32493;&#26356;&#26032;&#65306;&#119;&#119;&#119;&#46;&#108;&#97;&#110;&#114;&#101;&#110;&#122;&#104;&#105;&#106;&#105;&#97;&#46;&#99;&#111;&#109;</div>

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
						&copy; <?= date('Y') ?> <a href="/" class="font-weight-bold ml-1" target="_blank"><?php echo $conf['web_name']; ?></a>
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
</body>

</html>