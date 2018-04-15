$(".footer ul li>img").css("display","none");
$(".footer ul li>img:eq(2)").css("display","block");
$(" .footer ul li").click(function(){
    $(this).addClass('on').siblings().removeClass("on");
    var index=$(this).index();
    var liLen=$(".footer ul li").length;
    for(var i=0;i<=liLen-1;i++){
        $(".footer ul li>img").eq(i).css("display","none");
    }
    $(this).find("img:eq(0)").css("display","block");
})
var testTitle=function(value){
  if(value==""){
    alert("请先填写您的作品名称。")
    return;
  }
}
var testName=function(value){
  if(value==""){
    alert("请先填写您的名字。")
    return;
  }
}
// 手机号码正则验证
var testTel=function(value){
    var reg=/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/;
    if(!reg.test(value)){
        alert("你输入的手机号码不正确，请重新输入。")
        return false;
    }
}  
// 判断手机类型
function fBrowserRedirect(){
 var sUserAgent = navigator.userAgent.toLowerCase();
 var isIphone = sUserAgent.match(/iphone/i) == "iphone";
 var isAndroid = sUserAgent.match(/android/i) == "android";
 if(isIphone){ $("#file").attr("accept","");
 $("#file").attr("capture","");
 }
// if(isAndroid){ window.location.href = "download/android.html"; }
}
fBrowserRedirect();
// 点击上传实现上传文件
function firstFile() { 
    document.getElementsByClassName("webuploader-element-invisible")[0].click(); 
} 
//    获取url参数
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
}
var vote_id = getQueryString('vote_id');
$("#vote_id").attr("value",vote_id)
// 微信端分享
$.ajax({
    type: "get",
    url: "/index.php/Vote/voteListContribution",
    aysnc: true,
    dataType: "json",
    data:{
        vote_id:vote_id,
    },
    success:function(data){
        // console.log(data);
        var title=data.data.share_title;
        var f_title=data.data.share_desc;
        var shareUrl=data.data.share_url;
        var shareImg=data.data.share_img;
        // 调用微信的分享接口
        wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: "{$signPackage['appId']}", // 必填，公众号的唯一标识
            timestamp: "{$signPackage['timestamp']}", // 必填，生成签名的时间戳
            nonceStr: "{$signPackage['nonceStr']}", // 必填，生成签名的随机串
            signature: "{$signPackage['signature']}",// 必填，签名，见附录1
            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'hideOptionMenu', 'showOptionMenu', 'hideMenuItems', 'showMenuItems', 'hideAllNonBaseMenuItem', 'showAllNonBaseMenuItem', 'closeWindow', 'chooseImage', 'uploadImage', 'getLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function () {
            wx.onMenuShareAppMessage({
                title: title,
                desc: f_title,
                link: shareUrl,
                imgUrl: shareImg,
                success: function () {
                    share_record();
                },
                cancel: function () {
                    alert('已取消');
                }
            });
            wx.onMenuShareTimeline({
                title: title,
                link: shareUrl,
                imgUrl: shareImg,
                success: function () {
                    share_record();// 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    alert('已取消');// 用户取消分享后执行的回调函数
                }
            });

            function share_record() {
                var data = new Array();
                data[id] = getQueryString(id);
                data[share_user_id] = getQueryString(share_user_id);
             var url = "/index.php/Vote/userContributionRecord";
             $.post(url, data, function (result) {
             alert(result.message);
             }, 'json');
             }
        });
    }
});






