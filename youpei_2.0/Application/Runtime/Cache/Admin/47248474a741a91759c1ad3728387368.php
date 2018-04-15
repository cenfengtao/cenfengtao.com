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

<!-- iCheck -->
<link href="/Public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/css/admin/main.css">
<link rel="stylesheet" href="/Public/js/webuploader/webuploader.css"/>
<!-- bootstrap-daterangepicker -->
<link href="/Public/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<style>
    .webuploader-pick {
        padding: 10px 20px;
    }

    #demo-form2 {
        float: left;
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
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>修改投票</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <form id="demo-form2" data-parsley-validate
                                      class="form-horizontal form-label-left form-youpei">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">标题 <span
                                                class="required">*</span></label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input type="text" name="title" value="<?php echo ($vote['title']); ?>"
                                                   class="form-control col-md-7 col-xs-12">
                                            <input type="hidden" name="id" value="<?php echo ($vote['id']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">开始投稿时间
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12 form_radio">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" aria-describedby="inputSuccess2Status3"
                                                       name="work_start_time" value="<?php echo (date('m/d/Y',$vote['work_start_time'])); ?>"
                                                       id="single_cal3"
                                                       class="form-control has-feedback-left" required="required"/>
                                            <span class="fa fa-calendar-o form-control-feedback left"
                                                  aria-hidden="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">截稿时间
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12 form_radio">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" aria-describedby="inputSuccess2Status3"
                                                       name="work_end_time" value="<?php echo (date('m/d/Y',$vote['work_end_time'])); ?>"
                                                       id="single_cal2"
                                                       class="form-control has-feedback-left"/>
                                            <span class="fa fa-calendar-o form-control-feedback left"
                                                  aria-hidden="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">结束投票时间
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12 form_radio">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" aria-describedby="inputSuccess2Status3"
                                                       name="vote_end_time" value="<?php echo (date('m/d/Y',$vote['vote_end_time'])); ?>"
                                                       id="single_cal1"
                                                       class="form-control has-feedback-left"/>
                                            <span class="fa fa-calendar-o form-control-feedback left"
                                                  aria-hidden="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">主办单位 <span
                                                class="required">*</span></label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <select class="form-control" name="sponsor" id="">
                                                <option value="0">请选择</option>
                                                <?php if(is_array($orgList)): foreach($orgList as $key=>$val): ?><option value="<?php echo ($val['id']); ?>" <?php echo ($val['id'] == $vote['sponsor'] ?"selected='selected'":''); ?>><?php echo ($val['org_name']); ?></option><?php endforeach; endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">协办单位 </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <select class="form-control" name="organizer" id="">
                                                <option value="0">请选择(没有可不填)</option>
                                                <?php if(is_array($orgList)): foreach($orgList as $key=>$val): ?><option value="<?php echo ($val['id']); ?>" <?php echo ($val['id'] == $vote['organizer'] ?"selected='selected'":''); ?>><?php echo ($val['org_name']); ?></option><?php endforeach; endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">标签 <span
                                                class="required">*</span></label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input type="text" name="tag" required="required" maxlength="11" value="<?php echo ($vote['tag']); ?>"
                                                   class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">图片</label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div id="filePicker" style=''>上传图片</div>
                                            <input type="hidden" name="image" id="upload_image" tabindex="3"
                                                   autocomplete="off">
                                            <small>图片不能超过500k</small>
                                            <?php if(empty($vote['image'])): ?><img id='preview' src='' ref='' width='200' height='200'
                                                     style='display:none'/>
                                                <?php else: ?>
                                                <img id='preview' ref='' width='200' height='200'
                                                     src="<?php echo ($vote['image']); ?>"/><?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">投稿类型</label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            图片:<input type="radio" name="upload_type" value="1"
                                                   class="flat" <?php echo ($vote['upload_type'] == 1?'checked':''); ?>>
                                            视频:<input type="radio" name="upload_type" value="2"
                                                      class="flat" <?php echo ($vote['upload_type'] == 2?'checked':''); ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">投票模式</label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            纯投票:<input type="radio" name="mode" class="flat" value="1" <?php echo ($vote['mode'] == 1?'checked="checked"':''); ?>>
                                            比赛:<input type="radio" name="mode" class="flat" value="2"  <?php echo ($vote['mode'] == 2?'checked="checked"':''); ?>>
                                        </div>
                                    </div>
                                    <div class="form-group vote_ratio" style="display:none;">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">初赛票数</label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input type="number" name="vote_poll" value="<?php echo ($vote['vote_poll']); ?>" min="0">
                                        </div>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">初赛分数</label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input type="number" name="vote_grade" value="<?php echo ($vote['vote_grade']); ?>" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">投票活动简介</label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <textarea name="description" id="info"><?php echo ($vote['description']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-primary" type="reset">重置</button>
                                            <button type="button" id="table-button-submit" class="btn btn-success">提交
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
<!-- self -->
<script src="/Public/js/common.js"></script>
<script src="/Public/js/plugins/plugins.js"></script>
<script src="/Public/js/upload.js"></script>
<script src="/Public/js/webuploader/webuploader.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="/Public/vendors/moment/min/moment.min.js"></script>
<script src="/Public/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- uEditor -->
<script src="/Public/vendors/ueditor/ueditor.config.js"></script>
<script src="/Public/vendors/ueditor/ueditor.all.min.js"></script>
<script src="/Public/vendors/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8">
    window.UEDITOR_HOME_URL = "/Public/vendors/ueditor/";
    $(document).ready(function () {
        UE.getEditor('info', {
            initialFrameWidth: 900,
            initialFrameHeight: 400,
            serverUrl: "/Public/vendors/ueditor/php/controller.php"
        });
    });
</script>
<script>
    var SCOPE = {
        'jump_url': '<?php echo U("Vote/addVote");?>',
        'success_url': '<?php echo U("Vote/getList");?>'
    };
    var ThinkPHP = window.Think = {
        "ROOT": "",
        "PUBLIC": "/Public",
        "DOMAIN": "<?php echo HTTPDomain();?>"
    };

    $(function () {
        var uploading = null;
        uploadFile({
            server: "<?php echo U('Article/uploadPic');?>",
            pick: '#filePicker',
            formData: {dir: 'adspic'},
            callback: function (result) {
                if (result.status == 1) {
                    layer.close(uploading);
                    var json = WST.toJson(result);
                    $('#preview').attr('src', ThinkPHP.DOMAIN + "/" + json.file.savepath + json.file.savethumbname);
                    $('#upload_image').val('/' + json.file.savepath + json.file.savename);
                    $('#preview').show();
                } else {
                    dialog.error(result.message);
                }
            },
            progress: function (rate) {
                uploading = WST.msg('正在上传图片，请稍后...');
            }
        });
        var mode = $('input[name="mode"]:checked').val();
        if (mode == 2) {
            $('.vote_ratio').show();
        }
    });
    $('input[name="mode"]').change(function () {
        var mode = $('input[name="mode"]:checked').val();
        if (mode == 2) {
            $('.vote_ratio').show();
        }
        if(mode == 1){
            $('.vote_ratio').hide();
            $('input[name="vote_ratio"]').val(0);
        }
    });
</script>
</body>
</html>