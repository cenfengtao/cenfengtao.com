$(function(){
	var liWidth = $(".list li").outerWidth(true);
		var liLen = $(".list li").length;
		var bool = true;
		var lunbo;
		for(var i=0;i<liLen;i++){
			$(".list li").eq(i).css({"left":i*liWidth+"px"})
		}
//		$("#next").click(function(){
//			show();
//		})
//		$("#prev").click(function(){
//			if(bool){
//				bool = false;
//				if(liLen>4){
//					for(var i=0;i<liLen-1;i++){
//						$("#box li").eq(i).animate({"left":(i+1)*liWidth+"px"},500);
//					}
//					$("#box li").eq(liLen-1).prependTo("#box ul").css({"left":-liWidth+"px"}).animate({"left":0},500,function(){
//						
//						bool = true;
//					});
//				}
//			}
//		})
		$(".list").mouseover(function(){
			clearInterval(lunbo);
		})
		$(".list").mouseout(function(){
			lunbo = setInterval(function(){
				show();
			},2000)
		})
		function show(){
			if(bool){
				bool = false;
				if(liLen>4){
					$(".list li").eq(0).animate({"left":-liWidth+"px"},500,function(){
						$(".list li").eq(0).appendTo(".list ul").css({"left":(liLen-1)*liWidth+"px"});
						bool = true;
					})
					for(var i=1;i<liLen;i++){
						$(".list li").eq(i).animate({"left":(i-1)*liWidth+"px"},500);
					}
				}
			}
		}
		lunbo = setInterval(function(){
			show();
		},2000)
})
