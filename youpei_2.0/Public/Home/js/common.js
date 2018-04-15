
//tyui
var ty={render:[],api:"../api_v2/"};

ty.loadPage=function(p){
 	// $("body").addClass("kap-loading-tran");
   var hash = p.pageid;
    if(p.arg) hash += '/'+p.arg;
    // if(p.reload)   hash += '/'+p.reload;
    if(p.callback) hash += '/'+p.callback;
    window.location.href = hash;
}

//切换页面
ty.switchPage=ty.sp=function(id,silence){

    if(id==-1){
        $("body").data("ty-reload","0");
        window.history.go(-1);
        return;
    }

    if(!id)return false;
    var $page=kap.switchPage(id);
    if(!$page)return false;
    if(!$page.data("ty-tools")){
        var menus=[];
    }else{
        var menus=$page.data("ty-tools").split(",");
    }
    $(".ty-tools").removeClass("ty-tools-current");
    for(var i=0;i<menus.length;i++){
        var menu=menus[i];
        $(menu).addClass('ty-tools-current');
    }
    if($(".ty-menu-top .ty-tools-current").length>0 && $(".ty-menu-bottom .ty-tools-current").length>0){
        $("body").removeClass("ty-view-top");
        $("body").removeClass("ty-view-bottom");
        $("body").addClass("ty-view-all");
    }else if($(".ty-menu-top .ty-tools-current").length>0){
        $("body").removeClass("ty-view-all");
        $("body").removeClass("ty-view-bottom");
        $("body").addClass("ty-view-top");
    }else if($(".ty-menu-bottom .ty-tools-current").length>0){
        $("body").removeClass("ty-view-all");
        $("body").removeClass("ty-view-top");
        $("body").addClass("ty-view-bottom");
    }else{
        $("body").removeClass("ty-view-all");
        $("body").removeClass("ty-view-top");
        $("body").removeClass("ty-view-bottom");
    }
    $(".ty-menu-top-hide").removeClass("ty-menu-top-hide");

    var render_click=ty.render["click"];
    if(render_click!=null){
        if(!silence){
            $page.find("[data-ty-target]").unbind().click(function(){
				//$("body").addClass("kap-loading-tran");
                render_click($(this));
            });
        }
    }


    var render=ty.render[$page.attr("id")];
    if(render!=null)render($page,silence);

    $page.scroll();


    return $page;

}

//底部弹出
ty.popBottom=function(arg){
    //arg:{title:,html:,submit:{label:,callback},cancel:,height:}
    if(!arg.submit){
        arg.submit={label:'确定',callback:function(){}}
    }else{
        if(!arg.submit.callback){
            arg.submit.callback=function(){}
        }
        if(!arg.submit.label){
            arg.submit.label="确定";
        }
    }
    var html='<div class="ty-popbottom">';
    html+='<div class="title">'+arg.title+'<span class="btn-close" data-icon="&#x103;"></span></div>';
    html+='<div class="content">'+arg.html+'</div>';
    html+='<div class="btn-submit">'+arg.submit.label+'</div>'
    html+='</div>';
    if(!arg.height)arg.height=12.5;
    var $t=kap.popBottom({
        html:html,
        blur:true,
        height:arg.height+"rem"
    });
    $t.find(".content").css("height",arg.height-6.875+"rem");
    $t.find(".btn-submit").click(function(){
        arg.submit.callback();
        kap.popBottom(false);
    });
    $t.find(".btn-close").click(function(){
        if(arg.cancel!=null){
            arg.cancel();
        }
        kap.popBottom(false);
    });
    return $t;

}

//底部弹出
ty.popBottom2=function(arg){
    //arg:{title:,html:,submit:{label:,callback},cancel:,height:}
    if(!arg.submit){
        arg.submit={label:'确定',callback:function(){}}
    }else{
        if(!arg.submit.callback){
            arg.submit.callback=function(){}
        }
        if(!arg.submit.label){
            arg.submit.label="确定";
        }
    }
    var html='<div class="ty-popbottom">';
    html+='<div class="title">'+arg.title+'<span class="btn-close" data-icon="&#x103;"></span></div>';
    html+='<div class="content">'+arg.html+'</div>';
    html+='</div>';
    if(!arg.height)arg.height=10.5;
    var $t=kap.popBottom({
        html:html,
        blur:true,
        height:arg.height+"rem"
    });
    $t.find(".content").css("height",arg.height-6.875+"rem");
    $t.find(".btn-close").click(function(){
        if(arg.cancel!=null){
            arg.cancel();
        }
        kap.popBottom(false);
    });
    return $t;

}

