 // 底部导航选中状态
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
        // 拼团类型
        $(".groupsType li").click(function(){
            var index=$(this).index();
            $(this).addClass("on").siblings().removeClass("on");
            $(".content >div").eq(index).show().siblings().hide();
        })
        // 拼团商品导航切换
        $(".classifyNav li").click(function(){
            $(this).addClass("on").siblings().removeClass("on")
        });
        // 拼团里的进度条颜色变化
         $(function () {
             $(".finished").each(function () {
                 var nowPeople = $(this).find('.nowPeople').text();
                 var allPeople = $(this).find(".allPeople").text();
                 var scale=(nowPeople/allPeople*100);
                 if(scale<35){
                     $(this).next().find(".progress").css({"background":"greenyellow",'width':scale+'%'});
                 }else if(scale<70){
                     $(this).next().find(".progress").css({"background":"orange",'width':scale+"%"});
                 }else if(scale<101){
                     $(this).next().find(".progress").css({"background":"red",'width':scale+"%"});
                 }
             })
         });
        //查看限时抢购商品
        function getProduct(id) {
            window.location.href = "/index.php/Product/productDetails?pro_id=" + id;
        }
         // 生成海报图片
         function createGroupPoster(id) {
             layer.msg('生成海报中，请耐心等候');
             var ajaxUrl = "/index.php/Groups/createGroupPoster";
             $.get(ajaxUrl, {id: id}, function (result) {
                 if (result.status == 0) {
                     return alert(result.message);
                 }
                 if (result.status == 1) {
                     var imageUrl = result.data;
                     layer.open({
                         type: 1,
                         title: '分享团购海报',
                         skin: 'layui-layer-rim',
                         area: ['80%', '16rem'], //宽高
                         content: "<div><img src='" + imageUrl + "' style='width: 100%;height:14rem;'></div>",
                         cancel: function () {
                             $.post('/index.php/ScanResponse/unlinkImage',{image:imageUrl});
                         }
                     });
                 }
             }, 'json');
         }

         function getGroup(id) {
            window.location.href = "/index.php/Groups/getGroup?id="+id;
         }
//限时抢购倒计时
var time_current = (new Date()).valueOf();//获取当前时间
$(function () {
    var dateTime = new Date();
    var difference = dateTime.getTime() - time_current;

    setInterval(function () {
        $(".end_time").each(function () {
            var obj = $(this);
            var endTime = new Date(parseInt(obj.attr('value')) * 1000);
            var nowTime = new Date();
            var nMS = endTime.getTime() - nowTime.getTime() + difference;
            var myD = Math.floor(nMS / (1000 * 60 * 60 * 24));
            var myH = Math.floor(nMS / (1000 * 60 * 60)) % 24;
            var myM = Math.floor(nMS / (1000 * 60)) % 60;
            if(myM < 10) {
                myM = '0' + myM;
            }
            var myS = Math.floor(nMS / 1000) % 60;
            if(myS < 10) {
                myS = '0' + myS;
            }
            var myMS = Math.floor(nMS / 100) % 10;
            if (myD >= 0) {
                var str = "剩余下" + myD + "天  " + myH + ":" + myM + ":" + myS;
            } else {
                var str = "已结束！";
            }
            obj.html(str);
        });
    }, 100);
});
