$(function(){
	//实现点击显示更多支付方式
	$(".checked").hide();
	$(".bank ul li:gt(2)").hide();
	var bool=true;
	$(".otherType a").click(function(){
		if(bool){
			bool=false;
			$(".bank ul li:gt(2)").show();
		}else{
			bool=true;
			$(".bank ul li:gt(2)").hide();
		}
	})
	$(".payOrder img").click(function(){
		history.back()
	})
})
