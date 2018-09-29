<?php
$username=$_POST['username'];
$pwd=$_POST['pwd'];
echo $_POST['member'];

$link=mysqli_connect("localhost", "root", "root", "message", 3306);
if(mysqli_connect_errno($link)){
	mysqli_connect_error($link);
}
$sql="SELECT * FROM users WHERE username='{$username}' AND pwd='{$pwd}'";
$res=mysqli_query($link, $sql);
$one=mysqli_fetch_assoc($res);
if($one){
	session_start();
	
//	echo "登录成功";
	echo "<script>alert('登录成功');window.location.href='messagebord.php'</script>";
	$_SESSION['username']=$one['username'];
	if(!empty($_POST['member'])){
		setcookie("username",$one['username'],time()+3600*24*7);
	}
}else{
//	echo "登录失败";
	echo "<script>alert('登录失败');window.location.href='login.php'</script>";
}
?>