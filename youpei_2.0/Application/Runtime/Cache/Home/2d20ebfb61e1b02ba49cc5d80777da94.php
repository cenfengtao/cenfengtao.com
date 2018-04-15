<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<!--headTrap<body></body><head></head><html></html>--><html>
<head>
<meta charset="utf-8">
<title>优培圈</title>
<meta name="viewport" content="width=device-width, initial-scale=0.5, user-scalable=0, minimum-scale=0.5, maximum-scale=0.5">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><!-- iOS webapp s-->
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="优培圈" />
<meta name="description" content="" />
<link rel="apple-touch-icon-precomposed" href="styles/app_icon.png">
<!-- iOS webapp e -->
<link href="/Public/Home/css/kap.css" rel="stylesheet" type="text/css">
<link href="/Public/Home/css/common.css" rel="stylesheet" type="text/css">
<link href="/Public/Home/css/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/Public/index/member/css/dialog.css" media="all" />
<script type="text/javascript" src="/Public/Home/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="/Public/index/member/js/dialog.js"></script>
<!--移动端兼容适配 end -->
<script src="/Public/Home/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
if(/msie/i.test(navigator.userAgent)){window.location.href="http://www.youpei-exc.com/"}
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?548e13b07cb36e38bfd73870368a0253";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();


// var ua = navigator.userAgent.toLowerCase();
//     if(ua.indexOf("iphone")>0){ //app

//         get_ios_script();
//     }else{
//         get_android_script();
//         $("meta[name=viewport]").attr('content', 'width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0'); 
//     }
//     function get_ios_script() {
//       var link = document.createElement('link');
//         link.type = 'text/css';
//         link.rel = 'stylesheet';
//         link.href = '/Public/Home/css/ios.css';
//         document.getElementsByTagName("head")[0].appendChild(link);
//     }

  
</script>
</head>
<link href="/Public/Home/css/pageloader.css" rel="stylesheet" type="text/css">
<body class="kap-loading ty-view-all ty-ios" onload="">
<div class="kap-wrap">
<!--加载 -->
<div id="bonfire-pageloader">
    <div class="bonfire-pageloader-icon">
<svg class="kap-loading-icon" xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px"  enable-background="new 0 0 512 512" xml:space="preserve">
 <!-- Created with SVG-edit - http://svg-edit.googlecode.com/ -->
 <!--加载图片转码base64格式-->
<g>
 <image class="ty-loading-icon" xlink:href="data:image/png;base64,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" id="ty_tree" height="100" width="100" y="0" x="0"/>
 </g>
 </svg>
</div>
</div>

