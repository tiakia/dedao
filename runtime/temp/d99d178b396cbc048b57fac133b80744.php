<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\login.html";i:1514870927;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>平台管理中心</title>
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge"/>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="robots" content="noindex,nofollow">
    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="_/static/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/static/css/login.css" rel="stylesheet">
    <script>
        if (window.parent !== window.self) {
            document.write              = '';
            window.parent.location.href = window.self.location.href;
            setTimeout(function () {
                document.body.innerHTML = '';
            }, 0);
        }
    </script>
</head>
<body>
<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1 class="text-center">平台管理中心</h1>
                <form class="js-ajax-form" action="<?php echo url('open/dologin'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" id="input_username" class="form-control" name="username"
                               placeholder="用户名" title="用户名"
                               value="<?php echo cookie('admin_username'); ?>" data-rule-required="true" data-msg-required="">
                    </div>

                    <div class="form-group">
                        <input type="password" id="input_password" class="form-control" name="password"
                               placeholder="密码" title="密码" data-rule-required="true"
                               data-msg-required="">
                    </div>

                    <div class="form-group">
                        <div style="position: relative;">
                            <input type="text" name="verify" placeholder="验证码" class="form-control captcha">
                            <img src="/open/checkcode/index.html?height=32&amp;width=150&amp;font_size=18" onclick="this.src='/open/checkcode/index.html?height=32&amp;width=150&amp;font_size=18&amp;time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;position:absolute;right:1px;top:1px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="redirect" value="">
                        <button class="btn btn-primary btn-block js-ajax-submit" type="submit" style="margin-left: 0px"
                                data-loadingmsg="请稍后">
                            登录
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "__ROOT__/",
        WEB_ROOT: "__WEB_ROOT__/",
        JS_ROOT: "static/js/",
        APP: ''/*当前应用名*/
    };
</script>
<script src="__STATIC__/assets/js/jquery-1.10.2.min.js"></script>
<script src="/static/js/jquery.js"></script>
<script src="/static/js/wind.js"></script>
<script src="/static/js/admin.js"></script>
<script>
    (function () {
        document.getElementById('input_username').focus();
    })();
</script>
</body>
</html>
