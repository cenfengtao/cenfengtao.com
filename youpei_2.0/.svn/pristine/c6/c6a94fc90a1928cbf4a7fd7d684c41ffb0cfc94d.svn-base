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
$(function(){
    $(".morePeople").click(function(){
        $(".morePeople").hide()
    })
    $(".exchange").click(function(){
        $(".tellBox1").show()
    })
    $(".closeBtn").click(function(){
        $(this).parent().parent().hide()
    })
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

var id=GetRequest().id;
var share=GetRequest().share;
function moreWorks(){
    window.location.href="/index.php/Vote/voteList.html?id="+id+"&vote_id="+vote_id;
}
    //商品数量加操作
function add(obj){
    var voteNum=$(".surplus").text()
    var prd_num = obj.previousElementSibling;   
    var num = prd_num.value;
    
    if(isNaN(num)){
        num = 1;
    }else{
        num = parseInt(num);
    }
    
    num+=1;
    if(num>voteNum){
        num=voteNum
    }
    if(voteNum==0){
        num=1
    }
    prd_num.value = num;
}
//商品数量改变的操作
function numChange(obj){
    var num = obj.value;
    if(isNaN(num)){
        num = 1;
    }else if(num==""){
        num=1;
    }else if(num<1){
        num=1;
    }
    num = parseInt(num);
    obj.value = num;
}
//商品数量减操作
function reduce(obj){
    var prd_num = obj.nextElementSibling;
    var num = prd_num.value;
    if(isNaN(num)){
        num = 1;
    }else{
        num = parseInt(num);
    }
    
    num-=1;
    if(num<1){
        num=1
    }
    prd_num.value = num;
}	
    //商品数量加操作
function adds(obj){
    var voteNum=$(".comfirm .integral").text()
    var prd_num = obj.previousElementSibling;   
    var num = prd_num.value;
    
    if(isNaN(num)){
        num = 1;
    }else{
        num = parseInt(num);
    }
    
    num+=1;
    if(num>voteNum){
        num=voteNum
    }
    if(voteNum==0){
        num=0
    }
    prd_num.value = num;
}
//商品数量改变的操作
function numChanges(obj){
    var num = obj.value;
    if(isNaN(num)){
        num = 1;
    }else if(num==""){
        num=1;
    }else if(num<1){
        num=1;
    }
    num = parseInt(num);
    obj.value = num;
}
//商品数量减操作
function reduces(obj){
    var prd_num = obj.nextElementSibling;
    var num = prd_num.value;
    if(isNaN(num)){
        num = 1;
    }else{
        num = parseInt(num);
    }
    
    num-=1;
    if(num<1){
        num=0
    }
    prd_num.value = num;
}   
    $.ajax({
        type:"get",
        url:"/index.php/Vote/lookVoteCount",
        async:true,
        dataType:"json",
        data:{},
        success:function(data){
            var userCount=data.data.count;
            $(".surplus").html(userCount)
        }
    })	
    $.ajax({
        type:"get",
        url:"/index.php/Vote/ajaxVoteDetail",
        async: true,
        dataType:"json",
        data:{
            id:id
        },
        success:function(data){
            if(data.status==0){
                setTimeout(function(){
                    alert(data.message)
                    history.back()
                },1000)  
                return
            }
            var vote_count=data.data.work.vote_count;
            var username=data.data.work.username;
            var title=data.data.work.title;
            var pathUrl=data.data.work.path;
            var desc=data.data.desc;
            var upload_type=data.data.upload_type;
            var more=data.data.more;
            var moreLength=data.data.more.length;
            var desc=data.data.desc;
            $(".desc").append(desc)
            $(".nowNum").html(vote_count);
            $(".workName").html(title);
            $(".userName").html(username);
            $(".dateTime").html(data.data.start_time+'-'+data.data.end_time)
            if(data.status==1){
                $(".comfirm strong").text(data.data.integral)
                if(data.data.voteStatus==1){
                      $(".introduce").css("border","none");
                      $(".vote").hide();
                      $(".judge").attr("onclick","endActivity()");
                      $(".judge").css("background","gray");
                      $(".sharePoster").attr("onclick","endActivity()");
                      $(".sharePoster").css("background","gray");
                      $(".join").fadeIn(1500);
                }
                if(data.data.voteStatus==2){
                    if(share==1){
                        $(".morePeople").fadeIn(1500)
                    }
                    $(".vote").show();
                    if(data.data.isContribute==1){
                        // $(".joinWorks").hide();
                        $(".judge").attr("onclick","end()");
                        $(".judge").css("background","gray");
                        $(".join").fadeIn(1500);
                    }
                    if(data.data.isContribute==2){
                        // $(".joinWorks").show();
                        if(data.data.join==1){
                             $(".judge").attr("onclick","join()");
                             $(".join").fadeIn(1500);
                        }else if(data.data.join==2){
                            $(".judge").attr("onclick","joined()");
                            $(".join").hide();
                            // $(".join").fadeIn(1500);
                        }
                    }
                }
                if (data.data.isMyContribution == 2) {
                    $(".poster").hide();
                } else {
                    $(".poster").show();
                    $(".vote").hide();
                    // $(".go").show();
                    // $(".go").click(function(){
                    //     $(".morePeople").show()
                    // })
                }
                // $(".text").html(desc)
                if(upload_type==1){
                    var pathLength=pathUrl.length;
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
                    // $(".type").html('<img src="'+pathUrl+'" alt=""/>')
                    for(var i=0; i<moreLength; i++){
                        $(".imgList").append(
                             '<li onclick="toVote('+more[i].id+','+more[i].vote_id+')">'+
                                    '<div class="img">'+
                                         '<img class="lazy" alt="" src="'+more[i].path+'" alt="">'+
                                         '<img class="greenTap" src="../../../../Public/images/greenTap.png"/>'+
                                         '<span class="order">'+more[i].number+'号</span>'+
                                         // '<span>'+joinUser[i].id+'</span>'+
                                    '</div>'+
                                    '<p class="name">作品名称：<span>'+more[i].title+'</span></p>'+
                                    '<p>作品作者：<span>'+more[i].username+'</span></p>'+
                                    '<div class="text">'+
                                        '<span class="getNum"><strong>'+more[i].vote_count+'</strong>票</span>'+
                                        '<span class="vote">给TA投票</span>'+
                                    '</div>'+
                                '</li>'
                        )
                    }
                }
                if(upload_type==2){
                    $(".type").html('<video src="'+data.data.work.video+'" alt="" preload controls poster="'+pathUrl+'" style="width:100%;" controlsList="nodownload"></video>')
                    for(var j=0; j<moreLength; j++){
                         $(".imgList").append(
                             '<li onclick="toVote('+more[j].id+','+more[j].vote_id+')">'+
                                    '<div class="img">'+
                                          '<img class="lazy" alt="" src="'+more[j].path+'" alt="">'+
                                         '<img class="greenTap" src="../../../../Public/images/greenTap.png"/>'+
                                         '<span class="order">'+more[j].number+'号</span>'+
                                         '<img src="../../../../Public/images/play.png" alt="" class="playVideo">'+
                                    '</div>'+
                                    '<p class="name">作品名称：<span>'+more[j].title+'</span></p>'+
                                    '<p>作品作者：<span>'+more[j].username+'</span></p>'+
                                    '<div class="text">'+
                                        '<span class="getNum"><strong>'+more[j].vote_count+'</strong>票</span>'+
                                        '<span class="vote">给TA投票</span>'+
                                    '</div>'+
                                '</li>'
                        )
                     }
                }
            }
            
        }
    })
    var bool=true;
    $(".confirms").click(function(){
         var count=$(".numbers").val()
         if(bool){
            bool=false;
             $.ajax({
              type: "post",  
              url:"/index.php/Vote/exchange",  
              async: true, 
              dataType:"json",
              data:{
                count:count
              },
              success:function(data){
                if(data.status==1){
                    bool=true;
                    alert(data.message)
                    $(".tellBox1").hide()
                    window.location.href="/index.php/Vote/voteDetail.html?id="+id+"&vote_id="+vote_id
                }else{
                    bool=true;
                    alert(data.message)
                    // $(".tellBox1").hide()
                }
                
              },
            });
         }
       
    })
   

  //生成分享海报
 function sharePoster() {
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
                 title: '分享投票海报',
                 skin: 'layui-layer-rim',
                 area: ['80%', '17rem'], //宽高
                 content:"<div><img src='"+imageUrl+"' style='width: 100%;height:15.5rem;'></div>",
                 cancel : function () {
                     $.post('/index.php/ScanResponse/unlinkImage',{image:imageUrl});
                 }
             });
         }
     }, 'json');
 }
