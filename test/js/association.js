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
	var arrowLeft=document.querySelector(".type .left");
	var get=parseInt((winW-320)*47/80)+216;
	var startLeft;
	var moveLeft;
	var endLeft;
	ulList.addEventListener('touchstart',function(){
		startLeft=$(this).scrollLeft();
	})
	ulList.addEventListener('touchmove',function(){
		moveLeft=$(this).scrollLeft();
		if(moveLeft-startLeft>0){
			arrowLeft.style.display="block";
			if(winW==320){
				if(moveLeft==218){
					arrowRight.style.display="none";
				}
			}else if(winW>320){
				if(moveLeft>get){
					arrowRight.style.display="none";
				}
			}
		}else{
			if(moveLeft<30){
				arrowLeft.style.display="none";
			}
			arrowRight.style.display="block";
		}
	})

})