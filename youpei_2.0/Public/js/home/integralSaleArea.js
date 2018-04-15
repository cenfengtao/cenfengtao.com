// 底部半圆图片切换
$(function(){
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
});
$(function(){
    $.ajax({
        type:"get",
        url:"/index.php/Coupon/ajaxIntegralSaleArea",
        aysnc:true,
        dataType:"json",
        success:function(data){
            if (data.status == 0) {
                return alert(data.message);
            }
            var listList = data.data.list;
            var listLength = listList.length;
            if (listLength == 0) {
                $(".products").append(
                    "<p style='margin-left:3.5rem;font-size:0.6rem;'>没有对应的数据哦</p>"
                );
            } else {
                for(var j=0; j < listLength; j++){
                    $(".products").append(
                        '<li onclick="getProduct('+listList[j].id+')">'+
                        '<a href="###" class="img">'+
                        '<img src="'+listList[j].image+'">'+
                        '</a>'+
                        '<div class="text">'+
                        '<h3>'+listList[j].title+'</h3>'+
                        '<div class="describe">'+listList[j].f_title+'</div>'+
                        '<span class="original_price">原价：￥'+listList[j].original_price+'元</span>'+
                        '<p>'+
                        '<span>积分兑换：</span>'+
                        '<span>￥</span>'+
                        '<span>'+listList[j].price+'</span>'+
                        '</p>'+
                        '</div>'+
                        '</li>'
                    )
                }
            }
        }
    })
});
function getProduct(id) {
    window.location.href = "/index.php/Product/integralProductDetail?bargain_id=" + id;
}

function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}