//分享
ty.showShare=function(arg){
    if(arg){
        if($(".ty-win-share").length<1){
			if(arg == "friend"){
				$(".ty-win-share").remove();
				$("body").append($("#template_share_friend").html());
			}else{
				$(".ty-win-share").remove();
				$("body").append($("#template_share").html());
			}
        }
        kap.mask(true);
        $(".ty-win-share").unbind().click(function(){
            ty.showShare(false);
        })
        $(".ty-win-share").show();
    }else{
        kap.mask(false);
       $(".ty-win-share").hide().remove();
    }
}

ty.showAppShare=function(){
    //template_share_wx
    var $win=ty.popBottom({
        title:"分享到",
        html:$("#template_share_wx").html(),
        submit:{
            label:"取消"
        }
    });
}

//图集
ty.textPics=function($target){ //正文内文图，可重复设置
    if(!$target)var $target=$(".text-pics");
    $target.each(function(){
        //图片比
        //dom改造
        var $set=$(this);
        if($set.find(".pics").length>0)return;
        $set.find("img").wrapAll('<div class="pics"></div>');
        $set.height($set.width()*$set.data("height")/$set.data("width"));
        $set.append('<span class="pos"></span>');
        //改造完成
        var $pics=$set.find(".pics");
        var $pic_items=$pics.find("img");
        var $pos=$set.find(".pos");
        var cw=$set.width();
        var _count=$pic_items.length;
        var _pidx=0;
        $set.data("pos",0);
        $pic_items.each(function(i){
            $(this).css({
                width:cw,
                left:i*cw
            });
        });
        show(0);
        function show(idx){
            if(idx<0)idx=0;
            if(idx>$pic_items.length-1)idx=$pic_items.length-1;
            var np=-idx*cw;
            kap.css3trans($pics,"translateX("+np+"px)","0.5s");
            $set.data("pos",np);
            _pidx=idx;
            $pos.html((idx+1)+" / "+_count);

        }
        $set.bind("touchstart",function(e){
            var p=kap.pointerEventToXY(e);
            $(this).data("touch",p.x);
            $(this).data("touch-y",p.y);
            $set.data("touch-lock",false);
        });
        $set.bind("touchmove",function(e){
            if($set.data("touch-lock"))return;
            var p=kap.pointerEventToXY(e);
            var dis=p.x-$(this).data("touch");
            var disy=p.y-$(this).data("touch-y");
            if(Math.abs(disy)<Math.abs(dis)){
                //横向
                //if(!$set.data("touch-lock")){
                    e.preventDefault();
                    var np=$(this).data("pos")+dis;
                    kap.css3trans($pics,"translateX("+np+"px)");
                //}
            }else{
                $set.data("touch-lock",true);
            }
        });
        $set.bind("touchend",function(e){
            if($set.data("touch-lock"))return;
            var p=kap.pointerEventToXY(e);
            var disy=p.y-$(this).data("touch-y");
            var dis=p.x-$(this).data("touch");
            if(Math.abs(disy)+10<Math.abs(dis)){
                if(dis<-10){
                    show(_pidx+1);
                }else if(dis>10){
                    show(_pidx-1);
                }else{
                    show(_pidx);
                }
            }
        });
    });
}
ty.init=function(){
    kap.init();
    //菜单自动隐藏 data-ty-autohide=true
    var raf = window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.msRequestAnimationFrame ||
    window.oRequestAnimationFrame;
	var $window = $(window);
	var lastScrollTop = $window.scrollTop();

	if (raf) {
		loop();
	}

	function loop() {
		var scrollTop = $window.scrollTop();
		if (lastScrollTop === scrollTop) {
			raf(loop);
			return;
		} else {
			lastScrollTop = scrollTop;
			// 如果进行了垂直滚动，执行scroll方法
			ty_scroll();
			//console.log("requestAnimationFrame");
			raf(loop);
		}
	}
}

$(document).on("click","[data-ty-href]",function(){
	window.location.href = $(this).attr("data-ty-href");
}).on("click","[data-ty-url]",function(){
	current_hash = location.hash.replace("#","");
	$("body").data("ty-reload","1");
	var url = $(this).data("ty-url");
	if(url.indexOf("mp.weixin.qq.com")!=-1){
		window.open(url);
	}else{
		ty.loadPage({
			pageid:"#page_iframe",
			arg:"url="+encodeURIComponent(url)
		});
	}
});

