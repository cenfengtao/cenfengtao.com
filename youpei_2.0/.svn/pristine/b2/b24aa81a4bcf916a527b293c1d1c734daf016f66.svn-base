 $(function(){
// 延时加载底部导航
$(window).load(function (){
    setTimeout(function () {
        $('.footer').show();
    },2000)
});
// 底部导航选中状态
$(".footer ul li>img").css("display","none");
$(".footer ul li>img:eq(0)").css("display","block");
$(" .footer ul li").click(function(){
    $(this).addClass('on').siblings().removeClass("on");
    var index=$(this).index();
    var liLen=$(".footer ul li").length;
    for(var i=0;i<=liLen-1;i++){
        $(".footer ul li>img").eq(i).css("display","none");
    }
    $(this).find("img:eq(0)").css("display","block");
})
//    获取url参数
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
var id=GetRequest().id;
$.ajax({
    type:"get",
    url:"/index.php/Around/index",
    data:{
        cate_id:id,
        page:0
    },
    dataType:"json",
    success:function(data){
        if(data.status==1){
            var data=data.data;
            if(data.list.length==0){
                $(".alert").show().find("p").html("亲，暂时没有活动哦！").css("background","")
            }
            for(var i=0; i<data.list.length; i++){
                $(".parent").append(
                        '<li onclick="getPar('+data.list[i].id+')">'+
                            '<div class="imgs">'+
                                '<span class="address">'+
                                    '<img src="../../../../Public/images/addr.png" alt="">'+
                                    '<a href="/index.php/Map/GPS.html?par_id=29">'+data.list[i].province+data.list[i].city+data.list[i].area+'</a>'+
                                '</span>'+
                                '<img src="'+data.list[i].image+'" alt="">'+
                                '<span class="price">￥<strong>'+data.list[i].price+'</strong>起</span>'+
                            '</div>'+
                            '<div class="texts">'+
                                '<p class="title">'+data.list[i].title+'</p>'+
                                '<p class="time">时间：<span data-icon="Š">'+data.list[i].time+'</span></p>'+
                                '<div class="types types'+i+'">'+
                                '</div>'+
                            '</div>'+
                        '</li>'
                    )
                var type=".types"+i;
                if(data.list[i].tagA){
                    $(type).append('<span>'+data.list[i].tagA+'</span>')
                }
                if(data.list[i].tagB){
                    $(type).append('<span>'+data.list[i].tagB+'</span>')
                }
                if(data.list[i].tagC){
                    $(type).append('<span>'+data.list[i].tagC+'</span>')
                }
                
            }
            
        }
    }
})
})
// 滑动加载群数据
var npage=10;
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
            url:"/index.php/Around/loadingParenting",
            data:{
                id:id,
                page:npage
            },
            dataType:"json",
            success:function(data){
                if(data.status==1){
                    var data=data.data;
                    if(data.list.length==0){
                        $(".alert").show().find("p").html('没有更多了')
                    }
                    for(var i=0; i<data.list.length; i++){
                        $(".parent").append(
                                '<div onclick="getPar('+data.list[i].id+')">'+
                                    '<div class="imgs">'+
                                        '<span class="address">'+
                                            '<img src="../../../../Public/images/addr.png" alt="">'+
                                            '<a href="/index.php/Map/GPS.html?par_id=29">'+data.list[i].province+data.list[i].city+data.list[i].area+'</a>'+
                                        '</span>'+
                                        '<img src="'+data.list[i].image+'" alt="">'+
                                        '<span class="price">￥<strong>'+data.list[i].price+'</strong>起</span>'+
                                    '</div>'+
                                    '<div class="texts">'+
                                        '<p class="title">'+data.list[i].title+'</p>'+
                                        '<p class="time">时间：<span data-icon="Š">'+data.list[i].time+'</span></p>'+
                                        '<div class="types typess'+i+'">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            )
                        var type=".typess"+i;
                        if(data.list[i].tagA){
                            $(type).append('<span>'+data.list[i].tagA+'</span>')
                        }
                        if(data.list[i].tagB){
                            $(type).append('<span>'+data.list[i].tagB+'</span>')
                        }
                        if(data.list[i].tagC){
                            $(type).append('<span>'+data.list[i].tagC+'</span>')
                        }
                        
                    }
                    
                }
            }
        })
    npage+=5;
}
})


function getPar(id) {
window.location.href = "/index.php/Parenting/productDetails.html?par_id=" + id;
}
