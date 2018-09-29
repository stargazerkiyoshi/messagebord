<?php
date_default_timezone_set('Asia/Shanghai');

//接收数据
$content=$_POST['content'];
$uid=$_POST['uid'];
$addtime=time();

//连接数据库
$link=mysqli_connect("localhost", "root", "root", "message", 3306);
if(mysqli_connect_errno($link)){
	mysqli_connect_error($link);
}
$sql="INSERT INTO message(content,uid,addtime) VALUES ('{$content}',{$uid},{$addtime})";
mysqli_query($link, "set names utf8");
$res=mysqli_query($link, $sql);
if($res &&mysqli_affected_rows($link)){
	$data['info']="添加成功";
	$data['status']=1;
}else{
	$data['info']="添加失败";
	$data['status']=2;
}
echo json_encode($data);
?>