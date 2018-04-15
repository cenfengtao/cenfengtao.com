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
var vote_id=GetRequest().vote_id;
$(".voteList").attr("href","/index.php/Vote/voteList.html?vote_id="+vote_id)
$(".userVote").attr("href","/index.php/Vote/userVote.html?vote_id="+vote_id)
$(".userWorks").attr("href","/index.php/Vote/userWorks.html?vote_id="+vote_id)
$(".userBillboard").attr("href","/index.php/Vote/userBillboard.html?vote_id="+vote_id)
    $.ajax({
        type:"get",
        url:"/index.php/Vote/ajaxUserWorks",
        async: true,
        dataType:"json",
        data:{
            vote_id:vote_id
        },
        success:function(data){
            $('#status').val(data.data.status);
            $('#id').val(data.data.id);
            if(data.status==1){
                var data=data.data;
                if(data.is_null==0){
                    $(".works").append('<p style="text-align:center; font-size:0.5rem;margin-top:5rem;">您还没有作品哦，赶快去<a href="javascript:void(0);"style="text-decoration: underline;font-size:0.7rem; color:black;" class="judge">投稿</a>吧!</p>')
                    if(data.voteStatus==3){
                      var year=data.start_time.split("-")[0];
                      var month=data.start_time.split("-")[1];
                      var day=data.start_time.split("-")[2];
                      $(".judge").attr("onclick","")
                        $(".judge").click(function(){
                                alert("该活动未开始，将在"+year+"年"+month+"月"+day+"日开始，欢迎到时来参加！")
                            })
                    }
                    if(data.voteStatus==2){
                      if(data.isContribute==1){
                        $(".judge").attr("onclick","")
                        $(".judge").click(function(){
                                alert("该活动已截止投稿，欢迎下次活动时来投稿！")
                            })
                      }else{
                        $(".judge").click(function(){
                                window.location.href="/index.php/Vote/contribution.html?vote_id="+vote_id;
                            })
                         
                      }
                    }
                }else{
                    // var dataLength=data.length;
                    if(data.upload_type==1){
                        var year=data.time.split("-")[0];
                        var month=data.time.split("-")[1];
                        var day=data.time.split("-")[2];
                        $(".works").append(
                            '<li>'+
                                '<section class="date">'+
                                    '<p>投稿日期：<span>'+year+'年'+month+'月'+day+'日</span></p>'+
                                    '<span class="status"></span>'+
                                '</section>'+
                                '<section class="img">'+
                                    // '<img src="'+data.path+'" alt="">'+
                                    '<div class="swiper-container to" onclick="toVote('+data.id+','+data.vote_id+')">'+
                                        '<div class="swiper-wrapper">'+
                                        '</div>'+
                                        '<div class="pagination"></div>'+
                                        '<div class="arrow-left">&lt;</div>'+
                                        '<div class="arrow-right">&gt;</div>'+
                                   ' </div>'+
                                '</section>'+
                                '<section class="name">'+
                                    '<p><i></i>名称：<span>'+data.title+'</span></p>'+
                                '</section>'+
                                '<section class="nowTicket">'+
                                    '<p><i></i>当前票数：<span>'+data.vote_count+'</span>票</p>'+
                                '</section>'+
                                '<section class="go">'+
                                    '<a href="javascript:void(0)" class="goVote" onclick="createVotePoster()">邀请好友投票</a>'+
                                    '<a href="###" onclick="revise(event,'+data.id+','+data.vote_id+')" class="revise">我要修改</a>'+
                                '</section>'+
                            '</li>'
                        )
                        var pathUrl=data.path;
                        var pathLength=data.path.length;
                        var index=0;
                        for(var i=0; i<=pathLength-1;i++){
                            if(pathUrl[i]==""){
                                index+=1;
                            }
                        }
                        for(var j=0; j<pathLength-index; j++){
                            $(".swiper-wrapper").append(
                                    '<img src="'+pathUrl[j]+'" alt="" style="width: 100%" class="swiper-slide">'
                                ) 

                        }
                        var mySwiper = new Swiper('.swiper-container',{
                            pagination: '.pagination',
                            loop:true,
                            grabCursor: true,
                            paginationClickable: true,
                            spaceBetween: 30,
                            centeredSlides: true,
                            nextButton: '.arrow-right',
                            prevButton: '.arrow-left',
                            // autoplay: 2500,
                            // autoplayDisableOnInteraction: false
                        });
                            $(".arrow-left").click(function(e){
                                e.stopPropagation();
                            })
                            $(".arrow-right").click(function(e){
                                e.stopPropagation();
                            })
                        if(data.voteStatus==1){
                            $(".go").html('<a href="javascript:void(0)" onclick="alerts(event)" class="goVote" style="background:gray;">去拉票</a>');
                        }
                        if(data.voteStatus==2){
                            if(data.status==1){
                                document.getElementsByClassName("status")[0].innerHTML="审核中，请耐心等待";
                                document.getElementsByClassName("goVote")[0].style.display="none";
                                document.getElementsByClassName("revise")[0].style.marginTop="0";
                                document.getElementsByClassName("to")[0].onclick=function(){};
                            }
                            if(data.status==2){
                                document.getElementsByClassName("status")[0].innerHTML="审核通过，赶快去拉票吧";
                                document.getElementsByClassName("revise")[0].style.display="none";
                            }
                            if(data.status==3){
                                document.getElementsByClassName("status")[0].innerHTML="落选了，请重新投稿";
                                document.getElementsByClassName("goVote")[0].style.display="none";
                                document.getElementsByClassName("revise")[0].style.marginTop="0";
                                document.getElementsByClassName("to")[0].onclick=function(){};
                            }
                        }
                    }
                    if(data.upload_type==2){
                        var year=data.time.split("-")[0];
                        var month=data.time.split("-")[1];
                        var day=data.time.split("-")[2];
                        $(".works").append(
                            '<li onclick="toVote('+data.id+','+data.vote_id+')" class="to">'+
                                '<section class="date">'+
                                    '<p>投稿日期：<span>'+year+'年'+month+'月'+day+'日</span></p>'+
                                    '<span class="status"></span>'+
                                '</section>'+
                                '<section class="img">'+
                                    '<img src="'+data.path+'" alt=""></img>'+
                                '</section>'+
                                '<section class="name">'+
                                    '<p><i></i>名称：<span>'+data.title+'</span></p>'+
                                '</section>'+
                                '<section class="nowTicket">'+
                                    '<p><i></i>当前票数：<span>'+data.vote_count+'</span>票</p>'+
                                '</section>'+
                                '<section class="go">'+
                                    // '<a href="javascript:void(0)" class="goVote">去拉票</a>'+
                                    // '<a href="###" onclick="revise(event,'+data.id+','+data.vote_id+')" class="revise">我要修改</a>'+
                                    '<a href="javascript:void(0)" class="goVote" onclick="createVotePoster()">邀请好友投票</a>'+
                                    '<a href="###" onclick="revise(event,'+data.id+','+data.vote_id+')" class="revise">我要修改</a>'+
                                '</section>'+
                            '</li>'
                        )
                       if(data.voteStatus==1){
                            $(".go").html('<a href="javascript:void(0)" onclick="alerts(event)" class="goVote" style="background:gray;">去拉票</a>');
                        }
                        if(data.voteStatus==2){
                            if(data.status==1){
                                document.getElementsByClassName("status")[0].innerHTML="审核中，请耐心等待";
                                document.getElementsByClassName("goVote")[0].style.display="none";
                                document.getElementsByClassName("revise")[0].style.marginTop="0";
                                document.getElementsByClassName("to")[0].onclick=function(){};
                            }
                            if(data.status==2){
                                document.getElementsByClassName("revise")[0].style.display="none";
                            }
                            if(data.status==3){
                                document.getElementsByClassName("status")[0].innerHTML="落选了，请重新投稿";
                                document.getElementsByClassName("goVote")[0].style.display="none";
                                document.getElementsByClassName("revise")[0].style.marginTop="0";
                                document.getElementsByClassName("to")[0].onclick=function(){};
                            }
                        }
                    }
                }
                
            }
        }
    })
    function toVote(id,vote_id){
        // window.location.href="/index.php/Vote/voteDetail.html?id="+id+"&vote_id="+vote_id+"&share=1"; //提示分享
        window.location.href="/index.php/Vote/voteDetail.html?id="+id+"&vote_id="+vote_id;
    }
      function stopBubble(e)
    {
        if (e && e.stopPropagation){

            e.stopPropagation()
        }
        else{
            window.event.cancelBubble=true
        }
    }         
     function revise(event,id,vote_id){
        stopBubble()
        event.preventDefault();
        if ($(event.target).is('.revise')) {
           window.location.href="/index.php/Vote/contribution.html?id="+id+"&vote_id="+vote_id;
        }
        
    }
    function alerts(event){
        stopBubble()
        alert("该作品的投票活动已结束，点击图片可查看该作品之前的作品详情。")
    }

// 生成海报图片
function createVotePoster() {
    layer.msg('生成海报中，请耐心等候');
    var vote_id = GetRequest().vote_id;
    var ajaxUrl = "/index.php/Vote/createVotePoster";
    $.get(ajaxUrl, {vote_id:vote_id},function (result) {
        if (result.status == 0) {
            return alert(result.message);
        }
        if(result.status == 1) {
            var imageUrl = result.data;
            layer.open({
                type: 1,
                title: '长按图片可保存转发拉票',
                skin: 'layui-layer-rim',
                area: ['80%', '17rem'], //宽高
                content:"<div><img src='"+imageUrl+"' style='width: 100%;height:15.5rem;'></div>"
            });
        }
    }, 'json');
}