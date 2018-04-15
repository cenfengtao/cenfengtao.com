<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>提示消息</title>
</head>
<style type="text/css">
	*{
		margin: 0;
		padding: 0;
		font-size: 0.12rem;
	}
	body { font: 75% Arail; text-align: center;width:100%; position: relative;}
	#notice {position: fixed;top:22%;left:11%; width: 80%; padding: 3px;}
	#notice div { padding: 30px 0 20px; font-size: 1.2em; font-weight:bold;position: relative; height: 170px;}
	#notice p { margin: auto;height: 80px;line-height: 80px; width: 100%;text-align: center;font-size: 36px;}
	b{ color: #f00;font-size: 36px;}
	a { color: #f00;font-size: 36px;} a:hover { text-decoration: none; }
	img{width:100%;height:auto;}
</style>
<body>
<div id="notice">
	<div>
		<p style="font-size:60px;color: #fff;;">{$message}</p>
		<p class="jump">
			页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait">3</b>
		</p>
	</div>
</div>
<img src="/Public/image/correct.jpg" alt="">
<script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
<script>
	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
</script>
</body>
</html>