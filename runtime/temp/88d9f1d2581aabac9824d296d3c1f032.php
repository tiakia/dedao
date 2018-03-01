<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/video/view/open/header.html";i:1518140686;s:68:"/home/wwwroot/momo/public/../application/video/view/course/item.html";i:1519718528;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="__PUBLIC__/js/dedao/resize.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/css/dedao/reset.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_549589_66nby1hgbqfwp14i.css ">
    



    <link rel="stylesheet" href="__PUBLIC__/css/dedao/dropload.css">
    <link rel="stylesheet" href="__PUBLIC__/css/dedao/audio.css">
    <title>普罗米修斯</title>
</head>
<body>
    <!-- 上部图片 和 信息 -->
    <div class="top" style="background-image:url(<?php echo $course_info['top_thumb']; ?>)">
        <!-- 蒙层 -->
        <div class="modal"></div>
        <div class="backPage">
            <a href="javascript:history.go(-1)">
                <i class="iconfont icon-fanhui"></i>
            </a>

        </div>
        <!-- 课程信息 -->
        <div class="info-class">
            <span class="class-name"><?php echo $course_info['title']; ?></span>
            <span class="class-person">
                <!-- <span>78809</span>人购买 -->
            </span>
        </div>
        <!-- tab -->
        <div class="tab-container">
            <div class="blur">
               
            </div>
           
        </div>
        <div class="text-container">
                <div class="image active">
                    <span>看图文</span>
                </div>
                <div class="audio">
                    <span>听音频</span>
                </div>
       </div>
    </div>
    <!-- 下部分 列表 tab 切换 -->
    <div class="bottom">
        <div class="total">
            <span>共<?php echo $count; ?>条</span>
            <?php if($course_info['course_money'] > 0): ?><a href="javascript:void(0)" class="buy-class">购买</a><?php endif; ?>
        </div>
        <!-- 图文 -->
        <div class="tab active js-img">
            <div class="lists" id="img-mescroll">
            <?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): if( count($article)==0 ) : echo "" ;else: foreach($article as $key=>$vo): ?>
                <div class="list-item " style="justify-content: flex-start;">
                    <a class="left-btn" href="<?php echo url('Course/detail',['course_id'=>$vo['course_id'],'article_id'=>$vo['article_id']]); ?>">
                        <i class="iconfont icon-yueduliang"></i>
                    </a>
                    <div class="center-container">
                        <p class="top-title">
                            <?php echo $vo['title']; ?>
                        </p>
                        <p class="bottom-info">
                            <span class="date">
                              <?php echo date('m月d日',$vo['create_time']); ?>
                            </span>
                        </p>
                    </div>
                    <a class="right-btn" href="javascript:void(0);">
                        <!-- <i class="iconfont icon-iconset0481"></i> -->
                    </a>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <!-- 音频 -->
        <div class="tab js-audio">
            <div class="lists" id="audio-mescroll">
            <?php if(is_array($video) || $video instanceof \think\Collection || $video instanceof \think\Paginator): if( count($video)==0 ) : echo "" ;else: foreach($video as $key=>$vo): ?>
                <div class="list-item">
                    <!-- 音频属性 封面 播放速度 -->
                    <a class="left-btn" href="javascript:void(0);"
                       data-audio_img="./images/s11.png"
                       data-audio_speed='1.5'
                       data-audio_start_time='120'
                    >
                        <i class="iconfont icon-iconset0481"></i>
                        <!-- 音频链接 -->
                        <audio src="<?php echo $vo['url']; ?>" preload="auto" style="display:none;" class="audioPlay"></audio>
                    </a>
                    <div class="center-container">
                        <p class="top-title active">
                            <?php echo $vo['title']; ?>
                        </p>
                        <p class="bottom-info">
                            <span class="date">
                                <?php echo date('m月d日',$vo['create_time']); ?>
                            </span>
                            <span class="total-time">
                                时长15：30
                            </span>
                            <span class="ready-listen">
                                已听31%
                            </span>
                        </p>
                    </div>
                    <a class="right-btn" href="<?php echo url('Course/detail',['course_id'=>$vo['course_id'],'article_id'=>$vo['article_id']]); ?>">
                        <i class="iconfont icon-yueduliang"></i>
                    </a>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- 底部音频播放器 -->
            <div class="audio-play-con">
                <a href="javascript:void(0);" class="close">
                    <i class="iconfont icon-quxiao"></i>
                </a>
                <div class="audio-detail">
                    <!-- <img src="./images/s11.png" alt=""> -->
                    <div class="center-container">
                        <p class="top-title">
                            驻场答疑之六|世界上都有哪些超能力的英雄在默默付出
                        </p>
                        <p class="bottom-info">
                            <span class="total-time">
                                时长15：30
                            </span>
                            <span class="class-name">
                                枢纽 - 中国史炳50讲
                            </span>
                        </p>
                    </div>
                </div>
                <a href="javascript:void(0);" class="playPause">
                    <i class="iconfont icon-iconset0481"></i>
                    <!-- <i class="iconfont icon-zanting"></i> -->
                </a>
            </div>
        </div>
    </div>
    <script src="__PUBLIC__/js/dedao/zepto.js"></script>
    <script src="__PUBLIC__/js/dedao/event.js"></script>
    <script src="__PUBLIC__/js/dedao/ajax.js"></script>
    <script src="__PUBLIC__/js/dedao/dropload.js"></script>
    <script src="__PUBLIC__/js/dedao/detail.js"></script>
</body>
</html>