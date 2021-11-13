<?php
include("../includes/common.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
$title='在线测试';
include './head.php';
if($conf['sdk_is']==0){
			exit("<script language='javascript'>alert('本站管理员暂未开启在线测试模块，如有疑问请联系客服！');history.go(-1);</script>");
		}
?>
<!-- opao.kucat.cn -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">在线测试</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">在线测试</a></li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">测试支付</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-8"><p class="mb-0">关于在线测试的注意事项：<br/>1.请不要恶意提交订单，投诉订单，否则后果自负.<br/>2.请确保您所提交的商户ID为您本人，测试支付成功后资金错乱概不负责.<br/>3.商品订单号为唯一值，如中途放弃测试，请直接刷新页面获取最新的唯一订单号.<br/>4.付款金额为随机值<code>1-10</code>￥，请您不要恶意测试，否则后果自负.</p></div>
                </div><hr>
                <form class="needs-validation"name="alipayment"action="test/epayapi.php"method="post"target="_blank"><div class="form-row"><div class="col-md-6 mb-3"><label class="form-control-label"for="validationCustom01">商户ID</label><input type="text"class="form-control"name="id"placeholder="输入您要进行测试的商户ID"value="<?php echo $pid?>"required=""><div class="valid-feedback">看起来不错~</div></div><div class="col-md-6 mb-3"><label class="form-control-label"for="validationCustom02">商户密钥</label><input type="text"class="form-control"name="key"placeholder="输入您要进行测试的商户密钥"value="<?php echo $userrow['key']?>"required=""><div class="valid-feedback">看起来不错~</div></div><div class="col-md-12 mb-3"><label class="form-control-label"for="validationCustomUsername">商户订单号</label><input type="text"class="form-control"name="WIDout_trade_no"value="<?php echo date("YmdHis").mt_rand(100,999); ?>"aria-describedby="inputGroupPrepend"required=""><div class="invalid-feedback">请确保订单号无误无重复再提交哦~</div></div></div><div class="form-row"><div class="col-md-6 mb-3"><label class="form-control-label"for="validationCustom03">商品名称</label><input type="text"class="form-control"name="WIDsubject"value="天方夜谭网络测试订单"required=""><div class="invalid-feedback">请确保名称没有违规再提交哦~</div></div><div class="col-md-6 mb-3"><label class="form-control-label"for="validationCustom04">付款金额(随机值)</label><input type="text"class="form-control"name="WIDtotal_fee"value="<?php echo mt_rand(1,10);?>"required=""><div class="invalid-feedback">请不要恶意提交金额,后果自负~</div></div></div><div class="form-group"><div class="custom-control custom-checkbox mb-3"><input class="custom-control-input"id="invalidCheck"type="checkbox"required=""><label class="custom-control-label"for="invalidCheck">我已了解并同意服务条款</label><div class="valid-feedback">请您确保您已同意服务条款</div></div></div><div class="text-center"><button type="radio" value="qqpay" name="type" class="btn btn-<?php echo $conf['usermb_ys']?> my-3">QQ钱包</button><button type="radio" value="wxpay" name="type" class="btn btn-<?php echo $conf['usermb_ys']?> my-3">微信支付</button><button type="radio" value="alipay" name="type" class="btn btn-<?php echo $conf['usermb_ys']?> my-3">支付宝</button>
                </form>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>