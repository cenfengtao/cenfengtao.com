/*!
 * jQuery JavaScript Library v1.8.3
 * http://jquery.com/
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 *
 * Copyright 2012 jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: Tue Nov 13 2012 08:20:33 GMT-0500 (Eastern Standard Time)
 */

$(function(){
	$(window).resize(function(){
	location.reload();
	})
	/*定义一个变量是为了接收setInterval,以便需要的时候可以清除动画*/	
	var lunbo;
	/*为了获取当前浏览器窗口的宽度*/
	var winW = $(window).width();
	/*初始化索引值*/
	var index = 0;
	/*bool = true,是为了设定一个开关*/
	var bool = true;
	/*获取图片的个数*/
	var liLen = $(".index_banner .bd li").length;
	$(".index_banner .bd ul").css({"width":winW*liLen+"px"});
	$(".index_banner .bd li").width(winW);

	$(".index_banner .hd li").click(function(){
		index = $(this).index();
		if(bool){
			bool = false;
			$(".index_banner .bd ul").animate({marginLeft:-winW*index+"px"},function(){bool = true;});
			$(".index_banner .hd li").eq(index).addClass("on").siblings().removeClass('on');
		}
	})
	$(".index_banner .next").click(function(){
		index = $(".index_banner .hd li.on").index();
		/*通过if判断去执行动画，如果bool == true,那么就会执行if里面的代码*/
		if(bool){
			/*当我们进入if判断之后，为了防止下一次点击事件的立即执行，所以我们把开关关掉，bool = false*/
			bool = false;
			index+=1;
			if(index > liLen-1){
				index=0;
			}
			/*当我们执行完当前的animate()动画之后，那么我们需要使用回调函数重新把开关打开，以便下一次动画的执行*/
			$(".index_banner .bd ul").animate({marginLeft:-winW*index+"px"},700,function(){bool = true;});
			$(".index_banner .hd li").eq(index).addClass("on").siblings().removeClass('on');
		}

	})
	$(".index_banner .prev").click(function(){
		index = $(".index_banner .hd li.on").index();
		if(bool){
			bool = false;
			index-=1;
			if(index < 0){
				index=liLen-1;
			}
			$(".index_banner .bd ul").animate({marginLeft:-winW*index+"px"},700,function(){bool = true;});
			$(".index_banner .hd li").eq(index).addClass("on").siblings().removeClass('on');
		}

	})
	$(".index_banner").mouseover(function(){
		clearInterval(lunbo);
	})
	$(".index_banner").mouseout(function(){
		show()
	})
	/*实现自动轮播*/
	/*
	首先需要声明一个函数，
	声明方式：function functionName(){},
	调用函数：functionName();
	*/
	function show(){
		/*需要有一个变量去接收一个setInterval()方法，是为了能够通过这个变量使用clearInterval()去清除这个动画*/
		lunbo = setInterval(function(){
			/*因为我们需要执行下一张图片，所以对应的索引值需要+1*/
			index+=1;
			/*但是，如果没有一个方法能够阻止自增，那么这个索引值变量将会一直增加下去，所以，我们需要有一个判断能够停止这个索引值自增，而且我们要返回第一张图片，那么对应第一张图片索引值为0，所以我们给index赋值为0*/
			if(index > liLen-1){
				index=0;
			}
			/*animate()动画*/
			$(".index_banner .bd ul").animate({marginLeft:-winW*index+"px"});
			/*我们通过对应的索引值的小圆点增加当前样式.on，siblings()方法是找到除了自身元素之外的其他兄弟元素，也就是通过removeClass()这个方法去移除其他兄弟元素的.on*/
			$(".index_banner .hd li").eq(index).addClass("on").siblings().removeClass('on')
		},3000)
	}
	show();
})