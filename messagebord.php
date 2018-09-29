<?php 
//判断是否登录？未登录跳转登录页面
session_start();
//防止非法登录
if(empty($_SESSION['username'])){
	//跳转登录页面
	header("Location:login.html");
}

//获取留言的详细数据
//连接数据库
$link=mysqli_connect("localhost", "root", "root", "message", 3306);
$sql="SELECT m.id,m.uid,m.addtime,u.username,m.content FROM message AS m JOIN users AS u ON m.uid=u.id ORDER BY m.addtime DESC";

$res=mysqli_query($link, $sql);
$list=mysqli_fetch_all($res,MYSQL_ASSOC);
foreach($list as $k=>$v){
	$list[$k]['showtime']=date("Y-m-d H:i:s",$v['addtime']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			.container{
				width: 800px;
				border: 1px solid;
				margin:0 auto;
				
			}
			h1{
				text-align: center;
			}
			.myinput{
				width: 100%;
				height: 300px;
			}
			table{
				border-collapse: collapse;
				width:100%;
				margin-top: 20px;
				margin-bottom: 20px;
			}
		</style>
		<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	</head>
	<body>
		
		欢迎您
		<?php
		 	echo $_SESSION['username']; 
			echo "<a href='destroy.php'>注销</a>"
		?>
		<div class="container">
			<h1>留言板</h1>
			<textarea class="myinput"></textarea>
			<button onclick="sub()">发表留言</button>
			
			<div id="exchange">
				
			
			<?php foreach($list as $k=>$v){?>
			<table border="1">
				<tr>
					<td>用户名：</td><td><?php echo $v['username'];?></td>
				</tr>
				<tr>
					<td>内容：</td><td><?php echo $v['content']?></td>
				</tr>
				<tr>
					<td>发布时间：</td><td><?php echo $v['showtime']?></td>
				</tr>
			</table>
			<?php
				if($v['uid']==$_SESSION['uid']){
					echo "<button onclick='_delete({$v["id"]})'>删除</button>";
				}
			?>
			<?php }?>
			</div>
		</div>	
		<script type="text/javascript">
			
			//删除留言的函数
			function _delete(id){
				console.log(id);
				$.ajax({
					type:"post",
					url:"_delete.php",
					data:{
						id
					},
					async:true,
					dataType:"json",
					success:function(res){
						console.log(res);
						//删除成功
						if(res.status==1){
							getData();							
						}else{
							alert(res.info);
						}
					}
				});
			}
			
			//提交留言的函数
			function sub(){
				//获取数据
				var content=$(".myinput").val();
				var uid=<?php echo $_SESSION['uid'];?>;
				$.ajax({
					type:"post",
					url:"add.php",
					async:true,
					data:{
						content,
						uid
					},
					dataType:"json",
					success:function(res){
						//获取最新的数据更新dom结构：ajax；
						getData();
					}
				});
			}
			function getData(){
				$.ajax({
							type:"get",
							url:"getData.php",
							async:true,
							dataType:"json",
							success:function(res){
								console.log(res);
								var uid = <?php echo $_SESSION['uid'] ?>
								//组装html
								var str="";
								for(var i=0;i<res.length;i++){
									str+=`<table border="1">
				<tr>
					<td>用户名：</td><td>${res[i].username}</td>
				</tr>
				<tr>
					<td>内容：</td><td>${res[i].content}</td>
				</tr>
				<tr>
					<td>发布时间：</td><td>${res[i].showtime}</td>
				</tr>	
			</table>
			${uid==res[i].uid?'<button onclick="_delete('+res[i].id+')">删除</button>':''}`
								console.log(str);
								//最新的dom替换旧的dom结构
								$('#exchange').html(str);
								}
							}
						})
			}
		</script>
	</body>
	
</html>
