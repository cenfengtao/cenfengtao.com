﻿
$(function(){
   $(window).resize(function(){
        location.reload();
   })  
    var winW=$(window).width();
  			//获取小圆点的集合
		var  circleList =  $(".hd ul>li");
		//获取banner图集合
		var bannerList = $(".bd ul li");
    var len=circleList.length;
		//左右箭头切换标记
		var circleTag = 0;
		var liLen=bannerList.length;
		//自动轮播标记
			  var autoTag = 0;
		$(".bd ul").css({"width":winW*liLen+"px"});
		$(".bd li").width(winW);
		//小圆点切换banner图
		circleList.each(function(i){
			//为每一个小圆点绑定mouseover事件
			$(this).click(function(){
				clearlunbo();
				//鼠标移动到哪个圆点上，为该圆点增加active样式
			  circleList.eq(i).addClass("on");
				//其他圆点取消active样式
				circleList.not(circleList.eq(i)).removeClass("on");
				//切换对应的banner图
				bannerList.eq(i).show();
				bannerList.not(bannerList.eq(i)).hide();
				
					circleTag = i;
					autoTag = i;
			})
			
		})
			//左箭头切换上一张
		function prev(){
				
				circleTag--;
				// console.log(circleTag)
				if(circleTag<0){
					circleTag =len-1;
				}
				circleList.eq(circleTag).trigger("click");
			}
		
		//右箭头切换下一张
		function next(){
				circleTag++;
				//当下一页为最后一页时，则重置索引值，显示第一页
				if(circleTag>len-1){
					circleTag =0;
				}
				circleList.eq(circleTag).trigger("click");
		}
	  $(".bd ul li").swipe({
		swipeLeft: function(){
			next();
//			clearlunbo();
		},
		swipeRight: function(){
			prev();
//			clearlunbo();
		},
	})
		
			//自动轮播
		var autoTag=0;
//			var bool=true;
		var downtime =  setInterval(action,3000);//每隔一秒调用action函数
		//执行自动轮播的函数
		function action(){
				autoTag++;
			//如果已经是最后一页了，则重置为第一页
			if(autoTag>len-1){
				autoTag = 0;
			}
			circleList.eq(autoTag).trigger("click")	
		}		
		function clearlunbo(){
			clearInterval(downtime);
			setTimeout(function(){
				downtime=setInterval(action,3000)
			},1)
		}
		// $(".banner .bd ul li").hover(
		// 	function(){clearInterval(downtime)},
		// 	function(){downtime=setInterval(action,3000)}
		// )
//		bannerList.each(function(){
//				$(this).mouseover(function(){
//					clearInterval(downtime);
//				})
//				$(this).mouseout(function(){
//					//每隔一秒调用action函数
//					downtime = setInterval(action,1000)
//				})
//			})
})