<script type="text/javascript" src="/Public/Home/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.ba-hashchange.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.exif.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/selectivizr.js"></script>
<!-- <link rel="stylesheet" href="/Public/Home/css/message.css"> -->
<link rel="stylesheet" href="/Public/Home/css/comment.css">
<link rel="stylesheet" href="/Public/css/home/productDetails.css">
<div id="detail_activity" class="kap-page kap-page-current">
    <div class="kap-top ty-menu-top">
        <div id="tools_msg" class="ty-tools ty-tools-inner ty-tools-current">
            <span class="title"><?php echo ($product['title']); ?><span class="num"></span></span>
            <a href="javascript:void(0);" onclick="history.go(-1);" class="btn left btn-user" title="返回"
               data-icon="ɒ"></a>
            <a href="<?php echo U('Index/index');?>" class="btn right btn-user" title="返回首页" data-icon="Ņ"></a>
        </div>
    </div>
    <div class="ty-page">
        <div class="ty-detail-cover">
            <span class="thumb"
                  style="background-image:url(<?php echo ($product['pic_url']); ?>); background-size:100% 8.5rem;"></span>
                  <!-- <img src="/Public/images/1494476489.jpg" alt="" class="thumb" style="width: 100%; height: auto;"> -->
                <span class="desc-top">
                    <span data-icon="Ć" class="loc" ><a style="color:gray;" href="/index.php/Map/GPS?pro_id=<?php echo ($product['id']); ?>"><?php echo ($organization['city']); echo ($organization['area']); echo ($organization['address']); ?></a></span>
                </span>
            <div class="desc row">
                <!--   <h3 class="title"><span id="detail_activity_title">独家重磅！7天6晚厦门研学夏令营（共四期），6.18前报名低至¥4088/人！</span></h3> -->
                <!-- 注下：如果有多个出发日期，则先进入#detail_calendar，如果仅有一个出发日期，则点后直接跳到订单页#detail_order -->

                <!--                      <div class="count">
                 <span class="icon-sale">618促销</span>
                 <span class="price">4588</span>
                 <span class="price-off">4088</span>
                 </div> -->
                <span class="bargain" id="bargain" attr_bargain="<?php echo ($isBargain); ?>" attr_key="" style="display: none;" onclick="getBargainId(<?php echo ($product['id']); ?>)">我要砍价
                <img src='../../../../Public/images/axe1.png'>
                </span>
                <span class="status" id="now-price">现价: 元</span>
                <div class="tags">
                    <?php if(is_array($tags)): foreach($tags as $k=>$val): if($k == 0): ?><span class="tag red"><?php echo ($val); ?></span>
                            <?php elseif($k == 1): ?>
                            <span class="tag green"><?php echo ($val); ?></span>
                            <?php else: ?>
                            <span class="tag blue"><?php echo ($val); ?></span><?php endif; endforeach; endif; ?>
                    <label class="size red" id="original-price"></label>
                </div>
            </div>
            <div class="introduce">
                <span><nobr><?php echo ($product['f_title']); ?></nobr></span>
            </div>
            <div class="border item curriculum">
                <img src="/Public/images/chose.png" style="width:1.5rem;height:1.5rem;">
                <label>选择规格</label>
                <span style="float: right">库存(<div id="count" style="display: inline;">0</div>)</span>
            </div>
            <div class="class-normal">
                <div style="margin:1rem auto;">
                    <?php if(is_array($product["price"])): foreach($product["price"] as $k=>$val): if($val['count'] < 1): ?><a href="javascript:void(0);" class="class-normal-child" attr_count="<?php echo ($val['count']); ?>" style="border:1px dashed;color:#aaa;" id="normal-<?php echo ($k); ?>"><?php echo ($val['class_normal']); ?></a>
                            <?php else: ?>
                            <a href="javascript:changeNormal(<?php echo ($k); ?>);" class="class-normal-child" attr_count="<?php echo ($val['count']); ?>" id="normal-<?php echo ($k); ?>"><?php echo ($val['class_normal']); ?></a><?php endif; endforeach; endif; ?>
                </div>
            </div>
            <!--    <span class="share-invite">邀请好友</span> -->
            <input type="hidden" id="type" value="<?php echo ($type); ?>">
            <input type="hidden" name="class-key">
            <div class="border item curriculum" style="display: none;" data-icon="ř" onclick="getClassTable(<?php echo ($product['id']); ?>)">
                <label>预约试听课</label>
                <span class="tip" data-icon-after="Ĩ"></span>
            </div>
            <div class="border item company" style="display: none;" data-icon="ƃ"
                 onclick="organ(<?php echo ($organization['id']); ?>)">
                <label>教学单位</label>
                <span class="tip" data-icon-after="Ĩ"></span>
            </div>
            <a href="<?php echo U('Shop/toShopHome');?>">
                <div class="mechanism">
                    <img src="<?php echo ($organization['picture']); ?>">
                    <span><?php echo ($organization['org_name']); ?></span>
                    <div class="score" id="descs" style="line-height: 1.3rem;">
                        <span>机构评级</span>
                 <span class="star" data-ty-talent-star="5">
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    </span>
                        <span>环境评级</span>
                 <span class="star" data-ty-talent-star="5">
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    </span>
                        <span>教学质量</span>
                 <span class="star" data-ty-talent-star="5">
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    <i class="on iconfont">Ŧ</i>
                    </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="act-tag fixed">
            <a href="javascript:;" id="desc" class="tag detail on">详情</a>
            <a href="javascript:;" id="costc" class="tag price">费用说明</a>
            <a href="javascript:;" id="comment" class="tag qa">咨询&amp;评价</a>
        </div>
        <div class="ty-detail-content">
            <div class="article-title" id="kcxq">
                <?php if($product['type'] == 1): ?><span class="title">课程详情</span>
                    <?php else: ?>
                    <span class="title">商品详情</span><?php endif; ?>

                <img src="/Public/images/xianqin.png" height="72" class="kcxq">
            </div>
            <div class="article top">
                <div class="text"><?php echo ($product['desc']); ?>
                    <div id="costs" style="height: 95px;"></div>
                </div>
            </div>
            <div class="article-title"><span data-icon="Ĺ" class="title">费用说明</span><img
                    src="/Public/images/xianqin.png" height="72" class="kcxq"></div>
            <div class="article">
                <div class="text"><?php echo ($product['cost']); ?></div>
            </div>

            <div class="fav-list">
                <?php if(is_array($headImg)): $i = 0; $__LIST__ = array_slice($headImg,0,12,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><span class="avatar">
                       <img src="<?php echo ($val['headImg']); ?>">
                    </span><?php endforeach; endif; else: echo "" ;endif; ?>
                <span class="sum">本次活动共有<?php echo ($userCount); ?>人已下单</span>
            </div>
            <a data-icon="Ė" id="comments" class="btn-continue"
                   href="javascript:checkOrderInfo()">赶紧下单</a>
            <!--<a class="btn-share" href="javascript:void(0);">邀请好友一起玩</a>-->
            <div class="article-title article-title2"><span data-icon="ŕ" class="title">咨询&amp;评价</span><img
                    src="/Public/images/xianqin.png" height="72" class="kcxq"></div>
            <div class="article">
                <?php if(!empty($isCollect)): ?><a class="isCollect" data-icon="ą"
                       href="javascript:collect(<?php echo ($product["id"]); ?>,<?php echo ($product['type'] == 1?2:3); ?>)">收藏</a>
                    <?php else: ?>
                    <a class="follow" data-icon="ą"
                       href="javascript:collect(<?php echo ($product["id"]); ?>,<?php echo ($product['type'] == 1?2:3); ?>)">收藏</a><?php endif; ?>
                <button type="button" class="btn-comment" data-icon="Ę">说点什么..</button>
                <ul class="list-comment">
                    <?php if(is_array($productComment)): $k = 0; $__LIST__ = array_slice($productComment,0,15,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k;?><li class="item">
                            <div class="user-comment" onclick="getFather(<?php echo ($val['id']); ?>)">
                                <img src="<?php echo ($val['headImg']); ?>" alt="">
                                <span class="text"><?php echo ($val['content']); ?></span>
                            </div>
                            <div class="replys">
                                <?php if(is_array($val['child'])): $i = 0; $__LIST__ = $val['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><div class="reply" onclick='getFatherId("<?php echo ($va['id']); ?>","<?php echo ($val['id']); ?>")'>
                                    <div class="image"><img src="<?php echo ($va['headImg']); ?>">回复：
                                        <img src="<?php echo ($va['headImgs']); ?>"></div>
                                    <span class="text"><?php echo ($va['content']); ?></span>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <!-- 20160218 upadte -->
        <!-- 20160218 upadte end-->
        <span class="ty-reload" onclick="window.location.reload();" data-icon="ɇ">刷新本页面</span>
    </div>
</div>

</div>
<div class="kap-bottom ty-menu-bottom">
    <div id="tools_detail_activity" class="ty-tools ty-tools-order ty-tools-current">
        <div class="ty-tools-detail-btns">
            <a href="https://youpei.qiyukf.com/client?k=f5f0062b7b20b199e7ee5deeeb7a6fd3&wp=1&sid=113910&robotShuntSwitch=0"
               data-icon="Ē" class="btn btn-detail consult">咨询</a>
            <a href="tel:<?php echo ($organization['tel']); ?>" data-icon="Ł" class="btn-detail phone">电话</a>
            <a href="javascript:void(0);" data-ty-target="#page_talent" data-ty-talentid="" data-icon="ń"
               class="btn-detail shop more">推荐</a>
            <a href="javascript:checkOrderInfo()" class="btn-order" style="background-color:#ADADAD;">
                <?php echo ($product['type'] == 1?'我要报班':'我要下单'); ?>
            </a>
            <!--<span data-icon="&#x111;" class="btn-detail-navi"></span>-->
        </div>
    </div>
</div>
<div class="morePeople" style="display: none;">
     <span><img src="../../../../Public/images/guide1.png"/></span>
</div>
<div data-kap="kap-bottomwin" class="kap-bottomwin" style="display:none;">
    <div class="kap-hitarea"></div>
    <div class="kap-win"
         style="transform: translateY(0px); transition: -webkit-transform 0.2s cubic-bezier(0, 0, 0.25, 1);">
        <div class="kap-content">
            <div class="ty-popbottom">
                <div class="title">
                    发表评论
                    <span class="ask-kf">
                        <span><span class="btn-close" data-icon="ă"></span></span>
                    </span>
                </div>
                <div class="content" style="height: 5.625rem;">
                    <div class="ty-comment-pop">
                        <input type="hidden" name="product_id" value="<?php echo ($product['id']); ?>">
                        <textarea class="input-textarea btn-comment" id="product_contact_memo"
                                  placeholder="说点什么.."></textarea>
                    </div>
                </div>
                <div class="btn-submit" id="addProduct">确定</div>
            </div>
        </div>
    </div>
</div>
<div data-kap="_kap_mask" class="kap-mask kap-mask-on" style="display:none;"></div>

<div class="kap-comment" style="display:none;">
    <div class="kap-hitarea"></div>
    <div class="kap-win"
         style="transform: translateY(0px); transition: -webkit-transform 0.2s cubic-bezier(0, 0, 0.25, 1);">
        <div class="kap-content">
            <div class="ty-popbottom">
                <div class="title">
                    发表评论
                    <span class="ask-kf">
                        <span><span class="btn-close" data-icon="ă"></span></span>
                    </span>
                </div>
                <div class="content" style="height: 5.625rem;">
                    <div class="ty-comment-pop">
                        <textarea class="input-textarea " id="product_contact_meto"
                                  placeholder="说点什么.."></textarea>
                    </div>
                </div>
                <div class="btn-submit" id="addComment" attr_father_id="" attr_type_id="">确定</div>
            </div>
        </div>
    </div>
</div>
<div data-kap="_kap_mask" class="kap-mask  kap-background" style="display:none;"></div>
<!--<input type="hidden" name="product_id" value="<?php echo ($product['id']); ?>">-->
<!--<textarea name="" id="product_contact_memo" class="btn-comment" placeholder="说点什么.."></textarea>-->
<!--<a href="javascript:void(0)" class="comment" id="addProduct">发表评论</a>-->
<script src="https://qiyukf.com/script/044865c94981c048609d5c94c1ae9c6d.js" charset="UTF-8"></script>
<script>
$(function(){
     $(".more").click(function(){
        $(".morePeople").show()
    })
    $(".morePeople").click(function(){
        $(".morePeople").hide()
    })
})
    $(".act-tag span").on('touchstart mousedown', function (e) {
        e.preventDefault()
        $(".act-tag span").removeClass('on')
        $(this).addClass('on')
        $(".ty-detail-content .tabcon").eq($(this).index()).addClass("curr").siblings().removeClass("curr");
    });
    $(".act-tag span").click(function (e) {
        e.preventDefault();

    });
    $(function () {
        $('.act-tag span').on('touchstart mousedown', function () {
            $('html,body').animate({scrollTop: $('.act-tag').offset().top - 60}, 500);
        });
        $(".act-tag").removeClass("fixed");
        var firstKey = "<?php echo ($firstKey); ?>";
        changeNormal(firstKey);
    });
    $(window).scroll(function () {
        var bar_h = $(".act-tag").height();
        var _top = $(window).scrollTop();
        var tag_top = $("#detail_activity .ty-detail-cover").offset().top + $("#detail_activity .ty-detail-cover").height();
        if (tag_top - _top < bar_h) {
            $(".act-tag").addClass("fixed");
            if ($(".kap-top").hasClass("ty-menu-top-hide")) {
                $(".act-tag").addClass("top");
            } else {
                $(".act-tag").removeClass("top");
            }
        } else {
            $(".act-tag").removeClass("fixed");
        }

    });
    $('#addProduct').click(function () {
        if ($('#product_contact_memo').val() == '') {
            alert('请填写订单评价');
            return;
        }
        if ($('#product_contact_memo').val().length <= 6) {
            alert('请填写不少于6个字');
            return;
        }

        var product_id = $("input[name='product_id']").val();
        var data = {
            product_id: product_id,
            content: $('#product_contact_memo').val()
        };
        $.ajax({
            type: 'post',
            url: "<?php echo U('Product/productDetails');?>",
            data: data,
            dataType: 'json',
            success: function (res) {
                if (res.status == 0) {
                    $("#product_contact_memo").val('');
                    return alert(res.msg);
                } else if (res.status == 1) {
                    alert(res.msg);
                    $('.kap-bottomwin').css('display', 'none');
                    $('.kap-mask-on').css('display', 'none');
                    $("#product_contact_memo").val('');
                    $('.list-comment').prepend(
                            "<li class='item assign'>" +
                            "<div class='user-comment' onclick='getFather(" + res.data['id'] + ")'>" +
                            "<img src='" + res.data['headImg'] + "' alt=''><span class='text'>" + res.data['content'] + "</span>" +
                            "</div>" +
                            "<div class='replys'></div>" +
                            "</li>"
                    );
                }
            }
        })
    })
    $('.item').click(function () {
        $(this).addClass('assign');
        $(this).siblings('.item').removeClass('assign')
    });

    function getFather(id) {
        $('.kap-background').css('display', 'block');
        $('.kap-comment').css('display', 'block');
        $('.btn-close').click(function () {
            $('.kap-background').css('display', 'none');
            $('.kap-comment').css('display', 'none');
            $("#product_contact_meto").val('');
        });
        $('#addComment').attr('attr_father_id', id);
    }

    function getFatherId(id, type_id) {
        $('.kap-background').css('display', 'block');
        $('.kap-comment').css('display', 'block');
        $('.btn-close').click(function () {
            $('.kap-background').css('display', 'none');
            $('.kap-comment').css('display', 'none');
            $("#product_contact_meto").val('');
        });
        $('#addComment').attr('attr_father_id', id);
        $('#addComment').attr('attr_type_id', type_id);

    }

    $('#addComment').click(function () {
        if ($('#product_contact_meto').val() == '' && $('#product_contact_meto').val() > 0) {
            alert('内容不能为空');
            return;
        }
        if ($('#product_contact_meto').val().length <= 6) {
            alert('请填写不少于6个字');
            return;
        }
        if ($('#addComment').attr('attr_father_id') != '' && $('#addComment').attr('attr_type_id') == '') {
            var url = "<?php echo U('Product/comment');?>";
            var product_id = $("input[name='product_id']").val();
            var father_id = $('#addComment').attr('attr_father_id');
            var type_id = $('#addComment').attr('attr_father_id');
            var data = {
                product_id: product_id,
                father_id: father_id,
                type_id: type_id,
                content: $('#product_contact_meto').val()
            };
            $('.kap-background').css('display', 'none');
            $('.kap-comment').css('display', 'none');
            $("#product_contact_meto").val('');
            $.post(url, data, function (res) {
                if (res.status == 0) {
                    alert(res.msg);
                } else if (res.status == 1) {
                    alert(res.msg);
                    $('.assign .replys').append(
                            "<div class='reply' onclick='getFatherId(" + res.data['id'] + "," + res.data['type_id'] + ")'>" +
                            "<div class='image'><img src='" + res.data['headImg'] + "' alt=''>回复：<img src='" + res.data['headImgs'] + "' alt=''></div><span class='text'>" + res.data['content'] + "</span>" +
                            "</div>"
                    );
                }
            }, 'json');
        } else if ($('#addComment').attr('attr_father_id') != '' && $('#addComment').attr('attr_type_id') != '') {
            var url = "<?php echo U('Product/comment');?>";
            var product_id = $("input[name='product_id']").val();
            var father_id = $('#addComment').attr('attr_father_id');
            var type_id = $('#addComment').attr('attr_type_id');
            var data = {};
            data.product_id = product_id;
            data.father_id = father_id;
            data.type_id = type_id;
            data.content = $('#product_contact_meto').val();
            $('.kap-background').css('display', 'none');
            $('.kap-comment').css('display', 'none');
            $("#product_contact_meto").val('');
            $.post(url, data, function (res) {
                if (res.status == 0) {
                    alert(res.msg);
                } else if (res.status == 1) {
                    alert(res.msg);
                    $('.assign .replys').append(
                            "<div class='reply' onclick='getFatherId(" + res.data['id'] + "," + res.data['type_id'] + ")'>" +
                            "<div class='image'><img src='" + res.data['headImg'] + "' alt=''>回复：<img src='" + res.data['headImgs'] + "' alt=''></div><span class='text'>" + res.data['content'] + "</span>" +
                            "</div>"
                    );
                }
            }, 'json');
        }
    });

    function changeNormal(key) {
        var pro_id = getQueryString('pro_id');
        var url = "/index.php/Product/getNormalPrice";
        $("#normal-"+key).addClass("class-normal-on").siblings().removeClass("class-normal-on");
        $('input[name="class-key"]').val(key);
        $('#bargain').attr('attr_key',key);
        $.get(url, {pro_id: pro_id, key: key}, function (result) {
            if(result.status == 0){
                return alert(result.message);
            } else {
                $('#original-price').text("原价：" + result.data.normal.original_price);
                $('#now-price').text("现价：" + result.data.normal.now_price);
                if(result.data.isBargain != null){
                    $('#bargain').show();
                } else {
                    $('#bargain').hide();
                }
            }
        }, 'json')
    }

    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }

    //砍价
    function getBargainId(id) {
        var key = $("#bargain").attr('attr_key');
        window.location.href = "/index.php/Product/bargain?pro_id=" + id+"&key="+ key;
    }

    setTimeout(function () {
        var count = $('.class-normal-on').attr('attr_count');
        $('#count').text(count);
        if(!count || count == 0){
            $('.btn-order').css('background','#ADADAD');
        }else{
            $('.btn-order').css('background','#386998');
        }
    },500);
    $('.class-normal-child').click(function () {
        setTimeout(function () {
        var count = $('.class-normal-on').attr('attr_count');
            $('#count').text(count);
        if(count > 0){
            $('.btn-order').css('background','#386998');
        }
        },500);
    });
    function checkOrderInfo() {
        setTimeout(function () {
            var count = $('.class-normal-on').attr('attr_count');
            if(!count || count == 0){
                alert('暂时无货');
                return;
            }else{
                var key = $('input[name="class-key"]').val();
                var pro_id = getQueryString('pro_id');
                window.location.href = "/index.php/Product/checkOrderInformation?key="+key+"&pro_id="+pro_id;
            }
        },500);
    }
</script>
<!-- 设置分享信息 -->
<script type="text/javascript">
    //留言弹框
    $(function () {
        $('.btn-comment').click(function () {
            $('.kap-bottomwin').css('display', 'block');
            $('.kap-mask-on').css('display', 'block');
        });
        $('.btn-close').click(function () {
            $('.kap-bottomwin').css('display', 'none');
            $('.kap-mask-on').css('display', 'none');
        });
    });
    //页内跳转
    $(document).ready(function () {
        $("#desc").click(function () {
            $('html, body').animate({
                scrollTop: $("#descs").offset().top
            }, 1000);
        });
        $("#costc").click(function () {
            $('html, body').animate({
                scrollTop: $("#costs").offset().top
            }, 1000);
        });
        $("#comment").click(function () {
            $('html, body').animate({
                scrollTop: $("#comments").offset().top
            }, 500);
        });
    });

    //收藏
    function collect(id, type) {
        $.ajax({
            url: "<?php echo U('collect');?>?id=" + id + "&type=" + type,
            dataType: 'json',
            success: function (res) {
                if (res.status == 1) {
                    $('.follow').removeClass().addClass('isCollect');
                } else if (res.status == 2) {
                    $('.isCollect').removeClass().addClass('follow');
                }
            }
        })
    }

    //    机构
    function organ(id) {
        window.location.href = "<?php echo U('Organization/home');?>?id=" + id;
    }

    //预约试听课
    function getClassTable(id) {
        window.location.href = "<?php echo U('Product/getClassTable');?>?pro_id=" + id;
    }

    //砍价
    function getBargain() {
        var key = $('input[name="class-key"]').val();
        var pro_id = getQueryString('pro_id');
        window.location.href = "/index.php/Product/bargain?key="+key+"&pro_id="+pro_id;
    }

    var isBargain = $('#bargain').attr('attr_bargain');
    if (isBargain == 2) {
        $('#bargain').css('display', 'block');
    }


</script>
<script src="/Public/Home/js/jquery.min.js"></script>
<?php if($umark == "productDetails"): ?><div id="side_article" class="ty-sidebar-area ty-tools ty-tools-current">
        <div class="section">
            <span class="qrcode"><img src="/Public/images/618348288222690487.jpg" alt="" height="166" width="166"><b
                    class="tip">微信扫一扫</b></span>
            <p>关注“<b>优培圈</b>”微信公众号， “<b class="wx-code">立即购买</b></p>
            <span class="btn phone" data-icon="Ĉ">客服电话<b>1569357635</b></span>
        </div>
        <p class="copyright">
            Copyright &copy;2017 youpei<br>
            <a href="#" target="_blank">粤ICP备17008351号</a>
        </p>
    </div><?php endif; ?>


<!-- 20160621 updated -->
<script language="javascript">
    function getUrlArg(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null)return unescape(r[2]);
        return null;
    }
    function is_weixn() {
        var ua = navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == "micromessenger") {
            return true;
        } else {
            return false;
        }
    }
    function setCookie(name, value) {
        var Days = 30;
        var exp = new Date();
        exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
    }

    function delCookie(c_name, value) {
        var date = new Date();
        //将date设置为过去的时间
        date.setTime(date.getTime() - 10000);
        //将userId这个cookie删除
        document.cookie = c_name + "=" + escape(value) + " ; expires=" + date.toGMTString();
    }

    function getCookie(name) {
        var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
        if (arr != null) return unescape(arr[2]);
        return null;
    }
    var timestamp = (new Date()).valueOf();
    var hash = location.hash;
    var source = getUrlArg("source");
