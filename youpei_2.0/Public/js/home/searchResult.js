 //获取url地址type值
    function GetQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null)return decodeURI(r[2]);
        return null;
    }

    var npage = 10;
    $(function () {
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = $(this).height();
            var type = GetQueryString("type");
            var word = GetQueryString("word");
            if (scrollTop + windowHeight == scrollHeight) {
                //加载层
                layer.load();
                setTimeout(function () {
                    layer.closeAll('loading');
                }, 1000);
                var url = "/index.php/Index/loadingSearch";
                var params = {};
                params.type = type;
                params.word = word;
                params.npage = npage;
                $.post(url, params, function (result) {
                    if (result.status == 0) {
                        $(".empty").remove();
                        return $('.list').append("<li class='empty'>没有更多了</li>");
                    }
                    $.each(result.data, function (index, value) {
                        if (value['search_type'] == 1) {
                            $(".list").append("<li class='item' onclick='getArticle( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['image'] + "' style='background-size:cover;'>" +
                                    "<span class='desc'>" +
                                    "<h3 class='title'>" + value['title'] + "</h3>" +
                                    "<span class='time'><span class='lef'>" + value['time'] + "</span></span>" +
                                    "</span>" +
                                    "<span class='icon-sale'></span>" +
                                    "</li>");
                        } else if (vlaue['search_type'] == 2 || value['search_type'] == 3) {
                            $(".list").append("<li class='item' onclick='getProduct( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['pic_url'] + "' style='background-size:cover;'>" +
                                    "<span class='desc'>" +
                                    "<h3 class='title'>" + value['title'] + "</h3>" +
                                    "<span class='time'><span class='lef'>" + value['time'] + "</span></span>" +
                                    "</span>" +
                                    "<span class='icon-sale'></span>" +
                                    "</li>");
                        } else if (vlaue['search_type'] == 4) {
                            $(".list").append("<li class='item' onclick='getOrganization( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['picture'] + "' style='background-size:cover;width: 4.3rem;'>" +
                                    "<span class='desc'>" +
                                    "<h3 class='title'>" + value['org_name'] + "</h3>" +
                                    "<span class='time'><span class='lef'>" + value['time'] + "</span></span>" +
                                    "</span>" +
                                    "<span class='icon-sale'></span>" +
                                    "</li>");
                        }

                    });
                });
                npage += 6;
            }
        });
    });

    function getArticle(id) {
        window.location.href = "/index.php/Article/getArticle?art_id=" + id;
    }
    function getProduct(id) {
        window.location.href = "/index.php/Product/productDetails?pro_id=" + id;
    }
    function getOrganization(id) {
        window.location.href = "/index.php/Organization/home?id=" + id;
    }
    $(function () {
        $(".ty-cat-tags span").click(function () {
//            $(this).find("span").addClass("tag link on").parent().siblings().find("span").removeClass("on");

            $(this).siblings('span').removeClass('on');  // 删除其他兄弟元素的样式
            $(this).addClass('on');
        });
    });