<?php
mysql_connect("127.0.0.1","failte","52171250");
mysql_query("use nav");
$sql="select * from links";
$result=mysql_query($sql);
$rows=[];
while ($row=mysql_fetch_assoc($result)) {
    $rows[]=$row;
}
?>

<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
	<link rel="icon" href="images/search.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="author" content="failte,failte@163.com">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="Window-target" content="_blank">
	<base target="_blank" />
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="iconfont/iconfont.css">
<!-- 	<link rel="stylesheet" href="css/index.css"> -->
    <link rel="stylesheet/less" href="css/index.less">
    <!-- <script>less = { env: 'development'};</script> -->
    <script src="js/less-1.3.3.min.js"></script>
    <!-- <script>less.watch();</script> -->
    <title>星辰导航</title>
</head>
<body>
	<div class="header-box">
		<div class="header">
			<a href="http://failte.gitee.io/test" class="iconfont logo">&#xe60b;星辰的空间</a>
			<a href="." class="title">星辰导航</a>
			<a href="javascript: void(0);" class="realtime" title="UTC/GMT+08:00">时间获取中...</a>
		</div>
	</div>
	<div class="search-box">
		<div class="search">
			<span class="iconfont search-logo">&#xe65e;</span>
			<a href="javascript: void(0);" class="iconfont search-switch" onclick="engineChoose()">&#xe8a8;</a>
			<input class="search-input" name="search" autofocus="autofocus" placeholder="搜点什么" />
			<ul></ul>
			<a href="javascript: void(0);" class="search-btn" onclick="searchGo()"><span></span>搜索星辰</a>
		</div>
	</div>
	<div class="wrapper-box">
		<div class="wrapper">
			<table>
                <?php foreach ($rows as $key => $value): ?>
                <?php if($key==0) echo "<tr>"; 
                    $_name=$value['link_value'];
                    $_value=$value['link_name'];
                    echo "<td><a href='$_name'>$_value</a></td>";
                    if(($key+1)%5==0 && $key!=0) echo "</tr><tr>"; ?>
                <?php endforeach; echo "<td><a href='javascript: void(0);' onclick='return false;'>Add</a></td></tr>"?>
			</table>
		</div>
	</div>
	<div class="footer-box">
		<div class="footer">
			<p>暮暮夜色凉寒秋，嗳嗳霓虹相衣袖。人群喧喧不回首，回首嗟嗟勿忘路。</p>
			<p>Copyright &copy; 2017-2019 Failte All Rights Reserved. Failte 版权所有.</p>
		</div>
	</div>
	<div class="greeting"></div>
	<script src="js/index.js"></script>
</body>
</html>