</script>
<script src="/Public/Home/js/jweixin-1.0.0.js"></script>
<script src="/Public/Home/js/jquery.ba-hashchange.min.js"></script>
<script src="/Public/Home/js/jquery.exif.min.js"></script>
<script type="text/vbscript">
Function IEBinary_getByteAt(strBinary, iOffset)
    IEBinary_getByteAt = AscB(MidB(strBinary,iOffset+1,1))
End Function
Function IEBinary_getLength(strBinary)
    IEBinary_getLength = LenB(strBinary)
End Function
</script>
<script src="/Public/Home/js/kap.js?v6.6"></script>
<script src="/Public/Home/js/common.js?v6.6"></script>
<script src="/Public/Home/js/c.js?v6.6"></script>
<script src="/Public/Home/layer/layer.js"></script>
<script language="javascript">
    function handleOpenURL(url) {
        setTimeout(function () {
            var link = "";
            if (link.indexOf("http://www.youpei-exc.com") == 0) window.location.href = link;
        }, 0);
    }
</script>
<!--<script src="/Public/Home/js/selectivizr.js?v1.3"></script>-->
<!--加载 -->
<script src="/Public/Home/js/pageloader.js"></script>
<script>
    jQuery(window).resize(function () {
        resizenow();
    });
    function resizenow() {
        var browserwidth = jQuery(window).width();
        var browserheight = jQuery(window).height();
        jQuery('.bonfire-pageloader-icon').css('right', ((browserwidth - jQuery(".bonfire-pageloader-icon").width()) / 2)).css('top', ((browserheight - jQuery(".bonfire-pageloader-icon").height()) / 2));
    };
    resizenow();
