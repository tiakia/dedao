<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"F:\XAMPP\htdocs\momo\public/../application/video\view\index\index.html";i:1518141633;s:70:"F:\XAMPP\htdocs\momo\public/../application/video\view\open\header.html";i:1518140686;s:70:"F:\XAMPP\htdocs\momo\public/../application/video\view\open\footer.html";i:1518141258;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="__PUBLIC__/js/dedao/resize.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/css/dedao/reset.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_549589_66nby1hgbqfwp14i.css ">
    



 <title>得到</title>
 <link rel="stylesheet" href="__PUBLIC__/css/dedao/dropload.css">
 <link rel="stylesheet" href="__PUBLIC__/css/dedao/index.css">
</head>
<body>
    <header>
        <!-- 搜索框 -->
        <div class="search">
            <i class="iconfont icon-sousuo"></i>
            <input type="text" name='search' class="form-input"/>
        </div>
        <!-- 菜单 -->
        <div class="menu-container">
            <div class="icon-left">
                <i class="iconfont icon-shaixuan"></i>
                <span>筛选</span>
            </div>
            <ul class="right-menu">
                <li class="active">
                    <a>全部    
                    </a>
                </li>
                <li>
                    <a>订阅专栏
                        <i class="iconfont icon-xiangxia-copy"></i>
                    </a>
                    <div class="dropdown">
                        <a>读书</a>
                        <a>看报</a>
                        <a>少吃零食</a>
                        <a>少睡觉</a>
                    </div>
                </li>
                <li>
                    <a>每天听本书
                        <!-- <i class="iconfont icon-xiangxia-copy"></i> -->
                    </a>
                </li>
                <li>
                    <a>课程
                        <i class="iconfont icon-xiangxia-copy"></i>
                    </a>
                    <div class="dropdown">
                        <a>读书1</a>
                        <a>看报1</a>
                        <a>少吃零食1</a>
                        <a>少睡觉1</a>
                    </div>
                </li>
                <li>
                    <a>电子书
                        <!-- <i class="iconfont icon-xiangxia-copy"></i> -->
                    </a>
                </li>
                <li>
                    <a>我的课程1
                        <i class="iconfont icon-xiangxia-copy"></i>
                    </a>
                    <div class="dropdown">
                        <a>读书12</a>
                        <a>看报12</a>
                        <a>少吃零食12</a>
                        <a>少睡觉12</a>
                    </div>
                </li>
                <li>
                    <a>我的课程2
                        <i class="iconfont icon-xiangxia-copy"></i>
                    </a>
                    <div class="dropdown">
                        <a>读书123</a>
                        <a>看报123</a>
                        <a>少吃零食123</a>
                        <a>少睡觉123</a>
                    </div>
                </li>
                <li>
                    <a>我的课程3
                        <i class="iconfont icon-xiangxia-copy"></i>
                    </a>
                    <div class="dropdown">
                        <a>读书1234</a>
                        <a>看报1234</a>
                        <a>少吃零食1234</a>
                        <a>少睡觉1234</a>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- 二级菜单 -->
    <div id="dropdown">
        <a>读书</a>
        <a>看报</a>
        <a>少吃零食</a>
        <a>少睡觉</a>
    </div>
    <!-- 主体部分 -->
    <main  id="mescroll">
        <ul class="class-list">
        <?php if(is_array($course_info) || $course_info instanceof \think\Collection || $course_info instanceof \think\Paginator): if( count($course_info)==0 ) : echo "" ;else: foreach($course_info as $key=>$vo): ?>
            <li class="class-item">
                <a href="<?php echo url('Course/item',['course_id'=>$vo['course_id']]); ?>">
                    <img src="<?php echo $vo['thumb']; ?>" alt="">
                    <span class="class-text">
                        <?php echo $vo['title']; ?>
                    </span>
                </a>
            </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>  
        </ul>
    </main>
<!-- 底部导航菜单 -->
    <footer>
        <ul class="nav-list">
            <li class="nav-item active">
                <a href="<?php echo url('Index/index',['page'=>1]); ?>">
                    <i class="iconfont icon-faxian"></i>
                    <span class="nav-text">首页</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo url('Course/play_history'); ?>">
                    <i class="iconfont icon-xuexipingtai"></i>
                    <span class="nav-text">播放历史</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo url('Course/buy_course'); ?>">
                    <i class="iconfont icon-gaiicon-"></i>
                    <span class="nav-text">已购</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo url('Member/index'); ?>">
                    <i class="iconfont icon-wode"></i>
                    <span class="nav-text">我的</span>
                </a>
            </li>
        </ul>
    </footer>
    <script src="__PUBLIC__/js/dedao/zepto.js"></script>
    <script src="__PUBLIC__/js/dedao/event.js"></script>
    <script src="__PUBLIC__/js/dedao/ajax.js"></script>
    <script src="__PUBLIC__/js/dedao/dropload.js"></script>
    <script src="__PUBLIC__/js/dedao/index.js"></script>
</body>
</html> 