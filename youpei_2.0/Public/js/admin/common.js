/**
 * 后台公用js
 */

/*
 *提交form表单按钮
 */
$('#table-button-submit').click(function () {
    var data = $('.form-youpei').serializeArray();
    postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    var url = SCOPE.jump_url;
    var success_url = SCOPE.success_url;
    // 将获取到的数据post给服务器
    $.post(url, postData, function (result) {
        if (result.status == 1) {
            return dialog.success(result.message, success_url);
        } else {
            return dialog.error(result.message);
        }
    }, 'JSON');
});

/*
 * 删除确认按钮
 * */
$('.table-button-delete').click(function () {
    var id = $(this).attr('attr_id');
    var message = $(this).attr('attr_message');
    var url = SCOPE.delete_url;
    layer.open({
        type: 0,
        title: '确认信息',
        btn: ['确认', '取消'],
        icon: 3,
        closeBtn: 2,
        content: message,
        yes: function () {
            todelete(url, {'id': id});
        }
    });
});

/*
 * 删除
 * */
function todelete(url, data) {
    $.post(url, data, function (result) {
        if (result.status == 1) {
            return dialog.success(result.message, '');
        } else {
            return dialog.error(result.message);
        }
    }, 'JSON');
}

/*
* 控制权限是否显示
* */
$(function () {
    var accList = new Array();
    $(".accessIdList").each(function () {
        accList[$(this).attr('attr_key')] = $(this).attr('attr_value');
    });
    $(".btn_access").each(function () {
        if($.inArray($(this).attr('access_id'), accList) == -1){
            $(this).hide();
        } else {
            $(this).show();
        }
    });
});
