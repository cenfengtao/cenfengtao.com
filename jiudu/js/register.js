$(function(){
	$(".checked").hide();
	
	//清空表单
	function clearForm(){
		$("#username").val("");
		$("#password").val("");
		$("#tel").val("");
		$("#code").val("");
	}
	
	var reg_user = /^[a-zA-Z_]\w{7,15}$/; //8到16个字符，首字母不要有数字
	var reg_pass = /^[\w!@#$%^&*,.<>]{8,20}$/; //8到20个字符
	var reg_mphone = /^1[3-9]\d{9}$/;  //手机
	var reg_code = /^[a-zA-Z\d]{4}$/;	//验证码
	
	
	$("#username").change(function(){
		var user = $("#username").val();
		if(user.trim() === "" || !reg_user.test(user)){
			$(".userWarn").show();
			return;
		}else{
			$(".userWarn").hide();
		}
	})
	 $("#password").change(function(){
	 	var pass = $("#password").val();
		if(pass.trim() === "" || !reg_pass.test(pass)){
			$(".passWarn").show();
			return;
		}else{
			$(".passWarn").hide();
		}
	})
	$("#tel").change(function(){
		var mphone = $("#tel").val();
		if(mphone.trim() === "" || !reg_mphone.test(mphone)){
			$(".telWarn").show();
			return;
		}else{
			$(".telWarn").hide();
		}
	})
	$("#code").change(function(){
		var code = $("#code").val();
		if(code.trim() === "" || !reg_code.test(code)){
			$(".codeWarn").show();
			return;
		}else{
			$(".codeWarn").hide();
		}
	})
	
	$("#submit").click(function(event){
		var reg_user = /^[a-zA-Z_]\w{7,15}$/; //8到16个字符，首字母不要有数字
		var reg_pass = /^[\w!@#$%^&*,.<>]{8,20}$/; //8到20个字符
		var reg_mphone = /^1[3-9]\d{9}$/;  //手机
		var reg_code = /^[a-zA-Z\d]{4}$/;	//验证码
		//处理默认事件
		event.preventDefault();
		//获取控件的内容
		var user = $("#username").val();
		var pass = $("#password").val();
		var mphone = $("#tel").val();
		var code = $("#code").val();
		var checked=document.getElementsByClassName("checked")[0].checked;
		

		if(user.trim() === "" || !reg_user.test(user)){
			$(".userWarn").show();
			return;
		}else{
			$(".userWarn").hide();
		}


		if(pass.trim() === "" || !reg_pass.test(pass)){
			$(".passWarn").show();
			return;
		}else{
			$(".passWarn").hide();
		}


		if(mphone.trim() === "" || !reg_mphone.test(mphone)){
			$(".telWarn").show();
			return;
		}else{
			$(".telWarn").hide();
		}


		if(code.trim() === "" || !reg_code.test(code)){
			$(".codeWarn").show();
			return;
		}else{
			$(".codeWarn").hide();
		}
		if(!checked){
			$(".agreeWarn").show();
			return;
		}else{
			$(".agreeWarn").hide();
		}
		//设置点击之后的内容，同时限制多次点击
		$("#submit").val("注册中...").prop("disabled",true);
		//进行注册接口的调用
		$.ajax({
			type:"post",
			url:"./admin/reg.php",
			async:true,
			data:{
				//数据获取
				"user":user,
				"pass":pass,
				"mphone":mphone
			},
			success:function(data){
				console.log(data)
				$("#submit").val("下一步").prop("disabled",false);
				//将后端返回的字符串数据转成json
				var json = JSON.parse(data);
				//通过判断json数据的不同，进行不同的操作
				if(json.type === "error"){
					switch(json.code){
						case "1":
							alert("该用户已经被注册");
							break;
						default:
							alert("发生未知错误，code：" + json.code);
					}
				}else{
					alert("注册成功");
					clearForm();
					location.href = "login.html";
//					var loginData={"user":user,"pass":hex_md5(pass),"mphone":hex_md5(mphone)};
//	            	localStorage.setItem("isLogin",JSON.stringify(loginData));
				}
			},
			error:function(){
				alert("请完善注册信息再点击");
				$("#submit").val("下一步").prop("disabled",false);
			}
		});
		
	});
	var vcode = "";
			//one使绑定的事件只能触发一次
			$(".l_tel").one("click",getVcode);
			
			//获取验证码操作
			function getVcode(){
				vcode = Math.floor(Math.random()*(999999-100000+1)+100000);	
				console.log(vcode);
				//设置按钮的颜色
				$(".l_tel").css({
					"width":$(".l_tel").width()
				});
				//倒计时
				var second = 60;
				$(".l_tel").text(second+"秒");
				//
				var timer = setInterval(function(){
					second -= 1;
					$(".l_tel").text(second+"秒");
					if(second == 0){
						clearInterval(timer);//关闭倒计时
						$(".l_tel").text("获取验证码");
					}
				},1000);
			}
})
