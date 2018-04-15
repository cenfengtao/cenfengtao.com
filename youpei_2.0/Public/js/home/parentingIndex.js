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



     $(window).load(function (){
            setTimeout(function () {
                $('.footer').show();
            },2000)
        });
        // 进入团购详情
         function getGroup(id) {
            window.location.href = "/index.php/Groups/getGroup?id=" + id;
        }
       
        //查看商品详情
        function getProduct(id) {
            window.location.href = "/index.php/Product/productDetails?pro_id=" + id;
        }
         $(function(){
             // 拼团类型
            $(".groupsType li").click(function(){
                var index=$(this).index();
                $(this).addClass("on").siblings().removeClass("on");
            })
        $.ajax({
            type: "get",
            url: "/index.php/Parenting/ajaxIndex",
            aysnc: true,
            dataType: "json",
            data:{
                class_id:0,
                page:0
            },
            success: function (data) {
                if(data.status==1){
                    var data=data.data;
                    for(var i=0; i<data.class.length; i++){
                        $(".courseNav ul").append(
                                '<li  attr_id="'+data.class[i].id+'"><a href="javascript:void(0);">'+data.class[i].cate_title+'</a></li>'
                            )
                    }
                    for(var i=0; i<data.groupParenting.length; i++){
                        $(".courseList ul").append(
                                '<li onclick="getGroup('+data.groupParenting[i].id+')">'+
                                    '<div class="img">'+
                                        '<img src="'+data.groupParenting[i].image+'" alt="" class="courseImg">'+
                                        '<div class="tap">'+
                                            '<img src="../../../../Public/images/imgTap.png" alt="" class="logoTap">'+
                                            '<img src="'+data.groupParenting[i].logo+'" alt="" class="imgLogo">'+
                                        '</div>'+
                                        '<div class="type type'+i+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="text">'+
                                        '<div class="time">'+
                                            '<img src="../../../../Public/images/indexFilter.png" alt="">'+
                                            '<span class="endtime" value="'+data.groupParenting[i].end_time+'"></span>'+
                                        '</div>'+
                                        '<h3>'+data.groupParenting[i].title.substring(0,8)+'...</h3>'+
                                        '<span class="groupPrice">组团价：<span class="moneySign">￥</span><strong>'+data.groupParenting[i].price+'</strong></span>'+
                                        '<p class="originalPrice">原价：'+data.groupParenting[i].original_price+'元/人</p>'+
                                        '<a href="javascript:void(0)">去拼团</a>'+
                                        '<div class="groupNum groupNum'+i+'">'+
                                            '<span class="finished">已拼团人数 : (<span class="nowPeople">'+data.groupParenting[i].groupCount+'</span>/<span class="allPeople">'+data.groupParenting[i].max_people+'</span>)</span>'+
                                            '<div class="bar"><span></span></div>'+
                                        '</div>'+
                                    '</div>'+
                                '</li>'
                            )
                         // 遍历描述标签
                                  var type=".type"+i;
                                  if(data.groupParenting[i].tagA){
                                     $(type).append(
                                          '<span>'+data.groupParenting[i].tagA+'</span>'
                                      )
                                }else{
                                    $(type).hide()
                                }
                                if(data.groupParenting[i].tagB){
                                    $(type).append(
                                            '<span>'+data.groupParenting[i].tagB+'</span>'
                                        )
                                }
                                if(data.groupParenting[i].tagC){
                                    $(type).append(
                                            '<span>'+data.groupParenting[i].tagC+'</span>'
                                        )
                                }
                                 // 拼团里的进度条颜色变化
                                var groupNum=".groupNum"+i;
                                var nowPeople=$(groupNum).find(".nowPeople").text();
                                var allPeople=$(groupNum).find(".allPeople").text();
                                var scale=(nowPeople/allPeople*100);
                                $(groupNum).find(".bar span").css("width",scale+"%")
                                if(scale<35){
                                    $(groupNum).find(".bar span").css("background","greenyellow")
                                }else if(scale<70){
                                    $(groupNum).find(".bar span").css("background","orange")
                                }else if(scale<101){
                                    $(groupNum).find(".bar span").css("background","red")
                                }
                        }
                        if(data.groupParenting.length==0){
                            $(".courseList ul").html("")
                            $(".courseList ul").append(
                                    '<li style="text-align:center; font-size:0.5rem;">亲，暂时没有团购商品哦！</li>'
                                )
                        }

                    // 拼团导航
                    $(".courseNav li").click(function(){
                        $(this).addClass("on").siblings().removeClass("on");
                        var class_id=$(this).attr("attr_id")
                        $(".courseList ul").html("")
                        $('.courseList >div').html("")
                        shopPage=10;
                        coursePage=10;
                            $.ajax({
                                type: "get",
                                url: "/index.php/Parenting/ajaxIndex",
                                aysnc: true,
                                dataType: "json",
                                data:{
                                    class_id:class_id,
                                    page:0
                                },
                                success: function (data) {
                                    if(data.status==1){
                                        $(".courseList ul").html("")
                                        var data=data.data;
                                        if(data.groupParenting.length==0){
                                            $(".courseList ul").html("")
                                            $(".courseList ul").append(
                                                    '<li style="text-align:center; font-size:0.5rem;">亲，暂时没有团购商品哦！</li>'
                                                )
                                        }
                                        for(var i=0; i<data.groupParenting.length; i++){
                                            $(".courseList ul").append(
                                                    '<li onclick="getGroup('+data.groupParenting[i].id+')">'+
                                                        '<div class="img">'+
                                                            '<img src="'+data.groupParenting[i].image+'" alt="" class="courseImg">'+
                                                            '<div class="tap">'+
                                                                '<img src="../../../../Public/images/imgTap.png" alt="" class="logoTap">'+
                                                                '<img src="'+data.groupParenting[i].logo+'" alt="" class="imgLogo">'+
                                                            '</div>'+
                                                            '<div class="type type'+i+'">'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div class="text">'+
                                                            '<div class="time">'+
                                                                '<img src="../../../../Public/images/indexFilter.png" alt="">'+
                                                                '<span class="endtime" value="'+data.groupParenting[i].end_time+'"></span>'+
                                                            '</div>'+
                                                            '<h3>'+data.groupParenting[i].title.substring(0,8)+'...</h3>'+
                                                            '<span class="groupPrice">组团价：<span class="moneySign">￥</span><strong>'+data.groupParenting[i].price+'</strong></span>'+
                                                            '<p class="originalPrice">原价：'+data.groupParenting[i].original_price+'元/人</p>'+
                                                            '<a href="javascript:void(0)">去拼团</a>'+
                                                            '<div class="groupNum groupNum'+i+'">'+
                                                                '<span class="finished">已拼团人数 : (<span class="nowPeople">'+data.groupParenting[i].groupCount+'</span>/<span class="allPeople">'+data.groupParenting[i].max_people+'</span>)</span>'+
                                                                '<div class="bar"><span></span></div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</li>'
                                                )
                                             // 遍历描述标签
                                                     var type=".type"+i;
                                                      if(data.groupParenting[i].tagA){
                                                             $(type).append(
                                                                '<span>'+data.groupParenting[i].tagA+'</span>'
                                                            )
                                                    }else{
                                                        $(type).hide()
                                                    }
                                                    if(data.groupParenting[i].tagB){
                                                        $(type).append(
                                                                '<span>'+data.groupParenting[i].tagB+'</span>'
                                                            )
                                                    }
                                                    if(data.groupParenting[i].tagC){
                                                        $(type).append(
                                                                '<span>'+data.groupParenting[i].tagC+'</span>'
                                                            )
                                                    }
                                                     // 拼团里的进度条颜色变化
                                                    var groupNum=".groupNum"+i;
                                                    var nowPeople=$(groupNum).find(".nowPeople").text();
                                                    var allPeople=$(groupNum).find(".allPeople").text();
                                                    var scale=(nowPeople/allPeople*100);
                                                    $(groupNum).find(".bar span").css("width",scale+"%")
                                                    if(scale<35){
                                                        $(groupNum).find(".bar span").css("background","greenyellow")
                                                    }else if(scale<70){
                                                        $(groupNum).find(".bar span").css("background","orange")
                                                    }else if(scale<101){
                                                        $(groupNum).find(".bar span").css("background","red")
                                                    }
                                        }
                                        
                                    }
                                    
                                }
                            })
                        })
                    }
                }
            })
                var coursePage=10;
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
                        var class_id=$(".classifyNav li.on").attr("attr_id");
                         $.ajax({
                            type: "get",
                            url: "/index.php/Parenting/ajaxIndex",
                            aysnc: true,
                            dataType: "json",
                            data:{  
                                class_id:class_id,
                                page:coursePage
                            },
                            success: function (data) {
                                if(data.status==1){
                                    var data=data.data;
                                        for(var i=0; i<data.groupParenting.length; i++){
                                                $(".courseList ul").append(
                                                        '<li onclick="getGroup('+data.groupParenting[i].id+')">'+
                                                            '<div class="img">'+
                                                                '<img src="'+data.groupParenting[i].image+'" alt="" class="courseImg">'+
                                                                '<div class="tap">'+
                                                                    '<img src="../../../../Public/images/imgTap.png" alt="" class="logoTap">'+
                                                                    '<img src="'+data.groupParenting[i].logo+'" alt="" class="imgLogo">'+
                                                                '</div>'+
                                                                '<div class="type type'+i+'">'+
                                                                '</div>'+
                                                            '</div>'+
                                                            '<div class="text">'+
                                                                '<div class="time">'+
                                                                    '<img src="../../../../Public/images/indexFilter.png" alt="">'+
                                                                    '<span class="endtime" value="'+data.groupParenting[i].end_time+'"></span>'+
                                                                '</div>'+
                                                                '<h3>'+data.groupParenting[i].title.substring(0,8)+'...</h3>'+
                                                                '<span class="groupPrice">组团价：<span class="moneySign">￥</span><strong>'+data.groupParenting[i].price+'</strong></span>'+
                                                                '<p class="originalPrice">原价：'+data.groupParenting[i].original_price+'元/人</p>'+
                                                                '<a href="javascript:void(0);">去拼团</a>'+
                                                                '<div class="groupNum groupNum'+i+'">'+
                                                                    '<span class="finished">已拼团人数 : (<span class="nowPeople">'+data.groupParenting[i].groupCount+'</span>/<span class="allPeople">'+data.groupParenting[i].max_people+'</span>)</span>'+
                                                                    '<div class="bar"><span></span></div>'+
                                                                '</div>'+
                                                            '</div>'+
                                                        '</li>'
                                                    )
                                                 // 遍历描述标签
                                                 var type=".type"+i;
                                                  if(data.groupParenting[i].tagA){
                                                         $(type).append(
                                                            '<span>'+data.groupParenting[i].tagA+'</span>'
                                                        )
                                                }else{
                                                    $(type).hide()
                                                }
                                                if(data.groupParenting[i].tagB){
                                                    $(type).append(
                                                            '<span>'+data.groupParenting[i].tagB+'</span>'
                                                        )
                                                }
                                                if(data.groupParenting[i].tagC){
                                                    $(type).append(
                                                            '<span>'+data.groupParenting[i].tagC+'</span>'
                                                        )
                                                }
                                                 // 拼团里的进度条颜色变化
                                                var groupNum=".groupNum"+i;
                                                var nowPeople=$(groupNum).find(".nowPeople").text();
                                                var allPeople=$(groupNum).find(".allPeople").text();
                                                var scale=(nowPeople/allPeople*100);
                                                $(groupNum).find(".bar span").css("width",scale+"%")
                                                if(scale<35){
                                                    $(groupNum).find(".bar span").css("background","greenyellow")
                                                }else if(scale<70){
                                                    $(groupNum).find(".bar span").css("background","orange")
                                                }else if(scale<101){
                                                    $(groupNum).find(".bar span").css("background","red")
                                                }
                                            }
                                            if(data.groupParenting.length==0){
                                                $(".courseList >div").html(
                                                        '<p style="text-align:center; font-size:0.5rem;width:100%;height:1rem;">亲，暂时没有更多团购商品了！</p>'
                                                    )
                                            }      
                                        }    
                                        
                            }
                        })
                         coursePage+=6;                       
                    }
                })
            })