</script>
<script>
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: "<?php echo ($signPackage['appId']); ?>", // 必填，公众号的唯一标识
        timestamp: "<?php echo ($signPackage['timestamp']); ?>", // 必填，生成签名的时间戳
        nonceStr: "<?php echo ($signPackage['nonceStr']); ?>", // 必填，生成签名的随机串
        signature: "<?php echo ($signPackage['signature']); ?>",// 必填，签名，见附录1
        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'hideOptionMenu', 'showOptionMenu', 'hideMenuItems', 'showMenuItems', 'hideAllNonBaseMenuItem', 'showAllNonBaseMenuItem', 'closeWindow', 'chooseImage', 'uploadImage', 'getLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    wx.ready(function () {
        wx.onMenuShareAppMessage({
            title: "<?php echo ($shareData['share_title']); ?>",
            desc: "<?php echo ($shareData['share_desc']); ?>",
            link: "<?php echo ($shareData['share_url']); ?>",
            imgUrl: "<?php echo ($shareData['share_img']); ?>",
            success: function () {
                alert('分享成功');
            },
            cancel: function () {
                alert('已取消');
            }
        });
        wx.onMenuShareTimeline({
            title: "<?php echo ($shareData['share_title']); ?>",
            link: "<?php echo ($shareData['share_url']); ?>",
            imgUrl: "<?php echo ($shareData['share_img']); ?>",
            success: function () {
                alert('分享成功');// 用户确认分享后执行的回调函数
            },
            cancel: function () {
                alert('已取消');// 用户取消分享后执行的回调函数
            }
        });
        wx.error(function (res) {
//            alert(JSON.stringify(res));
        });
    });
