(function(weixin){
	weixin.versionError(function(config){
		weixin.uploadImage=function(){
			weixin.alert('weixin_update_image','本页上传功能需要微信版本6.0.2.58 以上<br/>您的当前版本为'+weixin.version+' 请升级');
			return;
		};
	});
	weixin.chooseUploadImage=function(previewImageCallback,uploadedImageCallback){
		 wx.chooseImage({
		      success: function (res) {
		        var localId = res.localIds;
		        if(res.localIds.length<1){
		        	return;
		        }else if(res.localIds.length>1){
		        	alert('您只能选择1张图片');
		        }else{
	        	 if(typeof previewImageCallback =='function'){
	        		 previewImageCallback(res);
		         }
 	        		wx.uploadImage({
				        localId: localId[0],
				        success: function (res) {
					          if(typeof uploadedImageCallback =='function'){
					        	  uploadedImageCallback(res);
					          }
				        },
				        fail: function (res) {
				          alert(res.errMsg);
				        }
				    });
		        }
		     }
		 });
	};
	weixin.chooseImage=function(len,previewImageCallback){
		 wx.chooseImage({
		      success: function (res) {
		        if(res.localIds.length<1){
		        	return;
		        }else if(res.localIds.length>len){
		        	alert('您只能选择'+len+'张图片');
		        }else{
		        	 if(typeof previewImageCallback =='function'){
		        		 previewImageCallback(res);
			         }	        	
		        }
		     }
		 });
	};
	weixin.uploadImage=function(localId,uploadedImageCallback){
		wx.uploadImage({
	        localId: localId,
	        success: function (res) {
		          if(typeof uploadedImageCallback =='function'){
		        	  uploadedImageCallback(res);
		          }
	        },
	        fail: function (res) {
	          alert(res.errmsg);
	        }
	    });
	};
})(OYEWeixin||{});