<?php
include("../includes/common.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
$title='推广返利';
include 'head.php';
if($conf['yq_open']==0){
			exit("<script language='javascript'>alert('本站管理员暂未开启推广返利模块，如有疑问请联系客服！');history.go(-1);</script>");
		}
?>
<!-- opao.kucat.cn -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">推广返利</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">推广返利</a></li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">推广返利</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <div class="row"><div class="col-lg-8"><p class="mb-0">关于推广返利的注意事项：<br/>1.只要有商户通过您的推广链接成功注册，您将获得<?php echo $conf['price']?>元佣金，推广获得的佣金都是实时到账您的余额的！<br/>2.您可以将您的推广链接分享到QQ、贴吧、社区、论坛、博客。<br/>3.虽然显得有些微不足道，但是日积夜累，积少成多，您动动手指就能赚到的钱还需要纠结？别犹豫快上车。</p></div>
                </div><hr>
                <div class="form-row">
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label" for="validationCustom01">
                      您的推广链接
                      </label>
                    <input type="text" class="form-control" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/user/reg.php?tid='.$pid; ?>" disabled>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-12 mb-3">
                    <label class="form-control-label" for="validationCustom03">
                      推广成功统计
                    </label>
                    <input type="text" class="form-control" value="您已成功邀请<?php echo $userrow['tgrs']?>位小伙伴，共返利<?php echo $userrow['price']?>元！" disabled>
                  </div>
                </div>        
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>