</script>
</div>

<script>
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: "<?php echo ($signPackage['appId']); ?>", // 必填，公众号的唯一标识
        timestamp: "<?php echo ($signPackage['timestamp']); ?>", // 必填，生成签名的时间戳
        nonceStr: "<?php echo ($signPackage['nonceStr']); ?>", // 必填，生成签名的随机串
        signature: "<?php echo ($signPackage['signature']); ?>",// 必填，签名，见附录1
        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'hideOptionMenu', 'showOptionMenu', 'hideMenuItems', 'showMenuItems', 'hideAllNonBaseMenuItem', 'showAllNonBaseMenuItem', 'closeWindow', 'chooseImage', 'uploadImage', 'getLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    wx.ready(function () {
        wx.onMenuShareAppMessage({
            title: "<?php echo ($product['title']); ?>",
            desc: "<?php echo ($product['f_title']); ?>",
            link: "<?php echo ($share_url); ?>",
            imgUrl: "<?php echo ($share_img); ?>",
            success: function () {
                share_record();
            },
            cancel: function () {
                alert('已取消');
            }
        });
        wx.onMenuShareTimeline({
            title: "<?php echo ($product['title']); ?>",
            link: "<?php echo ($share_url); ?>",
            imgUrl: "<?php echo ($share_img); ?>",
            success: function () {
                share_record();// 用户确认分享后执行的回调函数
            },
            cancel: function () {
                alert('已取消');// 用户取消分享后执行的回调函数
            }
        });
        function share_record() {
            var pro_id = "<?php echo ($product['id']); ?>";
            var url = "<?php echo U('Product/shareRecord');?>";
            $.post(url, {pro_id: pro_id}, function (result) {
                alert(result.message);
            }, 'json');
        }
    });

    if ($('#type').val() == 1) {
        $('.company').css('display', 'block');
        $('.curriculum').css('display', 'block');
    }
    var b = null;
    function a() {
        b = setTimeout(function () {
            $(".bargain").animate({"bottom": "2.2rem"}, 200, function () {
                $(".bargain").animate({"bottom": "2rem"}, 200)
            })
            a()
        }, 200)
//              clearTimeout(b)
    }
    a()
</script>
</body>
</html>