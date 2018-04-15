var OYEWeixin=(function(){
	var weixin={},readyCallback=[],versionErrorCallback=[];
	var config_marge=function(source){
		var def_config={
				 jsApiList: [
		             'checkJsApi',
		             'onMenuShareTimeline',
		             'onMenuShareAppMessage',
		             'onMenuShareQQ',
		             'onMenuShareWeibo',
		             'hideMenuItems',
		             'showMenuItems',
		             'hideAllNonBaseMenuItem',
		             'showAllNonBaseMenuItem',
		             'translateVoice',
		             'startRecord',
		             'stopRecord',
		             'onRecordEnd',
		             'playVoice',
		             'pauseVoice',
		             'stopVoice',
		             'uploadVoice',
		             'downloadVoice',
		             'chooseImage',
		             'previewImage',
		             'uploadImage',
		             'downloadImage',
		             'getNetworkType',
		             'openLocation',
		             'getLocation',
		             'hideOptionMenu',
		             'showOptionMenu',
		             'closeWindow',
		             'scanQRCode'
		           ],
		};
		
		for (key in source) {
			if (source[key] !== undefined)
				def_config[key] = source[key];
		}
		return def_config;
	};
	
	weixin.call=function(callback){
		window.WeixinJSBridge ? callback() : document.addEventListener && document.addEventListener("WeixinJSBridgeReady", callback, !1);
	};
	
	weixin.alert=function(alert_type,alert_content){
		if(weixin.cookie('donot_alert_me__'+alert_type)=='1'){
			return;
		}
		if(!document.getElementById('wx_alert_box')){
			var alert='<div class="wx_alert_bg"><div class="wx_alert_title">微信提示</div><div class="wx_alert_con">'+alert_content+'</div><label class="wx_alert_checkbox"><div class="wx_alert_checker"><span id="wx_alert_chk_bg"><input type="checkbox"  id="donot_alert_me"></span></div>	不再提示此消息</label><div class="wx_alert_sub" id="wx_alert_button">确定</div></div>';
			var div=document.createElement('div');
			div.setAttribute('id','wx_alert_box');
			div.innerHTML=alert;
			var image=new Image();
			image.src='/Public/Static/weixin_core_checkbox.png';
			$(function(){
				document.body.appendChild(div);
				$('#wx_alert_chk_bg').click(function(){
					if(document.getElementById("donot_alert_me").checked){
						$(this).css('background-position','-48px 0px');
					}else{
						$(this).css('background-position','-24px 0px');
					}
				});
				$('#wx_alert_button').click(function(){
					if(document.getElementById('donot_alert_me').checked){
						weixin.cookie('donot_alert_me__'+alert_type,'1');
					}
					document.getElementById('wx_alert_box').style.display='none';
				});
			});
		}
		$(function(){
			document.getElementById('wx_alert_box').style.display='block';
		});
	};
	weixin.cookie = function(key, value, options) {
		var days, time, result, decode;

		// A key and value were given. Set cookie.
		if (arguments.length > 1 && String(value) !== "[object Object]") {
			// Enforce object
			options = options||{};
			if (value === null || value === undefined)
				options.expires = -1;
			if (typeof options.expires === 'number') {
				days = (options.expires * 24 * 60 * 60 * 1000);
				time = options.expires = new Date();
				time.setTime(time.getTime() + days);
			}

			value = String(value);

			return (document.cookie = [
					encodeURIComponent(key),
					'=',
					options.raw ? value : encodeURIComponent(value),
					options.expires ? '; expires='
							+ options.expires.toUTCString() : '',
					options.path ? '; path=' + options.path : '',
					options.domain ? '; domain=' + options.domain : '',
					options.secure ? '; secure' : '' ].join(''));
		}
		options = value || {};
		decode = options.raw ? function(s) {
			return s;
		} : decodeURIComponent;

		return (result = new RegExp('(?:^|; )' + encodeURIComponent(key)
				+ '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
	};
	weixin.phone=(function(){
		var u = navigator.userAgent.toLowerCase(),
		android = -1 != u.indexOf("android"),
		iphone = -1 != u.indexOf("iphone") || -1 != u.indexOf("ipad");
		return {andriod:android,iphone:iphone};
	})();
	weixin.version=(function(){
		var u = navigator.userAgent.toLowerCase(),
		weixinVersion = function() {
			a=u.match(/micromessenger\/(\d+\.\d+\.\d+\.\d+)/)||u.match(/micromessenger\/(\d+\.\d+\.\d+)/)||u.match(/micromessenger\/(\d+\.\d+)/);
			return a ? a[1] : "";
		} ();
		return weixinVersion;
	})();
	weixin.versionCompare=function(version1,version2){
		var v1=version1.split('.');
		var v2=version2.split('.');
		var length=Math.max(v1.length,v2.length);
		for(var i=0;i<length;i++){
			var a1=v1[i],a2=v2[i];
			if(a1 != undefined && a2!=undefined){
					if(a1.indexOf('_')>-1)a1=a1.substring(0,a1.indexOf('_'));
					if(a2.indexOf('_')>-1)a2=a2.substring(0,a2.indexOf('_'));
					//console.log('a1:'+a1+'---a2:'+a2);
					var num1=parseInt(a1),num2=parseInt(a2);
					if(typeof num1 =='number' && typeof num2=='number'){
						if(num1>num2){
							return 1;
						}else if(num1<num2){
							return -1;				
						}
					}
			}else if(a1==undefined){
				//console.log('a1:'+'0'+'---a2:'+a2);
				return -1;
			}else if(a2==undefined){
				//console.log('a1:'+a1+'---a2:'+0);
				return 1;	
			}
		}
		return 0;
	};
	weixin.ready=function(callback){
		readyCallback.push(callback);
	};
	
	weixin.versionError=function(callback){
		versionErrorCallback.push(callback);
	};
	
	weixin.config=function(config){
		config=config_marge(config);
		if(weixin.versionCompare('6.0.2',weixin.version)>0){
			config.debug&&alert('使用老版本api');
			versionErrorCallback.forEach(function(callback){
				callback(config);
			});
		}else{
			config.debug&&alert('使用新版本api');
			console.log(wx);
			wx.config(config);
			wx.ready(function(){
				console.log('success');
				config.debug&&alert('使用新版本api:ready susscess');
				$('body').trigger('wxready');
				readyCallback.forEach(function(callback){
					callback(config);
				});
			});
			wx.error(function(res){
				console.log(res);
				config.debug&&alert(res.errMsg);	
			});
			console.log('继续执行');
			console.log(config);
		}
	};
	return weixin;
})();