$(function(){
    $(".confirm").click(function(){
        // var attentions=window.sessionStorage.getItem("attention")
        var userStatus=$("#userStatus").val();
        var value=$(".number").val();
        $.ajax({
            type:"post",
            url:"/index.php/Vote/toVote",
            async:true,
            dataType:"json",
            data:{
                count:value,
                id:id
            },
            success:function(data){
                if(data.status==0){
                    // alert(data.message)
                    $(".tellBox").fadeIn(1000)
                }
                if(data.status==1){
                    if(userStatus==1){
                        alert("恭喜您投票成功！")
                        document.location.reload();
                    }else{
                        $(".tellBoxs").fadeIn(1500);
                        $(".closeBtn").click(function(){
                        $(".tellBoxs").hide()
                        document.location.reload();
                       })

                    } 
                }
            }
        })
    })
})
$(".closeBtn").click(function(){
    $(".tellBox").hide()
})
function join(){
    window.location.href="/index.php/Vote/contribution.html?vote_id="+vote_id;
}
 function toVote(id,vote_id){
        window.location.href="/index.php/Vote/voteDetail.html?id="+id+"&vote_id="+vote_id;
    }

    function end(){
         alert("该活动已截止投稿，欢迎您下次活动时来投稿！")
    }
    function endActivity(){
         alert("该活动已结束，欢迎您下次活动来参加！")
    }
    function joined(){
         alert("您正在参加该活动哦！")
    }