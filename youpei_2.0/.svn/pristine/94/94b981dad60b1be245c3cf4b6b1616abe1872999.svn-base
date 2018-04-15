$(".wx-login").unbind().click(function(){
	ty.showLogin("login");
});

$(".wx-loginout").unbind().click(function(){
    $.ajax({
        dataType:"json",
        url:api_url,
        type:"POST",
        data:{
            action:"logout_member"
        },
        success: function(d){
            if(d.success=="1"){
                $(".head-icon img").attr("src","styles/avatar_default.png");
                $("body").data("login-status","0");
                $("#pc_login").find(".wx-name").text("");
                $("#pc_login").find(".wx-loginout").hide();
                $("#pc_login").find(".wx-login").show();
                kap.alert("已成功退出登录");
            }
        }
    });
});

ty.showLogin=function(){
    if($(".ty-pc-login").length<1){
		var hash=location.hash;
        $.ajax({
            dataType:"json",
            url:api_url,
            type:"POST",
            data:{
                action:"get_login_code",
                hash:hash
            },
            success: function(d){
                if(d.success=="1"){
                    $("body").append('<div class="ty-pc-login"><span class="login-qrcode"><img src="data:image/png;base64,'+d.qr+'" width="200" height="200" alt=""/>请使用微信扫码登录</span></div>');
                    $("body").data("login-countdown","90");
                    $("body").data("login-code",d.code)
                    recheck_login();
                    $(".ty-pc-login").unbind().click(function(){
                        ty.showShare(false);
                        $(this).remove();
                    })
                    kap.mask(true);
                }
            }
        });
    }else{
        kap.mask(false);
        $(".ty-win-share").hide().remove(); 
    }
}

function recheck_login(){
    var i = $("body").data("login-countdown");
    var code = $("body").data("login-code");
    var iCount = setInterval(function(){               
        if(i%2==0){
            $.ajax({
                dataType:"json",
                url:"../api_v2/api.php",
                type:"POST",
                data:{
                    action:"login_check",
                    code:code
                },
                success: function(d){
                    if(d.success=="1"){
                        $(".head-icon img").attr("src",d.headimgurl);
                        $("body").data("login-status","1");
                        $("#pc_login").find(".wx-name").text(d.nickname);
                        $("#pc_login").find(".wx-login").hide();
                        $("#pc_login").find(".wx-loginout").show();
                        clearInterval(iCount);
                        kap.mask(false);
						$(".ty-pc-login").remove();
                        $(".ty-win-share").hide().remove();
                        kap.alert("登录成功");
                    }else if(d.success == "-1"){
                        $("body").data("login-status","0");
                        kap.alert("二维码已失效，如需继续登录请重新获取");
                        clearInterval(iCount);
                    }else if(d.success == "2"){
                        $("body").data("login-status","0");
                        clearInterval(iCount);
                        kap.alert("您已取消登录，如需继续登录请重新获取");
                    }
                }
            });
        }
        i--;
        if(i==0)
            clearInterval(iCount);
    },1000);
}

function get_product_qrcode(sId,toolsId){
    $.ajax({
        dataType:"json",
        url:api_url,
        type:"POST",
        data:{
            action:"get_product_code",
            sid:sId,
            spread_type:spread_type,
            spread_from:spread_from,
            spread_uid:spread_uid,
            spread_sid:spread_seriesid
        },
        success: function(d){
            if(d.success=="1"){
                $("#"+toolsId).find(".qrcode img").attr("src","data:image/png;base64,"+d.qrcode);
                $("#"+toolsId).find(".wx-code").text(d.keyword);
            }else{
                // $("#"+toolsId).find(".qrcode img").attr("src","styles/pc_qrcode.png");
                $("#"+toolsId).find(".wx-code").text('优培');
            }
        }
    });
}

function show_order_info(tradeno,price){
    if($(".ty-pc-order").length<1){
        $("body").append('<div class="ty-pc-order"><span class="order-qrcode"><img src="imgs/wxpay.png" width="200" height="200" alt=""/><div class="ty-order-success"><div class="order-detail"><p>您的订单已经生成。</p ><p>订单号：<span class="code">'+tradeno+'</span></p ><p>需支付：<span class="price">'+price+'</span></p ><p>请使用微信扫描二维码完成支付。</p ></div></div></span></div>');
        $("body").data("order-countdown","120");
        recheck_order_pay();
        $(".ty-pc-order").unbind().click(function(){
            ty.showShare(false);
            $(this).remove();
        });
        $(".order-qrcode").click(function(){
            return false;
        });
        kap.mask(true);
    }else{
       kap.mask(false);
       $(".ty-win-share").hide().remove(); 
    }
}

function recheck_order_pay(){
    var i = $("body").data("order-countdown");
    var orderid = $("#form_order_person .ty-page").data("ty-orderid");
    var iCount = setInterval(function(){               
        if(i%2==0){
            $.ajax({
                dataType:"json",
                url:"../api_v2/api.php",
                type:"POST",
                data:{
                    action:"check_order_pay",
                    orderid:orderid
                },
                success: function(d){
                    if(d.success=="1"){
                        clearInterval(iCount);
                        kap.mask(false);
                        $(".ty-pc-order").remove();
                        $(".ty-win-share").hide().remove();
                        kap.alert("订单已成功支付，祝您出游愉快！",function(){
                            $("body").data("ty-reload","1");
                            ty.loadPage({
                                pageid:"#page_orders_ready"
                            });
                        });
                    }else if(d.success == "-1"){
                        clearInterval(iCount);
                        kap.mask(false);
                        $(".ty-pc-order").remove();
                        $(".ty-win-share").hide().remove();
                        kap.alert("操作已超时，如需继续支付请再次点击“提交订单”按钮");
                    }
                }
            });
        }
        i--;
        if(i==0)
            clearInterval(iCount);
    },1000);
}

$("#side_order .buy-now").unbind().click(function(){
    var order_item_id = "";
    var order_item_qty = "";
    var order_item_num = 0;
    $("#detail_order input[name='product_item']").each(function(){
        if(order_item_id != ""){
            order_item_id += ","+$(this).data("ty-itemid");
            order_item_qty += ","+$(this).val();
        }else{
            order_item_id = $(this).data("ty-itemid");
            order_item_qty = $(this).val();
        }
        order_item_num += $(this).val()*1;
    });
    if(order_item_num > 0){
        if($("#detail_order .ty-page").data("ty-seriesid") == '5044' && order_item_num > 1){ // App福利 20160924
            kap.alert("很抱歉，每位APP用户只能抢购一次哦");
        }else{
            if($("#detail_order .ty-page").data("ty-productid") != $("#form_order_person .ty-page").data("ty-productid") || order_item_qty != $("#form_order_person .ty-page").data("ty-qty"))
                $("body").data("ty-reload","1");
            ty.loadPage({
                pageid:"#form_order_person",
                arg:"sid="+$("#detail_order .ty-page").data("ty-seriesid")+"&pid="+$("#detail_order .ty-page").data("ty-productid")+"&itemid="+order_item_id+"&qty="+order_item_qty
            });
        }
    }else
        kap.alert('请先选择所需购买的项目');
});