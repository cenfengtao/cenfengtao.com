$(function(){
	$(".left .group ul li img").click(function(){
	     $(".left>img").attr("src",$(this).attr("src"));
	})
	$(".left .group ul li").click(function(){
		var index=$(this).index();
		$(".left .group ul li").eq(index).addClass("on").siblings().removeClass("on");
	})
	var liWidth = $(".list li").outerWidth(true);
		var liLen = $(".list li").length;
		var bool = true;
		var lunbo;
//		for(var i=0;i<liLen;i++){
//			$(".list li").eq(i).css({"left":i*liWidth+"px"})
//		}
		$(".right_icon").click(function(){
			show();
		})
		$(".left_icon").click(function(){
			if(bool){
				bool = false;
				if(liLen>3){
					for(var i=0;i<liLen-1;i++){
						$(".list li").eq(i).animate({"left":(i+1)*liWidth+"px"});
					}
					$(".list li").eq(liLen-1).prependTo(".list ul").css({"left":-liWidth+"px"}).animate({"left":0},function(){
						
						bool = true;
						$(".left>img").attr("src",$(".list li:eq(0) img").attr("src"));
						$(".list li:eq(0)").addClass("on").siblings().removeClass('on');
					})
				}
			})
			
		})
//		$("#banner").mouseover(function(){
//			clearInterval(lunbo);
//		})
//		$("#banner").mouseout(function(){
//			lunbo = setInterval(function(){
//				show();
//			},2000)
//		})
		function show(){
			if(bool){
				bool = false;
				if(liLen>3){
					$(".list li").eq(0).animate({"left":-liWidth+"px"},function(){
						$(".list li").eq(0).appendTo(".list ul").css({"left":(liLen-1)*liWidth+"px"});
						bool = true;
						$(".left>img").attr("src",$(".list li:eq(0) img").attr("src"));
						$(".list li:eq(0)").addClass("on").siblings().removeClass('on');
					})
					for(var i=1;i<liLen;i++){
						$(".list li").eq(i).animate({"left":(i-1)*liWidth+"px"});
					}
				}
			}
		}
//		lunbo = setInterval(function(){
//			show();
//		},2000)
})
