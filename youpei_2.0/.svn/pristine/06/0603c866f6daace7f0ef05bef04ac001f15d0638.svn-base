// 获取url中的参数
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
var id = GetRequest().id;
$(".close").click(function () {
    $(".box").fadeOut(100);
    $(".content").animate({width: '4.725rem', height: '6.77rem'}, 2000);
    boo = true;
});


$(function () {
    var aLength = $(".img span").length;
    $(".img span").click(function () {
        $(this).addClass("on");
        var onLength = $(".on").length;
        if (aLength == onLength) {
            $(".box").fadeIn(2000);
            $(".content").animate({width: '9.45rem', height: '13.44rem'}, 2000)
        }
    })
});
$("#musicImg").click(function () {
    $.ajax({
        type: "get",
        url: "/index.php/Games/ajaxSeekGame",
        aysnc: true,
        dataType: "json",
        data: {
            id: id
        },
        success: function (data) {
            var status = data.status;
            var message = data.message;
            if (status == 0) {
                return alert(message);
            } else {
                var isAddress = data.data.yes.is_address;
                var recordId = data.data.yes.record_id;
                // var audio = document.getElementById('music');
                // audio.play();
                // $("#music")[0].play();
                // setTimeout(function () {
                //     var audio = document.getElementById('music');
                //     audio.pause()
                // }, 2100);
                var titleName = data.data.yes.title;
                var code = data.data.yes.code;
                if(status == 1){
                    $(".giving").html(titleName);
                    $(".code").html("兑换码：" + code);
                    $("#musicImg").hide();
                    $(".changeImg").attr("src", "../../../../Public/images/box2.jpg");
                    $(".gift").show();
                    if(isAddress){
                        setTimeout(function () {
                            showAddress(recordId)
                        },2000);
                    }
                } else { //第二次中奖
                    $(".changeImg").attr("src", "../../../../Public/images/double-box.png");
                    $("#musicImg").hide();
                    $(".giving2").html(titleName);
                    $(".code2").html("兑换码：" + code);
                    $(".gift2").show();
                    $(".giving1").html(data.data.firstPrize.title);
                    $(".code1").html("兑换码：" + data.data.firstPrize.code);
                    $(".gift1").show();
                    if(isAddress) {
                        setTimeout(function () {
                            showAddress(recordId)
                        },2000);
                    }
                }
            }
        }
    })
});

function showAddress(recordId) {
    layer.open({
        type: 1,
        title: '填写领奖收货地址',
        skin: 'layui-layer-rim',
        area: ['90%', '45em'], //宽高
        content: "<div style='margin:2em;font-size:3.8em;'>联 系 人 &nbsp;：<input style='height:2em;font-size:13px;' type='text' name='username'></div>" +
                 "<div style='margin:2em;font-size:3.8em;'>联系电话：<input style='height:2em;font-size:13px;' type='number' name='mobile'></div>" +
                 "<div style='margin:2em;font-size:3.8em;'>收货地址：<input style='height:2em;font-size:13px;' type='text' name='address'></div>" +
                 "<button onclick='postAddress("+recordId+")' style='display: block;margin:0 auto;padding:0.6em 1.2em;border:0;color:#fff;background: #065b9c;border-radius:0.7em;font-size:5em;'>提交</button>"
    });
}

function postAddress(recordId) {
    var username = $('input[name="username"]').val();
    var mobile = $('input[name="mobile"]').val();
    var address = $('input[name="address"]').val();
    var url = '/index.php/Games/updateAddress';
    $.post(url,{username:username,mobile:mobile,address:address,recordId:recordId},function(result){
        if(result.status == 0){
            return alert(result.message);
        }
        if(result.status == 1){
            alert(result.message);
            location.reload();
        }
    },'json')
}