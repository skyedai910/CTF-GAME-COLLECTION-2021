<?php
$is_defend=true;
include("../includes/common.php");
if($conf['web_is']==1)sysmsg($conf['web_offtext']);
if($conf['web_is']==2)sysmsg($conf['web_offtext']);
if($conf['is_reg']==0)sysmsg($conf['reg_offtext']);
if($conf['yq_open']!=1){
if(isset($_GET['tid'])){
$tid = $_GET['tid'];
if($tid!=""){
exit("<script language='javascript'>alert('链接已失效，原因：未开启推广返利功能！');history.go(-1);</script>");
}
}
}
?>
<!-- opao.kucat.cn -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $conf['web_name']?>">
  <title>商户注册 - <?php echo $conf['web_name']?></title>
  <!-- Social tags -->
  <meta name="keywords" content="<?php echo $conf['web_name']?>">
  <!-- Favicon -->
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/fortawesome.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/assets/css/opao.min.css" type="text/css">
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
              <h1 class="text-white">自助申请商户</h1>
              <p class="text-lead text-white"><?php echo $conf['reggg']; ?></p>
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
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
              	<?php if($conf['is_payreg']){?>
                <small>商户申请价格为：<b><?php echo $conf['reg_price']?></b> 元</small>
                <?php }?>
              </div>
              <form name="form">
                <div class="form-group">
                	<select class="form-control" name="type"><?php if($conf['stype_1']){?><option value="1">支付宝结算</option><?php }if($conf['stype_2']){?><option value="2">微信结算</option><?php }if($conf['stype_3']){?><option value="3">QQ钱包结算</option><?php }if($conf['stype_4']){?><option value="4">银行卡结算</option><?php }?></select>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" type="text" name="account" placeholder="结算账号" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-badge"></i></span>
                    </div>
                    <input class="form-control" type="text" name="username" placeholder="真实姓名" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-world"></i></span>
                    </div>
                    <input class="form-control" type="text" name="url" placeholder="您的网站域名" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" type="email" name="email" placeholder="邮箱（用于接收商户信息）" required>
                  </div>
                </div>
                <?php if($conf['verifytype']==1){?>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                  	<div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" type="text" name="phone" placeholder="手机号码" required>
                  </div>
              	</div>
              	<div class="form-group">
              		<div class="form-group">
              			<div class="input-group">
                    		<input class="form-control" type="text" name="code" placeholder="短信验证码" required><div class="input-group-append"><button class="btn btn-dark" type="button" id="sendsms">获取验证码</button></div>
                    	</div>
              		</div>
	          	  </div>
                <div id="embed-captcha"></div>
              	<?php }else{?>
              	<div class="form-group">
              		<div class="form-group">
              			<div class="input-group">
              				<input class="form-control" type="text" name="code" placeholder="邮箱验证码" required><div class="input-group-append"><button type="button" class="btn btn-default" id="sendcode">获取验证码</button></div>
              			</div>
              		</div>
	          	  </div>
                <?php }?>
                <?php if($conf['yq_open']==1){?>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-active-40"></i></span>
                    </div>
                    <input class="form-control" type="text" name="tid" placeholder="邀请人商户ID(没有请留空)" value="<?php echo $_GET['tid']; ?>">
                  </div>
                </div>
                <?php }?>
                <div class="row my-4">
                  <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckRegister" type="checkbox" required>
                      <label class="custom-control-label" for="customCheckRegister">
                        <span class="text-muted">同意<a href="agreement.php">商户服务协议</a></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button class="btn btn-<?php echo $conf['usermb_ys']?>"  type="button" id="submit2" ng-click="login()" ng-disabled="form.$invalid">立即注册</button>
                </div>
              </form>
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
            &copy;2019-2020<a href="/" class="font-weight-bold ml-1" target="_blank"><?php echo $conf['web_name']; ?></a>
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
<script src="/assets/js/jquery.cookie.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/js.cookie.js"></script>
<script src="/assets/js/jquery.scrollbar.min.js"></script>
<script src="/assets/js/jquery-scrollLock.min.js"></script>
<script src="/assets/js/jquery.lavalamp.min.js"></script>
<script src="/assets/js/opao.min.js"></script>
<script src="/assets/js/demo.min.js"></script>
<script src="/assets/layer/layer.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script>
function invokeSettime(obj){
    var countdown=60;
    settime(obj);
    function settime(obj) {
        if (countdown == 0) {
            $(obj).attr("data-lock", "false");
            $(obj).text("获取验证码");
            countdown = 60;
            return;
        } else {
            $(obj).attr("data-lock", "true");
            $(obj).attr("disabled",true);
            $(obj).text("(" + countdown + ") s 重新发送");
            countdown--;
        }
        setTimeout(function() {
                    settime(obj) }
                ,1000)
    }
}
var handlerEmbed = function (captchaObj) {
    var phone;
    captchaObj.onReady(function () {
        $("#wait").hide();
    }).onSuccess(function () {
        var result = captchaObj.getValidate();
        if (!result) {
            return alert('请完成验证');
        }
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax.php?act=sendsms",
            data : {phone:phone,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 0){
                    new invokeSettime("#sendsms");
                    layer.msg('发送成功，请注意查收！');
                }else{
                    layer.alert(data.msg);
                    captchaObj.reset();
                }
            } 
        });
    });
    $('#sendsms').click(function () {
        if ($(this).attr("data-lock") === "true") return;
        phone=$("input[name='phone']").val();
        if(phone==''){layer.alert('手机号码不能为空！');return false;}
        if(phone.length!=11){layer.alert('手机号码不正确！');return false;}
        captchaObj.verify();
    })
    // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};
