<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/video/view/open/header.html";i:1518140686;s:67:"/home/wwwroot/momo/public/../application/video/view/open/login.html";i:1519801571;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="__PUBLIC__/js/dedao/resize.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/css/dedao/reset.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_549589_66nby1hgbqfwp14i.css ">
    



    <link rel="stylesheet" href="__PUBLIC__/css/dedao/login.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_549589_66nby1hgbqfwp14i.css">
    <title>登录</title>
</head>
<body>
    <div class="form-container">
        <div class="form-group">
            <label for="" class="form-label">手机号</label>
            <input type="tel" class="form-input" name="phone" placeholder="请输入手机号"/>
            <span class="help-block">请输入合法的手机号</span>
        </div>
        <div class="form-group">
            <label for="" class="form-label">密码</label>
            <input type="password" class="form-input" name="password" placeholder="请输入密码"/>
            <span class="help-block">密码大于8位，数字字母下划线组合</span>
        </div>
        <div class="form-group btn-con">
            <button class="btn js-login">登录</button>
            <span class="help-block">数据填写有误，请重新填写</span>
        </div>
        <div class="goRegisterCon">
            没有账号？<a class="goRegister" href="./register.html">去注册</a>
        </div>
    </div>
    <script src="__PUBLIC__/js/dedao/zepto.js"></script>
    <script src="__PUBLIC__/js/dedao/event.js"></script>
    <script src="__PUBLIC__/js/dedao/ajax.js"></script>
    <script src="__PUBLIC__/js/dedao/loginRe.js"></script>
</body>
</html>