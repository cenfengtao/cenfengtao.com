//$(function(){})
$(document).ready(function(){
	var winW = $(window).width();
	var constant = winW/6.4;
	$('body,html').css({"font-size":constant});
	$(window).resize(function(){
		var winW = $(window).width();
		var constant = winW/6.4;
		$('body,html').css({"font-size":constant});
	})
})




