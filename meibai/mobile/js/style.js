$(function(){

    $(".proShow .container ul li:gt(5)").hide();
    var tag=true;
	$(".proShow>a").click(function(){
		if(tag){
			$(".proShow .container ul li:gt(5)").slideDown(500,function(){
				tag=false;
			});
			$(".proShow>a").text("隐藏商品");
		}else{
			$(".proShow .container ul li:gt(5)").slideUp(500,function(){
				tag=true;
			});
			$(".proShow>a").text("显示更多");
		}
	})

	$(".news >section ul li:gt(4)").hide();
    var tag=true;
	$(".news>section>a").click(function(){
		if(tag){
			$(".news >section ul li:gt(4)").slideDown(500,function(){
				tag=false;
			});
			$(".news>section>a").text("隐藏新闻");
		}else{
			$(".news >section ul li:gt(4)").slideUp(500,function(){
				tag=true;
			});
			$(".news>section>a").text("显示更多");
		}
	})

	
})