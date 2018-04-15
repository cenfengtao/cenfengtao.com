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
<link href="/Public/css/home/style4.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="/Public/css/home/getArticle.css">
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
        <a href="/index.php/index/index.html" class="article_banner"  style="z-index: 11;"></a>
    </div>
    <div id="test" class="banner" style="position: fixed;top:0;width:100%;z-index: 10;"><a href="/index.php/index/index.html" class="article_banner" style="width:100%"></a></div>
    <div class="main plpr0" style="padding: 10px;">
        <section class="scroll">
            <input type="hidden" name="article_id" id="article_id" value="<?php echo ($article["id"]); ?>">
            <h1 style="font-size:20px;"><?php echo ((isset($article['title']) && ($article['title'] !== ""))?($article['title']):"优培圈"); ?></h1>
            <time><?php echo (date("Y-m-d",$article["create_time"])); ?> <span><?php echo ((isset($article['author']) && ($article['author'] !== ""))?($article['author']):""); ?></span></time>
            <div class="content">
                <div class="info" style="font-size:14px;" id="content-wrapper">
                    <?php echo ($article["content"]); ?>
                </div>
                <?php if($article['show_liability'] == 1): ?><div id="test1">《<font color="#F00"><u>请点击了解免责声明</u></font>》</div><?php endif; ?>
            </div>
            <div class="see-count">阅读&nbsp;&nbsp;<?php echo ((isset($article["read_count"]) && ($article["read_count"] !== ""))?($article["read_count"]):"0"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                    href="javascript:finger(<?php echo ($article["id"]); ?>,'2')">
                <?php if($article['isFinger'] > 0): ?><img src="/Public/images/finger-1.jpg" id="z-<?php echo ($article['id']); ?>"/>
                    <?php else: ?>
                    <img src="/Public/images/finger-2.jpg" id="z-<?php echo ($article['id']); ?>"/><?php endif; ?>
                &nbsp;<span id="finger-<?php echo ($article["id"]); ?>"><?php echo ($article["fingerCount"]); ?></span></a>
                <?php if(!empty($isCollect)): ?><a class="isCollect" data-icon="ą" href="javascript:collect(<?php echo ($article["id"]); ?>,'5')">收藏</a>
                    <?php else: ?>
                    <a class="follow" data-icon="ą" href="javascript:collect(<?php echo ($article["id"]); ?>,'5')">收藏</a><?php endif; ?>
            </div>
        </section>
        <div id="msgBox">
            <button type="button" class="btn-comment" data-icon="Ę">说点什么..</button>
            <div class="lists">
                <h3><span>最新评论</span></h3>
                <ul id="lists-msg">
                    <?php if(empty($comments)): ?><li id="empty">还没有人发表</li>
                        <?php else: ?>
                        <?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; if(!empty($val['user_id'])): ?><li class="items" >
                                    <div class="first" onclick='getFather("<?php echo ($val['id']); ?>")'>
                                        <div class="userPic"><img src="<?php echo ($val['headimgurl']); ?>"/></div>
                                        <div class="content" style="text-align: left;">
                                            <div class="userName"><a href="javascript:;"><?php echo ($val['username']); ?></a>:</div>
                                            <div class="msgInfo"><?php echo ($val['content']); ?></div>
                                            <div class="times">
                                                <span><?php echo (date("m-d H:i",$val['create_time'])); ?></span>
                                            </div>
                                        </div>
                                        <div class="finger">
                                            <a href="javascript:finger('<?php echo ($val["id"]); ?>','1')">
                                                <?php if($val['is_finger'] > 0): ?><img src="/Public/images/finger-1.jpg" id="z-<?php echo ($val["id"]); ?>"/>
                                                    <?php else: ?>
                                                    <img src="/Public/images/finger-2.jpg" id="z-<?php echo ($val["id"]); ?>"/><?php endif; ?>
                                                &nbsp;<span id="finger-<?php echo ($val["id"]); ?>"><?php echo ($val["finger_count"]); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>

                                    <div class="replys">
                                        <?php if(is_array($val['child'])): $i = 0; $__LIST__ = $val['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><div class="reply" onclick='getFatherId(<?php echo ($va['id']); ?>,<?php echo ($val['id']); ?>)'>

                                            <div class="image"><img src="<?php echo ($va['headImg']); ?>" alt=""><span>回复：</span><img src="<?php echo ($va['headImgs']); ?>" alt=""></div>

                                            <span class="text"><?php echo ($va['content']); ?></span>
                                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>

                                </li><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                </ul>

            </div>

        </div>
    </div>
    <div class="footer_coopyright">
        本活动最终解释权归优培圈所有
    </div>
</div>
<div data-kap="kap-bottomwin" class="kap-bottomwin" style="display:none;">
    <div class="kap-hitarea"></div>
    <div class="kap-win" style="transform: translateY(0px); transition: -webkit-transform 0.2s cubic-bezier(0, 0, 0.25, 1);">
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
                        <input type="hidden" name="par_id" value="<?php echo ($product['id']); ?>">
                        <textarea class="input-textarea btn-comment" id="product_contact_memo" placeholder="评论不少于3个字哦！"></textarea>
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
                                  placeholder="评论不少于3个字哦！"></textarea>
                    </div>
                </div>
                <div class="btn-submit" id="addComment" attr_father_id="" attr_type_id="">确定</div>
            </div>
        </div>
    </div>
</div>
<div data-kap="_kap_mask" class="kap-mask  kap-background" style="display:none;"></div>
<input type="hidden" id="attentionStatus" value="<?php echo ($attentionStatus); ?>">
<div class="tellBox" style="display: none;">
    <div class="tellContent">
        <img src="../../../../Public/images/close.png" alt="" class="closeBtn">
        <h3>温馨提示</h3>
        <div>
          <p>欢迎来到优培圈,您还没有关注我们哦!</p>
        </div>
        <a href="javascript:void(0);">关注「优培圈」才能方便您以后查看更多精彩的内容！</a>
        <img src="../../../../Public/images/ypq_qrcode.jpg" alt="" class="code">
    </div>
</div>
<script type="text/javascript" src="/Public/js/home/dialog_1-0.js"></script>
<script type="text/javascript" src="/Public/Home/js/jweixin-1.0.0.js"></script>
<script src="/Public/js/home/zepto.min.js"></script>
<script src="/Public/vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/Public/js/layer/layer.js"></script>
<script src="/Public/js/sea.js"></script>
<script src="/Public/js/home/getArticle.js" type="text/javascript" charset="utf-8"></script>
<script>
    var attentionStatus=$("#attentionStatus").val();
    console.log(attentionStatus)
    if(attentionStatus==2){
        $(".tellBox").show();
    }
    $(".closeBtn").click(function(){
        $(".tellBox").hide();
    })
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

    // 调用微信分享接口
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
            var url = "/index.php/Article/shareRecord";
            $.post(url, {art_id: art_id}, function (result) {
                alert(result.message);
            }, 'json');
        }
    });
</script>
</body>
</html>