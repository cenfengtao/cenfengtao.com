/**
 * 权限操作
 * */
var access = {
    check: function () {
        var father_id = $('select[name="father_id"] option:selected').val();
        var acc_name = $('input[name="acc_name"]').val();
        var url = $('input[name="url"]').val();
        var type = $('input[name="type"]:checked').val();
        var description = $('input[name="description"]').val();
        var id = $('input[name="id"]').val();
        if (father_id == '') {
            return dialog.error('请选择附属菜单');
        }
        if (!acc_name || acc_name == '') {
            return dialog.error('权限名称不能为空');
        }
        if (!url || url == '') {
            return dialog.error('地址不能为空');
        }
        if (!type || type == '') {
            return dialog.error('请选择类型');
        }
        if (type == 0 && father_id != 0) {
            return dialog.error('菜单类型，附属菜单必须选新菜单栏');
        }
        if (!id) {
            var data = {
                'father_id': father_id,
                'acc_name': acc_name,
                'url': url,
                'type': type,
                'description': description
            };
        } else {
            var data = {
                'father_id': father_id,
                'acc_name': acc_name,
                'url': url,
                'type': type,
                'description': description,
                'id': id
            };
        }

        var jumpUrl = SCOPE.jump_url;
        var success_url = SCOPE.success_url;
        $.post(jumpUrl, data, function (result) {
            if (result.status == 1) {
                return dialog.success(result.message, success_url);
            } else {
                return dialog.error(result.message);
            }
        }, 'JSON');
    },
    access: function () {
        var roleId = $('select option:selected').val();
        var accIds = {};
        $("input[name='table_records']:checkbox:checked").each(function (i) {
            accIds[i] = ($(this).val());
        });
        var url = "/admin.php/Access/access";
        $.post(url, {'accIds': accIds, 'roleId': roleId}, function (result) {
            if (result.status == 1) {
                return dialog.success(result.message, '/admin.php/Access/accessList');
            } else {
                return dialog.error(result.message);
            }
        }, 'JSON');
    }
};
