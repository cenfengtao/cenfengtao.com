define(function(require, exports, module) {
  // 通过 require 引入依赖
    var $ = require('zepto');
	$(".order.short").on('click',function(){
		$this=$(this);
		$this.removeClass("short");
		$this.addClass("long");
		$this.find("a").show();
		setTimeout(function(){
			$this.removeClass("long");
			$this.addClass("short");
		},2000);
		setTimeout(function(){
			$this.find("a").hide();
		},4000)
		
	});
});
