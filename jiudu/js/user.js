$(function(){
	winW=$(window).width();
	console.log(winW)
	if(winW>320){
		$(".see >span:eq(0) a:eq(0)").css({"marginBottom":"5px"},{"marginTop":"20px"});
		$(".see >span:eq(1) a:eq(0)").css({"marginBottom":"5px"},{"marginTop":"20px"});
	}
	$(window).resize(function(){
		location.reload();
		winW=$(window).width();
		console.log(winW)
		if(winW>320){
			$(".see span a:eq(0)").css({"marginBottom":"5px"},{"marginTop":"20px"});
			$(".see >span:eq(1) a:eq(0)").css({"marginBottom":"5px"},{"marginTop":"20px"});
		}
	})
})
