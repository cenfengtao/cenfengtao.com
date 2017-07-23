//复选框的勾选
$(function(){
	var bool=true;
	$(".border").click(function(){
		if(bool){
			bool=false;
			$(this).attr("src","./images/checked_border.png");
			$(this).next().attr("checked",false);
		}else{
			bool=true;
			$(this).attr("src","./images/checked.png");
			$(this).next().attr("checked",true);
		   }
  })
		$(".check").click(function(){
			if(bool){
				bool=false;
				$(this).prev().prev().attr("src","./images/checked_border.png");
				$(this).prev().attr("checked",false);
			}else{
				bool=true;
				$(this).prev().prev().attr("src","./images/checked.png")
				$(this).prev().attr("checked",true);
			   }
	   })
})
//返回本地数据
function getUserLoginInfo(userKey){
	return localStorage.getItem(userKey);
}
//点击登录时触发
function submitInput(){
	var emailValue = document.getElementById("email").value;
	var passwordValue = document.getElementById("password").value;
	var code=document.getElementById("code").value;
	if(emailValue == "" || passwordValue == ""){
		return false;
	}
	if(code == ""){
		$(".code_prompt").show();
		return false;
	}else{
		$(".code_prompt").hide();
	}
	var userInfos = getUserLoginInfo("userInfos");
	if(!userInfos){
		alert("该用户未注册！请先注册！")
		return false;
	}else{
		var userData = JSON.parse(userInfos);
		var bool = true;
		for(var i=0;i<userData.length;i++){
			if(userData[i].userName == emailValue){
				if(userData[i].password == passwordValue){
					bool = false;
					return true;
					break;
				}else{
					alert("密码不正确！")
					bool = false;
					return false;
					break;
				}
			}
		}
		if(bool){
			alert("该用户未注册！请先注册！");
			return false;
		}
	}	
	var emailValue = document.getElementById("email").value;
	var passwordValue = document.getElementById("password").value;
	//做一个判断，如果用户名和密码其中一个是"",那么就返回false，阻止表单提交
	if(emailValue == "" || passwordValue == ""){
		return false;
	}
	var isLogin = document.getElementById("rememberMe").checked;
	setCookie(emailValue,passwordValue,isLogin)
}
//function submitInput(){
//	var emailValue = document.getElementById("email").value;
//	var passwordValue = document.getElementById("password").value;
//	//做一个判断，如果用户名和密码其中一个是"",那么就返回false，阻止表单提交
//	if(emailValue == "" || passwordValue == ""){
//		return false;
//	}
//	var isLogin = document.getElementById("rememberMe").checked;
//	setCookie(emailValue,passwordValue,isLogin)
//}
//设置cookie
function setCookie(email,password,isLogin){
	//判断是否勾选复选框（是否勾选记住我）
	if(isLogin){   //如果勾选，就执行if里面的代码（设置cookie）
		var nowDate = new Date();
		//设置cookie过期时间
		nowDate.setTime(nowDate.getTime()+1000*60);
		document.cookie = "email="+email+";expires="+nowDate.toUTCString()+";path=/";
		document.cookie = "password="+password+";expires="+nowDate.toUTCString()+";path=/";
		document.cookie = "isLogin="+isLogin+";expires="+nowDate.toUTCString()+";path=/";
	}else{   //如果没有勾选，就设置cookie的值为空
		document.cookie = "email=";
		document.cookie = "password=";
		document.cookie = "isLogin=";
	}
}
//获取cookie
function getCookie(){
	var cookies = document.cookie;
	//email=dfsdf@qq.com; password=987654
	//做一个判断，cookie的长度大于0
	if(cookies.length > 0){
		//通过split()方法，将cookie分割成多个数据
		var cookieAll = cookies.split(";");
		//将分割出来的多个数据再进行分割，分割成键值对的形式
		var email = cookieAll[0].split("=");
		var password = cookieAll[1].split("="); 
		var isLogin = cookieAll[2].split("=");
		//把值赋值给对应的输入框
		document.getElementById("email").value = email[1];
		document.getElementById("password").value = password[1];
		document.getElementById("rememberMe").checked = isLogin[1];
	}
	
}
//	var isLogin = document.getElementById("rememberMe").checked;
//	setStorage(emailValue,passwordValue,isLogin)
//}
//function setStorage(email,password,isLogin){
//	var userLoginInfo = {
//		email:email,
//		password:password,
//		isLogin:isLogin
//	}
//	if(isLogin){   
//		localStorage.setItem("userLoginInfo",JSON.stringify(userLoginInfo))
//	}else{
//		localStorage.removeItem("userLoginInfo");
//	}
//}
//function getStorage(){
//	var data = localStorage.getItem("userLoginInfo");
//	if(data){
//		var storageData = JSON.parse(data);
//		document.getElementById("email").value = storageData.email;
//		document.getElementById("password").value = storageData.password;
//		document.getElementById("rememberMe").checked = storageData.isLogin;
//	}
//}

//用户的正则验证
var testEmail = function(value){
	var reg = /^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/;
	if(!reg.test(value)){
		$(".user_prompt").show();
	}else{
		$(".user_prompt").hide();
	}
}
//密码的正则验证
var testPassword = function(value){
	var reg = /^[a-z0-9_-]{6,18}$/;
	if(!reg.test(value)){
		$(".pass_prompt").show();
	}else{
		$(".pass_prompt").hide();
	}
}
//验证码的验证
var testCode = function(value){
    var code=document.getElementById("code").value;
	if(code == ""){
		$(".code_prompt").show();
	}else{
		$(".code_prompt").hide();
	}
}
//实现验证码图片点击可切换
$(function(){
	var i=1;
	$(".code img").click(function(){
	 	i+=1;
	    if(i>3){
	    	i=1
	    }
		$(".code img").attr("src","./images/code_"+i+".jpg")
		})
})
