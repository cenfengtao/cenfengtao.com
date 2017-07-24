//复选框的勾选

$(function(){
	var bool=true;
//	$(".border").each(function(i){
		$(".border").click(function(){
			if(bool){
				bool=false;
				
				$(".border").attr("src","./images/checked_border.png");
				$(".border").next().val(0);
				if($(".check").val(1)){
				$(".check").attr("src","./images/checked_border.png");
				$(".check").val(0);
				}
			}else{
				bool=true;
				$(".border").attr("src","./images/checked.png")
				$(".border").next().val(1);
				if($(".check").val(0)){
				$(".check").attr("src","./images/checked.png");
				$(".check").val(1);
				}
			}
//		})
	})
	checkAll()
	totalSum()
	checkedNum()
})

