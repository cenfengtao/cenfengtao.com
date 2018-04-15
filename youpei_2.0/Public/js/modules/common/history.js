define(function(require, exports, module) {
  // 通过 require 引入依赖
    var $ = require('zepto');
	$("#header_go_home").addClass('icon_home3').show();
	$("#header_select").addClass('icon_select3').show();
 	if(history.state){
	if(history.state=='1'){
			$('#header_go_back').addClass('icon_back').show();
			$('#header_go_back').on('click',function(){
				history.go(-1);
			});
		}else{
			$('#header_go_back').addClass('icon_back').show();
			$('#header_go_back').on('click',function(){
				history.go(-1);
			});
		}
	}else{
		if(history.length>1){
			history.replaceState(history.length,'',location.href);
			$('#header_go_back').addClass('icon_back').show();
			$('#header_go_back').on('click',function(){
				history.go(-1);
			});
		}else{
			history.replaceState(1,'',location.href);
			$('#header_go_back').addClass('icon_back').show();
			$('#header_go_back').on('click',function(){
				history.go(-1);
			});
		}
	}
});

