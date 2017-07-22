$(function(){
	//活动商品和爆款推荐的第一个商品图片随着product高度的变化而变化
	$(window).resize(function(){
		var activityHeight=$(".activity .product").height();
		var hotHeight=$(".hot .product").height();
		var activityImg=$(".activity .product ul li:eq(0) img");
		var hotImg=$(".hot .product ul li:eq(0) img");
		var width=$(window).width();
		if(width<401){
			activityImg.css("height",activityHeight+"px");
			hotImg.css("height",hotHeight+"px");
		}
  	})	
	var activityHeight=$(".activity .product").height();
	var hotHeight=$(".hot .product").height();
	var activityImg=$(".activity .product ul li:eq(0) img");
	var hotImg=$(".hot .product ul li:eq(0) img");
	var width=$(window).width();
	if(width<401){
		activityImg.css("height",activityHeight+"px");
		hotImg.css("height",hotHeight+"px");
	}
	
	//点击导航栏图片颜色可切换
	
	$(".nav ul li").click(function(){
		$(this).addClass('on').siblings().removeClass("on");
		for(var i=0;i<$(".nav ul li img").length;i++){
			var img=$(".nav ul li img").eq(i).attr("src");
			$(".nav ul li img").eq(i).attr("src",img.replace("_red",''))
		}
		var imgSrc=$(this).find("img").attr("src").split(".")[0];
		$(this).find("img").attr("src",imgSrc+"_red.png")
	})
	$(".search button").click(function(event){
		event.preventDefault();
		location.href="pro_search.html";
	})
})
