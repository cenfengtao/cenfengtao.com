define(function(require, exports, module) {
  // 通过 require 引入依赖
  var $ = require('zepto');
  if($('#header_go_back').length>0){
  	  	require.async('modules/common/history.js', function(controller){
	    });
  }
  if($('#form_sign_button').length>0){
	 	require.async('modules/form/form.js', function(controller){
			  controller.submit('form_sign_button','signform');
	    });
  }
  if($('#shareContainer').length>0){
  	 require.async('modules/common/share.js', function(controller){
	}); 
  }
  if($('#redpack_integral').length > 0) {
	  var redpack_jifen = parseInt($("#redpack_integral").data("jifen"));
	  var redpack_min_money = parseInt($("#redpack_integral").data("minmoney"));
	  $("#redpack_money").change(function(){
			var money = parseInt($("#redpack_money").val());
			$("#redpack_integral").html(money * redpack_jifen);
			if(money > 0) {
				//$("#redpack_sub_btn");
			}
		});
		$("#redpack_sub_btn").click(function(){
			var money = parseInt($("#redpack_money").val());
			if(money > 0) {
				if(money >= redpack_min_money) {
					$("#redpack_form").submit();
				} else {
					alert("兑换金额小于最低兑换金额");
				}
			} else {
				alert("请输入兑换金额");
			}
		})
  }



 $('#verify_sms_sn1').blur(function(){
 	var verify=$(this).val();
 	$.post($("#verify_sms_sn1").data("sms_url"),{'verify':verify},function(em){
 		var json=JSON.parse(em);
 		if(json.status==1){
 			$('#btn_sms_send').attr('status',1);
 		}else if(json.status==0){
 			$('#btn_sms_send').attr('status',0);
 			alert(json.info);
 		}
 	});
 });	

if($("#btn_sms_send").length > 0) {
	var count=60;
	$("#btn_sms_send").on("click",function(){
		send_vefiry();
	});
}
function send_vefiry(){
	var tel=$("#mobile").val();
	var data = {mobile:tel};
	if(!tel){
		alert("请输入手机号!");
		return false;
	}
	/*if(!/^(1(3|4|5|7|8|){1}\d{9})|(\d{3,4}-?\d{8})$/.test(tel)){*/
	if(!/^1(3|4|5|8|7){1}\d{9}$/.test(tel)){	
		alert("手机号码格式不正确，请重新填写");
		return false;
	}
	//data.mobile=$('#mobile').val();
	if(!$('#btn_sms_send').hasClass("gray")){
		count=60;
		timer=setInterval(function(){
			if(count<=0){
				$("#btn_sms_send").text("接听验证码");
				//count=60;
				$("#btn_sms_send").removeClass("gray");
				clearInterval(timer);
			}else{
				$("#btn_sms_send").text(count+"s后可以重发");
				count--;
			}
		}, 1000);
		$('#btn_sms_send').addClass("gray");
		$.post($("#btn_sms_send").data("sms_url"),data,function(res){
			if(res.code!=1){
				clearInterval(timer);
				timer=0;
				$('#btn_sms_send').removeClass('gray').text('接听验证码');
				alert(res.msg);
			}
		});
	}
}
  var previewImage=function(wrapper){
	  if(wrapper||wx){
	  	var imageList=wrapper.getElementsByTagName('img');
	  	var imagesrclist=[];
	  	if(imageList){
	  		for(var i=0;i<imageList.length;i++){
	  			var currentImage=imageList.item(i);
	  			var src=currentImage.getAttribute('src')||currentImage.dataset['src'];
	  			if(src){
	  				imagesrclist.push(src);
	  			}
	  			currentImage.addEventListener('click',function(){
	  				var src=this.getAttribute('src');
	  				wx.previewImage({
	  				 	current: src, 
    					urls: imagesrclist
    				});
	  			},false);
	  		}
	  	}
	  }
  };
  module.exports={previewImage:previewImage};
});

function alert(text, time, fn){
	var d = new iDialog();
	var args = {
		classList: "alert",
		title:"",
		close:"",
		content:'<div class="icon success"></div><div style="padding:10px 30px;line-height:23px;text-align:center;font-size:16px;color:#ffffff;">'+text+'</div>'
	};
	var timer = null;
	var time = time || 3000;
	if(fn){
		args.btns = [
			{id:"", name:"确定", onclick:"fn.call();", fn: function(self){
				!fn.call()&&self.die();
				time&&clearTimeout(timer);
			}}
		];
	}
	d.open(args);
	if(time){
		timer = setTimeout(function(){
			d.die();
			clearTimeout(timer);
		}, time);
	}
}
function confirm(text, fn1, fn2){
	var d = new iDialog();
	var args = {
		classList: "tip",
		title:"",
		close:"",
		content:text
	};
	args.btns = [
		{id:"", name:"确定", onclick:"fn.call();", fn: function(self){
			fn1&&fn1.call(this);
			self.die();
		}},
		{id:"", name:"取消", onclick:"fn.call();", fn: function(self){
			fn2&&fn2.call(this);
			self.die();
		}}
	];
	d.open(args);
}



function tip(text, time){
	var d = new iDialog();
	d.open({
		classList: "tip",
		title:"",
		close:"",
		content:text,
		btns:[
			{id:"", name:"确定", onclick:"fn.call();", fn: function(self){
				console.log("queding");
			}},
			{id:"", name:"取消", onclick:"fn.call();", fn: function(self){
				self.die();
			}}
		]
	});
}

//页面转跳
function redirect(url,time)
{
	if (undefined == url || url == '') {
		url = location;
	}
	
	if (undefined == time ) {
		time = 20;
	}
	setTimeout("location.href='"+url+"'",20);
}

function loading(type){
	if(type){
		window.loader = new iDialog();
		window.loader.open({
			classList: "loading",
			title:"",
			close:"",
			content:''
		});
	}else{
		//setTimeout(function(){
			window.loader.die();
			delete window.loader;
		//}, 100);
	}
	
}

