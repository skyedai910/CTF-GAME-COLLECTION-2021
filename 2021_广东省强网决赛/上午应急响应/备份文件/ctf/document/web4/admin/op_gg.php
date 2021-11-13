<?php
include("../includes/common.php");
$title='广告列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$numrows=$DB->query("SELECT * from opao_gg WHERE 1")->rowCount();
$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='delete'){
          $id=$_GET['id'];
          $rows=$DB->query("select * from opao_gg where id='$id' limit 1")->fetch();
         if(!$rows){
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
          }else{
          $sql="DELETE FROM opao_gg WHERE id='$id'";
          if($DB->exec($sql)){
            echo "<script language='javascript'>alert('报告老大，删除广告成功！');window.location.href='./op_gg.php';</script>";
          }else{
            echo "<script language='javascript'>alert('报告老大，删除广告失败！');history.go(-1);</script>";
          }
          }
        }elseif($my=='edit_submit'){
          $id=$_GET['id'];
            $rows=$DB->query("select * from opao_gg where id='$id' limit 1")->fetch();
         if(!$rows){
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
          }else{
          $title=$_POST['title'];
          $nr=$_POST['nr'];
          $url=$_POST['url'];
          if($title==NULL or $nr==NULL or $url==NULL){
          echo "<script language='javascript'>alert('保存错误,请确保加*项都不为空!');history.go(-1);</script>";
           }else{
          $sql="UPDATE `opao_gg` SET `title`='{$title}',`nr`='{$nr}',`url`='{$url}' WHERE `id`='$id'";
          if($DB->exec($sql)){
            echo "<script language='javascript'>alert('报告老大，修改广告信息成功！');window.location.href='./op_gg.php';</script>";
           } else{
            echo "<script language='javascript'>alert('报告老大，修改广告信息失败！');history.go(-1);</script>";
              }
              }
              }
           }if($my=='add_submit'){
          $daat=array();
          foreach ($_POST as $k=>$v){
            $daat[$k]=$v;
          }
          $sql="INSERT INTO `opao_gg`(`title`, `nr`, `url`) VALUES ('{$daat['title']}','{$daat['nr']}','{$daat['url']}')";
           $sds=$DB->exec($sql);
            if($sds){
            echo "<script language='javascript'>alert('报告老大，添加广告成功！');window.location.href='./op_gg.php';</script>";
          }else{
          echo "<script language='javascript'>alert('报告老大，添加广告失败！');history.go(-1);</script>";
        }     
        }
  ?>
<!-- 天方夜谭支付系统：www.pxula.cn -->
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">广告列表</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">广告设置</a></li><li class="breadcrumb-item active" aria-current="page">广告列表</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
    <?php
    if($my=='add'){
          echo '<div class="row"><div class="col"><div class="card-wrapper"><!-- Custom form validation --><div class="card"><!-- Card header --><div class="card-header"><h3 class="mb-0">添加广告</h3></div><!-- Card body --><div class="card-body"><form class="needs-validation"action="./op_gg.php?my=add_submit"method="post"role="form">
          <div class="form-group"><label>名称:</label><input type="text"class="form-control"name="title"value=""required></div>
          <div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">内容:</label><textarea name="nr" rows="4" required class="form-control"></textarea></div></div>
          <div class="form-group"><label>域名:</label><input type="text"class="form-control"name="url"value=""required></div>
          <button class="btn btn-'.$conf['adminmb_ys'].' form-control"type="submit"name="submit">确定添加</button></form><br/><a href="./op_gg.php">>>返回广告列表</a></div></div></div></div></div>';
           }elseif($my=='edit'){
          $id=$_GET['id'];
          $row=$DB->query("select * from opao_gg where id='$id' limit 1")->fetch();
          if(!$row){
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');history.go(-1);</script>";
          }else{
           echo '<div class="row"><div class="col"><div class="card-wrapper"><!-- Custom form validation --><div class="card"><!-- Card header --><div class="card-header"><h3 class="mb-0">修改广告信息</h3></div><!-- Card body --><div class="card-body"><form class="needs-validation"action="./op_gg.php?my=edit_submit&id='.$id.'"method="post"role="form">
          <div class="form-group"><label>*名称:</label><input type="text"class="form-control"name="title"value="'.$row['title'].'"></div>
         <div class="form-row"><div class="col-md-12 mb-3"><label class="form-control-label">*内容:</label><textarea name="nr" rows="4" class="form-control">'.$row['nr'].'</textarea></div></div>
          <div class="form-group"><label>*域名:</label><input type="text"class="form-control"name="url"value="'.$row['url'].'"></div>
          <button class="btn btn-'.$conf['adminmb_ys'].' form-control"type="submit"name="submit">确定修改</button></form><br/><a href="./op_gg.php">>>返回广告列表</a></div></div></div></div></div>';
         } 
         }?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                广告列表
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows ?></b> 个广告
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>ID</th><th>名称</th><th>内容</th><th>操作</th></tr></thead><tfoot><tr><th>ID</th><th>名称</th><th>内容</th><th>操作</th></tr></tfoot>
                <tbody>
                  <?php
                    $rs=$DB->query("SELECT * FROM opao_gg WHERE 1 order by id");
                    foreach($rs as $res){
                    echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['title'].'</td><td>'.$res['nr'].'</td><td><a href="http://'.$res['url'].'/" class="btn btn-sm btn-info">查看</a><a href="./op_gg.php?my=edit&id='.$res['id'].'" class="btn btn-sm btn-info">编辑</a><a href="./op_gg.php?my=delete&id='.$res['id'].'" class="btn btn-sm btn-danger" onclick="return confirm(\'你确实要删除此广告吗？\');">删除</a></td></tr>';
                  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>    
      <!-- 主页结束 -->
<?php include 'foot.php';?>
<script>var items=$("select[default]");for(i=0;i<items.length;i++){$(items[i]).val($(items[i]).attr("default"))}</script>