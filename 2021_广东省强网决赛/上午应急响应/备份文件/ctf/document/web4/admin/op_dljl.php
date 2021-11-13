<?php
$mod='blank';
include("../includes/common.php");
$title='登录记录查询';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$numrows=$DB->query("SELECT * from panel_log WHERE 1")->rowCount();
$rs=$DB->query("SELECT * FROM panel_log WHERE 1 order by id desc limit 0,$numrows");
?>
		<div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">登录记录</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">其他设置</a></li><li class="breadcrumb-item active" aria-current="page">登录记录查询</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                登录记录查询
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows ?></b> 个登陆记录
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>ID</th><th>登陆ID</th><th>登陆操作</th><th>登录时间</th><th>登陆IP</th></tr></thead><tfoot><tr><th>ID</th><th>登陆ID</th><th>登陆操作</th><th>登录时间</th><th>登陆IP</th></tr></tfoot>
                <tbody>
                  <?php
                    foreach($rs as $res){
                    echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['uid'].'</td><td>'.$res['type'].'</td><td>'.$res['date'].'</td><td>'.$res['data'].'</td></td></tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>