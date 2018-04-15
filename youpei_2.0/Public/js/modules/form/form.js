
define(function(require, exports, module) {
  
  var $ = require('zepto');
  
  $(".checkbox_label").click(function(){
  	if($("#cb_agree").prop("checked")){
		$(".button").removeClass("btn_disabled");
	}else{
		$(".button").addClass("btn_disabled");
	}
  });
  
  module.exports = {
  	submit:function(button_id,formid){
		if($('#'+button_id).length>0){
			$('#'+button_id).on('click',function(){
				if($(this).hasClass("btn_disabled")){
					return;
				}
				if($('#name').length>0&&$('#name').val()==''){
					alert('姓名不能为空');
					return;
				}
					if($('#verify').length>0&&$('#verify').val()==''){
					alert('验证码不能为空');
					return;
				}
				
				if($('#num').length>0&&$('#num').val()==''){
					alert('工号不能为空');
					return;
				}
				if($('#mobile').length>0&&$('#mobile').val()==''){
					alert('手机号不能为空');
					return;
				}
				
				if($('#mobile').length>0){
					var tel=$("#mobile").val();
					if(!/^1(3|4|5|7|8){1}\d{9}$/.test(tel)){
						alert("手机号码格式不正确，请重新填写");
						return false;
					}
				}
				
				if($('#no').length>0&&$('#no').val()==''){
					alert('工号不能为空');
					return;
				}
				if($('#idcard').length>0 && $('#idcard').attr("verify") != 'none'){
					var str=$("#idcard").val();
					if(!/^(\d{15})|(\d{18})$/.test(str)){
						alert("身份证格式不正确，请重新填写");
						return false;
					}
				}
				
				if($('#bank').length>0 && $('#bank').attr("verify") != 'none'){
					var str=$("#bank").val();
					if(!/^\d{19}$/.test(str)){
						alert("银行卡格式不正确，请重新填写");
						return false;
					}
				}
				
				
				if($('#estate_id').length>0&&$('#estate_id').val()==''){
					alert('项目不能为空');
					return;
				}
				if($('#building_id').length>0&&$('#building_id').val()==''){
					alert('产品不能为空');
					return;
				}
				if($('#amount').length>0&&$('#amount').val()==''){
					alert('金额不能为空');
					return;
				}
				if($('#verify_sms_sn').length>0){
					if($('#verify_sms_sn').val()==''){
						alert('验证码不能为空');
						return;
					}
					var check = false;
					var data = {};
					data.verify_sms_sn=$('#verify_sms_sn').val();
					$.ajax({  
						url:$("#btn_sms_send").data("sms_check_url"),
						data:data,
						async : false,
						dataType: "json",
						success:function(res){
							if(res == 1) {
								check = true;
							}
						}						
					});
					if(check == false) {
						alert("手机验证码不正确!");
						return ;
					}
				}
				if($('#verify').length>0){
                 	if($('#verify').val()==''){
						alert('验证码不能为空');
						return;
					}

					var check1 = false;
					var data = {};
					data.verify=$('#verify').val();
					$.ajax({  
						type:"post",
						url:$("#verifys").data("sms_check_url"),
						data:data,
						async : false,
						dataType: "json",
						success:function(res){
							if(res.status == 1) {
								check1  = true;

							}
						}						
					});
					if(check1 == false) {
						alert("验证码不正确!");
						return ;
					}
                 }
				$('#'+formid).submit();
			});
		}
	}
  }
});
