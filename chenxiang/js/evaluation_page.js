$(function(){
	//实现对商品的感觉勾选可切换
	$(".feel span").click(function(){
		var index=$(this).index();
		$(".feel span").eq(index).addClass("on").siblings().removeClass("on");
	})
	
	//实现星星评价功能
	$(".img img").click(function(){
		$(".img img").attr("src","images/star_white.png");
		var index=$(this).index()+1;
		for(var i=0;i<index;i++){
			$(".img img").eq(i).attr("src","images/star_red.png")
		}
	})
})

//实现上传本地图片
function F_Open_dialog() { 
    document.getElementById("btn_file").click(); 
} 