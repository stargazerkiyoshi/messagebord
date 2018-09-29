<?php
//p-1*5
//接收参数
$p=$_GET['p'];
$everyPage=$_GET['everyPage'];
$start=($p-1)*$everyPage;
//连接数据库
$link = mysqli_connect("localhost", "root", "root", "message", 3306);

$sql="SELECT m.id,m.uid,m.addtime,u.username,m.content FROM message AS m JOIN users AS u ON m.uid=u.id ORDER BY m.addtime DESC LIMIT {$start},{$everyPage}";

$res=mysqli_query($link, $sql);
$list=mysqli_fetch_all($res,MYSQL_ASSOC);
foreach($list as $k=>$v){
	$list[$k]['showtime']=date("Y-m-d H:i:s",$v['addtime']);
}

echo json_encode($list);
?>
