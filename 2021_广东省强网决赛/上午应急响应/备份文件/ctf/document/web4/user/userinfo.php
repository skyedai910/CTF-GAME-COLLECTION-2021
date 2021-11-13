<?php
include("../includes/common.php");
if ($islogin2 != 1) {
  exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
$title = '商户信息';
include './head.php';
if(strlen($userrow['phone'])==11){
  $userrow['phone']=substr($userrow['phone'],0,3).'****'.substr($userrow['phone'],7,10);
}
?>
<!-- opao.kucat.cn -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">商户信息</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">商户信息</a></li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">商户信息</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-8"><p class="mb-0">关于商户信息的注意事项：<br/><code>商户密钥
                ：</code>请妥善保管好您的密钥,可别被坏人发现了</p></div>
                </div><hr>
                <div class="form-row">
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      商户ID
                    </label>
                    <input type="text" class="form-control" value="<?php echo $pid?>" disabled>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      商户密钥
                    </label>
                    <input type="text" class="form-control" value="<?php echo $userrow['key']?>" disabled>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      商户余额
                    </label>
                    <input type="text" class="form-control" value="￥<?php echo $userrow['money'] ?>" disabled>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">商户密保</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-8"><p class="mb-0">关于商户密保的注意事项：<br/><code>结算账号
                ：</code>请注意不要填写错误哦,填错我们不负责<br/><code>结算姓名
                ：</code>请务必填写真实姓名,否则出款失败后果自负</p></div>
                </div><hr>
                <div class="form-row">
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      商户结算方式
                    </label>
                    <select class="form-control" name="stype" default="<?php echo $userrow['settle_id'] ?>"><?php if($conf['stype_1']){?><option value="1">支付宝结算</option>
                      <?php }if($conf['stype_2']){?><option value="2">微信结算</option>
                      <?php }if($conf['stype_3']){?><option value="3">QQ钱包结算</option>
                      <?php }if($conf['stype_4']){?><option value="4">银行卡结算</option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      商户结算账号
                    </label>
                    <input type="text" name="account" class="form-control" value="<?php echo $userrow['account']?>" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      商户结算姓名
                    </label>
                    <input type="text" name="username" class="form-control" value="<?php echo $userrow['username'] ?>" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                  <button id="editSettle" class="btn btn-<?php echo $conf['usermb_ys']?> form-control" type="button">确认修改</button>
                  </div>
                  <?php if ($conf['verifytype'] == 1) { ?>
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      手机号码
                    </label>
					<div class="input-group">
                     <input type="text" name="phone" id="disableinput" class="form-control" value="<?php echo $userrow['phone']?>" disabled>
					  <div class="input-group-append"><button type="button"class="btn btn-default"id="checkbind">修改绑定信息</button></div>
					</div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      邮箱地址
                    </label>
                    <input type="email" name="phone" id="disableinput" class="form-control" value="<?php echo $userrow['email']?>" disabled>
                  </div>
                  <?php } else { ?>
                  <div class="col-md-12 mb-3">
                    <div class="input-group">
                      <input class="form-control" id="disableinput" type="text" name="email" value="<?php echo $userrow['email'] ?>"disabled>
                      <div class="input-group-append"><button type="button"class="btn btn-default"id="checkbind">修改绑定信息</button></div>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      联系QQ
                    </label>
                    <input type="text" name="qq" id="disableinput" class="form-control" value="<?php echo $userrow['qq']?>">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label">
                      对接网站域名
                    </label>
                    <input type="text" name="url" id="disableinput" class="form-control" value="<?php echo $userrow['url']?>">
                  </div>
                  <div class="col-md-12 mb-3">
                    <button class="btn btn-<?php echo $conf['usermb_ys']?> form-control" type="button" id="editInfo">
                    确认修改
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">第三方登录绑定</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-8"><p class="mb-0">关于第三方登录的注意事项：<br/><code>须知：</code>第三方账号绑定仅仅为了方便各位商户登录，如发现本处无显示绑定按钮，则本站管理员暂未开启第三方登录功能</p></div>
                </div><hr>
                <div class="form-row">
                  <div class="col-md-12 mb-3 <?php echo isset($_GET['connect'])||$conf['quicklogin']!=0?'hide':null;?>">
                    <?php if(empty($userrow['alipay_uid'])){?>
                    <a href="oauth.php?bind=true" target="_blank" class="btn btn-<?php echo $conf['usermb_ys']?> form-control">
                    绑定支付宝账号
                    </a>
                    <?php }else{?>
                    已绑定支付宝UID:<?php echo $userrow['alipay_uid']?>&nbsp;<a onclick="return confirm('解绑后将无法通过支付宝一键登录,是否确定解绑?');" href="oauth.php?unbind=true" class="btn btn-primary btn-xs">
                    解绑账号
                    </a>
                    <?php }?>
                  </div>
                  <div class="col-md-12 mb-3 <?php echo isset($_GET['connect'])||$conf['quicklogin']!=0?'hide':null;?>">
                    <?php if(empty($userrow['qq_uid'])){?>
                    <a href="connect.php?bind=true" target="_blank" class="btn btn-<?php echo $conf['usermb_ys']?> form-control">绑定QQ账号</a>
                    <?php }else{?>
                    已绑定QQ互联Openid:<?php echo $userrow['qq_uid']?>&nbsp;<a onclick="return confirm('解绑后将无法通过QQ一键登录,是否确定解绑?');" href="connect.php?unbind=true" class="btn btn-<?php echo $conf['usermb_ys']?> btn-xs">解绑账号</a>
                    <?php }?>
                  </div>
                  <div class="col-md-12 mb-3 <?php echo isset($_GET['connect'])||$conf['quicklogin']!=1?'hide':null;?>">
                    <?php if(empty($userrow['alipay_uid'])){?>
                    <a href="oauth.php?bind=true" target="_blank" class="btn btn-<?php echo $conf['usermb_ys']?> form-control">
                    绑定支付宝账号
                    </a>
                    <?php }else{?>
                    已绑定支付宝UID:<?php echo $userrow['alipay_uid']?>&nbsp;<a onclick="return confirm('解绑后将无法通过支付宝一键登录,是否确定解绑?');" href="oauth.php?unbind=true" class="btn btn-<?php echo $conf['usermb_ys']?> btn-xs">
                    解绑账号
                    </a>
                    <?php }?>
                  </div>
                  <div class="col-md-12 mb-3 <?php echo isset($_GET['connect'])||$conf['quicklogin']!=2?'hide':null;?>">
                    <?php if(empty($userrow['qq_uid'])){?>
                    <a href="connect.php?bind=true" target="_blank" class="btn btn-<?php echo $conf['usermb_ys']?> form-control">绑定QQ账号</a>
                    <?php }else{?>
                    已绑定QQ互联Openid:<?php echo $userrow['qq_uid']?>&nbsp;<a onclick="return confirm('解绑后将无法通过QQ一键登录,是否确定解绑?');" href="connect.php?unbind=true" class="btn btn-<?php echo $conf['usermb_ys']?> btn-xs">解绑账号</a>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-<?php echo $conf['usermb_ys']?>">
              <h6 class="modal-title">验证密保信息</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <?php if ($conf['verifytype'] == 1) { ?>
                <div class="form-group"><div class="input-group input-group-merge input-group-alternative"><div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-mobile-button"></i></span></div><p class="form-control"style="font-weight: bold;">当前密保手机：<?php echo $userrow['phone']?></p></div>
                </div>
                <div class="form-group"><div class="form-group"><div class="input-group"><input class="form-control"type="text"name="code"placeholder="输入短信验证码"required><div class="input-group-append"><button type="button"class="btn btn-default"id="sendcode">获取验证码</button></div></div></div>
                </div>
              <?php } else { ?>
                <div class="form-group"><div class="input-group input-group-merge input-group-alternative"><div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-email-83"></i></span></div><p class="form-control"style="font-weight: bold;">当前密保邮箱：<?php echo $userrow['email']?></p></div>
                </div>
                <div class="form-group"><div class="form-group"><div class="input-group"><input class="form-control"type="text"name="code"placeholder="输入邮箱验证码"required><div class="input-group-append"><button type="button"class="btn btn-default"id="sendcode">获取验证码</button></div></div></div>
                </div>
              <?php } ?>
              <button type="button" id="verifycode" class="btn btn-<?php echo $conf['usermb_ys']?> form-control">确定</button>
              <div id="embed-captcha"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-<?php echo $conf['usermb_ys']?>">
              <h6 class="modal-title">修改密保信息</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <?php if ($conf['verifytype'] == 1) { ?>
                <div class="form-group"><div class="input-group input-group-merge input-group-alternative"><div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-mobile-button"></i></span></div><input class="form-control"type="text"name="phone_n"placeholder="输入新的手机号码"required></div>
                </div>
                <div class="form-group"><div class="form-group"><div class="input-group"><input class="form-control"type="text"name="code_n"placeholder="输入短信验证码"required><div class="input-group-append"><button type="button"class="btn btn-default"id="sendcode2">获取验证码</button></div></div></div>
                </div>
              <?php } else { ?>
                <div class="form-group"><div class="input-group input-group-merge input-group-alternative"><div class="input-group-prepend"><span class="input-group-text"><i class="ni ni-email-83"></i></span></div><input class="form-control"type="email"name="email_n"placeholder="输入新的邮箱"required></div>
                </div>
                <div class="form-group"><div class="form-group"><div class="input-group"><input class="form-control"type="text"name="code_n"placeholder="输入邮箱验证码"required><div class="input-group-append"><button type="button"class="btn btn-default"id="sendcode2">获取验证码</button></div></div></div>
                </div>
              <?php } ?>
              <button type="button" id="editBind" class="btn btn-<?php echo $conf['usermb_ys']?> form-control">确定</button>
              <div id="embed-captcha"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>
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
  var target;
  captchaObj.onReady(function () {
    $("#wait").hide();
  }).onSuccess(function () {
    var result = captchaObj.getValidate();
    if (!result) {
      return alert('请完成验证');
    }
    var situation=$("#situation").val();
    var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
      type : "POST",
      url : "ajax2.php?act=sendcode",
      data : {situation:situation,target:target,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
      dataType : 'json',
      success : function(data) {
        layer.close(ii);
        if(data.code == 0){
          new invokeSettime("#sendcode");
          new invokeSettime("#sendcode2");
          layer.msg('发送成功，请注意查收！');
        }else{
          layer.alert(data.msg);
          captchaObj.reset();
        }
      } 
    });
  });
  $('#sendcode').click(function () {
    if ($(this).attr("data-lock") === "true") return;
    captchaObj.verify();
  });
  $('#sendcode2').click(function () {
    if ($(this).attr("data-lock") === "true") return;
    if($("input[name='phone_n']").length>0){
      target=$("input[name='phone_n']").val();
      if(target==''){layer.alert('手机号码不能为空！');return false;}
      if(target.length!=11){layer.alert('手机号码不正确！');return false;}
    }else{
      target=$("input[name='email_n']").val();
      if(target==''){layer.alert('邮箱不能为空！');return false;}
      var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
      if(!reg.test(target)){layer.alert('邮箱格式不正确！');return false;}
    }
    captchaObj.verify();
  })
  // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};
$(document).ready(function(){
  $("select[name='stype']").change(function(){
    if($(this).val() == 1){
      $("#typename").html("支付宝账号");
    }else if($(this).val() == 2){
      $("#typename").html("微信Openid");
    }else if($(this).val() == 3){
      $("#typename").html("QQ号");
    }else if($(this).val() == 4){
      $("#typename").html("银行卡号");
    }
  });
  $("#editSettle").click(function(){
    var stype=$("select[name='stype']").val();
    var account=$("input[name='account']").val();
    var username=$("input[name='username']").val();
    if(account=='' || username==''){layer.alert('请确保各项不能为空！');return false;}
    var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
      type : "POST",
      url : "ajax2.php?act=edit_settle",
      data : {stype:stype,account:account,username:username},
      dataType : 'json',
      success : function(data) {
        layer.close(ii);
        if(data.code == 1){
          layer.alert('修改成功！');
        }else if(data.code == 2){
          $("#situation").val("settle");
          $('#myModal').modal('show');
        }else{
          layer.alert(data.msg);
        }
      }
    });
  });
  $("#editInfo").click(function(){
    var email=$("input[name='email']").val();
    var qq=$("input[name='qq']").val();
    var url=$("input[name='url']").val();
    if(email=='' || qq=='' || url==''){layer.alert('请确保各项不能为空！');return false;}
    if(email.length>0){
      var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
      if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
    }
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
    $.ajax({
      type : "POST",
      url : "ajax2.php?act=edit_info",
      data : {email:email,qq:qq,url:url},
      dataType : 'json',
      success : function(data) {
        layer.close(ii);
        if(data.code == 1){
          layer.alert('修改成功！');
        }else{
          layer.alert(data.msg);
        }
      }
    });
  });
  $("#checkbind").click(function(){
    var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
      type : "GET",
      url : "ajax2.php?act=checkbind",
      dataType : 'json',
      success : function(data) {
        layer.close(ii);
        if(data.code == 1){
          $("#situation").val("bind");
          $('#myModal2').modal('show');
        }else if(data.code == 2){
          $("#situation").val("mibao");
          $('#myModal').modal('show');
        }else{
          layer.alert(data.msg);
        }
      }
    });
  });
  $("#editBind").click(function(){
    var phone=$("input[name='phone_n']").val();
    var email=$("input[name='email_n']").val();
    var code=$("input[name='code_n']").val();
    if(code==''){layer.alert('请输入验证码！');return false;}
    var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
      type : "POST",
      url : "ajax2.php?act=edit_bind",
      data : {phone:phone,email:email,code:code},
      dataType : 'json',
      success : function(data) {
        layer.close(ii);
        if(data.code == 1){
          layer.msg('修改绑定成功，正在跳转中...', {icon: 16,shade: 0.01,time: 15000});
          setTimeout(window.location.reload(), 1000);
        }else{
          layer.alert(data.msg);
        }
      }
    });
  });
  $("#verifycode").click(function(){
    var code=$("input[name='code']").val();
    var situation=$("#situation").val();
    if(code==''){layer.alert('请输入验证码！');return false;}
    var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
      type : "POST",
      url : "ajax2.php?act=verifycode",
      data : {code:code},
      dataType : 'json',
      success : function(data) {
        layer.close(ii);
        if(data.code == 1){
          layer.msg('验证成功！');
          $('#myModal').modal('hide');
          if(situation=='settle'){
            $("#editSettle").click();
          }else if(situation=='mibao'){
            $("#situation").val("bind");
            $('#myModal2').modal('show');
          }else if(situation=='bind'){
            $('#myModal2').modal('hide');
            window.location.reload();
          }
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
  var items = $("select[default]");
  for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default")||1);
  }
});
</script>