<?php
$link = mysqli_connect("localhost", "root", "root", "message", 3306);
if (mysqli_connect_errno($link)) {
	mysqli_connect_error($link);
}

//form表单提交过来的
if (!empty($_POST)) {
	$username = $_POST['username'];
	$pwd = md5($_POST['pwd']);
	$sql = "SELECT * FROM users WHERE username='{$username}' AND pwd='{$pwd}'";
	//设置编码格式
	mysqli_query($link, $sql);
	$res = mysqli_query($link, $sql);
	$one = mysqli_fetch_assoc($res);
	if ($one && mysqli_affected_rows($link)) {
		//用户名且密码正确
		//建立会话
		session_start();

		//	echo "登录成功";
		//	echo "<script>alert('登录成功');window.location.href='messagebord.php'</script>";
		header("Location:messagebord.php");
		$_SESSION['username'] = $one['username'];
		$_SESSION['uid']=$one['id'];
		if (!empty($_POST['member'])) {
			setcookie("username", $one['username'], time() + 3600 * 24 * 7);
		}
	} else {
		//用户名或密码错误
		//	echo "登录失败";
		echo "<script>alert('登录失败');window.location.href='login.php'</script>";
	}
}

//如果是ajax提交过来的；
if(!empty($_GET)){
	//执行ajax逻辑
	//查询用户名是否正确
	$username=$_GET['username'];
	$sql="SELECT * FROM users WHERE username='{$username}'";

	$res=mysqli_query($link, $sql);
	
	$result=mysqli_fetch_assoc($res);
//	print_r($res);die;
	if($result && mysqli_affected_rows($link)){
		//用户名正确
		$data['info']="用户名正确";
		$data['status']=1;
	}else{
		//用户名错误
		$data['info']='用户名错误';
		$data['status']=2;
	}
	echo json_encode($data);//输出的东西返还给ajax的success里面
}
?>