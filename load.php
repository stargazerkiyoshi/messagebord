<?php 
session_start();
if(!empty($_COOKIE['username'])){
	$_SESSION['username']=$_COOKIE['username'];
}
if(!empty($_SESSION['username'])){
	header("Location:messagebord.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			body,h2{
				margin:0;
				padding: 0;
			}
			.loadbox{
				width:400px;
				height: 500px;
				border:1px solid;
				margin:100px auto;
			}
			.loadbox>h2{
				margin-top:10px;
				text-align: center;
			}
			.myinput{
				height: 30px;
				margin:30px;
				margin-top: 50px;
			}
			.myinput>label{
				margin-left: 20px;
               	width: 70px;
               	text-align: right;
               	display: inline-block;
            }
			.member{
				height: 20px;
				margin: 30px;
			}
			.member{
				text-align: center;
			}
			.load{
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="loadbox">
			<h2>留言板登录</h2>
			<form action="check.php" method="post">
				<div class="myinput">
					<label for="username">用户名：</label><input type="text" name="username" id="username"/>
				</div>
				
				<div class="myinput">
					<label for="pwd">密码：</label><input type="password" name="pwd" id="pwd"/>
				</div>
				<div class="member">
					<input type="checkbox" name="member"/>记住我
				</div>
				<div class="load">
					<input type="submit" value="登录"/>
				</div>
			</form>
		</div>
	</body>
	<script>
	</script>
</html>
