//移动端字体自适应
$(document).ready(function(){
	var winW = $(window).width();
	var constant = winW/11.25;
	$('body').css({"font-size":constant});
	$(window).resize(function(){
		var winW = $(window).width();
		var constant = winW/11.25;
		$('body').css({"font-size":constant});
	})
})




