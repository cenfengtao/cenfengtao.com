 $(function(){
    $.ajax({
        type:"get",
        url:"/index.php/Personal/ajaxMyBargain",
        aynsc:true,
        data:{},
        dataType:"json",
        success:function(data){
            if(data.status==1){
                var data=data.data;
                var bargainLength=data.bargainProduct.length;
                if(bargainLength==0){
                    $(".shopBargain").append(
                            ' <p style="font-size: 0.5rem;padding: 2rem 0.5rem;text-align: center;">亲,您还没有过参加砍价的记录哦，赶紧去看看还有什么<a href="/index.php/Activity/bargain.html" style="font-size: 0.5rem;text-decoration: underline;">砍价</a>参加吧！</p>'
                        )
                }
                for(var i=0; i<data.bargainProduct.length; i++){
                    $(".shopBargain ul").append(
                        '<li onclick="getBargainId('+data.bargainProduct[i].id+','+data.bargainProduct[i].key+')">'+
                            '<div class="tapImg">'+
                                '<img src="../../../../Public/images/tapImg.png" alt="">'+
                                '<span>砍价</span>'+
                                '</div>'+
                                '<div class="img">'+
                                '<img src="'+data.bargainProduct[i].pic_url+'" alt="">'+
                                '</div>'+
                                '<div class="text">'+
                                '<h3>'+data.bargainProduct[i].title.substring(0,10)+'...</h3>'+
                                '<p>'+
                                '<span>平台价：￥<strong>'+data.bargainProduct[i].now_price+'</strong></span>'+
                                '</p>'+
                                '<div class="type type'+i+'">'+
                                '</div>'+
                            '</div>'+
                        '</li>'
                    )
                     var sift=".type"+i;
                    if(data.bargainProduct[i].tagA){
                        $(sift).append(
                                '<span>'+data.bargainProduct[i].tagA+'</span>'
                            )
                    }
                    if(data.bargainProduct[i].tagB){
                        $(sift).append(
                                '<span>'+data.bargainProduct[i].tagB+'</span>'
                            )
                    }
                    if(data.bargainProduct[i].tagC){
                        $(sift).append(
                                '<span>'+data.bargainProduct[i].tagC+'</span>'
                            )
                    }
                }
            }

        }
    })
})
 //砍价
function getBargainId(id,key) {
        window.location.href = "/index.php/Product/bargain?pro_id=" + id + "&key=" + key;
    // }
}