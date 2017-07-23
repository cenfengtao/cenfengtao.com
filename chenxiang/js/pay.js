
$(function(){
	//点击可选择银行
	$(".img ul li").click(function(){
		var index=$(this).index();
		$(".img ul li").eq(index).addClass("on").siblings().removeClass("on");
	})
	//快捷支付里不同支付的切换
	$(".shortcut a").click(function(){
		var index=$(this).index();
		$(".shortcut a").eq(index).addClass("on").siblings().removeClass("on");
	})
})
//复选框的勾选
$(function(){
	var bool=true;
//	$(".border").each(function(i){
	$(".border").click(function(){
		if(bool){
			bool=false;
			$(this).css("paddingRight","16px");
			$(this).css("paddingTop","4px");
			$(this).attr("src","./images/pay_border.jpg");
			$(this).next().attr("checked",false);	
		}else{
			bool=true;
			$(this).attr("src","./images/pay_icon.png")
			$(this).css("paddingRight","8px")
			$(this).css("paddingTop","0px")
			$(this).next().attr("checked",true);
		    }
	})
	$(".check").click(function(){
			if(bool){
				bool=false;
				$(this).prev().children("img").css("paddingRight","16px");
				$(this).prev().children("img").css("paddingTop","4px");
				$(this).prev().children("img").attr("src","./images/pay_border.jpg");
				$(this).prev().children("input").attr("checked",false);	
			}else{
				bool=true;
				$(this).prev().children("img").attr("src","./images/pay_icon.png")
				$(this).prev().children("img").css("paddingRight","8px")
				$(this).prev().children("img").css("paddingTop","0px")
				$(this).prev().children("input").attr("checked",true);
			}
//		})
	   })
})

$(function(){
	//支付的切换
	$(".payType a").click(function(){
		var index=$(this).index();
		$(".payType a").eq(index).addClass("on").siblings().removeClass("on");
		$(".way div").eq(index).css("display","block").siblings().css("display","none");	
	})
	$(".payType a:eq(0)").click(function(){
		$(".payType a:eq(0) img").attr("src","./images/pay.jpg");
	})
	$(".payType a:eq(1)").click(function(){
		$(".payType a:eq(0) img").attr("src","./images/pay.png");
	})
	//点击实现更多的银行
	$(".img li:gt(10)").hide();
    $(".img li:last-child").show();
    var bool=true;
	$(".img #more").click(function(){
		if(bool){
			bool=false;
			$(".img li:gt(10)").show();
			$(".img #more").text("收起");
		}else{
			bool=true;
			$(".img li:gt(10)").hide();
			$(".img li:last-child").show();
			$(".img #more").text("更多银行");
		}
		
	})
	//弹窗确认支付
	$(".sub").click(function(event){
		if(event.preventDefault){
			event.preventDefault();
		}else{
			event.returnValue=false;
		}
        var con;
		con=confirm("你确定支付吗?"); //在页面上弹出对话框
		if(con==true){
			location.href="pay_sucess.html";
		}
		else {
			return false;
		};
		    })
})
