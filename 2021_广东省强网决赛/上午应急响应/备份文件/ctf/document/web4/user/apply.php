<?php
include("../includes/common.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
$title='手动结算';
include './head.php';
if($conf['settle_open']==0){
	exit("<script language='javascript'>alert('本站管理员暂未开启手动结算功能，如有疑问请联系客服！');history.go(-1);</script>");
}
$today=date("Y-m-d").' 00:00:00';
$rs=$DB->query("SELECT * from pay_order where pid={$pid} and status=1 and endtime>='$today'");
$order_today=0;
while($row = $rs->fetch())
{
	$order_today+=$row['money'];
}
$enable_money=round($userrow['money']-$order_today*$conf['money_rate']/100,2);
if(isset($_GET['act']) && $_GET['act']=='do'){
		if($userrow['apply']==1){
			exit("<script language='javascript'>alert('很抱歉，您今天已经申请过手动结算，每日仅可申请一次，请勿重复申请！');history.go(-1);</script>");
		}
		if($userrow['money']<$conf['sdtx_money_min']){
			exit("<script language='javascript'>alert('很抱歉，您当前的商户余额不满足本站可申请手动结算的最低金额设定标准！');history.go(-1);</script>");
		}
		if($userrow['type']==2){
			exit("<script language='javascript'>alert('很抱歉，您的商户出现异常，无法申请手动结算！');history.go(-1);</script>");
		}
		$sqs=$DB->exec("update `pay_user` set `apply` ='1' where `id`='$pid'");
		exit("<script language='javascript'>alert('恭喜您，申请手动结算成功，相关费率信息请看底部说明！');history.go(-1);</script>");
}
?>
<!-- opao.kucat.cn -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">手动结算</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">订单与结算</a></li><li class="breadcrumb-item active" aria-current="page">手动结算</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">手动结算</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-8"><p class="mb-0">关于手动提现的注意事项：<br/>1.当商户余额达到本站<font color="red">“手动结算金额标准”</font>即可申请结算！<br/>2.手动结算功能可以让您在商户余额未达到<font color="red">“每日自动结算金额标准”</font>时向管理员申请结算！<br/>3.款项将扣除<?php $a=100;$b=$conf['settle_rate'];echo $a*$b?>%的手续费，在T+1工作日内结算到您的指定账户中；结算时如手续费不足<font color=red"><?php echo $conf['settle_fee_min']; ?>元</font>按<font color="red"><?php echo $conf['settle_fee_min']; ?>元</font>收取，请知悉！<br/><code>每日自动结算金额标准：</code>商户余额满<?php echo $conf['settle_money']; ?>元，系统每日自动结算！<br/><code>申请手动结算金额标准：</code>商户余额满<?php echo $conf['sdtx_money_min']; ?>元，才可申请手动结算！</p></div>
                </div><hr>
                <form class="needs-validation" action="./apply.php?act=do" method="post">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label" for="validationCustom01">
                                结算账号
                            </label>
                            <input type="text" class="form-control" value="<?php echo $userrow['account']?>" disabled>
                            <div class="valid-feedback">
                                看起来不错~
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label" for="validationCustom02">
                                结算姓名
                            </label>
                            <input type="text" class="form-control" value="<?php echo $userrow['username']?>" disabled>
                            <div class="valid-feedback">
                                看起来不错~
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label" for="validationCustomUsername">
                                商户余额
                            </label>
                            <input type="text" class="form-control" value="￥<?php echo $userrow['money']?>" disabled>
                            <div class="invalid-feedback">
                                看到自己的余额，眼泪都掉下来了吧~
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="invalidCheck" type="checkbox"
                            required="">
                            <label class="custom-control-label" for="invalidCheck">
                                我已了解并同意服务条款
                            </label>
                            <div class="valid-feedback">
                                请您确保您已同意服务条款
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-<?php echo $conf['usermb_ys']?> form-control" value="申请结算">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
      <?php include 'foot.php';?>