// 限时抢购倒计时
var time_current = (new Date()).valueOf();//获取当前时间
$(function () {
    var dateTime = new Date();
    var difference = dateTime.getTime() - time_current;
    // 课程团购倒计时
    setInterval(function () {
        $(".endtime").each(function () {
            var obj = $(this);
            var endTime = new Date(parseInt(obj.attr('value')) * 1000);
            var nowTime = new Date();
            var nMS = endTime.getTime() - nowTime.getTime() + difference;
            var myD = Math.floor(nMS / (1000 * 60 * 60 * 24));
            var myH = Math.floor(nMS / (1000 * 60 * 60)) % 24;
            var myM = Math.floor(nMS / (1000 * 60)) % 60;
            var myS = Math.floor(nMS / 1000) % 60;
            var myMS = Math.floor(nMS / 100) % 10;
            // 
            if (myD >= 0) {
                var str = "剩余下" + myD + "天  " + myH + ":" + myM + ":" + myS;
            } else {
                var str = "已结束！";
            }
            if(myH==-1){
                var str = "已结束！";
            }
            obj.html(str);
        });
    }, 100);
    // 商品团购倒计时
    setInterval(function () {
        $(".shopGroupsTime").each(function () {
            var obj = $(this);
            var endTime = new Date(parseInt(obj.attr('value')) * 1000);
            var nowTime = new Date();
            var nMS = endTime.getTime() - nowTime.getTime() + difference;
            var myD = Math.floor(nMS / (1000 * 60 * 60 * 24));
            var myH = Math.floor(nMS / (1000 * 60 * 60)) % 24;
            var myM = Math.floor(nMS / (1000 * 60)) % 60;
            var myS = Math.floor(nMS / 1000) % 60;
            var myMS = Math.floor(nMS / 100) % 10;
            if (myD >= 0) {
                var str = "剩余下" + myD + "天  " + myH + ":" + myM + ":" + myS;
            } else {
                var str = "已结束！";
            }
            if(myH==-1){
                var str = "已结束！";
            }
            obj.html(str);
        });
    }, 100);
});
