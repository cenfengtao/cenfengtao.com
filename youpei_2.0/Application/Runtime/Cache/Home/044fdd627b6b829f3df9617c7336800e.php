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
    <script type="text/javascript" src="/Public/js/home/dialog_1-0.js"></script>
    <script type="text/javascript" src="/Public/Home/js/jweixin-1.0.0.js"></script>
    <link rel="stylesheet" href="/Public/Home/css/comment.css">
    <link rel="stylesheet" href="/Public/Home/css/common.css">
    <!--移动端兼容适配 end -->
</head>
<body>
<div class="container">
    <!--&lt;!&ndash;图片类型验证方法1&ndash;&gt;-->
    <input type="button" id="btn1" value="选择上传文件" onclick="showFiles();" />
    <!--<h4>选择文件如下:</h4>-->
    <img src="" id="img1" />
    <img src="" id="imgTarget">
</div>

</body>
<script src="/Public/vendors/jquery/dist/jquery.min.js"></script>
<script src="/Public/js/sea.js"></script>
<script>
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
</script>


<!--<script type="text/javascript">-->
    <!--wx.config(<?php echo --> <!--debug: false, <!--appId: "{$signPackage['appId'];?>", // 必填，公众号的唯一标识-->
        <!--timestamp: "<?php echo ($signPackage['timestamp']); ?>", // 必填，生成签名的时间戳-->
        <!--nonceStr: "<?php echo ($signPackage['nonceStr']); ?>", // 必填，生成签名的随机串-->
        <!--signature: "<?php echo ($signPackage['signature']); ?>",// 必填，签名，见附录1-->
        <!--jsApiList: ["chooseImage", "previewImage", "uploadImage", "downloadImage"] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2-->
    <!--});-->
    <!--wx.ready(function () <?php echo --> <!--wx.error(function (res) {--> <!-- <!--;?>);-->
    <!--});-->
    var images = {
        localId: [],
        serverId: []
    };
    <!--// 拍照或者选择照片-->
    function showFiles() {
        wx.chooseImage({
            count: 1, // 默认9，这里每次只处理一张照片
            sizeType: ['original', 'compressed'],   // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'],        // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localId = res.localIds[0];
                <!--//选择图片成功，上传到微信服务器-->
                wx.uploadImage({
                    localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
                    isShowProgressTips: 1, // 默认为1，显示进度提示
                    success: function (res) {
                        var serverId = res.serverId; // 返回图片的服务器端ID
                        $('#serverId').text(serverId);
                        wx.downloadImage({
                            serverId: serverId, // 需要下载的图片的服务器端ID，由uploadImage接口获得
                            isShowProgressTips: 1, // 默认为1，显示进度提示
                            success: function (res) {
                                var localId = res.localId; // 返回图片下载后的本地ID
                                $('#imgTarget').attr('src',localId);
                            }
                        });
                    }
                });
            }
        });
    }
</script>
</html>