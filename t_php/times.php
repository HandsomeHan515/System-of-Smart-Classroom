﻿<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
	<title>签到统计</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-1.12.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>
<body>
	<!-- navbar -->
	<div class="navbar navbar-inverse index-nav">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">智慧教室管理系统</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../t_html/rfid.html">学生账户登录</a></li>
                    <li><a href="./not_logout.php">当日考勤信息</a></li>
                    <li><a href="result.php">近期记录</a></li>
                    <li><a href="../t_html/week_result.html">周查询</a></li>
                    <li><a href="../t_html/month_result.html">具体时间查询</a></li>
                    <li><a href="../t_html/t_search.html">学生姓名查询</a></li>
                    <li><a href="#">签到统计</a></li>
                    <li><a href="../index.html">注销</a></li>
                </ul>
            </div>
        </div>
	</div>
	<!-- /navbar -->
<?php
	header("Content-Type: text/html; charset=utf-8");
	$con = mysqli_connect("localhost","root","","classroom");
	mysqli_query($con,"set names utf8");
	$result = mysqli_query($con,"select id,count(*),SUM(stay_time),count(case when end='not_logout' then 1 else null end) unsign, count(case when end<>'not_logout' then 1 else null end) signed from checkin group by id order by count(*) desc,SUM(stay_time) desc");
	echo "<div class='col-md-1'></div>";
	echo "<div class='col-md-10'>";
		echo "<iframe src='chart.php' width='100%' height='200' frameborder='no' border='0'allowtransparency='yes'> </iframe>";
		echo "<table class='table table-bordered table-striped table-hover'>";
			echo "<thead>
				<tr>
					<th style='text-align: center;'>排名</th>
					<th style='text-align: center;'>姓名</th>
					<th style='text-align: center;'>总签到次数</th>
					<th style='text-align: center;'>净签到次数</th>
					<th style='text-align: center;'>未签退次数</th>
				</tr>
				</thead>
				<tbody>";
	$line=1;
	while($row = mysqli_fetch_array($result)) {
		echo "<tr>
			<td style='text-align: center;'>".$line++."</td>
			<td style='text-align: center;'><a href='name.php?name=".$row['id']."'>".$row['id']."</a></td>
			<td style='text-align: center;'>".$row['count(*)']."</td>
			<td style='text-align: center;'>".$row['signed']."</td>
			<td style='text-align: center;'>".$row['unsign']."</td>
		</tr>";
	  }
	echo "</tbody></table>";
	echo "</div>";
	echo "<div class='col-md-1'></div>";
	mysqli_close($con);
?>
</body>
</html>
