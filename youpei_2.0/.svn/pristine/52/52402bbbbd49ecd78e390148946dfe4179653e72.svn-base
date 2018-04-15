/**
 * 管理员操作
 * */
var adminUser = {
    //验证修改
    checkEdit: function () {
        var mobile = $('input[name="mobile"]').val();
        var mobileRet = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/;
        var passwordA = $('input[name="passwordA"]').val();
        var passwordB = $('input[name="passwordB"]').val();
        var passwordRet = /^(?=.*\d)((?=.*[a-z])|(?=.*[A-Z]))[a-zA-Z\d]{8,20}$/;
        if (!mobileRet.test(mobile)) {
            return dialog.error('手机格式不正确');
        }
        if (passwordA != passwordB) {
            return dialog.error('两次输入密码不一致');
        }
        if (!(passwordRet.test(passwordA) || passwordRet.test(passwordB))) {
            return dialog.error('密码必须包含字母和数字');
        }
        var url = "/admin.php/AdminUser/editAdminUser";
        var data = {'mobile': mobile, 'passwordA': passwordA, 'passwordB': passwordB};
        $.post(url, data, function (result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1) {
                return dialog.success(result.message, '/admin.php');
            }
        }, 'json');
    },
    checkInput: function () {
        var username = $('input[name="username"]').val();
        var passwordA = $('input[name="passwordA"]').val();
        var passwordB = $('input[name="passwordB"]').val();
        var mobile = $('input[name="mobile"]').val();
        var mobileRet = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/;
        var role_id = $('select[name="role_id"] option:selected').val();
        var type = $('input[name="type"]:checked').val();
        var org_id = $('select[name="org_id"] option:selected').val();
        var passwordRet = /^(?=.*\d)((?=.*[a-z])|(?=.*[A-Z]))[a-zA-Z\d]{8,20}$/;
        if (passwordA != '' && !passwordRet.test(passwordA)) {
            return dialog.error('密码必须包含字母和数字，且在8到20范围内');
        }
        if (passwordA != passwordB) {
            return dialog.error('两次输入密码不一致');
        }
        if (mobile != '' && !mobileRet.test(mobile)) {
            return dialog.error('手机格式不正确');
        }
        if (role_id == '' || role_id == 0) {
            return dialog.error('请选择角色等级');
        }
        if (type == 1 && (org_id == '' || org_id == 0)) {
            return dialog.error('机构id不能为空');
        }
        var jumpUrl = SCOPE.jump_url;
        var successUrl = SCOPE.success_url;
        var data = $('.form-youpei').serializeArray();
        postData = {};
        $(data).each(function (i) {
            postData[this.name] = this.value;
        });
        $.post(jumpUrl, postData, function (result) {
            if (result.status == 1) {
                return dialog.success(result.message, successUrl);
            } else {
                return dialog.error(result.message);
            }
        }, 'JSON')
    }

};
