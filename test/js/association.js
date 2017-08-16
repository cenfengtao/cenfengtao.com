$(function(){
	$(".nav ul li").click(function(){
		var index=$(this).index();
		$(".nav ul li").eq(index).addClass("on").siblings().removeClass("on");
		$(".content>div").eq(index).css("display","block").siblings().css("display","none")
	})
	$(".footer ul li>img").css("display","none");
	$(".footer ul li>img:eq(2)").css("display","block");
	$(" .footer ul li").click(function(){
		$(this).addClass('on').siblings().removeClass("on");
		var index=$(this).index();
		var liLen=$(".footer ul li").length;
		for(var i=0;i<=liLen-1;i++){
			$(".footer ul li>img").eq(i).css("display","none");
		}
		$(this).find("img:eq(0)").css("display","block");
	})

	$(window).resize(function(){
        location.reload();
    })  
    var winW=$(window).width();
    var liLength=$(".type ul li").length;
//	 $(".type").swipe({
//		swipeLeft: function(){
//			var leftNow=$(".type ul").css('marginLeft');
//			leftNow=leftNow.substring(0,leftNow.length-2)
//			$(".type ul").animate({"marginLeft":leftNow-50+"px"})
//		},
//		swipeRight: function(){
//			$(".type ul").animate({"marginLeft":0+"px"},1000)
//		}
//	})
	var ulList=document.querySelector(".type ul");
	var arrowRight=document.querySelector(".type .right");
	var arrowLeft=document.querySelector(".type .left")
	var lastLeft;
	var nowLeft;
	ulList.addEventListener('touchstart',function(){
		lastLeft=$(this).scrollLeft();
	})
	ulList.addEventListener('touchmove',function(){
		var liL=$(".type ul li").innerWidth();
		var liLength=$(".type ul li").length;
		nowLeft=$(this).scrollLeft();
		if(nowLeft-lastLeft>0){
			arrowLeft.style.display="block";
			if(nowLeft>winW*0.55){
				arrowRight.style.display="none"
			}

		}else{
			if(nowLeft==0){
				arrowLeft.style.display="none"
			}
			arrowRight.style.display="block"	
		}
	})
})