<?php
	include 'head.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$phone = test_input($_POST["phone"]);
		$password = test_input($_POST["password"]);
	}
	$flag = false;
	$result = mysqli_query($con,"SELECT * FROM teacher where phone = $phone");
	while($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
		$time = $row['times'];
		if($row['password']==$password) {
			$flag = true;
		}
	}
	if ($flag) {
		mysqli_query($con,"UPDATE teacher SET times = times+1 WHERE phone = $phone");
		echo "<script>alert('登录成功！');</script>";
	}else {
		echo "<script>alert('密码或账号错误！');window.location='../t_html/t_checkin.html';</script>";
	}
	mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
		<title>智慧教室管理系统</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery-1.12.3.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
</head>
<body style="background: url(../img/bg.png);">
	<div class="navbar navbar-inverse index-nav">
		<div class="container">
			<div class="navbar-header">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
    			</button>
    			<a class="navbar-brand" href="#">智慧教室管理系统</a>
			</div>
			<div class="navbar-collapse collapse navbar-responsive-collapse">
    			<ul class="nav navbar-nav btn-group">
      				<li><a href="../t_html/rfid.html">学生账户登录</a></li>
      				<li><a href="./not_logout.php">当日考勤信息</a></li>
        			<li><a href="result.php">近期记录</a></li>
        			<li><a href="../t_html/week_result.html">周查询</a></li>
        			<li><a href="../t_html/month_result.html">具体时间查询</a></li>
        			<li><a href="../t_html/t_search.html">学生姓名查询</a></li>
        			<li><a href="times.php">签到统计</a></li>
        			<li><a href="../index.html">注销</a></li>
    			</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row" style="text-align: center;">
			<div class="col-md-12">
				<h1 style="font-size: 5em;">智慧教室管理系统</h1>
			</div>
		</div>
		<div class="row" style="text-align: center;">
			<div class="col-md-8 col-md-offset-2">
				<h3>欢迎<strong class='h2'><?php echo $name; ?></strong>老师来到智慧教室管理系统！！！</h3>
				<p class='h3'>这是您第<strong><?php echo $time; ?></strong>次登录该系统！</p>
			</div>
		</div>
	</div>
</body>
</html>