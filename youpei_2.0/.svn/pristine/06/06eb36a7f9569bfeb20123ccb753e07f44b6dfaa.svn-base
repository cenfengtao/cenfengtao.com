$(window).load(function (){
    setTimeout(function () {
        $('.kap-bottom').show();
    },2000)
});



var npage = 10;
    $(function() {
        $(window).scroll(function() {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = $(this).height();
            var cate_id = $('.ty-cat-tags .on').attr('attr_id');
            if (scrollTop + windowHeight == scrollHeight) {
                //加载层
                layer.load();
                setTimeout(function(){layer.closeAll('loading');}, 1000);
                var url = "/index.php/Collect/loadingCollect";
                var params = {};
                params.cate_id = cate_id;
                params.npage = npage;
                $.post(url,params,function(result) {

                    if (result.status == 0) {
                        $(".empty").remove();
                        scrollHeight = '';
                        return $('.list').append("<li class='empty'>没有更多了</li>");
                    }

                    $.each(result.data, function (index, value) {
                        if(value['type_id'] == 1){
                            $(".list").append("<li class='item' onclick='getOrg( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['picture'] + "' style='background-size:cover;'>" +
                                    "<span class='desc'>"+
                                    "<h3 class='title'>" + value['org_name'] + "</h3>"+
                                    "<span class='time'><span class='lef'>收藏于:" + value['time'] + "</span><span class='rig'>收藏（" + value['count'] + "）</span></span>"+
                                    "</span>"+
                                    "<span class='icon-sale'></span>"+
                                    "</li>");
                        }else if(value['type_id'] == 2){
                            $(".list").append("<li class='item' onclick='getProduct( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['pic_url'] + "' style='background-size:cover;'>" +
                                    "<span class='desc'>"+
                                    "<h3 class='title'>" + value['title'] + "</h3>"+
                                    "<span class='time'><span class='lef'>收藏于:" + value['time'] + "</span><span class='rig'>评论（" + value['count'] + "）</span></span>"+
                                    "</span>"+
                                    "<span class='icon-sale'></span>"+
                                    "</li>");
                        }else if(value['type_id'] == 3){
                            $(".list").append("<li class='item' onclick='getProduct( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['pic_url'] + "' style='background-size:cover;'>" +
                                    "<span class='desc'>"+
                                    "<h3 class='title'>" + value['title'] + "</h3>"+
                                    "<span class='time'><span class='lef'>收藏于:" + value['time'] + "</span><span class='rig'>评论（" + value['count'] + "）</span></span>"+
                                    "</span>"+
                                    "<span class='icon-sale'></span>"+
                                    "</li>");
                        }else if(value['type_id'] == 4){
                            $(".list").append("<li class='item' onclick='getParenting( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['image'] + "' style='background-size:cover;'>" +
                                    "<span class='desc'>"+
                                    "<h3 class='title'>" + value['title'] + "</h3>"+
                                    "<span class='time'><span class='lef'>收藏于:" + value['time'] + "</span><span class='rig'>评论（" + value['count'] + "）</span></span>"+
                                    "</span>"+
                                    "<span class='icon-sale'></span>"+
                                    "</li>");
                        }else if(value['type_id'] == 5){
                            $(".list").append("<li class='item' onclick='getArticle( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['image'] + "' style='background-size:cover;'>" +
                                    "<span class='desc'>"+
                                    "<h3 class='title'>" + value['title'] + "</h3>"+
                                    "<span class='time'><span class='lef'>收藏于:" + value['time'] + "</span><span class='rig'>评论（" + value['count'] + "）</span></span>"+
                                    "</span>"+
                                    "<span class='icon-sale'></span>"+
                                    "</li>");
                        }else if(value['type_id'] == 6){
                            $(".list").append("<li class='item' onclick='getActivity( " + value['id'] + ")'>" +
                                    "<img class='thumb' src='" + value['image'] + "' style='background-size:cover;'>" +
                                    "<span class='desc'>"+
                                    "<h3 class='title'>" + value['title'] + "</h3>"+
                                    "<span class='time'><span class='lef'>收藏于:" + value['time'] + "</span><span class='rig'>评论（" + value['count'] + "）</span></span>"+
                                    "</span>"+
                                    "<span class='icon-sale'></span>"+
                                    "</li>");
                        }

                    });
                })
                npage += 6;
            }
        });
    });

    function getOrg(id) {
        window.location.href = "/index.php/Organization/home?id="+ id;
    }
    function getArticle(id){
        window.location.href = "/index.php/Article/getArticle?art_id="+ id;
    }
    function getProduct(id){
        window.location.href = "/index.php/Product/productDetails?pro_id="+ id;
    }
    function getParenting(id){
        window.location.href = "/index.php/Parenting/productDetails?par_id="+ id;
    }
    function getCateListById(id){
        window.location.href = "/index.php/Collect/index?id="+ id;
    }
    function getActivity(id) {
        window.location.href = "/index.php/Organization/activityDetail?id="+ id;
    }
    $(function () {
        $(".ty-cat-tags span").click(function () {
            $(this).siblings('span').removeClass('on');  // 删除其他兄弟元素的样式
            $(this).addClass('on');
        });
    });