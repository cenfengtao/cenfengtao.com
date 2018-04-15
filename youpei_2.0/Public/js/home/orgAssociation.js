  function GetRequest() {
        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for (var i = 0; i < strs.length; i++) {
                theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    }
 $(function(){
    // 底部当前状态切换
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
    // 点击对应的列表显示对应的弹框
    $(".courseContent ul li").click(function(){
        $(this).find(".tan").show()
    })
    // 关闭弹框
     $(".tan").click(function(event){
       event.stopPropagation()
        $(this).hide()
    })
     //    获取url参数
    var asso_id=GetRequest().id;
     // 获取群数据
     $.ajax({
        type:"get",
        url:"/index.php/organization/ajaxAssociation",
        aynsc:true,
        data:{
            id:asso_id,
            page:0
        },
        dataType:"json",
        success:function(data){
            if(data.status==1){
                var data=data.data;
                if(data.list.length==0){
                    $(".alert").show().find("p").html("亲，暂时没有群哦！").css("background","")
                    $(".alert").find("p").css("margin-top","0.5rem")
                }
                for(var i=0; i<data.list.length; i++){
                    $(".courseContent ul").append(
                        '<li>'+
                            '<div class="img">'+
                                '<img src="'+data.list[i].pic_url+'" alt="" class="courseImg">'+
                                '<div class="tap">'+
                                    '<img src="../../../../Public/images/tap2.png" alt="" class="logoTap">'+
                                    '<span class="tapText">'+data.list[i].tag+'</span>'+
                               ' </div>'+
                            '</div>'+
                            '<div class="text">'+
                                '<section class="username">'+
                                    '<p><i></i>名称：<span>'+data.list[i].title.substring(0,7)+'</span></p>'+
                                    '<p><i></i>主题：<span>'+data.list[i].theme+'</span></p>'+
                                    '<p><i></i>人数：<span>'+data.list[i].number+'</span></p>'+
                                    '<p><i></i>状态：<span>开放</span></p>'+
                                '</section>'+
                            '</div>'+
                            '<div class="tan">'+
                                '<div class="attention">'+
                                    '<img src="'+data.list[i].qr_code+'"/>'+
                                    '<span>长按二维码可关注哦</span>'+
                                '</div>'+
                            '</div>'+
                        '</li>'
                    )
                }
            }
            // 点击对应的列表显示对应的弹框
            $(".courseContent ul li").click(function(){
                $(this).find(".tan").show()
            })
            // 关闭弹框
             $(".tan").click(function(event){
               event.stopPropagation()
                $(this).hide()
            })
        }
     })
     // 滑动加载群数据
     var npage=6;
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = $(this).height();
            if (scrollTop + windowHeight == scrollHeight) {
                $(this).scrollTop(scrollHeight - 50);
                //加载层
                layer.load();
                setTimeout(function () {
                    layer.closeAll('loading');
                }, 1000);
                $.ajax({
                    type:"get",
                    url:"/index.php/organization/ajaxAssociation",
                    aynsc:true,
                    data:{
                        id:asso_id,
                        page:npage
                    },
                    dataType:"json",
                    success:function(data){
                        if(data.status==1){
                            var data=data.data;
                            if(data.list.length==0){
                                $(".nomore").html("")
                                $(".nomore").append(
                                        '<p style="text-align:center;font-size:0.5rem;margin-bottom:0.3rem;">没有更多了</p>'
                                    )
                            }
                            for(var i=0; i<data.list.length; i++){
                                $(".courseContent ul").append(
                                    '<li>'+
                                        '<div class="img">'+
                                            '<img src="'+data.list[i].pic_url+'" alt="" class="courseImg">'+
                                            '<div class="tap">'+
                                                '<img src="../../../../Public/images/tap2.png" alt="" class="logoTap">'+
                                                '<span class="tapText">'+data.list[i].tag+'</span>'+
                                           ' </div>'+
                                        '</div>'+
                                        '<div class="text">'+
                                            '<section class="username">'+
                                                '<p><i></i>名称：<span>'+data.list[i].title.substring(0,7)+'</span></p>'+
                                                '<p><i></i>主题：<span>'+data.list[i].theme+'</span></p>'+
                                                '<p><i></i>人数：<span>'+data.list[i].number+'</span></p>'+
                                                '<p><i></i>状态：<span>开放</span></p>'+
                                            '</section>'+
                                        '</div>'+
                                        '<div class="tan">'+
                                            '<div class="attention">'+
                                                '<img src="'+data.list[i].qr_code+'"/>'+
                                                '<span>长按二维码可关注哦</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</li>'
                                )
                            }
                        }
                        // 点击对应的列表显示对应的弹框
                        $(".courseContent ul li").click(function(){
                            $(this).find(".tan").show()
                        })
                        // 关闭弹框
                         $(".tan").click(function(event){
                           event.stopPropagation()
                            $(this).hide()
                        })
                    }
                 })
                npage+=6;
            }
        })
        
})
var id=GetRequest().id;
 // 底部导航图解按钮
function fullshot(){
    window.location.href ="/index.php/Organization/fullShot.html?id="+id;
}
 // 底部导航群组按钮
function association(){
    window.location.href ="/index.php/Organization/association.html?id="+id;
}
// 底部导航最新活动按钮
function activity(){
    window.location.href ="/index.php/Organization/activityList.html?id="+id;
}
// 底部导航TA首页按钮
function orgIndex(){
    window.location.href= "/index.php/Organization/home.html?id="+id;
}