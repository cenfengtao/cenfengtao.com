/**
 * 活动操作
 * */
var parenting = {
    //验证修改
    check: function () {
        var title = $('input[name="title"]').val();
        if (!title) {
            return dialog.error('活动名称不能为空');
        }
        var org_id = $('select[name="org_id"] option:selected').val();
        if (!org_id || org_id == 0) {
            return dialog.error('机构不能为空');
        }
        var count = $('input[name="count"]').val();
        if (!count || count < 0) {
            return dialog.error('库存不能低于0');
        }
        var original_price = $('input[name="original_price"]').val();
        var price = $('input[name="price"]').val();
        if (original_price < 0 || price < 0) {
            return dialog.error('价钱不能低于0');
        }
        var url = "/admin.php/Parenting/addParenting";
        var data = $('.form-youpei').serializeArray();
        postData = {};
        $(data).each(function (i) {
            postData[this.name] = this.value;
        });
        $.post(url, postData, function (result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1) {
                return dialog.success(result.message, '/admin.php/Parenting/index');
            }
        }, 'json');
    }
};
