<?php
$link=mysqli_connect("localhost", "root", "root", "message", 3306);
$sql="SELECT m.id,m.uid,m.addtime,u.username,m.content FROM message AS m JOIN users AS u ON m.uid=u.id ORDER BY m.addtime DESC";

$res=mysqli_query($link, $sql);
$list=mysqli_fetch_all($res,MYSQL_ASSOC);
//print_r($list);
foreach($list as $k=>$v){
	$list[$k]['showtime']=date("Y-m-d H:i:s",$v['addtime']);
}
echo json_encode($list);

?>