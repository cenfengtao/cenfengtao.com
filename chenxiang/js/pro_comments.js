$(function(){
	//实现小图切换大图功能
	$(".lunbo>ul li a img").click(function(){
		$(".top_left #smll_box>img").attr("src",$(this).attr("src"))
	})
	//实现点击获取当前状态
	$(".lunbo>ul li").click(function(){
		var index=$(this).index();
		$(".lunbo>ul li").eq(index).addClass("on").siblings().removeClass("on")
	})
	//实现商品的点击切换上下张图片功能
	var liWidth=$(".lunbo>ul li").outerWidth(true);
	var liLen=$(".lunbo>ul li").length;
	var bool=true;
	//点击切换上一张图片
	$(".prev").click(function(){
		if(bool){
			bool=false;
			if(liLen>3){
				for(var i=0;i<liLen-1;i++){
					$(".lunbo>ul li").eq(i).animate({"left":(i+1)*liWidth+"px"});
				}
				$(".lunbo>ul li").eq(liLen-1).prependTo(".lunbo>ul").css({"left":-liWidth+"px"}).animate({"left":0},function(){
					bool=true;
				})
				$(".top_left #smll_box>img").attr("src",$(".lunbo>ul li:eq(0) img").attr("src"));
				$(".lunbo>ul li:eq(0)").addClass("on").siblings().removeClass("on")
			}
		}	
	})
	//点击切换下一张图片
	$(".next").click(function(){
	    if(bool){
	    	bool=false;
	    	if(liLen>3){
	                $(".lunbo>ul li").eq(0).animate({"left":-liWidth+"px"},100,function(){
	                   	$(".lunbo>ul li").eq(0).appendTo(".lunbo>ul").css({"left":(liLen-1)*liWidth+"px"});
	                   	bool=true;
	                    $(".top_left #smll_box>img").attr("src",$(".lunbo>ul li:eq(0) img").attr("src"));
	                  	$(".lunbo>ul li:eq(0)").addClass("on").siblings().removeClass("on");
	                })
	                   
	                for(var i=1;i<liLen;i++){
	                    $(".lunbo>ul li").eq(i).animate({"left":(i-1)*liWidth+"px"});
	                }
	    	}
	    }
	})
	

  //实现放大镜功能
    var smll_box = document.getElementById("smll_box");
	var box1 = document.getElementById("box1");
	var box = document.getElementById("box");
	var img = document.createElement("img");
	img.style.position="absolute";
	img.style.width="1600px";
	img.style.height="1600px";
	box.appendChild(img);
	
	smll_box.onmouseover = function(){
		box1.style.display = "block";
		box.style.display = "block";
		img.src = smll_box.getElementsByTagName("img")[0].src;
	}
	smll_box.onmouseout = function(){
		box1.style.display = "none";
		box.style.display = "none";
	}
	smll_box.onmousemove = function(e){
		var e = e || window.event;
		var imgX = e.pageX;
		var imgY = e.pageY;
		var box1Left = imgX - smll_box.offsetLeft - box1.offsetWidth/2;
		var box1Top = imgY - smll_box.offsetTop - box1.offsetHeight/2;
		if(box1Left < 0){
			box1Left = 0;
		}else if(box1Left > smll_box.offsetWidth - box1.offsetWidth){
			box1Left = smll_box.offsetWidth - box1.offsetWidth;
		}
		if(box1Top < 0){
			box1Top = 0;
		}else if(box1Top > smll_box.offsetHeight - box1.offsetHeight){
			box1Top = smll_box.offsetHeight - box1.offsetHeight;
		}
		box1.style.left = box1Left + "px";
		box1.style.top = box1Top + "px";
		var count = img.offsetWidth/smll_box.getElementsByTagName("img")[0].offsetWidth;
		img.style.left = -box1Left*count + "px";
		img.style.top = -box1Top*count + "px";
		
	}	

})

//点击加入购物车上传数据到本地存储
function setProduct(){
	var imgSrc = ["images/pro_details4.jpg","images/pro_details5.jpg","images/pro_details6.jpg",
	"images/pro_details7.jpg","images/pro_details8.jpg","images/pro_details9.jpg","images/pro_details10.jpg"];
	var id = parseInt(Math.random()*6)
	var img = imgSrc[id];
	var num = parseInt(document.getElementById("pro_num").value);
	var price = 1350;
	var product = {
		imgSrc:img,
		num:num,
		price:price,
		id:id,
		totalPrice:(price*num).toFixed(2)
	}
	addShopCar(product);
	proNum();
}

//实现文本点击可切换获取当前状态
$(function(){
	$(".type a").click(function(){
		index=$(this).index()-1;
        $(".type a").eq(index).addClass("on").siblings().removeClass("on")
	})
	$(".staging span:gt(0)").click(function(){
		index=$(this).index()-1;
        $(".staging span:gt(0)").eq(index).addClass("on").siblings().removeClass("on")
	})
		
	$(".middle_right .pro_details .top>a").click(function(){
		index=$(this).index();
		$(".middle_right .pro_details .top>a").eq(index).addClass("on").siblings().removeClass("on");
		$(".middle_right .pro_details .bottom>div").eq(index).css("display","block").siblings().css("display","none")
	})
	$(".situation>a").click(function(){
		index=$(this).index();
		$(".situation>a").eq(index).addClass("on").siblings().removeClass("on");
		$(".content>div").eq(index).css("display","block").siblings().css("display","none")
	})
})
