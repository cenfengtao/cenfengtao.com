$(function(){
	//点击图标实现删除搜索痕迹
	$(".del").click(function(){
		$(".often ul li").remove();
	})
	$(".search input").focus();
})
