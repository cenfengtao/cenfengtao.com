//实现文本点击可切换获取当前状态
$(function(){
	$(".type a").click(function(){
		$(this).addClass("on").siblings().removeClass('on');
	})
})
//当文本框的商品数据发生改变时触发
function changeValue(){
	var page_num=document.getElementById("page_num");
	var num=page_num.value;
	if(isNaN(num)){
		num=1;
	}else if(num==""){
		num=1;
	}else if(num<1){
		num=1;
	}
	num =parseInt(num);
	page_num.value=num;
}