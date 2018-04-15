<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
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
	#notice {position: fixed;top:22%;left:11%; width: 80%; border: 1px solid #BBB; background: #EEE; padding: 3px;}
	#notice div { background: #FFF; padding: 30px 0 20px; font-size: 1.2em; font-weight:bold;position: relative; height: 170px;}
	#notice p { background: #FFF; margin: auto;height: 80px;line-height: 80px; width: 100%;text-align: center;font-size: 36px;}
	a { color: #f00;font-size: 36px;} a:hover { text-decoration: none; }
	img{width:100%;height:auto;}
</style>
<body>
<div id="notice">

	<input type="hidden" id="message" value="<?php echo $e['message'] ?>">
	<div>
		<p style="font-size:60px;">页面出现错误，请联系客服</p>
		<p>
			在<span id="sec" style="color:blue;font-weight:bold;font-size: 36px;">3</span>秒后自动跳转，或直接点击 <a href="javascript:window.history.back();">这里</a> 跳转。
		</p>
	</div>
</div>
<img src="/Public/image/error.jpg" alt="">
<script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
<script>
	var i = 3;
	var intervalid;
	intervalid = setInterval("fun()", 1000);
	var message = document.getElementById('message').value;
	console.log(message);
	function fun() {
		if (i == 0) {
			window.history.back();location.reload();
			clearInterval(intervalid);
		}
		document.getElementById("sec").innerHTML = i;
		i--;
	}
</script>
</body>
</html>