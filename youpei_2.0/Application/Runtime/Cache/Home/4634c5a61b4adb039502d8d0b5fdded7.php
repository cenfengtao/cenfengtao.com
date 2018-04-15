<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ((isset($header_title) && ($header_title !== ""))?($header_title):"优培圈"); ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Mobile Devices Support @begin -->
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes"/> <!-- apple devices fullscreen -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/home/dialog.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/home/main_1-0.css">
    <link rel="stylesheet" href="/Public/Home/css/message.css">
    <link rel="stylesheet" href="/Public/Home/css/comment.css">
    <link rel="stylesheet" href="/Public/Home/css/common.css">
    <link rel="stylesheet" href="/Public/Home/css/kap.css">
    <!--移动端兼容适配 end -->
</head>
<link rel="stylesheet" href="/Public/css/home/introduce.css">
<link href="/Public/css/home/style4.css" rel="stylesheet" type="text/css"/>
<body>
<div class="container">
    <div class="header" style="z-index: 11;" data-action="<?php echo (ACTION_NAME); ?>">
        <a class="block" href="javascript:void(0)" id="header_go_back"
           data-home-url="<?php echo U('Index/index');?>" style="display: none;"></a>
        <h1 style="font-size:20px;">优培圈</h1>
        <a class="block" href="<?php echo U('Index/index');?>" id="header_go_home" style="display: none;"></a>
        <?php if(!empty($interests_url)): ?><a class="icon_menu block" href="<?php echo ($interests_url); ?>"></a><?php endif; ?>
    </div>
    <div class="banner" style="z-index: 11;">
        <a href="/index.php/index/index.html" class="article_banner" style="z-index: 11;"></a>
    </div>
    <div id="test" class="banner" style="position: fixed;top:0;width:100%;z-index: 10;"><a
            href="/index.php/index/index.html" class="article_banner" style="width:100%"></a></div>
    <div class="main plpr0" style="padding: 10px;">
        <section class="scroll">
            <input type="hidden" name="article_id" id="article_id" value="<?php echo ($article["id"]); ?>">
            <h1 style="font-size:20px;">关于优培</h1>
            <div class="content">
                <div class="info" style="font-size:14px;" id="content-wrapper">
                    <?php echo ($introduce['content']); ?>
                </div>
            </div>
        </section>
        </li>
        </notempty>
        </volist>
        </empty>
        </ul>
    </div>
</div>
</div>
</div>
</body>
<script type="text/javascript" src="/Public/js/home/dialog_1-0.js"></script>
<script type="text/javascript" src="/Public/Home/js/jweixin-1.0.0.js"></script>
<script src="/Public/js/home/zepto.min.js"></script>
<script src="/Public/vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/Public/js/layer/layer.js"></script>
<script src="/Public/js/sea.js"></script>
<script src="/Public/js/home/introduce.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
     var assetsVersion = '2.5';
    seajs.config({
        map: [
            [/^(.*\.(?:css|js))(.*)$/i, '$1?v=' + assetsVersion]
        ],
        base: "/Public/js",
        alias: {
            "jquery": "jquery-1.10.2.min.js",
            "zepto": "modules/zepto/zepto",
        }
    });
    seajs.use(["main"], function (main) {
        wrapper = document.getElementById('content-wrapper');
        if (wrapper) {
            main.previewImage(wrapper);
        }
    });

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
            title: "<?php echo ($article[title]); ?>",
            desc: "<?php echo ($article['desc']); ?>",
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
            title: "<?php echo ($article[title]); ?>",
            link: "<?php echo ($share_url); ?>",
            imgUrl: "<?php echo ($share_img); ?>",
            success: function () {
                share_record();// 用户确认分享后执行的回调函数
            },
            cancel: function () {
                alert('已取消');// 用户取消分享后执行的回调函数
            }
        });
        wx.error(function (res) {
//            alert(JSON.stringify(res));
        });
        function share_record() {
            var art_id = "<?php echo ($article['id']); ?>";
            var url = "<?php echo U('Article/shareRecord');?>";
            $.post(url, {art_id: art_id}, function (result) {
                alert(result.message);
            }, 'json');
        }
    });
</script>
</html>