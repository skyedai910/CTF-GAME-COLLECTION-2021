<?php
include("./includes/common.php");
?>
<!-- opao.kucat.cn -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $conf['web_name']?>,开发文档">
  <title>开发文档 - <?php echo $conf['web_name']?></title>
  <meta name="keywords" content="<?php echo $conf['web_name']?>">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="/assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/fortawesome.css" type="text/css">
  <link rel="stylesheet" href="/assets/css/opao.min.css" type="text/css">
  <style type="text/css">.row {margin:0;}</style>
</head>
<body>
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
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-<?php echo $conf['usermb_ys']?> py-6">
      <div class="container">
        <div class="header-body text-center">
          <div class="row justify-content-center">
            <h1 class="text-white">开发文档</h1>
            <p class="text-lead text-white">使用此接口可以实现支付宝、QQ钱包、微信支付与财付通的即时到账，免签约，无需企业认证。本文阅读对象：商户系统（在线购物平台、人工收银系统、自动化智能收银系统或其他）集成<?php echo $conf['web_name']?> 涉及的技术架构师，研发工程师，测试工程师，系统运维工程师。</p>
          </div>
        </div>
      </div>
    </div><br>
    <div class="container">
      <div class="row justify-content-center">
        <div class="row" style="overflow-y:auto">
          <div class="col-lg-12">
            <p><a href="#api0" style="padding-right: 10px;">[API]创建商户</a><a href="#api1" style="padding-right: 10px;">[API]查询商户信息</a><a href="#api2" style="padding-right: 10px;">[API]修改结算账号</a><br/><a href="#api3" style="padding-right: 10px;">[API]查询结算记录</a><a href="#api4" style="padding-right: 10px;">[API]查询单个订单</a><a href="#api5" style="padding-right: 10px;">[API]批量查询订单</a><a href="#pay0" style="padding-right: 10px;">发起支付请求</a><a href="#pay1" style="padding-right: 10px;">支付结果通知</a></p><hr/>
            <h2>接口申请方式</h2>
            <p>（一）普通支付商户<br/>可以获得一个支付商户。请联系人工申请QQ<a target="_blank" href="https://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $conf['web_qq'] ?>&amp;site=qq&amp;menu=yes"><?php echo $conf['web_qq'] ?></a>或网页自助申请，申请之后会将商户ID和商户KEY给你！
            </p>
            <p>（二）合作支付商户<br/>获得一个合作者身份TOKEN，可以集成到你开发的程序里面，通过接口无限申请普通支付商户，并且每个普通支付商户单独结算，相对独立。请联系人工申请QQ<a target="_blank" href="https://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $conf['web_qq'] ?>&amp;site=qq&amp;menu=yes"><?php echo $conf['web_qq'] ?></a>，申请之后会将合作者身份TOKEN给你！
            </p>
            <h2>协议规则</h2>
            <p>传输方式：HTTP</p>
            <p>数据格式：JSON</p>
            <p>签名算法：MD5</p>
            <p>字符编码：UTF-8</p><hr/>
            <h2 id="api0">[API]创建商户</h2>
            <p>API权限：该API只能合作支付商户调用</p>
            <p>URL地址：http://<?php echo $_SERVER['SERVER_NAME']?>/api.php?act=apply&amp;token={合作者身份TOKEN}&amp;url={商户域名}</p>
            <p>请求参数说明：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>apply</td><td>此API固定值</td></tr><tr><td>合作者TOKEN</td><td>token</td><td>是</td><td>String</td><td>9ddab6c4f2c87ce442de371b04f36d68</td><td>需要事先申请</td></tr><tr><td>商户域名</td><td>url</td><td>是</td><td>String</td><td><?php echo $_SERVER['SERVER_NAME'];?></td><td></td></tr></tbody></table>
            <p>返回结果：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr><tr><td>返回信息</td><td>msg</td><td>String</td><td>添加支付商户成功！</td><td></td></tr><tr><td>商户ID</td><td>pid</td><td>Int</td><td>10001</td><td>所创建的商户ID</td></tr><tr><td>商户密钥</td><td>key</td><td>String(32)</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td>所创建的商户密钥</td></tr><tr><td>商户类型</td><td>type</td><td>Int</td><td>1</td><td>此值暂无用</td></tr></tbody></table>
            <h2 id="api1">[API]查询商户信息与结算规则</h2>
            <p>URL地址：http://<?php echo $_SERVER['SERVER_NAME']?>/api.php?act=query&amp;pid={商户ID}&amp;key={商户密钥}</p>
            <p>请求参数说明：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>query</td><td>此API固定值</td></tr><tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>10001</td><td></td></tr><tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr></tbody></table>
            <p>返回结果：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr><tr><td>商户ID</td><td>pid</td><td>Int</td><td>10001</td><td>所创建的商户ID</td></tr><tr><td>商户密钥</td><td>key</td><td>String(32)</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td>所创建的商户密钥</td></tr><tr><td>商户类型</td><td>type</td><td>Int</td><td>1</td><td>此值暂无用</td></tr><tr><td>商户状态</td><td>active</td><td>Int</td><td>1</td><td>1为正常，0为封禁</td></tr><tr><td>商户余额</td><td>money</td><td>String</td><td>0.00</td><td>商户所拥有的余额</td></tr><tr><td>结算账号</td><td>account</td><td>String</td><td>pay@m6e6.cn</td><td>结算的支付宝账号</td></tr><tr><td>结算姓名</td><td>username</td><td>String</td><td>张三</td><td>结算的支付宝姓名</td></tr><tr><td>满多少自动结算</td><td>settle_money</td><td>String</td><td>30</td><td>此值为系统预定义</td></tr><tr><td>手动结算手续费</td><td>settle_fee</td><td>String</td><td>1</td><td>此值为系统预定义</td></tr><tr><td>每笔订单分成比例</td><td>money_rate</td><td>String</td><td>98</td><td>此值为系统预定义</td></tr></tbody></table>
            <h2 id="api2">[API]修改结算账号</h2>
            <p>URL地址：http://<?php echo $_SERVER['SERVER_NAME']?>/api.php?act=change&amp;pid={商户ID}&amp;key={商户密钥}&amp;account={结算账号}&amp;username={结算姓名}</p>
            <p>请求参数说明：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>change</td><td>此API固定值</td></tr><tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>10001</td><td></td></tr><tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr><tr><td>结算账号</td><td>account</td><td>是</td><td>String</td><td>pay@m6e6.cn</td><td>结算的支付宝账号</td></tr><tr><td>结算姓名</td><td>username</td><td>是</td><td>String</td><td>张三</td><td>结算的支付宝姓名</td></tr></tbody></table>
            <p>返回结果：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr><tr><td>返回信息</td><td>msg</td><td>String</td><td>修改收款账号成功！</td><td></td></tr></tbody></table>
            <h2 id="api3">[API]查询结算记录</h2>
            <p>URL地址：http://<?php echo $_SERVER['SERVER_NAME']?>/api.php?act=settle&amp;pid={商户ID}&amp;key={商户密钥}</p>
            <p>请求参数说明：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>settle</td><td>此API固定值</td></tr><tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>10001</td><td></td></tr><tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr></tbody></table>
            <p>返回结果：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr><tr><td>返回信息</td><td>msg</td><td>String</td><td>查询结算记录成功！</td><td></td></tr><tr><td>结算记录</td><td>data</td><td>Array</td><td>结算记录列表</td><td></td></tr></tbody></table>
            <h2 id="api4">[API]查询单个订单</h2>
            <p>URL地址：http://<?php echo $_SERVER['SERVER_NAME']?>/api.php?act=order&amp;pid={商户ID}&amp;key={商户密钥}&amp;out_trade_no={商户订单号}</p>
            <p>请求参数说明：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>order</td><td>此API固定值</td></tr><tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>10001</td><td></td></tr><tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr><tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td></td></tr></tbody></table>
            <p>返回结果：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr><tr><td>返回信息</td><td>msg</td><td>String</td><td>查询订单号成功！</td><td></td></tr><tr><td>易支付订单号</td><td>trade_no</td><td>String</td><td>2016080622555342651</td><td>小明易支付订单号</td></tr><tr><td>商户订单号</td><td>out_trade_no</td><td>String</td><td>20160806151343349</td><td>商户系统内部的订单号</td></tr><tr><td>支付方式</td><td>type</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr><tr><td>商户ID</td><td>pid</td><td>Int</td><td>10001</td><td>发起支付的商户ID</td></tr><tr><td>创建订单时间</td><td>addtime</td><td>String</td><td>2016-08-06 22:55:52</td><td></td></tr><tr><td>完成交易时间</td><td>endtime</td><td>String</td><td>2016-08-06 22:55:52</td><td></td></tr><tr><td>商品名称</td><td>name</td><td>String</td><td>VIP会员</td><td></td></tr><tr><td>商品金额</td><td>money</td><td>String</td><td>1.00</td><td></td></tr><tr><td>支付状态</td><td>status</td><td>Int</td><td>0</td><td>1为支付成功，0为未支付</td></tr></tbody></table>
            <h2 id="api5">[API]批量查询订单</h2>
            <p>URL地址：http://<?php echo $_SERVER['SERVER_NAME']?>/api.php?act=orders&amp;pid={商户ID}&amp;key={商户密钥}</p>
            <p>请求参数说明：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>操作类型</td><td>act</td><td>是</td><td>String</td><td>orders</td><td>此API固定值</td></tr><tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>10001</td><td></td></tr><tr><td>商户密钥</td><td>key</td><td>是</td><td>String</td><td>89unJUB8HZ54Hj7x4nUj56HN4nUzUJ8i</td><td></td></tr><tr><td>查询订单数量</td><td>limit</td><td>否</td><td>Int</td><td>20</td><td>返回的订单数量，最大50</td></tr></tbody></table>
            <p>返回结果：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>返回状态码</td><td>code</td><td>Int</td><td>1</td><td>1为成功，其它值为失败</td></tr><tr><td>返回信息</td><td>msg</td><td>String</td><td>查询结算记录成功！</td><td></td></tr><tr><td>订单列表</td><td>data</td><td>Array</td><td></td><td>订单列表</td></tr></tbody></table>
            <hr/>
            <h2 id="pay0">发起支付请求</h2>
            <p>URL地址：http://<?php echo $_SERVER['SERVER_NAME']?>/submit.php?pid={商户ID}&amp;type={支付方式}&amp;out_trade_no={商户订单号}&amp;notify_url={服务器异步通知地址}&amp;return_url={页面跳转通知地址}&amp;name={商品名称}&amp;money={金额}&amp;sitename={网站名称}&amp;sign={签名字符串}&amp;sign_type=MD5</p>
            <p>请求参数说明：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>10001</td><td></td></tr><tr><td>支付方式</td><td>type</td><td>是</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr><tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td></td></tr><tr><td>异步通知地址</td><td>notify_url</td><td>是</td><td>String</td><td>http:<td>服务器异步通知地址</td></tr><tr><td>跳转通知地址</td><td>return_url</td><td>是</td><td>String</td><td>http:<td>页面跳转通知地址</td></tr><tr><td>商品名称</td><td>name</td><td>是</td><td>String</td><td>VIP会员</td><td></td></tr><tr><td>商品金额</td><td>money</td><td>是</td><td>String</td><td>1.00</td><td></td></tr><tr><td>网站名称</td><td>sitename</td><td>否</td><td>String</td><td>小明云任务</td><td></td></tr><tr><td>签名字符串</td><td>sign</td><td>是</td><td>String</td><td>202cb962ac59075b964b07152d234b70</td><td>签名算法与<a href="https://doc.open.alipay.com/docs/doc.htm?treeId=62&articleId=104741&docType=1"target="_blank">支付宝签名算法</a>相同</td></tr><tr><td>签名类型</td><td>sign_type</td><td>是</td><td>String</td><td>MD5</td><td>默认为MD5</td></tr></tbody></table>
            <h2 id="pay1">支付结果通知</h2>
            <p>通知类型：服务器异步通知（notify_url）、页面跳转通知（return_url）</p>
            <p>请求方式：GET</p>
            <p>请求参数说明：</p>
            <table class="table table-bordered table-hover"><thead><tr><th>字段名</th><th>变量名</th><th>必填</th><th>类型</th><th>示例值</th><th>描述</th></tr></thead><tbody><tr><td>商户ID</td><td>pid</td><td>是</td><td>Int</td><td>10001</td><td></td></tr><tr><td>易支付订单号</td><td>trade_no</td><td>是</td><td>String</td><td>20160806151343349021</td><td>小明易支付订单号</td></tr><tr><td>商户订单号</td><td>out_trade_no</td><td>是</td><td>String</td><td>20160806151343349</td><td>商户系统内部的订单号</td></tr><tr><td>支付方式</td><td>type</td><td>是</td><td>String</td><td>alipay</td><td>alipay:支付宝,tenpay:财付通,<br/>qqpay:QQ钱包,wxpay:微信支付</td></tr><tr><td>商品名称</td><td>name</td><td>是</td><td>String</td><td>VIP会员</td><td></td></tr><tr><td>商品金额</td><td>money</td><td>是</td><td>String</td><td>1.00</td><td></td></tr><tr><td>支付状态</td><td>trade_status</td><td>是</td><td>String</td><td>TRADE_SUCCESS</td><td></td></tr><tr><td>签名字符串</td><td>sign</td><td>是</td><td>String</td><td>202cb962ac59075b964b07152d234b70</td><td>签名算法与<a href="https://doc.open.alipay.com/docs/doc.htm?treeId=62&articleId=104741&docType=1"target="_blank">支付宝签名算法</a>相同</td></tr><tr><td>签名类型</td><td>sign_type</td><td>是</td><td>String</td><td>MD5</td><td>默认为MD5</td></tr></tbody></table>
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