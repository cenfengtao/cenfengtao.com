
//当页面加载时触发获取优惠后的总计值
function countAll(){
	count()
}
//复选框的勾选
$(function(){
//	var bool=true;
//	$(".border").each(function(i){
		$(".border").click(function(){
			var border=document.getElementsByClassName("border")[0];
			var check=this.parentNode.getElementsByTagName("input")[0];
			if(check.value==1){
				this.src="./images/checked_border.png";
				check.value=0;
			}else if(check.value==0){
				this.src="./images/checked.png";
				check.value=1;
			}
			count()
	    })
//	})	
})
//确定订单页实现勾选商品后优惠得到总计
function count(){
	var less=document.getElementsByClassName("less")[0];
	var payable=document.getElementsByClassName("payable")[0];
	var pro=document.getElementsByClassName("pro");
	var count=document.getElementsByClassName("total")[0];
	var sum=0;
	for(var i=0;i<pro.length;i++){

		var checkValue=pro[i].getElementsByClassName("checked")[0].value;
		var price = parseFloat(pro[i].getElementsByClassName("price")[0].innerHTML.slice(1));
		var num=parseFloat(pro[i].getElementsByClassName("num")[0].innerHTML.slice(1))
		if(checkValue==1){
			sum+=price*num;
		}
		
	}
	if(sum==0){
		payable.innerHTML="¥0.00";
		less.innerHTML="¥0.00";
	}else{
		less.innerHTML=" ¥-66.8";
		payable.innerHTML="¥"+(sum-66.8).toFixed(2);
	}
	count.innerHTML="￥"+sum.toFixed(2);
	
}

//实现地址的增多与收起
$(function(){
	$(".message ul li:eq(0)").show();
	$(".message ul li:gt(0)").hide();
	var bool =true;
	$(".more").click(function(){
		if(bool){
			bool=false;
			$(".message ul li:gt(0)").show();
			$(".message ul li:eq(0)").show();
			$(".more span").text("收起");
			
		}else{
			bool=true;
			$(".message ul li").hide();
			$(".message ul li:eq(0)").show();
			$(".more span").text("更多地址");
			
		}
	})
	
	$(".del").click(function(){
		var con;
		con=confirm("你确定要删除吗?"); //在页面上弹出对话框
		if(con==true){
			$(this).parent().remove();
		}
		else {
			return false;
		};
		if($(".message ul li").length==1){
				$(".more").text("更多地址");
			}
		if($(".message ul li").length==0){
				$(".more").text("");
			}
	})
})
