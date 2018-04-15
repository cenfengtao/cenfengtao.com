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

<!-- Animate.css -->
<link href="/Public/vendors/animate.css/animate.min.css" rel="stylesheet">
<script src="/Public/vendors/jquery/dist/jquery.min.js"></script>
<script src="/Public/js/layer/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<style>
    #loginSubmit {
        width:34%;font-size:20px;
    }
</style>
<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="<?php echo U('AdminUser/loginIn');?>" method="post" id="loginIn">
                    <h1>登 录</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="用户名" required="required" name="username" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="密码" required="required" name="password" />
                    </div>
                    <div>
                        <a class="btn btn-success" onclick="login.check()" id="loginSubmit">登 录</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">忘记密码请联系客服</p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <p>©2017 优培圈</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="/Public/js/admin/login.js"></script>
<script>
    $(function() {
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                $("#loginSubmit").click();
            }
        });
    });
</script>
</html>