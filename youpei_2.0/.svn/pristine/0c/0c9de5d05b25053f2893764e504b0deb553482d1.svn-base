(function(weixin){
	weixin.call(function(){
		WeixinJSBridge.call('hideOptionMenu');
	});
	var getShareDesc=function(){
		return window.shareData.desc||getShareLink();
	};
	var getShareTitle=function(){
		return window.shareData.title||document.title;
	};
	
	
	var getShareID=function(){
		return window.shareData.share_id||'0';
	};
	var getShareModule=function(){
		return window.shareData.share_module;
	};
	var getShareAction=function(){
		return window.shareData.share_action;
	};
	var getShareToken=function(){
		return window.shareData.share_token;
	};
	var getShareWechaID=function(){
		return window.shareData.share_wecha_id;
	};
	var getShareUid=function(){
		return window.shareData.share_uid||'0';
	};
	var getShareLink=function(){
		var url = '';
		var post_url = window.shareData.share_link||location.href;
		if(post_url.indexOf("?") == -1) {
			url = post_url+"?time="+new Date().getTime();
		} else {
			url = post_url+"&time="+new Date().getTime();
		}
		return url;
	};
	var getShareImageURL=function(){
		var shareImgObj = document.getElementsByTagName('img')[0];
		if('undefined' != typeof(shareImgObj)){
			share_imgurl = shareImgObj.src;
		}
		return window.shareData.imgUrl || share_imgurl;
	};
	var timeline=function(){
		var data={
			imgUrl:	window.shareData.timeline_image||getShareImageURL(),
			title:  window.shareData.timeline_title||getShareTitle(),
			link:   window.shareData.timeline_link||getShareLink(),
			success: function () { 
		        // 用户确认分享后执行的回调函数
		    	share_report('timeline');
		    },
		    cancel: function () { 
		        // 用户取消分享后执行的回调函数
		    },
		    trigger:function(){
		    }
		}
		return data;
	};
	
	window.getTimeline=timeline();
	
	var share_report=function(type){
		
		var post_url=window.shareData.post_url;
		if(!post_url){
			if(window.shareData.redirect){
				window.location.href=window.shareData.redirect;
			}
			return false;
		}
		var post_data={
			wecha_id:getShareWechaID(),
			token:getShareToken(),
			module:getShareModule(),
			action:getShareAction(),
			uid:getShareUid(),
			id:getShareID(),
			share_type:type,
			weixin_version:weixin.version
		};
		if(window.jQuery||window.Zepto)
		{
			var url = post_url;
			$.post( url,post_data,function(res){
				var json=JSON.parse(res);
				if(json&&json.status){
					if(json.add_score){
						alert('分享成功，获得积分奖励'+json.score+'积分');
					}
				}
				if(window.shareData.redirect){
					window.location.href=window.shareData.redirect;
				}
			});
		}
	};
	var newWeixinShare=function(config){
		config.debug&&alert('新版api：开始注册JS事件');
		
		if(window.shareData.noshare){
			wx.hideMenuItems({
			    menuList: ['menuItem:share:appMessage','menuItem:share:timeline','menuItem:share:qq','menuItem:share:weiboApp','menuItem:share:facebook'] // 要隐藏的菜单项，所有menu项见附录3
			});
		}else{
			if(window.shareData.noappmessage||window.shareData.notimeline){
				if(window.shareData.noappmessage){
					wx.hideMenuItems({
						menuList: ['menuItem:share:appMessage'] // 要隐藏的菜单项，所有menu项见附录3
					});
				}
				if(window.shareData.notimeline){
					wx.hideMenuItems({
						menuList: ['menuItem:share:timeline'] // 要隐藏的菜单项，所有menu项见附录3
					});
				}
			}else{
				wx.showMenuItems({
				    menuList: ['menuItem:share:appMessage','menuItem:share:timeline','menuItem:share:qq','menuItem:share:weiboApp','menuItem:share:facebook'] // 要隐藏的菜单项，所有menu项见附录3
				});
			}
		}
		wx.onMenuShareTimeline(window.getTimeline);
		var appmessage={
			    title: getShareTitle(), // 分享标题
			    desc: getShareDesc(), // 分享描述
			    link: getShareLink(), // 分享链接
			    imgUrl: getShareImageURL(), // 分享图标
			    type: 'link', // 分享类型,music、video或link，不填默认为link
			    success: function () { 
			        // 用户确认分享后执行的回调函数
			    	share_report('appmessage');
			    },
			    cancel: function () { 
			        // 用户取消分享后执行的回调函数
			    }
			};
		
		wx.onMenuShareAppMessage(appmessage);
		var weibo={
			    title: getShareTitle(), // 分享标题
			    desc: getShareDesc(), // 分享描述
			    link: getShareLink(), // 分享链接
			    imgUrl: getShareImageURL(), // 分享图标
			    success: function () { 
			       // 用户确认分享后执行的回调函数
			    	share_report('weibo');
			    },
			    cancel: function () { 
			        // 用户取消分享后执行的回调函数
			    }
			};
		wx.onMenuShareWeibo(weibo);
		
		
		wx.onMenuShareQQ({
		    title: getShareTitle(), // 分享标题
		    desc:  getShareDesc(), // 分享描述
		    link: getShareLink(), // 分享链接
		    imgUrl: getShareImageURL(), // 分享图标
		    success: function () { 
		       // 用户确认分享后执行的回调函数
		    	share_report('qq');
		    },
		    cancel: function () { 
		       // 用户取消分享后执行的回调函数
		    }
		});
		wx.showOptionMenu();
	};
	var oldWeixinShare=function(config){
		config.debug&&alert('老版api：开始注册JS事件');
		weixin.call(function(){
			WeixinJSBridge.call('showOptionMenu');
			WeixinJSBridge.call('hideToolbar');
			// 发送给好友
			WeixinJSBridge.on('menu:share:appmessage', function(argv) {
				config.debug&&alert('menu:share:appmessage');
				if(window.shareData.noshare){
					alert(window.shareData.noshare);		
				}else{
					if(window.shareData.noappmessage){
						alert(window.shareData.noappmessage);		
					}else{
						shareFriendOrTimeline("sendAppMessage", "send_msg");
					}
				}
			});
			// 分享到朋友圈
			WeixinJSBridge.on('menu:share:timeline', function(argv) {
				config.debug&&alert('menu:share:timeline');
				if(window.shareData.noshare){
					alert(window.shareData.noshare);		
				}else{
					if (window.shareData.notimeline) {
						alert(window.shareData.notimeline);
					}else{
						shareFriendOrTimeline("shareTimeline", "timeline");
					}
				}
			});
			WeixinJSBridge.on('menu:share:weibo', function(argv){
				if(window.shareData.noshare){
					alert(window.shareData.noshare);		
				}else{
					shareFriendOrTimeline("shareWeibo", "shareWeibo");
				}
			});
			WeixinJSBridge.on('menu:share:qq', function(argv){
				if(window.shareData.noshare){
					alert(window.shareData.noshare);		
				}else{
					shareFriendOrTimeline("shareQQ", "shareQQ");
				}
			});

		});
		
		
		
		var shareFriendOrTimeline = function(invokeType, reportType) {
			var opts={
					"title" : getShareTitle(),
					"desc" : getShareDesc(),
					"img_url" : getShareImageURL(),
					"link" : getShareLink(),
					'type': "link",
					'data_url': ""
				};
			WeixinJSBridge.invoke(invokeType,opts , function(res) {
				if(invokeType=='shareTimeline'){
					switch (res.err_msg) {
		                    case 'share_timeline:confirm':
		                    case 'share_timeline:ok':
								share_report('timeline');
		                        break;
		            }
				}else if(invokeType=='sendAppMessage'){
					switch (res.err_msg) {
		                    case 'send_app_msg:confirm':
		                    case 'send_app_msg:ok':
								share_report('appmessage');
		                        break;
		           }
				}else if(invokeType=='shareWeibo'){
					 switch (res.err_msg) {
		                    case 'share_weibo:confirm':
		                    case 'share_weibo:ok':
								share_report('weibo');
		                        break;
		            }
				}else if(invokeType=='shareQQ'){
					 switch (res.err_msg) {
		                    case 'share_qq:confirm':
		                    case 'share_qq:ok':
								share_report('qq');
		                        break;
		            }
				}
				
			});
		};
	};
	weixin.versionError(function(config){
		//weixin.alert('weixin_share','本页分享功能需要微信版本6.0.2.58 以上<br/>您的当前版本为'+weixin.version+' 请升级');
		oldWeixinShare(config);
	});
	weixin.ready(function(config){
		if(weixin.phone.andriod){
			var base='6.0.2.58';
			if(weixin.versionCompare(base,weixin.version)>0){
				if(config.debug){
					alert('微信版本小于6.0.2.58，不能正常分享。关闭分享功能');
				}
				wx.hideMenuItems({
					menuList: ['menuItem:share:appMessage','menuItem:share:timeline','menuItem:share:qq','menuItem:share:weiboApp','menuItem:share:facebook'] // 要隐藏的菜单项，所有menu项见附录3
				});
				weixin.alert('weixin_share','本页分享功能需要微信版本6.0.2.58 以上<br/>您的当前版本为'+weixin.version+' 请升级  (在微信中 点击 ‘我’->设置->关于微信->检查新版本)');
				return;
			}
		}
		newWeixinShare(config);	
	});
})(window.OYEWeixin||{});