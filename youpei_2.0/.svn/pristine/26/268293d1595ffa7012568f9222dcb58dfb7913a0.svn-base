function open_info(id) {
    var displays = $(".li-" + id).css('display');
    if (displays == 'none') {
        $(".li-" + id).css("display", "");
        $("#li_" + id + " i").css("transform", "rotate(180deg)");
    } else {
        $(".li-" + id).css("display", "none");
        $("#li_" + id + " i").css("transform", "rotate(0deg)");
    }
}

function open_integrallist() {
    var url = "/index.php/MemberIntegral/integrallist";
    window.location.href = url;
}



function showAddress(recordId) {
    layer.open({
        type: 1,
        title: '填写领奖收货地址',
        skin: 'layui-layer-rim',
        area: ['90%', '25em'], //宽高
        content: "<div style='margin:4em 2em 2em 2em;font-size:1em;'>联 系 人 &nbsp;：<input style='height:1.5em;font-size:1em;border:1px solid;width:10em;' type='text' name='username'></div>" +
        "<div style='margin:2em;font-size:1em'>联系电话：<input style='height:1.5em;font-size:1em;border:1px solid;width:10em;' type='number' name='mobile'></div>" +
        "<div style='margin:2em;font-size:1em'>收货地址：<input style='height:1.5em;font-size:1em;border:1px solid;width:10em;' type='text' name='address'></div>" +
        "<button onclick='postAddress("+recordId+")' style='display: block;margin:0 auto;padding:0.6em 1.2em;border:0;color:#fff;background: #065b9c;border-radius:0.7em;font-size:1.2em;'>提交</button>"
    });
}

function postAddress(recordId) {
    var username = $('input[name="username"]').val();
    var mobile = $('input[name="mobile"]').val();
    var address = $('input[name="address"]').val();
    var url = '/index.php/Games/updateAddress';
    $.post(url,{username:username,mobile:mobile,address:address,recordId:recordId},function(result){
        if(result.status == 0){
            layer.closeAll();
            setTimeout(function(){
                return alert(result.message);
            },1500)
        }
        if(result.status == 1){
            layer.closeAll();
            setTimeout(function () {
                alert(result.message);
            },1500);
            setTimeout(function () {
                location.reload();
            },1000);
        }
    },'json')
}