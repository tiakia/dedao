<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/video/view/open/header.html";i:1518140686;s:69:"/home/wwwroot/momo/public/../application/video/view/member/index.html";i:1519800888;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="__PUBLIC__/js/dedao/resize.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/css/dedao/reset.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_549589_66nby1hgbqfwp14i.css ">
    



    <link rel="stylesheet" href="__PUBLIC__/css/dedao/common.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/dedao/iosSelect.css">
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <link rel="stylesheet" href="__PUBLIC__/css/dedao/user.css">
    <title>个人中心</title>
</head>
<body>
    <nav class="header-nav">
        <a href="javascript:history.go(-1)">
            <i class="iconfont icon-jiantou4"></i>
        </a>    
        <span class="nav-title">个人中心</span>
    </nav>
    <div class="userImg">
        <div class="img-container">
            <img src="<?php echo !empty($member_avatar)?'__UPLOAD__avatar/'.$member_avatar : '__UPLOAD__advert/head.png'; ?>"/>
        </div>
        <div>
            <span class="nickName"><?php echo $member_name; ?></span>
        </div>
    </div>
    <div class="user-item">
        <a>
            <div class="left-icon">
                <i class="iconfont icon-yuebao"></i>
            </div>
            <div class="center">
                <span class="left-text">
                    点券余额
                </span>
                <span class="right-text">
                    <?php echo $buy_coupon; ?>
                </span>
            </div>
            <div class="right-icon">
                <!-- <i class="iconfont icon-youjiantou1"></i> -->
            </div>
        </a>
    </div>     
    <div class="user-item">
        <a href='<?php echo url('Member/change_pass'); ?>'>
            <div class="left-icon">
                <i class="iconfont icon-xiugaimima"></i>
            </div>
            <div class="center">
                <span class="left-text">
                    修改密码    
                </span>
                <span class="right-text">
                    
                </span>
            </div>
            <div class="right-icon">
                <i class="iconfont icon-youjiantou1"></i>
            </div>
        </a>
    </div>  
    <div class="user-item">
        <a id="setSpeed">
            <input type="hidden" name="speed" id="speed" value="">
            <div class="left-icon">
                <i class="iconfont icon-bofanggaikuang"></i>
            </div>
            <div class="center">
                <span class="left-text">
                    设置播放速度
                </span>
                <span class="right-text" 
                      id="showSpeed" 
                      data-id="1"
                      data-value="正常"
                >
                   <?php echo $speed; ?>   
                </span>
            </div>
            <div class="right-icon">
                <i class="iconfont icon-youjiantou1"></i>
            </div>
        </a>
    </div>
    <div class="user-item">
        <input type="hidden" name="token" value="<?php echo $token; ?>" id="token">
        <button class="btn js-loginOut" id="logout">退出登录</button>
    </div>
    <div class="container"></div>     
    <script src="__PUBLIC__/js/dedao/zepto.js"></script>
    <script src="__PUBLIC__/js/dedao/event.js"></script>
    <script src="__PUBLIC__/js/dedao/iosSelect.js"></script>
    <script src="__PUBLIC__/js/dedao/usercenter.js"></script>
</body>
</html>
<script type="text/javascript">
    $(function(){
        //退出登录
        $("#logout").click(function(){
            var tokens = $("#token").val();
            location.href = 'http://momo.veone.cn/video/open/logout?token='+tokens;
        });
    });
    
</script>
