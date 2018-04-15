// 底部半圆的切换
$(".footer ul li>img").css("display","none");
$(".footer ul li>img:eq(1)").css("display","block");
$(" .footer ul li").click(function(){
    $(this).addClass('on').siblings().removeClass("on");
    var index=$(this).index();
    var liLen=$(".footer ul li").length;
    for(var i=0;i<=liLen-1;i++){
        $(".footer ul li>img").eq(i).css("display","none");
    }
    $(this).find("img:eq(0)").css("display","block");
})

$(function(){
    $.ajax({
        type:"get",
        url:"/index.php/Product/ajaxCourseList",
        aynsc:true,
        data:{
            class_id:0,
            page:0
        },
        dataType:"json",
        success:function(data){
            if(data.status==1){
                var data=data.data;
                for(var i=0; i<data.class.length; i++){
                    $(".smallNav").append(
                             '<li id="'+data.class[i].id+'"><a href="javascript:void(0)">'+data.class[i].title+'</a></li>'
                        )
                }
                 if(data.product.length==0){
                    $(".alert").show().find("p").html('亲，该分类暂时没有课程哦')
                    $(".alert").find("p").attr("background","")
                }
                for(var j=0; j<data.product.length; j++){
                    $(".courseList ul").append(
                            '<li class="course" onclick="getProduct('+data.product[j].id+')">'+
                            '<div class="courseContent">'+
                            '<div class="coursesList">'+
                            '<div class="text">'+
                            '<h3>'+data.product[j].title.substring(0,20)+'</h3>'+
                            '<span class="groupPrice">平台价：<span class="moneySign">￥</span><strong>'+data.product[j].now_price+'</strong></span>'+
                            '<p class="originalPrice">原价：'+data.product[j].original_price+'元/人</p>'+
                            '<p class="try">'+
                            '<a href="javascript:void(0);" onclick="groupOrder(event,'+data.product[j].id+')">立即下单</a>'+
                            '<a href="javascript:void(0);" onclick="appoint(event,'+data.product[j].id+')">预约试听</a>'+
                            '</p>'+
                            '</div>'+
                            '<div class="img">'+
                            '<img src="'+data.product[j].pic_url+'" alt="" class="courseImg">'+
                            '<div class="tap">'+
                            '<img src="../../../../Public/images/imgTap.png" alt="" class="logoTap">'+
                            '<img src="'+data.product[j].logo+'" alt="" class="imgLogo">'+
                            '</div>'+
                            '<div class="type type'+j+'">'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</li>'
                    )
                    var coursesList=".type"+j;
                    if(data.product[j].tagA){
                        $(coursesList).append(
                                '<span>'+data.product[j].tagA+'</span>'
                        )
                    }else{
                        $(coursesList).hide()
                    }
                    if(data.product[j].tagB){
                        $(coursesList).append(
                                '<span>'+data.product[j].tagB+'</span>'
                        )
                    }
                    if(data.product[j].tagC){
                        $(coursesList).append(
                                '<span>'+data.product[j].tagC+'</span>'
                        )
                    }
                }
                $(".smallNav li").click(function(){
                    $(this).addClass("on").siblings().removeClass("on")
                    $(".courseList ul").html("")
                    $(".alert").hide()
                    var class_id=$(this).attr("id");
                    npage=8;
                    $.ajax({
                        type:"get",
                        url:"/index.php/Product/ajaxCourseList",
                        aynsc:true,
                        data:{
                            class_id:class_id,
                            page:0
                        },
                        dataType:"json",
                        success:function(data){
                            if(data.status==1){
                                var data=data.data;
                                 if(data.product.length==0){
                                    $(".alert").show().find("p").html('亲，该分类暂时没有课程哦')
                                    $(".alert").find("p").attr("background","")
                                }
                                for(var j=0; j<data.product.length; j++){
                                    $(".courseList ul").append(
                                            '<li class="course" onclick="getProduct('+data.product[j].id+')">'+
                                            '<div class="courseContent">'+
                                            '<div class="coursesList">'+
                                            '<div class="text">'+
                                            '<h3>'+data.product[j].title.substring(0,20)+'</h3>'+
                                            '<span class="groupPrice">平台价：<span class="moneySign">￥</span><strong>'+data.product[j].now_price+'</strong></span>'+
                                            '<p class="originalPrice">原价：'+data.product[j].original_price+'元/人</p>'+
                                            '<p class="try">'+
                                            '<a href="javascript:void(0);" onclick="groupOrder(event,'+data.product[j].id+')">立即下单</a>'+
                                            '<a href="javascript:void(0);" onclick="appoint(event,'+data.product[j].id+')">预约试听</a>'+
                                            '</p>'+
                                            '</div>'+
                                            '<div class="img">'+
                                            '<img src="'+data.product[j].pic_url+'" alt="" class="courseImg">'+
                                            '<div class="tap">'+
                                            '<img src="../../../../Public/images/imgTap.png" alt="" class="logoTap">'+
                                            '<img src="'+data.product[j].logo+'" alt="" class="imgLogo">'+
                                            '</div>'+
                                            '<div class="type type'+j+'">'+
                                            '</div>'+
                                            '</div>'+
                                            '</div>'+
                                            '</div>'+
                                            '</li>'
                                    )
                                    var coursesList=".type"+j;
                                    if(data.product[j].tagA){
                                        $(coursesList).append(
                                                '<span>'+data.product[j].tagA+'</span>'
                                        )
                                    }else{
                                        $(coursesList).hide()
                                    }
                                    if(data.product[j].tagB){
                                        $(coursesList).append(
                                                '<span>'+data.product[j].tagB+'</span>'
                                        )
                                    }
                                    if(data.product[j].tagC){
                                        $(coursesList).append(
                                                '<span>'+data.product[j].tagC+'</span>'
                                        )
                                    }
                                }
                            }
                        }
                    })
                })
                
            }
        }
    })
    var npage=8;
    $(window).scroll(function(){
        var scrollTop = $(document).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(window).height();
        if (scrollTop + windowHeight == scrollHeight) {
            var class_id=$(".smallNav li.on").attr("id");
            $(this).scrollTop(scrollHeight - 50);
            //加载层
            layer.load();
            setTimeout(function () {
                layer.closeAll('loading');
            }, 1000);
            $.ajax({
                type:"get",
                url:"/index.php/Product/ajaxCourseList",
                aynsc:true,
                data:{
                    class_id:class_id,
                    page:npage
                },
                dataType:"json",
                success:function(data){
                    if(data.status==1){
                        var data=data.data;
                        if(data.product.length==0){
                            $(".alert").show().find("p").html('没有更多了')
                        }
                        for(var j=0; j<data.product.length; j++){
                            $(".courseList ul").append(
                                    '<li class="course" onclick="getProduct('+data.product[j].id+')">'+
                                    '<div class="courseContent">'+
                                    '<div class="coursesList">'+
                                    '<div class="text">'+
                                    '<h3>'+data.product[j].title.substring(0,20)+'</h3>'+
                                    '<span class="groupPrice">平台价：<span class="moneySign">￥</span><strong>'+data.product[j].now_price+'</strong></span>'+
                                    '<p class="originalPrice">原价：'+data.product[j].original_price+'元/人</p>'+
                                    '<p class="try">'+
                                    '<a href="javascript:void(0);" onclick="groupOrder(event,'+data.product[j].id+')">立即下单</a>'+
                                    '<a href="javascript:void(0);" onclick="appoint(event,'+data.product[j].id+')">预约试听</a>'+
                                    '</p>'+
                                    '</div>'+
                                    '<div class="img">'+
                                    '<img src="'+data.product[j].pic_url+'" alt="" class="courseImg">'+
                                    '<div class="tap">'+
                                    '<img src="../../../../Public/images/imgTap.png" alt="" class="logoTap">'+
                                    '<img src="'+data.product[j].logo+'" alt="" class="imgLogo">'+
                                    '</div>'+
                                    '<div class="type types'+j+'">'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'+
                                    '</li>'
                            )
                            var coursesList=".types"+j;
                            if(data.product[j].tagA){
                                $(coursesList).append(
                                        '<span>'+data.product[j].tagA+'</span>'
                                )
                            }else{
                                $(coursesList).hide()
                            }
                            if(data.product[j].tagB){
                                $(coursesList).append(
                                        '<span>'+data.product[j].tagB+'</span>'
                                )
                            }
                            if(data.product[j].tagC){
                                $(coursesList).append(
                                        '<span>'+data.product[j].tagC+'</span>'
                                )
                            }
                        }
                    }
                }
            })
            npage+=8;
        }
    })

})
 // 进入商品详情
function groupOrder(event,id){
    event.stopPropagation();
    window.location.href = "/index.php/Product/productDetails?pro_id=" + id;
}
// 进入预约表
function appoint(event,id){
    event.stopPropagation();
    window.location.href = "/index.php/Product/getClassTable?pro_id=" + id;
}
 //查看限时抢购商品
function getProduct(id) {
    window.location.href = "/index.php/Product/productDetails?pro_id=" + id;
}