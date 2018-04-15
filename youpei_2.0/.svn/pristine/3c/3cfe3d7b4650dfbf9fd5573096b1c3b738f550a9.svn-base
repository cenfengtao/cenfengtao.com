 //查询
 function searchWord() {
     var word = $("#searchWord").val();
     // var type = $("select[name='searchType'] option:selected").val();
     if (!word) {
         return alert('请输入关键词');
     }
     window.location.href = "/index.php/Index/searchResult?type=4&word="+word;
 }

 function getArticle(id) {
     window.location.href = '/index.php/Article/getArticle?art_id='+id;
 }

 function getBargain(id,key) {
     window.location.href = '/index.php/Product/bargain?pro_id='+id+'&key='+key;
 }
// 调用地图时触发，隐藏头部
    function hideHead(i) {
        var head = i.contentWindow.document.getElementById('headTitle');
        head.style.display = 'none';
        var top = i.contentWindow.document.getElementById('qiandao');
        top.style.margin = '-10rem auto 0 auto';
        var allmap = i.contentWindow.document.getElementById('allmap');
        allmap.style.height = '38rem';
        // var message = i.contentWindow.document.getElementById('message');
        // message.style.size = '6vh';
    }
$(function(){
    $.ajax({
        type:"get",
        url:"/index.php/organization/ajaxIndex",
        aynsc:true,
        data:{

        },
        dataType:"json",
        success:function(data){
            if(data.status==1){
                var data=data.data;
                for(var i=0; i<data.data.length; i++){
                    $(".orgList >ul").append(
                       '<li onclick="getInfo('+data.data[i].is_show+','+data.data[i].id+')" id="'+data.data[i].id+'">'+
                            '<div class="content">'+
                                '<div class="rank">'+
                                    '<span>综合排名</span>'+
                                    '<div>'+
                                        '<img src="../../../../Public/images/orgIcon4.png" alt="" class="rankImg">'+
                                        '<span class="rankText">'+data.data[i].ranking+'</span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="org">'+
                                    '<img src="'+data.data[i].picture+'" alt="">'+
                                    '<span>'+data.data[i].org_name+'</span>'+
                                '</div>'+
                                '<ul>'+
                                   '<li>'+
                                        '<span>教学环境</span>'+
                                        '<span class="env_star">'+   
                                        '</span>'+
                                    '</li>'+
                                    '<li>'+
                                        '<span>教学质量</span>'+
                                        '<span class="quality_star">'+
                                        '</span>'+
                                    '</li>'+
                                    '<li>'+
                                        '<span>机构信誉</span>'+
                                        '<span class="org_star">'+
                                        '</span>'+
                                    '</li>'+
                                '</ul>'+
                            '</div>'+
                            '<div class="img">'+
                                '<img src="'+data.data[i].cover_image+'" alt="">'+
                            '</div>'+
                        '</li>'
                    )
                    if($(".rankText").eq(i).html()==1){
                        $(".rankImg").eq(i).attr("src","../../../../Public/images/orgIcon1.png")
                    }
                    if($(".rankText").eq(i).html()==2){
                        $(".rankImg").eq(i).attr("src","../../../../Public/images/orgIcon2.png")
                    }
                    if($(".rankText").eq(i).html()==3){
                        $(".rankImg").eq(i).attr("src","../../../../Public/images/orgIcon3.png")
                    }
                    var env_star=data.data[i].env_star;
                    var quality_star=data.data[i].quality_star;
                    var org_star=data.data[i].org_star;
                    for(var j=0; j<env_star; j++){
                        $("#"+data.data[i].id).find(".env_star").append(
                            '<img src="../../../../Public/images/star-full.png" alt="">'
                            )
                    }
                    for(var j=0; j<quality_star; j++){
                        $("#"+data.data[i].id).find(".quality_star").append(
                            '<img src="../../../../Public/images/star-full.png" alt="">'
                            )
                    }
                    for(var j=0; j<org_star; j++){
                        $("#"+data.data[i].id).find(".org_star").append(
                            '<img src="../../../../Public/images/star-full.png" alt="">'
                            )
                    }
                }
                
            }
        }
    })
   
})
//  var npage=6;
//  $(window).scroll(function () {
//     var scrollTop = $(this).scrollTop();
//     var scrollHeight = $(document).height();
//     var windowHeight = $(this).height();
//     var upload_type=window.sessionStorage.getItem("status")
//     if (scrollTop + windowHeight == scrollHeight) {
//         $(this).scrollTop(scrollHeight - 50);
//         //加载层
//         layer.load();
//         setTimeout(function () {
//             layer.closeAll('loading');
//         }, 1000);
//         $.ajax({
//             type:"get",
//             url:"/index.php/organization/ajaxIndex",
//             aynsc:true,
//             data:{
//                 page:npage
//             },
//             dataType:"json",
//             success:function(data){
//                 if(data.status==1){
//                     var data=data.data;
//                     for(var i=0; i<data.data.length; i++){
//                         $(".orgList >ul").append(
//                            '<li onclick="getInfo('+data.data[i].id+')" id="'+data.data[i].id+'">'+
//                                 '<div class="content">'+
//                                     '<div class="rank">'+
//                                         '<span>综合排名</span>'+
//                                         '<div>'+
//                                             '<img src="../../../../Public/images/orgIcon4.png" alt="" class="rankImg">'+
//                                             '<span class="rankText">'+data.data[i].ranking+'</span>'+
//                                         '</div>'+
//                                     '</div>'+
//                                     '<div class="org">'+
//                                         '<img src="'+data.data[i].picture+'" alt="">'+
//                                         '<span>'+data.data[i].org_name+'</span>'+
//                                     '</div>'+
//                                     '<ul>'+
//                                        '<li>'+
//                                             '<span>教学环境</span>'+
//                                             '<span class="env_star">'+   
//                                             '</span>'+
//                                         '</li>'+
//                                         '<li>'+
//                                             '<span>教学质量</span>'+
//                                             '<span class="quality_star">'+
//                                             '</span>'+
//                                         '</li>'+
//                                         '<li>'+
//                                             '<span>机构信誉</span>'+
//                                             '<span class="org_star">'+
//                                             '</span>'+
//                                         '</li>'+
//                                     '</ul>'+
//                                 '</div>'+
//                                 '<div class="img">'+
//                                     '<img src="'+data.data[i].cover_image+'" alt="">'+
//                                 '</div>'+
//                             '</li>'
//                         )
//                         if($(".rankText").eq(i).html()==1){
//                             $(".rankImg").eq(i).attr("src","../../../../Public/images/orgIcon1.png")
//                         }
//                         if($(".rankText").eq(i).html()==2){
//                             $(".rankImg").eq(i).attr("src","../../../../Public/images/orgIcon2.png")
//                         }
//                         if($(".rankText").eq(i).html()==3){
//                             $(".rankImg").eq(i).attr("src","../../../../Public/images/orgIcon3.png")
//                         }
//                         var env_star=data.data[i].env_star;
//                         var quality_star=data.data[i].quality_star;
//                         var org_star=data.data[i].org_star;
//                         for(var j=0; j<env_star; j++){
//                             $(".env_star").eq(i).append(
//                                 '<img src="../../../../Public/images/star-full.png" alt="">'
//                                 )
//                         }
//                         for(var j=0; j<quality_star; j++){
//                             $(".quality_star").eq(i).append(
//                                 '<img src="../../../../Public/images/star-full.png" alt="">'
//                                 )
//                         }
//                         for(var j=0; j<org_star; j++){
//                             $(".org_star").eq(i).append(
//                                 '<img src="../../../../Public/images/star-full.png" alt="">'
//                                 )
//                         }
//                     }
                    
//                 }else{
//                     $(".alert").html("")
//                     $(".alert").append('<p style="text-align:center; font-size:0.5rem; padding:0.2rem 0.5rem;">没有更多了</p>')
//                 }
//             }
//         })
//         npage+=6;
//     }
// })
function getInfo(show,id) {
    if(show==1){
         window.location.href = "/index.php/Organization/demo.html?id=" + id;
    }else{
        alert("亲，该机构暂未开放哦！")
    }
}