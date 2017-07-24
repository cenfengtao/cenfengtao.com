
$(function(){
	//实现左导航栏li间隔颜色变化
	$(".nav_left li:even").css("background","#0a0909");
	$(".nav_left li:odd").css("background","#d03c30");
	//实现回到顶部有延迟效果
	$("#top_btn").click(function(){
		if(scroll=="off") return;
		$("html,body").animate({scrollTop: 0}, 600);
	});
	  //实现左导航不在头部显示
	  $(window).scroll(function () {
	  	var scrollTop = $(window).scrollTop();
	  	console.log(scrollTop)
	  	if(scrollTop<810) {
	  		$('.nav_left').css('display','none');
	  	}else {
	  		$('.nav_left').css('display','block');
	  	}
	  });
})
    
 