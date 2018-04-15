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
                            <h2>投票列表</h2>
                            <a href="<?php echo U('Vote/addVote');?>" class="btn btn-success add_button btn_access" access_id="167">添加投票</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                         aria-labelledby="home-tab">
                                        <div class="table-responsive">
                                            <table id="datatable"
                                                   class="table table-striped jambo_table table-bordered">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title">标题</th>
                                                    <th class="column-title">投稿时间</th>
                                                    <th class="column-title">截稿时间</th>
                                                    <th class="column-title">结束投票时间</th>
                                                    <th class="column-title">投稿类型</th>
                                                    <th class="column-title">状态</th>
                                                    <th class="column-title">审核状态</th>
                                                    <th class="column-title no-link last"><span class="nobr">操作</span></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(is_array($list)): foreach($list as $key=>$val): ?><tr class="even pointer">
                                                        <td><?php echo ($val['title']); ?></td>
                                                        <td><?php echo (date("m-d", $val['work_start_time'] )); ?></td>
                                                        <td><?php echo (date("m-d", $val['work_end_time'] )); ?></td>
                                                        <td><?php echo (date("m-d", $val['vote_end_time'] )); ?></td>
                                                        <td><?php echo ($val['upload_type'] == 1? '图片': '视频'); ?></td>
                                                        <td><?php echo ($val['status'] == 1 ? '投稿中': ($val['status'] == 2?'截止投稿':($val['status'] == 3? '截止投票':($val['status'] == 4?'发布结果':'已结束')))); ?></td>
                                                        <td><?php echo ($val['check_status'] == 1? '审核中': ($val['check_status'] == 2? '通过':'不通过:')); echo ($val["err_msg"]); ?></td>
                                                        <td class="last">
                                                            <a href="<?php echo U('Vote/editVote',array('id'=>$val['id']));?>" class="btn btn-info btn-xs btn_access" access_id="168">修改</a>
                                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs btn_access table-button-delete" attr_message="确认删除该投票？" access_id="169" attr_id="<?php echo ($val['id']); ?>">删除</a>
                                                            <?php if($val['check_status'] == 3): ?><a href="javascript:regainCheck(<?php echo ($val['id']); ?>)"
                                                                   class="btn btn-success btn-xs btn_access" access_id="174">重新审核</a><?php endif; ?>
                                                            <?php if(in_array(($val['status']), explode(',',"1,2"))): ?><a href="<?php echo U('Vote/getContribution',array('id' => $val['id']));?>" class="btn btn-primary btn-xs btn_access" access_id="178">作品列表</a><?php endif; ?>
                                                            <?php if(in_array(($val['status']), explode(',',"5"))): else: ?>
                                                                <a href="<?php echo U('Vote/getVoteList',array('vote_id' => $val['id']));?>" style="background:#FF758D;border: #FF758D;" class="btn btn-primary btn-xs btn_access" access_id="294" >投票记录</a><?php endif; ?>
                                                            <a href="<?php echo U('Vote/getProductList',array('vote_id' => $val['id']));?>" style="background:#26b946;border: #26b946;" class="btn btn-primary btn-xs btn_access" access_id="500">活动商品</a>
                                                            <a href="/admin.php/Admin/Vote/prizeList.html?vote_id=<?php echo ($val['id']); ?>"style="background:#ec7a0a;border: #ec7a0a;" class="btn btn-primary btn-xs btn_access" access_id="508">奖品发放</a>
                                                        </td>
                                                    </tr><?php endforeach; endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
    var SCOPE = {
        'delete_url': '<?php echo U("Vote/delete");?>'
    };
    function regainCheck(id) {
        var url = "<?php echo U('Check/regainCheckVote');?>";
        $.post(url, {id: id}, function (result) {
            if (result.status == 1) {
                return dialog.success(result.message, "<?php echo U('Vote/getList');?>");
            } else {
                return dialog.error(result.message);
            }
        }, 'json');
    }
</script>
</body>
</html>