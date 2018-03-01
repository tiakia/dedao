<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/video/view/open/header.html";i:1518140686;s:70:"/home/wwwroot/momo/public/../application/video/view/course/detail.html";i:1519615748;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="__PUBLIC__/js/dedao/resize.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/css/dedao/reset.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_549589_66nby1hgbqfwp14i.css ">
    



    <link rel="stylesheet" href="__PUBLIC__/css/dedao/detail.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_549589_c1lt3yjzdkc07ldi.css ">
    <title>图文详情</title>
</head>
<body>
    <header>
        <h3 class="title">
            <?php echo $content['title']; ?>
        </h3>
        <div class="author">
            <div class="author-info">
                <img src="<?php echo $content['thumb']; ?>">
                <span class="author-name"><?php echo $content['author_name']; ?></span>
            </div>
            <span class="article-time">
                <?php echo date('Y-m-d H:i',$content['create_time']); ?>
            </span>
        </div>
    </header>
    <!-- 音频显示 -->
    <?php if($content['audio']): ?>
    <div class="audio-con">
        <div class="left-btn">
            <a href="">
                <i class="iconfont icon-bofang"></i>
                <!-- <i class="iconfont icon-zanting1"></i> -->
            </a>
        </div>
        <div class="right-info">
            <span class="audio-title">
                <?php echo $content['title']; ?>    
            </span>
            <div class="audio-info">
                <span class="time">10:22</span>
                <span class="audio-bit">4.86MB</span>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- <div class="reader">
        信件朗读者： 宝木
    </div> -->
    <!-- 正文 -->
    <article>
        <!-- <h4>display,你好！</h4>
        <p>我在《浪潮之巅》一书中，写到了“美国政府诉微软案”，这里面涉及到的最关键的词就是“垄断”二字。关于垄断我在昨天的信中谈到了它的本质特征和危害，以及为什么反垄断是必须的。今天我就和你聊聊 IT 行业里的垄断。</p>
        <p>首先我想分析一个大家都能观察到的现象，那就是 IT 行业非常容易形成垄断，而在传统行业中这一点其实非常困难。比如微软公司从1975年成立，到1991年美国政府开始对它进行反垄断调查，中间只经过了15年的时间。</p>
        <p>Google 从1998年成立，到占有70%的搜索市场份额，只用了不到4年的时间。当然，搜索只是在互联网上大家常用的功能之一，而且每天使用的时间并不长，但是 Google 从诞生到获得互联网上一半的广告收入（加上它的广告联盟），也不过用了10年左右的时间。</p>
        <p>事实上，在2007年，Google 提出收购雅虎时，美国政府就首次对 Google 进行了反垄断“关注”，这让 Google 放弃了对雅虎的收购。Google 后来在自己之上又成立了控股的母公司 Alphabet，一个重要的考虑也是害怕将来美国政府对它提起反垄断诉讼。</p>
        <p>Facebook 成长更快，从诞生到获得一大半的社交网络市场，只花了短短三年时间。要不是因为中国政府不让它进入中国市场，是否能有腾讯的神话还真说不准。至于美国政府没有对它进行反垄断关注，是因为在它的前面有一个更大的互联网公司 Google 存在。
        </p> -->
        <?php echo $content['content']; ?>
    </article>
</body>
</html>