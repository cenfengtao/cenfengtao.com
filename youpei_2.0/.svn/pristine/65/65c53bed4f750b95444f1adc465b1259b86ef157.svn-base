$(function(){
    $.ajax({
        type:"get",
        url:"/index.php/personal/ajaxAppointList",
        aynsc:true,
        dataType:"json",
        data:{
        },
        success:function(data){
            if(data.status==1){
                var data=data.data;
                for(var i=0; i<data.list.length; i++){
                    $(".appointList ul").append(
                        '<li onclick="getOrg('+data.list[i].orgId+')">'+
                           ' <section class="org">'+
                                '<span  class="logo">'+
                                    '<img src="'+data.list[i].logo+'" alt="">'+
                                '</span>'+
                                '<a href="/index.php/Organization/getOrganizationIntroduce.html?id='+data.list[i].orgId+'">了解TA</a>'+
                                '<span class="seen seen'+data.list[i].orgId+'" onclick="followed('+data.list[i].orgId+')"></span>'+
                                '<div class="type">'+
                                    '<span></span>'+
                                '</div>'+
                            '</section>'+
                             '<section class="works">'+
                                '<span>课程名称：</span>'+
                                '<input type="text"  name="courseName" id="courseName" value="'+data.list[i].title+'" disabled>'+
                            '</section>'+
                             '<section class="works">'+
                                '<span>上课时间：</span>'+
                                '<input type="text" name="classTime" id="classTime" value="'+data.list[i].book_time+'" disabled>'+
                            '</section>'+
                            '<section class="works">'+
                                '<span>上课地点：</span>'+
                                '<input type="text"  name="classTime" id="address" value="'+data.list[i].address+'" disabled>'+
                            '</section>'+ 
                        '</li>'
                    )
                    if(data.list[i].isFollowed==1){
                        $(".seen").eq(i).text("已关注")
                    }else{
                        $(".seen").eq(i).text("关注")

                    }
                    if(data.list[i].bookStatus==1){
                        $(".type").eq(i).addClass("arrange").find("span").text("正在排课")
                    }else if(data.list[i].bookStatus==2){
                        $(".type").eq(i).addClass("success").find("span").text("预约成功")
                    }else if(data.list[i].bookStatus==3){
                        $(".type").eq(i).addClass("fail").find("span").text("预约失败")
                    }

                }
                if(data.list.length==0){
                    $(".alert").append('<p style="text-align:center; font-size:0.5rem; padding:1rem;">您暂时还没有预约哦，赶快去商品详情里预约试听吧！</p>')
                }
            }else{
                $(".alert").append('<p style="text-align:center; font-size:0.5rem; padding:1rem;">您暂时还没有预约哦，赶快去商品详情里预约试听吧！</p>')
            }
        }
    })

     var npage=6;
     $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        var upload_type=window.sessionStorage.getItem("status")
        if (scrollTop + windowHeight == scrollHeight) {
            $(this).scrollTop(scrollHeight - 50);
            //加载层
            layer.load();
            setTimeout(function () {
                layer.closeAll('loading');
            }, 1000);
            $.ajax({
                type:"get",
                url:"/index.php/personal/ajaxAppointList",
                aynsc:true,
                dataType:"json",
                data:{
                    page:npage
                },
                success:function(data){
                    if(data.status==1){
                        var data=data.data;
                        for(var i=0; i<data.list.length; i++){
                            $(".appointList ul").append(
                                '<li onclick="getOrg('+data.list[i].orgId+')">'+
                                   ' <section class="org">'+
                                        '<span  class="logo">'+
                                            '<img src="'+data.list[i].logo+'" alt="">'+
                                        '</span>'+
                                        '<a href="/index.php/Organization/getOrganizationIntroduce.html?id='+data.list[i].orgId+'">了解TA</a>'+
                                        '<span class="seen seen'+data.list[i].orgId+'" onclick="followed('+data.list[i].orgId+')"></span>'+
                                        '<div class="type">'+
                                            '<span></span>'+
                                        '</div>'+
                                    '</section>'+
                                     '<section class="works">'+
                                        '<span>课程名称：</span>'+
                                        '<input type="text"  name="courseName" id="courseName" value="'+data.list[i].title+'" disabled>'+
                                    '</section>'+
                                     '<section class="works">'+
                                        '<span>上课时间：</span>'+
                                        '<input type="text" name="classTime" id="classTime" value="'+data.list[i].book_time+'" disabled>'+
                                    '</section>'+
                                    '<section class="works">'+
                                        '<span>上课地点：</span>'+
                                        '<input type="text"  name="classTime" id="address" value="'+data.list[i].address+'" disabled>'+
                                    '</section>'+ 
                                '</li>'
                            )
                            if(data.list[i].isFollowed==1){
                                $(".seen").eq(i).text("已关注")
                            }else{
                                $(".seen").eq(i).text("关注")

                            }
                            if(data.list[i].bookStatus==1){
                                $(".type").eq(i).addClass("arrange").find("span").text("正在排课")
                            }else if(data.list[i].bookStatus==2){
                                $(".type").eq(i).addClass("success").find("span").text("预约成功")
                            }else if(data.list[i].bookStatus==3){
                                $(".type").eq(i).addClass("fail").find("span").text("预约失败")
                            }

                        }
                    }else{
                        $(".alert").html("")
                        $(".alert").append('<p style="text-align:center; font-size:0.5rem; padding:0.2rem 0.5rem;">没有更多了</p>')
                    }
                }
            })
            npage+=6;
        }
    })
})
// 关注状态
function followed(id) {
    var url = "/index.php/Organization/followed";
    $.post(url,{id:id},function (res) {
        if(res.status == 1){
            alert('成功关注');
            $(".seen"+id).text("已关注")
        }else if(res.status == 2){
            alert('成功取消关注');
            $(".seen"+id).text("关注")
        }
    },'json')
}
function getOrg(id) {
    window.location.href = "/index.php/Organization/demo.html?id=" + id;
}