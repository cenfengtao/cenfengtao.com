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
    var li=$(".type ul li").width();
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
	var arrow=document.querySelector(".type div")
	var lastLeft;
	var nowLeft;
	ulList.addEventListener('touchstart',function(){
		lastLeft=$(this).scrollLeft();
	})
	ulList.addEventListener('touchmove',function(){
		nowLeft=$(this).scrollLeft();
		
		if(nowLeft-lastLeft>0){
			arrow.innerHTML="《";
		}else{
			arrow.innerHTML="》"
		}
	})
//	var bool=true;
//	$('.type div').click(function(){
//		if(bool){
//			$('.type ul').css({"position":'absolute','top':'0.04rem','left':0,'zIndex':50,'whiteSpace':'normal'})
//			$('.type div').css("zIndex",50).text("》")
//			bool=false;
//		}else{
//			bool=true;
//			$('.type ul').css({"position":'static','top':'static','left':"static",'zIndex':"normal",'whiteSpace':'nowrap'})
//			$('.type div').css({"zIndex":"normal"}).text("《")
//		}
//	})
})