$(document).ready(function(){
    $("select[name='type']").change(function(){
        if($(this).val() == 1){
            $("input[name='account']").attr("placeholder","支付宝账号");
        }else if($(this).val() == 2){
            $("input[name='account']").attr("placeholder","微信号");
        }else if($(this).val() == 3){
            $("input[name='account']").attr("placeholder","QQ号");
        }else if($(this).val() == 4){
            $("input[name='account']").attr("placeholder","银行卡号");
        }
    });
    $("select[name='type']").change();
    if($.cookie('mch_info')){
        var data = $.cookie('mch_info').split("|");
        layer.open({
          type: 1,
          title: '你之前申请的商户',
          skin: 'layui-layer-rim',
          content: '<li class="list-group-item"><b>商户ID：</b>'+data[0]+'</li><li class="list-group-item"><b>商户密钥：</b>'+data[1]+'</li><li class="list-group-item"><a href="login.php?user='+data[0]+'&pass='+data[1]+'" class="btn btn-default btn-block">返回登录</a></li>'
        });
    }
    $("#sendcode").click(function(){
        if ($(this).attr("data-lock") === "true") return;
        var email=$("input[name='email']").val();
        if(email==''){layer.alert('邮箱不能为空！');return false;}
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax.php?act=sendcode",
            data : {email:email},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 0){
                    new invokeSettime("#sendcode");
                    layer.msg('发送成功，请注意查收！');
                }else{
                    layer.alert(data.msg);
                }
            } 
        });
    });
    $("#submit2").click(function(){
        if ($(this).attr("data-lock") === "true") return;
        var type=$("select[name='type']").val();
        var account=$("input[name='account']").val();
        var username=$("input[name='username']").val();
        var url=$("input[name='url']").val();
        var email=$("input[name='email']").val();
        var phone=$("input[name='phone']").val();
        var code=$("input[name='code']").val();
        var tid=$("input[name='tid']").val();
        if(account=='' || username=='' || url=='' || email=='' || phone=='' || code==''){layer.alert('请确保各项不能为空！');return false;}
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
        if (url.indexOf(" ")>=0){
            url = url.replace(/ /g,"");
        }
        if (url.toLowerCase().indexOf("http://")==0){
            url = url.slice(7);
        }
        if (url.toLowerCase().indexOf("https://")==0){
            url = url.slice(8);
        }
        if (url.slice(url.length-1)=="/"){
            url = url.slice(0,url.length-1);
        }
        $("input[name='url']").val(url);
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $(this).attr("data-lock", "true");
        $.ajax({
            type : "POST",
            url : "ajax.php?act=reg",
            data : {type:type,account:account,username:username,url:url,email:email,phone:phone,code:code,tid:tid},
            dataType : 'json',
            success : function(data) {
                $("#submit2").attr("data-lock", "false");
                layer.close(ii);
                if(data.code == 1){
                    layer.open({
                      type: 1,
                      title: '商户申请成功',
                      skin: 'layui-layer-rim',
                      content: '<li class="list-group-item"><b>商户ID：</b>'+data.pid+'</li><li class="list-group-item"><b>商户密钥：</b>'+data.key+'</li><li class="list-group-item">以上商户信息已经发送到您的邮箱中</li><li class="list-group-item"><a href="login.php?user='+data.pid+'&pass='+data.key+'" class="btn btn-default btn-block">返回登录</a></li>'
                    });
                    var mch_info = data.pid+"|"+data.key;
                    $.cookie('mch_info', mch_info);
                }else if(data.code == 2){
                    layer.open({
                      type: 1,
                      title: '支付确认页面',
                      skin: 'layui-layer-rim',
                      content: '<li class="list-group-item"><b>所需支付金额：</b>'+data.need+'元</li><li class="list-group-item text-center"><a href="../submit2.php?type=alipay&trade_no='+data.trade_no+'" class="btn btn-primary">支付宝</a>&nbsp;<a href="../submit2.php?type=wxpay&trade_no='+data.trade_no+'" class="btn btn-primary">微信支付</a>&nbsp;<a href="../submit2.php?type=qqpay&trade_no='+data.trade_no+'" class="btn btn-primary">QQ钱包</a></li><li class="list-group-item">提示：支付完成后请勿关闭网页，才能显示商户注册成功信息</li>'
                    });
                }else{
                    layer.alert(data.msg);
                }
            }
        });
    });
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        url: "ajax.php?act=captcha&t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            console.log(data);
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                width: '100%',
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "bind", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerEmbed);
        }
    });
});
</script>
</body>
</html>