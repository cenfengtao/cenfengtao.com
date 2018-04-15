<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>优培圈后台管理系统</title>

    <!-- Bootstrap -->
    <link href="/Public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/Public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="/Public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/Public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/Public/css/custom/custom.min.css" rel="stylesheet">
    <!-- Main -->
    <link rel="stylesheet" href="/Public/css/admin/main.css">
</head>

<!-- NProgress -->
<link href="/Public/vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="/Public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- SELF -->
<link rel="stylesheet" href="/Public/css/admin/main.css">
<link rel="stylesheet" href="/Public/css/admin/index.css">
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="/admin.php" class="site_title">&nbsp; &nbsp;&nbsp;&nbsp;<span>优培圈</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="/Public/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>欢迎光临</span>
                <h2><?php echo ($adminName); ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3><?php echo ($roleName); ?></h3>
                <ul class="nav side-menu">
                    <?php if(is_array($menuList)): foreach($menuList as $key=>$val): if(empty($val['child'])): ?><li class="btn_access" access_id="<?php echo ($val['accessId']); ?>"><a href="<?php echo U($val['url']);?>"><i class="fa <?php echo ($val['pic_url']); ?>"></i> <?php echo ($val['title']); ?> </a></li>
                            <?php else: ?>
                            <li class="btn_access" access_id="<?php echo ($val['accessId']); ?>"><a><i class="fa <?php echo ($val['pic_url']); ?>"></i> <?php echo ($val['title']); ?> <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?php if(is_array($val['child'])): foreach($val['child'] as $key=>$vo): ?><li class="btn_access" access_id="<?php echo ($vo['accessId']); ?>"><a href="<?php echo U($vo['url']);?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; ?>
                                </ul>
                            </li><?php endif; endforeach; endif; ?>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <div style="display: inline-block;float: right;">
                <a href="<?php echo U('ProductComment/commentList');?>" style="line-height: 58px;margin-right:30px;"><i class="fa fa-users"></i>用户咨询 <span style="color:red">(<?php echo ($newProductCommentCount); ?>条新咨询)</span></a>
                <a href="<?php echo U('Order/orderList');?>" style="margin-right: 10px;"><i class="glyphicon glyphicon-bell"></i>订单通知 <span style="color:red">(<?php echo ($newOrderMsgCount); ?>条新信息)</span></a>
                <ul class="nav navbar-nav navbar-right" style="width:auto;">
                    <li>
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <?php echo ($adminName); ?>
                            <span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="<?php echo U('AdminUser/editAdminUser',array('adminId'=>$adminId));?>"><i class="glyphicon glyphicon-cog pull-right" ></i>修改资料</a></li>
                            <li><a href="<?php echo U('Login/loginOut');?>"><i class="fa fa-sign-out pull-right"></i> 退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- /top navigation -->
        <!-- page content -->
        <?php if($isSuper == 2): ?><div class="right_col" role="main" style="padding-bottom: 1px;">
                <div style="text-align: center;margin-top: 110px;">
                    <h1>欢迎登陆优培圈后台</h1>
                </div>
            </div>
            <?php else: ?>
            <div class="right_col" role="main" style="padding-bottom: 1px;">
                <div class="col_header">
                    <div class="header-frame">
                        <div class="visual"><i class="fa fa-user-md"></i></div>
                        <div class="details">
                            <div class="number"><?php echo ($userCount); ?></div>
                            <div class="details-type">平台用户数量</div>
                        </div>
                        <a href="<?php echo U('Index/userLoginRecord');?>" class="check-detail">查看详细<i
                                class="fa fa-chevron-circle-right"></i></a>
                    </div>
                    <div class="header-frame">
                        <div class="visual"><i class="fa fa-user-md"></i></div>
                        <div class="details">
                            <div class="number"><?php echo ($integralCount); ?></div>
                            <div class="details-type">积分数量</div>
                        </div>
                        <a href="<?php echo U('Index/userIntegralRecord');?>" class="check-detail">查看详细<i
                                class="fa fa-chevron-circle-right"></i></a>
                    </div>
                    <div class="header-frame">
                        <div class="visual"><i class="fa fa-user-md"></i></div>
                        <div class="details">
                            <div class="number"><?php echo ($shareCount); ?></div>
                            <div class="details-type">转发数量</div>
                        </div>
                        <a href="javascript:void(0);" class="check-detail">查看详细<i
                                class="fa fa-chevron-circle-right"></i></a>
                    </div>
                    <div class="header-frame">
                        <div class="visual"><i class="fa fa-user-md"></i></div>
                        <div class="details">
                            <div class="number"><?php echo ($todayCount); ?></div>
                            <div class="details-type">每日登陆数量</div>
                        </div>
                        <a href="javascript:void(0);" class="check-detail">查看详细<i
                                class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
                <div class="col_chart">
                    <div style="width:100%;">
                        <canvas id="canvas" style="width:80%;height:500px;"></canvas>
                    </div>
                </div>
            </div><?php endif; ?>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                2017 © 优培圈
            </div>
            <!-- 获取权限 -->
            <div style="display: none">
                <?php if(is_array($accessIdList)): foreach($accessIdList as $k=>$val): ?><p class="accessIdList" attr_key="<?php echo ($k); ?>" attr_value="<?php echo ($val); ?>"></p><?php endforeach; endif; ?>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- jQuery -->
        <script src="/Public/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/Public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="/Public/vendors/fastclick/lib/fastclick.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="/Public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- Skycons -->
        <script src="/Public/vendors/skycons/skycons.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="/Public/js/custom/custom.min-index.js"></script>
        <!-- NProgress -->
        <script src="/Public/vendors/nprogress/nprogress.js"></script>
        <!-- layer -->
        <script src="/Public/js/layer/layer.js"></script>
        <script src="/Public/js/dialog.js"></script>
        <!-- common -->
        <script src="/Public/js/admin/common.js"></script>
        <!-- /footer content -->
    </div>
</div>
<!-- FastClick -->
<script src="/Public/vendors/fastclick/lib/fastclick.js"></script>

<!-- chart.js -->
<script src="/Public/js/Chart.js-2.6.0/dist/Chart.bundle.js"></script>
<script src="/Public/js/Chart.js-2.6.0/samples/utils.js"></script>
<script>
    var dates = new Array();
    var new_user = new Array();
    var login_user = new Array();
    var datesData = <?php echo ($datesData); ?>;
    var i = 0;
    $.each(datesData, function (index, item) {
        dates[i] = item['date'];
        new_user[i] = item['new_user'];
        login_user[i] = item['login_user'];
        i++;
    });
    var config = {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: "用户增加数量",
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                data: new_user,
                fill: false,
            }, {
                label: "每日登陆数量",
                backgroundColor: window.chartColors.green,
                borderColor: window.chartColors.green,
                data: login_user,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                    },
                    ticks: {
                        min: 0,
                        max: 500,
                        stepSize: 20
                    }
                }]
            }
        }
    };
    window.onload = function () {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, config);
    };
</script>
</body>
</html>