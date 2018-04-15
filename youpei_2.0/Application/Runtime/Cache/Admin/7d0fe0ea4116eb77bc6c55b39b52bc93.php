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
<!-- Datatables -->
<link href="/Public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/Public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="/Public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="/Public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="/Public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/css/admin/main.css">
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
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>审核投票列表</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped jambo_table table-bordered">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">标题</th>
                                        <th class="column-title">投稿时间</th>
                                        <th class="column-title">截稿时间</th>
                                        <th class="column-title">投票结束时间</th>
                                        <th class="column-title">投稿类型</th>
                                        <th class="column-title">机构</th>
                                        <th class="column-title">状态</th>
                                        <th class="column-title no-link last"><span class="nobr">操作</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr class="even pointer">
                                            <td><?php echo ($val['title']); ?></td>
                                            <td><?php echo (date("Y-m-d",$val['work_start_time'])); ?></td>
                                            <td><?php echo (date("Y-m-d",$val['work_end_time'])); ?></td>
                                            <td><?php echo (date("Y-m-d",$val['vote_end_time'])); ?></td>
                                            <td><?php echo ($val['upload_type'] == 1?'图片':'视频'); ?></td>
                                            <td><?php echo ($val['org_name']); ?></td>
                                            <td><?php echo ($val['status'] == 1? '审核中':($val['status'] == 2?'通过':'审核失败')); ?></td>
                                            <td class="last">
                                                <a href="<?php echo U('Check/checkVote',array('id'=>$val['id']));?>"
                                                   class="btn btn-info btn-xs btn_access" access_id="176">查看</a>
                                                <a href="javascript:changeStatus(<?php echo ($val['id']); ?>);"
                                                   class="btn btn-success btn-xs btn_access" access_id="177">审核</a>
                                            </td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
<script src="/Public/js/custom/custom.min.js"></script>
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
<!-- bootstrap-progressbar -->
<script src="/Public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="/Public/vendors/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="/Public/vendors/fastclick/lib/fastclick.js"></script>
<!-- Datatables -->
<script src="/Public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/Public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/Public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/Public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="/Public/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="/Public/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/Public/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/Public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="/Public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="/Public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/Public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="/Public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="/Public/vendors/jszip/dist/jszip.min.js"></script>
<script src="/Public/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="/Public/vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- self -->
<script>
    function changeStatus(voteId) {
        layer.open({
            type: 1,
            title: '审核状态',
            skin: 'layui-layer-rim',
            area: ['370px', '240px'], //宽高
            content: "<form style='margin-top:20px;' id='demo-form2' data-parsley-validate class='form-horizontal form-label-left form-youpei'><div class='form-group'>" +
            "<label class='control-label col-md-3 col-sm-3 col-xs-12'> 审核结果 </label>" +
            "<div class='col-md-6 col-sm-6 col-xs-12'>" +
            "<input type='hidden' name='voteId' value='" + voteId + "'>" +
            "审核通过:<input type='radio' name='status' class='flat icheckbox_flat-green;' value='2' checked='checked' onclick='hiddenMsg()'>" +
            "审核失败:<input type='radio' name='status' class='flat icheckbox_flat-green;' value='3' onclick='showMsg()'>" +
            "</div></div>" +
            "<div class='form-group' id='errMsg' style='display: none;'>" +
            "<label class='control-label col-md-3 col-sm-3 col-xs-12'> 失败理由 </label>" +
            "<div class='col-md-6 col-sm-6 col-xs-12'>" +
            "<textarea style='width:220px;height:50px;resize:none;' id='errMsgContent'></textarea>" +
            "</div></div>" +
            "<div class='form-group'>" +
            "<div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>" +
            "<button class='btn btn-primary' type='reset'>重置</button>" +
            "<button type='button'  class='btn btn-success' onclick='submitStatus()'>提交</button>" +
            "</div></div></form>"
        });
    }

    function submitStatus() {
        var url = "<?php echo U('Check/submitCheckForVote');?>";
        var status = $("input[name='status']:checked").val();
        var voteId = $("input[name='voteId']").val();
        var errMsg = $("#errMsgContent").val();
        $.post(url, {status: status, voteId: voteId, errMsg: errMsg}, function (result) {
            if (result.status == 1) {
                return dialog.success(result.message, "<?php echo U('Check/voteList');?>");
            } else {
                return dialog.error(result.message);
            }
        }, 'json');
    }
    function showMsg() {
        $("#errMsg").show();
    }

    function hiddenMsg() {
        $("#errMsg").hide();
    }
</script>
</body>
</html>