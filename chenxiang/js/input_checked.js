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
	    })
//	})	
})
