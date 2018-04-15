function submituserinfo(){
	var params = {};
	params.id = $("#id").val();
	params.username = $("#username").val();
	params.mobile = $("#mobile").val();
	params.areaId1 = $('#areaId1').val();
	params.areaId2 = $('#areaId2').val();
	params.areaId3 = $('#areaId3').val();
	params.address = $("#address").val();

    if (params.username=="") {
    	alert("姓名不能空");
			return;	
    }
    
    if(params.mobile==""){
			alert("请输入手机号码或固定电话");
			return;		
		}

		if($('#mobile').length>0){
					if(!/^1(3|4|5|7|8){1}\d{9}$/.test(params.mobile)){
						alert("手机号码格式不正确，请重新填写");
						return;
					}
				}

	if(params.areaId1<1){
	   		alert("请选择省");
			return;		
		}
		if(params.areaId2<1){
			alert("请选择市");
			return;		
		}
		if(params.areaId3<1){
			alert("请选择区县");
			return;		
		}
	
		if(params.address==""){
			alert("请输入详细地址");
			return;		
		}
	$.post("/index.php/Lottery/confirmsave",params,function(res){
        if (res.status==1) {
        	alert(res.msg);
        	location.href = "/index.php/Lottery/userAddress";
        }
	})
}