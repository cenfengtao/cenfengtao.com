$(function(){
	//实现导航栏选项卡功能
	$(".content>div:gt(0)").hide();
	$(".nav ul li").click(function(){
		var index=$(this).index();
		$(".nav ul li").eq(index).addClass("on").siblings().removeClass("on");
		$(".content>div").eq(index).css("display","block").siblings().css("display","none");
	})
})
