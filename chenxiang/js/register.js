//获取本地存储数据
function getUserData(userKey){
	return localStorage.getItem(userKey)
}
//当点击注册时触发
function submitForm(){
	var userName = document.getElementById("userName").value;
	var password = document.getElementById("password").value;
	var repassword=document.getElementById("repassword").value;
	var email=document.getElementById("email").value;
	var tel=document.getElementById("tel").value;
	var code=document.getElementById("code").value;
	if(!userName || !password||!repassword||!email||!tel||!code){
		return false;
	}
	if($(".user_prompt").css("display") == "block" ||$(".pass_prompt").css("display") == "block"||$(".repass_prompt").css("display") == "block"||$(".email_prompt").css("display") == "block"||$(".tel_prompt").css("display") == "block"){
		return false;
	}
	var userInfo = {
		userName:userName,
		password:password,
		repassword:repassword,
		email:email,
		tel:tel,
		code:code
	}
	//setUserInfoStorage(userInfo)
	
	var userData = getUserData("userInfos");
	if(!userData){
		var userInfos = [
			userInfo
		];
		localStorage.setItem("userInfos",JSON.stringify(userInfos))
	}else{
		var data = JSON.parse(userData);
		var bool = true;
		for(var i=0;i<data.length;i++){
			if(data[i].userName == userInfo.userName){
				alert("该用户已被注册！");
				bool = false;
				return false;
				break;
			}
		}
		if(bool){
			data.push(userInfo);
			localStorage.setItem("userInfos",JSON.stringify(data))
		}
	}
}
//用户的正则验证
var testUsername = function(value){
	var reg = /^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.(com|cn|net))+$/g;
	if(!reg.test(value)){
		$(".user_prompt").show();
		return false;
	}else{
		$(".user_prompt").hide();
	}
}
//密码的正则验证
var testPassword = function(value){
	var reg = /^[a-zA-Z]\w{5,17}$/;
	if(!reg.test(value)){
		$(".pass_prompt").show();
		return false;
	}else{
		$(".pass_prompt").hide();
	}
}
//确认密码的正则验证
var testRepassword = function(value){
	var reg = /^[a-z0-9_-]{6,18}$/;
	var val=document.getElementById("password").value;
	if(!reg.test(value)||value!=val){
		$(".repass_prompt").show();
		return false;
	}else{
		$(".repass_prompt").hide();
	}
}
//邮箱的正则验证
var testEmail = function(value){
	var reg = /^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.(com|cn|net))+$/g;
	if(!reg.test(value)){
		$(".email_prompt").show();
		return false;
	}else{
		$(".email_prompt").hide();
	}
}
//电话号码的正则验证
var testTel=function(value){
	var reg=/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/;
	if(!reg.test(value)){
		$(".tel_prompt").show();
		return false;
	}else{
		$(".tel_prompt").hide();
	}
}


//实现复选框的勾选功能
$(function(){
	var bool=true;
//	$(".border").each(function(i){
		$(".border").click(function(){
			if(bool){
				bool=false;
				$(this).attr("src","./images/checked_border.png");
				$(this).next().attr("checked",false);
			}else{
				bool=true;
				$(this).attr("src","./images/checked.png")
				$(this).next().attr("checked",true);
			    }
//		})
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
//		})
	   })
})
