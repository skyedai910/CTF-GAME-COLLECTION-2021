<?php
include("../includes/common.php");
if ($islogin2 != 1) {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
$title = '商户排行';
include './head.php';
if($conf['phb_open']==0){
			exit("<script language='javascript'>alert('本站管理员暂未开启商户排行模块，如有疑问请联系客服！');history.go(-1);</script>");
		}
$rs = $DB->query("SELECT pay_user.id AS pid, pay_user.qq AS qq,(SELECT SUM(money) FROM pay_order WHERE STATUS='1' AND TO_DAYS(endtime)=TO_DAYS(NOW()) AND pid = pay_user.id) AS money FROM pay_user 	ORDER BY money DESC LIMIT 0 , 10");
$i = 1;
?>
<!-- opao.kucat.cn -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">商户排行榜</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">商户排行榜</a></li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">商户排行榜TOP10</h3>
               </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush"><thead class="thead-light"><tr><th scope="col">头像</th><th scope="col">ID</th><th scope="col">日销</th><th scope="col">排名</th></tr></thead>
              <tbody>
<?php
while($res = $rs->fetch())
{
if($res['money']=="")$res['money']='0.00';
$money = 	round($money,2);
if ($res[qq]==null) {
$tx="./assets/images/user.png";
}	else{
$tx='//q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$res['qq'].'&src_uin='.$res['qq'].'&fid='.$res['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC';			
}
echo '<tr><th><div class="media align-items-center"><a href="#!" class="avatar rounded-circle"><img alt="商户头像" src='.$tx.'></a></div></th><td>'.$res['pid'].'</td><td>'.$res['money'].'</td><td>第'.$i++.'名</td></tr>';}
?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>