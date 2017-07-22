$(function(){
	//实现.service选项卡功能
	$(".content> div:gt(0)").hide();
	$(".service .container a").click(function(){
		var index=$(this).index();
		$(".service .container a").eq(index).addClass("on").siblings().removeClass("on");
		$(".content> div").eq(index).css("display","block").siblings().css("display","none")
	})
})
