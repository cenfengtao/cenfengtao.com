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
    <link rel="stylesheet" type="text/css" href="/Public/css/home/style_v3.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/home/dialog.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/Public/css/home/main_1-0.css">
    <script type="text/javascript" src="/Public/js/home/dialog_1-0.js"></script>
    <script type="text/javascript" src="/Public/js/home/zepto.min.js"></script>
    <!--移动端兼容适配 end -->
</head>
<body>
<div class="container">
    <div class="header" data-action="<?php echo (ACTION_NAME); ?>">
        <a class="block" href="javascript:void(0)" id="header_go_back" data-home-url="<?php echo U('Index/index');?>"
           style="display: none;"></a>
        <h1 style="font-size:20px;"><?php echo ((isset($page_title) && ($page_title !== ""))?($page_title):"优培圈"); ?></h1>
        <a class="block" href="<?php echo U('Index/index');?>" id="header_go_home" style="display: none;"></a>
    </div>
    <div class="main">
        <div class="ad_img_v4 center mtb8 ptb3 bdr10" style="box-shadow: 0 5px 8px #dadada;">
            <p class="myfriend-v4">我的学友团</p>
        </div>
        <section class="user-info-v4">
            <ul class="user_list fz18">
<!--                 <li class="clr gray-bg_v4 bdr10 ptb3" style="background: #97c2e0;">
                    <label>总人数</label>
                    <div class="user-total-coupons bdr10 fz18"><?php echo ((isset($count) && ($count !== ""))?($count):"0"); ?>人</div>
                </li>

                    <li class="clr gray-bg_v4 bdr10 ptb3">
                        <label class="username">你的上级</label>
                        <div class="user-total-coupons bdr10 fz18"><?php echo ($up_user['username']); ?></div>
                    </li> -->

            </ul>
        </section>
    </div>
    <section class="manage-v4 w92 friend-v4">
        <table id="tableList">
            <thead>
            <tr>
                <th data-sort="1" class="gray-bg_v4 bdr10 bg568 fz18">我的学生</th>
                <th data-sort="1" class="gray-bg_v4 bdr10 bg798 fz18">加入时间</th>
                <th data-sort="1" class="gray-bg_v4 bdr10 bg96a fz18">他的学生</th>
            </tr>
            </thead>
            <tbody>
            
            <!-- <?php if(is_array($children)): $i = 0; $__LIST__ = $children;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr onclick="showChildren(<?php echo ($vo["id"]); ?>);"
                <?php if($vo['child_count'] < 1): ?>id=''
                    <?php else: ?>
                    id="tr_<?php echo ($vo["id"]); ?>"<?php endif; ?>
                >
                <td><?php echo ($vo["username"]); ?></td>
                <td><?php echo (date("Y-m-d",$vo["create_time"])); ?></td>
                <td class="last-td last_id<?php echo ($vo["id"]); ?>"><?php echo ($vo["child_count"]); ?><img src="/Public/images/down.png" alt="">
                </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?> -->
            </tbody>
        </table>
    </section>
    <div class="footer_coopyright">
        本活动最终解释权归优培圈所有
    </div>
</div>
</body>
<!-- footer start-->
<script src="/Public/js/home/zepto.min.js"></script>
<script src="/Public/js/home/friends.js" type="text/javascript" charset="utf-8"></script>
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
</html>
<!-- footer end-->