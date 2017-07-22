$(function(){
	//为筛选绑定点击事件显示与隐藏下拉列表
	var bool=true;
	$(".chose").click(function(){
		if(bool){
			bool=false;
			$(".choseText").show();
		}else{
			bool=true;
			$(".choseText").hide();
		}
		
	})
    $(".search input").focus(function(){
    	$(".search input").css("background-image","none");
    })
})
//点击加入购物车上传数据到本地存储
function setProduct(){
	var imgSrc = ["images/shop_cart1.jpg","images/pro_details2.jpg","images/pro_details3.jpg","images/pro_details4.jpg","images/pro_details5.jpg","images/pro_list1.jpg","images/pro_list2.jpg"];
	var id = parseInt(Math.random()*7);
	var img = imgSrc[id];
//	console.log(img);
	var num = 1;
	var price = 16.80;
	var product = {
		imgSrc:img,
		num:num,
		price:price,
		id:id,
		totalPrice:(price*num).toFixed(2)
	}
	addShopCar(product);
//	proNum();
}