 $('#addOrder').click(function () {
        var groupRecordId = $("input[name='groupRecordId']").val();
        var amount = $("input[name='amount']").val();
        var url = "/index.php/Orders/addGroupOrder";
        if ($('#order_contact_name').val() == '') {
            alert('填写联系人姓名');
            return;
        }
        if ($('#order_contact_mobile').val() == '') {
            alert('填写联系人电话');
            return;
        }
        if ($('#order_contact_mobile').length > 0) {
            var tel = $("#order_contact_mobile").val();
            if (!/^1(3|4|5|7|8){1}\d{9}$/.test(tel)) {
                alert("手机号码格式不正确，请重新填写");
                return;
            }
        }
        var data = {
            groupRecordId: groupRecordId,
            amount: amount,
            name: $('#order_contact_name').val(),
            mobile: $('#order_contact_mobile').val(),
            message: $('#order_contact_memo').val()
        };
        $.post(url, data, function (result) {
            if (result.status == 0) {
                return alert(result.msg);
            } else {
                window.location.href = "/index.php/WxPay/jsapiByGroup?orderId=" + result.orderId;
            }
        }, 'json');
    });
    $(".xm").click(function() {
        $("html, body").animate({
            scrollTop: $("#xm").offset().top }, {duration: 500,easing: "swing"});
        return false;
    });