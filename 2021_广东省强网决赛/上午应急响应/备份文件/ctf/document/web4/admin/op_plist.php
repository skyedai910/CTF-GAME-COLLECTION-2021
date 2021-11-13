<?php
$mod='blank';
include("../includes/common.php");
$title='合作者列表';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$numrows=$DB->query("SELECT * from panel_user WHERE 1")->rowCount();
?>
    <div class="header bg-<?php echo $conf['adminmb_ys']?> pb-6"><div class="container-fluid"><div class="header-body"><div class="row align-items-center py-4"><div class="col-lg-6 col-7"><h6 class="h2 text-white d-inline-block mb-0">合作者列表</h6><nav aria-label="breadcrumb"class="d-none d-md-inline-block ml-md-4"><ol class="breadcrumb breadcrumb-links breadcrumb-dark"><li class="breadcrumb-item"><a href="#!"><i class="fas fa-home"></i></a></li><li class="breadcrumb-item"><a href="#!">商户管理</a></li><li class="breadcrumb-item active" aria-current="page">合作者列表</li></ol></nav></div></div></div></div>
    </div>
    <div class="container-fluid mt--6">
    	<?php
        $my=isset($_GET['my'])?$_GET['my']:null;
        if($my=='add'){
          echo '<div class="row"><div class="col"><div class="card"><div class="card-header"><h3 class="mb-0">添加合作者</h3></div><div class="card-body"><form action="./op_plist.php?my=add_submit"method="POST"><div class="form-group"><label>用户名:</label><input type="text"class="form-control"name="user"value=""required></div><div class="form-group"><label>密码:</label><input type="text"class="form-control"name="pwd"value=""required></div><div class="form-group"><label>姓名:</label><input type="text"class="form-control"name="name"value=""placeholder="可留空"></div><div class="form-group"><label>等级:</label><select class="form-control"name="level"><option value="1">1_普通合作者</option><option value="2">2_高级合作者</option><option value="3">3_白金合作者</option></select></div><div class="form-group"><label>状态:</label><select class="form-control"name="active"><option value="1">1_激活</option><option value="0">0_封禁</option></select></div><input type="submit"class="btn btn-'.$conf['adminmb_ys'].' btn-block"value="确定添加"></form><br/><a href="./op_plist.php">>>返回合作者列表</a></div></div></div></div>';
        }
        elseif($my=='edit'){
          $id=$_GET['id'];
          $row=$DB->query("select * from panel_user where id='$id' limit 1")->fetch();
          echo 'iv class="row"><div class="col"><div class="card"><div class="card-header"><h3 class="mb-0">修改合作者信息</h3></div><div class="card-body"><form action="./op_plist.php?my=edit_submit&id='.$id.'"method="POST"><div class="form-group"><label>用户名:</label><input type="text"class="form-control"name="user"value="'.$row['user'].'"required></div><div class="form-group"><label>密码:</label><input type="text"class="form-control"name="pwd"value="'.$row['pwd'].'"required></div><div class="form-group"><label>姓名:</label><input type="text"class="form-control"name="name"value="'.$row['name'].'"required></div><div class="form-group"><label>等级:</label><select class="form-control"name="level"default="'.$row['level'].'"><option value="1">1_普通合作者</option><option value="2">2_高级合作者</option><option value="3">3_白金合作者</option></select></div><div class="form-group"><label>状态:</label><select class="form-control"name="active"default="'.$row['active'].'"><option value="1">1_激活</option><option value="0">0_封禁</option></select></div><div class="form-group"><label>是否重置密钥？</label><select class="form-control"name="resetkey"><option value="0">否</option><option value="1">是</option></select></div><input type="submit"class="btn btn-'.$conf['adminmb_ys'].' btn-block"value="确定修改"></form><br/><a href="./op_plist.php">>>返回合作者列表</a></div></div></div></div>';
        }
        elseif($my=='add_submit'){
          $user=$_POST['user'];
					$pwd=$_POST['pwd'];
					$name=$_POST['name'];
					$level=$_POST['level'];
					$active=$_POST['active'];
					if($user==NULL or $pwd==NULL){
          echo "<script language='javascript'>alert('保存错误,请确保加*项都不为空!');</script>";
        }else{
          $key = md5(random(32));
          $sds=$DB->exec("INSERT INTO `panel_user` (`token`, `user`, `pwd`, `name`, `level`, `regtime`, `active`) VALUES ('{$key}', '{$user}', '{$pwd}', '{$name}', '{$level}', '{$date}', '{$active}')");
          $pid=$DB->lastInsertId();
          if($sds){
            echo "<script language='javascript'>alert('报告老大，添加合作者成功！');window.location.href='./op_plist.php';</script>";
          }else{
            echo "<script language='javascript'>alert('报告老大，添加合作者失败！');history.go(-1);</script>";
          }
        }
      }elseif($my=='edit_submit'){
          $id=$_GET['id'];
          $rows=$DB->query("select * from panel_user where id='$id' limit 1")->fetch();
          if(!$rows)
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');</script>";
          $user=$_POST['user'];
					$pwd=$_POST['pwd'];
					$name=$_POST['name'];
					$level=$_POST['level'];
					$active=$_POST['active'];
					if($user==NULL or $pwd==NULL){
          echo "<script language='javascript'>alert('保存错误,请确保加*项都不为空!');</script>";
        }else{
          $sql="update `panel_user` set `user` ='{$user}',`pwd` ='{$pwd}',`name` ='{$name}',`level` ='{$level}',`active` ='$active' where `id`='$id'";
          if($_POST['resetkey']==1){
            $key = md5(random(32));
            $sqs=$DB->exec("update `panel_user` set `token` ='{$key}' where `id`='$id'");
          }
          if($DB->exec($sql)||$sqs){
            echo "<script language='javascript'>window.location.href='./op_plist.php';</script>";
          }else{
            echo "<script language='javascript'>alert('报告老大，修改合作者信息失败！');history.go(-1);</script>";
          }
        }
        }elseif($my=='delete'){
          $id=$_GET['id'];
          $rows=$DB->query("select * from panel_user where id='$id' limit 1")->fetch();
          if(!$rows)
            echo "<script language='javascript'>alert('报告老大，当前记录不存在！');</script>";
          $urls=explode(',',$rows['url']);
          $sql="DELETE FROM panel_user WHERE id='$id'";
          if($DB->exec($sql)){
            echo "<script language='javascript'>window.location.href='./op_plist.php';</script>";
          }else{
            echo "<script language='javascript'>alert('报告老大，删除合作者失败！');</script>";
          }
        }
      ?>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0">
                商户列表
              </h3>
              <p class="text-sm mb-0">
                共有 <b><?php echo $numrows ?></b> 个合作者
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light"><tr><th>ID</th><th>用户名</th><th>密码</th><th>合作者TOKEN</th><th>添加时间</th><th>等级</th><th>状态</th><th>操作</th></tr></thead><tfoot><tr><th>ID</th><th>用户名</th><th>密码</th><th>合作者TOKEN</th><th>添加时间</th><th>等级</th><th>状态</th><th>操作</th></tr></tfoot>
                <tbody>
                  <?php
                    $rs=$DB->query("SELECT * FROM panel_user WHERE 1 order by id desc limit 0,$numrows");
                    foreach($rs as $res){
                    echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['user'].'</td><td>'.$res['pwd'].'</td><td>'.$res['token'].'</td><td>'.$res['regtime'].'</td><td>'.$res['level'].'</td><td>'.($res['active']==1?'<font color=green>正常</font>':'<font color=red>封禁</font>').'</td><td><a href="./op_plist.php?my=edit&id='.$res['id'].'">编辑</a>&nbsp;<a href="./op_plist.php?my=delete&id='.$res['id'].'"onclick="return confirm(\'你确实要删除此商户吗？\');">删除</a></td></tr>';
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