//菜单自动隐藏 data-ty-autohide=true 201660823 updated
var _scrollPos=$(window).scrollTop();
$(".ty-menu-top,.ty-menu-bottom").data("ty-scrollpos",$(window).scrollTop());
//页面滚动事件
var ty_scroll = function () {
	var _top=$(window).scrollTop();
	//顶栏滚动判断
   	if($(".ty-menu-top .ty-tools-current").data("ty-autohide")){
        var _scrollPos=$(".ty-menu-top").data("ty-scrollpos");
        if(_top>_scrollPos){
            if(!$(".ty-menu-top").hasClass("ty-menu-top-hide") && _top>50){
                $(".ty-menu-top").addClass("ty-menu-top-hide");
            }
        }else if(_top<_scrollPos){
            if($(".ty-menu-top").hasClass("ty-menu-top-hide")){
               $(".ty-menu-top").removeClass("ty-menu-top-hide");
            }
        }
        $(".ty-menu-top").data("ty-scrollpos",_top);
    }
	//底栏滚动判断
    if($(".ty-menu-bottom .ty-tools-current").data("ty-autohide")){
        var _scrollPos=$(".ty-menu-bottom").data("ty-scrollpos");
        if(_top>_scrollPos){
            if(!$(".ty-menu-bottom").hasClass("ty-menu-bottom-hide")){
                $(".ty-menu-bottom").addClass("ty-menu-bottom-hide");
            }
        }else if(_top<_scrollPos){
            if($(".ty-menu-bottom").hasClass("ty-menu-bottom-hide")){
                $(".ty-menu-bottom").removeClass("ty-menu-bottom-hide");
            }
        }
        $(".ty-menu-bottom").data("ty-scrollpos",_top);
    }
	//各个单页滚动判断
	if(!$("body").hasClass("ty-ios")){
		if($("#page_hot").hasClass("kap-page-current")){
			var cat_top = $(".ty-special-rec").offset().top + $(".ty-special-rec").height();
			var cat_h = $("#tools_hot").height();
			if(_top - cat_top - cat_h > 450){
				//$(".ty-cat-tags").addClass("hide");
			}
			else if(_top - cat_top + cat_h > 0){
				$(".ty-cat-tags").addClass("fixed");
				$(".ty-cat-tags").removeClass("hide");
			}else{
				$(".ty-cat-tags").removeClass("fixed").removeClass("hide");
			}
		}else if($("#detail_activity").hasClass("kap-page-current")){
			var tag_top = $("#detail_activity .ty-detail-cover").offset().top + $("#detail_activity .ty-detail-cover").height();
			var bar_h = $(".act-tag").height();
			if(tag_top - _top < bar_h){
				$(".act-tag").addClass("fixed");
				if($(".kap-top").hasClass("ty-menu-top-hide")){
					$(".act-tag").addClass("top");
				}else{
					$(".act-tag").removeClass("top");
				}
			}else{
				$(".act-tag").removeClass("fixed");
			}
		}
		if($(".kap-page-current .tags-wrap").length>0){
			//20161116 updated
			var special_tag_top = $(".kap-page-current .tags-wrap").parent("div").offset().top - $(".kap-page-current .tags-wrap").height();
			if(_top > special_tag_top){
				$(".kap-page-current .tags-wrap").addClass("fixed");
			}else{
				$(".kap-page-current .tags-wrap").removeClass("fixed");
			}
		}
	}
	if($("#page_activity_timeline").hasClass("kap-page-current")){
		if(_top < 10){
			$(".ty-calendars.activity").removeClass("fold");
			$(".ty-calendars.activity .day.fold").removeClass("fold").addClass("unfold");
			//console.log("page_hot_scroll");
		}else{
			$(".ty-calendars.activity").addClass("fold");
			$(".ty-calendars.activity .day").addClass("fold").removeClass("unfold");
			if($(".ty-calendar.on .today").length > 0){
				week_now = $(".day.today").attr("data-week");
			}else{
				week_now = $(".ty-calendar.on .day:first").attr("data-week");
			}
			$("[data-week="+week_now+"]").removeClass("fold").addClass("unfold");
		}
		//console.log("timeline_scroll");
	}else if($("#detail_activity").hasClass("kap-page-current")){
		var tag_top = $("#detail_activity .ty-detail-cover").offset().top + $("#detail_activity .ty-detail-cover").height();
		var bar_h = $(".act-tag").height();
		var comment_top = $("#detail_activity .article-title .title:contains('咨询&评价')").parent().offset().top - 400;
		if ($("#detail_activity .article-title .title:contains('费用说明')").length>0){
            talent_top = $("#detail_activity .article-title .title:contains('费用说明')").parent().offset().top - 400;
			if(_top < talent_top){
				$(".act-tag .tag").removeClass("on");
				$(".act-tag .tag.detail").addClass("on");
			}else if(_top >= comment_top){
				$(".act-tag .tag").removeClass("on");
				$(".act-tag .tag.qa").addClass("on");
			}else{
				$(".act-tag .tag").removeClass("on");
				$(".act-tag .tag.price").addClass("on");
			}
        }else{
             $(".act-tag .tag.price").hide();
			 if(_top >= comment_top){
				$(".act-tag .tag").removeClass("on");
				$(".act-tag .tag.qa").addClass("on");
			}else{
				$(".act-tag .tag").removeClass("on");
				$(".act-tag .tag.detail").addClass("on");
			}
        }

	}else if($("#page_talent").hasClass("kap-page-current") || $("#page_talent_plus").hasClass("kap-page-current") || $("#page_user").hasClass("kap-page-current")){
		//20161220 updated
		if(_top > 150){
			$(".ty-tools-current").removeClass("transparent");
		}else{
			$(".ty-tools-current").addClass("transparent");
		}
	}

	if($(".kap-page-current .tags-wrap").length>0){
		//20161116 updated
		var special_tag_top = $(".kap-page-current .tags-wrap").parent("div").offset().top - $(".kap-page-current .tags-wrap").height();
		var flag_length = $(".kap-page-current .flag").length;
		var flag_position;
		for(var i=0; i < flag_length; i++){
			flag_position = $(".kap-page-current").find(".flag").eq(i).offset().top - $(".kap-page-current .tags-wrap").height() - 60;
			if(_top >= flag_position){
				$(".kap-page-current .tags-wrap .tag").removeClass("on");
				$(".kap-page-current .tags-wrap").find(".tag").eq(i).addClass("on");
			}else if(_top < special_tag_top){
				$(".kap-page-current .tags-wrap .tag").removeClass("on");
			}
		}
	}
};
//倒计时插件
(function ($) {

		$.fn.downCount = function (options, callback) {
			var settings = $.extend({
					date: null,
					offset: null
				}, options);

			// Throw error if date is set incorectly
			if (!Date.parse(settings.date)) {
				$.error('Incorrect date format, it should look like this, 12/24/2012 12:00:00.');
			}

			// Save container
			var container = this;

			/**
			 * Change client's local date to match offset timezone
			 * @return {Object} Fixed Date object.
			 */
			var currentDate = function () {
				// get client's current date
				var date = new Date();

				// turn date to utc
				var utc = date.getTime() + (date.getTimezoneOffset() * 60000);

				// set new Date object
				var new_date = new Date(utc + (3600000*settings.offset))

				return new_date;
			};

			/**
			 * Main downCount function that calculates everything
			 */
			function countdown () {
				var target_date = new Date(settings.date), // set target date
					current_date = currentDate(); // get fixed current date

				// difference of dates
				var difference = target_date - current_date;

				// if difference is negative than it's pass the target date
				if (difference < 0) {
					// stop timer
					container.addClass("end");
					container.parent().removeClass("on")
					clearInterval(interval);

					if (callback && typeof callback === 'function') callback();

					return;
				}else{
					$(".limit-area").addClass("on");
					container.parent().addClass("on");
				}

				// basic math variables
				var _second = 1000,
					_minute = _second * 60,
					_hour = _minute * 60,
					_day = _hour * 24;

				// calculate dates
				var days = Math.floor(difference / _day),
					hours = Math.floor((difference % _day) / _hour),
					minutes = Math.floor((difference % _hour) / _minute),
					seconds = Math.floor((difference % _minute) / _second);

					// fix dates so that it will show two digets
					days = (String(days).length >= 2) ? days : days;
                	hours = (String(hours).length >= 2) ? hours : '0' + hours;
					minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
					seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;

				// set to DOM
				container.find('.days').text(days);
				container.find('.hours').text(hours);
				container.find('.minutes').text(minutes);
				container.find('.seconds').text(seconds);
			}

			// start
			var interval = setInterval(countdown, 1000);
		};

	})(jQuery);
$(function(){
    ty.init();
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


function hint(){
    alert("此功能开发中"+'<br>'+"敬请期待！");
}
