<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/video/view/open/header.html";i:1515640322;s:78:"/home/wwwroot/momo/public/../application/video/view/course/article_detail.html";i:1515727530;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="zh-cn">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title><?php echo $article_info['title']; ?></title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no, email=no" />
    <meta name="msapplication-tap-highlight" content="no"/>
    <link rel="dns-prefetch" href="https://staticcdn.igetget.com"/>
    <link rel="dns-prefetch" href="https://piccdn.igetget.com"/>
    <script type="text/javascript">
    window.onerror = function (msg, url, lineNum, colNum, error) {
      var err = { msg: msg, url: url, line: lineNum, column: colNum }
      __uploadErrorMsg(err)
    }

    function __errorHandler (element) {
      var err = {
        tagName: element.tagName,
        srcUrl: element.src || element.href,
        pageUrl: window.location.href,
        referrer: document.referrer,
        isSecondTime: false
      }

      if (element.getAttribute('data-fallbacked')) {
        err.isSecondTime = true
        __uploadErrorMsg(err)
        return false
      }

      __uploadErrorMsg(err)

      try {
        var url = new URL(err.srcUrl)
        if (url.host === 'staticcdn.igetget.com') {
          url.host = 'staticcdn2.igetget.com'
        }
        var ele = document.createElement(err.tagName)
        // 遍历属性, 做href,src属性替换
        for (var i = 0; i < element.attributes.length; i++) {
          var attr = element.attributes[i]
          if (attr.nodeName === 'onerror') {
          } else if (attr.nodeName === 'href') {
            ele[attr.nodeName] = url
          } else if (attr.nodeName === 'src') {
            ele[attr.nodeName] = url
          } else {
            ele[attr.nodeName] = attr.nodeValue
          }
        }
        if (err.tagName === 'SCRIPT') {
          ele.src = url.toString()
          ele.setAttribute('data-fallbacked', 1)
        } else if (err.tagName === 'LINK') {
          ele.href = url.toString()
          ele.setAttribute('data-fallbacked', 1)
        }
        ele.onerror = function () {
          window.__errorHandler(ele)
        }

        element.parentElement.appendChild(ele)
      } catch (e) {
        console.log(e)
      }
    }

    function __uploadErrorMsg (err) {
      var oImg = new Image()
      var errMsg = encodeURIComponent(JSON.stringify(err))
      oImg.src = '/native/errorcollect?err=' + errMsg
    }
    </script>

    <script type="text/javascript" src="https://staticcdn.igetget.com/docker/iget-h5-node/js/libs/flexible.js"></script>



    <link href="https://staticcdn.igetget.com/docker/iget-h5-node/css/project/subscribe/index-new.8f7cda1d1e.css" rel="stylesheet">

    <link href="https://staticcdn.igetget.com/docker/iget-h5-node/css/project/subscribe/article-new.592d63bc76.css" rel="stylesheet">

    <script type="text/javascript">
        var baseUrl = "https://staticcdn.igetget.com/docker/iget-h5-node/";
    </script>


    <script>
    var APPVersion = 0;
    ! function(a, b) {
        function c() {
            var b = f.getBoundingClientRect().width;
            if(a.navigator.appVersion.match(/iphone/gi) && b < 500){
                b = b * i
            }
            b / i > 540 && (b = 540 * i);
            var c = b / 10;
            f.style.fontSize = c + "px", k.rem = a.rem = c
        }
        var d, e = a.document,
            f = e.documentElement,
            g = e.querySelector('meta[name="viewport"]'),
            h = e.querySelector('meta[name="flexible"]'),
            i = 0,
            j = 0,
            k = b.flexible || (b.flexible = {});
        if (g) {
            console.warn("将根据已有的meta标签来设置缩放比例");
            var l = g.getAttribute("content").match(/initial\-scale=([\d\.]+)/);
            l && (j = parseFloat(l[1]), i = parseInt(1 / j))
        } else if (h) {
            var m = h.getAttribute("content");
            if (m) {
                var n = m.match(/initial\-dpr=([\d\.]+)/),
                    o = m.match(/maximum\-dpr=([\d\.]+)/);
                n && (i = parseFloat(n[1]), j = parseFloat((1 / i).toFixed(2))), o && (i = parseFloat(o[1]), j = parseFloat((1 / i).toFixed(2)))
            }
        }
        if (!i && !j) {
            var p = (a.navigator.appVersion.match(/android/gi), a.navigator.appVersion.match(/iphone/gi)),
                q = a.devicePixelRatio;
            i = p ? q >= 3 && (!i || i >= 3) ? 3 : q >= 2 && (!i || i >= 2) ? 2 : 1 : 1, j = 1 / i
        }
        if (f.setAttribute("data-dpr", i), !g)
            if (g = e.createElement("meta"), g.setAttribute("name", "viewport"), g.setAttribute("content", "initial-scale=" + j + ", maximum-scale=" + j + ", minimum-scale=" + j + ", user-scalable=no"), f.firstElementChild) f.firstElementChild.appendChild(g);
            else {
                var r = e.createElement("div");
                r.appendChild(g), e.write(r.innerHTML)
            }
        a.addEventListener("resize", function() {
            clearTimeout(d), d = setTimeout(c, 300)
        }, !1), a.addEventListener("pageshow", function(a) {
            a.persisted && (clearTimeout(d), d = setTimeout(c, 300))
        }, !1), "complete" === e.readyState ? e.body.style.fontSize = 12 * i + "px" : e.addEventListener("DOMContentLoaded", function() {
            e.body.style.fontSize = 12 * i + "px"
        }, !1), c(), k.dpr = a.dpr = i, k.refreshRem = c, k.rem2px = function(a) {
            var b = parseFloat(a) * this.rem;
            return "string" == typeof a && a.match(/rem$/) && (b += "px"), b
        }, k.px2rem = function(a) {
            var b = parseFloat(a) / this.rem;
            return "string" == typeof a && a.match(/px$/) && (b += "rem"), b
        }
    }(window, window.lib || (window.lib = {}));
    </script>

    <link href="https://staticcdn.igetget.com/docker/iget-h5-node/css/project/subscribe/index-new.8f7cda1d1e.css" rel="stylesheet">

    <link href="https://staticcdn.igetget.com/docker/iget-h5-node/css/project/subscribe/article-new.592d63bc76.css" rel="stylesheet">


    <!-- 新版本编辑器样式 -->

    <link href="https://staticcdn.igetget.com/www/editor/dist/preview.b5a1058ad45dab0bd267.css" rel="stylesheet"/>
        <style>
        @font-face {
            font-family: "font-text";
            src: url(https://piccdn.igetget.com/fontminify/eacb20bcc2a485d08633d9f9634861cb.woff);
        }
        .article .article-body p,.article .article-body ul li,.article .article-body ol li,.article .article-body .tips p b,.article .elite-module {
            font-family: "font-text";
        }

        @font-face {
            font-family: "font-title";
            src: url(https://piccdn.igetget.com/fontminify/1673ebbbd65a8183e7dd80f86c2ed0fd.woff);
        }
        .article .title,.article h3.letter-item,.article h4.letter-item,.article .article-body h2.titleCenter {
            font-family: "font-title";
        }

        @font-face {
            font-family: "font-tip";
            src: url(https://piccdn.igetget.com/fontminify/5ab648861837856566a4711fd5db4159.woff);
        }
        .article .article-body .tag span,.article .article-body figure figcaption,.article .article-body .audio .audio-tips .text,.article .article-body .tips p,.article .article-body .audio .info span,.article .author {
            font-family: "font-tip";
        }

        @font-face {
            font-family: "font-titleSmall";
            src: url(https://piccdn.igetget.com/fontminify/dcf36c45f8ceb6b5899e8bce3ee3bd4c.woff);
        }
        .article .article-body h2 {
            font-family: "font-titleSmall";
        }

        @font-face {
            font-family: "font-quoted";
            src: url(https://piccdn.igetget.com/fontminify/bf8a1ab319f4bb07cf31bebc2d8eab81.woff);
        }
        .article .article-body blockquote,.article .article-body blockquote p {
            font-family: "font-quoted";
        }

        @font-face {
            font-family: "font-bold";
            src: url(https://piccdn.igetget.com/fontminify/97ac136360841a1d6512da42b2a99196.woff);
        }
        .article .article-body p b,.article .article-body b {
            font-family: "font-bold";
        }
    </style>
    <script type="text/javascript">
        var user = {"openid":"olFg1szQbEJSbUZtQuBK8BpxnZN8","nickname":"container","sex":1,"language":"zh_CN","city":"漳州","province":"福建","country":"中国","headimgurl":"http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKqmlgRKDoQ7ydNrNyklcibZHtJiaGI3lBGjoebyes5ZHMvtpWkvAicicaE3JqTvv7x6eX7btrfXOI8ZQ/0","privilege":[],"unionid":"oDI7Dvkc35fZGzUZQt_6a_M9AHnc"};
        var id = "jaWZ0XaVLWzD8JEYoZ5AkeqO3vwlA2WeTNC7V4pRMKB4l61yj7bN29gmnxrdGVm0";
        var votestatic = "";
    </script>
<!-- 该模块是前端的全局变量，比如ID，如下例子 -->
    <!-- <script type="text/javascript">
        var productId = "";
    </script> -->
    <script src="__PUBLIC__/js/content.js"></script>
</head>
<body v-cloak>
<article class="article default">
    <h1 class="title name-jaWZ0XaVLWzD8JEYoZ5AkeqO3vwlA2WeTNC7V4pRMKB4l61yj7bN29gmnxrdGVm0"><?php echo $article_info['title']; ?></h1>
    <div class="author">
        <img src="https://piccdn.igetget.com/img/201707/28/201707281123073248911910.jpg@100w_100h"/>
        <p>呃呃呃</p>
        <span class="time"><?php echo date('Y-m-d H:i',$article_info['create_time']); ?></span>
    </div>
    <div class="line"></div>
    <div style="display:none;" v-cloak>
            container
        {&quot;openid&quot;:&quot;olFg1szQbEJSbUZtQuBK8BpxnZN8&quot;,&quot;nickname&quot;:&quot;container&quot;,&quot;sex&quot;:1,&quot;language&quot;:&quot;zh_CN&quot;,&quot;city&quot;:&quot;漳州&quot;,&quot;province&quot;:&quot;福建&quot;,&quot;country&quot;:&quot;中国&quot;,&quot;headimgurl&quot;:&quot;http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKqmlgRKDoQ7ydNrNyklcibZHtJiaGI3lBGjoebyes5ZHMvtpWkvAicicaE3JqTvv7x6eX7btrfXOI8ZQ/0&quot;,&quot;privilege&quot;:[],&quot;unionid&quot;:&quot;oDI7Dvkc35fZGzUZQt_6a_M9AHnc&quot;}
    </div>
    <div class="article-body">
                <div class="player-v2" id="audio-1514300725158">
                    <div class="player-wrap">
                        <!-- i-play / i-pause -->
                        <button class="i-play"></button>
                        <div class="progress-group">
                            <div class="audio-title"><?php echo $article_info['title']; ?></div>
                            <input type="range" min="0" max="100" value="0" data-current="0:00" data-max="12:17" data-total="737"/>
                        </div>
                        <?php if($article_info['audio']): ?>
                        <audio title="<?php echo $article_info['title']; ?>" src="<?php echo $article_info['audio']; ?>" preload cover="https://piccdn.igetget.com/img/201704/24/201704242328257260784871.jpg" cover-img="https://piccdn.igetget.com/img/201704/24/201704242328257260784871.jpg"></audio>
                        <?php endif; ?>
                    </div>
                </div>
                <h2 class="titleCenter">
                    <div>
                        <span>今日内容看点</span>
                    </div>
                </h2>
                <!-- 需要处理空白p标签 -->
                <div class="split"></div>
                <div class="text ">
                    <p><?php echo $article_info['content']; ?></p>
                </div>
    </div>
</article>
    <div id="audioContainer"></div>
    </div>
<script type="text/javascript" src="https://staticcdn.igetget.com/docker/iget-h5-node/js/project/common.4b4dbe7ec8cdca6d1a9b.dist.js"></script>
<script type="text/javascript" src="https://staticcdn.igetget.com/docker/iget-h5-node/js/project/subscribe/detail/main.f0fb23110c32d4305551.dist.js"></script>
</body>
</html>
