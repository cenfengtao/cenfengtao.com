$(window).load(function () {
        setTimeout(function () {
            $('.kap-bottom').show();
        }, 2000)
    });
    $('.submit-comment').click(function () {
        var org_star = $(".org-star .light").length;
        var env_star = $(".env-star .light").length;
        var quality_star = $(".quality-star .light").length;
        if(org_star <= 0){
            return alert('请对机构评分');
        }
        if(env_star <= 0){
            return alert('请对环境评分');
        }
        if(quality_star <= 0){
            return alert('请对教学质量评分');
        }
        var order_id = $("input[name='order_id']").val();
        var url = "/index.php/Orders/addComment";
        var data = {
            order_id: order_id,
            content: $('#order_contact_memo').val(),
            org_star: org_star,
            env_star: env_star,
            quality_star: quality_star
        };
        $.post(url, data, function (result) {
            if (result.status == 0) {
                return alert(result.message);
            } else {
                alert(result.message);
                setTimeout(window.location.href = '/index.php/Personal/index', 3000);

            }
        }, 'json');
    });

    $(".org-star li").click(function () {
        var starCount = $(this).attr('attr-val');
        var lis = $(".org-star li");
        for (var i = 0; i < lis.length; i++) {
            lis[i].className = i < starCount ? "light" : '';
        }
    });

    $(".env-star li").click(function () {
        var starCount = $(this).attr('attr-val');
        var lis = $(".env-star li");
        for (var i = 0; i < lis.length; i++) {
            lis[i].className = i < starCount ? "light" : '';
        }
    });

    $(".quality-star li").click(function () {
        var starCount = $(this).attr('attr-val');
        var lis = $(".quality-star li");
        for (var i = 0; i < lis.length; i++) {
            lis[i].className = i < starCount ? "light" : '';
        }
    });