$(function(){
	var reg_user = /^(?!\d)\w\w{7,15}$/;//8到16个字符，首字母不要有数字
 	var reg_pass = /^[\w!@#$%^&*,.<>]{8,20}$/; //8到20个字符
	$("#username").change(function(){
		var user = $("#username").val();
		if(user.trim() === "" || !reg_user.test(user)){
			$(".userWarn").show();
			return;
		}else{
			$(".userWarn").hide();
		}
	})
	$("#username").focus(function(){
			$(".userNo").hide();
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
	
	$("#btn_login").click(function(event){
		//清除默认事件
		event.preventDefault();
		var user = $("#username").val();
		var pass = $("#password").val();
		var reg_user = /^[a-zA-Z_]\w{7,15}$/; //8到16个字符，首字母不要有数字
		var reg_pass = /^[\w!@#$%^&*,.<>]{8,20}$/; //8到20个字符
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
		//限制按钮
		$("#btn_login").val("登录中...(^_^)").prop("disabled",true);
		//ajax提交登录请求
		$.ajax({
			type:"post",
			url:"admin/login.php",
			async:true,
			data:{
				"user":user,
				"pass":hex_md5(pass)   //提交的密码经过加密
			},
			success:function(msg){
				//恢复按钮
				$("#btn_login").val("登录").prop("disabled",false);
				//json数据转换
				var json = JSON.parse(msg);
				if(json.type == "success"){
					//document.cookie = "user="+user;
					localStorage.setItem("user",user);//跨页面验证
//					rememberPass();
					//登录成功操作
					$("#username").val("");
					$("#password").val("");
					
					location.href = "homepage.html";
				}else{
					//判断错误情况
					switch(json.code){
						case "1":
							$(".userNo").show();
							break;
						case "2":	
							$(".passWarn").show();
							break;
						default:
							alert("发生未知错误");
					}
				}
			},
			error:function(){
				$("#btn_login").val("登录").prop("disabled",false);
				alert("服务器连接失败，请检查网络");
			}
		});
	});
	
//	function rememberPass(){
//		if($("#ckbox").prop("checked")){
//			var pass = $(".password").val();
//			//密码不能直接保存在本地中
//			//对密码进行加密  md5
//			pass = hex_md5(pass);
//			localStorage.setItem("pass",pass);//记住密码
//		}
//	}
var bool=true;
	$(".btn").click(function(){
		if(bool){
			bool=false;
			$(".btn").animate({left:"0.84rem"},100);
			$("#password").attr("type","text");
			$(".show span:eq(0)").css("marginLeft","0.1rem");
		}else{
			bool=true;
			$(".btn").animate({left:"0"},100);
			$("#password").attr("type","password");
			$(".show span:eq(0)").css("marginLeft","0.75rem");
		}
		
	})
	
})
