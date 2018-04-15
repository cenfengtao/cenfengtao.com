    $(function () {
        $("#prize li").each(function () {
            var p = $(this);
            p.css("background", "url(/Public/images/lottery_change01.png) no-repeat").css("background-size", '100% 100%');
            p.click(function () {
                //判断是否有抽奖次数
                var count = $("#lotteryCount").text();
                if (parseInt(count) <= 0) {
                    return alert("点击下方抽奖说明获取更多抽奖机会");
                }
                $("#status").text("正在抽奖中...");
                $("#prize li").unbind('click'); //连续翻动
                var params = {};
                params.token = $('#token').val();
                params.activityid = $('#activityid').val();
                $.getJSON("/index.php/Lottery/lottery", params, function (json) {
                    if (json.status == -1) {
                        $("#status").text('抽奖失败');
                        return alert(json.msg);
                    }
                    var prize = json.msg.yes['title']; //抽中的奖项
                    var pic = json.msg.yes['pic']; //抽中的pic地址
                    var prizeid = json.msg.yes['prizeid'];
                    var pid = json.msg['pid'];
                    var token = $('#token').val();
                    p.flip({
                        direction: 'rl', //翻动的方向rl：right to left
                        speed: 200,
//                        content: prize, //翻转后显示的内容即奖品
                        onEnd: function () { //翻转结束
                            p.css({
                                "background": "url(/" + pic + ") no-repeat",
                                "background-size": "100% 100%"
                            });
                            p.attr("id", "r"); //标记中奖方块的id
//                            $("#viewother").show(); //显示查看其他按钮
                            $("#prize li").unbind('click').css("cursor", "default").removeAttr("title");
                        }
                    });
                    $("#repeat").css('display', 'block');
                    if (json.status == 2) {
                        setTimeout(function () {
                            layer.open({
                                cornerRadius: 8,
                                type: 2 //Page层类型
                                ,
                                skin: 'layer-MyClass'
                                ,
                                area: ['100%', '100%']
                                ,
                                title: "获得了 " + json.msg.yes['title'] + ""
                                ,
                                shade: 0.9 //遮罩透明度
                                ,
                                anim: 1 //0-6的动画形式，-1不开启
                                ,
                                maxmin: true
                                ,
                                content: ["/index.php/Lottery/userinfo?prizeid=" + prizeid + "&token=" + token + "&pid=" + pid, 'no']
                            });
                        }, 1500);

                    }
                    //临时活动
                    if (prize == "电影券") {
                        $("#status").text("微信添加\"youpeikefu01\"发送数字“1”登记领奖！").css({
                            'color': 'red',
                            'font-size': '1.8vh'
                        });
                    } else if (prize.indexOf("邦宝") >= 0) {
                        $("#status").text("微信添加\"youpeikefu01\"发送数字“1”登记领奖！").css({
                            'color': 'red',
                            'font-size': '1.8vh'
                        });
                    } else {
                        $("#status").text("恭喜你，抽中了" + prize).css({'color': 'red', 'font-size': '2.5vh'});
                    }
                    $("#lotteryCount").text(count - 1); //减少抽奖次数
//                    $("#data").data("nolist", json.msg.no); //保存未中奖信息

                    setTimeout(function () {
                        var mydata = json.msg.no; //获取数据
                        var mydata2 = eval(mydata);//通过eval()函数可以将JSON转换成数组
                        $("#prize li").not($('#r')[0]).each(function (index) {
                            var pr = $(this);
                            pr.flip({
                                direction: 'bt',
                                speed: 200,
                                onEnd: function () {
                                    pr.css({

                                        "background": "url(/" + mydata2[index]['pic'] + ") no-repeat",
                                        "background-size": "100% 100%",
                                        'opacity': '0.5',
                                    });
                                }
                            });
                        });
                        $("#data").removeData("nolist");
                    }, 1000);
                });
            });
        });
        $("#repeat").click(function () {
            window.location.href = window.location.href + "&id=" + 10000 * Math.random();
        });
        // $("#explain").click(function () {
        //     layer.open({
        //         cornerRadius: 8,
        //         type: 1 //Page层类型
        //         , skin: 'layer-MyClass'
        //         , area: ['80%', '50%']
        //         , title: '规则说明'
        //         , shade: 0.5 //遮罩透明度
        //         , anim: 5 //0-6的动画形式，-1不开启
        //         , content:
        //         '<p style="text-indent:20px;">1、通过分享抢课活动的专属海报(公众号菜单栏->红包提现->生成海报)，邀请好友助力扫码关注平台，每5次助力可获得1次抽奖机会</p>' +
        //         '<p style="text-indent:20px;">2、通过每日登陆优培圈平台签到可获得一次抽奖机会</p>' +
        //         '<p style="text-indent:20px;">3、奖品兑换按优培圈平台实际操作规定执行。</p>' +
        //         '<p style="text-indent:20px;">4、任何人不得利用平台技术漏洞或规则漏洞进行恶意攻击。使用攻击手段获得的抽奖次数，优培圈有权单方面予以修正。</p>'+
        //         '<p style="text-indent:20px;">5、优培圈平台对此规则拥有最终解释权。</p>'
        //     });
        // });
    });
    var bool=true;
    function exchange() {
        if(bool){
            bool=false;
            layer.open({
            type: 2,
            title: '兑换抽奖次数',
            shadeClose: false,
//          maxmin: true,
            closeBtn:1,
            shade: 5,
            area: ['80%', '50%'],
            content: ["/index.php/Lottery/exchange", 'no'],
            cancel: function(){ 
                    bool=true;
                 }
            })
        }
    
    }

    $(function(){
        $(".scrollText ul li").css("background-color","#f0f1f1");      
        $(".scrollText ul li:even").css("background-color","#fefefe");
    })