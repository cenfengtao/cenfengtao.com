/**
 * 商品操作
 * */
var product = {
    //验证修改
    check: function () {
        var title = $('input[name="title"]').val();
        if (!title) {
            return dialog.error('商品名称不能为空');
        }
        var url = "/admin.php/Product/addProduct";
        var data = $('.form-youpei').serializeArray();
        var book_time_length = $('select[name="book_time_day"] option:selected').length;
        var book_time = new Array();
        for (var i = 0; i <= book_time_length; i++) {
            book_time[i] = new Array();
            book_time[i][0] = $(".book_time" + i + " select[name='book_time_day'] option:selected").val();
            book_time[i][1] = $(".book_time" + i + " input[name='book_start_hour']").val();
            book_time[i][2] = $(".book_time" + i + " input[name='book_end_hour']").val();
        }
        var class_time_length = $('select[name="class_time_day"] option:selected').length;
        var class_time = new Array();
        for (var j = 0; j <= class_time_length; j++) {
            class_time[j] = new Array();
            class_time[j][0] = $(".class_time" + j + " select[name='class_time_day'] option:selected").val();
            class_time[j][1] = $(".class_time" + j + " input[name='class_start_hour']").val();
            class_time[j][2] = $(".class_time" + j + " input[name='class_end_hour']").val();
        }
        var price_length = $('.class_normal').length;
        var price = new Array();
        for (var k = 0; k <= price_length; k++) {
            price[k] = new Array();
            price[k][0] = $(".price" + k + " input[name='class_normal']").val();
            price[k][1] = $(".price" + k + " input[name='original_price']").val();
            price[k][2] = $(".price" + k + " input[name='now_price']").val();
            price[k][3] = $(".price" + k + " input[name='count']").val();
        }
        var postData = {};
        $(data).each(function (i) {
            postData[this.name] = this.value;
        });
        postData['book_time'] = book_time;
        postData['class_time'] = class_time;
        postData['price'] = price;
        $.post(url, postData, function (result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1) {
                return dialog.success(result.message, '/admin.php/Product/proUpList');
            }
        }, 'json');
    },
    checkReal: function () {
        var title = $('input[name="title"]').val();
        if (!title) {
            return dialog.error('商品名称不能为空');
        }
        var price_length = $('.class_normal').length;
        var price = new Array();
        for (var k = 0; k <= price_length; k++) {
            price[k] = new Array();
            price[k][0] = $(".price" + k + " input[name='class_normal']").val();
            price[k][1] = $(".price" + k + " input[name='original_price']").val();
            price[k][2] = $(".price" + k + " input[name='now_price']").val();
            price[k][3] = $(".price" + k + " input[name='count']").val();
            price[k][4] = $(".price" + k + " input[name='price_status']").attr('attr_status');
        }
        var url = "/admin.php/Product/addRealProduct";
        var data = $('.form-youpei').serializeArray();
        var postData = {};
        $(data).each(function (i) {
            postData[this.name] = this.value;
        });
        postData['price'] = price;
        $.post(url, postData, function (result) {
            if (result.status == 0) {
                return dialog.error(result.message);
            }
            if (result.status == 1) {
                return dialog.success(result.message, '/admin.php/Product/proUpList');
            }
        }, 'json');
    }
};
