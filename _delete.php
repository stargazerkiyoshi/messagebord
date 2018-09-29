<?php
//删除数据库里的留言信息
$id=$_POST['id'];
//连接数据库
$link=mysqli_connect("localhost", "root", "root", "message", 3306);
$sql="DELETE FROM message WHERE id={$id}";
$res=mysqli_query($link,$sql);
if($res){
	$data['info']="删除成功";
	$data['status']=1;
}else{
	$data['info']="删除失败";
	$data['status']=2;
}
echo json_encode($data);
?>