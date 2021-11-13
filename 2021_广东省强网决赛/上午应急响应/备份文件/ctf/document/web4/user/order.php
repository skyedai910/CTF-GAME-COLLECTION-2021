<?php
include("../includes/common.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
$title='订单记录';
include './head.php';
?>
<?php
function do_callback($data){
  global $DB,$userrow;
  if($data['status']>=1)$trade_status='TRADE_SUCCESS';
  else $trade_status='TRADE_FAIL';
  $array=array('pid'=>$data['pid'],'trade_no'=>$data['trade_no'],'out_trade_no'=>$data['out_trade_no'],'type'=>$data['type'],'name'=>$data['name'],'money'=>$data['money'],'trade_status'=>$trade_status);
  $arg=argSort(paraFilter($array));
  $prestr=createLinkstring($arg);
  $urlstr=createLinkstringUrlencode($arg);
  $sign=md5Sign($prestr, $userrow['key']);
  if(strpos($data['notify_url'],'?'))
    $url=$data['notify_url'].'&'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
  else
    $url=$data['notify_url'].'?'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
  return $url;
}
if(!empty($_GET['type']) && !empty($_GET['kw'])) {
  $kw=daddslashes($_GET['kw']);
  if($_GET['type']==1)$sql=" and trade_no='$kw'";
  elseif($_GET['type']==2)$sql=" and out_trade_no='$kw'";
  elseif($_GET['type']==3)$sql=" and name='$kw'";
  elseif($_GET['type']==4)$sql=" and money='$kw'";
  elseif($_GET['type']==5)$sql=" and type='$kw'";
  else $sql="";
  $link='&type='.$_GET['type'].'&kw='.$_GET['kw'];
}else{
  $sql="";
  $link='';
}
$numrows=$DB->query("SELECT count(*) from pay_order WHERE pid={$pid}{$sql}")->fetchColumn();
$list=$DB->query("SELECT * FROM pay_order WHERE pid={$pid}{$sql} order by trade_no desc limit 0,$numrows")->fetchAll();
?>
<!-- opao.kucat.cn -->
    <div class="header bg-<?php echo $conf['usermb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">订单明细</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">订单与结算</a></li><li class="breadcrumb-item active" aria-current="page">订单明细</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                订单明细表
              </h3>
              <p class="text-sm mb-0">
                要钱没有，要命也没有，跑路使我快乐，删库使我舒畅。小老弟你怎么回事？你竟然有
                <?php echo $numrows?>
                  条订单记录
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>交易号/商户订单号</th><th>商品名称</th><th>商品金额</th><th>支付方式</th><th>创建时间/完成时间</th><th>订单状态</th><th>操作</th></tr></thead><tfoot><tr><th>交易号/商户订单号</th><th>商品名称</th><th>商品金额</th><th>支付方式</th><th>创建时间/完成时间</th><th>订单状态</th><th>操作</th></tr></tfoot>
                <tbody>
                  <?php
                    foreach($list as $res){
                    echo '<tr><td>'.$res['trade_no'].'<br/>'.$res['out_trade_no'].'</td><td>'.$res['name'].'</td><td>￥ <b>'.$res['money'].'</b></td><td> <b>'.$res['type'].'</b></td><td>'.$res['addtime'].'<br/>'.$res['endtime'].'</td><td>'.($res['status']==1?'<font color=green>已完成</font>':'<font color=red>未完成</font>').'</td><td><a href="'.do_callback($res).'" target="_blank" rel="noreferrer">重新通知</a></td></tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- 主页结束 -->
<?php include 'foot.php';?>