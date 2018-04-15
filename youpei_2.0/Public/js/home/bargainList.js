// 底部半圆图片切换
$(function(){
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
})
//调转到对应id的页面
function getArticle(id) {
    window.location.href = "/index.php/Article/getArticle?art_id=" + id;
}
// 跳转到对应id的商品页
function getProduct(id) {
    window.location.href = "/index.php/Product/productDetails?pro_id=" + id;
}
// 跳转到对应id的课程页
function getCourse(id) {
    window.location.href = "/index.php/Product/productDetails.html?pro_id="+id;
}



$(function(){
    $.ajax({
         type: "post",
         url: "/index.php/Activity/ajaxBargain",
         aysnc: true,
         dataType: "json",
         success:function(data){
            var courseLength=data.data.courses.length;
            var productLength=data.data.products.length;
            var articleLength=data.data.articles.length;
            // 遍历商品数据
            for(var j=0; j<productLength; j++){
                var productImg=data.data.products[j].pic_url;
                var productId=data.data.products[j].id;
                var products=data.data.products[j];
                $(".products").append(
                    '<li onclick="getProduct(' + productId + ')">'+
                        '<a href="###" class="img">'+
                            '<img src="'+productImg+'" alt="">'+
                            '<span class="bargainTap" attr_bargain="' + products.is_bargain + 
                                '" onclick="getBargainId(event,' + productId + ','+ data.data.products[j].key +')" >'+
                                "<img src='../../../../Public/images/bargainText.png' class='bargainText'>"+
                                "<img src='../../../../Public/images/bargain.gif' class='bargainImg'>"+
                            "</span>" +
                        '</a>'+
                        // '<span class="productBargain" attr_bargain="' + products.is_bargain + 
                        //     '" onclick="getBargainId(' + productId + ','+ data.data.products[j].key +')" >点我砍价'+
                        //     "<img src='../../../../Public/images/axe1.png'>"+
                        // "</span>" +
                        
                        '<div class="text">'+
                            '<h3>'+products.titles+products.price.class_normal+'</h3>'+
                            '<div class="describe">'+products.f_title+'</div>'+
                            '<span class="original_price">原价:￥:'+products.price.original_price+'</span>'+
                            '<p>'+
                                '<span>现价：</span>'+
                                '<span>￥</span>'+
                                '<span>'+products.price.now_price+'</span>'+
                            '</p>'+
                        '</div>'+
                    '</li>'
                )
            }
            // 遍历课程数据
            for(var i=0; i<courseLength; i++){
                var courseId=data.data.courses[i].id;
                var courseImg=data.data.courses[i].pic_url;
                var course=data.data.courses[i];
                $(".courses").append(
                    '<li onclick="getProduct(' + course.id + ')">'+
                        '<div class="courseImg">'+
                            '<a href="###">'+
                               ' <img src="'+courseImg+'" alt="">'+
                                // '<span>优培圈</span>'+
                                '<div class="bargainTap" attr_bargain="' + course.is_bargain + 
                                    '" onclick="getBargainId(event,' + course.id + ','+ course.key+')" >'+
                                    "<img src='../../../../Public/images/bargainText.png' class='courseBargain1'>"+
                                    "<img src='../../../../Public/images/bargain.gif' class='courseBargain2'>"+
                                '</div>'+
                            '</a> '  +
                            
                       ' </div>'+
                       
                        '<div class="text">'+
                            '<h3>'+course.titles+'</h3>'+
                            '<div class="type">'+
                                '<span class="tagFirst">'+course.tagA+'</span>'+
                                '<span class="tagTwo">'+course.tagB+'</span>'+
                                '<span class="tagThree">'+course.tagC+'</span>'+
                            '</div>'+
                           ' <a href="###" class="address">'+
                               ' <img src="../../../../Public/images/address.png" alt="">'+
                                '<span>'+course.add+'</span>'+
                           ' </a>'+
                            '<span class="original_price">原价:￥:'+course.price.original_price+'</span>'+
                            '<p>'+
                               ' <span>平台价：</span>'+
                                '<span>￥</span>'+
                                '<span>'+course.price.now_price+'</span>'+
                                '<span>起</span>'+
                           ' </p>'+
                        '</div>'+
                    '</li>'
                )
                if(course.tagC == ''){
                     var tagC = document.getElementsByClassName('type')[i].lastChild;
                     tagC.style.display="none";
                 }
                 if(course.tagB ==""){
                     var tagB = document.getElementsByClassName('type')[i].lastChild.previousSibling;
                     tagB.style.display="none";
                 }
                 if(course.tagA ==""){
                     var tagA = document.getElementsByClassName('type')[i].lastChild.previousSibling.previousSibling;
                     tagA.style.display="none";
                 }
            }
            
            //遍历文章或视频数据
            for(var a=0; a<articleLength; a++){
                var articleId=data.data.articles[a].id;
                var articleImg=data.data.articles[a].image;
                var article=data.data.articles[a];
                $(".articles").append(
                     '<li class="articleLi" onclick="getArticle('+articleId+')">'+
                       ' <img src="'+articleImg+'" alt="">'+
                        '<div class="text">'+
                            '<h3>'+article.titles+'</h3>'+
                            // '<div class="describe">'+article.desc+'</div>'+
                            '<span class="biao">'+article.cate_name+'</span>'+
                            '<span class="time">'+article.create_time+'</span>'+
                            '<span class="custom">评论（'+article.count+'）| 收藏（'+article.collect+'）</span>'+
                        '</div>'+
                    '</li>'
                )
            }
         }
    })
})
function stopBubble(e)
{
    if (e && e.stopPropagation)
        e.stopPropagation()
    else
        window.event.cancelBubble=true
}         
//砍价
function getBargainId(event,id,key) {
    event.preventDefault()
    event.stopPropagation()
    window.location.href = "/index.php/Product/bargain?pro_id=" + id + "&key=" + key;
}      
 // var b=null;
 //    function a(){
 //        b=setTimeout(function(){
 //        $(".bargain").animate({"bottom":"10px"},200,function(){
 //            $(".bargain").animate({"bottom":"0px"},200)
 //            })
 //        a()
 //    },200)        
 //    }
 //    a()
 //    var c=null;
 //    function d(){
 //        c=setTimeout(function(){
 //        $(".productBargain").animate({"top":"10px"},200,function(){
 //            $(".productBargain").animate({"top":"0px"},200)
 //            })
 //        d()
 //    },200)        
 //    }
 //    d()