var upload_type;
var upload_status;
$(function(){
    $.ajax({
        type: "get",
        url: "/index.php/Vote/uploadType",
        aysnc: true,
        dataType: "json",
        data:{
            vote_id:vote_id,
        },
        success:function(data){
            if(data.status==1){
              upload_type=data.data.type;
              upload_status=data.data.userUpload.upload_status;
                if(data.data.type==1){
                  $(".alert").html("亲，请上传图片。")
                  $(".explain").append(
                      '<h3>投稿说明：</h3>'+
                     ' <p>1.只可上传1幅图片。</p>'+
                      '<p>2.投稿后请到“我的作品”处查看活动进度。</p>'
                    )
                  if(data.data.userUpload.upload_status==2){
                      var title=data.data.userUpload.title;
                      var userName=data.data.userUpload.username;
                      var mobile=data.data.userUpload.mobile;
                      var src=data.data.userUpload.path;
                      $("#title").val(title)
                      $("#userName").val(userName)
                      $("#mobile").val(mobile)
                      $(".img").html('<img src="'+src+'">')
                      $(".alert").hide()
                  }
                }
                if(data.data.type==2){
                   $(".alert").html("亲，请上传视频。")
                   $(".explain").append(
                     ' <h3>投稿说明：</h3>'+
                      '<p>1.只可上传1个视频。</p>'+
                      '<p>2.上传视频建议采用微信短视频后保存上传，视频限制最大12MB。</p>'+
                      '<p>3.投稿后请到“我的作品”处查看活动进度。</p>'
                    )
                    if(data.data.userUpload.upload_status==2){
                        var title=data.data.userUpload.title;
                        var userName=data.data.userUpload.username;
                        var mobile=data.data.userUpload.mobile;
                        var src=data.data.userUpload.path;
                        $("#title").val(title)
                        $("#userName").val(userName)
                        $("#mobile").val(mobile)
                        $(".img").css("height","7.23rem")
                        $(".img").html('<div class="video"><video src="'+src+'" id="video" autoplay></video></div>')
                         $(".alert").hide()
                    }
                }
            }    
        }
    })
})


 // var SCOPE = {
 //        'jump_url': '/index.php/Vote/ajaxContribution',
 //        'success_url': '/index.php/Vote/voteList.html?vote_id='+vote_id
 //    };
    var ThinkPHP = window.Think = {
        "ROOT": "__ROOT__",
        "PUBLIC": "__PUBLIC__",
        "DOMAIN": "{:HTTPDomain()}"
    };

    $(function () {
      setTimeout(function(){
        var uploading = null;
        uploadFile({
            server: "/index.php/Vote/uploadPic",
            pick: '#filePicker',
            formData: {dir: 'vote',upload_type:upload_type},
            callback: function (result) {
                if (result.status == 1) {
                    layer.close(uploading);
                    var json = WST.toJson(result);
                    $('#preview').attr('src', ThinkPHP.DOMAIN + "/" + json.file.savepath + json.file.savethumbname);
                    $('#upload_image').val('/' + json.file.savepath + json.file.savename);
                    var src=$("#preview").attr("src")
                    if(src.indexOf("jpg")>-1||src.indexOf("jpeg")>-1||src.indexOf("pdf")>-1||src.indexOf("gif")>-1||src.indexOf("dwg")>-1||src.indexOf("png")){
                      $(".img").html('<img src="'+src+'" alt="" />')
                    }
                    if(src.indexOf("mp4")>-1||src.indexOf("mp3")>-1){
                      $(".img").css("height","7.23rem")
                      $(".img").html('<div class="video"><video src="'+src+'" id="video" autoplay></video></div>')
                    }
                } else {
                    dialog.error(result.message);
                }
            },
            progress: function (rate) {
                uploading = WST.msg('正在上传中，请稍后...');
            }
        });
      },1800)
        
    });
 
   
    setTimeout(function(){
     $(".upload_status").attr("value",upload_status)
    },2500)
    function sub(){
      var upload_status=$(".upload_status").attr("value")
       if($("#title").val()==""){
        alert("请先填写您的作品名称。")
        return
      }
      if($("#userName").val()==""){
        alert("请先填写您的名字。")
        return
      }
      if($("#mobile").val()==""){
        alert("请先填写您的电话号码。")
        return
      }
      if(upload_status==1){
        $(".sub").show()
        $.ajax({   
          type: "post",  
          url:"/index.php/Vote/ajaxContribution",  
          async: true, 
          dataType:"json",
          data:{
              title:$("#title").val(),
              vote_id:$("#vote_id").val(),
              username:$("#userName").val(),
              mobile:$("#mobile").val(),
              path:$("#upload_image").val()
          }, 
          success: function(data) {
            $(".sub").hide()
             if(data.status==0){     
                setTimeout(function(){
                    alert(data.message+",请重新上传。")
                },500)
             }
              if(data.status==1){
                setTimeout(function(){
                   alert(data.message)      
                 },500)   
                window.location.href="/index.php/Vote/voteList.html?vote_id="+vote_id;
               }
          }  
        }) 
      }
      if(upload_status==2){
        var confirm=window.confirm("重新投稿需工作人员审核通过后才能继续参与投票和展示作品，在此期间请耐心等候，我们将会尽快通知您。是否确认？")
        if(confirm==true){
          $(".sub").show()
          $.ajax({   
            type: "post",  
            url:"/index.php/Vote/ajaxContribution",  
            async: true, 
            dataType:"json",
            data:{
                title:$("#title").val(),
                vote_id:$("#vote_id").val(),
                username:$("#userName").val(),
                mobile:$("#mobile").val(),
                path:$("#upload_image").val()
            }, 
            success: function(data) {
              $(".sub").hide()
               if(data.status==0){     
                  setTimeout(function(){
                      alert(data.message+",请重新上传。")
                  },500)
               }
                if(data.status==1){
                  setTimeout(function(){
                     alert(data.message)      
                   },500)   
                  window.location.href="/index.php/Vote/voteList.html?vote_id="+vote_id;
                 }
            }  
          }) 
        }
      }
    }