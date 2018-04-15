function submituserinfo(){
    var params = {};
    params.id = $("#id").val();
    params.username = $("#username").val();
    params.prizeid = $("#prizeid").val();
    params.token = $("#token").val();
    params.pid = $("#pid").val();
    params.mobile = $("#mobile").val();
    params.areaId1 = $('#areaId1').val();
    params.areaId2 = $('#areaId2').val();
    params.areaId3 = $('#areaId3').val();
    params.address = $("#address").val();

    if (params.username=="") {
        alert("姓名不能空");
            return; 
    }
    
    if(params.mobile==""){
            alert("请输入手机号码或固定电话");
            return;     
        }

        if($('#mobile').length>0){
                    if(!/^1(3|4|5|7|8){1}\d{9}$/.test(params.mobile)){
                        alert("手机号码格式不正确，请重新填写");
                        return;
                    }
                }

    if(params.areaId1<1){
            alert("请选择省");
            return;     
        }
        if(params.areaId2<1){
            alert("请选择市");
            return;     
        }
        if(params.areaId3<1){
            alert("请选择区县");
            return;     
        }
    
        if(params.address==""){
            alert("请输入详细地址");
            return;     
        }
    $.post("/index.php/Lottery/confirmsave",params,function(res){
        if (res.status==1) {
            layer.open({
               title: "中奖信息说明",
               area: ['80%', '30%'],
               content: '<div style="font-size:1rem;line-height:1rem;">抽到的奖品工作人员会在1-7个工作日发出，如有更改及时联系客服微信youpeikefu01或者电话18826439321</div>',
               btn: '我知道了',
               yes: function(){
                window.parent.location.reload();
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
              }

            });

        }
    })
}