
$(function(){
	//实现商品类型点击可切换功能
	$(".type >span").click(function(){
		var index=$(this).index();
		$(".type span").eq(index).addClass("on").siblings().removeClass("on");
		$(".content >div").eq(index).css("display","block").siblings().css("display","none");
	})
	//实现删除整行商品
	$(".del").click(function(){
	var checkValue=$(this).parent().parent().children().children("input").val();
	if(checkValue==1){
		var con=confirm("确定要删除这行商品吗？");
		if(con){
			$(this).parent().parent().remove()
		}else{
			return false;
		}
	}else{
		alert("只有先勾选了之后才能再删除商品。")
	}
	})
})

//实现点击删除整行数据

