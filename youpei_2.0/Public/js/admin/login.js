/**
 * 前端登陆js
 */
var login = {
    check: function () {
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        if (!username) {
            return dialog.error('用户名不能为空');
        }
        if (!password) {
            return dialog.error('密码不能为空');
        }
        //执行异步请求
        var url = "/admin.php/Login/loginIn";
        var data = {'username': username, 'password': password};
        $.post(url, data, function (result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1 && result.data['isSuper'] == 1) {
                return location.href = '/admin.php';
            }
            if (result.status == 1 && result.data['isSuper'] == 2) {
                return location.href = '/admin.php/product/proUpList';
            }
        }, 'JSON');
    }
};