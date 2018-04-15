/*
 * 封装弹出框方法
 * */

var dialog = {
    //错误弹出框
    error: function (message) {
        layer.open({
            title: '错误提示',
            content: message,
            icon: 2
        });
    },

    //正确弹出框
    success: function (message, url) {
        layer.open({
            icon: 1,
            content: message,
            yes: function () {
                location.href = url;
            }
        });
    },

    //确认弹出框
    confirm: function (message, url) {
        layer.open({
            content: message,
            icon: 3,
            btn: ['确认', '取消'],
            yes: function () {
                location.href = url;
            }
        });
    },

    //停留本页面的确认弹出框
    toConfirm: function (message) {
        layer.open({
            content: message,
            icon: 3,
            btn: ['确认']
        });
    }
};