<?php
$mod='blank';
include("../includes/common.php");
$title='商户加款';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(isset($_POST['submit'])) {
$id=$_POST['id'];
$money=$_POST['money'];
$fl=$_POST['fl'];
$row=$DB->query("select * from pay_user where id='$id' limit 1")->fetch();
if($id==NULL or $money==NULL or $fl==NULL){
echo "<script language='javascript'>alert('保存错误,请确保每项都不为空!');history.go(-1);</script>";
}elseif (!$row) {
exit("<script language='javascript'>alert('加款商户ID不存在！');history.go(-1);</script>");
}else{
$addmoney=round($money*$fl/100,2);
$fl_n=100-$fl;
$DB->query("update pay_user set money=money+{$addmoney} where id='{$id}'");
$DB->query("insert into `opao_shjk` (`id`,`fl`,`money`,`addmoney`,`time`) values ('".$id."','".$fl_n."','".$money."','".$addmoney."','".$date."')");
 echo "<script language='javascript'>alert('报告老大，商户加款成功！');window.location.href='./op_shjk.php';</script>";
}
}
$numrows=$DB->query("SELECT count(*) from opao_shjk WHERE 1")->fetchColumn();
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">商户加款</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">商户管理</a></li><li class="breadcrumb-item active" aria-current="page">商户加款</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
  <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">商户加款</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                 <form class="needs-validation"action="./op_shjk.php?mod=site_n"method="post"role="form"><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">商户ID:</label><input type="text"name="id"class="form-control"value=""></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">加款金额:</label><input type="text"name="money"class="form-control"value=""></div></div><div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">费率分成:</label><input type="text"name="fl"class="form-control"value=""placeholder="填写百分数，例如98.5"></div></div><button class="btn btn-<?php echo $conf['adminmb_ys']?> form-control"type="submit"name="submit">确定加款</button>
                </form>
              </div>
            </div>
          </div>
          </div>
          </div>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                商户加款记录
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows?></b> 条记录
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>商户ID</th><th>手续费</th><th>加款金额</th><th>实际到账</th><th>加款时间</th></tr></thead><tfoot><tr><th>商户ID</th><th>手续费</th><th>加款金额</th><th>实际到账</th><th>加款时间</th></tr></tfoot>
                <tbody>
                  <?php
                   	$list=$DB->query("SELECT * FROM opao_shjk WHERE 1 order by time desc limit 10");
                    foreach($list as $res){
                    echo '<tr><td>'.$res['id'].'</td><td>'.$res['fl'].'%</td><td>'.$res['money'].'</td><td>'.$res['addmoney'].'</td><td>'.$res['time'].'</td></tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
<?php include 'foot.php';?>